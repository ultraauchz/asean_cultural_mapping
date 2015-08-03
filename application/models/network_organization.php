<?php
/*
 * Content Model
 */
class Network_Organization extends ORM {

	var $table = "acm_network_orgs";
	
	var $has_many = array("network","organization");
	
    function __construct($id = NULL)
	{
		parent::__construct($id);
    }
}