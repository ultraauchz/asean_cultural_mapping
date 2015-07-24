<?php
/**
 * Request_Rain_Delight_Status Model
 */
class Request_Rain_Delight_Status extends ORM {
	
	public $table = "ma_request_rain_delight_status";

	public $has_many = array("request_rain");
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
