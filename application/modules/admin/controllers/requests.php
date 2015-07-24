<?php
/**
 * Requests Controllers
 */
class Requests extends Admin_Controller {

	function __construct() {
		parent::__construct();

		if(!permission("requests","views")) {
			redirect("admin");
		}
	}

	public function index() {
		if(permission("requests","views")) {
			$data["variable"] = new Request_Rain();

			$data['get'] = '?true=1';

			//	ปี
			if(@$_GET["y"]) {
				$data['get'] .= '&y='.$_GET['y'];
				$data["variable"]->where("YEAR(request_date)",$_GET["y"]);
			}

			//	วัน
			if(@$_GET["d"] && @$_GET["e"]) {
				$data['get'] .= '&y='.$_GET['d'].'&y='.$_GET['e'];
				$data["variable"]->where("DATE(request_date) >=",$_GET["d"])->where("DATE(request_date) <=",$_GET["e"]);
			} else {
				if(@$_GET["d"]) {
				$data['get'] .= '&d='.$_GET['d'];
					$data["variable"]->where("DATE(request_date)",$_GET["d"]);
				}

				if(@$_GET["e"]) {
				$data['get'] .= '&e='.$_GET['e'];
					$data["variable"]->where("DATE(request_date)",$_GET["e"]);
				}
			}

			//	เลขที่เรื่อง
			if(@$_GET["p"]) {
				$data['get'] .= '&p='.$_GET['p'];
				$data["variable"]->like("form_number",$_GET["p"]);
			}

			//	ชื่อ
			if(@$_GET["n"]) {
				$data['get'] .= '&n='.$_GET['n'];
				$data["variable"]->group_start()->like("firstname",$_GET["n"])->or_like("lastname",$_GET["n"])->group_end();
			}

			//	อีเมล
			if(@$_GET["m"]) {
				$data['get'] .= '&m='.$_GET['m'];
				$data["variable"]->like("email",$_GET["m"]);;
			}

			//	เบอร์โทรศัพท์
			if(@$_GET["t"]) {
				$data['get'] .= '&t='.$_GET['t'];
				$data["variable"]->like("tel_number",$_GET["t"]);;
			}

			//	จังหวัด
			if(@$_GET["a"]) {
				$data['get'] .= '&a='.$_GET['a'];
				$data["variable"]->where_related("request_rain_area_province","province_id",$_GET["a"]);
			}

			//	ศูนย์
			if(!permission('requests_center', 'extra')) {
				$data['variable']->where_related('request_rain_area_province', 'org_id', user()->center_id);

			} else if(@$_GET["o"]) {
				$data['get'] .= '&o='.$_GET['o'];
				$data["variable"]->where("operation_center_id",$_GET["o"]);
			}

			//	สถานะ
			if(@$_GET["s"]) {
				if(@$_GET['s']=='e') {
					$data['get'] .= '&s=e';
					$data["variable"]->where("status_id <",6);
				} else {
					$data['get'] .= '&s='.$_GET['s'];
					$data["variable"]->where("status_id",$_GET["s"]);
				}
			}

			if(@$_GET["r"]) {
				$data['get'] .= '&r='.$_GET['r'];
				$data["variable"]->where("request_type",$_GET["r"]);
			}

			// $data["variable"]->order_by("id","DESC")->get_page();
			$select = "id,
					uid,
					form_number,
					firstname,
					lastname,
					status_id,
					request_date,
					(CASE
						WHEN DATE(NOW()) < (DATE(progess_date) + INTERVAL 2 DAY)
							THEN '5cb85c'
						WHEN DATE(NOW()) = (DATE(progess_date) + INTERVAL 2 DAY)
							THEN 'f0ad4e'
						ELSE 'd9534f'
					END) AS late_status";
			$data['variable']->select($select)->order_by('id','DESC')->get_page();

			$this->template->build("requests/index",$data);
		} else {
			redirect("admin");
		}
	}

	public function imports()
	{
		if(@$_FILES['import_file']['name']) {
			$ext = pathinfo($_FILES['import_file']['name'],PATHINFO_EXTENSION);

			if($ext=='xls') {
				$file = strtolower(uniqid().'.'.$ext);
				is_uploaded_file($_FILES['import_file']['tmp_name']);

				if(move_uploaded_file($_FILES['import_file']['tmp_name'], 'temp/$file')) {
					require_once('media/excelreader/reader.php');

					$data = new Spreadsheet_Excel_Reader;
					$data->setOutputEncoding('utf-8');
					$data->read('temp/$file');

					error_reporting(E_ALL ^ E_NOTICE);

					$x = $data->sheet[0]['numRows'];
					$add = 0;
					for ($i=0; $i < $x; $i++) {
						$verification_code = strtoupper(uniqid());
						$x = new Request_Rain();
						$x->get_by_verification_code($verification_code);

						if($x->id) {
							$verification_code = strtoupper(substr(md5(rand()), -8));
						}

						$province_id = $data->sheets[0]['cells'][$i][1];
						$year = $data->sheets[0]['cells'][$i][1];
						$month = $data->sheets[0]['cells'][$i][1];

						//	หาจังหวัด
						$province = new Province($province_id);
						$initial = $province->operation_center->initial;		//	เรียกตัวย่อของภาค

						//	หาของปี
						$foo = new Request_Rain;
						$foo->where("YEAR(request_date)",$year)->order_by("number_year","DESC")->get(1);

						//	หาหมายเลขล่าสุดของเดือน
						$bar = new Request_Rain;
						$bar->where("operation_center_id",$province->operation_center_id)->where("YEAR(request_date)",$year)->where("MONTH(request_date)",$month)->order_by("number_month","DESC")->get(1);

						$number_year = ($foo->number_year+1);
						$number_month = ($bar->number_month+1);

						//	Example. N5801001
						$form_number = $initial.(substr((date("Y")+543), -2)).sprintf("%02d",date("m")).sprintf("%03d",$bar->number_month+1);

						$request_rain = new Request_Rain;

						$value = array(
							'verification_code' => $verification_code,
							'uid'								=> uniqid(),
							'ip_address'						=> $_SERVER['REMOTE_ADDR'],
							'officer_fullname'					=> ($data->sheets[0]['cells'][$i][1]) ? $data->sheets[0]['cells'][$i][1] : null,
							'form_number'						=> $form_number,
							'number_year'						=> ($data->sheets[0]['cells'][$i][1]) ? $data->sheets[0]['cells'][$i][1] : (date('Y')+543),
							'number_month'						=> ($data->sheets[0]['cells'][$i][1]) ? sprintf('%02d',$data->sheets[0]['cells'][$i][1]) : date('m'),
							'start_time'						=> date('Y-m-d H:i:s'),
							'end_time'							=> date('Y-m-d H:i:s'),
							'request_date'						=> ($data->sheets[0]['cells'][$i][1]) ? $data->sheets[0]['cells'][$i][1] : null,
							'progess_date'						=> ($data->sheets[0]['cells'][$i][1]) ? $data->sheets[0]['cells'][$i][1] : null,
							'title'								=> 0,
							'firstname'							=> ($data->sheets[0]['cells'][$i][1]) ? $data->sheets[0]['cells'][$i][1] : null,
							'lastname'							=> ($data->sheets[0]['cells'][$i][1]) ? $data->sheets[0]['cells'][$i][1] : null,
							'age'								=> ($data->sheets[0]['cells'][$i][1]) ? $data->sheets[0]['cells'][$i][1] : null,
							'personal_id'						=> ($data->sheets[0]['cells'][$i][1]) ? $data->sheets[0]['cells'][$i][1] : null,
							'tel_number'						=> ($data->sheets[0]['cells'][$i][1]) ? $data->sheets[0]['cells'][$i][1] : null,
							'email'								=> ($data->sheets[0]['cells'][$i][1]) ? $data->sheets[0]['cells'][$i][1] : null,
							'address_number'					=> ($data->sheets[0]['cells'][$i][1]) ? $data->sheets[0]['cells'][$i][1] : null,
							'address_moo'						=> ($data->sheets[0]['cells'][$i][1]) ? $data->sheets[0]['cells'][$i][1] : null,
							'address_soi'						=> ($data->sheets[0]['cells'][$i][1]) ? $data->sheets[0]['cells'][$i][1] : null,
							'address_road'						=> ($data->sheets[0]['cells'][$i][1]) ? $data->sheets[0]['cells'][$i][1] : null,
							'address_district_id'				=> 0,
							'address_amphur_id'					=> 0,
							'address_province_id'				=> 0,
							'address_code'						=> ($data->sheets[0]['cells'][$i][1]) ? $data->sheets[0]['cells'][$i][1] : null,
							'personal_type_id'					=> 0,
							'personal_detail'					=> 0,
							'operation_center_id'				=> 0,
							'not_rain'							=> 0,
							'request_rain_day'					=> 0,
							'for_1'								=> 0,
							'for_2'								=> 0,
							'for_2_1'							=> 0,
							'for_text_2_1'						=> 0,
							'for_2_2'							=> 0,
							'for_text_2_2'						=> 0,
							'for_2_3'							=> 0,
							'for_text_2_3'						=> 0,
							'for_2_4'							=> 0,
							'for_text_2_4'						=> 0,
							'for_2_5'							=> 0,
							'for_text_2_5'						=> 0,
							'for_2_6'							=> 0,
							'for_text_2_6'						=> 0,
							'for_3'								=> 0,
							'for_text_3'						=> 0,
							'for_4'								=> 0,
							'for_text_4'						=> 0,
							'for_other'							=> 0,
							'for_text_other'					=> 0,
							'in_area'							=> 0,
							'in_area_text'						=> 0,
							'recall_type'						=> ($data->sheets[0]['cells'][$i][1]) ? $data->sheets[0]['cells'][$i][1] : null,
							'recall_firstname'					=> ($data->sheets[0]['cells'][$i][1]) ? $data->sheets[0]['cells'][$i][1] : null,
							'recall_lastname'					=> ($data->sheets[0]['cells'][$i][1]) ? $data->sheets[0]['cells'][$i][1] : null,
							'recall_age'						=> ($data->sheets[0]['cells'][$i][1]) ? $data->sheets[0]['cells'][$i][1] : null,
							'recall_personal_id'				=> ($data->sheets[0]['cells'][$i][1]) ? $data->sheets[0]['cells'][$i][1] : null,
							'recall_email'						=> ($data->sheets[0]['cells'][$i][1]) ? $data->sheets[0]['cells'][$i][1] : null,
							'recall_number'						=> ($data->sheets[0]['cells'][$i][1]) ? $data->sheets[0]['cells'][$i][1] : null,
							'recall_moo'						=> ($data->sheets[0]['cells'][$i][1]) ? $data->sheets[0]['cells'][$i][1] : null,
							'recall_soi'						=> ($data->sheets[0]['cells'][$i][1]) ? $data->sheets[0]['cells'][$i][1] : null,
							'recall_road'						=> ($data->sheets[0]['cells'][$i][1]) ? $data->sheets[0]['cells'][$i][1] : null,
							'recall_tel_number'					=> ($data->sheets[0]['cells'][$i][1]) ? $data->sheets[0]['cells'][$i][1] : null,
							'recall_district_id'				=> 0,
							'recall_amphur_id'					=> 0,
							'recall_province_id'				=> 0,
							'recall_address_code'				=> 0,
							'other_detail'						=> ($data->sheets[0]['cells'][$i][1]) ? $data->sheets[0]['cells'][$i][1] : null,
							'help_date'							=> 0,
							'help_district_id'					=> 0,
							'help_amphur_id'					=> 0,
							'help_province_id'					=> 0,
							'help_area_near_district'			=> 0,
							'help_title'						=> 0,
							'help_firstname'					=> 0,
							'help_lastname'						=> 0,
							'request_type'						=> 0,
							'request_detail'					=> 0,
							'status_id'							=> 0,
							'created'							=> 0,
							'updated'							=> 0,
							'delight_date'						=> 0,
							'delight_contact'					=> 0,
							'delight_contact_other'				=> 0,
							'request_rain_delight_status_id'	=> 0,
							'delight_other'						=> 0,
							'delight_note'						=> 0,
							'file_path'							=> 0,
						);

						$request_rain->from_array($value);
						//	$request_rain->save();
					}
				}

				@unlink('temp/$file');
			}

		}
	}

	public function exports()
	{
		$this->load->library('export');
		$data['variable'] = new Request_Rain;

		//	ปี
		if(@$_GET["y"]) {
			$data["variable"]->where("YEAR(request_date)",$_GET["y"]);
		}

		//	วัน
		if(@$_GET["d"] && @$_GET["e"]) {
			$data["variable"]->where("DATE(request_date) >=",$_GET["d"])->where("DATE(request_date) <=",$_GET["e"]);
		} else {
			if(@$_GET["d"]) {
				$data["variable"]->where("DATE(request_date)",$_GET["d"]);
			}

			if(@$_GET["e"]) {
				$data["variable"]->where("DATE(request_date)",$_GET["e"]);
			}
		}

		//	เลขที่เรื่อง
		if(@$_GET["p"]) {
			$data["variable"]->like("form_number",$_GET["p"]);
		}

		//	ชื่อ
		if(@$_GET["n"]) {
			$data["variable"]->group_start()->like("firstname",$_GET["n"])->or_like("lastname",$_GET["n"])->group_end();
		}

		//	อีเมล
		if(@$_GET["m"]) {
			$data["variable"]->like("email",$_GET["m"]);;
		}

		//	เบอร์โทรศัพท์
		if(@$_GET["t"]) {
			$data["variable"]->like("tel_number",$_GET["t"]);;
		}

		//	จังหวัด
		if(@$_GET["a"]) {
			$data["variable"]->where_related("request_rain_area_province","province_id",$_GET["a"]);
		}

		//	ศูนย์
		if(!permission('requests_center', 'extra')) {
			$data['variable']->where_related('request_rain_area_province', 'org_id', user()->center_id);

		} else if(@$_GET["o"]) {
			$data["variable"]->where("operation_center_id",$_GET["o"]);
		}

		//	สถานะ
		if(@$_GET["s"]) {
			if(@$_GET['s']=='e') {
				$data['get'] .= '&s=e';
				$data["variable"]->where("status_id <",6);
			} else {
				$data['get'] .= '&s='.$_GET['s'];
				$data["variable"]->where("status_id",$_GET["s"]);
			}
		}

		if(@$_GET["r"]) {
			$data["variable"]->where("request_type",$_GET["r"]);
		}

		$data['variable']->get();

		$this->load->view('requests/export',$data);
	}

	public function form() {
		if(permission("requests","create")) {
			$data['uid'] = uniqid();
			$this->template->build("requests/form",$data);
		} else {
			redirect("admin/requests");
		}
	}

	public function view($id) {
		$data["value"] = new Request_Rain($id);
		$this->template->build("requests/view",$data);
	}

	public function actions($id) {
		if(permission("requests","views")) {
			$data["value"] = new Request_Rain($id);
			if($data['value']->id) {
				$this->template->build("requests/actions",$data);
			} else {
				$msg = 'ไม่สามารถดูรายละเอียดรายการนี้ได้ กรุณาตรวจสอบความถูกต้อง';
				$this->session->set_flashdata("alert","danger");
				$this->session->set_flashdata("title","ผิดพลาด");
				$this->session->set_flashdata("msg",$msg);
				redirect("admin/requests");
			}
		} else {
			redirect("admin/requests");
		}
	}

	public function debug() {
		echo "<pre>";
		print_r($_POST);

	}

	public function save() {
		if(permission("requests","create")) {
			if($_POST) {
				$error = 0;
				$msg = null;
				$personal_id = null;
				$recall_personal_id = null;
				$error_personal_id = 0;
				$error_recall_personal_id = 0;

				//	ตรวจสอบรหัสบัตรประชาชน
				if(@$_POST["personal_id"]) {
					if(!is_numeric($_POST["personal_id"])) {
						$error = 1;
						$msg .= "กรุณาใส่รหัสบัตรประชาชนให้ถูกต้อง<br />";
					}
				}

				//	ตรวจสอบ สถานะผู้ร้องขอ
				if(@$_POST["personal_type_id"]==null) {
					$error = 1;
					$msg .= "กรุณาเลือกสถานะของผู้ร้องขอ<br />";
				}

				//	check format email
				if(@($_POST["email"])) {
					if(!(filter_var($_POST["email"],FILTER_VALIDATE_EMAIL))) {
						$error = 1;
						$msg .= "กรุณาระบุอีเมลให้ถูกต้อง<br />";
					}
				}

				//	ตรวจสอบอายุ
				if(@$_POST["age"]) {
					if(!is_numeric($_POST["age"])) {
						$error = 1;
						$msg .= "กรุณาระบุอายุให้ถูกต้อง<br />";
					}
				}

				if(@$_POST['not_rain']) {
					if(!ctype_digit($_POST['not_rain'])) {
						$error = 1;
						$msg .= "กรุณาระบุวันที่ฝนไม่ตกเป็นตัวเลข<br />";
					}
				}

				if(@$_POST['request_rain_day']) {
					if(!ctype_digit($_POST['request_rain_day'])) {
						$error = 1;
						$msg .= "กรุณาระบุจำนวนวันที่ต้องการน้ำฝนต่อเนื่องเป็นตัวเลข<br />";
					}
				}

				if (permission('requests_editdate', 'extra')):
					//	ตรวจสอบเขต/อำเภอ
					if(!@$_POST["area_amphur_id"]) {
						$error = 1;
						$msg .= "กรุณาเลือกอำเภอที่ขอรับบริหาร<br />";
					}

					//	ตรวจสอบจังหวัด
					if(!@$_POST["area_province_id"]) {
						$error = 1;
						$msg .= "กรุณาเลือกจังหวัดที่ขอรับบริหาร<br />";
					}
				endif;

				if($error==1) {
					$this->session->set_flashdata("alert","danger");
					$this->session->set_flashdata("title","ผิดพลาด");
					$this->session->set_flashdata("msg",$msg);
					redirect("admin/requests/form");
				} else {

					$data = new Request_Rain();

					if($_POST["personal_type_id"]>2) {
						$_POST["personal_detail"] = @$_POST["personal_type_".$_POST["personal_type_id"]];
					}

					if($_POST["request_type"]!=3) {
						$_POST["request_detail"] = @$_POST["request_type_detail_".$_POST["request_type"]];
					}

					//	ขึ้นรหัสใหม่
					$verification_code = strtoupper(uniqid());
					$x = new Request_Rain();
					$x->get_by_verification_code($verification_code);

					//	ตรวจสอบว่ามีรหัสหรือยัง
					if($x->id) {
						$verification_code = strtoupper(substr(md5(rand()), -8));
					}

					//	หาจังหวัด
					$province = new Province($_POST["area_province_id"][0]);
					$initial = $province->operation_center->initial;		//	เรียกตัวย่อของภาค

					$request_date = (@$_POST["request_date"]) ? $_POST["request_date"] : $now;
					$y = date("Y",strtotime($request_date));
					$m = date("m",strtotime($request_date));

					//	หาของปี
					$foo = new Request_Rain();
					$foo->where("YEAR(request_date)",$y)->order_by("number_year","DESC")->get(1);

					//	หาหมายเลขล่าสุดของเดือน
					$bar = new Request_Rain();
					$bar->where("operation_center_id",$province->operation_center_id)->where("YEAR(request_date)",$y)->where("MONTH(request_date)",$m)->order_by("number_month","DESC")->get(1);

					$number_year = ($foo->number_year+1);
					$number_month = ($bar->number_month+1);

					$form_number = $initial.(substr(($y+543), -2)).sprintf("%02d",$m).sprintf("%03d",$bar->number_month+1);

					$now = date("Y-m-d H:i:s");

					$data->from_array($_POST);
					$data->uid = uniqid();
					$data->status_id = 0;
					$data->form_number = $form_number;
					$data->number_year = $number_year;
					$data->number_month = $number_month;
					$data->request_date = $request_date;
					$data->progess_date = $request_date;
					$data->end_time= $now;
					$data->personal_id = $_POST["personal_id"];
					$data->ip_address = $_SERVER["REMOTE_ADDR"];
					$data->verification_code = $verification_code;
					$data->operation_center_id = $province->operation_center_id;

					if(@$_FILES['file_path']['name']) {
						$data->file_path = $data->upload($_FILES['file_path'],'requests');
					}

					//	แหล่งน้ำใกล้เคียงบริเวณพิ้นที่ขอรับบริการฝนหลวง ถ้าไม่ใช่ อื่นๆ ไม่ต้องมีเพิ่มเติม
					if(@$_POST["request_rain_dam_id"]!=5) {
						$data->request_rain_dam_other = null;
					}

					$data->save();

					$id = $data->id;

					//	นับจังหวัดที่เลือก
					$p = array();

					foreach ($_POST["area_province_id"] as $key => $value) {
						$c_amphur = count(explode(',', $_POST['area_amphur_id'][$key]));

						//	เช็คว่าได้ใส่จังหวัดนี้เข้าไปรึยัง ถ้าใส่แล้วจะข้ามไป
						if(!in_array($value, $p)) {
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
						$this->session->set_flashdata("alert","success");
						$this->session->set_flashdata("success",1);

						$this->session->set_flashdata("form_number",$data->form_number);
						$this->session->set_flashdata("uid",$data->uid);

						//	สร้างไฟล์ PDF
						$this->pdf($data->uid);
					}
				}

			}
		}
		redirect("admin/requests");
	}

	public function save_edit($id) {
		if(permission("requests","create")) {
			if($_POST) {
				$error = 0;
				$msg = null;
				$personal_id = null;
				$recall_personal_id = null;
				$error_personal_id = 0;
				$error_recall_personal_id = 0;

				if(@$_POST["personal_id"]) {
					//	ตรวจสอบรหัสบัตรประชาชน
					if(!is_numeric($_POST["personal_id"])) {
						$error = 1;
						$msg .= "กรุณาใส่รหัสบัตรประชาชนให้ถูกต้อง<br />";
					}
				}

				//	ตรวจสอบ สถานะผู้ร้องขอ
				if(@$_POST["personal_type_id"]==null) {
					$error = 1;
					$msg .= "กรุณาเลือกสถานะของผู้ร้องขอ<br />";
				}

				//	check format email
				if(@($_POST["email"])) {
					if(!(filter_var($_POST["email"],FILTER_VALIDATE_EMAIL))) {
						$error = 1;
						$msg .= "กรุณาระบุอีเมลให้ถูกต้อง<br />";
					}
				}

				//	ตรวจสอบอายุ
				if(@$_POST["age"]==null || !is_numeric($_POST["age"])) {
					$error = 1;
					$msg .= "กรุณาระบุอายุให้ถูกต้อง<br />";
				}

				//	ตรวจสอบเบอร์โทรศัพท์
				if(!@$_POST["tel_number"]) {
					$error = 1;
					$msg .= "กรุณาระบุหมายเลขโทรศัพท์<br />";
				}

				if(@$_POST['not_rain']) {
					if(!ctype_digit($_POST['not_rain'])) {
						$error = 1;
						$msg .= "กรุณาระบุวันที่ฝนไม่ตกเป็นตัวเลข<br />";
					}
				}

				if(@$_POST['request_rain_day']) {
					if(!ctype_digit($_POST['request_rain_day'])) {
						$error = 1;
						$msg .= "กรุณาระบุจำนวนวันที่ต้องการน้ำฝนต่อเนื่องเป็นตัวเลข<br />";
					}
				}

				if (permission('requests_editdate', 'extra')):
					//	ตรวจสอบเขต/อำเภอ
					if(!@$_POST["area_amphur_id"]) {
						$error = 1;
						$msg .= "กรุณาเลือกอำเภอที่ขอรับบริหาร<br />";
					}

					//	ตรวจสอบจังหวัด
					if(!@$_POST["area_province_id"]) {
						$error = 1;
						$msg .= "กรุณาเลือกจังหวัดที่ขอรับบริหาร<br />";
					}
				endif;

				if($error==1) {
					$this->session->set_flashdata("alert","danger");
					$this->session->set_flashdata("title","ผิดพลาด");
					$this->session->set_flashdata("msg",$msg);
					redirect("admin/requests/actions/$id");
				} else {

					$data = new Request_Rain($id);

					if($_POST["personal_type_id"]>2) {
						$_POST["personal_detail"] = @$_POST["personal_type_".$_POST["personal_type_id"]];
					}

					if($_POST["request_type"]!=3) {
						$_POST["request_detail"] = @$_POST["request_type_detail_".$_POST["request_type"]];
					}

					$now = date("Y-m-d H:i:s");

					//	หาจังหวัด
					$province = new Province($_POST["area_province_id"][0]);


					$data->from_array($_POST);
					//	$data->status_id = 0;
					//	$data->request_date = (@$_POST["request_date"]) ? $_POST["request_date"] : $now;
					$data->end_time= $now;
					if(@$_POST["personal_id"]) $data->personal_id = $_POST["personal_id"];
					//	$data->ip_address = $_SERVER["REMOTE_ADDR"];
					$data->operation_center_id = $province->operation_center_id;

					//	แหล่งน้ำใกล้เคียงบริเวณพิ้นที่ขอรับบริการฝนหลวง ถ้าไม่ใช่ อื่นๆ ไม่ต้องมีเพิ่มเติม
					if($_POST["request_rain_dam_id"]!=5) {
						$data->request_rain_dam_other = null;
					}

					if(@$_FILES['file_path']['name']) {
						$data->file_path = $data->upload($_FILES['file_path'],'requests');
					}

					$data->save();

					if (permission('requests_editdate', 'extra')):
						$delete = new Request_Rain_Area_Province;
						$delete->where("request_rain_id",$data->id)->get()->delete_all();

						$delete = new Request_Rain_Area_Amphur();
						$delete->where("request_rain_id",$data->id)->get()->delete_all();
					endif;
					//	นับจังหวัดที่เลือก
					$p = array();

					foreach ($_POST["area_province_id"] as $key => $value) {
						$c_amphur = count(explode(',', $_POST['area_amphur_id'][$key]));

						//	เช็คว่าได้ใส่จังหวัดนี้เข้าไปรึยัง ถ้าใส่แล้วจะข้ามไป
						if(!in_array($value, $p) && !empty($value) && @$_POST['area_amphur_id'][$key]==true) {
							array_push($p, $value);

							$province = new Province($value);

							$request_province = new Request_Rain_Area_Province;
							$request_province->request_rain_id = $data->id;
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
								$request_amphur->request_rain_id = $data->id;
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

					if($data->id) {
						$this->session->set_flashdata("success",1);

						//	สร้างไฟล์ PDF
						$this->pdf($data->uid);
					}
				}
			}
		}
		redirect("admin/requests/actions/$id");
	}

	public function save_progess($type,$id,$pid=null) {
		if($_POST) {
			$request_rain = new Request_Rain($id);

			switch ($type) {
				case 1:
					if($request_rain->status_id==0 || $pid==true) {
						$progess = new Request_Rain_Progess($pid);
						$progess->user_id = user()->id;
						$progess->request_rain_id = $id;
						$progess->help_center_id = user()->center->org_id;
						$progess->help_center_title = user()->center->center_name;
						$progess->help_fullname = user()->firstname.' '.user()->lastname;
						$progess->request_rain_status_id = 1;
						$progess->detail = @$_POST["detail"];
						$progess->progess_date = (@$_POST["progess_date"]) ? $_POST["progess_date"] : date("Y-m-d H:i:s");
						$progess->save();

						$request_rain->status_id = $type;
						$request_rain->save();
					}
					break;
				case 2:
					if($request_rain->status_id>=1 || $pid==true) {

						if($pid) {
							$delete = new Request_Rain_Progess_Province;
							$delete->where('request_rain_progess_id',$pid)->where('progess_type',2)->get()->delete_all();

							$delete = new Request_Rain_Progess_Amphur;
							$delete->where('request_rain_progess_id',$pid)->where('progess_type',2)->get()->delete_all();
						}

						$progess = new Request_Rain_Progess($pid);
						$progess->user_id = user()->id;
						$progess->request_rain_id = $id;
						$progess->help_center_id = user()->center->org_id;
						$progess->help_center_title = user()->center->center_name;
						$progess->help_fullname = user()->firstname.' '.user()->lastname;
						$progess->request_rain_status_id = 2;
						$progess->progess_date = (@$_POST["progess_date"]) ? $_POST["progess_date"] : date("Y-m-d H:i:s");
						$progess->detail = @$_POST["detail"];
						$progess->save();

						$progess_id = $progess->id;

						$request_rain->status_id = $type;
						$request_rain->save();

						if($progess_id) {
							//	นับจังหวัดที่เลือก
							$p = array();

							foreach ($_POST["area_province_id"] as $key => $value) {
								$c_amphur = count(explode(',', $_POST['area_amphur_id'][$key]));

								//	เช็คว่าได้ใส่จังหวัดนี้เข้าไปรึยัง ถ้าใส่แล้วจะข้ามไป
								if(!in_array($value, $p) && !empty($value) && @$_POST['area_amphur_id'][$key]==true) {
									array_push($p, $value);

									$province = new Province($value);

									$progess_province = new Request_Rain_Progess_Province;
									$progess_province->request_rain_id = $id;
									$progess_province->request_rain_progess_id = $progess_id;
									$progess_province->progess_type = 2;
									$progess_province->title = $province->title;
									$progess_province->province_id = $value;
									$progess_province->operation_center_id = $province->operation_center_id;
									$progess_province->org_id = $province->org_id;
									$progess_province->status = 0;
									$progess_province->save();

									$amphur_id = explode(',', $_POST['area_amphur_id'][$key]);

									foreach ($amphur_id as $num => $row) {
										$amphur = new Amphur($row);

										$progess_amphur = new Request_Rain_Progess_Amphur;
										$progess_amphur->request_rain_id = $id;
										$progess_amphur->request_rain_progess_id = $progess_id;
										$progess_amphur->request_rain_progess_province_id = $progess_province->id;
										$progess_amphur->progess_type = 2;
										$progess_amphur->title = $amphur->title;
										$progess_amphur->second_title = $amphur->second_title;
										$progess_amphur->amphur_id = $row;
										$progess_amphur->province_id = $amphur->province_id;
										$progess_amphur->operation_center_id = $province->operation_center_id;
										$progess_amphur->org_id = $province->org_id;
										$progess_amphur->save();
									}
								}
							}
						}	//	close $progess_id
					}
					break;
				case 3:
					if($request_rain->status_id>=1 || $pid==true) {
						$progess = new Request_Rain_Progess($pid);
						$progess->user_id = user()->id;
						$progess->request_rain_id = $id;
						$progess->help_center_id = user()->center->org_id;
						$progess->help_center_title = user()->center->center_name;
						$progess->help_fullname = user()->firstname.' '.user()->lastname;
						$progess->request_rain_status_id = 3;
						$progess->progess_date = (@$_POST["progess_date"]) ? $_POST["progess_date"] : date("Y-m-d H:i:s");
						$progess->detail = @$_POST["detail"];
						$progess->note = @$_POST["note"];
						$progess->save();

						$request_rain->status_id = $type;
						$request_rain->save();
					}
					break;
				case 4:
					if($request_rain->status_id>=1 || $pid==true) {

						if($pid) {
							$delete = new Request_Rain_Progess_Province;
							$delete->where('request_rain_progess_id',$pid)->where('progess_type',4)->get()->delete_all();

							$delete = new Request_Rain_Progess_Amphur;
							$delete->where('request_rain_progess_id',$pid)->where('progess_type',4)->get()->delete_all();
						}

						$progess = new Request_Rain_Progess($pid);
						$progess->user_id = user()->id;
						$progess->request_rain_id = $id;
						$progess->help_center_id = user()->center->org_id;
						$progess->help_center_title = user()->center->center_name;
						$progess->help_fullname = user()->firstname.' '.user()->lastname;
						$progess->request_rain_status_id = 4;
						$progess->help_province_id = @$_POST["help_province_id"];
						$progess->progess_date = (@$_POST["progess_date"]) ? $_POST["progess_date"] : date("Y-m-d H:i:s");
						$progess->help_rain_level = @$_POST["rain_level"];
						$progess->detail = @$_POST["detail"];
						$progess->note = @$_POST["note"];
						$progess->save();

						$progess_id = $progess->id;

						if($progess_id) {
							//	นับจังหวัดที่เลือก
							$p = array();

							foreach ($_POST["area_province_id"] as $key => $value) {
								$c_amphur = count(explode(',', $_POST['area_amphur_id'][$key]));

								//	เช็คว่าได้ใส่จังหวัดนี้เข้าไปรึยัง ถ้าใส่แล้วจะข้ามไป
								if(!in_array($value, $p) && !empty($value) && @$_POST['area_amphur_id'][$key]==true) {
									array_push($p, $value);

									$province = new Province($value);

									$progess_province = new Request_Rain_Progess_Province;
									$progess_province->request_rain_id = $id;
									$progess_province->request_rain_progess_id = $progess_id;
									$progess_province->progess_type = 4;
									$progess_province->title = $province->title;
									$progess_province->province_id = $value;
									$progess_province->operation_center_id = $province->operation_center_id;
									$progess_province->org_id = $province->org_id;
									$progess_province->status = 0;
									$progess_province->save();

									$amphur_id = explode(',', $_POST['area_amphur_id'][$key]);

									foreach ($amphur_id as $num => $row) {
										$amphur = new Amphur($row);

										$progess_amphur = new Request_Rain_Progess_Amphur;
										$progess_amphur->request_rain_id = $id;
										$progess_amphur->request_rain_progess_id = $progess_id;
										$progess_amphur->request_rain_progess_province_id = $progess_province->id;
										$progess_amphur->progess_type = 4;
										$progess_amphur->title = $amphur->title;
										$progess_amphur->second_title = $amphur->second_title;
										$progess_amphur->amphur_id = $row;
										$progess_amphur->province_id = $amphur->province_id;
										$progess_amphur->operation_center_id = $province->operation_center_id;
										$progess_amphur->org_id = $province->org_id;
										$progess_amphur->save();
									}
								}
							}
						}	//	close $progess_id

						$request_rain->status_id = $type;
						$request_rain->save();
					}
					break;
				case 5:
					$progess = new Request_Rain_Progess($pid);
					$progess->user_id = user()->id;
					$progess->request_rain_id = $id;
					$progess->help_center_id = user()->center->org_id;
					$progess->help_center_title = user()->center->center_name;
					$progess->help_fullname = user()->firstname.' '.user()->lastname;
					$progess->request_rain_status_id = 5;
					$progess->progess_date = (@$_POST["progess_date"]) ? $_POST["progess_date"] : date("Y-m-d H:i:s");
					$progess->recall_type = @$_POST["recall_type"];
					$progess->recall_type_detail = @$_POST["recall_type_".@$_POST["recall_type"]];
					$progess->detail = @$_POST["detail"];
					$progess->note = @$_POST["note"];

					if(@$_FILES["file_path"]["name"]) {
						$progess->file_path = $progess->upload($_FILES["file_path"], "requests");
					}

					$progess->save();

					$request_rain->status_id = $type;
					$request_rain->progess_date = now();
					$request_rain->save();
					break;
				case 6:
					$progess = new Request_Rain_Progess($pid);
					$progess->user_id = user()->id;
					$progess->request_rain_id = $id;
					$progess->help_center_id = user()->center->org_id;
					$progess->help_center_title = user()->center->center_name;
					$progess->help_fullname = user()->firstname.' '.user()->lastname;
					$progess->request_rain_status_id = 6;
					$progess->progess_date = (@$_POST["progess_date"]) ? $_POST["progess_date"] : date("Y-m-d H:i:s");
					$progess->recall_type = @$_POST["recall_type"];
					$progess->note = @$_POST["note"];
					$progess->save();

					$request_rain->status_id = $type;
					$request_rain->save();
					break;
			}

			$this->generateProgess($id);

			//	สร้างไฟล์ PDF
			$this->pdf($request_rain->uid);
		}
		redirect("admin/requests/actions/$id");
	}

	public function save_action($id) {
		if(permission("requests","create")) {
			$title = null;

			if($_POST["help_title"]==4) {
				$_POST["help_title"] = $_POST["help_title_other"];
			}

			if($_POST["request_type"]!=3) {
				$_POST["request_detail"] = @$_POST["request_type_detail_".$_POST["request_type"]];
			}

			$data = new Request_Rain($id);
			$data->help_date = $_POST["help_date"];
			$data->help_province_id = $_POST["help_province_id"];
			$data->help_amphur_id = $_POST["help_amphur_id"];
			$data->help_district_id = $_POST["help_district_id"];
			$data->help_area_near_district = $_POST["help_area_near_district"];
			$data->help_title = $_POST["help_title"];
			$data->help_firstname = $_POST["help_firstname"];
			$data->help_lastname = $_POST["help_lastname"];
			$data->request_type = $_POST["request_type"];
			$data->request_detail = @$_POST["request_detail"];
			$data->status_id = $_POST["status_id"];
			$data->save();

			$log = new Request_Rain_Progess();
			$log->user_id = user()->id;
			$log->request_rain_id = $id;
			$log->help_date = $_POST["help_date"];
			$log->help_province_id = $_POST["help_province_id"];
			$log->help_amphur_id = $_POST["help_amphur_id"];
			$log->help_district_id = $_POST["help_district_id"];
			$log->help_area_near_district = $_POST["help_area_near_district"];
			$log->help_title = $_POST["help_title"];
			$log->help_firstname = $_POST["help_firstname"];
			$log->help_lastname = $_POST["help_lastname"];
			$log->request_type = $_POST["request_type"];
			$log->request_detail = @$_POST["request_detail"];
			$log->request_rain_status_id = $_POST["status_id"];
			$log->save();

			$this->session->set_flashdata("alert","success");
			$this->session->set_flashdata("title","สำเร็จ");
			$this->session->set_flashdata("msg","ดำเนินการ ".$data->form_number." <strong>".$data->status->title."</strong>");
		}
		redirect("admin/requests");
	}

	public function save_delight($id) {
		if($_POST) {
			$data = new Request_Rain($id);
			$data->delight_date = (@$_POST["delight_date"]) ? $_POST["delight_date"] : date("Y-m-d");
			$data->delight_contact = (@$_POST["delight_contact"]) ? $_POST["delight_contact"] : null;
			$data->delight_contact_other = (@$_POST["delight_contact"]==4 && @$_POST["delight_contact_other"]) ? $_POST["delight_contact_other"] : null;
			$data->request_rain_delight_status_id = (@$_POST["request_rain_delight_status_id"]) ? $_POST["request_rain_delight_status_id"] : 0;
			$data->delight_other = @$_POST["delight_other"];
			$data->delight_note = @$_POST["delight_note"];

			if(@$_POST['delight_contact']==2 || @$_POST['delight_contact']==4) {
				$data->delight_contact_other = $_POST['delight_contact_other_'.$_POST['delight_contact']];
			}
			$data->save();
		}

		redirect("admin/requests/actions/$id");
	}

	public function get_edit($id) {
		$data["value"] = new Request_Rain($id);
		$data["areas"] = new Request_Rain_Area_Province;
		$data["areas"]->where('request_rain_id',$id)->order_by('ID','ASC')->get(10);

		$data["amphurs"] = new Request_Rain_Area_Amphur;
		$data["amphurs"]->where('request_rain_id',$id)->order_by('id','ASC')->get();

		$data["uid"] = uniqid();
		$this->load->view("requests/get_edit",$data);
	}

	public function get_action($id) {
		$data["value"] = new Request_Rain($id);
		$this->load->view("requests/get_action",$data);
	}

	public function get_complacency($id) {
		$data["value"] = new Request_Rain($id);
		$this->load->view("requests/get_delight",$data);
	}

	public function get_progess($id) {
		$variable = new Request_Rain_Log();
		$variable->where("request_rain_id",$id)->get();

		echo "<div id=\"progress_list\">";

			foreach ($variable as $key => $value):
				echo "<div class=\"progress_box\">";
				echo "<div><strong style=\"margin-right:5px;\" >".$value->user->firstname." ".$value->user->firstname."</strong></div>";
				echo "<div class=\"created\" >".mysql_to_th($value->created,"F",TRUE)."</div>";
				echo "</div>";
			endforeach;

		echo "</div>";
	}

	public function form_progess($id,$type,$progess_id=null) {
		$data["value"] = new Request_Rain($id);
		$status = $data['value']->status_id;

		$data["progess"] = new Request_Rain_Progess($progess_id);

		$request_date = strtotime($data["value"]->request_date);

		$data["year"] = date("Y",$request_date);
		$data["month"] = date("m",$request_date);
		$data["day"] = date("d",$request_date);

		switch ($type) {
			case 1:	//	รับเรื่องขอรับบริการฝนหลวง
				if($status==0 || $progess_id==true) {
					$this->load->view("requests/progess_1",$data);
				} else {
					$data['msg'] = 'ไม่สามารถรับเรื่องซ้ำได้กรุณาเลือกการดำเนินการอื่น';
					$this->load->view('requests/progess_error',$data);
				}
				break;
			case 2:	//	วางแผนปฏิบัติการให้ความช่วยเหลือ
				if(($status>=1 && $status<6) || $progess_id==true) {
					$data['uid'] = uniqid();

					if($progess_id==true) {
						//	$data['areas'] = new Request_Rain_Progess_Province;
						//	$data['areas']->where('request_rain_id',$id)->where('request_rain_progess_id',$progess_id)->get();

						//	$amphurs = new Request_Rain_Progess_Amphur;
						//	$amphurs->where('request_rain_id',$id)->where('request_rain_progess_id',$progess_id)->get();

						$data['areas'] = new Request_Rain_Progess_Province;
						$data['areas']->where('request_rain_id',$id)->where('request_rain_progess_id',$progess_id)->get();

						$data["amphurs"] = new Request_Rain_Progess_Amphur;
						$data["amphurs"]->where('request_rain_id',$id)->where('request_rain_progess_id',$progess_id)->order_by('id','ASC')->get();

						$amphurs = new Request_Rain_Area_Amphur;
						$amphurs->where('request_rain_id',$id)->get();

						$data['where_a'] = ' AND (';
						foreach ($amphurs as $num => $row) {
							if($num!=0) $data['where_a'] .= ' OR';
							$data['where_a'] .= ' id = '.$row->amphur_id;
						}
						$data['where_a'] .= ')';
					} else {
						$data['areas'] = new Request_Rain_Area_Province();
						$data['areas']->where('request_rain_id',$id)->get();
					}

					$data['where'] = '1=1 AND (';
					foreach ($data['areas'] as $num => $row) {
						if($num!=0) $data['where'] .= ' OR';
						$data['where'] .= ' id = '.$row->province_id;
					}
					$data['where'] .=  ')';

					$this->load->view("requests/progess_2",$data);
				} else {
					if($status<1) {
						$data['msg'] = 'กรุณารับเรื่องก่อนดำเนินการในขั้นตอนอื่น';
					} else {
						$data['msg'] = 'ไม่สามารถดำเนินการได้เนื่องจากยุติเรื่องแล้ว';
					}
					$this->load->view('requests/progess_error',$data);
				}
				break;
			case 3:	//	รายงานความก้าวหน้า
				if(($status>=1 && $status<6) || $progess_id==true) {
					$this->load->view("requests/progess_3",$data);
				} else {
					if($status<1) {
						$data['msg'] = 'กรุณารับเรื่องก่อนดำเนินการในขั้นตอนอื่น';
					} else {
						$data['msg'] = 'ไม่สามารถดำเนินการได้เนื่องจากยุติเรื่องแล้ว';
					}
					$this->load->view('requests/progess_error',$data);
				}
				break;
			case 4:	//	ปฏิบัติการสำเร็จ
				if(($status>=1 && $status<6) || $progess_id==true) {
					$data['uid'] = uniqid();

					if($progess_id==true) {
						//	$data['areas'] = new Request_Rain_Progess_Province;
						//	$data['areas']->where('request_rain_id',$id)->where('request_rain_progess_id',$progess_id)->get();

						//	$amphurs = new Request_Rain_Progess_Amphur;
						//	$amphurs->where('request_rain_id',$id)->where('request_rain_progess_id',$progess_id)->get();

						$data['areas'] = new Request_Rain_Progess_Province;
						$data['areas']->where('request_rain_id',$id)->where('request_rain_progess_id',$progess_id)->get();

						$data["amphurs"] = new Request_Rain_Progess_Amphur;
						$data["amphurs"]->where('request_rain_id',$id)->where('request_rain_progess_id',$progess_id)->order_by('id','ASC')->get();

						$amphurs = new Request_Rain_Area_Amphur;
						$amphurs->where('request_rain_id',$id)->get();

						$data['where_a'] = ' AND (';
						foreach ($amphurs as $num => $row) {
							if($num!=0) $data['where_a'] .= ' OR';
							$data['where_a'] .= ' id = '.$row->amphur_id;
						}
						$data['where_a'] .= ')';
					} else {
						$data['areas'] = new Request_Rain_Area_Province();
						$data['areas']->where('request_rain_id',$id)->get();
					}

					$data['where'] = '1=1 AND (';
					foreach ($data['areas'] as $num => $row) {
						if($num!=0) $data['where'] .= ' OR';
						$data['where'] .= ' id = '.$row->province_id;
					}
					$data['where'] .=  ')';

					$this->load->view("requests/progess_4",$data);
				} else {
					if($status<1) {
						$data['msg'] = 'กรุณารับเรื่องก่อนดำเนินการในขั้นตอนอื่น';
					} else {
						$data['msg'] = 'ไม่สามารถดำเนินการได้เนื่องจากยุติเรื่องแล้ว';
					}
					$this->load->view('requests/progess_error',$data);
				}
				break;
			case 5:	//	การตอบกลับผู้ขอรับบริการ
				if(($status>=1 && $status<6) || $progess_id==true) {
					$this->load->view("requests/progess_5",$data);
				} else {
					if($status<1) {
						$data['msg'] = 'กรุณารับเรื่องก่อนดำเนินการในขั้นตอนอื่น';
					} else {
						$data['msg'] = 'ไม่สามารถดำเนินการได้เนื่องจากยุติเรื่องแล้ว';
					}
					$this->load->view('requests/progess_error',$data);
				}
				break;
			case 6:	//	ยุติเรื่อง
				if(($status>=1 && $status<6) || $progess_id==true) {
					$this->load->view("requests/progess_6",$data);
				} else {
					if($status<1) {
						$data['msg'] = 'กรุณารับเรื่องก่อนดำเนินการในขั้นตอนอื่น';
					} else {
						$data['msg'] = 'ไม่สามารถดำเนินการได้เนื่องจากยุติเรื่องแล้ว';
					}
					$this->load->view('requests/progess_error',$data);
				}
				break;
			default:
				$data['msg'] = 'ล้มเหลวกรุณาลองใหม่ภายหลัง';
				$this->load->view('requests/progess_error',$data);
				break;
		}
	}

	public function report() {
		if(permission("requests","views")) {
			$data['where'] = 'status = 0';
			$data['range'] = null;

			if(@$_GET['s']) {
				$s = strtotime($_GET['s']);
				$start = date('Y-m-d',$s);
				$data['where'] .= " AND ma_request_rain_area_amphur.created >= DATE('$start')";
				$data['range'] .= '(ตั้งแต่วันที่ '.mysql_to_th($_GET['s'],"F",FALSE);
			}

			if(@$_GET['e']) {
				$e = strtotime($_GET['e']);
				$end = date('Y-m-d',$e);
				$data['where'] .= " AND ma_request_rain_area_amphur.created <= DATE('$end')";
				$data['range'] .= ' - '.mysql_to_th($_GET['e'],"F",FALSE);
			}

			if(!empty($data['range'])) {
				$data['range'] .= ')';
			}

			$data['variable'] = new operation_center;
			$data['variable']->order_by('id','ASC')->get();


			$this->template->build("requests/report",$data);
		} else {
			redirect("admin/requests");
		}
	}

	public function prints($id) {
		$data["value"] = new Request_Rain($id);
		$this->load->view("requests/print",$data);
	}

	public function pdf($uid) {
		$data["value"] = new Request_Rain();
		$data["value"]->where("uid",$uid)->get(1);

		$this->load->view("requests/pdf",$data);
	}

	public function get_district($id,$target) {
		echo "ตำบล<span class=\"text_error\" >*</span> ".@form_dropdown($target."_district_id",get_option("id","title","ma_district","WHERE AMPHUR_ID = $id ORDER BY TITLE ASC"),null,"class=\"form-control\"","-- เลือกตำบล --");
	}

	public function get_amphur($id,$target) {
		if($target=="area") {
			echo "อำเภอ<span class=\"text_error\" >*</span> ".@form_dropdown($target."_amphur_id[]",get_option("id","title","ma_amphur","WHERE PROVINCE_ID = $id ORDER BY TITLE ASC"),null,"class=\"form-control select-amphur\" data-target=\"$target\" style=\"margin: 0;\" ","-- เลือกอำเภอ --");
		} else {
			echo "อำเภอ<span class=\"text_error\" >*</span> ".@form_dropdown($target."_amphur_id",get_option("id","title","ma_amphur","WHERE PROVINCE_ID = $id ORDER BY TITLE ASC"),null,"class=\"form-control select-amphur\" data-target=\"$target\"","-- เลือกอำเภอ --");
		}
	}

	public function get_amphur_area($id) {
		echo "<br class=\"more-area\" /><span class=\"more-area\" style=\"margin-left: 46px;\" >".@form_dropdown("area_amphur_id[]",get_option("id","title","ma_amphur","WHERE PROVINCE_ID = $id ORDER BY TITLE ASC"),null,"class=\"form-control\" style=\"margin: 5px 0; width: 200px; display: inline;\" ","-- เลือกอำเภอ --")."</span><button type=\"button\" class=\"btn btn-danger delete-area more-area\" style=\"margin-left: 5px;\" ><i class=\"glyphicon glyphicon-trash\" ></i></button>";
	}

	public function get_progess_area($id,$main=false) {
		if($main) {
			echo form_dropdown("help_amphur_id[]",get_option("id","title","ma_amphur","WHERE province_id = $id ORDER BY title ASC"),null,"class=\"form-control\" style=\"display: inline; width: 180px; margin-bottom: 5px;\" ","เลือกอำเภอ","");
		} else {
			echo "<br class=\"progess-more-area\" />".form_dropdown("help_amphur_id[]",get_option("id","title","ma_amphur","WHERE province_id = $id ORDER BY title ASC"),null,"class=\"form-control progess-more-area\" style=\"display: inline; width: 180px; margin-bottom: 5px;\" ","เลือกอำเภอ","");
		}
	}

	public function deletefile($id)
	{
		$data = new Request_Rain($id);
		@unlink('requests/'.$data->file_path);
		$data->file_path = null;
		$data->save();
	}

	public function deleteprogessfile($id)
	{
		$data = new Request_Rain_Progess($id);
		@unlink('requests/'.$data->file_path);
		$data->file_path = null;
		$data->save();
	}

	public function deleteprogess($id)
	{
		$data = new Request_Rain_Progess($id);

		$request = $data->request_rain_id;

		@unlink('requests/'.$data->file_path);
		$data->delete();

		$this->generateProgess($request);
	}

	public function truncatebyjack()
	{
		$table = array(
						'ma_request_rain',
						'ma_request_rain_area_amphur',
						'ma_request_rain_area_province',
						'ma_request_rain_progess',
						'ma_request_rain_progess_amphur',
						'ma_request_rain_progess_province'
					);

		foreach ($table as $value) {
			$this->db->truncate($value);
		}
	}

	public function generateProgess($id)
	{
		$data = new Request_Rain_Progess;
		$data->where('request_rain_id',$id)->order_by('progess_date','DESC')->get(1);

		$request = new Request_Rain($id);
		$request->status_id = $data->request_rain_status_id;
		$request->save();
	}

	public function generatePDF()
	{
		$variable = new Request_Rain;
		$variable->order_by('id','ASC')->get();

		foreach ($variable as $key => $value) {
			$this->pdf($value->uid);
		}
	}

	public function generateCenter()
	{
		$variable = new Request_Rain_Progess;
		$variable->get();

		foreach ($variable as $key => $value) {
			$progess = new Request_Rain_Progess($value->id);
			$progess->help_center_id = $value->user->center->org_id;
			$progess->help_center_title = $value->user->center->center_name;
			$progess->save();
		}
	}

}
