<?php
/**
 * Amphur Model
 */
class Amphur extends ORM {
	
	var $table = "ma_amphur";
	
	public $has_many = array(
		//	Set relation สำหรับที่อยู่
		"address_amphur_id"	=> array(
			"class"			=> "request_rain",
			"other_field"	=> "address_amphur"
		),
		
		//	Set relation สำหรับการติดต่อกลับ
		"recall_amphur_id"	=> array(
			"class"			=> "request_rain",
			"other_field"	=> "recall_amphur"
		),
		
		//	Set relation สำหรับพื้นที่ช่วยเหลือ
		"help_amphur_id"	=> array(
			"class"			=> "request_rain",
			"other_field"	=> "help_amphur"
		),
		"district","request_rain_area_amphur"
	);
	
	public $has_one = array("province");
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
