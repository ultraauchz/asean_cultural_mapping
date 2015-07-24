<?php
/*
 * Faq_Group Model
 */
class Faq_Group extends ORM {

	var $table = "ma_faq_group";

	var $has_many = array("faq");

    function __construct($id = NULL)
	{
		parent::__construct($id);
    }
}