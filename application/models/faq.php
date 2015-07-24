<?php
/**
 * Hilight Model
 * ไฮไลท์สไลด์หน้าแรก
 */
class Faq extends ORM {

	var $table = "ma_faqs";
	
	var $has_one = array("faq_group");

    function __construct($id = NULL)
	{
		parent::__construct($id);
    }
	
}
