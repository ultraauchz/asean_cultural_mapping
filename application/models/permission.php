<?php
/**
 * Permission Model
 */
class Permission extends ORM {
	
	var $table = "acm_permissions";
	
	var $has_one = array("acm_user_types");
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
