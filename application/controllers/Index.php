<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
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

	public function index($code = NULL)
	{
		$this->data['code'] = null;
		if(isset($code)){
			$this->data['code'] = $code;
			$this->load->view('signup', $this->data);
		}
		else
			$this->load->view('index', $this->data);
	}

	public function experience()
	{
		$this->load->view('experience', $this->data);
	}

	public function chisiamo()
	{
		$this->load->view('chisiamo', $this->data);
	}

	public function bando()
	{
		$this->load->view('bando', $this->data);
	}

	public function signup()
	{
		$data['now'] = date('Y-m-d');
		$this->load->view('signup', $this->data);
	}

	public function faq()
	{
		$this->load->view('faq', $this->data);
	}

	public function soloclick()
	{
		$this->load->view('soloclick/index', $this->data);
	}

	public function denied()
	{
		$this->load->view('error_401');
	}
}
