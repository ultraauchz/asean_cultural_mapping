<?php
/*
 * Content Model
 */
class Complain_progress extends ORM {
	var $table = "ma_complain_progress";
	
	#public $has_one = array('complain');

    function __construct($id = NULL)
	{
		parent::__construct($id);
    }
}