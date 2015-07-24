<?php
/**
 * Ebook Model
 * หนังสืออิเล็กทรอนิกส์ หน้าแรก
 */
class Ebook_group extends ORM {

	public $table = "ebook_group";
	public $has_many = array(
		'ebook'
	);
    function __construct($id = NULL)
	{
		parent::__construct($id);
    }
	
}
