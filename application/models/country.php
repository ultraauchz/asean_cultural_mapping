<?php
/*
 * Content Model
 */
class Country extends ORM {

	var $table = "acm_country";
	var $has_one = array("organization_chart");
	var $has_many = array("organization", "state", "heritage");
    
    function __construct($id = NULL)
	{
		parent::__construct($id);
    }
}