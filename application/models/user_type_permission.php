<?php
/**
 * User_Type Model
 */
class User_Type_Permission extends ORM {
	
	var $table = "acm_user_type_permission";

	var $has_many = array("user_type","user");
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
