<div class="col-lg-12">
	<h1 class="page-header">ตั้งค่า หนังสืออิเล็กทรอนิกส์</h1>
</div>

<form class="form-horizontal" role="form" action="admin/ebooks/setting_save/<?php echo @$rs->id?>" method="post" enctype="multipart/form-data">
	<div class="form-group" >
		<label style="text-align:left;" class="col-sm-12 control-label" >การตั้งค่า<hr></label>
	</div>
		<div class="form-group" >
			<label for="size" class="col-sm-2 control-label" >ขนาดไฟล์</label>
			<div class="col-lg-4" > <input type="text" class="form-control" name="size" placeholder="ขนาดไฟล์" style="display:inline-block; width:100px;" value="<?php echo @$rs['size']?>" /> KB </div>
		</div>
	<hr>

	<div class="form-group" >
		<label style="text-align:left;" class="col-sm-12 control-label" >การแสดงผล<hr></label>
	</div>
		<div class="form-group" >
			<label for="width" class="col-sm-2 control-label" >ความกว้าง</label>
			<div class="col-lg-4" >
				<input type="text" class="form-control" style="display:inline-block; width:100px;" name="width" placeholder="ความกว้าง" value="<?php echo @$rs['width']?>" /> PX
			</div>
		</div>
		<div class="form-group" >
			<label for="height" class="col-sm-2 control-label" >ความสูง</label>
			<div class="col-lg-4" >
				<input type="text" class="form-control" name="height" style="display:inline-block; width:100px;" placeholder="ความสูง" value="<?php echo @$rs['height']?>" /> PX
			</div>
		</div>
	<div class="form-group text-right">
		<button type='submit' class='btn btn-success'>บันทึกข้อมูล</button>
	</div>