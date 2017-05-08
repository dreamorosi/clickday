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
		$this->data['code'] = $code;
		$this->load->view('signup', $this->data);
	}

	public function newUser()
	{
		$usr = array(
			'name' => ucfirst($this->input->post('name')),
			'surname' => ucfirst($this->input->post('surname')),
			'email' => $this->input->post('email'),
			'dateBirth' => $this->input->post('bday-day') .'/'. $this->input->post('bday-month') .'/'. $this->input->post('bday-year'),
			'country' => ucfirst($this->input->post('country')),
			'address' => $this->input->post('address') . ' ' . $this->input->post('door'),
			'cap' => $this->input->post('cap'),
			'prov' => strtoupper($this->input->post('prov')),
			'cf' => strtoupper($this->input->post('cf')),
			'work' => ucfirst($this->input->post('work')),
			'phone' => $this->input->post('phone'),
			'password' => $this->input->post('password'),
			'clickM' => $this->input->post('code'),
      'clickM_code' => $this->input->post('code'),
		);

		if ($usr['clickM'] === '') {
			$usr['clickM'] = -1;
		} else {
			$usr['clickM'] = intval($this->clickmaster->checkCMCode($usr['clickM']));
		}

		$data = $this->user->createNewUser($usr);
		echo json_encode($data);
	}

	public function test()
	{
		$r = $this->user->dispatchMail();
		echo json_encode($r);
	}

	public function editUser($ID)
	{
		$usr = array(
			'ID' => $this->data['ID'],
			'name' => ucfirst($this->input->post('name')),
 			'surname' => ucfirst($this->input->post('surname')),
 			'email' => $this->input->post('email'),
 			'dateBirth' => $this->input->post('bday-day') .'/'. $this->input->post('bday-month') .'/'. $this->input->post('bday-year'),
			'country' => $this->input->post('country'),
			'address' => $this->input->post('address'),
			'cap' => $this->input->post('cap'),
			'prov' => strtoupper($this->input->post('prov')),
			'cf' =>strtoupper( $this->input->post('cf')),
			'work' => ucfirst($this->input->post('work')),
			'phone' => $this->input->post('phone')
		);
		$data = array();
 		if ($this->data['ID'] === $ID) {
			$data['success'] = $this->user->editUserInfo($ID, $usr);
		} else {
			$data['success'] = FALSE;
		}
		echo json_encode($data);
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

		$imageLib['image_library'] = 'gd2';
		$imageLib['maintain_ratio'] = TRUE;
		$imageLib['width']	= 298;



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
				$imageLib['source_image']	= $_SERVER['DOCUMENT_ROOT'] .'/assets/uploads/screenshots/' . $filename;
				$imageLib['new_image']	= $_SERVER['DOCUMENT_ROOT'] .'/assets/uploads/screenshots/thumbs/';
				$this->load->library('image_lib');
				$this->image_lib->initialize($imageLib);
				$this->image_lib->resize();
				$this->image_lib->clear();
				echo json_encode($filename);
			}
		}
	}

	public function upload2(){
		$config['upload_path']	= './assets/uploads/contratti/';
		$config['allowed_types']= 'pdf|jpg|png|doc|docx';
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
