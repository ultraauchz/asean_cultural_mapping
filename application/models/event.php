<?php
/**
 * Event Model
 * หน้าอื่นๆ
 */
class Event extends ORM {

	var $table = "ma_event";
	
	var $has_one = array("event_type");
	
    function __construct($id = NULL)
	{
		parent::__construct($id);
    }
	
}
