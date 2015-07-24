<?php
/**
 * Module model
 */
class Module extends ORM {
	
	public $table = "ma_module";
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
