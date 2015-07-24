<?php
/**
 * Event Model
 * หน้าอื่นๆ
 */
class Event_type extends ORM {

	var $table = "ma_event_type";
	
	var $has_many = array("event");
	
    function __construct($id = NULL)
	{
		parent::__construct($id);
    }
	
}
