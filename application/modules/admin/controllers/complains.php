<?php
/**
 * Complains Controllers
 */
class Complains extends Admin_Controller {
	
	function __construct() {
		parent::__construct();
		if(!permission("complains","views")) {
			redirect("admin");
		}
	}
	public $status_complain_text = array(
		'0'=>'รอการตรวจสอบเบื้องต้น',
		'1'=>'ตั้งกรรมการสอบ',
		'2'=>'ดำเนินการสอบสวน',
		'3'=>'สรุปผลการสอบ',
		'4'=>'ลงโทษ',	
		'5'=>'รายงานผล',
		'6'=>'บันทึกความก้าวหน้า',
		'7'=>'รายงานสรุป',
		'8'=>'รายงานกรม',
		'9'=>'แจ้งผู้ร้องเรียน',
		'10'=>'จบการทำงาน'
	);
	
	public $status_result_text = array(
		'0'=>'รอดำเนินการ',
		'1'=>'ไม่ผิด เนื่องจากไม่มีมูล',
		'2'=>'ดำเนินการสอบสวนแล้วพบว่าไม่ผิด',
		'3'=>'ดำเนินการสอบสวนแล้วพบว่ามีความผิดจริง'
	);
	
	public $rdo1_text = array(
		1 => 'ต้องการให้ติดต่อกลับ',
		2 => 'ไม่ต้องการให้ติดต่อกลับ'
	);
	
	public $rdo2_text = array(
		1 => 'ที่อยู่',
		2 => 'E-mail',
		3 => 'โทรศัพท์บ้าน',
		4 => 'โทรศัพท์มือถือ'
	);
	
	public $rdo2_field = array(
		1 => 'address',
		2 => 'email',
		3 => 'basicphone',
		4 => 'mobilephone'
	);
	
	public $rdo3_text = array(
		1 => 'เรื่องร้องเรียนนี้อยู่ในชั้นศาล',
		2 => 'เรื่องร้องเรียนนี้ไม่อยู่ในชั้นศาล'
	);
	/*
	 * $data['rdo1_text'] = $this->rdo1_text;
		$data['rdo2_text'] = $this->rdo2_text;
		$data['rdo3_text'] = $this->rdo3_text;
		$data['rdo2_field'] = $this->rdo2_field;*/
	
	public function static_data() {
		$data['status_complain_text'] =  $this->status_complain_text;
		$data['status_result_text'] = $this->status_result_text;
		
		$data['rdo1_text'] = $this->rdo1_text;
		$data['rdo2_text'] = $this->rdo2_text;
		$data['rdo3_text'] = $this->rdo3_text;
		$data['rdo2_field'] = $this->rdo2_field;
		
		return $data;
	}
		
	public function index() {
		if(permission("complains","views")) {
			$data = $this->static_data();
			
			$data['rs'] = new Complain();
			$data['rs']->order_by('id', 'desc')->get_page();
			$data['no'] = 0;
			
			$this->template->build("complains/index", @$data);
		} else {
			redirect("admin");
		}
	}

	public function detail($id = null) {
		if(permission("complains","views")) {
			
			if(!$id) {
				redirect('admin/complains');
			}
			
			$data = $this->static_data();
			
			$data['rs'] = new Complain($id);
			
			//Progress lists
			$pg_qry = "select 
				ma_user.firstname, 
				ma_user.lastname,
				ma_complain_progress.detail,
				ma_complain_progress.created
			from ma_complain_progress 
				join ma_user on ma_complain_progress.ma_user_id = ma_user.id
			where ma_complain_progress.ma_complain_id = '".$data['rs']->id."'
			order by ma_complain_progress.created desc";
			$data['pg'] = $this->db->query($pg_qry);
			
			$this->template->build('complains/detail', @$data);
		} else {
			redirect("admin/complains");
		}
	}
	
	public function save($id = null) {
		if(permission("complains","views")) {
			if(!$id) {
				redirect('admin/complains');
			}
					
			$data['rs'] = new Complain($id);
			$data['rs']->from_array($_POST);
			$data['rs']->save();
			if($_POST['send_mail'] == 1) {
				$title = "แจ้งผลการร้องเรียน : ".$data['rs']->offender;
				$detail = "<div><strong>การการร้องเรียน : </strong>".$data['rs']->offender.'</div>';
				$detail .= "<div><strong>รายละเอียด : </strong>".$data['rs']->detail."</div>";
				$detail .= "<div><strong>ผลลัพธ์การร้องเรียน : </strong>".$this->status_result_text[$data['rs']->status_result]."</div>";
				
				sendmail($title, $detail, $data['rs']->email);
				
				$_GET['ma_user_id'] = user()->id;
				$_GET['ma_complain_id'] = $data['rs']->id;
				$_GET['detail'] = "ดำเนินการแจ้งผลการร้องเรียน ผ่านทาง E-mail";
				$data = new Complain_progress();
				$data->from_array($_GET);
				$data->save();
			}
		}
		redirect('admin/complains');
	}

	//Progress
	public function list_progress($id = null) {
		if(permission("complains","views")) {
			$data['month_th'] = array(
				"0"=>"",
				"1"=>"มกราคม",
				"2"=>"กุมภาพันธ์",
				"3"=>"มีนาคม",
				"4"=>"เมษายน",
				"5"=>"พฤษภาคม",
				"6"=>"มิถุนายน",	
				"7"=>"กรกฎาคม",
				"8"=>"สิงหาคม",
				"9"=>"กันยายน",
				"10"=>"ตุลาคม",
				"11"=>"พฤศจิกายน",
				"12"=>"ธันวาคม"					
			);
			//Progress lists
			$pg_qry = "select 
				ma_user.firstname, 
				ma_user.lastname,
				ma_complain_progress.detail,
				ma_complain_progress.created
			from ma_complain_progress 
				join ma_user on ma_complain_progress.ma_user_id = ma_user.id
			where ma_complain_progress.ma_complain_id = '".$id."'
			order by ma_complain_progress.created desc";
			$data['pg'] = $this->db->query($pg_qry);
			$this->load->view('complains/list_progress', $data);
		} else {
			redirect("admin/complains");
		}
	}

	public function save_progress() {
		if(permission("complains","views")) {
			$_GET['ma_user_id'] = user()->id;
					
			$data = new Complain_progress();
			$data->from_array($_GET);
			$data->save();
		}
	}
}
