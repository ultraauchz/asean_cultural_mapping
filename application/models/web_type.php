<?php
/**
 * Menu Model
 * เมนู
 */
class Web_Type extends ORM {

	var $table = "ma_web_type";
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
