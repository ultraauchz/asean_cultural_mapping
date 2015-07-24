<?php
/**
 * Ebook Model
 * หนังสืออิเล็กทรอนิกส์ หน้าแรก
 */
class Ebook_info extends ORM {

	public $table = "ebook_info";

    function __construct($id = NULL)
	{
		parent::__construct($id);
    }
	
}
