<?php
/**
 * Menu Model
 * เมนู
 */
class Menu extends ORM {

	var $table = "ma_menu";

	// var $has_one = array();

	// var $has_many = array();
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
