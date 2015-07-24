<?php
/**
 * Province Model
 */
class Province extends ORM {

	var $table = "ma_province";
	
	public $has_many = array(
		//	Set relation สำหรับที่อยู่
		"address_province_id"	=> array(
			"class"			=> "request_rain",
			"other_field"	=> "address_province"
		),
		
		//	Set relation สำหรับพื้นที่ขอฝน
		"area_province_id"	=> array(
			"class"			=> "request_rain",
			"other_field"	=> "area_province"
		),
		
		//	Set relation สำหรับการติดต่อกลับ
		"recall_province_id"	=> array(
			"class"			=> "request_rain",
			"other_field"	=> "recall_province"
		),
		
		//	Set relation สำหรับพื้นที่ช่วยเหลือ
		"help_province_id"	=> array(
			"class"			=> "request_rain",
			"other_field"	=> "help_province"
		),
		"amphur","district","request_rain_area_province"
	);
	
	public $has_one = array("operation_center");
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
