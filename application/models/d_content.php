<?php
/*
 * Content Model
 */
class D_Content extends ORM {

	var $table = "d_content";

	var $has_one = array("d_content_group");

	//var $has_many = array("content_comment");
	
    function __construct($id = NULL)	{
		parent::__construct($id);
    }
}