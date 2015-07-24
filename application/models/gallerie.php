<?php
/*.
 * Gallerie Model
 * อัลบั้มรูปภาพ
 */
class Gallerie extends ORM  {

	var $table = "ma_galleries";

	// var $has_one = array();

	var $has_many = array("image");

    function __construct($id = NULL)
	{
		parent::__construct($id);
    }

}