<?php
/**
 * Hilight Model
 * ไฮไลท์สไลด์หน้าแรก
 */
class Hilight extends ORM {

	var $table = "ma_hilight";

    function __construct($id = NULL)
	{
		parent::__construct($id);
    }
	
}
