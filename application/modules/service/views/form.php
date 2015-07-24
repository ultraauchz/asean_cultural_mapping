<?php if($this->session->flashdata("msg")):?>
<div class="alert alert-danger text-center" role="alert">
	<strong>ผิดพลาด กรุณาตรวจสอบข้อมูล</strong>
	<br />

	<?php echo $this->session->flashdata("msg")?>
</div>
<?php endif?>

<form id="form-request" action="service/send" method="post" >
	<!--<div id='test'>test</div>-->
	<div class="alert alert-error" style='display:none;'>
		<span id="error_firstname" ></span>
		<span id="error_lastname" ></span>
		<span id="error_sex" ></span>
		<span id="error_age" ></span>
		<span id="error_personal_id" ></span>
		<span id="error_tel_number" ></span>
		<span id="error_email" ></span>
		<span id="error_address_number" ></span>
		<span id="error_address_province_id" ></span>
		<span id="error_address_amphur_id" ></span>
		<span id="error_address_district_id" ></span>
		<span id="error_personal_type_id" ></span>
		<span id="error_victim_id" ></span>
		<span id="error_area_province_id" ></span>
		<span id="error_area_amphur_id" ></span>
		<span id="error_not_rain" ></span>
		<span id="error_request_rain_day" ></span>
		<span id="error_request_rain_dam_id" ></span>
		<span id="error_for_text_2_1"></span>
		<span id="error_for_text_2_2"></span>
		<span id="error_for_text_2_3"></span>
		<span id="error_for_text_2_4"></span>
		<span id="error_for_text_2_5"></span>
		<span id="error_for_text_2_6"></span>
		<span id="error_for_text_3"></span>
		<span id="error_for_text_4"></span>
		<span id="error_for_text_other"></span>
		<span id="error_dam_far" ></span>
		<span id="error_water_level" ></span>
		<span id="error_recall_type" ></span>
		<span id="error_recall_firstname" ></span>
		<span id="error_recall_lastname" ></span>
		<span id="error_recall_tel_number" ></span>
		<span id="error_recall_number" ></span>
		<span id="error_recall_province_id" ></span>
		<span id="error_recall_amphur_id" ></span>
		<span id="error_recall_district_id" ></span>
		<span id="error_numeral" ></span>
		<span id="error_recall_firstnam"></span>
		<span id="error_recall_lastname"></span>
		<span id="error_recall_tel_number"></span>
		<span id="error_recall_number"></span>
		<span id="error_recall_province_id"></span>
		<span id="error_recall_amphur_id"></span>
		<span id="error_recall_district_id"></span>
	</div>

<table class="table table-bordered">
	<tr>
		<th style="background-color: #fcf8e3;" >ชื่อผู้ขอรับบริการ</th>
	</tr>
	<tr>
		<td>
			<span>ชื่อ<span class="requestTxt" >*</span> <input type="text" name="firstname" /></span>
			<span>นามสกุล<span class="requestTxt" >*</span> <input type="text" name="lastname" /></span>
			<span>เพศ<span class="requestTxt" >*</span>
				<select name="sex" style="width: 80px;" >
					<option value="1" >ชาย</option>
					<option value="2" >หญิง</option>
				</select>
			</span>
			<span>อายุ<span class="requestTxt" >*</span> <input type="text" name="age" style="width: 60px;" /></span>
			<br />

			<span>เลขประจำตัวประชาชน<span class="requestTxt" >*</span> <input type="text" name="personal_id" maxlength="13" style="width: 120px;" /></span>
			<span>หมายเลขโทรศัพท์<span class="requestTxt" >*</span> <input type="text" name="tel_number" style="width: 100px;" /></span>
			<span>อีเมล์ <input type="text" name="email" style="width: 200px;" ></span>
		</td>
	</tr>

	<tr>
		<th style="background-color: #fcf8e3;" >ที่อยู่</th>
	</tr>
	<tr>
		<td>
			<span>บ้านเลขที่<span class="requestTxt" >*</span> <input type="text" name="address_number" style="width: 80px;" ></span>
			<span>หมู่ที่ <input type="text" name="address_moo" maxlength="2" style="width:40px;" ></span>
			<span>ซอย <input type="text" name="address_soi" style="width: 140px;" ></span>
			<span>ถนน <input type="text" name="address_road" style="width: 140px;" ></span>
			<br />

			<span>จังหวัด<span class="requestTxt">*</span> <?php echo form_dropdown("address_province_id",get_option("id","title","ma_province","ORDER BY TITLE ASC"),null,"class=\"form-control select-province\" data-target=\"address\" style=\"display: inline; width: 180px;\"","-- เลือกจังหวัด --")?></span>
			<span id="address-amphur" >อำเภอ<span class="requestTxt" >*</span> <?php echo @form_dropdown("address_amphur_id",null,null,"class=\"form-control  select-amphur\" data-target=\"address\" style=\"display: inline; width: 180px;\" disabled","-- เลือกอำเภอ --")?></span>
			<span id="address-district" >ตำบล<span class="requestTxt" >*</span> <?php echo @form_dropdown("address_district_id",null,null,"class=\"form-control\" data-target=\"address\" style=\"display: inline; width: 180px;\" disabled","-- เลือกตำบล --")?></span>
			<br />

			<span>รหัสไปรษณีย์ <input type="text" name="address_code" maxlength="5" style="width: 50px;" ></span>
		</td>
	</tr>

	<tr>
		<th style="background-color: #fcf8e3;" >สถานะผู้ขอรับบริการ<span class="requestTxt" >*</span></th>
	</tr>
	<tr>
		<td>
			<span style="display: inline-block; padding: 5px;"><input type="radio" name="personal_type_id" value="1" checked > บุคคลทั่วไป</span>
			<br />
			<span style="display: inline-block; padding: 5px;"><input type="radio" name="personal_type_id" value="2" > อาสาสมัครฝนหลวง</span>
			<br />
			<span style="display: inline-block; padding-left: 5px;"><input type="radio" name="personal_type_id" value="3" > หน่วยงานราชการ <input type="text" class="personal_type" name="personal_type_3" style="width: 120px;" disabled ></span>
			<br />
			<span style="display: inline-block; padding-left: 5px;"><input type="radio" name="personal_type_id" value="4" > หน่วยงานเอกชน <input type="text" class="personal_type" name="personal_type_4" style="width: 120px;" disabled ></span>
			<br />
			<span style="display: inline-block; padding-left: 5px;"><input type="radio" name="personal_type_id" value="5" > อื่นๆ <input type="text" class="personal_type" name="personal_type_5" style="width: 120px;" disabled ></span>
			<br />
		</td>
	</tr>

	<tr>
		<th style="background-color: #fcf8e3;" >รายละเอียดพื้นที่ขอรับบริการฝนหลวง</th>
	</tr>
	<tr>
		<td>
			<input type="hidden" id="count-province" value="1" />
			<span>พื้นที่ที่ต้องการฝน จังหวัด<span class="requestTxt" >*</span></span>
			<div id="main-area" >
				<?php
					if(!@$uid) {
						$uid = uniqid();
					}
					echo @form_dropdown("area_province_id[]",get_option("id","title","ma_province","ORDER BY TITLE ASC"),null,"id=\"main-province\" class=\"form-control select-province\" data-target=\"area\" data-uid=\"$uid\" style=\"display: inline; margin: 0; width: 180px;\"","-- เลือกจังหวัด --");
				?>
				<div id="<?php echo $uid?>-amphur" class="area-amphur" ><?php echo @form_dropdown("$uid",null,null,"class=\"form-control\"  style=\"display: inline; width: 180px; margin: 0;\"","-- เลือกอำเภอ --")?></div>
				<div class="area-amphur" >
					<button type="button" id="add-province" class="btn btn-success" data-loading-text="Loading..." >เพิ่มจังหวัด</button>
				</div>
				<div>
					<input type="text" id="<?php echo $uid?>" class="tagsinput" name="area_amphur_id[]" readonly />
				</div>
			</div>

			<hr />

			<div id="last-area" class="clearfix" >&nbsp;</div>

			<span>ฝนไม่ตกมา<span class="requestTxt" >*</span> <input type="number" name="not_rain" style="display: inline; width: 60px;" /> วัน</span>
			<span>ต้องการน้ำฝนอย่างต่อเนื่อง<span class="requestTxt" >*</span> <input type="number" name="request_rain_day" style="display: inline; width: 60px;" /> วัน</span>
			<br />

				<span>ประเภทความเดือดร้อน (เลือกได้มากกว่า 1 ข้อ)</span>
				<br />

					<div>
						<input type="checkbox" class="checkbox-inline checkbox" name="for_1" value="1" style="margin-left: 40px;" > การอุปโภคบริโภค
					</div>

					<div>
						<input type="checkbox" class="checkbox-inline checkbox" name="for_2" value="1" data-target="for_2" data-root="1" style="margin-left: 40px;" > การเกษตร (โปรดระบุชนิดของพีช และสามารถเลือกได้มากกว่า 1 ข้อ)
					</div>

						<div style="margin-left: 60px;" >
							<div class="div-for">
								<input type="checkbox" id="for_2_1" class="checkbox-inline checkbox for_2" name="for_2_1" data-target="for_2_1" data-parent="for_2" value="1" disabled > นาปี/นาปรัง
								<input type="text" class="for_2_1" name="for_text_2_1" data-parent="for_2" style="width: 60px;" disabled > ไร่
							</div>

							<div class="div-for" >
								<input type="checkbox" id="for_2_2" class="checkbox-inline checkbox for_2" name="for_2_2" data-target="for_2_2" data-parent="for_2" value="1" disabled > ข้าวโพดเลี้ยงสัตว์
								<input type="text" class="for_2_2" name="for_text_2_2" data-parent="for_2" style="width: 60px;" disabled > ไร่
							</div>
						</div>

						<div style="margin-left: 60px;" >
							<div class="div-for">
								<input type="checkbox" id="for_2_3" class="checkbox-inline checkbox for_2" name="for_2_3" data-target="for_2_3" data-parent="for_2" value="1" disabled > มันสำปะหลัง
								<input type="text" class="for_2_3" name="for_text_2_3" data-parent="for_2" style="width: 60px;" disabled > ไร่
							</div>

							<div class="div-for" >
								<input type="checkbox" id="for_2_4" class="checkbox-inline checkbox for_2" name="for_2_4" data-target="for_2_4" data-parent="for_2" value="1" disabled > อ้อย
								<input type="text" class="for_2_4" name="for_text_2_4" data-parent="for_2" style="width: 60px;" disabled > ไร่
							</div>
						</div>

						<div style="margin-left: 60px;" >
							<div class="div-for">
								<input type="checkbox" id="for_2_5" class="checkbox-inline checkbox for_2" name="for_2_5" data-target="for_2_5" data-parent="for_2" value="1" disabled > ปาล์มน้ำมัน
								<input type="text" class="for_2_5" name="for_text_2_5" data-parent="for_2" style="width: 60px;" disabled > ไร่
							</div>

							<div class="div-for" >
								<input type="checkbox" id="for_2_6" class="checkbox-inline checkbox for_2" name="for_2_6" data-target="for_2_6" data-parent="for_2" value="1" disabled > สวนผลไม้
								<input type="text" class="for_2_6" name="for_text_2_6" data-parent="for_2" style="width: 60px;" disabled > ไร่
							</div>
						</div>

					<div>
						<input type="checkbox" id="for_3" class="checkbox-inline checkbox" name="for_3" value="1" data-target="for_3" style="margin-left: 40px;" > การปศุสัตว์
						<input type="text" class="for_3" name="for_text_3" style="width: 250px;" disabled >
					</div>

					<div>
						<input type="checkbox" id="for_4" class="checkbox-inline checkbox" name="for_4" value="1" data-target="for_4" style="margin-left: 40px;" > การประมง
						<input type="text" class="for_4" name="for_text_4" style="width: 250px;" disabled >
					</div>

					<div>
						<input type="checkbox" id="for_other" class="checkbox-inline checkbox" name="for_other" value="1" data-target="for_other" style="margin-left: 40px;" > อื่นๆ (โปรดระบุ)
						<input type="text" class="for_other" name="for_text_other" style="width: 250px;" disabled >
					</div>

				<span>พื้นที่ที่ต้องการฝนอยู่ในเขตชลประทาน</span>
					<div style="margin-left: 40px;"><input type="radio" class="radio-inline radio" name="in_area" value="1" > ใช่</div>
					<div style="margin-left: 40px;">
						<input type="radio" class="radio-inline radio" name="in_area" value="2" > ไม่ใช่ โปรดระบุแหล่งน้ำ
						<input type="text" name="in_area_text" style="width: 250px;" disabled >
					</div>
					<div style="margin-left: 40px;"><input type="radio" class="radio-inline radio" name="in_area" value="0" checked > ไม่ทราบ</div>
		</td>
	</tr>

	<tr>
		<th style="background-color: #fcf8e3;" >รายละเอียดการติดต่อกลับ</th>
	</tr>
	<tr>
		<td>
			<span style="margin-left: 5px;" ><input type="radio" name="recall_type" value="1" checked /> ผู้ขอรับบริการ</span><br />
			<span style="margin-left: 5px;" ><input type="radio" id="recall_type_2" name="recall_type" value="2" /> บุคคลอื่่น</span>

			<div id="is_recall_type_2" style="margin-left: 20px; display: none;" >
				<span>ชื่อ<span class="requestTxt" >*</span> <input type="text" name="recall_firstname" style="display: inline-block; width: 130px;" /></span>
				<span>นามสกุล<span class="requestTxt" >*</span> <input type="text" name="recall_lastname" style="display: inline-block; width: 150px;" /></span>
				<br />

				<span>โทรศัพท์<span class="requestTxt" >*</span> <input type="text" name="recall_tel_number" style="width: 200px; display:inline;" /></span>
				<span>อีเมล์ <input type="text" name="recall_email" style="width: 250px; display:inline;" /></span>
				<br />

				<span>บ้านเลขที่<span class="requestTxt" >*</span> <input type="text" name="recall_number" style="display:inline-block;width: 80px;" /></span>
				<span>หมู่ที่ <input type="text" name="recall_moo" style="display:inline-block;width: 50px;" /></span>
				<span>ซอย <input type="text" name="recall_soi" style="display:inline-block;width: 140px;" /></span>
				<span>ถนน <input type="text" name="recall_road" style="width: 140px; display: inline;" /></span>
				<br />

				<span>จังหวัด<span class="requestTxt" >*</span> <?php echo @form_dropdown("recall_province_id",get_option("id","title","ma_province","ORDER BY TITLE ASC"),null,"class=\"form-control select-province\" data-target=\"recall\" style=\"display: inline; width: 180px;\"","-- เลือกจังหวัด --")?></span>
				<span id="recall-amphur" >อำเภอ<span class="requestTxt" >*</span> <select disabled style="display: inline;width: 180px;" ><option>-- เลือกอำเภอ --</option></select></span>
				<span id="recall-district" >ตำบล<span class="requestTxt" >*</span> <select disabled style="display: inline;width: 180px;" ><option>-- เลือกตำบล --</option></select></span>
				<br />

				<span>รหัสไปรษณีย์ <input type="text" name="recall_address_code" maxlength="5" style="width: 80px; display: inline;" /></span>
			</div>
		</td>
	</tr>

	<tr class="active" >
		<th style="background-color: #fcf8e3;" >ข้อเสนอแนะ</th>
	</tr>
	<tr>
		<td><textarea name="other_detail" rows="7" style="width: 98%;" ></textarea></td>
	</tr>

	<tr>
		<td>
			<button type="submit" id="submit-service" class="btn btn-primary" ><span class="glyphicon glyphicon-ok"></span> ยืนยัน</button>
			<a href="index" class="btn btn-danger" ><span class="glyphicon glyphicon-remove" ></span> ยกเลิก</a>
		</td>
	</tr>

</table>
</form>

<link rel="stylesheet" type="text/css" href="js/tagsinput/bootstrap-tagsinput.css" >
<script type="text/javascript" src="js/tagsinput/bootstrap-tagsinput.js" ></script>
<script type="text/javascript" src="js/jquery.validate.min.js" ></script>
<style type="text/css" >
	input[type=number]::-webkit-inner-spin-button,
	input[type=number]::-webkit-outer-spin-button {
  		-webkit-appearance: none;
		margin: 0;
	}
	.blogBlk {
		background: none;
	}
	.requestTxt {
		color: #f00;
	}
	.alert.alert-error span {
  		display: block;
	}
	input.error {
  		border: #f00 1px solid;
	}
	.error {
		display: inline !important;
	}
	.div-for {
		display: inline-block;
		width: 40%;
	}
	.bootstrap-tagsinput {
		border: none;
		box-shadow: none;
	}
	.bootstrap-tagsinput input {
		display: none;
	}
	.area-amphur {
		display: inline-block;
	}
</style>

<script type="text/javascript">

	function formValidate() {
		$("#form-request").validate({
			rules: {
				firstname: {required: true},										//	ชื่อ
				lastname: {required: true},											//	นามสกุล
				sex: {required: true},												//	เพศ
				age: {required: true,number:true},									//	อายุ
				personal_id: {required: true,number: true,minlength: 13,maxlength: 13},	//	หมายเลขบัตรประชาชน
				email: {email: true},
				tel_number: {required: true,number: true},							//	หมายเลขโทรศัพท์
				address_number: {required: true},									//	บ้านเลขที่
				address_province_id: {required: true},								//	จังหวัด
				address_amphur_id: {required: true},								//	อำเภอ
				address_district_id: {required: true},								//	ตำบล
				personal_type_id: {required: true},									//	สถานะผู้ขอรับบริการ
				victim_id: {required: true},										//	ผู้เดือดร้อน
				area_province_id: {required: true},									//	จังหวัด
				//	"area_amphur_id[]": {required: true},							//	อำเภอ

				for_text_2_1: {required:"#for_2_1"},								//	นาปี/นาปรัง
				for_text_2_2: {required:"#for_2_2"},								//	ข้าวโพด/สัตว์เลี้ยง
				for_text_2_3: {required:"#for_2_3"},								//	มันสำปะหลัง
				for_text_2_4: {required:"#for_2_4"},								//	อ้อย
				for_text_2_5: {required:"#for_2_5"},								//	ปาล์มน้ำมัน
				for_text_2_6: {required:"#for_2_6"},								//	สวนผลไม้

				for_text_3: {required:"#for_3"},									//	การปศุสัตว์
				for_text_4: {required:"#for_4"},									//	การประมง
				for_text_other: {required:"#for_other"},							//	อื่นๆ (โปรดระบุ)

				recall_firstname: {required:"#recall_type_2:checked"},
				recall_lastname: {required:"#recall_type_2:checked"},
				recall_tel_number: {required:"#recall_type_2:checked"},
				recall_number: {required:"#recall_type_2:checked"},
				recall_province_id: {required:"#recall_type_2:checked"},
				recall_amphur_id: {required:"#recall_type_2:checked"},
				recall_district_id: {required:"#recall_type_2:checked"}
			},
			messages: {
				firstname: {required: "กรุณาระบุชื่อ"},											//	ชื่อ
				lastname: {required: "กรุณาระบุนามสกุล"},										//	นามสกุล
				sex: {required: "กรุณาเลือกเพศ"},												//	เพศ
				age: {required: "กรุณาระบุอายุ",number: "กรุณาใส่อายุเป็นตัวเลข"},					//	อายุ
				personal_id: {required: "กรุณาระบุหมายเลขบัตรประชาตัวประชาชน",
					number: "กรุณาระบุหมายเลขบัตรประชาตัวประชาชนเป็นตัวเลข",
					minlength: "กรุณาระบุหมายเลขบัตรประชาตัวประชาชนให้ครบ",
					maxlength: "กรุณาระบุหมายเลขบัตรประชาตัวประชาชนให้ครบ"},						//	หมายเลขบัตรประชาชน
				tel_number: {required: "กรุณาระบุหมายเลขโทรศัพท์",number: "กรุณาระบุหมายเลขโทรศัพท์เป็นตัวเลข"},		//	หมายเลขโทรศัพท์
				email: {email: "กรุณาระบุรูปแบบอีเมล์ให้ถูกต้อง"},
				address_number: {required: "กรุณาระบุที่อยู่"},									//	บ้านเลขที่
				address_province_id: {required: "กรุณาเลือกจังหวัด"},								//	จังหวัด
				address_amphur_id: {required: "กรุณาระบุเลือกอำเภอ"},							//	อำเภอ
				address_district_id: {required: "กรุณาระบุเลือกตำบล"},							//	ตำบล
				personal_type_id: {required: "กรุณาระบุเลือกสถานะผู้ขอรับบริการ"},					//	สถานะผู้ขอรับบริการ
				victim_id: {required: "กรุณาระบุประเภทผู้เดือดร้อน"},								//	ผู้เดือดร้อน
				area_province_id: {required: "กรุณาเลือกจังหวัดที่ขอฝน"},							//	จังหวัด
				"area_amphur_id[]": {required: "กรุณาเลือกอำเภอที่ขอฝน"},						//	อำเภอ

				for_text_2_1: {required: "กรุณาระบุพื้นที่ นาปี/นาปรัง"},						//	นาปี/นาปรัง
				for_text_2_2: {required: "กรุณาระบุพื้นที่ ข้าวโพด/สัตว์เลี้ยง"},					//	ข้าวโพด/สัตว์เลี้ยง
				for_text_2_3: {required: "กรุณาระบุพื้นที่ มันสำปะหลัง"},						//	มันสำปะหลัง
				for_text_2_4: {required: "กรุณาระบุพื้นที่ อ้อย"},								//	อ้อย
				for_text_2_5: {required: "กรุณาระบุพื้นที่ ปาล์มน้ำมัน"},						//	ปาล์มน้ำมัน
				for_text_2_6: {required: "กรุณาระบุพื้นที่ สวนผลไม้"},							//	สวนผลไม้

				for_text_3: {required: "กรุณาระบุพื้นที่ การปศุสัตว์"},							//	การปศุสัตว์
				for_text_4: {required: "กรุณาระบุพื้นที่ การประมง"},								//	การประมง
				for_text_other: {required: "กรุณาระบุพื้นที่อื่นๆ"},								//	อื่นๆ (โปรดระบุ)

				recall_firstname: {required:""},
				recall_lastname: {required:""},
				recall_tel_number: {required:""},
				recall_number: {required:""},
				recall_province_id: {required:""},
				recall_amphur_id: {required:""},
				recall_district_id: {required:""}
			},
			errorPlacement: function(error,element) {
				$('.alert.alert-error').show();
				if(element.attr('name')=='firstname') {
					$('#error_firstname').html(error);
				} else if(element.attr('name')=='lastname') {
					$('#error_lastname').html(error);
				} else if(element.attr('name')=='sex') {
					$('#error_sex').html(error);
				} else if(element.attr('name')=='age') {
					$('#error_age').html(error);
				} else if(element.attr('name')=='personal_id') {
					$('#error_personal_id').html(error);
				} else if(element.attr('name')=='tel_number') {
					$('#error_tel_number').html(error);
				} else if(element.attr('name')=='email') {
					$('#error_email').html(error);
				} else if(element.attr('name')=='address_number') {
					$('#error_address_number').html(error);
				} else if(element.attr('name')=='address_province_id') {
					$('#error_address_province_id').html(error);
				} else if(element.attr('name')=='address_amphur_id') {
					$('#error_address_amphur_id').html(error);
				} else if(element.attr('name')=='address_district_id') {
					$('#error_address_district_id').html(error);
				} else if(element.attr('name')=='personal_type_id') {
					$('#error_personal_type_id').html(error);
				} else if(element.attr('name')=='victim_id') {
					$('#error_victim_id').html(error);
				} else if(element.attr('name')=='area_province_id') {
					$('#error_area_province_id').html(error);
				} else if(element.attr('name')=="area_amphur_id/[/]") {
					$("#error_area_amphur_id/[/]").html(error);
				} else if(element.attr('name')=='for_text_2_1') {
					$('#error_for_text_2_1').html(error);
				} else if(element.attr('name')=='for_text_2_2') {
					$('#error_for_text_2_2').html(error);
				} else if(element.attr('name')=='for_text_2_3') {
					$('#error_for_text_2_3').html(error);
				} else if(element.attr('name')=='for_text_2_4') {
					$('#error_for_text_2_4').html(error);
				} else if(element.attr('name')=='for_text_2_5') {
					$('#error_for_text_2_5').html(error);
				} else if(element.attr('name')=='for_text_2_6') {
					$('#error_for_text_2_6').html(error);
				} else if(element.attr('name')=='for_text_3') {
					$('#error_for_text_3').html(error);
				} else if(element.attr('name')=='for_text_4') {
					$('#error_for_text_4').html(error);
				} else if(element.attr('name')=='for_text_other') {
					$('#error_for_text_other').html(error);
				} else if(element.attr('name')=='recall_firstname') {
					$('#error_recall_firstname').html(error);
				} else if(element.attr('name')=='recall_lastname') {
					$('#error_recall_lastname').html(error);
				} else if(element.attr('name')=='recall_tel_number') {
					$('#error_recall_tel_number').html(error);
				} else if(element.attr('name')=='recall_number') {
					$('#error_recall_number').html(error);
				} else if(element.attr('name')=='recall_province_id') {
					$('#error_recall_province_id').html(error);
				} else if(element.attr('name')=='recall_amphur_id') {
					$('#error_recall_amphur_id').html(error);
				} else if(element.attr('name')=='recall_district_id') {
					$('#error_recall_district_id').html(error);
				} else {
					error.insertAfter(element);
				}
				checkValidateboard();
			}, success: function(label) {

	    }//success:function()
			,submitHandler: function(form) {
	    	//alert('submitHandler');
				$('button[type=submit]').attr('disabled', true);
				form.submit();
	  	}

		});
	}

	function removeProvince() {
		var value = [];
		var i = 0;

		$('select[name="area_province_id[]"]').each(function(){
			value[i] = $(this).val();
			i++;
		})

		$.each(value, function(foo,bar) {
			$('.other-area .select-province option[value="'+bar+'"]').not(':checked').remove();
		})
	}

	function formTagsinput() {
		$('.tagsinput').tagsinput({
			itemValue: 'value',
			itemText: 'text',
			maxTags: 10
		});
	}

	function checkValidateboard() {
		if($('.alert-error .error').size() == 0) { //ยังไม่ได้ validate
			return false;
		} else {
			statusVBoard = false;
			for(i=0; i<$('.alert-error .error').size(); i++) {
				if($('.alert-error .error').eq(i).html() != '') {
					statusVBoard = true;
				}
			}

			if(statusVBoard == false) {
				$('.alert.alert-error').hide();
			} else {
				$('.alert.alert-error').show();
			}
		}
		//$('div#test').html($('.alert-error .error').size());
	}

	$(document).ready(function(){
		$('form').on('blur', 'input', function(){
			checkValidateboard();
		});

		$('form').on('blur', 'select', function(){
			checkValidateboard();
		});

		$('.alert.alert-error').hide();


		//Script prevention of repeated submit form. - สคริปป้องกันการบันทึกข้อมูลซ้ำ
		$('form').on('submit', function(){

		});






		formValidate();
		formTagsinput();

		$('body').on('change','.select-province[data-uid]', function(){
		})

		$('body').on('change','.add-area', function(){
			var uid = $(this).attr('data-uid');
			var value = $(this).val();
			var title = $(this).find('option:selected').text();

			if(value!='') {
				$('#'+uid).tagsinput('add',{'value':value,'text':title});
			}
			formValidate();
		})

		//	เพิ่มจังหวัด
		$("#add-province").click(function(){
			var id = $("#main-province").val();
			var target = $("#last-area");
			var c = $("#count-province");
			var num = c.val();
			var foo = 1;

			if(id!="" && num<10) {

				$('select[name="area_province_id[]"]').each(function(){
					if($(this).val()=='') {
						alert('กรุณาเลือกจังหวัดให้ครบก่อน');
						return false;
					}
				});

				var value = [];
				var i = 0;

				$('select[name="area_province_id[]"]').each(function(){
					value[i] = $(this).val();
					i++;
				})

				$.post("service/get_area/"+id, {province_id : value},function(data){
					num++;
					c.val(num);
					$(data).insertBefore(target);
					formTagsinput();
				})

			} else {
				if(num==10) {
					alert("ไม่สามารถเลือกได้เกิน 10 จังหวัด");
				} else {
					alert("กรุณาเลือกจังหวัดก่อน");
				}
			}
			formValidate();
		})

		//	ลบจังหวัด
		$("body").on("click",".btn-delete", function(){
			var btn = $(this);
			var c = $("#count-province");
			var num = c.val();

			num--;
			btn.parent().parent().next().remove();
			btn.parent().parent().remove();
			c.val(num);
			formValidate();
		})

		//	เลือกจังหวัด
		$("body").on("change",".select-province",function(){
			var id = $(this).val();
			var target = $(this).attr("data-target");

			if(target!="area") {
				$.get("service/get_amphur/"+id+"/"+target,function(data){
					$("#"+target+"-amphur").html(data);

					$("select[name="+target+"_district_id]").val("");
					$("select[name="+target+"_district_id]").attr("disabled",true);
				})
			} else {
				var uid = $(this).attr("data-uid");
				$('#'+uid).tagsinput('removeAll');
				$.get("service/get_amphur/"+id+"/"+target+"/"+uid,function(data){
					$("#"+uid+"-amphur").html(data);
				})
			}

			formValidate();
		});

		//	เลือกอำเภอ
		$("body").on("change",".select-amphur",function(){
			var id = $(this).val();
			var target = $(this).attr("data-target");
			$.get("service/get_district/"+id+"/"+target,function(data){
				$("#"+target+"-district").html(data);
			})

			formValidate();
		});

		//	สถานะผู้ขอรับบริการ
		$("[name=personal_type_id]").click(function(){
			var btn = $(this);
			var value = btn.val();

			if(value>2) {
				$(".personal_type").attr("disabled",true);
				$(".personal_type").val(null);
				$("[name=personal_type_"+value+"]").attr("disabled",false);
			} else {
				$(".personal_type").attr("disabled",true);
				$(".personal_type").val(null);
			}
			formValidate();
		})

		//	ประเภทความเดือดร้อน
		$("input[type=checkbox][data-target]").click(function(){
			var chk = $(this);
			var target = chk.attr("data-target");
			var root = chk.attr("data-root");

			if(chk.is(":checked")) {
				$("."+target).attr("disabled",false);
			} else {
				$("."+target).attr("checked",false);
				$("."+target).attr("disabled",true);
				$("input[type=text]."+target).val("");

				if(root=='1') {
					$("input[type=text][data-parent]").attr("disabled",true);
					$("input[type=text][data-parent]").val("");
				}
			}
			formValidate();
		})

		$("[name=in_area]").click(function(){
			var value = $(this).val();

			if(value==2) {
				$("[name=in_area_text]").attr("disabled",false);
			} else {
				$("[name=in_area_text]").attr("disabled",true);
				$("[name=in_area_text]").val("");
			}
			formValidate();
		})

		//	รายละเอียดการติดต่อกลับ
		$("[name=recall_type]").click(function(){
			var value = $(this).val();

			if(value==2) {
				$("#is_recall_type_2").show();
			} else {
				$("#is_recall_type_2").hide();
			}
			formValidate();
		})
	})
</script>
