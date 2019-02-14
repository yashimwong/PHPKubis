<?php

	class Users extends Controller{
		public function __construct(){

		}

		public function register(){
			// Check for POST
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				// Process form

			} else {
				// Init Data
				$data = [
					'name' 					=> '',
					'email'					=> '',
					'password'				=> '',
					'confirm_password' 		=> '',
					'name_error'			=> '',
					'email_error'			=> '',
					'password_error'		=> '',
					'confirm_password_error' => ''
				];

				// Load View
				$this->view('users/register', $data);
			}
		}

		public function login(){
			// Check for POST
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				// Process form

			} else {
				// Init Data
				$data = [
					'email'					=> '',
					'password'				=> '',
					'email_error'			=> '',
					'password_error'		=> '',
				];

				// Load View
				$this->view('users/login', $data);
			}
		}
	}



?>