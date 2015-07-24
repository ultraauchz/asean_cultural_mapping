<?php
/**
 * Request_Rain_Progess_Amphur Model
 */
class Request_Rain_Progess_Amphur extends ORM {

	var $table = 'ma_request_rain_progess_amphur';
	
	var $has_one = array(
			"amphur",
			"request_rain",
			"request_rain_progess"
		);

	var $has_many = array();
	
	public function __construct($id=null) {
		parent::__construct($id);
	}
}