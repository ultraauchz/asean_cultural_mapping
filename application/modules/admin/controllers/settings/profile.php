<?php
/**
 * Profile Controller
 */
class Profile extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
	}

	public function index()
	{
		$data['value'] = new User(user()->id);
		$this->template->build('profile',$data);
	}

	public function save($id=null)
	{
		if($_POST) {
			$data = new User(user()->id);

			if((!empty($_POST["password"])) && ($_POST["password"]===$_POST["passwords"])) {
				$data->passwords = encrypt_password(strip_tags(trim($_POST["passwords"])));
			}

			$data->firstname = strip_tags(trim($_POST["firstname"]));
			$data->lastname = strip_tags(trim($_POST["lastname"]));
			$data->email = strip_tags(trim($_POST["email"]));
			$data->tel = strip_tags(trim($_POST["tel"]));
			$data->per_cardno = @trim($_POST["per_cardno"]);

			$data->save();
		}
		redirect('admin/settings/profile');
	}

}