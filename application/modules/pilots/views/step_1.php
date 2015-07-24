<p>๑. ข้อมูลส่วนตัว</p>
<table class="table table-bordered table-responsive table-striped" >
	
	<thead class="hidden" >
		<tr>
			<th style="width: 460px;"></th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	
	<tbody>
		
		<tr>
			<td>
				<label>ชื่อและนามสกุล (โปรดระบุยศ)</label><br />
				<select name="sex_id" style="width: 90px;" >
					<option value="1" >นาย</option>
					<option value="2" >นาง</option>
					<option value="3" >นางสาว</option>
				</select>
				
				<input type="text" class="form-control" name="fullname" style="width: 350px;" />
			</td>
			<td style="text-align: center;" >
				<label>ลงทะเบียนตำแหน่ง</label><br />
				<input type="text" class="form-control" name="registration_position" style="width: 130px;" />
			</td>
			<td style="text-align: center;" >
				<label>วันที่ลงทะเบียน</label><br />
				<input type="text" class="form-control" name="registration_date" style="width: 130px;" />
			</td>
		</tr>
		
		<tr>
			<td>
				<label>ที่อยู่ที่ติดต่อได้</label><br />
				<textarea class="form-control" rows="5" style="width: 440px;" ></textarea>
			</td>
			<td style="text-align: center;" >
				<label>ชื่อเล่น</label><br />
				<input type="text" class="form-control" name="registration_position" style="width: 130px;" />
			</td>
			<td style="text-align: center;" >
				<label>อายุ (ปี)</label><br />
				<input type="number" class="form-control" name="registration_date" style="width: 130px;" />
			</td>
		</tr>
		
		<tr>
			<td>
				<label>หมายเลขโทรศัพท์บ้าน</label>
				<input type="text" class="form-control" name="fullname" style="width: 300px; margin: 3px 0;" /><br />
				
				<label>หมายเลขโทรศัพท์มือถือ</label>
				<input type="text" class="form-control" name="fullname" style="width: 290px; margin: 3px 0;" /><br />
				
				<label>E-mail Address</label>
				<input type="text" class="form-control" name="fullname" style="width: 338px; margin: 3px 0;" />
			</td>
			<td style="text-align: center;" >
				<label>วัน/เดือน/ปีเกิด</label><br />
				<input type="text" class="form-control" name="registration_position" style="width: 130px;" />
			</td>
			<td style="text-align: center;" >
				<label>สถานที่เกิด (จังหวัด)</label><br />
				<?php echo form_dropdown("registration_born_province",get_option("id","title","ma_province","ORDER BY TITLE ASC"),1,"class=\"form-control\" style=\"width: 130px;\" ")?>
			</td>
		</tr>
		
		<tr>
			<td>
				<label>หมายเลขโทรศัพท์บ้าน</label>
				<input type="text" class="form-control" name="fullname" style="width: 300px; margin: 3px 0;" /><br />
				
				<label>ออกให้ที่อำเภอ/เขต</label>
				<select class="form-control" style="width: 140px;" disabled ><option value="" >--เลือกอำเภอ/เขต--</option></select>
				<label>จังหวัด</label>
				<?php echo form_dropdown("personal_card_province_id",get_option("id","title","ma_province","ORDER BY TITLE ASC"),1,"class=\"form-control\" style=\"width: 140px;\" ")?>
				<br />
				
				<label>วัน เดือน ปีที่ออกบัตร</label>
				<input type="text" class="form-control datepicker" id="personal_card_start" name="personal_card_start" readonly style="width: 115px; margin: 3px 0;" />
				<label>หมดอายุ</label>
				<input type="text" class="form-control datepicker" id="personal_card_end" name="personal_card_end" readonly style="width: 115px; margin: 3px 0;" />
			</td>
			<td style="text-align: center;" >
				<label>เชื้อชาติ</label><br />
				<input type="text" class="form-control" name="extraction" style="width: 130px;" />
			</td>
			<td style="text-align: center;" >
				<label>สัญชาติ</label><br />
				<input type="text" class="form-control" name="nationality" style="width: 130px;" />
			</td>
		</tr>
		
		<tr>
			<td>
				<label>ส่วนสูง</label>
				<input type="text" class="form-control" name="height" style="width: 140px; margin: 3px 0;" />
				<label>น้ำหนัก</label>
				<input type="text" class="form-control" name="weight" style="width: 140px; margin: 3px 0;" />
				<br />
				
				<label>ตำหนิ</label>
				<input type="text" class="form-control" name="fullname" style="width: 400px; margin: 3px 0;" />
			</td>
			<td style="text-align: center;" >
				<label>สถานภาพสมรส</label><br />
				<input type="text" class="form-control" name="marital_status" style="width: 130px;" />
			</td>
			<td style="text-align: center;" >
				<label>ศาสนา</label><br />
				<input type="text" class="form-control" name="religion" style="width: 130px;" />
			</td>
		</tr>
		
		<tr>
			<td>
				<label>อาชีพปัจจุบัน</label><br />
				<input type="text" class="form-control" name="height" style="width: 440px; margin: 3px 0;" /><br />
				
				<label>เหตุผลที่ (อยาก) เป็นนักบินฝนหลวง</label><br />
				<textarea class="form-control" rows="5" style="width: 440px;" ></textarea>
			</td>
			<td style="text-align: center;" >
				<label>ประเภทนักบิน (บ,ฮ)</label><br />
				<input type="text" class="form-control" name="pilot_category_id" style="width: 130px;" />
			</td>
			<td style="text-align: center;" >
				<label>ชั่วโมงบินรวม</label><br />
				<input type="number" class="form-control" name="flight_hours" style="width: 130px;" />
			</td>
		</tr>
		
	</tbody>
</table>

<a href="#step2" class="btn btn-primary pull-right tab-step" data-li="2" >ขั้นตอนต่อไป</a>