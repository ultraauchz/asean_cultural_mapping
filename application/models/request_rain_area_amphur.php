<?php
/**
 * Request_Rain_Area
 */
class Request_Rain_Area_Amphur extends ORM {
	
	var $table = "ma_request_rain_area_amphur";
	
	var $has_one = array(
			"amphur",
			"request_rain",
			"request_rain_area_province"
		);
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
