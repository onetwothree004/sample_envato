<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PostController extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
	function __construct () {
		parent::__construct();
		$this->load->model('post');
	}

	function index ( $start = 0 ) {
		$data['posts'] = $this->post->getPosts(5, $start);
		//echo "<pre>"; print_r($data['posts']); echo "</pre>";
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'PostController/index/';
		$config['total_rows'] = $this->post->getPostsCount();
		$config['per_page'] = 5;
		
		$this->pagination->initialize($config);
		
		$data['pages']	=	$this->pagination->create_links();
		$this->load->view('_post/index', $data);
	}

	function create () {
		if ( $_POST ) {
			$data	=	array(
				'title'		=>	$_POST['post_title'],
				'body'		=>	$_POST['post_body'],
				'active'	=>	1
				//'created_at'	=>	
			);
			$this->post->insertPost($data);
			redirect(base_url().'PostController');
		} else {
			$this->load->view('_post/create');
		}
	}

	function show ( $post_id ) {
		$data['post']	=	$this->post->getPost($post_id);
		$this->load->view('_post/show', $data);
	}

	function edit ( $post_id ) {
		$data['success']	=	0;
		if ( $_POST ) {
			$update_post	=	array(
				'title'		=>	$_POST['post_title'],
				'body'		=>	$_POST['post_body'],
				'active'	=>	1	
			);
			$this->post->updatePost($post_id, $update_post);
			$data['success']	=	1;
		}
		$data['post']	=	$this->post->getPost($post_id);
		$this->load->view('_post/edit', $data);
	}

	function destroy ( $post_id ) {
		$this->post->deletePost($post_id);
		redirect(base_url().'PostController');
	}

}
