<?php
/**
 * Operation_Center Model
 */
class Operation_Center extends ORM {
	
	public $table = "ma_operation_center";
	
	public $has_many = array("province","user","request_rain");
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
