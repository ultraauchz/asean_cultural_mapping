<div class="col-lg-12">
    <?php if($value->title):?>
	<h1 class="page-header"><?php echo $value->title?></h1>
    <?php else:?>
	<h1 class="page-header">ประเภทผู้ใช้งาน</h1>
    <?php endif?>
</div>

<form class="form-horizontal" role="form" action="admin/settings/user_types/save/<?php echo $value->id?>" method="post" >
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ประเภทผู้ใช้งาน</label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="title" value="<?php echo $value->title?>" />
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary" ><span class="glyphicon glyphicon-ok" ></span> ยืนยัน</button>
			<a href="admin/settings/user_types" class="btn btn-danger" > ยกเลิก</a>
		</div>
	</div>
	
</form>