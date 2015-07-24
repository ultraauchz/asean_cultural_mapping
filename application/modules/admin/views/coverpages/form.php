<div class="col-lg-12">
    <?php if($value->title):?>
	<h1 class="page-header"><?php echo $value->title?></h1>
    <?php else:?>
	<h1 class="page-header">หน้าก่อนเข้าเว็บไซต์</h1>
    <?php endif?>
</div>

<form class="form-horizontal" role="form" action="admin/coverpages/save/<?php echo $value->id?>" method="post" >
	
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
		<label for="title" class="col-sm-2 control-label" >วันที่เริ่มต้น</label>
		<div class="col-lg-4" >
			<input type="text" id="datepicker-1" class="form-control datepicker" name="start_date" placeholder="วันที่เริ่มต้น" value="<?php echo $value->start_date?>" data-date-format="yyyy-mm-dd" readonly="readonly" />
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >วันที่สิ้นสุด</label>
		<div class="col-lg-4" >
			<input type="text" id="datepicker-2" class="form-control datepicker" name="end_date" placeholder="วันที่สิ้นสุด" value="<?php echo $value->end_date?>" data-date-format="yyyy-mm-dd" readonly="readonly" />
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" ></span> ยืนยัน</button>
			<a href="admin/coverpages" class="btn btn-danger" > ยกเลิก</a>
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
    
		var nowTemp = new Date();
		var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
		
		var checkin = $('#datepicker-1').datepicker({
		    onRender: function(date) {
		        return date.valueOf() < now.valueOf() ? 'disabled' : '';
		    }
		}).on('changeDate', function(ev) {
		    if (ev.date.valueOf() > checkout.date.valueOf()) {
		        var newDate = new Date(ev.date)
		        newDate.setDate(newDate.getDate() + 1);
		        checkout.setValue(newDate);
		    }
		    checkin.hide();
		    $('#datepicker-2')[0].focus();
		}).data('datepicker');
		var checkout = $('#datepicker-2').datepicker({
		    onRender: function(date) {
		        return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
		    }
		}).on('changeDate', function(ev) {
		    checkout.hide();
		}).data('datepicker');
		
	});
</script>