<div class="col-lg-12">
    <h1 class="page-header">ติดต่อเรา</h1>
</div>
<?php echo $contact_us->detail; ?>
<hr>
<form id="form_comment" role="form" action="contacts_us/save" method="post" role="form">
	<div class="form-group">
		<label for="title" class="col-sm-2 control-label" >ชื่อ</label>
		<div class="col-lg-4" >
        	<input type="text" name="name_contect" maxlength="250" style="width: 250px" class="form-control">
       	</div>
    </div>
    
    <div class="form-group">
    	<label for="title" class="col-sm-2 control-label" >อีเมล์</label>
		<div class="col-lg-4" >
        	<input type="text" name="email" maxlength="250" style="width: 250px" class="form-control">
        </div>
    </div>
    
     <div class="form-group">
    	<label for="title" class="col-sm-2 control-label" >หัวเรื่อง</label>
		<div class="col-lg-4" >
        	<input type="text" name="title" maxlength="500" style="width: 500px" class="form-control">
        </div>
    </div>
    
    <div class="form-group">
    	<label for="title" class="col-sm-2 control-label" >รายละเอียด</label>
		<div class="col-lg-4" >
        	<textarea name="detail" rows="5" style="width: 600px" class="form-control"></textarea>
        </div>
    </div>
    
    <div class="form-group">
    	<label for="title" class="col-sm-2 control-label" >รหัสยืนยัน</label>
		<div class="col-lg-4" >
			<img src="contents/captcha" />
        	<input type="text" class="form-control" name="captcha" >
        </div>
    </div>
    <br />
    <button type="submit" id="save_comments" class="btn btn-primary">ส่งข้อความ</button>
</form>

<script type="text/javascript">
	$(function(){
		
		$.validator.setDefaults({
			submitHandler:function(form){
				$('.btn-primary').attr('disabled', 'disabled');
				$('.btn-danger').attr('disabled', 'disabled');
				$.get(
					'<?php echo base_url()?>contacts_us/chk_captcha',
					{'captcha':$('[name=captcha]').val()},
					function (data) {
						if (data == 'false') {
							alert('รหัสยืนยันไม่ถูกต้อง');
							$('[name=captcha]').focus();
							$('.btn-primary').removeAttr('disabled');
							$('.btn-danger').removeAttr('disabled');
							return false;
						} else {
							form.submit();
						}
					}
				);
		   	 }      
		});
		$( "#form_comment" ).validate({
			rules: {
				name_contect:{required:true},
				detail:{required:true},
				title:{required:true},
				email:{required:true, email:true},
				captcha:{required:true, minlength: '6'},
			},
			messages:{
				name_contect:{required:'กรุณาระบุชื่อ'},
				detail:{required:'กรุณาระบุ Comment'},
				title:{required:'กรุณาระบุ หัวเรื่อง'},
				email:{required:'กรุณาระบุ E-mail', email:'กรุณาระบุ E-mail ให้ถูกต้อง'},
				captcha:{required:'กรุณาระบุรหัสยืนยัน', minlength:'กรุณาระบุอย่างน้อย 6 ตัว'},
			},
			errorPlacement: function(error, element) {
			    error.insertAfter(element);
			}
		});
	});
</script>