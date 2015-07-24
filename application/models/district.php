<?php
/**
 * District Model
 */
class District extends ORM {
	
	var $table = "ma_district";
	
	public $has_many = array(
		//	Set relation สำหรับที่อยู่
		"address_district_id"	=> array(
			"class"			=> "request_rain",
			"other_field"	=> "address_district"
		),
		
		//	Set relation สำหรับการติดต่อกลับ
		"recall_district_id"	=> array(
			"class"			=> "request_rain",
			"other_field"	=> "recall_district"
		),
		
		//	Set relation สำหรับพื้นที่ช่วยเหลือ
		"help_district_id"	=> array(
			"class"			=> "request_rain",
			"other_field"	=> "help_district"
		)
	);
	
	public $has_one = array("province","amphur");
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
