<?php
/**
 * Request_Rain_Status Model
 */
class Request_Rain_Status extends ORM {
	
	public $table = "ma_request_rain_status";
	
	public $has_many = array(
		"status_id" => array(
			"class"			=> "request_rain",
			"other_field"	=> "status"
		),
		"help_status_id" => array(
			"class"			=> "request_rain_log",
			"other_field"	=> "help_status"
		),
		
		"request_rain_progess"
	);
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
