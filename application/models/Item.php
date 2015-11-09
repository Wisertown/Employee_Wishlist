<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item extends CI_Model {

	public function get_user_info()
	{
		$query = "SELECT name FROM users WHERE id = ?";
		$values = $this->session->userdata('id');
		$user = $this->db->query($query, $values)->row_array();
		return $this->db->query($query, $values)->row_array();
	}
	public function create($post)
	{
		$this->form_validation->set_rules("item", "item/stuff", "trim|required|is_unique[stuff.item]|min_length[3]");
		if($this->form_validation->run() === FALSE){
			$this->session->set_flashdata("errors", validation_errors());
			return FALSE;
		} else {
			$query2 = "INSERT INTO stuff(item, added_by, created_by, created_at, updated_at) values(?, ?, ?, NOW(), NOW())";
			$values = array($post['item'], $this->session->userdata('id'), $this->session->userdata('id'));
			$this->db->query($query2, $values);
			return TRUE;

			// $query = "INSERT INTO wishlist(user_id, stuff_id, count, created_at, updated_at) values(?, last_insert_id(), ?, NOW(), NOW())";
			// $values = array($this->session->userdata('id'), 1);
			// $this->db->query($query, $values);

		}
	}
	public function get_my_stuff()
	{
		$query = "SELECT users.name, stuff.id, stuff.item, stuff.added_by, stuff.created_by, stuff.created_at from users join stuff on users.id = created_by where stuff.added_by = ?"; 
		$values = $this->session->userdata('id');
		return $this->db->query($query, $values)->result_array();
	}
	public function get_others_stuff()
	{
		$query = "SELECT users.name, stuff.id, stuff.item, stuff.added_by, stuff.created_by, stuff.created_at from users join stuff on users.id = created_by where stuff.added_by != ?"; 
		$values = $this->session->userdata('id');
		return $this->db->query($query, $values)->result_array();
	}
	public function add_to_wishlist($post)
	{
		$query = "INSERT INTO wishlist(user_id, stuff_id, item, created_at, updated_at) SELECT ?, stuff.id, item, NOW(), NOW() FROM stuff where stuff.id = ?";
		$values = array($this->session->userdata('id'), $post['item_id']);
		return $this->db->query($query, $values);
	}
	public function get_item_names()
	{
		$query = "SELECT users.name, stuff.item from users join stuff on users.id = stuff.added_by where stuff.item = ?";

	}
}
?>