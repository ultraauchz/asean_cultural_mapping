<?php
/**
 * Service Controller
 */
class Service extends Base_Controller {

	public function __construct() {
		parent::__construct();
		if(now()<=REQUEST_START) {
			redirect('index');
		}
	}

	public function index()	// หน้าแรก
	{
		$this->template->build("index");
	}

	public function search() //	หน้าค้นหา
	{
		$data["variable"] = new Request_Rain();
		$data["variable"]->where("personal_id",$_GET["v"])->where("personal_id IS NOT NULL AND personal_id<>''");
		$data["variable"]->order_by('id','DESC')->get_page();
		$this->template->build("search",$data);
	}

	public function activation() {
		$this->template->build('activation');
	}

	public function form() // หน้าฟอร์ม
	{
		//Get activation data from accept form.
		if(!empty($_POST['activation'])) {
			$this->session->set_flashdata('activation', true);
			redirect('service/form');
		}

		//Check flashdata "activation"
		if(!$this->session->flashdata('activation')) {
			redirect('service');
		}

		$data['uid'] = uniqid(); //	สุ่ม uniquid มาใส่ใน input จังหวัดที่ต้องการขอ
		$this->template->build('form',$data);
	}

	public function send() // ส่งค่าจากฟอร์ม
	{
		if(@$_POST) {
			$error = 0;
			$personal_id = null;
			$recall_personal_id = null;
			$msg = null;
			$error_personal_id = 0;
			$error_recall_personal_id = 0;

			//	check รหัสบัตรประชาชน
			if(!is_numeric($_POST["personal_id"])) {
				$error = 1;
				$msg .= "กรุณาใส่รหัสบัตรประชาชนให้ถูกต้อง<br />";
			}

			//	check สถานะผู้ร้องขอ
			if(@$_POST["personal_type_id"]==null) {
				$error = 1;
				$msg .= "กรุณาเลือกสถานะของผู้ร้องขอ<br />";
			}

			//	check format email
			if(@($_POST["email"])) {
				//	check email format
				if(!(filter_var($_POST["email"],FILTER_VALIDATE_EMAIL))) {
					$error = 1;
					$msg .= "กรุณาระบุอีเมลให้ถูกต้อง<br />";
				}
			}

			//	check อายุ
			if(@$_POST["age"]==null || !is_numeric($_POST["age"])) {
				$error = 1;
				$msg .= "กรุณาระบุอายุให้ถูกต้อง<br />";
			}

			//	check เบอร์โทรศัพท์
			if(!@$_POST["tel_number"]) {
				$error = 1;
				$msg .= "กรุณาระบุหมายเลขโทรศัพท์<br />";
			}

			if(!@$_POST["address_number"]) {
				$error = 1;
				$msg .= "กรุณาระบุบ้านเลขที่<br />";
			}

			if(!@$_POST["address_province_id"]) {
				$error = 1;
				$msg .= "กรุณาเลือกจังหวัด<br />";
			}

			if(!@$_POST["address_amphur_id"]) {
				$error = 1;
				$msg .= "กรุณาเลือกเขต/อำเภอ<br />";
			}

			if(!@$_POST["address_district_id"]) {
				$error = 1;
				$msg .= "กรุณาเลือกแขวง/ตำบล<br />";
			}

			//	รายละเอียดการติดต่อกลับ
			if(@$_POST["recall_type"]==2) {

				if(!@$_POST["recall_firstname"]) {
					$error = 1;
					$msg .= "กรุณาระบุชื่อผู้ที่ต้องการให้ติดต่อกลับ<br />";
				}

				if(!@$_POST["recall_lastname"]) {
					$error = 1;
					$msg .= "กรุณาระบุนามสกุลผู้ที่ต้องการให้ติดต่อกลับ<br />";
				}

				if(!@$_POST["recall_tel_number"]) {
					$error = 1;
					$msg .= "กรุณาระบุเบอร์โทรศัพท์ผู้ที่ต้องการให้ติดต่อกลับ<br />";
				}

				if(!@$_POST["recall_number"]) {
					//	$error = 1;
					//	$msg .= "กรุณาระบุบ้านเลขที่ผู้ที่ต้องการให้ติดต่อกลับ<br />";
				}

				if(!@$_POST["recall_province_id"]) {
					$error = 1;
					$msg .= "กรุณาระบุจังหวัดผู้ที่ต้องการให้ติดต่อกลับ<br />";
				}

				if(!@$_POST["recall_amphur_id"]) {
					$error = 1;
					$msg .= "กรุณาระบุอำเภอผู้ที่ต้องการให้ติดต่อกลับ<br />";
				}

				if(!@$_POST["recall_district_id"]) {
					$error = 1;
					$msg .= "กรุณาระบุตำบลผู้ที่ต้องการให้ติดต่อกลับ<br />";
				}
			}

			if($error==0) {

				$data = new Request_Rain();

				$verification_code = strtoupper(uniqid());
				$x = new Request_Rain();
				$x->get_by_verification_code($verification_code);

				if($x->id) {
					$verification_code = strtoupper(substr(md5(rand()), -8));
				}

				//	หาจังหวัด
				$province = new Province($_POST["area_province_id"][0]);
				$initial = $province->operation_center->initial;		//	เรียกตัวย่อของภาค

				//	หาของปี
				$foo = new Request_Rain();
				$foo->where("YEAR(request_date)",date("Y"))->order_by("number_year","DESC")->get(1);

				//	หาหมายเลขล่าสุดของเดือน
				$bar = new Request_Rain();
				$bar->where("operation_center_id",$province->operation_center_id)->where("YEAR(request_date)",date("Y"))->where("MONTH(request_date)",date("m"))->order_by("number_month","DESC")->get(1);

				$number_year = ($foo->number_year+1);
				$number_month = ($bar->number_month+1);

				//	Example. N5801001
				$form_number = $initial.(substr((date("Y")+543), -2)).sprintf("%02d",date("m")).sprintf("%03d",$bar->number_month+1);

				$now = date("Y-m-d H:i:s");

				//	สถานะของผู้ร้องขอ
				if($_POST["personal_type_id"]>=3) {
					$_POST["personal_detail"] = @$_POST["personal_type_".$_POST["personal_type_id"]];
				}

				if(@$_POST["other_detail"]) {
					$_POST["other_detail"] = @nl2br($_POST["other_detail"]);
				}

				$data->from_array($_POST);
				$data->uid = uniqid();
				$data->status_id = 0;
				$data->form_number = $form_number;
				$data->number_year = $number_year;
				$data->number_month = $number_month;
				$data->request_date = $now;
				$data->progess_date = $now;
				$data->end_time= $now;
				$data->personal_id = @$_POST["personal_id"];
				$data->ip_address = $_SERVER["REMOTE_ADDR"];
				$data->verification_code = $verification_code;
				$data->operation_center_id = $province->operation_center_id;

				if($_POST["recall_type"]==1) {
					$data->recall_firstname = null;
					$data->recall_lastname = null;
					$data->recall_tel_number = null;
					$data->recall_email = null;
					$data->recall_number = null;
					$data->recall_moo = null;
					$data->recall_soi = null;
					$data->recall_road = null;
					$data->recall_province_id = null;
					$data->recall_amphur_id = null;
					$data->recall_district_id = null;
					$data->recall_address_code = null;
				}

				$data->save();

				$id = $data->id;

				//	นับจังหวัดที่เลือก
				$p = array();

				foreach ($_POST["area_province_id"] as $key => $value) {
					$c_amphur = count(explode(',', $_POST['area_amphur_id'][$key]));

					//	เช็คว่าได้ใส่จังหวัดนี้เข้าไปรึยัง ถ้าใส่แล้วจะข้ามไป
					if(!in_array($value, $p) && !empty($value) && @$_POST['area_amphur_id'][$key]==true) {
						array_push($p, $value);

						$province = new Province($value);

						$request_province = new Request_Rain_Area_Province;
						$request_province->request_rain_id = $id;
						$request_province->title = $province->title;
						$request_province->province_id = $value;
						$request_province->operation_center_id = $province->operation_center_id;
						$request_province->org_id = $province->org_id;
						$request_province->status = 0;
						$request_province->save();

						$amphur_id = explode(',', $_POST['area_amphur_id'][$key]);

						foreach ($amphur_id as $foo => $bar) {
							$amphur = new Amphur($bar);

							$request_amphur = new Request_Rain_Area_Amphur;
							$request_amphur->request_rain_id = $id;
							$request_amphur->request_rain_area_province_id = $request_province->id;
							$request_amphur->title = $amphur->title;
							$request_amphur->second_title = $amphur->second_title;
							$request_amphur->amphur_id = $bar;
							$request_amphur->province_id = $amphur->province_id;
							$request_amphur->operation_center_id = $province->operation_center_id;
							$request_amphur->org_id = $province->org_id;
							$request_amphur->save();
						}
					}
				}

				if($id) {
					//	sendmail($title, $this->load->view("email_success",$data,TRUE), $data->email);
					$this->session->set_flashdata("success",1);
					$this->session->set_flashdata("id",$id);
					$this->session->set_flashdata("email",$data->email);
					$this->session->set_flashdata("verification_code",trim($data->verification_code));

					$this->pdf($data->uid);
					redirect("service/success");
					return false;
				}
			} else {
				$this->session->set_flashdata("msg",$msg);
			}
		}
		$this->template->build("form",@$data);
	}

	public function success() {
		if($this->session->flashdata("success")==1) {
			$data["value"] = new Request_Rain($this->session->flashdata("id"));
			$this->template->build("success",$data);
		} else {
			redirect("service");
		}
	}

	public function view($uid) {
		$data["value"] = new Request_Rain();
		$data["value"]->get_by_uid($uid);

		$data["progesses"] = new Request_Rain_Progess();
		$data["progesses"]->where("request_rain_id",$data["value"]->id)->order_by("created","ASC")->get();

		$this->template->build("view",$data);
	}

	public function prints($uid) {
		$data["value"] = new Request_Rain();
		$data["value"]->get_by_uid($uid);
		$this->load->view("prints",$data);
	}

	public function pdf($uid) {
		$data["value"] = new Request_Rain();
		$data["value"]->get_by_uid($uid);

		$this->load->view("pdf",$data);
	}

	public function get_area($province_id,$request_id=null) {
		$data['where'] = " 1=1 ";

		foreach ($_POST["province_id"] as $key => $value) {
			$data['where'] .= " AND id != $value";
		}

		if($request_id==true) {
			$data['where'] .= ' AND (';

			$request = new Request_Rain($request_id);
			foreach ($request->request_rain_area_province as $key => $value) {
				if($key!=0) $data['where'] .= ' OR ';
				$data['where'] .= 'id = '.$value->province_id;
			}
			$data['where'] .= ')';
		}

		$province = new Province($province_id);
		$data['p_id'] = $province_id;
		$data['o_id'] = $province->operation_center_id;
		$data['uid'] = uniqid();
		$this->load->view('get_area',$data);
	}

	public function get_amphur($id,$target,$uid=null,$request_id=null) {
		if($target=="area") {
			$where = '1=1';
			if($request_id==true) {
				$amphur = new Request_Rain_Area_Amphur;
				$amphur->where('request_rain_id',$request_id)->get();
				$where .= ' AND (';
				foreach ($amphur as $num => $row) {
					if($num!=0) $where .= ' OR';
					$where .= ' id = '.$row->amphur_id;
				}
				$where .= ')';
			}
			echo @form_dropdown($uid,get_option("id","title","ma_amphur","WHERE PROVINCE_ID = $id AND $where ORDER BY TITLE ASC"),null,"class=\"form-control add-area\" data-uid=\"$uid\" style=\"display: inline; width: 180px; margin: 0;\"","-- เลือกอำเภอ --");
		} else {
			echo "อำเภอ<span class=\"requestTxt\" >*</span> ".@form_dropdown($target."_amphur_id",get_option("id","title","ma_amphur","WHERE PROVINCE_ID = $id ORDER BY TITLE ASC"),null,"class=\"form-control select-amphur\" data-target=\"$target\"","-- เลือกอำเภอ --");
		}
	}

	public function get_district($id,$target) {
		echo "ตำบล<span class=\"requestTxt\" >*</span> ".@form_dropdown($target."_district_id",get_option("id","title","ma_district","WHERE AMPHUR_ID = $id ORDER BY TITLE ASC"),null,"class=\"form-control\"","-- เลือกตำบล --");
	}

	public function get_amphur_area($id) {
		echo "<br class=\"more-area\" /><span class=\"more-area\" style=\"margin-left: 49px;\" >".@form_dropdown("area_amphur_id[]",get_option("id","title","ma_amphur","WHERE PROVINCE_ID = $id ORDER BY TITLE ASC"),null,"class=\"form-control\" style=\"margin: 5px 0;\" ","-- เลือกอำเภอ --")."</span><button type=\"button\" class=\"btn btn-danger delete-area more-area\" style=\"margin-left: 5px;\" ><i class=\"icon icon-trash\" ></i></button>";
	}

	public function chk_area($id,$id2) {
		$area = new Province($id);
		$area2 = new Province($id2);
		if($area->operation_center_id!=$area2->operation_center_id) {
			return 'true';
		} else {
			return 'false';
		}
	}

	public function p5535d6a7e47d6() {
		$variable = new Request_Rain();
		$variable->get();
		foreach ($variable as $key => $value) {
			$this->pdf($value->uid);
		}
	}

}
