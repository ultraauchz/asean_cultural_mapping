<div class="col-lg-12">
	<h1 class="page-header">ลิงค์ตัวหนังสือ</h1>
</div>

<form class="form-horizontal" role="form" action="admin/slides/save/<?php echo $value->id?>" method="post" >
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ชื่อลิงค์</label>
		<div class="col-lg-8" >
			<input type="text" class="form-control" name="title" placeholder="กรอกชื่อเรื่อง" value="<?php echo $value->title?>" />
		</div>
	</div>
	
	<div id="route-2" class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ลิงค์</label>
		<div class="col-lg-8" >
			<input type="text" class="form-control" name="links" placeholder="กรอกชื่อลิงค์ ตัวอย่าง เช่น http://www.google.co.th" value="<?php echo $value->links?>" />
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" ></span> ยืนยัน</button>
			<a href="admin/slides" class="btn btn-danger" > ยกเลิก</a>
		</div>
	</div>
	
</form>