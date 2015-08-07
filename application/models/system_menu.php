<?php
class System_menu extends ORM {

	var $table = "acm_system_menus";
	
    function __construct($id = NULL)
	{
		parent::__construct($id);
    }
}