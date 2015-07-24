<div class="col-lg-12">
	<h1 class="page-header">ติดต่อเรา</h1>
</div>

<form class="form-horizontal" role="form" action="admin/contacts_us/save/" method="post" >
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >รายละเอียดที่อยู่ <span style="color: red">*</span></label>
		<div class="col-lg-4" >
			<textarea class="form-control" name="detail" ><?php echo $value->detail?></textarea>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" ></span> ยืนยัน</button>
			<a href="admin/contacts_us" class="btn btn-danger" > ยกเลิก</a>
		</div>
	</div>
	
</form>

<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/tinymce/config.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		tiny("detail","<?php echo base_url()?>");
		
		$('.btn-primary').on('click', function(){
			tinymce.triggerSave();
		})
		
		$.validator.setDefaults({
			submitHandler:function(form){
				$('.btn-primary').attr('disabled', 'disabled');
				$('.btn-danger').attr('disabled', 'disabled');
		   	 	form.submit();
		   	 }      
		});
		$( "form" ).validate({
			rules: {
				detail:{required:true},
			},
			messages:{
				detail:{required:'กรุณาระบุ'},
			},
			errorPlacement: function(error, element) {
			    error.insertAfter(element);
			}
		});
	});
</script>