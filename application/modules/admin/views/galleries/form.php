<div class="col-lg-12">
    <?php if($value->title):?>
	<h1 class="page-header"><?php echo $value->title?></h1>
    <?php else:?>
	<h1 class="page-header">อัลบั้มรูป</h1>
    <?php endif?>
</div>

<form class="form-horizontal" role="form" action="admin/galleries/save/<?php echo $value->id?>" method="post" >
	
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
			    <input type="text" id="file_path" class="form-control" name="file_path" placeholder="รูปภาพหัวเรื่อง" value="<?php echo $value->file_path?>" />
			    <span class="input-group-btn">
			    	<a href="js/tinymce/plugins/filemanager/dialog.php?type=2&field_id=file_path" class="btn btn-primary iframe-btn" >เลือกไฟล์</a>
				</span>
			</div>
		</div>
	</div>
	
	<?php if(@$value->id):?>
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >จำนวนรูปที่แสดงต่อหน้า</label>
		<div class="col-lg-4" >
			<input type="number" class="form-control" name="image_per_page" value="<?php echo $value->image_per_page?>" style="width: 80px;" />
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >อัพโหลดรูปภาพ</label>
		<div class="col-lg-4" >
			<div class="input-group">
				<input type="file" id="file_upload" name="file_upload" multiple="true" />
			    <button type="button" class="btn btn-default" onclick="javascript:$('#file_upload').uploadify('upload','*')" ><span class="glyphicon glyphicon-upload" ></span> อัพโหลด</button>
			</div>
		</div>
	</div>
	<?php endif?>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" ></span> Submit</button>
			<a href="admin" class="btn btn-danger" > Cancel</a>
		</div>
	</div>
	
</form>

<?php if(@$value->id):?>
<div class="col-sm-offset-2 col-sm-10" >
	<?php foreach ($value->image->get() as $num => $row):?>
	<a href="#" id="link-modal-<?php echo $row->id?>" data-toggle="modal" data-target="#modal-<?php echo $row->id?>" >
		<img src="<?php echo "gallery/thumbs/".$row->image_path?>" class="img-thumbnail" title="<?php echo $row->title?>" />
	</a>
	
	<div id="modal-<?php echo $row->id?>" class="modal fade">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
	                </button>
	                <img src="<?php echo "galleries/".$row->image_path?>" class="img-responsive" title="<?php echo $row->title?>" />
	            </div>
	            <div class="modal-body">
	            	<label>คำอธิบาย 
						<input type="text" id="title-<?php echo $row->id?>" class="form-control" name="modal-title" value="<?php echo $row->title?>" />
					</label>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-primary submit-modal" data-id="<?php echo $row->id?>" ><span class="glyphicon glyphicon-save"></span> บันทึก</button>
	                <button type="button" class="btn btn-danger delete-modal" data-id="<?php echo $row->id?>" ><span class="glyphicon glyphicon-trash"></span> ลบ</button>
	                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove" ></span> ปิด</button>
	            </div>
	        </div>
	    </div>
	</div>
	<?php endforeach?>
</div>

<div class="clearfix" >&nbsp;</div>
<?php endif?>

<link rel="stylesheet" href="js/uploadify/uploadify.css" />
<script type="text/javascript" src="js/uploadify/jquery.uploadify.js" ></script>
<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/tinymce/config.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		tiny("detail","<?php echo base_url()?>");
		
		$("#file_upload").uploadify({
			"auto"		: false,
			"swf"			: 'js/uploadify/uploadify.swf',
			"uploader"	: '../uploads/<?php echo $value->id?>',
			fileTypeDesc	: 'Image Files (*.jpg;*.jpeg;*.gif;*.png)',
			fileTypeExts	: '*.jpg;*.jpeg;*.gif;*.png',
			"onQueueComplete" : function() {
				$.ajax({
					url: "admin/galleries/countimage/<?php echo @$value->id?>"
				})
            	alert("Success");
        	}
		})
		
		$(".submit-modal").click(function(){
			var id = $(this).attr("data-id");
			var title = $("#title-"+id).val();
			$.post("admin/galleries/savetitle/"+id,{title:title});
			$("#modal-"+id).modal("toggle");
		})
		
		$(".delete-modal").click(function(){
			if(confirm("ต้องการลบรูปภาพนี้")) {
				var id = $(this).attr("data-id");
				$.ajax({url:"admin/galleries/delete_image/"+id});
				
				$("#modal-"+id).modal("toggle");
				$("#link-modal-"+id).fadeOut();
				$("#modal-"+id).fadeOut();
				
				setTimeout(function(){
					$("#link-modal-"+id).remove();
					$("#modal-"+id).remove();
				}, 1000);
			}
		})
		
	});
</script>