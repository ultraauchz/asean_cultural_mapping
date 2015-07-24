<?php
/*
 *	Function calculate birthday to age
*/
if(!function_exists("date_calculate_age")) {
	function date_calculate_age($birthday,$month=false) {
		$result = null;
		$x = strtotime($birthday);
		$y = strtotime(date("Y-m-d"));

		list($y1,$m1,$d1) = explode("-", date("Y-m-d",$x));
		list($y2,$m2,$d2) = explode("-", date("Y-m-d",$y));

		$year = $y2-$y1;
		$month = $m2-$m1;
		$day = $d2-$d1;

		if((int)($m2.$d2)<(int)($m1.$d1)) {
			$year -= 1;
		}

		$result = $year." ปี";

		if($month==true) {
			$result .= " ".$month." เดือน";
		}

		return $result;
	}
}

/*
 *	Function get time relative
*/
if(!function_exists("mysql_to_relative")) {
	function mysql_to_relative($timestamp) {
		$timestamp = mysql_to_unix($timestamp);
		$difference = time() - $timestamp;
		$periods = array("วินาที", "นาที", "ชั่วโมง", "วัน", "สัปดาห์","เดือน", "ปี", "สิบปี");
		$lengths = array("60","60","24","7","4.35","12","10");
		
		if ($difference > 0) {
			// this was in the past
			$ending = "ที่ผ่านมา";
		} else {
			// this was in the future
			$difference = -$difference;
			$ending = "to go";
		}
		
		for($j = 0; $difference >= $lengths[$j]; $j++) {
			$difference /= $lengths[$j];
		}
		
		$difference = round($difference);
		$text = "$difference $periods[$j]$ending";
		return $text;
	}
}

/*
 *	Function get time thai text
*/
if(!function_exists('mysql_to_th')) {
	function mysql_to_th($datetime = '',$format = 'S' ,$time = FALSE) {
		
		if($datetime == '0000-00-00' || $datetime=='') {
			return false;
		}
		
		if($format == 'F') {
			$month_th = array(
				1  => 'มกราคม',
				2  => 'กุมภาพันธ์',
				3  => 'มีนาคม',
				4  => 'เมษายน',
				5  => 'พฤษภาคม',
				6  => 'มิถุนายน',
				7  => 'กรกฏาคม',
				8  => 'สิงหาคม',
				9  => 'กันยายน',
				10 => 'ตุลาคม',
				11 => 'พฤศจิกายน',
				12 => 'ธันวาคม'
			);
		} else {
			$month_th = array(
				1  => 'ม.ค.',
				2  => 'ก.พ.',
				3  => 'มี.ค.',
				4  => 'เม.ย',
				5  => 'พ.ค.',
				6  => 'มิ.ย',
				7  => 'ก.ค.',
				8  => 'ส.ค.',
				9  => 'ก.ย.',
				10 => 'ต.ค.',
				11 => 'พ.ย.',
				12 => 'ธ.ค.'
			);
		}
		
		$datetime = mysql_to_unix($datetime);
		
		$r = date('d', $datetime).' '.$month_th[date('n', $datetime)].' '.(date('Y', $datetime) + 543); 

		if($time) {
			$r .= ' - '.date('H', $datetime).':'.date('i', $datetime).' น.';
		}
	
		return $r;
	}
}