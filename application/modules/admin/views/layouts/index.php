<div class="col-lg-12">
	<h1 class="page-header">เลเอ้าท์</h1>
</div>

<form action="admin/layouts/save" method="post" class="form-horizontal" >
	
	<?php foreach ($variable as $key => $value):?>
	<div class="form-group" >
		<label for="<?php echo $value->module?>" class="col-lg-2 control-label" ><?php echo $value->title?></label>
		<div class="col-lg-10" >
			<img src="images/module/<?php echo $value->module?>.png" class="img-polaroid" style="width: 90%;" />
			<input type="tel" class="form-control" name="orders[]" value="<?php echo $value->orders?>" style="width: 40px; display: inline-block;" />
			<input type="hidden" name="id[]" value="<?php echo $value->id?>" />
		</div>
	</div>
	<hr />
	<?php endforeach;?>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" ></span> ยืนยัน</button>
			<a href="admin/layouts" class="btn btn-danger" > ยกเลิก</a>
		</div>
	</div>
	
</form>