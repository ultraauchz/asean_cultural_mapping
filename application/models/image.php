<?php
/*
 * Image Model
 * รูปภาพใน Gallerie
 */
class Image extends ORM {

	var $table = "ma_images";

	var $has_one = array("gallerie");

	// var $has_many = array();

    function __construct($id = NULL) {
		parent::__construct($id);
    }
}