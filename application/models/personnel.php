<?php
/**
 * Menu Model
 * เมนู
 */
class Personnel extends ORM {

	var $table = "personnel";

	// var $has_one = array();

	// var $has_many = array();
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
