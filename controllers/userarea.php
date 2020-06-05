<?php

class userarea extends Controller {

	function __construct() {
		parent::__construct();
        
		Session::init();
		$logged = Session::get('loggedIn');
		if ($logged == false) {
			Session::destroy();
			header('location: ./');
			exit;
		}
        //$this->view->js = array('public/js/landingpageapp.js');
	}

	function index() {
	$message='';
	$this->view->js = array('public/js/controllers/userarea/headerController.js');
    $this->view->render('userarea/landingpage', $noinclude=false, $message);
	}
    
   
 

 
}
