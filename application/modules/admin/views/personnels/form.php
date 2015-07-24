<div class="col-lg-12">
    <?php if($value->title):?>
    	<h1 class="page-header"><?php echo $value->title?></h1>
    <?php else:?>
    	<h1 class="page-header">บุคลากร (<?php echo $dept->title; ?>)</h1>
    <?php endif?>
</div>

<form class="form-horizontal" role="form" action="admin/personnels/save/<?php echo $dept->id?>/<?php echo @$value->parent_id?>/<?php echo $value->id?>" method="post" >
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ลำดับ <span style="color: red">*</span></label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="orders" placeholder="ลำดับหน่วยงาน" value="<?php echo $value->orders?>" />
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >รูปบุคลากร</label>
		<div class="col-lg-4" >
			<div class="input-group">
			    <input type="text" id="image_path" class="form-control" name="image_path" placeholder="รูปภาพหัวเรื่อง" value="<?php echo $value->image_path?>" />
			    <span class="input-group-btn">
			    	<a href="js/tinymce/plugins/filemanager/dialog.php?type=1&field_id=image_path" class="btn btn-primary iframe-btn" >เลือกรูปภาพ</a>
				</span>
			</div>
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ชื่อ <span style="color: red">*</span></label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="fname" placeholder="ชื่อ" value="<?php echo $value->fname?>" />
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >นามสกุล <span style="color: red">*</span></label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="lname" placeholder="นามสกุล" value="<?php echo $value->lname?>" />
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ตำแหน่ง </label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="position" placeholder="ตำแหน่ง" maxlength="255" value="<?php echo $value->position?>" />
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ที่อยู่ <span style="color: red">*</span></label>
		<div class="col-lg-4" >
			<textarea name="addr" rows="5" cols="80"><?php echo $value->addr?></textarea>
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >เบอร์โทร <span style="color: red">*</span></label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="tel" placeholder="กรอกเบอร์โทร" value="<?php echo $value->tel?>" />
		</div>
	</div>

	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >E-mail <span style="color: red">*</span></label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="email" placeholder="กรอก E-mail" value="<?php echo $value->email?>" />
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" ></span> Submit</button>
			<button type="button" class="btn btn-danger" onclick="window.history.back();" > Cancel</button>
		</div>
	</div>
	
</form>

<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/tinymce/config.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		tiny("addr","<?php echo base_url()?>");
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
				fname:{required:true},
				lname:{required:true},
				orders:{required:true, number:true, max:<?php echo @$max_orders; ?>},
				addr:{required:true},
				tel:{required:true, number:true},
				email:{required:true, email:true},
				department_id:{required:true},
			},
			messages:{
				fname:{required:'กรุณาระบุ'},
				lname:{required:'กรุณาระบุ'},
				orders:{required:'กรุณาระบุ', number:'กรุณาระบุเป็นตัวเลข', max:'ลำดับมากที่สุดคือ <?php echo @$max_orders; ?>'},
				addr:{required:'กรุณาระบุ'},
				tel:{required:'กรุณาระบุ', number:'กรุณาระบุเป็นตัวเลข'},
				email:{required:'กรุณาระบุ', email:'กรุณาระบุ E-mail ให้ถูกต้อง'},
				department_id:{required:'กรุณาระบุ'},
			},
			errorPlacement: function(error, element) {
			    error.insertAfter(element);
			}
		});
	});
</script>