<?php
/*
 * Content Model
 */
class State extends ORM {

	var $table = "acm_state";
	var $has_one = array('country');
    
    function __construct($id = NULL)
	{
		parent::__construct($id);
    }
}