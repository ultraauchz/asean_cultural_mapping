<?php
/*
 * Content_Group Model
 */
class Content_Group extends ORM {

	var $table = "ma_content_group";

	var $has_many = array("content");

    function __construct($id = NULL)
	{
		parent::__construct($id);
		if($this->id!=true) {
			$this->where("web_type_id",1);
		}
    }
}