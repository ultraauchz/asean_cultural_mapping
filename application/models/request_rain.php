<?php
/**
 * Request_Rain Model
 */
class Request_Rain extends ORM {
	
	public $table = "ma_request_rain";
	
	public $has_many = array(
			"request_rain_log",
			"request_rain_numeral",
			"request_rain_area",
			"request_rain_progess",
			"request_rain_area_amphur",
			"request_rain_area_province",
			"request_rain_progess_amphur",
			"request_rain_progess_province"
		);
	
	public $has_one = array(
		//	Set relation สำหรับที่อยู่
		"address_district"	=> array(
			"class"			=> "district",
			"other_field"	=> "address_district_id"
		),
		"address_amphur"	=> array(
			"class"			=> "amphur",
			"other_field"	=> "address_amphur_id"
		),
		"address_province"	=> array(
			"class"			=> "province",
			"other_field"	=> "address_province_id"
		),
		
		//	Set relation สำหรับพื้นที่ขอฝน
		"area_province"	=> array(
			"class"			=> "province",
			"other_field"	=> "area_province_id"
		),
		
		//	Set relation สำหรับการติดต่อกลับ
		"recall_district"	=> array(
			"class"			=> "district",
			"other_field"	=> "recall_district_id"
		),
		"recall_amphur"	=> array(
			"class"			=> "amphur",
			"other_field"	=> "recall_amphur_id"
		),
		"recall_province"	=> array(
			"class"			=> "province",
			"other_field"	=> "recall_province_id"
		),	
		
		//	Set relation สำหรับพื้นที่ช่วยเหลือ
		"help_district"	=> array(
			"class"			=> "district",
			"other_field"	=> "help_district_id"
		),
		"help_amphur"	=> array(
			"class"			=> "amphur",
			"other_field"	=> "help_amphur_id"
		),
		"help_province"	=> array(
			"class"			=> "province",
			"other_field"	=> "help_province_id"
		),
		
		//	Set relation สำหรับสถานะ
		"status"	=> array(
			"class"			=> "request_rain_status",
			"other_field"	=> "status_id"
		),
		"personal_type","request_rain_delight_status","operation_center"
	);
	
	function __construct($id=null) {
		parent::__construct($id);
		
	}
}
