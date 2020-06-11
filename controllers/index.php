<?php

class Index extends Controller {

	function __construct() {
        parent::__construct();
        
		Session::init();
		$logged = Session::get('loggedIn');
        if ($logged == true) {
            header('location:'.URL.'userarea/');
			//Session::destroy();
			//header('location: ./login');
			exit;
        }
        
        
        //$this->view->js = array('public/js/landingpageapp.js');
	}
    function index() {
        $message='';
        $this->view->js = array('public/js/controllers/registerController.js');
        $this->view->render('index/register', $noinclude=true, $message);
    }
    
}
