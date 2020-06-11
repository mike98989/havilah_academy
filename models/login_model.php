<?php
header('Access-Control-Allow-Origin: *');
class login_Model extends Model
{
	public function __construct()
	{
		parent::__construct();

	}

	public function user_login($email,$password,$json)
	{
		$email = $this->db->escape($email);
		$password = $this->db->escape($password);
		$sth = $this->db->query("SELECT * FROM users WHERE email ='$email' AND password='$password'")or die(mysql_error());
		$count =  $sth->num_rows;
		if ($count > 0) {
			if($sth->row['status']=='0'){
				$message['status']="1";
				$message['message'] = "Your account is not yet active. Please click on the validation link sent to your email or contact administrator!";
			}
            else if($sth->row['activated']=='0'){
				$message['status']="1";
				$message['message'] = "Your account is ready but not active. Please contact administrator via our official email handle admin@havilahacademy.com.ng";
			}else{
			/////UPDATE TOKEN AND LAST LOGIN
			$token = bin2hex(openssl_random_pseudo_bytes(64));
			//$today = date('Y-m-d H:i:s A');
			$date = new DateTime();
			$date->setTimezone(new DateTimeZone('GMT+1'));
			$date->format('Y-m-d H:i:s');
			$date=json_encode($date,true);
			$date = json_decode($date,true);
			//$date = new DateTime($today, new DateTimeZone('GMT'));
			//print_r($date['date']);
			//$date->setTimezone(new DateTimeZone('GMT+1'));
    		$update= $this->db->query("UPDATE users SET token='".$token."', last_login='".date($date['date'])."' WHERE id='".$sth->rows[0]['id']."'")or die(mysql_error());	
			// login
			$message['status']="2";	
			$message['data'] = $sth->row;
			$message['message'] = "Sucess";
			$message['token']=$token;  
			if((isset($_POST['source']))&&($_POST['source']=='browser')){	
			Session::init();
			Session::set('loggedIn', true);
			Session::set('loggedType', 'user');
			Session::set('token', $token);
			Session::set('data', $sth->row); 
			//header('Location:'.URL.'adminarea');
			}

			
		}

		} else {
			$message['status']="0";
			$message['message'] = "Ooopss. Wrong Username or Password! Please try again";

		}

		if($json==true){	
		$return = $this->returnjson($message);
		print_r($return);
		exit;
		}
	}


	public function admin_login($email,$password,$json)
	{

		$email = $this->db->escape($email);
		$password = $this->db->escape($password);
		$sth = $this->db->query("SELECT * FROM admin WHERE admin_email ='$email' AND admin_pass='$password'")or die(mysql_error());
		$count =  $sth->num_rows;
		if ($count > 0) {
			if($sth->row['admin_status']=='0'){
				$message['status']="1";
				$message['message'] = "Your account is not yet active. Please contact administrator!";
			}else{
			/////UPDATE TOKEN AND LAST LOGIN
			//$token = bin2hex(openssl_random_pseudo_bytes(64));
			$date = date('Y-m-d H:i:s A');
    		$update= $this->db->query("UPDATE users SET last_login='".date($date)."' WHERE ID='".$sth->rows[0]['ID']."'")or die(mysql_error());	
			// login
			$message['status']="2";	
			$message['data'] = $sth->rows;
			$message['message'] = "Sucess";
			
			Session::init();
			Session::set('loggedIn', true);
			Session::set('loggedType', 'admin');
			Session::set('details', $message['data']); 
			
		}

		} else {
			$message['status']="0";
			$message['message'] = "Ooopss. Wrong Username or Password! Please try again";

		}

		if($json==true){	
		$return = $this->returnjson($message);
		print_r($return);
		exit;
		}
	}

	public function user_signup($json){
	if(isset($_POST['password'])){
	$exclude = array('password','confirm_password');
	//////CHECK IF BOTH PASSWORDS ARE THESAME//////
	if($_POST['password']==$_POST['confirm_password']){
	//////CHECK IF EMAIL ALREADY EXIST!/////
	$check_table_for_email = $this->db->query("SELECT * FROM `users` WHERE email='".$this->db->escape($_POST['email'])."'")or die(mysql_error());

	if($check_table_for_email->num_rows==0){
		foreach(array_keys($_POST) as $key ) {
		if(!in_array($key, $exclude) ) {
		$fields[] = "`$key`";
		$values[] = "'" .$this->db->escape($_POST[$key])."'";
		}
		}
    
    //echo $account_type;exit;
	$addedfieldvalue=array("'".md5($_POST['password'])."'");
	$addedfieldarray=array("`password`");

	$rand = rand(1000,100000);
	$addedfieldvalue2=array("'".$rand."'");
	$addedfieldarray2=array("`user_confirm_id`");

	$date = date('Y-m-d');
	$addedfieldvalue3=array("'".$date."'");
	$addedfieldarray3=array("`signup_date`");

	$data = $values = array_merge($values,$addedfieldvalue);
	$keys = $fields = array_merge($fields,$addedfieldarray);

	$data = $values = array_merge($values,$addedfieldvalue2);
	$keys = $fields = array_merge($fields,$addedfieldarray2);

	$data = $values = array_merge($values,$addedfieldvalue3);
	$keys = $fields = array_merge($fields,$addedfieldarray3);

		$fields = implode(",", $fields);
		$values = implode(",", $values);

		$insert = $this->db->query("INSERT INTO `users` ($fields) VALUES ($values)");
		if($insert==1) {
	  	$message['msg'] = "User details was saved, but email is yet to be sent to your account for confirmation.";
		$message['status'] = '0';
		
        ////// CONFIRMATION EMAIL SHOULD ONLY BE SENT AFTER PAYMENT IS SUCCESS
        
        $message['sendstatus'] = '1';
		include_once("./api/smsandemail.php");
		$send=new smsandemail();

		$email_message = "
        <div style='background:#EAE9E9;width:100%;padding:0;margin:0;padding:30px'>
<div style='margin:0 auto;width:40%;min-width:300px;float:none;'>	
<div style='height:45px;background:#DEDEDE;padding:5px 25px; text-align:left'>
<img src='".URL."public/images/sabl_logo.png' style='height:100%'>

</div>
<div style='background:#fff;padding:10px'>	
<div style='text-align:left;font-size:14px;padding:0 20px'>
<h3 style='color:#666666'>Hello  ".$_POST['email']." </h3>
<p style='line-height:20px'>
Welcome to <strong>Havilah Academy</strong>. We bring you a world of possibilities. Get ready to explore.To validate your account, please complete your registration process by clicking on this link. <br/>
<a href=".URL.'confirm_registration/?id='.$rand.'&key='.$_POST['email'].">".URL.'confirm_registration/?id='.$rand.'&key='.$_POST['email']."</a><br/>
You can copy and paste the link on your browser url if it is not clickable <br/>

<hr style='border:none; border-bottom:1px solid #E7E7E7' />
</p>
<p style='line-height:15px;text-align:left;font-size:12px;margin-top:15px'>
If you did not associate your address with an Havilah Account account, please ignore this message. 
</p>
</div>
</div>
</div>
</div>

        ";

		$sender_name = "Havilah Academy";
		$subject = "We at Havilah welcome you!";

		$emailing = $send->emailing($_POST['email'],$email_message,$sender_name,$subject,'','');
		if($emailing['code']=='success'){
		$message['status']='1';
		$message['email'] = $_POST['email']; 
		$message['msg']="A Confirmation Email have been sent to the email address ".$_POST['email']." Please click on the confirmation link to activate your account";
		print_r($this->returnjson($message));
		return;
		//header("Location:".URL."register?success=".$_POST['email']."&fname=".$_POST['fullname']);	
		}
		
		
        
	    }else {
	        $message['msg'] = mysql_error();
	        $message['status']='0';
	    }
			print_r($this->returnjson($message));
			return;
	}
	else{
		$message['msg']="Email address already exist! Please try again.";
		$message['status']="2";
	}
	print_r($this->returnjson($message));
	return;
}
else{
		$message['msg']="Ooops. Passwords do not match! Please try again";
		$message['status']='3';
		print_r($this->returnjson($message));
		return;
	}

}

	}




	function user_confirm_signup($json, $confirm_code, $confirm_email){
	$code = $this->db->escape($confirm_code);	
	$email = $this->db->escape($confirm_email);
	//////CHECK IF VALUE EXIST!/////
	$check_table_for_value = $this->db->query("SELECT * FROM `users` WHERE user_confirm_id='".$code."' AND email='".$email."' AND status='0' ORDER BY id DESC LIMIT 1")or die(mysql_error());
	if($check_table_for_value->num_rows==1){
	$update=$this->db->query("UPDATE `users` SET status='1', activated='1'  WHERE user_confirm_id='".$code."' AND email='".$email."'");
	$message['msg']="Bravo! You are unstoppable, your account is now ready. You can now proceed to login.";
	$message['status']='1';
	}else{
	$message['msg']="Used, Wrong or Invalid Confirmation Code!";
	$message['status']='0';
	}
	if($json==true){
	print_r($this->returnjson($message));    
	return;    
	}else{
	return $message;    
	}
	

	}

	function user_confirm_signup_from_react_native($json){
	$json=file_get_contents('php://input');
	$obj=json_decode($json,true);
	$code = $this->db->escape($obj['confirm_code']);	
	$email = $this->db->escape($obj['confirm_email']);
	//////CHECK IF VALUE EXIST!/////
	$check_table_for_value = $this->db->query("SELECT * FROM `users` WHERE user_confirm_id='".$code."' AND email='".$email."' AND status='0' ORDER BY id DESC LIMIT 1")or die(mysql_error());
	if($check_table_for_value->num_rows==1){
	$update=$this->db->query("UPDATE `users` SET status='1'  WHERE user_confirm_id='".$code."' AND email='".$email."'");
	$message['msg']="Bravo! You are unstoppable, your account is now ready. You can now proceed to login.";
	$message['status']='1';
	print_r($this->returnjson($message));
	}else{
	$message['msg']="Wrong or Invalid Confirmation Code!";
	$message['status']='0';
	print_r($this->returnjson($message));
	}	

	}
    
    
    function forgot_password_confirm($json){
    $email = $this->db->escape($_POST['email']); 
    $recover_id = $this->db->escape($_POST['user_recover_id']); 
    $password = $this->db->escape($_POST['password']);      
    $confirm_password = $this->db->escape($_POST['password']);  
    if($password===$confirm_password){
    $check_first = $this->db->query("SELECT * FROM users WHERE user_recover_id='".$recover_id."' AND email='".$email."'")or die(mysql_error());
    if($check_first->num_rows==1){    
    $pass = md5($password);    
    $update = $this->db->query("UPDATE users SET password='".$pass."' WHERE user_recover_id='".$recover_id."' AND email='".$email."'")or die(mysql_error());
    $message['msg']="Password change was successful. Please proceed to login";
    $message['status']="1";    
    }else{
    $message['msg']="Invalid Confirmation Code!";
    $message['status']="2";    
    }
    }else{
    $message['msg']="Sorry passwords do not match!";
    $message['status']="0";
    }
      
    if($json==true){
    print_r($this->returnjson($message));    
    return;    
    }else{
    return $message;    
    }
    }
    
    
    function forgot_password($json){
    $email = $this->db->escape($_POST['email']); 
    $rand = rand(10000,1000000);    
	$check_table_for_email = $this->db->query("SELECT * FROM `users` WHERE email='".$email."'")or die(mysql_error());
	$detail = $check_table_for_email->row;
	if($check_table_for_email->num_rows==0){
	$message['msg']="Sorry we do not have this email address!";
	$message['status']="0";
	print_r($this->returnjson($message));
	return;
	}else{
    $update= $this->db->query("UPDATE users SET user_recover_id='".$rand."' WHERE id='".$detail['id']."'")or die(mysql_error());	
        
		include_once("./api/smsandemail.php");
		$send=new smsandemail();

		$email_message = "
<div style='background:#EAE9E9;width:100%;padding:0;margin:0;padding:30px'>
<div style='margin:0 auto;width:40%;min-width:300px;float:none;'>	
<div style='height:45px;background:#DEDEDE;padding:5px 25px; text-align:left'>
<img src='".URL."public/images/sabl_logo.png' style='height:100%'>

</div>
<div style='background:#fff;padding:10px'>	
<div style='text-align:left;font-size:14px;padding:0 20px'>
<h3 style='color:#666666'>Hello  ".$email." </h3>
<p style='line-height:20px'>
You recently made a request to reset your Nulai Compass Account (".$email."). Here is your activation code to complete the process.<br/>
<h1>".$rand."</h1><br/>
If you did not make this change or you believe an unauthorised person have accessed your account, please contact admin@nulai.com.ng.<br/>Regards.
<hr style='border:none; border-bottom:1px solid #E7E7E7' />
</p>
<p style='line-height:15px;text-align:left;font-size:12px;margin-top:15px'>
If you did not associate your address with a NULAI Compass account, please ignore this message. 
</p>
</div>
</div>
</div>
</div>
        ";

		$sender_name = "NULAI-Compass";
		$subject = "Password Reset";
		$emailing = $send->emailing($_POST['email'],$email_message,$sender_name,$subject,'','');
		if($emailing['code']=='success'){
		$message['status']='1';
		$message['email'] = $email; 
		$message['msg']="Please enter the confirmation code sent to your email ".$_POST['email'];
		print_r($this->returnjson($message));
		return;
		//header("Location:".URL."register?success=".$_POST['email']."&fname=".$_POST['fullname']);	
		}
	}

}

		

}
?>

