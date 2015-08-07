<?php
/*
 * Content Model
 */
class Network_Org extends ORM {

	var $table = "acm_network_org";
	var $has_one = array('network');	
	var $has_many = array('organization');
	
    function __construct($id = NULL)
	{
		parent::__construct($id);
    }
}