<?php
/**
 * Request_Rain_Log Model
 */
class Request_Rain_Log extends ORM {
	
	public $table = "ma_request_rain_log";
	
	public $has_one = array(		
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
			"other_field"	=> "help_status_id"
		),
		"request_rain"
	);
	
	function __construct($id=null) {
		parent::__construct($id);
		
		//	แบ่งให้เห็นเฉพาะศูนย์ที่กำหนด
		if(!permission("requests","view")) {
			$this->where_related("area_province","id",user()->operation_center_id);
		}
		
	}
}
