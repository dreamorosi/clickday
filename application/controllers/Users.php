<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	function  __construct() {
		parent::__construct();
		$this->data['isLogged'] = $this->session->userdata('isLogged');
		$this->data['email'] = $this->session->userdata('email');
		$this->data['name'] = $this->session->userdata('name');
		$this->data['surname'] = $this->session->userdata('surname');
		$this->data['ID'] = $this->session->userdata('ID');
		$this->data['approved'] = $this->session->userdata('approved');
		$this->data['clickM'] = $this->session->userdata('clickM');
		$this->data['role'] = $this->session->userdata('role');
		$this->data['lastSeen'] = $this->session->userdata('lastSeen');
	}

	public function signup($code = NULL)
	{
		$this->data['code'] = null;
		if(isset($code)){
			$this->data['code'] = $code;
		}
		//$this->data['open_signup'] = $this->dashboard->checkTime();
		$this->load->view('signup', $this->data);
	}

	public function newUser()
	{
		$usr = array(
			'name' => $this->input->post('name'),
			'surname' => $this->input->post('surname'),
			'email' => $this->input->post('emailS'),
			'dateBirth' => $this->input->post('dateBirth'),
			'country' => $this->input->post('country'),
			'address' => $this->input->post('address') . ' ' . $this->input->post('door'),
			'cap' => $this->input->post('cap'),
			'prov' => $this->input->post('prov'),
			'cf' => strtoupper($this->input->post('cf')),
			'work' => $this->input->post('work'),
			'phone' => $this->input->post('phone'),
			'password' => $this->input->post('passwordS'),
			'clickM' => $this->input->post('clickM'),
		);

		$data = $this->user->createNewUser($usr);
		if($data['code']==409){
			$this->output->set_status_header('409');
			echo json_encode($data['message']);
		}elseif($data['code']==500){
			$this->output->set_status_header('500');
			echo json_encode(FALSE);
		}else{
			echo json_encode(TRUE);
		}
	}

	public function editUser()
	{
		$usr = array(
			'ID' => $this->data['ID'],
			'name' => $this->input->post('name'),
			'surname' => $this->input->post('surname'),
			'email' => $this->input->post('emailS'),
			'dateBirth' => $this->input->post('dateBirth'),
			'country' => $this->input->post('country'),
			'address' => $this->input->post('address'),
			'cap' => $this->input->post('cap'),
			'prov' => $this->input->post('prov'),
			'cf' => $this->input->post('cf'),
			'work' => $this->input->post('work'),
			'phone' => $this->input->post('phone')
		);
		$data = $this->user->editUserInfo($usr);
		if($data['code']==409){
			$this->output->set_status_header('409');
			echo json_encode($data['message']);
		}elseif($data['code']==500){
			$this->output->set_status_header('500');
			echo json_encode(FALSE);
		}else{
			echo json_encode(TRUE);
		}
	}

	public function activate($code = NULL)
	{
		if(isset($code)){
			$this->data['success'] = $this->user->activateUser($code);
			$this->load->view('activation', $this->data);
		}else{
			$this->data['success'] = FALSE;
			$this->load->view('activation', $this->data);
		}
	}

	public function setNewPassword()
	{
		$password = $this->input->post('passwordF');
		$ID = $this->input->post('tab');
		$role = $this->input->post('role');
		if($role == 'users'){
			$data = $this->user->recoveryPass($password, $ID);
		}else{
			$data = $this->clickmaster->recoveryPass($password, $ID);
		}
		if($data['code']==409){
			$this->output->set_status_header('409');
			echo json_encode($data['message']);
		}elseif($data['code']==500){
			$this->output->set_status_header('500');
			echo json_encode(FALSE);
		}else{
			echo json_encode(TRUE);
		}
	}

	public function upload(){
		$config['upload_path']	= './assets/uploads/screenshots/';
		$config['allowed_types']= 'gif|jpg|png';
		//$config['encrypt_name']	= TRUE;
		$config['file_name'] = $this->data['ID'] . "_" .$this->data['name'] . "_" . $this->data['surname'];
		$ID = $this->session->userdata('ID');
		$this->load->library('upload', $config);

		$config2['image_library'] = 'gd2';
		$config2['maintain_ratio'] = TRUE;
		$config2['width']	= 298;



		if(!$this->upload->do_upload('userfile')){
			//$this->output->set_status_header('409');
			$data['message'] = $this->upload->display_errors();
			echo json_encode($data);
		}else{
			$filename = $this->upload->data()['file_name'];
			if(!$this->user->uploadScreen($ID, $filename)){
			//	$this->output->set_status_header('500');
				echo json_encode(FALSE);
			}else{
				$config2['source_image']	= $_SERVER['DOCUMENT_ROOT'] .'/assets/uploads/screenshots/' . $filename;
				$config2['new_image']	= $_SERVER['DOCUMENT_ROOT'] .'/assets/uploads/screenshots/thumbs/';
				$this->load->library('image_lib', $config2);
				$this->image_lib->resize();
				echo json_encode($filename);
			}
		}
	}

	public function upload2(){
		$config['upload_path']	= './assets/uploads/contratti/';
		$config['allowed_types']= '*';
		$config['max_size']		= 5000;
		$config['encrypt_name']	= TRUE;
		$ID = $this->session->userdata('ID');
		$this->load->library('upload', $config);


		if(!$this->upload->do_upload('userfile2')){
			//$this->output->set_status_header('409');
			var_dump($this->upload->display_errors('', ''));
			var_dump($_FILES);
			$data['message'] = $this->upload->display_errors();
			echo json_encode($data);
		}else{
			$filename = $this->upload->data()['file_name'];
			if(!$this->user->uploadCont($ID, $filename)){
				$data['message'] = $this->upload->display_errors();
			//	$this->output->set_status_header('500');
				echo json_encode($data);
			}else{
				echo json_encode($filename);
			}
		}
	}

}
