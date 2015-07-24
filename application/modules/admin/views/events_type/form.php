<div class="col-lg-12">
    <?php if($value->title):?>
	<h1 class="page-header">ประเภทกิจกรรม (<?php echo $value->title?>)</h1>
    <?php else:?>
	<h1 class="page-header">ประเภทกิจกรรม</h1>
    <?php endif?>
</div>

<form class="form-horizontal" role="form" action="admin/events_type/save/<?php echo $value->id?>" method="post" >
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ชื่อประเภท <span style="color: red">*</span></label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="title" placeholder="กรอกชื่อเรื่อง" value="<?php echo $value->title?>" />
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >สีในการแสดง <span style="color: red">*</span></label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="code_color" placeholder="กรอก code สี" value="<?php echo $value->code_color?>" readonly />
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" ></span> ยืนยัน</button>
			<a href="admin/events_type" class="btn btn-danger" > ยกเลิก</a>
		</div>
	</div>
	
</form>

<link rel="stylesheet" href="js/datepicker/css/datepicker.css" />
<link rel="stylesheet" href="js/colorpicker/css/colpick.css" type="text/css"/>
<script type="text/javascript" src="js/datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/tinymce/config.js"></script>
<script src="js/colorpicker/js/colpick.js" type="text/javascript"></script>
<style>
	.color-box {
		float:left;
		width:30px;
		height:30px;
		margin:5px;
		border: 1px solid white;
	}
</style>

<script type="text/javascript">
	$(document).ready(function() {
		$('[name=code_color]').colpick({
				colorScheme:'dark',
				layout:'rgbhex',
				color:'<?php echo $value->code_color; ?>',
				onSubmit:function(hsb,hex,rgb,el,bySetColor) {
					$('.color-box').css('background-color','#'+hex);
					// Fill the text box just if the color was set using the picker, and not the colpickSetColor function.
					if(!bySetColor) $(el).val('#'+hex);
					$(el).colpickHide();
				}
		}).keyup(function(){
				$(this).colpickSetColor(this.value);
		});;

		$.validator.setDefaults({
			submitHandler:function(form){
				$('.btn-primary').attr('disabled', 'disabled');
				$('.btn-danger').attr('disabled', 'disabled');
		   	 	form.submit();
		   	 }      
		});
		$( "form" ).validate({
			rules: {
				title:{required:true},
				code_color:{required:true},
			},
			messages:{
				title:{required:'กรุณาระบุ'},
				code_color:{required:'กรุณาระบุ'},
			},
			errorPlacement: function(error, element) {
			    error.insertAfter(element);
			}
		});
	});
</script>