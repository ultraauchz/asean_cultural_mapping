<?php
/*
 * Content Model
 */
class Organization extends ORM {

	var $table = "acm_organization";
	
	var $has_one = array("country");
	
	var $has_many = array('network_organization');
	
    function __construct($id = NULL)
	{
		parent::__construct($id);
    }
}