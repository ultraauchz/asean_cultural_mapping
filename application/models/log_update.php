<?php
/**
 * Log_Update Model
 */
class Log_Update extends ORM {
	
	var $table = "ma_update_log";
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
