<div class="col-lg-12">
	<h1 class="page-header">เมนูด้านข้าง</h1>
</div>

<form class="form-horizontal" role="form" action="admin/sidebars/save/<?php echo $value->id?>" method="post" >
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ชื่อเว็บไซต์</label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="title" placeholder="กรอกชื่อเรื่อง" value="<?php echo $value->title?>" />
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ไอคอน</label>
		<div class="col-lg-6" >
			<div class="input-group">
			    <input type="text" id="image_path" class="form-control" name="image_path" placeholder="รูปภาพหัวเรื่อง" value="<?php echo $value->image_path?>" />
			    <span class="input-group-btn">
			    	<button type="button" class="btn btn-primary" onclick="browser('image','image_path')" >เลือกรูปภาพ</button>
				</span>
			</div>
		</div>
	</div>
	
	<div id="route-2" class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ลิงค์</label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="links" placeholder="กรอกชื่อลิงค์ ตัวอย่าง เช่น http://www.google.co.th" value="<?php echo $value->links?>" />
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" ></span> ยืนยัน</button>
			<a href="admin/sidebars" class="btn btn-danger" > ยกเลิก</a>
		</div>
	</div>
	
</form>

<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/tinymce/config.js"></script>