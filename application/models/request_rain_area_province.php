<?php
/**
 * Request_Rain_Area
 */
class Request_Rain_Area_Province extends ORM {
	
	var $table = "ma_request_rain_area_province";
	
	var $has_one = array(
			"province",
			"request_rain"
		);

	var $has_many = array("request_rain_area_amphur");
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
