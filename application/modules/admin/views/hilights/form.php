<div class="col-lg-12">
    <?php if($value->title):?>
	<h1 class="page-header"><?php echo $value->title?></h1>
    <?php else:?>
	<h1 class="page-header">ไฮไลท์</h1>
    <?php endif?>
</div>

<form class="form-horizontal" role="form" action="admin/hilights/save/<?php echo $value->id?>" method="post" >

	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ชื่อเรื่อง</label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="title" placeholder="กรอกชื่อเรื่อง" value="<?php echo $value->title?>" />
		</div>
	</div>

	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ลิงค์</label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="links" placeholder="ลิงค์" value="<?php echo $value->links?>" />
		</div>
	</div>

	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >แนบรูปภาพ</label>
		<div class="col-lg-4" >
			<div class="input-group">
			    <input type="text" id="image_path" class="form-control" name="image_path" placeholder="รูปภาพหัวเรื่อง" value="<?php echo $value->image_path?>" />
			    <span class="input-group-btn">
			    	<a href="js/tinymce/plugins/filemanager/dialog.php?type=1&field_id=image_path" class="btn btn-primary iframe-btn" >เลือกไฟล์</a>
				</span>
			</div>
			<br />
			<span style="color:#f00;" >ขนาด 1100px x 244px</span>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" ></span> Submit</button>
			<a href="admin/hilights" class="btn btn-danger" > Cancel</a>
		</div>
	</div>

</form>

<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/tinymce/config.js"></script>