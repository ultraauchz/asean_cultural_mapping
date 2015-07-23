<?php
function GenRandomString($length=5) {
    
    $string = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,5);

    return $string;
}

function ContactData($fieldname){
	$CI=&get_instance();
	$CI->load->model('system_contact_model','system_contact');
	$contact_data = $CI->system_contact->get_row(1);
	return $contact_data[$fieldname];
}

function GetCurrLang() {
	$uri = $_SERVER["REQUEST_URI"];
	$pos = strrpos($uri, "/en");
	$lang = $pos > 0 ? "en" : "th";
	return $lang;
}

function GetCurrURL($curr_lang = FALSE, $select_lang = FALSE) {
	$uri = $_SERVER["REQUEST_URI"];
	$url = $curr_lang == $select_lang ? $uri : str_replace('/' . $curr_lang, '/' . $select_lang, $uri);
	return $url;
}

function send_register_email($user_id=FALSE) {
	require_once('include/PHPMailer/class.phpmailer.php');
	$CI = &get_instance();
	$CI->load->model('users_model','user');
	$user = $CI->user->get_row($user_id);
	$mail_to = $user['email'];
	$subject = 'Welcome to ThaiComplex.com';
	$message = 'Dear '.$user['name'].',<br>';
	$message.= 'You have account log is. <br><br>';
	$message.= 'Username:::'.$user['username'].'<br>';
	$message.= 'Password:::'.$user['password'].'<br>';
	$message.= 'Click here to <a href="http://www.thaicomplex.com/front/member/register_form" target="_blank">login</a> to your account.<br>';
	$message.= 'Click here to the website:<a href="http://www.thaicomplex.com" target="_blank">www.thaicomplex.com</a><br><br>';
	$message.= 'Sincerely,<br>';
	$message.= 'ThaiComplex.com';
	$message.= '</b>';
		$contact_email = ContactData('contact_email');
		$mail             = new PHPMailer(); // defaults to using php "mail()"
		
		$mail->CharSet = "utf-8";
		$mail->IsSMTP();
		$mail->SMTPDebug = 0;
		$mail->SMTPAuth = true;
		$mail->Host       = "mail.thaicomplex.com";
		$mail->Port       = 25;
		$mail->Username   = $contact_email; //"info@thaicomplex.com";
		$mail->Password   = "info@THComp";
		
		$mail->AddReplyTo($contact_email, 'ThaiComplex.com');
		$mail->SetFrom($contact_email, 'ThaiComplex.com');

		$body             = $message;
		//$body             = ereg_replace ("[\]",'',$body);
		
		$address = $mail_to;
		$mail->AddAddress($address, $user['name']);		
		$mail->Subject    = $subject;	
		
		$mail->MsgHTML($body);		
		if(!$mail->Send()) {
		  //echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
		  //echo "Message sent!";
		}
	//mail($mail_to, $subject, $message, $headers);
}

function GetMenuProperty($id, $field) {
	$CI = &get_instance();
	$result = $CI -> db -> getone("SELECT " . $field . " from admin_menu where id=" . $id);
	return $result;
}

function GetProductDetail($product_id) {
	$CI = &get_instance();

	$sql = " select product.*,
		pc1.name_en as cat_lv1_name_en,
		pc1.name_en as cat_lv1_name_th,
		pc2.name_en as cat_lv2_name_en,
		pc2.name_en as cat_lv2_name_th, 
		pc3.name_en as cat_lv3_name_en, 
		pc3.name_th as cat_lv3_name_th 
		from product		
		left join product_category pc1 ON product.cat_lv1 = pc1.id
		left join product_category pc2 ON product.cat_lv2 = pc2.id
		left join product_category pc3 ON product.cat_lv3 = pc3.id ";
	$result = $CI -> db -> getrow($sql . " where product.id=" . $product_id);
	return $result;
}

?>
