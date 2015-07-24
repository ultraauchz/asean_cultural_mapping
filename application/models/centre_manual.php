<?php
/**
 * Centre_Manual Model
 */
class Centre_Manual extends ORM {
	
	public $table = "ma_centre_manual";
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
