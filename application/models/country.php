<?php
/*
 * Content Model
 */
class Country extends ORM {

	var $table = "acm_country";
	var $has_many = array("organization", "state");
    
    function __construct($id = NULL)
	{
		parent::__construct($id);
    }
}