<?php

class Bootstrap {

	function __construct() {
		$url = isset($_GET['url']) ? $_GET['url'] : null;
		$url = rtrim($url, '/');
		$url = explode('/', $url);

		//print_r($url);

		if (empty($url[0])) {
			
			require 'controllers/index.php';
			$controller = new Index();
			$controller->loadModel('index');
			$controller->index();
			
			return false;
		}
		
      
		$file = 'controllers/' . $url[0] . '.php';
		if (file_exists($file)) {
			require $file;
		}

		else {

			$this->error();
			return;
		}
		
		$controller = new $url[0];
		
		$controller->loadModel($url[0]);
		
		//echo $url[0];
		// calling methods
		
		if (isset($url[2])) {

			if (method_exists($controller, $url[1])) {
				$controller->{$url[1]}($url[2]);
			}elseif(($url[0]=='category')){
				$controller->book_details();
				} else {
				$this->error();
			}
		} else {

			if (isset($url[1])) {
				if (method_exists($controller, $url[1])) {
					$controller->{$url[1]}();
				}elseif($url[0]=="category"){
					$controller->index();
				} else {
					$this->error();
				}
			} else {

				$controller->index();
			}
		}


	}

	function error() {
		//echo "INVALID LINK!";
		
		require 'controllers/_404.php';
		$controller = new _404();
		$controller->index();
		
		return false;
	}

}
