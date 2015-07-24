<?php
/**
 * Web_Layout Model
 */
class Web_Layout extends ORM {
	
	public $table = "ma_web_layout";
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
