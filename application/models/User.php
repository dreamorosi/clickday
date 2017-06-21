<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class User extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  function loginUser($email, $password)
  {
    $this->load->helper('security');
    $password = do_hash($password);
    $query = $this->db->get_where('users', array('email' => $email, 'password' => $password));
    if ($query->num_rows() > 0) {
      $newdata = array(
        'email' => $email,
        'isLogged' => TRUE,
        'name' => $query->row()->name,
        'surname' => $query->row()->surname,
        'ID' => $query->row()->ID,
        'approved' => $query->row()->approved,
        'clickM' => $query->row()->clickM,
        'role' => 'user',
        'lastSeen' => $query->row()->lastSeen,
        'subCm' => $query->row()->subCm,
        'referral' => $query->row()->referral,
        'isWinner' => $query->row()->isWinner
      );
      $this->session->set_userdata($newdata);
      return TRUE;
    } else {
      return FALSE;
    }
  }

  function shotMail($email, $subject, $payload, $template)
  {
    $this->load->library('email');
    $this->load->helper('url');
    $config['protocol'] = 'sendmail';
    // $config['protocol'] = 'smtp';
    // $config['smtp_host'] = 'emcwhosting.hwgsrl.it';
    // $config['smtp_port'] = '25';
    // $config['smtp_timeout'] = '7';
    // $config['smtp_user'] = 'info@clickdayats.it';
    // $config['smtp_pass'] = 'YUcd_2016!';
    $config['validate'] = 'FALSE';
    $config['mailtype'] = 'html';
    $this->email->initialize($config);
    $this->email->from('info@clickdayats.it', 'ClickDay 2017');
    $this->email->to($email);
    $this->email->subject($subject);
    $content = $this->load->view($template, $payload, TRUE);
    $this->email->message($content);
    $this->email->send();
  }

  function sendRecoveryMail($email, $code)
  {
    $subject = 'Recupero Password ClickDay 2017';
    $data = array('base_url' => base_url(), 'recovery' => base_url('login/forgot/' . $code));
    $template = 'emails/recovery';
    $this->shotMail($email, $subject, $data, $template);
  }

  function sendConfirmActivation($email, $role, $payload)
  {
    $subject = 'Conferma Attivazione ClickDay 2017';
    $data = array('base_url' => base_url());
    $template = 'emails/confirm_usr';
    if ($role === 'cm') {
      $subject = 'Nuovo Utente Verificato ClickDay 2017';
      $data = array('base_url' => base_url(), 'name' => $payload);
      $template = 'emails/confirm_cm';
    }
    $this->shotMail($email, $subject, $data, $template);
  }

  function createNewUser($usr)
  {
    $query = $this->db->get_where('users', array('email' => $usr['email']));
    $response = array(
      'success' => TRUE
    );
    if ($query->num_rows() > 0) {
      $response['success'] = FALSE;
      $response['message'] = "L'indirizzo mail inserito è già in uso";
      return $response;
    }
    $this->load->helper('security');
    $password = do_hash($usr['password']);
    $this->load->helper('string');
    $activation = random_string('alnum', 16);
    $this->load->helper('date');
    $datestring = '%Y-%m-%d %H:%i';
    $time = now('Europe/Rome');
    $now = mdate($datestring, $time);
    $referral = $this->generateSubCode();
    $newUser = array(
      'name' => $usr['name'],
      'surname' => $usr['surname'],
      'email' => $usr['email'],
      'phone' => $usr['phone'],
      'password' => $password,
      'dateBirth' => $usr['dateBirth'],
      'country' => $usr['country'],
      'address' => $usr['address'],
      'cf' => $usr['cf'],
      'joinDate' => $now,
      'prov' => $usr['prov'],
      'cap' => $usr['cap'],
      'work' => $usr['work'],
      'clickM' => $usr['clickM'],
      'subCm' => $usr['subCm'],
      'clickM_code' => $usr['clickM_code'],
      'referral' => $referral,
      'activation' => $activation,
      'region' => ''
    );
    $this->db->insert('users', (object)$newUser);
    if ($this->db->affected_rows() > 0) {
      if ($usr['clickM'] != -1) {
        $cmEmail = $this->clickmaster->getCMemail($usr['clickM']);
        if ($cmEmail != '') {
          $subject = 'Nuovo Utente Registrato ClickDay 2017';
          $name = $usr['name'] . ' ' . $usr['surname'];
          $code = $usr['clickM_code'];
          $template = 'emails/activation_cm';
          $data = array('base_url' => base_url(), 'name' => $name, 'code' => $code);
          $this->shotMail($cmEmail, $subject, $data, $template);
        }
      }
      if ($usr['subCm'] !== 'NULL') {
        $usrEmail = $this->getEmail($usr['subCm']);
        if ($usrEmail != '') {
          $subject = 'Nuovo Utente Registrato ClickDay 2017';
          $fullName = $usr['name'] . ' ' . $usr['surname'];
          $referredUsers = $this->user->getReferredUsers($usr['subCm']);
          $data = array('base_url' => base_url(), 'name' => $fullName, 'referredUsers' => $referredUsers);
          $template = 'emails/activation_subcm';
          $text = 'Un nuovo utente si è registrato come tuo referral. Il suo nome è ' . $fullName . '. Adesso hai ' . $referredUsers . ' referral.';
          $this->load->model('dashboard_model');
          $ID = $this->dashboard_model->sendmessage($subject, $text, -1, $usr['subCm'], -27, -1);
      		$this->dashboard_model->putNot($ID, -1, $usr['subCm']);
          $this->shotMail($usrEmail, $subject, $data, $template);
        }
      }
      $subject = 'Registrazione ClickDay 2017';
      $data = array('base_url' => base_url(), 'code' => base_url('users/activate/' . $activation));
      $template = 'emails/activation';
      $this->shotMail($usr['email'], $subject, $data, $template);
      return $response;
    } else {
      $response['success'] = FALSE;
      $response['message'] = "Si è verificato un errore inaspettato, riprovare tra qualche istante";
      return $response;
    }
  }

  function generateSubCode()
  {
    do{
      $subcode = substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(5/strlen($x)) )),1,5);
    } while($this->db->get_where('users', array('referral' => $subcode))->num_rows()!=0);
    return $subcode;
  }

  function genereateCodes()
  {
    $query = $this->db->get_where('users', array('referral' => NULL));
    $users = $query->result_array();
    if ($query->num_rows() > 0) {
      foreach($users as $user){
        $this->db->set('referral', $this->generateSubCode())->where('ID', $user['ID'])->update('users');
      }
    }
  }

  function editUserInfo($ID, $usr)
  {
    $this->db->set($usr)->where('ID', $ID)->update('users');
    return $this->db->affected_rows() > 0;
  }

  function activateUser($code)
  {
    $query = $this->db->get_where('users', array('activation' => $code));
    if ($query->num_rows() > 0) {
      $email = $query->row()->email;
      $clickM = $query->row()->clickM;
      $name = $query->row()->name;
      $surname = $query->row()->surname;
      $this->db->set(array('activation' => NULL, 'approved' => 1))->where('ID', $query->row()->ID)->update('users');
      if ($this->db->affected_rows() > 0) {
        if ($clickM != -1) {
          $cmEmail = $this->clickmaster->getCMemail($clickM);
          if ($cmEmail != '') {
            $name = $name . ' ' . $surname;
            $this->sendConfirmActivation($cmEmail, 'cm', $name);
          }
        }
        $this->sendConfirmActivation($email, 'usr', $name);
        return TRUE;
      } else {
        return FALSE;
      }
    } else {
      return FALSE;
    }
  }

  function setRecovery($email)
  {
    $query = $this->db->get_where('users', array('email' => $email));
    if ($query->num_rows() > 0) {
      $this->load->helper('string');
      $code = random_string('alnum', 16);
      $this->db->set('recovery', $code)->where('ID', $query->row()->ID)->update('users');
      if ($this->db->affected_rows() > 0) {
        $this->sendRecoveryMail($email, $code);
        return TRUE;
      } else {
        $data['code'] = 500;
        return $data;
      }
    } else {
      $data['code'] = 409;
      $data['message'] = "La mail inserita non risulta essere nei nostri database";
      return $data;
    }
  }

  function checkForgot($code)
  {
    if ($code != NULL) {
      $query = $this->db->get_where('users', array('recovery' => $code));
      if ($query->num_rows() > 0) {
        $ID = $query->row()->ID;
        $this->db->set('recovery', NULL)->where('ID', $ID)->update('users');
        if ($this->db->affected_rows() > 0) {
          $data['code'] = 200;
          $data['ID'] = $ID;
          return $data;
        } else {
          $data['code'] = 500;
          return $data;
        }
      } else {
        $data['code'] = 409;
        $data['message'] = "Il codice fornito non è stato trovato o è già scaduto.";
        return $data;
      }
    } else {
      $data['code'] = 409;
      $data['message'] = "Il codice fornito non è stato trovato o è già scaduto.";
      return $data;
    }
  }

  function getName($ID)
  {
    $query = $this->db->get_where('users', array('ID' => $ID));
    if ($query->num_rows() > 0) {
      return $query->row()->name;
    } else {
      return '';
    }
  }

  function getFullName($ID)
  {
    $query = $this->db->get_where('users', array('ID' => $ID));
    if ($query->num_rows() > 0) {
      return $query->row()->name . ' ' . $query->row()->surname;
    } else {
      return '';
    }
  }

  function getEmail($ID)
  {
    $query = $this->db->get_where('users', array('ID' => $ID));
    if ($query->num_rows() > 0) {
      return $query->row()->email;
    } else {
      return '';
    }
  }

  function getUserById($ID)
  {
    $query = $this->db->get_where('users', array('ID' => $ID));
    if ($query->num_rows() > 0) {
      $query->row()->joinDate = date('d/m/Y', strtotime($query->row()->joinDate));
      $query->row()->lastSeen = date('d/m/Y \a\l\l\e h:i', strtotime($query->row()->lastSeen));
      if ($query->row()->screen_uploaded) {
        $query->row()->screen_file = $this->checkScreen($ID);
      }
      if ($query->row()->cont_uploaded) {
        $query->row()->contract_file = $this->checkCont($ID);
      }
      return $query->row();
    } else {
      log_message('error', 'ERROR: I am :bug: you have been hunting since 27/4 2:50. The $ID was ' . $ID . ' type ' . gettype($ID));
      return FALSE;
    }
  }

  function recoveryPass($password, $ID)
  {
    $this->load->helper('security');
    $password = do_hash($password);
    $query = $this->db->get_where('users', array('ID' => $ID));
    if ($query->num_rows() > 0) {
      if ($query->row()->password == $password) {
        $data['code'] = 409;
        $data['message'] = "La nuova password non deve essere uguale a quella precedente.";
        return $data;
      } else {
        $this->db->set(array('password' => $password, 'recovery' => NULL))->where('ID', $ID)->update('users');
        if ($this->db->affected_rows() > 0) {
          $data['code'] = 200;
          return $data;
        } else {
          $data['code'] = 500;
          return $data;
        }
      }
    } else {
      $data['code'] = 500;
      return $data;
    }
  }

  function screenStat($ID)
  {
    $query = $this->db->get_where('users', array('ID' => $ID));
    if ($query->num_rows() > 0) {
      return $query->row()->screen_uploaded;
    } else {
      return FALSE;
    }
  }

  function contStat($ID)
  {
    $query = $this->db->get_where('users', array('ID' => $ID));
    if ($query->num_rows() > 0) {
      return $query->row()->cont_uploaded;
    } else {
      return FALSE;
    }
  }

  function checkScreen($ID)
  {
    $query = $this->db->get_where('screenshots', array('user' => $ID));
    if ($query->num_rows() > 0) {
      return $query->row()->filename;
    } else {
      return FALSE;
    }
  }

  function checkCont($ID)
  {
    $query = $this->db->get_where('contracts', array('user' => $ID));
    if ($query->num_rows() > 0) {
      return $query->row()->filename;
    } else {
      return FALSE;
    }
  }

  function uploadCont($ID, $filename)
  {
    $oldFile = $this->checkCont($ID);
    if ($oldFile != FALSE) {
      $this->load->helper('file');
      $this->load->helper('date');
      $format = '%Y-%m-%d %H:%i:%s';
      $time = time();
      $now = mdate($format, $time);
      if (!unlink($_SERVER['DOCUMENT_ROOT'] . '/assets/uploads/contratti/' . $oldFile)) {
        return FALSE;
      }
      $this->db->set(array('filename' => $filename, 'uploaded' => $now, 'approved' => 0))->where('user', $ID)->update('contracts');
      $this->db->set('cont_uploaded', 1)->where('ID', $this->session->userdata('ID'))->update('users');
      return TRUE;
    } else {
      $newUser = array('user' => $ID, 'filename' => $filename);
      $this->db->insert('contracts', (object)$newUser);
      $this->db->set('cont_uploaded', 1)->where('ID', $this->session->userdata('ID'))->update('users');
      if ($this->db->affected_rows() > 0) {
        return TRUE;
      } else {
        return FALSE;
      }
    }
  }

  function uploadScreen($ID, $filename)
  {
    $oldFile = $this->checkScreen($ID);
    if ($oldFile != FALSE) {
      $this->load->helper('file');
      $this->load->helper('date');
      $format = '%Y-%m-%d %H:%i:%s';
      $time = time();
      $now = mdate($format, $time);
      if (!unlink($_SERVER['DOCUMENT_ROOT'] . '/assets/uploads/screenshots/' . $oldFile)) {
        return FALSE;
      }
      $this->db->set(array('filename' => $filename, 'uploaded' => $now, 'approved' => 0))->where('user', $ID)->update('screenshots');
      $this->db->set('screen_uploaded', 1)->where('ID', $this->session->userdata('ID'))->update('users');
      return TRUE;
    } else {
      $newUser = array('user' => $ID, 'filename' => $filename);
      $this->db->insert('screenshots', (object)$newUser);
      $this->db->set('screen_uploaded', 1)->where('ID', $this->session->userdata('ID'))->update('users');
      if ($this->db->affected_rows() > 0) {
        return TRUE;
      } else {
        return FALSE;
      }
    }
  }

  function removeUsr($ID)
  {
    $this->db->delete('screenshots', array('user' => $ID));
    return $this->db->delete('users', array('ID' => $ID));
  }

  function removeUsrCode($ID)
  {
    $this->db->set('region', '')->where('ID', $ID)->update('users');
    return $this->db->set('code', 'NULL', false)->where('ID', $ID)->update('users');
  }

  function setWinnerAgree($ID)
  {
    $this->load->helper('date');
    $datestring = '%Y-%m-%d %H:%i';
    $time = now('Europe/Rome');
    $now = mdate($datestring, $time);
    $query = $this->db->get_where('users', array('ID' => $ID));
    if ($query->num_rows() > 0) {
      $date = $query->row()->winnerAgreement;
      if ($date == '0000-00-00 00:00:00') {
        return $this->db->set('winnerAgreement', $now)->where('ID', $ID)->update('users');
      } else {
        return FALSE;
      }
    }
  }

  function getReferredUsers($ID)
  {
    $query = $this->db->get_where('users', array('subCm' => $ID));
    return $query->num_rows();
  }

  function checkSubCode($code)
  {
    $query = $this->db->get_where('users', array('referral' => $code));
    if ($query->num_rows() > 0) {
      return $query->row()->ID;
    } else {
      return 'NULL';
    }
  }

  function toggleWinner($ID, $newState) {
    return $this->db->set('isWinner', $newState)->where('ID', $ID)->update('users');
  }

  function shouldNotifyATS($ID)
  {
    $usr = $this->getUserById($ID);
    if ($usr->bank !== '' && $usr->account_holder !== '' && $usr->iban !== '' && $usr->comune !== '') {
      $email = 'vecxijjw@sharklasers.com';
      $subject = 'test';
      $payload = array(
        'name' => $usr->name . ' ' . $usr->surname,
        'base_url' => base_url(),
        'bank' => $usr->bank,
        'account_holder' => $usr->account_holder,
        'iban' => $usr->iban,
        'comune' => $usr->comune
      );
      $template = 'emails/winnerData';
      $this->user->shotMail($email, $subject, $payload, $template);
    }
  }
}
?>
