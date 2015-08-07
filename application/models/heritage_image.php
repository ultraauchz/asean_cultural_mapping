<?php
/**
 * Heritage_image Model
 * 
 */
class Heritage_image extends ORM {

	var $table = "acm_heritage_images";
	
	public $has_one = array("heritage");

    function __construct($id = NULL)
	{
		parent::__construct($id);
    }
	
}
