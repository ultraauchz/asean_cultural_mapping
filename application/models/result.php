<?php
/**
 * Result Model
 */
class Result extends ORM {
	
	public $table = "ma_result";
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
