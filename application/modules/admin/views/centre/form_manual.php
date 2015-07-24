<div class="col-lg-12">
	<h1 class="page-header">คู่มือการใช้งาน</h1>
</div>

<form class="form-horizontal" role="form" action="admin/centre/manage/save_manual/<?php echo $value->id?>" method="post" >
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >เมนูย่อย</label>
		<div class="col-lg-4" >
			<?php echo @form_dropdown('parent',get_option('id','title','ma_centre_manual','WHERE parent = 0 ORDER BY orders ASC'),@$value->parent,'class="form-control"','-- เลือกเมนูย่อย --',0);?>
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ชื่อเรื่อง</label>
		<div class="col-lg-4" >
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
		<label for="title" class="col-sm-2 control-label" >รูปแบบลิงค์</label>
		<div class="col-lg-4" >
			<label style="width: 250px;" ><input type="radio" name="link_type" value="1" <?php if($value->link_type==1 || $value->id==false) echo "checked"?> /> หัวข้อ</label><br />
			<label style="width: 250px;" ><input type="radio" name="link_type" value="2" <?php if($value->link_type==2) echo "checked"?> /> ลิงค์</label><br />
			<label style="width: 250px;" ><input type="radio" name="link_type" value="3" <?php if($value->link_type==3) echo "checked"?> /> แนบไฟล์</label><br />
		</div>
	</div>

	<div class="form-group" id="div-links" <?php if($value->link_type!=2 || empty($value->id)) echo 'style="display: none;"'?> >
		<label for="title" class="col-sm-2 control-label" >ลิงค์</label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="links" placeholder="กรอกลิงค์" value="<?php echo $value->links?>" />
		</div>
	</div>
	
	<div class="form-group" id="div-file" <?php if($value->link_type!=3 || empty($value->id)) echo 'style="display: none;"'?> >
		<label for="title" class="col-sm-2 control-label" >แนบไฟล์</label>
		<div class="col-lg-4" >
			<div class="input-group">
			    <input type="text" id="file_path" class="form-control" name="file_path" placeholder="เลือกไฟล์" value="<?php echo $value->file_path?>" />
			    <span class="input-group-btn">
			    	<a href="js/tinymce/plugins/filemanager/dialog.php?type=2&field_id=file_path" class="btn btn-primary iframe-btn" >เลือกไฟล์</a>
				</span>
			</div>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" ></span> ยีนยัน</button>
			<a href="admin/centre/manage" class="btn btn-danger" > ยกเลิก</a>
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

<script type="text/javascript">
	$(document).ready(function(){

		$('[name=link_type]').click(function(){
			var btn = $(this);
			var value = btn.val();
			var div_link = $('#div-links');
			var div_file = $('#div-file');

			if(value=='2') {
				div_link.show();
				div_file.hide();
			} else if(value=='3') {
				div_file.show();
				div_link.hide();
			}else {
				div_file.hide();
				div_link.hide();
			}
		})

	})
</script>