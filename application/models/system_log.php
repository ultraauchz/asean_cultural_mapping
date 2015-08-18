<?php
/**
 * Heritage Model
 * 
 */
class System_Log extends ORM {

	var $table = "acm_system_log";
	public $has_one = array("user","menu");
	//public $has_many = array("menu");

    function __construct($id = NULL)
	{
		parent::__construct($id);
    }
	
}
