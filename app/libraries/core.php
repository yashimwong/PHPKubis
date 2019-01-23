<?php
	/*
	* App Core Class
	* Creates URL & Loads Core controller
	* URL Format - /controller/method/parameters
	*/

	class Core {
		protected $currentController = 'Pages';
		protected $currentMethod = 'index';
		protected $params = [];

		public function __construct() {
			// print_r($this->getUrl());
			$url = $this -> getUrl();

			// Look in controllers for first index
			if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
				// If controller exist, set as controller
				$this->currentController = ucwords($url[0]);
				// Unset 0 index
				unset($url[0]);
			}

			// Require the controller
			require_once '../app/controllers/' . $this->currentController . '.php';

			// Instantiate controller class
			$this->currentController = new $this->currentController;

			// Check for second part of URL
			if(isset($url[1])){
				// Check to see if method exist
				if(method_exists($this->currentController, $url[1])){
					$this->currentMethod = $url[1];
					unset($url[1]);
				}
			}
			
			// Get Parameters
			$this->params = $url ? array_values($url) : [];

			// Call a callback with array of parameters
			call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
		}

		public function getUrl() {
			if(isset($_GET['url'])){
				$url = rtrim($_GET['url'],'/');
				$url = filter_var($url, FILTER_SANITIZE_URL);
				$url = explode('/', $url);
				return $url;

			}
		}
	}


?>