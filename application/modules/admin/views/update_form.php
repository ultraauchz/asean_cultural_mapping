<div class="col-lg-12">
	<h1 class="page-header">หน้า</h1>
</div>

<form class="form-horizontal" role="form" action="admin/updates/save/<?php echo $value->id?>" method="post" >
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >เนื้อหา</label>
		<div class="col-lg-4" >
			<textarea class="form-control" name="detail" ><?php echo $value->detail?></textarea>
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >วันที่อัพเดท</label>
		<div class="col-lg-4" >
			<input type="text" id="datepicker-1" class="form-control datepicker" name="update_date" placeholder="วันที่อัพเดท" value="<?php echo $value->update_date?>" data-date-format="yyyy-mm-dd" readonly="readonly" />
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" ></span> Submit</button>
			<a href="admin/pages" class="btn btn-danger" > Cancel</a>
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
		
		$('#datepicker-1').datepicker();
	});
</script>