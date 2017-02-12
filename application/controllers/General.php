<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends CI_Controller {
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
	
	
	public function index()
	{
		if(!$this->data['isLogged']){
			$this->load->view('login', $this->data);
		}
	}
	
	public function terms()
	{
		$this->load->view('terms', $this->data);
	}
	
	public function page_missing()
	{
		$this->load->view('error_404', $this->data);
	}
}
?>