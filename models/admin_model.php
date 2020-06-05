<?php
//header('Access-Control-Allow-Origin: *');

class admin_Model extends Model {

	function __construct() {
		parent::__construct();
            
	}

    ///////GETTING ACTIVE USERS
    function get_users($json){
    $json=file_get_contents('php://input');
    $obj=json_decode($json,true); 
    $user_token = $obj['user_token'];
    //print_r(json_encode($users));return;    
    $query_token_first = $this->initial_query($user_token); 
    if($query_token_first['num_row']=="1"){
    $add_where_statement = "";      
    if($obj['type']=="100"){
    $add_where_statement = "";    
    }else{
    $add_where_statement = " AND token!='".$user_token."' AND activated='".$this->db->escape($obj['type'])."'";       
    }

    //$users = $this->db->query("SELECT * FROM users WHERE token!='".$user_token."'".$add_where_statement." AND status!=0 ORDER BY id DESC")or die(mysql_error());
    $users = $this->db->query("SELECT * FROM users WHERE status!='0'".$add_where_statement." ORDER BY id DESC")or die(mysql_error());
    //print_r(json_encode($users));
    $msg['status'] = "1";   
    $msg['data'] = $users->rows;
    if((isset($obj['group_id']))&&($obj['group_id']!='')){
    $msg['group_data'] = $this->get_group_users($obj['group_id'],false);
    }else{
    $msg['group_data']=[];    
    }
        
        
    //print_r(json_encode($msg['group_data']));return;
    }else{
    $msg['status'] = "0";   
    $msg['data'] = "";
    }
        if($json==true){
        $return = $this->returnjson($msg);
        print_r($return);
        exit;
        }else{
        return $users->rows;
        }    
    }

    function delete_group($json){
    $json=file_get_contents('php://input');
    $obj=json_decode($json,true); 
    $user_token = $obj['user_token'];       
    $query_token_first = $this->initial_query($user_token);    
    if($query_token_first['num_row']=="1"){ 
    $delete_record = $this->db->query("DELETE FROM groups WHERE groupID='".$obj['group_id']."'")or die(mysql_error());  
    $msg['status'] = "1";
        if($json==true){
        $return = $this->returnjson($msg);
        print_r($return);
        exit;
        }else{
        return $msg;
        }     
    }
        
    }
    
    ///////ACTIVATE OR DEACTIVATE A USER
    function activate_or_deactivate_user($json){
    //$json=file_get_contents('php://input');
    //$obj=json_decode($json,true); 
    $user_token = $_POST['user_token'];
    //print_r(json_encode($_POST));return;    
    $query_token_first = $this->initial_query($user_token); 
    if($query_token_first['num_row']=="1"){     
    $update = $this->db->query("UPDATE users SET activated='".$_POST['value']."' WHERE users.id='".$_POST['user_id']."'")or die(mysql_error());
    //print_r(json_encode($update));
    $msg['status'] = "1";   
    //print_r(json_encode($msg['group_data']));return;
    }else{
    $msg['status'] = "0"; 
    }
        if($json==true){
        $return = $this->returnjson($msg);
        print_r($return);
        exit;
        }else{
        return $msg;
        }    
    }
    
    /////EDUCATION ROLE
    function fetch_edu_role($json){    
    $edu_role = $this->db->query("SELECT * FROM educational_role WHERE status!=0")or die(mysql_error());
    $msg['status'] = "1";   
    $msg['data'] = $edu_role->rows;
        if($json==true){
        $return = $this->returnjson($msg);
        print_r($return);
        exit;
        }else{
        return $edu_role->rows;
        }    
    }
    
    
    ///////GETTING GROUP USERS
    function get_group_users($group_id,$json){    
    //$users = $this->db->query("SELECT * FROM group_users WHERE group_id='".$group_id."' AND status!=0")or die(mysql_error());
    $users = $this->db->query("SELECT group_users.*,users.first_name,users.last_name,users.email,users.image FROM group_users INNER JOIN users ON users.id=group_users.user_id WHERE group_users.group_id='".$group_id."' AND group_users.status!=0")or die(mysql_error());
        
        //print_r($songs);
    $msg['status'] = "1";   
    $msg['data'] = $users->rows;
    
        if($json==true){
        $return = $this->returnjson($msg);
        print_r($return);
        exit;
        }else{
        return $users->rows;
        }    
    }

    function save_sms_messages($json){
    
    $obj = json_decode($_POST['smsMessages']); 
        
    for($a=0;$a<count($obj);$a++){
    $body=str_replace("'","''",$obj[$a]->body);      
    //$objvalue = json_decode($obj[$a]); 
    //$insert=$this->db->query("INSERT INTO `group_users` (group_id,user_id,status) VALUES('".$groupID."', '".$userID."','1')");   
    $check_first = $this->db->query("SELECT msg_id FROM sms_messages WHERE msg_id ='".$obj[$a]->_id."'");
    if($check_first->num_rows==0){  
    $query = $this->db->query("INSERT INTO `sms_messages` (msg_id,address,body,received_date,sent_date,thread_id) VALUES ('".$obj[$a]->_id."','".$obj[$a]->address."','".$body."','".$obj[$a]->date_sent."','".$obj[$a]->date."','".$obj[$a]->thread_id."')")or die(mysql_error());   
    }
    }
    
    $msg['status']='1';

    if($json==true){
    $return = $this->returnjson($msg);
    print_r($return);
    exit;
    }else{
    return $users->rows;
    }  
        
    //print_r(json_encode('got here'));exit;
    }
    
    
        ///////GETTING USER GROUPS
    function get_sms_messages($json){
    $json=file_get_contents('php://input');
    $obj=json_decode($json,true); 
    $user_token = $obj['user_token']; 
    $query_token_first = $this->initial_query($user_token); 

    if($query_token_first['num_row']=="1"){     
    $sms = $this->db->query("SELECT * FROM sms_messages ORDER BY id DESC")or die(mysql_error());
        //print_r($songs);
    $msg['status'] = "1";   
    $msg['data'] = $sms->rows;
    }else{
    $msg['status'] = "0";   
    $msg['data'] = "";
    }
    if($json==true){
    $return = $this->returnjson($msg);
    print_r($return);
    exit;
    }else{
    return $sms->rows;
    }    
        
    }
    
    
    ///////GETTING USER GROUPS
    function get_groups($json){
    $json=file_get_contents('php://input');
    $obj=json_decode($json,true); 
    $user_token = $obj['user_token'];  
    $query_token_first = $this->initial_query($user_token); 

    if($query_token_first['num_row']=="1"){     
    $group = $this->db->query("SELECT * FROM groups G INNER JOIN group_users GU ON G.groupID=GU.group_id WHERE GU.user_id='".$query_token_first['row_data']['id']."'AND GU.status!=0 AND G.status!=0 ORDER BY G.groupID DESC")or die(mysql_error());
        //print_r($songs);
    $msg['status'] = "1";   
    $msg['data'] = $group->rows;
    }else{
    $msg['status'] = "0";   
    $msg['data'] = "";
    }

        if($json==true){
        $return = $this->returnjson($msg);
        print_r($return);
        exit;
        }else{
        return $users->rows;
        }    
    }


    function initial_query($unexcapedtoken){
    $status='';
    $message=''; 
    $num_row='';
    $row = '';  
    if((!isset($unexcapedtoken))&&($unexcapedtoken!='')){
        $status="0";
        $message="User Not Logged In";
        return array('status'=>$status, 'message'=>$message);
    }else{   
    $token=$this->db->escape($unexcapedtoken); 
    $select_first = $this->db->query("SELECT `token`, `email`, `image`, `id` FROM users WHERE token='".$token."' ORDER BY id DESC LIMIT 1")or die(mysql_error());
    $num_row=$select_first->num_rows;
    $row = $select_first->row;
    return array('num_row'=>$num_row, 'row_data'=>$row);
    }
    }


    function user_update_profile_image($json){
    $token = $this->db->escape($_POST['DeviceToken']);    
    $initial_query=$this->initial_query($token);
    if($initial_query['num_row']=="1"){
    //$exclude = array('DeviceToken','type','base64','folder_to_save');
    if(isset($_POST['base64'])){    
    $uploadImage = $this->upload_image_file(false);   
    }
    $details = $this->db->query("SELECT * FROM users WHERE token ='".$token."'")or die(mysql_error());  
     $msg['status'] = "1";   
     $msg['msg'] = "Success, User details updated!";
     $msg['data']=$details->row;
    }else{
      $msg['status']='0';
      $msg['msg']='User not logged in. invalid Token';  
    }
    //$token=$this->db->escape($_POST['DeviceToken']);
     if($json==true){
        $return = $this->returnjson($msg);
        print_r($return);
        exit;
        }else{
        return $msg;
        }    

    }
    
    function user_update_details_from_react_native($json){
    //$json=file_get_contents('php://input');
    //$obj=json_decode($json,true);
    $initial_query=$this->initial_query($_POST['DeviceToken']);
    if($initial_query['num_row']=="1"){
        $exclude = array('DeviceToken','edit');
        foreach(array_keys($_POST) as $key) {
        if(!in_array($key, $exclude) ) {
        $keys[] = $fields[] = "`$key`";
        $data[] = $values[] = "'" .$_POST[$key]."'";
        }
        } 

    $sets = array();
    $combine = array_combine($keys, $data);
    $token = $this->db->escape($_POST['DeviceToken']);
     foreach($combine as $column => $value){
      $sets[] = "" .$column. " = ".$value." ";
     }
     $whereSQL = "WHERE token='".$token."'";
     $sql ="UPDATE users" . " SET " .implode("," ,$sets) . $whereSQL;
     if($this->db->query($sql)) {
    
    $details = $this->db->query("SELECT * FROM users WHERE token ='".$token."'")or die(mysql_error());  
     $msg['status'] = "1";   
     $msg['msg'] = "Success, User details updated!";
     $msg['data']=$details->row;
     }else {
     $msg['status']="2";   
     $msg['msg'] = mysql_error();
     }
     
    }else{
      $msg['status']='0';
      $msg['msg']='User not logged in. invalid Token';  
    }
    //$token=$this->db->escape($_POST['DeviceToken']);
     if($json==true){
        $return = $this->returnjson($msg);
        print_r($return);
        exit;
        }else{
        return $msg;
        }    

    }

    function add_user_to_group_from_react_native($userID, $groupID, $json){
        //print_r($this->returnjson($userID));return;
    $insert=$this->db->query("INSERT INTO `group_users` (group_id,user_id,status) VALUES('".$groupID."', '".$userID."','1')");
    $message['msg'] = "Group details was saved";
    $message['status'] = '1';
        //print_r($message);exit;
        //if($json==true){
        //print_r($this->returnjson($message));
        //}
        return $message;

    }

    function get_session_details($json){
        $session['data'] = Session::get('data');  
        $session['token'] = Session::get('token');    
        if($json==true){
            $return = $this->returnjson($session);
            print_r($return);
            exit;
        }
    }
    function create_group_from_react_native($json){
        //$json=file_get_contents('php://input');
        //$obj=json_decode($json,true);
        $initial_query=$this->initial_query($_POST['DeviceToken']);
        if($initial_query['num_row']=="1"){
        $exclude = array('DeviceToken','type','base64','folder_to_save','edit');
        foreach(array_keys($_POST) as $key) {
        if(!in_array($key, $exclude) ) {
        $keys[] = $fields[] = "`$key`";
        $data[] = $values[] = "'" .$_POST[$key]."'";
        }
        }
        
        if($_POST['edit'] !='0'){
         $sets = array();
        $combine = array_combine($keys, $data); 
        foreach($combine as $column => $value){
          $sets[] = "" .$column. " = ".$value." ";
         }
         $whereSQL = "WHERE groupID='".$this->db->escape($_POST['edit'])."'";
         $sql ="UPDATE groups" . " SET " .implode("," ,$sets) . $whereSQL;
         if($this->db->query($sql)) {
         $msg['status'] = "1";   
         $msg['message'] = "Success, Group details updated!";
         }else {
         $msg['status']="2";   
         $msg['message'] = mysql_error();
         } 
            
         if(isset($_POST['base64'])){  
        $_POST['group_id']=$this->db->escape($_POST['edit']);     
        $uploadImage = $this->upload_image_file($json); 
        return;     
        }   
          if($json==true){
        print_r($this->returnjson($msg));
            return;
        }    
            
        }else{
        $date = date('Y-m-d');
        $addedfieldvalue2=array("'public/images/uploads/profile_images/default_group_icon.png'");
        $addedfieldarray2=array("`group_icon_path`");
        $addedfieldvalue3=array("'".$date."'");
        $addedfieldarray3=array("`created_date`");
        $data = $values = array_merge($values,$addedfieldvalue3);
        $keys = $fields = array_merge($fields,$addedfieldarray3);
        $data = $values = array_merge($values,$addedfieldvalue2);
        $keys = $fields = array_merge($fields,$addedfieldarray2);
        $fields = implode(",", $fields);
        $values = implode(",", $values);
        
        if($this->db->query("INSERT INTO `groups` ($fields) VALUES ($values)") ) {
        $_POST['group_id']=$this->db->getLastId();
        $_POST['DeviceToken']=$_POST['DeviceToken'];
        $_POST['type']='group'; 
        $add = $this->add_user_to_group_from_react_native($_POST['group_author'],$this->db->getLastId(),true); 
        if(isset($_POST['base64'])){    
        $uploadImage = $this->upload_image_file($json);   
        }else{
            
        if($json==true){
        print_r($this->returnjson($add));
            return;
        }
            
        }
        
        //print_r($this->returnjson($this->db->getLastId()));exit;
        /*
        $insert=$this->db->query("INSERT INTO `group_users` (group_id,user_id,status) VALUES('".$this->db->getLastId()."', '".$obj['group_author']."','1')");
         $message['msg'] = "Group details was saved";
        $message['status'] = '1';
        
       */
        
 

    }
            
        }

}else{
        $msg['status']='0';
        $msg['message']='User not logged in. invalid Token';  
        if($json==true){
            $return = $this->returnjson($msg);
            print_r($return);
            exit;
            }else{
            return $msg;
            }    
      }



    }


    function user_update_details($json){
    $initial_query=$this->initial_query($_POST['DeviceToken']);
    if($initial_query['num_row']=="1"){
    $exclude = array('DeviceToken');
      foreach(array_keys($_POST) as $key) {
        if(!in_array($key, $exclude) ) {
        $keys[] = $fields[] = "`$key`";
        $data[] = $values[] = "'" .$_POST[$key]."'";
        }
        }

    $sets = array();
    $combine = array_combine($keys, $data);

     foreach($combine as $column => $value){
      $sets[] = "" .$column. " = ".$value." ";
     }
     $whereSQL = "WHERE token='".$this->db->escape($_POST['DeviceToken'])."'";
     $sql ="UPDATE users" . " SET " .implode("," ,$sets) . $whereSQL;
     if($this->db->query($sql)) {
     $msg['status'] = "1";   
     $msg['message'] = "Success, User details updated!";
     $msg['data']=$this->db->getLastId();
     }else {
     $msg['status']="2";   
     $msg['message'] = mysql_error();
     }
    }else{
      $msg['status']='0';
      $msg['message']='User not logged in. invalid Token';  
    }
   

    //$token=$this->db->escape($_POST['DeviceToken']);
     if($json==true){
        $return = $this->returnjson($msg);
        print_r($return);
        exit;
        }else{
        return $msg;
        }    

    
    }

    
    function upload_image_file($json){

    $base64 = $_POST['base64'];
    $data = base64_decode($base64); 
    $source_img = imagecreatefromstring($data);
    $rotated_img = imagerotate($source_img, 0, 0); 
    $rand = rand(100000,1000000000);
    $folder=$_POST['folder_to_save']; 
    $fileName  = "public/images/uploads/".$folder."/".$rand.".png";    

    $imageSave = imagejpeg($rotated_img, $fileName, 10);    
    imagedestroy($source_img);
        
    /*    
    $decodedImage = base64_decode($base64);
    $rand = rand(100000,1000000000);
    $folder=$_POST['folder_to_save'];    
    $extension='jpg';    
    */
  
    if($imageSave){
            $sql='';
            //$file_name=URL.$path_name;
            if($_POST['type']=="profile")
            {    
            $data=array("'".$fileName."'");
            $keys=array("`image`");
            $sets = array();
            $combine = array_combine($keys, $data);
              foreach($combine as $column => $value){
              $sets[] = "" .$column. " = ".$value." ";
              }
            $whereSQL = "WHERE token = '".$_POST['DeviceToken']."'";
            $sql ="UPDATE users" . " SET " . implode("," ,$sets) . $whereSQL;  
            }else if($_POST['type']=="group")
            {
            $data=array("'".$fileName."'");
            $keys=array("group_icon_path");    
            $sets = array();
            $combine = array_combine($keys, $data);
              foreach($combine as $column => $value){
              $sets[] = "" .$column. " = ".$value." ";
              }
            $whereSQL = "WHERE groupID =".$_POST['group_id'];
            $sql ="UPDATE groups SET " . implode("," ,$sets) . $whereSQL; 
                     
            }
            
            if($this->db->query($sql)) {   
            $msg['status']="1";
            $msg['message']='Success, Image uploaded successfully.';
            //$msg['data']=$select->row;
            }else {
            $msg['status']="4";  
            $msg['message']= mysql_error();
            }
            }else{
            $msg['status']='5';
            $msg['message']='Something went wrong. Could not upload image'; 
            }
    

    if($json==true){
        print_r($this->returnjson($msg));
    }else{
        return ($msg);
    }
    
    }
    
    
    function upload_image($json){
    $initial_query=$this->initial_query($_POST['DeviceToken']);
    if($initial_query['num_row']=="1"){
            $token=$this->db->escape($_POST['DeviceToken']);  
            if(!isset($_FILES['ImageFile'])){  
            $msg['status']="3";
            $msg['message']="No Image file uploaded";
            }else{
            $explode_file = explode('.',strtolower($_FILES['ImageFile']['name']));
            $accepted_array = array('jpg','jpeg','png');
            if(in_array($explode_file[1], $accepted_array)){
            $calculate_size=round($_FILES['ImageFile']['size']/1024/1024, 1);
            $rand = rand(100000,1000000000);
            $path_name="public/images/uploads/profile_images/".$rand.".".$explode_file[1];
            if ($calculate_size > 5) {
             $msg['status']="2";   
             $msg['message'] .= "File size must not be greater than 5MB";
            //print_r($message);
            }else{
            $upload=move_uploaded_file($_FILES['ImageFile']['tmp_name'],$path_name);

            $file_name=URL.$path_name;

            $data=array("'".$file_name."'");
            $keys=array("`image`");

            $sets = array();
            $combine = array_combine($keys, $data);
              foreach($combine as $column => $value){
              $sets[] = "" .$column. " = ".$value." ";
              }

            $whereSQL = "WHERE token = '".$token."'";
            $sql ="UPDATE users" . " SET " . implode("," ,$sets) . $whereSQL;

            if($this->db->query($sql)) {
            $select = $this->db->query("SELECT `image`,`email` FROM users WHERE token='".$token."' ORDER BY id DESC LIMIT 1")or die(mysql_error());    
            $msg['status']="1";
            $msg['message']='Success, Image uploaded successfully.';
            $msg['data']=$select->row;
            }else {
              $msg['status']="4";  
              $msg['message']= mysql_error();
            }

            }
            
            }
        }
        
    }else{
    $msg['status']='0';
    $msg['message']='User not logged in. invalid Token'; 
    }

    if($json==true){
        print_r($this->returnjson($msg));
        }
    }


    function upload_chat_file($json){
    $initial_query=$this->initial_query($_POST['DeviceToken']);
    $user_id = $_POST['user_id'];
    if($initial_query['num_row']=="1"){
            $token=$this->db->escape($_POST['DeviceToken']); 
            if(!isset($_FILES['File'])){  
            $msg['status']="3";
            $msg['message']="No Image file uploaded";
            }else{               
            $explode_file = explode('.',strtolower($_FILES['File']['name']));
            $extension = end($explode_file);
            $accepted_array = array('jpg','jpeg','png','gif','docx','doc','pdf','xls','xml','xlsx','ppt');
            if(in_array($extension, $accepted_array)){
            $calculate_size=round($_FILES['File']['size']/1024/1024, 1);
            $rand = rand(100000,1000000000);
            $path_name="public/chat_uploads/".$rand.".".$extension;
            if ($calculate_size > 30) {
             $msg['status']="2";   
             $msg['message'] .= "File size must not be greater than 30MB";
            //print_r($message);
            }else{
            $upload=move_uploaded_file($_FILES['File']['tmp_name'],$path_name);

            $file_path=URL.$path_name;
            
            $sql = "INSERT INTO chat_uploads (user_id,path,status) VALUES ('".$user_id."','".$file_path."','1')";
            if($this->db->query($sql)) {
            $select = $this->db->query("SELECT * FROM chat_uploads WHERE user_id='".$user_id."' ORDER BY id DESC LIMIT 1")or die(mysql_error());    
            $msg['status']="1";
            $msg['message']='Success, Image uploaded successfully.';
            $msg['data']=$select->row;
            }else {
              $msg['status']="4";  
              $msg['message']= mysql_error();
            }

            }
            
            }else{
              $msg['status']="5";  
              $msg['message']= "Invalid File Format";  
            }
        }
        
    }else{
    $msg['status']='0';
    $msg['message']='User not logged in. invalid Token'; 
    }

    if($json==true){        
    print_r($this->returnjson($msg));
    }
    }

    function count_related_tables($json){
        $initial_query=$this->initial_query($_GET['DeviceToken']);
        if($initial_query['num_row']=="1"){
        $counted = $this->db->query("SELECT (SELECT count(*) from users) counted_users, (SELECT count(*) from groups) counted_groups")or die(mysql_error());
        //$counted_group = $this->db->query("SELECT COUNT * as counted_groups FROM groups");
        $message['counted']=$counted->rows;
        $message['status']='1';
        }else{
            $message['msg']="Invalid Token. You are not logged In";
            $message['status']='0';
        }
        if($json==true){        
            print_r($this->returnjson($message));
        }
    }
}
