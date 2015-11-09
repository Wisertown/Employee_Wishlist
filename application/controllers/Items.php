<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends CI_Controller {

	public function show()
	{
		$others_list = $this->Item->get_others_stuff();
		$my_list = $this->Item->get_my_stuff();
		$user = $this->Item->get_user_info();
		$this->load->view('/dashboard', array("user"=>$user, "my_list"=>$my_list, "others_list"=>$others_list));
	}

	public function show2()
	{
		$this->load->view('/add_wish_item');
	}

	public function create(){
	if($this->Item->create($this->input->post())){
			redirect('/dashboard');
		} else {
			redirect('/add_item_view');
		}
	}
	public function logout_user() {
		$this->session->sess_destroy();
		redirect('/');
	}
	public function add_to_wishlist()
	{
		$this->Item->add_to_wishlist($this->input->post());
		redirect('/dashboard');
	}
	public function item_view($id){
		$wishers = $this->Item->get_item_names($id);
		$this->load->view('/item_view', array("wishers"=>$wishers));
	}
	public function remove()
	{
		$this->Item->remove($this->input->post());
		return redirect('/dashboard');
	}
	
}