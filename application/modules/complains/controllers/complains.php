<?php
/**
 * Complains Controllers
 */
class Complains extends Base_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$this->template->build("index", @$data);
	}
		public function goption_address($type = false, $parent_id = false) {
			if(empty($type) || empty($parent_id)) {
				echo 'empty';
			} else {
				//Get data sector.
				//--อำเภอ
				if($type == 'amphur') {
					$option = new Amphur();
					$option->where('province_id', $parent_id)->get();
					$option_df = '-อำเภอ-';
				}
				//--ตำบล
				if($type == 'district') {
					$option = new District();
					$option->where('amphur_id', $parent_id)->get();
					$option_df = '-ตำบล-';					
				}
				
				//Echo sector.
				if(count($option->all) == 0) {
					echo 'empty';
				} else {
					echo '<option value="">'.$option_df.'</option>';
					foreach($option as $item) {
						echo '<option value="'.$item->id.'">'.$item->title.'</option>';
					}
				}
			}
		}
	
	public function save() {
		$error = array('status'=>0);
		$_POST['idcard'] = join($_POST['idcard']);
		
		//Validate
		$validate[] = array((empty($_POST['firstname']) || empty($_POST['lastname'])), 'ไม่ระบุ ชื่อ, นามสกุลของผู้ร้องเรียน');
		$validate[] = array((empty($_POST['idcard']) || strlen($_POST['idcard']) != 13), 'ไม่ระบุข้อมูลรหัสบัตรประชาชน หรือ ระบุไม่ถูกต้อง');
		$validate[] = array((empty($_POST['address']) || empty($_POST['province']) || empty($_POST['district'])), 'ไม่ระบุที่อยู่ของผู้ร้องเรียน');
		$validate[] = array((empty($_POST['basicphone']) && empty($_POST['mobilephone']) && empty($_POST['faxnumber']) && empty($_POST['email'])), 'ไม่ระบุข้อมูลที่อยู่ของผู้ร้องเรียน');
		$validate[] = array((empty($_POST['offender'])), 'ไม่ระบุข้อมูลผู้ถูกร้องเรียน');
		$validate[] = array((empty($_POST['detail'])), 'ไม่ระบุข้อมูลรายละเอียดการร้องเรียน');
		
		foreach($validate as $key=>$item) {
			$error = ($item[0] && $error['status'] != 1)?array('status'=>1, 'msg'=>$item[1]):$error;
		}
		
		/*
		if($error['status'] == 1) {
			//set_notify('error', 'ไม่สามารถบันทึกข้อมูลได้เนื่องจาก '.$error['msg']);
			redirect('complains');
		}*/
		//end-validate
		
		
		
		$_POST['status_complain'] = 0;
		$_POST['status_result'] = 0;
		$_POST['ipaddress'] = (@getenv(HTTP_X_FORWARDED_FOR)) ? @getenv(HTTP_X_FORWARDED_FOR):@getenv(REMOTE_ADDR);
		
		$data['rs'] = new Complain();
		$data['rs']->from_array($_POST);
		$data['rs']->save();

		#$title = 'เรื่องร้องเรียน';
		#	sendmail($title, $this->load->view("alertview", @$data), $data['rs']->email);
		redirect('');
	}
}
