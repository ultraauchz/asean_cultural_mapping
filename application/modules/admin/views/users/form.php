<div class="col-lg-12">
    <?php if($value->id):?>
    	<h1 class="page-header"><?php echo $value->username?></h1>
    <?php else:?>
    	<h1 class="page-header">ผู้ใช้งาน</h1>
    <?php endif?>
</div>

<form class="form-horizontal" role="form" action="admin/settings/users/save/<?php echo $value->id?>" method="post" >
	
	<div class="form-group" >
		<label for="username" class="col-sm-2 control-label" >สำนัก/กอง <span style="color: red">*</span></label>
		<div class="col-lg-4" >
			<?php echo @form_dropdown('heap_id', get_option('org_id', 'heap_name', 'ma_heap','WHERE heap_budget = 0'), @$value->heap_id, 'class="form-control"', '--กรุณาเลือก--',''); ?>
		</div>
	</div>
	
	<div class="form-group" >
		<label for="username" class="col-sm-2 control-label" >ส่วน / กลุ่มงาน / ฝ่าย <span style="color: red">*</span></label>
		<div id="div-center" class="col-lg-4" >
			<?php
				if($value->heap_id):
					echo @form_dropdown('center_id', get_option('org_id', 'center_name', "ma_center where heap_id = '".$value->heap->id."'"), @$value->center_id, 'class="form-control"', '--กรุณาเลือก--','');
				else:
					echo @form_dropdown('center_id', null, null, 'class="form-control"', '--กรุณาเลือก--','');
				endif;
			?>
		</div>
	</div>
	
	<div class="form-group" >
		<label for="username" class="col-sm-2 control-label" >ชื่อผู้ใช้งาน <span style="color: red">*</span></label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="username" placeholder="ชื่อผู้ใช้งาน" value="<?php echo $value->username?>" <?php if($value->id) echo "readonly"?> />
		</div>
	</div>
	
	<div class="form-group" >
		<label for="email" class="col-sm-2 control-label" >อีเมล์ <span style="color: red">*</span></label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="email" placeholder="อีเมล์" value="<?php echo $value->email?>" />
		</div>
	</div>
	
	<hr />
	
	<div class="form-group" >
		<label for="firstname" class="col-sm-2 control-label" >ชื่อ <span style="color: red">*</span></label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="firstname" placeholder="ชื่อ" value="<?php echo $value->firstname?>" />
		</div>
	</div>
	
	<div class="form-group" >
		<label for="lastname" class="col-sm-2 control-label" >นามสกุล <span style="color: red">*</span></label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="lastname" placeholder="นามสกุล" value="<?php echo $value->lastname?>" />
		</div>
	</div>
	
	<div class="form-group" >
		<label for="tel" class="col-sm-2 control-label" >เบอร์โทร <span style="color: red">*</span></label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="tel" placeholder="เบอร์โทร" value="<?php echo $value->tel?>" />
		</div>
	</div>
	
	<div class="form-group" >
		<label for="per_cardno" class="col-sm-2 control-label" >หมายเลขบัตรประชาชน <span style="color: red">*</span></label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="per_cardno" placeholder="หมายเลขบัตรประชาชน" value="<?php echo $value->per_cardno?>" />
		</div>
	</div>
	
	<hr />
	
	<?php if($value->id):?>
	<div class="form-group" >
		<label class="col-lg-6 control-label" >เปลี่ยนรหัสผ่าน <span style="color: red">* (ถ้าต้องการใช้รหัสผ่านเดิมไม่ต้องกรอก)</span></label>
	</div>
	<?php endif?>
	
	<div class="form-group" >
		<label for="password" class="col-sm-2 control-label" >รหัสผ่าน <span style="color: red">*</span></label>
		<div class="col-lg-4" >
			<input type="password" class="form-control" name="password" placeholder="รหัสผ่าน" />
		</div>
	</div>
	
	<div class="form-group" >
		<label for="passwords" class="col-sm-2 control-label" >ยืนยันรหัสผ่าน <span style="color: red">*</span></label>
		<div class="col-lg-4" >
			<input type="password" class="form-control" name="passwords" placeholder="ยืนยันรหัสผ่าน" />
		</div>
	</div>
	
	<hr />
	
	<div class="form-group" >
		<label for="username" class="col-sm-2 control-label" >สิทธิการใช้งาน<span style="color: red">*</span></label>
		<div id="div-center" class="col-lg-6" >
			<?php echo form_dropdown("user_type_id", get_option("id", "title", "ma_user_type","WHERE id != 1 ORDER BY title ASC"), @$value->user_type_id, "class=\"form-control\" style=\"display: inline; width:80%;\" ", 'เลือกประเภทสิทธิการใช้งาน',"");?>
			<a style="display: inline;" ><span class="glyphicon glyphicon-info-sign" ></span></a>
		</div>
	</div>
	<!--
	<div class="form-group" >
		<label for="username" class="col-sm-2 control-label" >สิทธิรายละเอียดขอสนับสนุนฝนหลวงทั้งหมด <span style="color: red">*</span></label>
		<div id="div-center" class="col-lg-6" >
			<input type="checkbox" class="inline" name="request_rain" value="1" <?php if($value->request_rain==1) echo "checked"?> />
			<a style="display: inline;" ><span class="glyphicon glyphicon-info-sign" ></span></a>
		</div>
	</div>
	-->
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" ></span> ยืนยัน</button>
			<a href="admin/settings/users" class="btn btn-danger" > ยกเลิก</a>
		</div>
	</div>
	
</form>

<script type="text/javascript">
	$(document).ready(function(){
		
		$("select[name=heap_id]").change(function(){
			var id = $(this).val();
			$.get("admin/settings/users/get_center/"+id, function(data) {
				$("#div-center").html(data);
			})
		})
		
	})
</script>