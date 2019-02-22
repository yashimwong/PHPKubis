<?php

	class User {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

		// Register User
		public function register($data) {
			$new_user_query = 'INSERT INTO users (username, email, password) VALUES(:username, :email, :password)';
			$this->db->query($new_user_query);
			// Bind Values
			$this->db->bind(':username', $data['username']);
			$this->db->bind(':email', $data['email']);
			$this->db->bind(':password', $data['password']);

			if($this->db->execute()){
				return true;
			} else {
				return false;
			}
		}

		// Login User
		public function login($email, $password) {
			$login_query ='SELECT * FROM users WHERE email = :email';
			$this->db->query($login_query);
			$this->db->bind(':email', $email);

			$row = $this->db->single();

			$hashed_password = $row->password;
			if(password_verify($password, $hashed_password)){
				return $row;
			} else {
				return false;
			}
		}

		// Find user by email
		public function findUserByEmail($email) {
			$find_email_query = 'SELECT * FROM users WHERE email = :email';
			$this->db->query($find_email_query);
			$this->db->bind(':email', $email);
			$row = $this->db->single();

			if($this->db->rowCount() > 0){
				return true;
			} else {
				return false;
			}

		}

		public function getUserById($id) {
			$find_id_query = 'SELECT * FROM users WHERE id = :id';
			$this->db->query($find_id_query);
			$this->db->bind(':id', $id);
			$row = $this->db->single();

			return $row;

		}

	}



?>