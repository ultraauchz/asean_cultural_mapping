<?php
/*
 *	Function get option
 *	Example:
 *		echo form_dropdown("id",get_option("id","title","TABLE","WHERE 1=1"));
*/
if(!function_exists('get_option')) {
	function get_option($value,$text,$table,$condition = NULL,$lang = NULL) 	{
		$CI =& get_instance();
		$variable = $CI->db->query("select * from $table $condition");
		foreach($variable->result() as $item) {
			$option[$item->{$value}] = $item->{$text};
		}
		return $option;
	}
}

/*
 *	Function clean url
 *	Example:	about us -> about-us
*/
if(!function_exists("clean_url")) {
	function clean_url($text) {	
		setlocale(LC_ALL,"Thai");
		$text=strtolower($text);
		$code_entities_match = array(' ','--','&quot;','!','@','#','$','%','^','&','*','(',')','_','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',','.','/','*','+','~','`','=');
		$code_entities_replace = array('-','-','','','','','','','','','','','','','','','','','','','','','','','','');
		$text = str_replace($code_entities_match, $code_entities_replace, $text);
		$text = @ereg_replace('(--)+', '', $text);
		$text = @ereg_replace('(-)$', '', $text);
		return $text;
	}
}

/*
 *	Function Youtube to Thumb
*/
if(!function_exists("YoutubeIframe2Thumb")) {
	function YoutubeIframe2Thumb($iframeCode,$width,$height,$extra=null) {
	  $regexstr = '~(?:(?:<iframe [^>]*src=")?|(?:(?:<object .*>)?(?:<param .*</param>)*(?:<embed [^>]*src=")?)?)?(?:https?:\/\/(?:[\w]+\.)*(?:youtu\.be/| youtube\.com| youtube-nocookie\.com)(?:\S*[^\w\-\s])?([\w\-]{11})[^\s]*)"?(?:[^>]*>)?(?:</iframe>|</embed></object>)?~ix';
	  $thumb = '<img src="http://img.youtube.com/vi/$1/0.jpg" '.$extra.' width="'.$width.'" height="'.$height.'"><input type="hidden" name="cover_pic[]" value="http://img.youtube.com/vi/$1/0.jpg">';
	  return preg_replace($regexstr, $thumb, $iframeCode);
	}
}

/*
 *	Function Link youtube to Iframe
*/
if(!function_exists("YoutubeIframe")) {
	function YoutubeIframe($link,$width,$height,$extra=null) {
		$v = $link;  
		$link = html_entity_decode($link);
		$link = strip_tags($link);
		$c="youtube";
		$v = @eregi_replace('(((f|ht){1}tp://)[-a-zA-Z0-9@:%_\+.~#?&//=]+)','<a href="\\1" target=_blank>\\1</a>', $v);
		$v = @eregi_replace('(((f|ht){1}tps://)[-a-zA-Z0-9@:%_\+.~#?&//=]+)','<a href="\\1" target=_blank>\\1</a>', $v);
		$v = @eregi_replace('([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&//=]+)','\\1<a href="http://\\2" target=_blank>\\2</a>', $v);
		$v = @eregi_replace('([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})','<a href="mailto:\\1" target=_blank>\\1</a>', $v);
		$v = preg_replace('#<a href="https?://www.'.$c.'.*?>([^>]*)</a>#i', '$1', $v);
		$v = @preg_replace("#http://(www\.)?youtube\.com/watch\?v=([^ &\n]+)(&.*?(\n|\s))?#i",'<div><object width="'.$width.'" height="'.$height.'"><param name="movie" value="http://www.youtube.com/v/$2"></param><embed src="http://www.youtube.com/v/$2" type="application/x-shockwave-flash" width="'.$width.'" height="'.$height.'"></embed></object></div>', $v);
		$v = @preg_replace("#https://(www\.)?youtube\.com/watch\?v=([^ &\n]+)(&.*?(\n|\s))?#i",'<div><object width="'.$width.'" height="'.$height.'"><param name="movie" value="http://www.youtube.com/v/$2"></param><embed src="http://www.youtube.com/v/$2" type="application/x-shockwave-flash" width="'.$width.'" height="'.$height.'"></embed></object></div>', $v);
	    return $v;
	}
}

if(!function_exists("Youtube2Iframe")) {
	function Youtube2Iframe($link,$width=560,$height=315) {
		$url = $link;
		$url_string = parse_url($url, PHP_URL_QUERY);
		parse_str($url_string, $args);
		if(isset($args["v"])) {
			$iframe = "<iframe width=\"$width\" height=\"$height\" src=\"//www.youtube.com/embed/".$args['v']."\" frameborder=\"0\" allowfullscreen></iframe>";
			return $iframe; 
		} else {
			return false;
		}
	}
}

if(!function_exists("fonts")) {
	function fonts() {
		$CI =& get_instance();
		$size = $CI->session->userdata("fontsize");
		
		switch ($size) {
			case 'small':
				$style = "body {\n
						font-size: 13px;\n
					}";
				break;
			case 'large':
				$style = "body {\n
						font-size: 17px;\n
					}";
				break;
			default:
				$style = null;
				break;
		}
		return $style;
	}
}

if(!function_exists("detail_page")) {
	function detail_page($detail) {		
		$page = 0;
		
		if(@$_GET["page"]) {
			$page = ($_GET["page"]-1);
		}
		
		$foo = @split("<!-- pagebreak -->", $detail);

		$target = preg_replace("/([&?]+page=[0-9]+)/i", "", $_SERVER["REQUEST_URI"]);
		
		$pagination = new pagination();
		$pagination->target($target);
		$pagination->limit(1);
		@$pagination->currentPage($_GET["page"]);
		$pagination->Items(count($foo));
		
		return @$foo[$page].$pagination->show(); 
	}
}

if(!function_exists("chk_image_path")) {
	function chk_image_path($image_path=null) {		
		if ($image_path) {
			$url_path = explode(base_url(), $image_path);
			$image = (empty($url_path['0']))?$url_path['1']:$url_path['0'];
			return file_exists($image);
		} else {
			return false;
		}
	}
}


if(!function_exists("online_users")) {
	function online_users() {		
		$CI =& get_instance();
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$file = $_SERVER['PHP_SELF'];
		$timeoutseconds = 300; //ตั้งเวลาสำหรับเช็คคนออนไลน์ เป็นวินาที 300= 5 นาที
		$timestamp=time();
		$timeout=$timestamp-$timeoutseconds;

		// เมื่อมีการโหลดเวบเพจขึ้นมา จะกำหนดให้เก็บค่า IP ของคนเยี่ยมชม และเวลาที่โหลดหน้าเวบเพจ ลงในฐานข้อมูลทันที
		$CI->db->query("INSERT INTO useronline VALUES ('$timestamp','$ip','$file')");
 
		//หลังจากนั้นเช็คว่า คนเยี่ยมชมหมายเลข IP ใด เกินกำหนดเวลาที่ตั้งไว้แล้ว ให้ลบออกฐานข้อมูล
		$CI->db->query("DELETE FROM useronline WHERE timestamp<$timeout");
		
		//ให้นับจำนวนเรคคอร์ดในตารางทั้งหมด ที่มี IP ต่างกัน ว่ามีเท่าไหร่ โดย IP เดียวกันให้นับเป็นคนเดียว
		$users = $CI->db->query("SELECT DISTINCT ip FROM useronline WHERE file='$file'");
		
		print_r($users->num_rows());
	}
}

if(!function_exists("bread_crumb")) {
	function bread_crumb($menu_id){		
		$CI =& get_instance();
		//$CI->load->model('Menu','menu');
		$menu = new Menu();
		$menu->where("id",$menu_id)->get(1);
		//$menu = $CI->menu->get($menu_id);
		
		$bread_crumb='<!-- Content Header (Page header) -->
		<section class="content-header">
		  <h1>
		    '.$menu->title.'
		    <small>'.$menu->description.'</small>
		  </h1>
		  <ol class="breadcrumb">
		    <li><a href="siteadmin/dashboard/index"><i class="fa fa-dashboard"></i> Home</a></li>
		    <li class="active">'.$menu->title.'</li>
		  </ol>
		</section>';
		
		return $bread_crumb;	
	} 
}


if(!function_exists('fix_file'))
{
    function fix_file(&$files)
    {
        $names = array( 'name' => 1, 'type' => 1, 'tmp_name' => 1, 'error' => 1, 'size' => 1);
    
        foreach ($files as $key => $part) {
            // only deal with valid keys and multiple files
            $key = (string) $key;
            if (isset($names[$key]) && is_array($part)) {
                foreach ($part as $position => $value) {
                    $files[$position][$key] = $value;
                }
                // remove old key reference
                unset($files[$key]);
            }
        }
    }
}