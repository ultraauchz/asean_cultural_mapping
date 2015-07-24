<?php
/**
 * Permission Model
 */
class Permission extends ORM {
	
	var $table = "ma_permission";
	
	var $has_one = array("user_type");
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
