<?php
/*
 *	Slide Model
 */
class Slide extends ORM {

	var $table = "ma_slidetext";

	public function __construct($id=null) {
		parent::__construct($id);
	}

}