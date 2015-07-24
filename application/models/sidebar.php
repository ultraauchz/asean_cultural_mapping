<?php
/**
 * Sidebar Model
 */
class Sidebar extends ORM {

	var $table = "ma_sidebar";
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
