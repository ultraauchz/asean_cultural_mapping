<div class="col-lg-12">
    <?php if($value->title):?>
	<h1 class="page-header"><?php echo $value->title?></h1>
    <?php else:?>
	<h1 class="page-header">เว็บบอร์ด</h1>
    <?php endif?>
</div>

<form class="form-horizontal" role="form" action="admin/forum/save/<?php echo $value->id?>" method="post" >
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ผู้ใช้งาน</label>
		<div class="col-lg-4" >
			<div class="input-group">
			    <input type="text" id="username" class="form-control" value="<?php echo $value->user->get()->username?>" readonly />
			    <span class="input-group-btn">
			    	<a href="admin/forum/user_list" class="btn btn-primary iframe-btn" ><span class="glyphicon glyphicon-user" ></span></a>
				</span>
				<input type="hidden" id="user_id" name="user_id" value="<?php echo $value->user_id?>" />
			</div>
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

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" ></span> ยืนยัน</button>
			<a href="admin/forum" class="btn btn-danger" > ยกเลิก</a>
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
	});
</script>