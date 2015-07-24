<?php
/*
 * Content Model
 */
class Contact_us extends ORM {

	var $table = "ma_contact_us";
	
    function __construct($id = NULL)
	{
		parent::__construct($id);
    }
}