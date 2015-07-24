<?php
/**
 * Request_Rain_Progess_Province Model
 */
class Request_Rain_Progess_Province extends ORM {

	var $table = 'ma_request_rain_progess_province';
	
	var $has_one = array(
			"province",
			"request_rain",
			"request_rain_progess"
		);

	var $has_many = array();
	
	public function __construct($id=null) {
		parent::__construct($id);
	}
}