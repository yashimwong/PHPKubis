<?php
	class Post {
		private $db;

		public function __construct(){
			$this->db = new Database;
		}

		public function getPosts(){
			$sql = 'SELECT * FROM posts';
			$this->db->query($sql);
			return $results = $this->db->resultSet();
		}
	}



?>