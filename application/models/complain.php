<?php
/*
 * Content Model
 */
class Complain extends ORM {
	var $table = "ma_complain";
	
	#public $has_many = array('complain_progress');

    function __construct($id = NULL)
	{
		parent::__construct($id);
    }
}