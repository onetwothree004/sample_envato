<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Model {

	function getPosts ( $num=100, $start=0 ) {
		// $sql = "SELECT * FROM users WHERE active=1 ORDER BY created_at DESC LIMIT 0,20";
		// $this->db->select()
		// 		->from('posts')
		// 		->where('active', 1)
		// 		->order_by('created_at', 'desc')
		// 		->limit($num, $start);
		// $query = $this->db->get();

		// $this->db->select();
		// $this->db->from('posts');
		// $this->db->where('active', 1);
		// $this->db->order_by('created_at', 'desc');
		// $this->db->limit($num, $start);
		// $this->db->jion('users', 'users.id = posts.user_id', 'left');

		// $query = $this->db->get();

		$this->db->order_by('created_at', 'desc');
		$query = $this->db->get_where('posts', array('active' => 1), $num, $start);
		return $query->result_array();
	}

	function getPostsCount () {
		$this->db->select('id')->from('posts')->where('active', 1);
		$query	=	$this->db->get();
		return $query->num_rows();
	}

	function getPost ( $post_id ) {
		$this->db->select()->from('posts')->where( array( 'active'	=>	1, 'id'	=>	$post_id ) )->order_by('created_at', 'desc');
		$query	=	$this->db->get();
		return $query->first_row('array');
	}

	function insertPost ( $data ) {
		$this->db->insert('posts', $data);
		return $this->db->insert_id();
	}

	function updatePost ( $post_id, $update_post ) {
		$this->db->where('id', $post_id);
		return $this->db->update('posts', $update_post);
	}

	function deletePost ( $post_id ) {
		$this->db->where('id', $post_id);
		return $this->db->delete('posts');
	}

	// function insertPost ( $data ) {
	// 	$data = array(
	// 		'title'	=>	'post title test',
	// 		'body'	=>	'post body test'
	// 	);

	// 	$this->db->insert('posts', $data);
	// 	return $this->db->insert_id();
	// }

	// function updatePost ( $post_id, $data ) {
	// 	$this->db->where('id', $post_id);
	// 	$this->db->update('posts', $data);
	// }

	// function deletePost ( $post_id, $data ) {
	// 	$this->db->where('id', $post_id);
	// 	$this->db->delete('posts', $data);
	// }
}
