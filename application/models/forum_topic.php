<?php
/**
 * Forum_Topic Model
 */
class Forum_Topic extends ORM {

	var $table = "ma_forum_topic";
	
	var $has_one = array("user");

	var $has_many = array("forum_comment");
	
    function __construct($id = NULL)
	{
		parent::__construct($id);
    }
	
}
