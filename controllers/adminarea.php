<?php

class adminarea extends Controller {

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
	$this->view->js = array('public/js/controllers/adminarea/headerController.js');
    $this->view->render('adminarea/landingpage', $noinclude=false, $message);
	}
    
   
 

 
}
