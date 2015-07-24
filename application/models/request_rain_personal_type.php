<?php
/**
 * Request_Rain_Personal_Type Model
 */
class Request_Rain_Personal_Type extends ORM {
	
	var $table = "ma_request_rain_personal_type";
	
	var $has_many = array("request_rain");
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
