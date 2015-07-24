<div class="col-lg-12">
    <?php if($value->title):?>
	<h1 class="page-header"><?php echo $value->title?></h1>
    <?php else:?>
	<h1 class="page-header">เว็บลิ้งค์</h1>
    <?php endif?>
</div>

<form class="form-horizontal" role="form" action="admin/links/save/<?php echo $value->id?>" method="post" >
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ประเภทเว็บลิ้งค์</label>
		<div class="col-lg-4" >
			<?php echo form_dropdown("link_group_id",get_option("id", "title", "ma_link_group"),($value->link_group_id) ? $value->link_group_id : @$_GET["g"],"class=\"form-control\"")?>
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ชื่อเว็บไซต์</label>
		<div class="col-lg-6" >
			<input type="text" class="form-control" name="title" placeholder="ชื่อเว็บไซต์" value="<?php echo $value->title?>" />
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ลิงค์</label>
		<div class="col-lg-6" >
			<input type="text" class="form-control" name="url" placeholder="ลิงค์ เช่น http://www.google.com" value="<?php echo $value->url?>" />
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >คำอธิบาย</label>
		<div class="col-lg-6" >
			<textarea class="form-control" rows="4" name="detail" placeholder="กรอกคำอธิบาย"><?php echo $value->detail?></textarea>
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >Action</label>
		<div class="col-lg-6" >
			<?php echo form_dropdown("action",array('_self'=>'เปิดหน้าต่างเดิม','_blank'=>'เปิดหน้าต่างใหม่'),$value->action,"class=\"form-control\"")?>
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >แบนเนอร์</label>
		<div class="col-lg-4" >
			<div class="input-group">
			    <input type="text" id="file_path" class="form-control" name="image" placeholder="ภาพแบนเนอร์" value="<?php echo $value->image?>" />
			    <span class="input-group-btn">
			    	<!-- <button type="button" class="btn btn-primary" onclick="browser('file','file_path')" >เลือกไฟล์</button> -->
			    	<a href="js/tinymce/plugins/filemanager/dialog.php?type=2&field_id=file_path" class="btn btn-primary iframe-btn" >เลือกไฟล์</a>
				</span>
			</div>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" ></span> ยืนยัน</button>
			<a href="admin/links" class="btn btn-danger" > ยกเลิก</a>
		</div>
	</div>
	
</form>

<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/tinymce/config.js"></script>