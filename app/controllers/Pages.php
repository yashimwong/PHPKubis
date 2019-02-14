<?php
	
	class Pages extends Controller {
		public function __construct(){

		}

		public function index(){
			$data = [
			'title' => 'Welcome',
			'description' => 'This is the PHPKubis Framework. Please refer to the documentations on how to use it.'
		];
			$this->view('pages/index', $data);
		}

		public function about(){
			$data = [
				'title' => 'About Us',
				'description' => 'This site is powered by PHPKubis.'
			];
			$this->view('pages/about', $data);
		}
	}

?>