<?php
/**
 * Video Model
 */
class Video extends ORM {
	
	var $table = "ma_video";
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
