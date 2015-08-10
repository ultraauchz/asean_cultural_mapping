<?php
/**
 * Heritage Model
 * 
 */
class Heritage extends ORM {

	var $table = "acm_heritage";
	
	public $has_many = array("heritage_image","heritage_organization");

    function __construct($id = NULL)
	{
		parent::__construct($id);
    }
	
}
