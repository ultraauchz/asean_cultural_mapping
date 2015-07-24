<div class="col-lg-12">
	<h1 class="page-header">ตั้งค่าทั่วไป</h1>
</div>

<form class="form-horizontal" role="form" action="admin/settings/social/save" method="post" >
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >อีเมล์ <span class="danger" ></span></label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="email" placeholder="อีเมล์ เช่น noreply@royalrain.go.th" value="<?php echo $value->email?>" />
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >Facebook</label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="facebook" placeholder="ลิงค์ Facebook เช่น https://www.facebook.com/user" value="<?php echo $value->facebook?>" />
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >Twitter</label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="twitter" placeholder="ลิงค์ Twitter เช่น https://twitter.com/user" value="<?php echo $value->twitter?>" />
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" ></span> ยืนยัน</button>
			<a href="admin" class="btn btn-danger" > ยกเลิก</a>
		</div>
	</div>
	
</form>