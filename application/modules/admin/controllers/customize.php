<?php
/**
 * Customize Controller
 */
class Customize extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	public function form_dynamic() {
		$this->template->build("customize/form_dynamic");
	}
	
	public function save_dynamic() {		
		natsort($_POST["round_meeting"]);
		debug($_POST);
		
		foreach ($_POST["round_meeting"] as $key => $value) {
			//	echo $_POST["round_meeting"][$key]." | ".mysql_to_th($_POST["date_meeting"][$key],"F",false)." | ".$_POST["balance"][$key]."<br />";
		}
		
		$foo = 0;
		$check = array();
		for ($i=0; $i <count($_POST["balance"]) ; $i++) {
			for ($x=0; $x < $i; $x++) { 
				if($_POST["balance"][$i]==$_POST["balance"][$x]) {
					$foo = 1;
				}
			}
		}
		
		if($foo==1) {
			echo "FALSE";
		} else {
			echo "TRUE";
		}
		
	}
	
}
