<?php
/**
 * Uploader Libraries
 */
require_once(APPPATH."libraries/class.upload.php");
 
class Uploader extends upload {
	
	function __construct() {
		log_message("debug", get_class($this)." Class Initialized");
	}
}
