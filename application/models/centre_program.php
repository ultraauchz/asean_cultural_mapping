<?php
/**
 * Centre_Program Model
 */
class Centre_Program extends ORM {
	
	public $table = "ma_centre_program";
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
