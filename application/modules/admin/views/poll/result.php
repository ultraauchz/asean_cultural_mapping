<div class="col-lg-12">
    <?php if($value->title):?>
	<h1 class="page-header"><?php echo $value->title?></h1>
    <?php else:?>
	<h1 class="page-header">แบบสำรวจ</h1>
    <?php endif?>
</div>

<form class="form-horizontal" role="form" action="admin/poll/save/<?php echo $value->id?>" method="post" >
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ชื่อเรื่อง</label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="title" placeholder="กรอกชื่อเรื่อง" value="<?php echo $value->title?>" />
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >เนื้อหา</label>
		<div class="col-lg-10" >
			<p><?php echo $value->detail?></p>
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ผลการโหวต</label>
		<div class="col-lg-6" >
			
			<div class="progress">
			    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
			        <span class="sr-only">40% Complete (success)</span>
			    </div>
			</div>
			
			<div class="progress">
			    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
			        <span class="sr-only">20% Complete</span>
			    </div>
			</div>
			
			<div class="progress">
			    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
			        <span class="sr-only">60% Complete (warning)</span>
			    </div>
			</div>
			
			<div class="progress">
			    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
			        <span class="sr-only">80% Complete (danger)</span>
			    </div>
			</div>
			
		</div>
	</div>
	

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" ></span> ยืนยัน</button>
			<a href="admin" class="btn btn-danger" > ยกเลิก</a>
		</div>
	</div>
	
</form>

<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/tinymce/config.js"></script>
<script type="text/javascript">
		
</script>