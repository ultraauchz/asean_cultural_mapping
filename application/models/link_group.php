<?php
/*
 * Link_Group Model
 */
class Link_Group extends ORM {

	var $table = "ma_link_group";

	var $has_many = array("link");

    function __construct($id = NULL)
	{
		parent::__construct($id);
    }
}