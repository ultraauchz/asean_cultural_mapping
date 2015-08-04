<?php
class Network extends ORM {

	var $table = "acm_network";

	 var $has_one = array();

	 var $has_many = array('network_org'
	 				
	 );
	
	function __construct($id=null) {
		parent::__construct($id);
	}
}
