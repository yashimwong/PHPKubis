<?php

	class Posts extends Controller {

		public function __construct() {
			if(!isLoggedIn()){
				redirect('users/login');
			}

			$this->postModel = $this->model('Post');
			$this->userModel = $this->model('User');
		}

		public function index() {
			// Get posts
			$posts = $this->postModel->getPosts();

			$data = [
				'posts' => $posts
			];

			$this->view('posts/index', $data);
		}


		public function add() {
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				// Sanitize POST array
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				$data = [
					'title' => trim($_POST['title']),
					'body' => trim($_POST['body']),
					'user_id' => $_SESSION['user_id'],
					'title_error' => '',
					'body_error' => ''
				];

				// Validate Title
				if(empty($data['title'])){
					$data['title_error'] = 'Please enter title.';
				}

				if(empty($data['body'])){
					$data['body_error'] = 'Please enter body text.';
				}

				// Ensure that there are no errors
				if(empty($data['title_error']) && empty($data['body_error'])){

					if($this->postModel->addPost($data)){
						notify('post_message','Posts successfully submitted.');
						redirect('posts');
					} else {
						die('Something went wrong');
					}

				} else {
					// Load view with errors
					$this->view('posts/add', $data);
				}


			} else {

				$data = [
					'title' => '',
					'body' => ''
				];

				$this->view('posts/add',$data);

			}
		}

		public function show($id) {
			$post = $this->postModel->getPostById($id);
			$user = $this->userModel->getUserById($post->user_id);

			$data = [
				'post' => $post,
				'user' => $user
			];

			$this->view('posts/show', $data);
		}


		public function edit($id) {
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				// Sanitize POST array
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				$data = [
					'id' => $id,
					'title' => trim($_POST['title']),
					'body' => trim($_POST['body']),
					'user_id' => $_SESSION['user_id'],
					'title_error' => '',
					'body_error' => ''
				];

				// Validate Title
				if(empty($data['title'])){
					$data['title_error'] = 'Please enter title.';
				}

				if(empty($data['body'])){
					$data['body_error'] = 'Please enter body text.';
				}

				// Ensure that there are no errors
				if(empty($data['title_error']) && empty($data['body_error'])){

					if($this->postModel->updatePost($data)){
						notify('post_updated','Posts successfully submitted.');
						redirect('posts');
					} else {
						die('Something went wrong');
					}

				} else {
					// Load view with errors
					$this->view('posts/edit', $data);
				}


			} else {
				// Get existing post from model
				$post = $this->postModel->getPostById($id);

				// Check for owner
				if($post->user_id != $_SESSION['user_id']){
					redirect('posts');
				}

				$data = [
					'id' => $id,
					'title' => $post->title,
					'body' => $post->body
				];

				$this->view('posts/edit',$data);

			}
		}


		public function delete($id) {
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				
				// Check for owner
				if($post->user_id != $_SESSION['user_id']){
					redirect('posts');
				}

				if($this->postModel->deletePost($id)){
					notify('post_message', 'Post Removed');
					redirect('posts');
				} else {
					die('Something went wrong');
				}
			} else {
				redirect('posts');
			}
		}


	}


?>