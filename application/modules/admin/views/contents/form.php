<div class="col-lg-12">
	<h1 class="page-header"><?php echo($group->title) ? $group->title : "ข่าว"?></h1>
</div>

<form class="form-horizontal" role="form" action="admin/contents/save/<?php echo $value->id?>" method="post" >
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ประเภทเรื่อง</label>
		<div class="col-lg-4" >
			<?php
				if(permission("content_groups","views")) {
					echo form_dropdown("content_group_id",get_option("id", "title", "ma_content_group",$where),$value->content_group_id,"class=\"form-control\"");
				} else {
					echo form_dropdown("content_group_id",get_option("id", "title", "ma_content_group",$where),$value->content_group_id,"class=\"form-control\"");
					//	echo form_hidden("content_group_id",($value->content_group_id) ? $value->content_group_id : @$_GET["g"]);
				}
			?>
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ชื่อเรื่อง</label>
		<div class="col-lg-8" >
			<input type="text" class="form-control" name="title" placeholder="กรอกชื่อเรื่อง" value="<?php echo $value->title?>" />
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >เนื้อหา</label>
		<div class="col-lg-4" >
			<textarea class="form-control" name="detail" ><?php echo $value->detail?></textarea>
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >รูปภาพหัวเรื่อง</label>
		<div class="col-lg-4" >
			<div class="input-group">
			    <input type="text" id="image_path" class="form-control" name="image_path" placeholder="รูปภาพหัวเรื่อง" value="<?php echo $value->image_path?>" />
			    <span class="input-group-btn">
			    	<a href="js/tinymce/plugins/filemanager/dialog.php?type=1&field_id=image_path" class="btn btn-primary iframe-btn" >เลือกรูปภาพ</a>
				</span>
			</div>
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >แนบไฟล์</label>
		<div class="col-lg-4" >
			<div class="input-group">
			    <input type="text" id="file_path" class="form-control" name="file_path" placeholder="เลือกไฟล์" value="<?php echo $value->file_path?>" />
			    <span class="input-group-btn">
			    	<!-- <button type="button" class="btn btn-primary" onclick="browser('file','file_path')" >เลือกไฟล์</button> -->
			    	<a href="js/tinymce/plugins/filemanager/dialog.php?type=2&field_id=file_path" class="btn btn-primary iframe-btn" >เลือกไฟล์</a>
				</span>
			</div>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" ></span> ยีนยัน</button>
			<a href="admin/contents?g=<?php echo @$_GET["g"]?>" class="btn btn-danger" > ยกเลิก</a>
		</div>
	</div>
	
</form>

<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/tinymce/config.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		
		tiny("detail","<?php echo base_url()?>");
		
	});
</script>