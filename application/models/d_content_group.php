<?php
/*
 * Content_Group Model
 */
class D_Content_Group extends ORM {

	var $table = "d_content_group";

	var $has_many = array("d_content");

    function __construct($id = NULL)	{
		parent::__construct($id);
    }
}