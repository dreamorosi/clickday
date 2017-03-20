<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Clickmaster extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

	function loginClick($email, $password)
	{
		$this->load->helper('security');
		$password = do_hash($password);
		$query = $this->db->get_where('clickmasters', array('email' => $email, 'password' => $password));
		if ($query->num_rows() > 0){
			$newdata = array(
				'email'     => $email,
				'isLogged' => TRUE,
				'name' => $query->row()->name,
				'surname' => $query->row()->surname,
				'ID' => $query->row()->ID,
				'clickM' => $query->row()->code,
				'role' => 'clickMaster',
				'lastSeen' => $query->row()->lastSeen
			);
			$this->session->set_userdata($newdata);
			return TRUE;
		}else{
			return FALSE;
		}
	}

	function sendNotificationMail($email, $pass)
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
		$this->email->subject('Profilo Click Master ClickDay 2016');
		$data = array( 'email' => $email, 'base_url' => base_url(), 'pass' => $pass);
		$content = $this->load->view('emails/notification', $data, TRUE);
		$this->email->message($content);
		$result = $this->email->send();
    return $result;
        // log_message('error', $this->email->print_debugger());
	}

	function createNewCm($usr)
	{
		$data['code'] = 200;
		$query = $this->db->get_where('clickmasters', array('email' => $usr['email']));
		if($query->num_rows() > 0){
			$data['code'] = 409;
			$data['message'] = "L'indirizzo mail inserito è già in uso.";
			return $data;
		}
		$query = $this->db->get_where('clickmasters', array('code' => $usr['code']));
		if ($query->num_rows() > 0){
			$data['code'] = 409;
			$data['message'] = "Il codice inserito è già in uso.";
			return $data;
		}
		$this->load->helper('string');
		$password = random_string('alnum', 8);
		$this->load->helper('security');
		$passwordH = do_hash($password);
		$newCm = array('name' => $usr['name'], 'surname' => $usr['surname'], 'email' => $usr['email'], 'password' => $passwordH, 'code' => $usr['code']);
		$this->db->insert('clickmasters', (object) $newCm);
		$data['ID'] = -1;
		$data['ID'] = $this->db->insert_id();
		// $this->db->insert('codes', array('ID' => $data['ID']));
		if ($this->db->affected_rows() > 0){
			$this->sendNotificationMail($usr['email'], $password);
			return $data;
		}else{
			$data['code'] = 500;
			return $data;
		}
	}

	function editCmInfo($usr, $ID)
	{
		$this->db->set($usr)->where('ID', $ID)->update('clickmasters');
		if ($this->db->affected_rows() > 0){
			return TRUE;
		}else{
			$data['code'] = 500;
			return $data;
		}
	}

	function removeCm($ID)
	{
		$this->db->delete('clickmasters', array('ID' => $ID));
		$this->db->delete('codes', array('ID' => $ID));
		return TRUE;
	}

	function getName($ID)
	{
		$query = $this->db->get_where('clickmasters', array('ID' => $ID));
		if($query->num_rows() > 0){
			return $query->row()->name;
		}else{
			return '';
		}
	}

	function getSurname($ID)
	{
		$query = $this->db->get_where('clickmasters', array('ID' => $ID));
		if($query->num_rows() > 0){
			return $query->row()->surname;
		}else{
			return 0;
		}
	}

	function getCompleteName($ID)
	{
		$query = $this->db->get_where('clickmasters', array('ID' => $ID));
		if($query->num_rows() > 0){
			return substr($query->row()->name,0,1) .'. '. $query->row()->surname;
		}else{
			return 0;
		}
	}

	function getCMemail($ID)
	{
		$query = $this->db->get_where('clickmasters', array('ID' => $ID));
		if($query->num_rows() > 0){
			return $query->row()->email;
		}else{
			return '';
		}
	}

	function getCmById($ID)
	{
		$query = $this->db->get_where('clickmasters', array('ID' => $ID));
		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return '';
		}
	}

	function checkForgot($code)
	{
		if($code != NULL){
			$query = $this->db->get_where('clickmasters', array('recovery' => $code));
			if ($query->num_rows() > 0){
				$ID = $query->row()->ID;
				$this->db->set('recovery', NULL)->where('ID', $ID)->update('clickmasters');
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

	function recoveryPass($password, $ID)
	{
		$this->load->helper('security');
		$password = do_hash($password);
		$query = $this->db->get_where('clickmasters', array('ID' => $ID));
		if($query->num_rows() > 0){
			if($query->row()->password == $password){
				$data['code'] = 409;
				$data['message'] = "La nuova password non deve essere uguale a quella precedente.";
				return $data;
			}else{
				$this->db->set(array('password' => $password, 'recovery' => NULL))->where('ID', $ID)->update('clickmasters');
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

	function setRecovery($email)
	{
		$query = $this->db->get_where('clickmasters', array('email' => $email));
		if ($query->num_rows() > 0){
			$this->load->helper('string');
			$code = random_string('alnum', 16);
			$this->db->set('recovery', $code)->where('ID', $query->row()->ID)->update('clickmasters');
			if ($this->db->affected_rows() > 0){
				$this->user->sendRecoveryMail($email, $code);
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

	function distributeCode($codes, $ID)
	{
		$query = $this->db->order_by('','RANDOM')->get_where('users', array('clickM' => $ID));
		if ($query->num_rows() > 0){
			$res = $query->result();
			$data = [];
			foreach($res as $user){
				$user = get_object_vars($user);
				$user['code_received'] = 0;
				$obj['ID'] = $user['ID'];
				$obj['code_received'] = $user['code_received'];
				$obj['code'] = NULL;
				$data[]=$obj;
			}
			$tot = count($data);
			$relay = $data;
			$data = [];
			foreach($codes as $code){
				$n = $code[1]*$tot/100;
				$c = 0;
				$tmp = [];
				foreach($relay as $user){
					if($c<$n){
						$user['code_received'] = 1;
						$user['code'] = $code[0];
						$data[] = $user;
					}else{
						$tmp[]= $user;
					}
					$c++;
				}
				$relay = $tmp;
			}
			$data = array_merge($data, $relay);
			foreach($data as $user){
				$this->db->set(array('code' => $user['code'], 'code_received' => $user['code_received']))->where('ID', $user['ID'])->update('users');
				if ($this->db->affected_rows() < 0){
					return 500;
				}
			}
			$this->db->set(array('payload' => serialize($codes)))->where('ID', $ID)->update('codes');
			return 200;
		}
	}

	function getCodes($ID)
	{
		$query = $this->db->get_where('codes', array('ID' => $ID));
		if($query->num_rows()>0){
			return unserialize($query->row()->payload);
		}
	}
}

?>
