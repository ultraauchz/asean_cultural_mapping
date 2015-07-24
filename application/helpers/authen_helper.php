<?php
if(!function_exists("login")) {
	function login($username,$password) {
		$CI =& get_instance();		
		$foo = new User();
		$foo->where("username",$username)->where("password",$password)->where("status",1)->get(1);
		if($foo->id) {

			$CI->session->set_userdata("id",$foo->id);
			$CI->session->set_userdata("user_type_id",$foo->user_type_id);
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

if(!function_exists("logout")) {
	function logout() {
		$CI =& get_instance();
		$CI->session->unset_userdata('id');
		$CI->session->unset_userdata('user_type_id');
	}
}

if(!function_exists("user")) {
	function user() {
		$CI =& get_instance();
		$foo = new User($CI->session->userdata("id"));
		return $foo;
	}
}

if(!function_exists("encrypt_password")) {
	function encrypt_password($password) {
		return md5($password);
	}
}

if(!function_exists("check_session")) {
	function check_session($session,$value) {
		$CI =& get_instance();
		$ss = $CI->session->userdata($session);

		if($session==$value) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

if(!function_exists("check_captcha")) {
	function check_captcha($captcha) {
		$CI =& get_instance();
		if($CI->session->userdata("captcha")===$captcha) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

if(!function_exists("uri_segment")) {
	function uri_segment($segment=2,$url) {
		$CI =& get_instance();

		if($CI->uri->segment($segment)==$url) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

if(!function_exists("permission")) {
	function permission($module,$action,$id=null) {
		$CI =& get_instance();
		$foo = new Permission();

		if($id) {
			$foobar = $foo->where("user_type_id",$id)->where("module",$module)->get(1);
			if($foobar->$action) {
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			if(user()->fd_admin==1) {
				return TRUE;
			} else {
				$foobar = $foo->where("user_type_id",user()->user_type_id)->where("module",$module)->get(1);

				if($foobar->$action) {
					return TRUE;
				} else {
					return FALSE;
				}
			}
		}
	}
}

if(!function_exists("debug")) {
	function debug($value) {
		echo "<pre>";
		print_r($value);
		echo "</pre>";
	}
}

if(!function_exists("color")) {
	function color() {
		$CI =& get_instance();
		$color = $CI->session->userdata('color');
		switch ($color) {
			case "black":
				return $color;
				break;
			case "yellow":
				return $color;
				break;
			default:
				return "default";
				break;
		}
	}
}

if(!function_exists("sendmail")) {
	function sendmail($title,$detail,$email) {
		$sendsubject= "=?utf-8?b?".base64_encode($title)."?=";

		require_once(APPPATH."libraries/phpmailer/class.phpmailer.php");

		//	imap.mail.go.th
		//	SSL
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Host = "smtp.mail.go.th";
		$mail->Port = 25;
		$mail->Username   = "noreply@royalrain.go.th";
		$mail->Password   = "12345678";
		$mail->SMTPAuth = true;
		$mail->CharSet = "utf-8";
		$mail->From = "noreply@royalrain.go.th";		//  account e-mail ของเราที่ใช้ในการส่งอีเมล
		$mail->FromName = WEB_TITLE;
		$mail->AddAddress($email);	  		// Email ปลายทางที่เราต้องการส่ง
		$mail->IsHTML(true);								// ถ้า E-mail นี้ มีข้อความในการส่งเป็น tag html ต้องแก้ไข เป็น true
		$mail->Subject = $sendsubject;
		$mail->Body = $detail;					// ข้อความ ที่จะส่ง
		$mail->SMTPDebug = false;
		$mail->do_debug = 1;
		$mail->Send();
	}
}

if(!function_exists("currentURL")) {
	function currentURL() {
		$CI =& get_instance();
		$return = $CI->config->site_url().$CI->uri->uri_string();
		if(count($_GET)>0) {
		    $get = array();
		    foreach($_GET as $key => $val) {
		        $get[] = $key.'='.$val;
		    }
		    $return .= '?'.implode('&', $get);
		}
		return $return;
	}
}

if(!function_exists("default_value")) {
	function default_value() {
		$foo = new Other(1);
		return $foo;
	}
}
