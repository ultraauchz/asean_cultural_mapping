<?php
/**
 * Ebook Model
 * หนังสืออิเล็กทรอนิกส์ หน้าแรก
 */
class Ebook extends ORM {

	public $table = "ebook";
	public $has_one = array(
		'ebook_group'
	);
	public $has_many = array(
		'ebook_detail'
	);
    function __construct($id = NULL)
	{
		parent::__construct($id);
    }
	
}
