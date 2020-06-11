<?php

class userlogin extends Controller {

	function __construct() {
		parent::__construct();
        
	}

	function index() {
    $this->view->js = array('public/js/controllers/loginController.js');
    $message='';
    $this->view->render('index/login', $noinclude=true, $message);
	}
    
   
 

 
}
