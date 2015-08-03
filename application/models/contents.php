<?php
/*
 * Content Model
 */
class Contents extends ORM {

	var $table = "acm_contents";
	
    function __construct($id = NULL)
	{
		parent::__construct($id);
		// if($this->id!=true) {
			// $this->where("web_type_id",1);
		// }
    }
}