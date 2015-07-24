<?php
/**
 * Ebook Model
 * หนังสืออิเล็กทรอนิกส์ หน้าแรก
 */
class Log extends ORM {

	public $table = "log";

	public $has_one = array("user");

    function __construct($id = NULL)
	{
		parent::__construct($id);
    }
	
}
