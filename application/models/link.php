<?php
/**
 * Link Model
 * ลิ้งเว็บไซต์
 */
class Link extends ORM {

	var $table = "ma_links";
	
	var $has_one = array("link_group");

    function __construct($id = NULL)
	{
		parent::__construct($id);
    }
	
}
