<?php
header('Access-Control-Allow-Origin: *');
class api extends Controller {

	function __construct() {
		parent::__construct();
		/*
		Session::init();
		$this->logged = Session::get('loggedIn');
		$this->loggedType= Session::get('loggedType');;
		$this->view->session_details=Session::get('details');
		*/

	}

	function delete_group(){
     include("./models/admin_model.php");
	 $admin = new admin_Model;
	 $this->model=$admin->delete_group($json=true);   
    }
    
    
	function user_login(){
	include("./models/login_model.php");
	 $login = new login_Model;
	 $this->model=$login->user_login($_POST['username'],md5($_POST['password']),$json=true);	
	}
	
    function save_sms_messages(){
     include("./models/admin_model.php");
	 $admin = new admin_Model;
	 $this->model=$admin->save_sms_messages($json=true);   
    }
    
    function fetch_edu_role(){
     include("./models/admin_model.php");
	 $admin = new admin_Model;
	 $this->model=$admin->fetch_edu_role($json=true);   
    }
    
    
     function forgot_password(){
     include("./models/login_model.php");
	 $login = new login_Model;
	 $this->model=$login->forgot_password($json=true);   
    }
    
    function forgot_password_confirm(){
     include("./models/login_model.php");
	 $login = new login_Model;
	 $this->model=$login->forgot_password_confirm($json=true);   
    }
    

    function activate_or_deactivate_user(){
     include("./models/admin_model.php");
	 $admin = new admin_Model;
	 $this->model=$admin->activate_or_deactivate_user($json=true);       
    }
    
    function get_sms_messages(){
     include("./models/admin_model.php");
	 $admin = new admin_Model;
	 $this->model=$admin->get_sms_messages($json=true);   
    }
    
    
	function get_users(){
	include("./models/admin_model.php");
	 $admin = new admin_Model;
	 $this->model=$admin->get_users($json=true);	
	}

	function get_session_details(){
	include("./models/admin_model.php");
	$admin = new admin_Model;
	$this->model=$admin->get_session_details($json=true);	
	}

	function get_group_users(){
	$json=file_get_contents('php://input');
    $obj=json_decode($json,true); 	
	include("./models/admin_model.php");
	 $admin = new admin_Model;
	 $this->model=$admin->get_group_users($obj['group_id'],$json=true);
	}

	function get_groups(){
	include("./models/admin_model.php");
	 $admin = new admin_Model;
	 $this->model=$admin->get_groups($json=true);	
	}

	function admin_login(){
	include("./models/login_model.php");
	 $login = new login_Model;
	 $this->model=$login->admin_login($_POST['username'],md5($_POST['password']),$json=true);	
	}

	function user_login_from_react_native(){
	$json=file_get_contents('php://input');
	$obj=json_decode($json,true);	
	include("./models/login_model.php");
	$login = new login_Model;
	 $this->model=$login->user_login($obj['username'],md5($obj['password']),$json=true);	
	}

	function user_signup(){
	include("./models/login_model.php");
	 $login = new login_Model;
	 $this->model=$login->user_signup($json=true);	
	}

	function user_signup_from_react_native(){
	include("./models/login_model.php");
	 $login = new login_Model;
	 $this->model=$login->user_signup_from_react_native($json=true);	
	}

	function user_confirm_signup(){
	include("./models/login_model.php");
	 $login = new login_Model;
	 $this->model=$login->user_confirm_signup($json=true);	
	}

	function user_confirm_signup_from_react_native(){
	include("./models/login_model.php");
	 $login = new login_Model;
	 $this->model=$login->user_confirm_signup_from_react_native($json=true);	
	}

	function user_update_details_from_react_native(){
	include("./models/admin_model.php");
	 $admin = new admin_Model;
	 $this->model=$admin->user_update_details_from_react_native($json=true);
	}
    
    function user_update_profile_image(){
	include("./models/admin_model.php");
	 $admin = new admin_Model;
	 $this->model=$admin->user_update_profile_image($json=true);
	}
    

	function add_user_to_group_from_react_native(){
	$json=file_get_contents('php://input');
    $obj=json_decode($json,true);	

	include("./models/admin_model.php");
	 $admin = new admin_Model;
	 $this->model=$admin->add_user_to_group_from_react_native($obj['user_id'],$obj['group_id'],$json=true);
	}

	function create_group_from_react_native(){
	include("./models/admin_model.php");
	 $admin = new admin_Model;
	 $this->model=$admin->create_group_from_react_native($json=true);	
	}
	/*
	function upload_image(){
	include("./models/admin_model.php");
	 $admin = new admin_Model;
	 $this->model=$admin->upload_image($json=true);		
	}
    */
    function upload_image_file(){
	include("./models/admin_model.php");
	 $admin = new admin_Model;
	 $this->model=$admin->upload_image_file($json=true);		
	}

	function upload_chat_file(){
	include("./models/admin_model.php");
	 $admin = new admin_Model;
	 $this->model=$admin->upload_chat_file($json=true);		
	}

	function count_related_tables(){
		include("./models/admin_model.php");
		$admin = new admin_Model;
		$this->model=$admin->count_related_tables($json=true);		
	}
}

