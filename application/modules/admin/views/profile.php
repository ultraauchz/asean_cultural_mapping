<div class="col-lg-12">
	<h1 class="page-header"><?php echo $value->username?></h1>
</div>

<form class="form-horizontal" role="form" action="admin/settings/profile/save" method="post" >
	
	<div class="form-group" >
		<label for="username" class="col-sm-2 control-label" >ชื่อผู้ใช้งาน <span style="color: red">*</span></label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" value="<?php echo $value->username?>" disabled />
		</div>
	</div>
	
	<div class="form-group" >
		<label for="email" class="col-sm-2 control-label" >อีเมล์ <span style="color: red">*</span></label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="email" placeholder="อีเมล์" value="<?php echo $value->email?>" />
		</div>
	</div>
	
	<hr />
	
	<div class="form-group" >
		<label for="firstname" class="col-sm-2 control-label" >ชื่อ <span style="color: red">*</span></label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="firstname" placeholder="ชื่อ" value="<?php echo $value->firstname?>" />
		</div>
	</div>
	
	<div class="form-group" >
		<label for="lastname" class="col-sm-2 control-label" >นามสกุล <span style="color: red">*</span></label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="lastname" placeholder="นามสกุล" value="<?php echo $value->lastname?>" />
		</div>
	</div>
	
	<div class="form-group" >
		<label for="tel" class="col-sm-2 control-label" >เบอร์โทร <span style="color: red">*</span></label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="tel" placeholder="เบอร์โทร" value="<?php echo $value->tel?>" />
		</div>
	</div>
	
	<div class="form-group" >
		<label for="per_cardno" class="col-sm-2 control-label" >หมายเลขบัตรประชาชน <span style="color: red">*</span></label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="per_cardno" placeholder="หมายเลขบัตรประชาชน" value="<?php echo $value->per_cardno?>" />
		</div>
	</div>
	
	<hr />
	
	<?php if($value->id):?>
	<div class="form-group" >
		<label class="col-lg-6 control-label" >เปลี่ยนรหัสผ่าน <span style="color: red">* (ถ้าต้องการใช้รหัสผ่านเดิมไม่ต้องกรอก)</span></label>
	</div>
	<?php endif?>
	
	<div class="form-group" >
		<label for="password" class="col-sm-2 control-label" >รหัสผ่าน <span style="color: red">*</span></label>
		<div class="col-lg-4" >
			<input type="password" class="form-control" name="password" placeholder="รหัสผ่าน" />
		</div>
	</div>
	
	<div class="form-group" >
		<label for="passwords" class="col-sm-2 control-label" >ยืนยันรหัสผ่าน <span style="color: red">*</span></label>
		<div class="col-lg-4" >
			<input type="password" class="form-control" name="passwords" placeholder="ยืนยันรหัสผ่าน" />
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" ></span> ยืนยัน</button>
			<a href="admin" class="btn btn-danger" > ยกเลิก</a>
		</div>
	</div>
	
</form>