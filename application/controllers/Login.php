<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function  __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->data['isLogged'] = $this->session->userdata('isLogged');
		$this->data['email'] = $this->session->userdata('email');
		$this->data['role'] = $this->session->userdata('role');
		if ($this->data['role'] === 'user') {
			$this->data['name'] = $this->session->userdata('name');
			$this->data['surname'] = $this->session->userdata('surname');
		} else {
			$this->data['fullName'] = $this->session->userdata('fullName');
		}
		$this->data['ID'] = $this->session->userdata('ID');
		$this->data['approved'] = $this->session->userdata('approved');
		$this->data['clickM'] = $this->session->userdata('clickM');
		$this->data['lastSeen'] = $this->session->userdata('lastSeen');
	}

	public function signin()
	{
		$email = $this->input->post('email');
		$pass = $this->input->post('password');
		if($this->user->loginUser($email, $pass)){
			die(json_encode(TRUE));
		}else{
			if($this->clickmaster->loginClick($email, $pass)){
				die(json_encode(TRUE));
			}else{
				if($this->admin->loginAdmin($email, $pass)){
					die(json_encode(TRUE));
				}else{
					$this->output->set_status_header('409');
				}
			}
		}
	}

	public function signout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}

	public function forgot($code = NULL)
	{
		$rest = $this->user->checkForgot($code);
		if($rest['code']==200){
			$this->data['code'] = 200;
			$this->data['reset'] = $rest['ID'];
			$this->data['role'] = 'users';
		}else{
			$rest = $this->clickmaster->checkForgot($code);
			if($rest['code']==200){
				$this->data['code'] = 200;
				$this->data['reset'] = $rest['ID'];
				$this->data['role'] = 'clickmasters';
			}else{
				$this->data['reset'] = 0;
				$this->data['role'] = 0;
				$this->data['code'] = $rest['code'];
				$this->data['message'] = $rest['message'];
			}
		}
		$this->load->view('resetPass', $this->data);
	}

	public function setRecoveryCode()
	{
		$email = $this->input->post('email');
		$data = $this->user->setRecovery($email);
		if($data['code']==409){
			$data = $this->clickmaster->setRecovery($email);
			if($data['code']==409){
				$this->output->set_status_header('409');
				echo json_encode($data['message']);
			}elseif($data['code']==500){
				$this->output->set_status_header('500');
				echo json_encode(FALSE);
			}else{
				echo json_encode(TRUE);
			}
		}elseif($data['code']==500){
			$this->output->set_status_header('500');
			echo json_encode(FALSE);
		}else{
			echo json_encode(TRUE);
		}
	}

	public function adminFirst($code)
	{
		if($this->data['isLogged']){
			$this->load->view('dashboard', $this->data);
		}else{
			$admin = $this->admin->checkActivation($code);
			$this->data['success'] = TRUE;
			$this->load->helper('string');
			$this->data['name'] = $admin['name'];
			$this->data['ID'] = $admin['ID'];
			$this->load->view('adminFirstAccess', $this->data);
		}
	}

	function setAdminPassw()
	{
		$ID = $this->input->post('ID');
		$pass = $this->input->post('pass');
		$result = $this->admin->setAdminPass($pass, $ID);
		echo json_encode($result);
	}
}
