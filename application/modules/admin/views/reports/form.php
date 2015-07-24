<div class="col-lg-12">
    <?php if($value->title):?>
	<h1 class="page-header"><?php echo $value->title?></h1>
    <?php else:?>
	<h1 class="page-header">ผลการปฏิบัติการ</h1>
    <?php endif?>
</div>

<form class="form-horizontal" role="form" action="admin/reports/save/<?php echo $value->id?>" method="post" >
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >รูปแบบ</label>
		<div class="col-lg-4" >
			<select class="form-control" name="result_type_id" >
				<option value="0" <?php if($value->result_type_id==0) echo "selected"?> >รายวัน</option>
				<option value="1" <?php if($value->result_type_id==1) echo "selected"?> >รายสัปดาห์</option>
				<option value="2" <?php if($value->result_type_id==2) echo "selected"?> >รายเดือน</option>
			</select>
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ประเภท</label>
		<div class="col-lg-4" >
			<select class="form-control" name="deposits" >
				<option value="0" <?php if($value->deposits==0) echo "selected"?> >สรุปผลการปฏิบัติการฝนหลวง</option>
				<option value="1" <?php if($value->deposits==1) echo "selected"?> >รายงานสถานการณ์ภัยแล้งและภัยพิบัติ</option>
				<option value="2" <?php if($value->deposits==2) echo "selected"?> >กส.9</option>
			</select>
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ชื่อเรื่อง</label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="title" placeholder="กรอกชื่อเรื่อง" value="<?php echo $value->title?>" />
		</div>
	</div>
	
	<div class="form-group sr-only" >
		<label for="title" class="col-sm-2 control-label" >เนื้อหา</label>
		<div class="col-lg-4" >
			<textarea class="form-control" name="detail" ><?php echo $value->detail?></textarea>
		</div>
	</div>
	
	<div class="form-group" >
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
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >วันที่ลงข้อมูล</label>
		<div class="col-lg-4" >
			<div class="input-group">
				<input type="text" id="datepicker-1" class="form-control datepicker" name="import_time" placeholder="วันที่ลงข้อมูล" value="<?php echo ($value->import_time) ? date("Y-m-d",strtotime($value->import_time)) : date("Y-m-d")?>" data-date-format="yyyy-mm-dd" readonly="readonly" />
			    <span class="input-group-btn">
			    	<button type="button" class="btn btn-primary remove-datepicker" ><span class="glyphicon glyphicon-remove-sign" ></span></button>
				</span>
			</div>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" ></span> ยืนยัน</button>
			<a href="admin/reports" class="btn btn-danger" > ยกเลิก</a>
		</div>
	</div>
	
</form>

<link rel="stylesheet" href="js/datepicker/css/datepicker.css" />
<script type="text/javascript" src="js/datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/tinymce/config.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		tiny("detail","<?php echo base_url()?>");
		
		$(".datepicker").datepicker();
		
		$(".datepicker").on("changeDate", function(e) {
			$(this).datepicker("hide");
		})
		
		$(".remove-datepicker").click(function(){
			$(".datepicker").val("");
		})
		
		$("select[name=result_type_id]").change(function() {
			var value = $(this).val();
			var foo = "<option value=\"1\">รายงานสถานการณ์ภัยแล้งและภัยพิบัติ</option>";
			
			if(value=="0") {
				$(foo).insertBefore("select[name=deposits] option[value=2]");
			} else {
				$("select[name=deposits] option[value=1]").remove();
			}
		})
	});
</script>

<style type="text/css">
	.datepicker {
		margin-top: 0;
	}
</style>