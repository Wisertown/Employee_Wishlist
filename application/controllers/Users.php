<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function index()
	{
		$this->load->view('/index');
	}
	public function register()
	{
		$this->User->register($this->input->post());
		redirect('/');
	}
	public function login()
	{
		if($this->User->login($this->input->post())){
			redirect('/dashboard');
		} else {
			redirect('/');
		}
	}

}
?>