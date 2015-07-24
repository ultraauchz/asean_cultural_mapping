<?php
/**
 * Forum_Comment Model
 */
class Forum_Comment extends ORM {

	var $table = "ma_forum_comment";
	
	var $has_one = array("forum_topic","user");
	
	function __construct($id=null) {
		parent::__construct($id);
	}
	
}
