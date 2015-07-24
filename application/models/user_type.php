<?php
/**
 * User_Type Model
 */
class User_Type extends ORM {
	
	var $table = "ma_user_type";

	var $has_many = array("permission","user");
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
