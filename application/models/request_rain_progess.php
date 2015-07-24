<?php
/**
 * Request_Rain_Progess Model
 */
class Request_Rain_Progess extends ORM {
	
	public $table = "ma_request_rain_progess";
	
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
		"request_rain_status","request_rain","user"
	);

	public $has_many = array("request_rain_progess_amphur","request_rain_progess_province");
	
	function __construct($id=null) {
		parent::__construct($id);
		
		//	แบ่งให้เห็นเฉพาะศูนย์ที่กำหนด
		if(!permission("requests","view")) {
			//	$this->where_related("area_province","id",user()->operation_center_id);
		}
		
	}
}
