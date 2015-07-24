<?php
/**
 * Menu Model
 * เมนู
 */
class Department extends ORM {

	var $table = "department";

	// var $has_one = array();

	// var $has_many = array();
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
