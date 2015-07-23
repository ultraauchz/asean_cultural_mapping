<?php 
if ( ! function_exists('db_to_th'))
{
function db_to_th($datetime = '', $time = TRUE ,$format = 'F')
	{
		if($format == 'F')
		{
			$month_th = array( 1 =>'มกราคม',2 => 'กุมภาพันธ์',3=>'มีนาคม',4=>'เมษายน',5=>'พฤษภาคม',6=>'มิถุนายน',7=>'กรกฏาคม',8=>'สิงหาคม',9=>'กันยายน',10=>'ตุลาคม',11=>'พฤศจิกายน',12=>'ธันวาคม');
		}
		else
		{
			$month_th = array( 1 =>'ม.ค.',2 => 'ก.พ.',3=>'มี.ค.',4=>'เม.ย',5=>'พ.ค.',6=>'มิ.ย',7=>'ก.ค.',8=>'ส.ค.',9=>'ก.ย.',10=>'ต.ค.',11=>'พ.ย.',12=>'ธ.ค.');
		}
		
		$datetime = human_to_unix($datetime);
		
		
		$r = date('d', $datetime).' '.$month_th[date('n', $datetime)].' '.(date('Y', $datetime) + 543); 
		
		if($time)
		{
				$r .= ' - '.date('H', $datetime).':'.date('i', $datetime);
				
		}
	
		return $r;
		
	}
}

if ( ! function_exists('unix_to_human_date'))
{
	function unix_to_human_date($time = '')
	{
		return date('Y', $time).'-'.date('m', $time).'-'.date('d', $time);
	}
}

function date_to_mysql($date,$is_date_thai = FALSE)
{
	list($d,$m,$y) = explode('-', $date);
	$y = ($is_date_thai) ? $y - 543 : $y;
	return $y.'/'.$m.'/'.$d;
}

function mysql_to_date($date,$is_date_thai = FALSE,$lang)
{
	$month['th'] = array('','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12');
	//$month['th'] = array('','01'=>'มกราคม','02'=>'กุมภาพันธ์','03'=>'มีนาคม','04'=>'เมษายน','05'=>'พฤษภาคม','06'=>'มิถุนายน','07'=>'กรกฏาคม','08'=>'สิงหาคม','09'=>'กันยายน','10'=>'ตุลาคม','11'=>'พฤศจิกายน','12'=>'ธันวาคม');
	$month['en'] = array('','01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');
	@list($y,$m,$d) = @explode('-', $date);
	$y = ($is_date_thai) ? $y + 543 : $y;
	return @$date ? $d.'/'.$month[$lang][$m].'/'.$y : NULL;
}

if(!function_exists('get_year_option'))
{
	function get_year_option($start,$plus = 0)
	{
		$year = (date('Y') + 543) + $plus;
		$data = array();
		for($year;$year >= $start;$year--)
		{
			$data[$year] = $year;
		}
		return $data;
	}
}

if(!function_exists('get_month'))
{
	function get_month()
	{
		return array('1'=>'มกราคาม','2'=>'กุมภาพันธ์','3'=>'มีนาคม','4'=>'เมษายน','5'=>'พฤษภาคม','6'=>'มิถุนายน','7'=>'กรกฏาคม','8'=>'สิงหาคม','9'=>'กันยายน','10'=>'ตุลาคม','11'=>'พฤศจิกายน','12'=>'ธันวาคม');
	}
}


if(!function_exists('stamp_to_th'))
{
	function stamp_to_th($timestamp)
	{
		if($timestamp > 0 )
		{
		$engdate = date('Y-m-d', $timestamp);
		$thaidate = mysql_to_date($engdate,TRUE);
		}
		else
		{
			$thaidate="";
		}
		return $thaidate;
	}
}
function en_to_stamp($date,$includeTime=FALSE)
{
	if($includeTime!= TRUE)
		{
			list($d, $m, $y) = explode("-", $date);
			$timestamp = strtotime($d . "-" . $m . "-" . $y);
		}else{
			$date = explode(" ",$date);
			list($d, $m, $y) = explode("-", $date[0]);
			$timestamp = strtotime($d . "-" . $m . "-" . $y." ".$date[1]);
		}
		return $timestamp;
}
if(!function_exists('th_to_stamp'))
{
	function th_to_stamp($thaidate,$includeTime = FALSE) 
	{
		if($thaidate=="")
		{
			$timestamp = 0;
		}
		else
		{
			if($includeTime!= TRUE)
			{
				list($d, $m, $y) = explode("-", $thaidate);
				$timestamp = strtotime($d . "-" . $m . "-" . ($y-543));
			}else{
				$date = explode(" ",$thaidate);
				list($d, $m, $y) = explode("-", $date[0]);
				$timestamp = strtotime($d . "-" . $m . "-" . ($y-543)." ".$date[1]);
			}
		}
		return $timestamp;
	}
}

if(!function_exists('stamp_to_th_fulldate'))
{
	function stamp_to_th_fulldate($timestamp)
	{
		if($timestamp > 0)
		{
		$th_date = date("Y-m-d", $timestamp);
		$th_date = db_to_th(date("Y-m-d H:i:s", $timestamp),FALSE,'F');
		}else{$th_date='';}
		return $th_date;
	}
}
if(!function_exists('stamp_to_th_abbrfulldate'))
{
	function stamp_to_th_abbrfulldate($timestamp)
	{
		$th_date = db_to_th(date("Y-m-d H:is", $timestamp),TRUE,'');
		return $th_date;
	}
}
?>