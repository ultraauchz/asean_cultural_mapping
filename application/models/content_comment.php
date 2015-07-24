<?php
/*
 * Content Model
 */
class Content_comment extends ORM {

	var $table = "ma_content_comment";

	var $has_one = array("content");

    function __construct($id = NULL)
	{
		parent::__construct($id);
    }
}