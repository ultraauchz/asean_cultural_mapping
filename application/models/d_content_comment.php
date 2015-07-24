<?php
/*
 * Content Model
 */
class D_Content_comment extends ORM {

	var $table = "d_content_comment";

	var $has_one = array("d_content");

    function __construct($id = NULL)	{
		parent::__construct($id);
    }
}