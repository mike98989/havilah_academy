<?php

class confirm_registration extends Controller {

	function __construct() {
		parent::__construct();
        
	}

	function index() {
    $parameters['id'] = $_GET['id'];
    $parameters['email'] = $_GET['key'];
    $this->loadModel("login");
    $message=$this->model->user_confirm_signup(false, $parameters['id'],$parameters['email']);
    $this->view->js = array('public/js/controllers/registerController.js');
    $this->view->render('index/confirm_signup', $noinclude=true, $message);
	}
    
   
 

 
}
