<?php
/**
 * Centre_Page Model
 */
class Centre_Page extends ORM {
	
	public $table = "ma_centre_page";
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
