<?php
/**
 * Heritage Model
 * 
 */
class Heritage_Organization extends ORM {

	var $table = "acm_heritage_organization";
	public $has_one = array("heritage");
	public $has_many = array("organization");

    function __construct($id = NULL)
	{
		parent::__construct($id);
    }
	
}
