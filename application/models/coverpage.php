<?php
/**
 * Coverpage Model
 */
class Coverpage extends ORM {
	
	var $table = "ma_coverpage";
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
