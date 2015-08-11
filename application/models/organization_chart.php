<?php
class Organization_Chart extends ORM {

	var $table = "acm_organization_chart";
	
	var $has_one = array('country');	
	
    function __construct($id = NULL)
	{
		parent::__construct($id);
    }
}