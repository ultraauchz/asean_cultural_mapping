<?php
/*
 * Content Model
 */
class Setting extends ORM {

	var $table = "ma_setting";
	
    function __construct($id = NULL)
	{
		parent::__construct($id);
    }
}