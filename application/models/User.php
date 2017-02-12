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
		if ($query->num_rows() > 0){
			$newdata = array(
				'email'     => $email,
				'isLogged' => TRUE,
				'name' => $query->row()->name,
				'surname' => $query->row()->surname,
				'ID' => $query->row()->ID,
				'approved' => $query->row()->approved,
				'clickM' => $query->row()->clickM,
				'role' => 'user',
				'lastSeen' => $query->row()->lastSeen
			);
			$this->session->set_userdata($newdata);
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function sendActivationMail($email, $role, $activation)
	{
		$this->load->library('email');
		$this->load->helper('url');
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'emcwhosting.hwgsrl.it';
        $config['smtp_port']    = '25';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'info@clickdayats.it';
        $config['smtp_pass']    = 'YUcd_2016!';
		$config['validate'] = 'FALSE';
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from('info@clickdayats.it', 'ClickDay 2016');
		$this->email->to($email);
		if($role == 'usr'){
			$this->email->subject('Registrazione ClickDay 2016');
			$data = array( 'base_url' => base_url(), 'code' => base_url('users/activate/'.$activation));
			$content = $this->load->view('emails/activation', $data, TRUE);
		}elseif($role=='cm'){
			$this->email->subject('Nuovo Utente Registrato ClickDay 2016');
			$data = array( 'base_url' => base_url(), 'name' => $activation);
			$content = $this->load->view('emails/activation_cm', $data, TRUE);
		}
		$this->email->message($content);
		$this->email->send();
	}

	function sendRecoveryMail($email, $code)
	{
		$this->load->library('email');
		$this->load->helper('url');
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'emcwhosting.hwgsrl.it';
        $config['smtp_port']    = '25';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'info@clickdayats.it';
        $config['smtp_pass']    = 'YUcd_2016!';
		$config['validate'] = 'FALSE';
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from('info@clickdayats.it', 'ClickDay 2016');
		$this->email->to($email);
		$this->email->subject('Recupero Password ClickDay 2016');
		$data = array( 'base_url' => base_url(), 'recovery' => base_url('login/forgot/'.$code));
		$content = $this->load->view('emails/recovery', $data, TRUE);
		$this->email->message($content);
		$this->email->send();
	}

	function sendConfirmActivation($email, $role, $payload)
	{
		$this->load->library('email');
		$this->load->helper('url');
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'emcwhosting.hwgsrl.it';
        $config['smtp_port']    = '25';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'info@clickdayats.it';
        $config['smtp_pass']    = 'YUcd_2016!';
		$config['validate'] = 'FALSE';
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from('info@clickdayats.it', 'ClickDay 2016');
		$this->email->to($email);
		if($role == 'usr'){
			$this->email->subject('Conferma Attivazione ClickDay 2016');
			$data = array( 'base_url' => base_url());
			$content = $this->load->view('emails/confirm_usr', $data, TRUE);
		}elseif($role == 'cm'){
			$this->email->subject('Nuovo Utente Verificato ClickDay 2016');
			$data = array( 'base_url' => base_url(), 'name' => $payload);
			$content = $this->load->view('emails/confirm_cm', $data, TRUE);
		}
		$this->email->message($content);
		$this->email->send();
	}

	function createNewUser($usr)
	{
		$data['code'] = 200;
		$query = $this->db->get_where('users', array('email' => $usr['email']));
		if($query->num_rows() > 0){
			$data['code'] = 409;
			$data['message'] = "L'indirizzo mail inserito è già in uso";
			return $data;
		}
		$clickM = -1;
		if($usr['clickM'] != "-1"){
			$query = $this->db->get_where('clickmasters', array('code' => $usr['clickM']));
			if ($query->num_rows() > 0){
				$clickM = $query->row()->ID;
			}else{
				$data['code'] = 409;
				$data['message'] = "Il codice ClickMaster inserito non è valido";
				return $data;
			}
		}
		$this->load->helper('security');
		$password = do_hash($usr['password']);
		$this->load->helper('string');
		$activation = random_string('alnum', 16);
		$this->load->helper('date');
		$datestring = '%Y-%m-%d %H:%i';
		$time = now('Europe/Rome');
		$now = mdate($datestring, $time);
		$newUser = array('name' => $usr['name'], 'surname' => $usr['surname'], 'email' => $usr['email'], 'phone' => $usr['phone'], 'password' => $password, 'dateBirth' => $usr['dateBirth'], 'country' => $usr['country'], 'address' => $usr['address'], 'cf' => $usr['cf'],'joinDate' => $now, 'prov' => $usr['prov'], 'cap' => $usr['cap'], 'work' => $usr['work'], 'clickM' => $clickM, 'activation' => $activation);
		$this->db->insert('users', (object) $newUser);
		if ($this->db->affected_rows() > 0){
			if($clickM != -1){
				$cmEmail = $this->clickmaster->getCMemail($clickM);
				if($cmEmail != ''){
					$name = $usr['name']. ' ' .$usr['surname'];
					$this->sendActivationMail($cmEmail, 'cm', $name);
				}
			}
			$this->sendActivationMail($usr['email'], 'usr', $activation);
			return $data;
		}else{
			$data['code'] = 500;
			return $data;
		}
	}

	function editUserInfo($usr)
	{
		$data['code'] = 200;
		$this->db->set($usr)->where('ID', $usr['ID'])->update('users');
		return $data;
	}

	function activateUser($code)
	{
		$query = $this->db->get_where('users', array('activation' => $code));
		if ($query->num_rows() > 0){
			$email = $query->row()->email;
			$clickM = $query->row()->clickM;
			$name = $query->row()->name;
			$surname = $query->row()->surname;
			$this->db->set(array('activation'=> NULL, 'approved' => 1))->where('ID', $query->row()->ID)->update('users');
			if ($this->db->affected_rows() > 0){
				if($clickM != -1){
					$cmEmail = $this->clickmaster->getCMemail($clickM);
					if($cmEmail != ''){
						$name = $name. ' ' .$surname;
						$this->sendConfirmActivation($cmEmail, 'cm', $name);
					}
				}
				$this->sendConfirmActivation($email, 'usr', $name);
				return TRUE;
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}

	function setRecovery($email)
	{
		$query = $this->db->get_where('users', array('email' => $email));
		if ($query->num_rows() > 0){
			$this->load->helper('string');
			$code = random_string('alnum', 16);
			$this->db->set('recovery', $code)->where('ID', $query->row()->ID)->update('users');
			if ($this->db->affected_rows() > 0){
				$this->sendRecoveryMail($email, $code);
				return TRUE;
			}else{
				$data['code'] = 500;
				return $data;
			}
		}else{
			$data['code'] = 409;
			$data['message'] = "La mail inserita non risulta essere nei nostri database";
			return $data;
		}
	}

	function checkForgot($code)
	{
		if($code != NULL){
			$query = $this->db->get_where('users', array('recovery' => $code));
			if ($query->num_rows() > 0){
				$ID = $query->row()->ID;
				$this->db->set('recovery', NULL)->where('ID', $ID)->update('users');
				if ($this->db->affected_rows() > 0){
					$data['code'] = 200;
					$data['ID'] = $ID;
					return $data;
				}else{
					$data['code'] = 500;
					return $data;
				}
			}else{
				$data['code'] = 409;
				$data['message'] = "Il codice fornito non è stato trovato o è già scaduto.";
				return $data;
			}
		}else{
			$data['code'] = 409;
			$data['message'] = "Il codice fornito non è stato trovato o è già scaduto.";
			return $data;
		}
	}

	function getName($ID)
	{
		$query = $this->db->get_where('users', array('ID' => $ID));
		if($query->num_rows() > 0){
			return $query->row()->name;
		}else{
			return '';
		}
	}

	function getUserById($ID)
	{
		$query = $this->db->get_where('users', array('ID' => $ID));
		if($query->num_rows() > 0){
			$query->row()->joinDate = date('d/m/Y', strtotime($query->row()->joinDate));
			$query->row()->lastSeen = date('d/m/Y \a\l\l\e h:i', strtotime($query->row()->lastSeen));
			if($query->row()->screen_uploaded){
				$query->row()->screen_file = $this->checkScreen($ID);
			}
			if($query->row()->cont_uploaded){
				$query->row()->contract_file = $this->checkCont($ID);
			}
			return $query->row();
		}else{
			return FALSE;
		}
	}

	function recoveryPass($password, $ID)
	{
		$this->load->helper('security');
		$password = do_hash($password);
		$query = $this->db->get_where('users', array('ID' => $ID));
		if($query->num_rows() > 0){
			if($query->row()->password == $password){
				$data['code'] = 409;
				$data['message'] = "La nuova password non deve essere uguale a quella precedente.";
				return $data;
			}else{
				$this->db->set(array('password' => $password, 'recovery' => NULL))->where('ID', $ID)->update('users');
				if ($this->db->affected_rows() > 0)
				{
					$data['code'] = 200;
					return $data;
				}else{
					$data['code'] = 500;
					return $data;
				}
			}
		}else{
			$data['code'] = 500;
			return $data;
		}
	}

	function screenStat($ID)
	{
		$query = $this->db->get_where('users', array('ID' => $ID));
		if($query->num_rows() > 0){
			return $query->row()->screen_uploaded;
		}else{
			return FALSE;
		}
	}

	function contStat($ID)
	{
		$query = $this->db->get_where('users', array('ID' => $ID));
		if($query->num_rows() > 0){
			return $query->row()->cont_uploaded;
		}else{
			return FALSE;
		}
	}

	function checkScreen($ID)
	{
		$query = $this->db->get_where('screenshots', array('user' => $ID));
		if($query->num_rows() > 0){
			return $query->row()->filename;
		}else{
			return FALSE;
		}
	}

	function checkCont($ID)
	{
		$query = $this->db->get_where('contracts', array('user' => $ID));
		if($query->num_rows() > 0){
			return $query->row()->filename;
		}else{
			return FALSE;
		}
	}

	function uploadCont($ID, $filename)
	{
		$oldFile = $this->checkCont($ID);
		if($oldFile != FALSE){
			$this->load->helper('file');
			$this->load->helper('date');
			$format = '%Y-%m-%d %H:%i:%s';
			$time = time();
			$now = mdate($format, $time);
			if(!unlink($_SERVER['DOCUMENT_ROOT'] .'/assets/uploads/contratti/' . $oldFile)){
				return FALSE;
			}
			$this->db->set(array('filename' => $filename, 'uploaded' => $now, 'approved' => 0))->where('user', $ID)->update('contracts');
			$this->db->set('cont_uploaded', 1)->where('ID', $this->session->userdata('ID'))->update('users');
			return TRUE;
		}else{
			$newUser = array('user' => $ID, 'filename' => $filename);
			$this->db->insert('contracts', (object) $newUser);
			$this->db->set('cont_uploaded', 1)->where('ID', $this->session->userdata('ID'))->update('users');
			if ($this->db->affected_rows() > 0){
				return TRUE;
			}else{
				return FALSE;
			}
		}
	}

	function uploadScreen($ID, $filename)
	{
		$oldFile = $this->checkScreen($ID);
		if($oldFile != FALSE){
			$this->load->helper('file');
			$this->load->helper('date');
			$format = '%Y-%m-%d %H:%i:%s';
			$time = time();
			$now = mdate($format, $time);
			if(!unlink($_SERVER['DOCUMENT_ROOT'] .'/assets/uploads/screenshots/' . $oldFile)){
				return FALSE;
			}
			$this->db->set(array('filename' => $filename, 'uploaded' => $now, 'approved' => 0))->where('user', $ID)->update('screenshots');
			$this->db->set('screen_uploaded', 1)->where('ID', $this->session->userdata('ID'))->update('users');
			return TRUE;
		}else{
			$newUser = array('user' => $ID, 'filename' => $filename);
			$this->db->insert('screenshots', (object) $newUser);
			$this->db->set('screen_uploaded', 1)->where('ID', $this->session->userdata('ID'))->update('users');
			if ($this->db->affected_rows() > 0){
				return TRUE;
			}else{
				return FALSE;
			}
		}
	}

	function removeUsr($ID)
	{	$this->db->delete('screenshots', array('user' => $ID));
		return $this->db->delete('users', array('ID' => $ID));
	}

	function removeUsrCode($ID)
	{
		$this->db->set('region', '')->where('ID', $ID)->update('users');
		return $this->db->set('code', 'NULL', false)->where('ID', $ID)->update('users');
	}

  function setWinnerAgree($ID){
    $this->load->helper('date');
		$datestring = '%Y-%m-%d %H:%i';
		$time = now('Europe/Rome');
		$now = mdate($datestring, $time);
    $query = $this->db->get_where('users', array('ID' => $ID));
    if ($query->num_rows() > 0){
      $date = $query->row()->winnerAgreement;
      if($date == '0000-00-00 00:00:00'){
        return $this->db->set('winnerAgreement', $now)->where('ID', $ID)->update('users');
      }else{
        return FALSE;
      }
    }
  }
}

?>
