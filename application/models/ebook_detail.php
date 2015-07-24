<?php
/**
 * Ebook Model
 * หนังสืออิเล็กทรอนิกส์ หน้าแรก
 */
class Ebook_detail extends ORM {

	public $table = "ebook_detail";
	
	public $has_one = array(
		'ebook'
	);

    function __construct($id = NULL)
	{
		parent::__construct($id);
    }
	
}
