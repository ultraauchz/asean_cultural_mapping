<?php
/*
 * Content Model
 */
class Content extends ORM {

	var $table = "ma_content";

	var $has_one = array("content_group");

	var $has_many = array("content_comment");
	
    function __construct($id = NULL)
	{
		parent::__construct($id);
		if($this->id!=true) {
			$this->where("web_type_id",1);
		}
    }
}