<?php

	class Users extends Controller{
		public function __construct(){
			$this->userModel = $this->model('User');

		}

		public function register(){
			// Check for POST
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				// Process form

				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				// Init Data
				$data = [
					'username' 					=> trim($_POST['username']),
					'email'						=> trim($_POST['email']),
					'password'					=> trim($_POST['password']),
					'confirm_password' 			=> trim($_POST['confirm_password']),
					'username_error'			=> '',
					'email_error'				=> '',
					'password_error'			=> '',
					'confirm_password_error' 	=> ''
				];

				// Validate Email
				if(empty($data['email'])){
					$data['email_error'] = 'Email address cannot be empty.';
				}

				// Validate Name
				if(empty($data['username'])){
					$data['username_error'] = 'Name field must not be empty.';
				}

				// Validate Password
				if(empty($data['password'])){
					$data['password_error'] = 'Password field must not be empty.';
				} else if(strlen($data['password']) < 6 ){
					$data['password_error'] = 'Password must be at least 6 characters or longer.';
				}

				// Validate Confirm Password
				if(empty($data['password'])){
					$data['confirm_password_error'] = 'Password field must not be empty.';
				} else {
					if($data['password'] != $data['confirm_password']){
						$data['confirm_password_error'] = 'Confirm Password does not match.';
					}
				}

				// Check if all errors are empty
				if(empty($data['email_error']) && empty($data['username_error']) && empty($data['password_error']) && empty($data['confirm_password_error'])){
					// All inputs are validated
					die('Success');
				

				} else {
					// Load View with Errors
					$this->view('users/register', $data);
				}


			} else {
				// Init Data to empty values
				$data = [
					'username' 					=> '',
					'email'						=> '',
					'password'					=> '',
					'confirm_password' 			=> '',
					'username_error'			=> '',
					'email_error'				=> '',
					'password_error'			=> '',
					'confirm_password_error' 	=> ''
				];

				// Load View
				$this->view('users/register', $data);
			}
		}

		public function login(){
			// Check for POST
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				// Process form
				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				// Init Data
				$data = [
					'email'						=> trim($_POST['email']),
					'password'					=> trim($_POST['password']),
					'email_error'				=> '',
					'password_error'			=> '',
				];

				// Validate Email
				if(empty($data['email'])){
					$data['email_error'] = 'Email address cannot be empty.';
				}

				// Validate Email
				if(empty($data['password'])){
					$data['password_error'] = 'Password field cannot be empty.';
				}

				// Make Sure error is empty
				if(empty($data['email_error']) && empty($data['password_error'])){
					// All inputs are validated
					die('Success');
				

				} else {
					// Load View with Errors
					$this->view('users/login', $data);
				}


			} else {
				// Init Data
				$data = [
					'email'						=> '',
					'password'					=> '',
					'email_error'				=> '',
					'password_error'			=> '',
				];

				// Load View
				$this->view('users/login', $data);
			}
		}
	}



?>