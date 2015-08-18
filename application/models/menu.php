<?php
/**
 * Menu Model
 * เมนู
 */
class Menu extends ORM {

	var $table = "acm_system_menus";

	// var $has_one = array();

	 var $has_many = array('system_log');
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
