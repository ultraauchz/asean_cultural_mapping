<?php
class Network extends ORM {

	var $table = "acm_networks";

	// var $has_one = array();

	 var $has_many = array('network_organization');
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
