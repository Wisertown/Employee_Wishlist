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
			$query2 = "INSERT INTO stuff(item, created_by, created_at, updated_at) values(?, ?, NOW(), NOW())";
			$values = array($post['item'], $this->session->userdata('id'));
			$this->db->query($query2, $values);

			$query = "INSERT INTO wishlist(user_id, stuff_id, item, added_by, created_at, updated_at) values(?, last_insert_id(), ?, ?, NOW(), NOW())";
			$values = array($this->session->userdata('id'), $post['item'], $this->session->userdata('id'));
			$this->db->query($query, $values);
			return TRUE;
		}
	}
	public function get_my_stuff()
	{
		$query = "SELECT users.id, users.name, wishlist.item, wishlist.added_by, wishlist.created_at, wishlist.stuff_id as it_id, wishlist.user_id from users join wishlist on users.id = wishlist.user_id where added_by = ?"; 
		$values = $this->session->userdata('id');
		return $this->db->query($query, $values)->result_array();
	}
	public function get_others_stuff()
	{
		$query = "SELECT users.id, users.name, wishlist.item, wishlist.added_by, wishlist.created_at, wishlist.stuff_id as it_id, wishlist.user_id from users join wishlist on users.id = wishlist.user_id where added_by != ?"; 
		$values = $this->session->userdata('id');
		return $this->db->query($query, $values)->result_array();
	}
	public function add_to_wishlist($post)
	{
		$query = "INSERT INTO wishlist(user_id, stuff_id, item, added_by, created_at, updated_at) SELECT stuff.created_by, stuff.id, stuff.item, ?, NOW(), NOW() FROM stuff where stuff.id = ?";
		$values = array($this->session->userdata('id'), $post['it_id']);
		return $this->db->query($query, $values);
	}
	public function get_item_names($id)
	{
		$query = "SELECT users.name, users.id, wishlist.item, wishlist.added_by, wishlist.user_id, wishlist.stuff_id from users join wishlist on users.id = wishlist.added_by where stuff_id = ?";
		$values = array($id);
		return $this->db->query($query, $values)->result_array();
	}
	public function remove($post){
		$query = "DELETE from wishlist where stuff_id = ? and added_by = ?";
		$values = array($post['it_id'], $this->session->userdata('id'));
		return $this->db->query($query, $values);
	}
}
?>