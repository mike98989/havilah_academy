<?php
use Mailgun\Mailgun;


class smsandemail {
/////// SMS API VIA SMSLIVE247
public function smsmessage($sms_to_phonenumber,$text_message,$sender_name){

			$owneremail="mike98989@gmail.com";
			$subacct="WEBSITE_CLIENTS";
			$subacctpwd="proffessor";
			$sendto=$sms_to_phonenumber;
			$sender=$sender_name;
			$message=$text_message;
			/* create the required URL */
			/* destination number */
			/* sender id */
			/* message to be sent */
			$url =
			"http://www.smslive247.com/http/index.aspx?" . "cmd=sendquickmsg"
			. "&owneremail=" . UrlEncode($owneremail)
			. "&subacct=" . UrlEncode($subacct)
			. "&subacctpwd=" . UrlEncode($subacctpwd) . "&message=" . UrlEncode($message)."&sendto=".UrlEncode($sendto)."&sender=".UrlEncode($sender);
			/* call the URL */



			if ($f = @fopen($url, "r"))
			{
				  $answer = fgets($f, 255);
				  if (substr($answer, 0, 1) == "+")
				  {
						$msg="SMS to $dnr was successful.";
						return $msg;
			}
				elseif($answer){
					$msg='You message was successfully sent to Recipient(s)! Regards.';
					return $msg;
				}
			else {
			$msg="an error has occurred: [$answer].";
			return $msg;
			} }

			else{
			$msg="url could no be oppened";
			return $msg;
			}
				return $msg;
				}


//SENDINBLUE  EMAIL API
public function emailing($emailtoaddress,$email_message,$sender_name,$subject,$attachment1,$attachment2){


	require_once('api/Mailin.php');
	/*
	 * This will initiate the API with the endpoint and your access key.
	 *
	 */
	//$mailin = new Mailin('https://api.sendinblue.com/v2.0','vykTJ9r4LwWFzQH5');
	$mailin = new Mailin('https://api.sendinblue.com/v2.0','b7UMIaBPxhtrRNs8');
	
	/*
	 * This will send a transactional email
	 *
	 */
	/** Prepare variables for easy use **/

	$data = array( "to" => array($emailtoaddress=>"to whom!"),
				//"cc" => array("cc@example.net"=>"cc whom!"),
				//"bcc" =>array("bcc@example.net"=>"bcc whom!"),
				"from" => array("no-reply@propertyfy.com.ng",$sender_name),
				"replyto" => array("no-reply@propertyfy.com.ng",$sender_name),
				"subject" => $subject,
				"text" => $email_message,
				"html" => $email_message,
				"attachment" => array($attachment1,$attachment2),
				"headers" => array("Content-Type"=> "text/html; charset=iso-8859-1","X-param1"=> "value1", "X-param2"=> "value2","X-Mailin-custom"=>"my custom value", "X-Mailin-IP"=> "102.102.1.2", "X-Mailin-Tag" => "My tag"),

				//"inline_image" => array('myinlineimage1.png' => "your_png_files_base64_encoded_chunk_data",'myinlineimage2.jpg' => "your_jpg_files_base64_encoded_chunk_data")
	);

	$sendmail = $mailin->send_email($data);
    
	return $sendmail;
	//print_r($send)
	//print_r($sendmail);
	//var_dump($mailin->send_email($data));



}




}

;?>
