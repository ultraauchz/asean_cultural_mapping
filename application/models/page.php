<?php
/**
 * Page Model
 * หน้าอื่นๆ
 */
class Page extends ORM {

	var $table = "ma_page";

    function __construct($id = NULL)
	{
		parent::__construct($id);
    }
	
}
