<?php
class Logout extends Controller {

function logout(){
		Session::init();
		Session::destroy();
		die(header('location:'.URL));
		exit;
	}

}