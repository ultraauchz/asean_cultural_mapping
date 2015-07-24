<style type='text/css'>
	label {
		font-weight:bold;
	}
	div.form-group {
		margin-bottom:10px;
	}
	
	.wrap_input {
		display:inline-block; 
		text-align:center;  
		font-size:12px;
	}
		.wrap_input input, .wrap_input select {
			margin:0px;
		}
</style>
<script language='javascript'>
	$(function(){
		//Input - idcard
		$('.idcard').on('keyup', function(){
			if($(this).val().length == $(this).attr('maxlength')) {
				$('.idcard').eq($(this).index('.idcard')+1).focus();
			}
		});
		$('.idcard').focus(function(){
			$(this).val('');
		});
	});
</script>


<h3>ร้องเรียน/ร้องทุกข์</h3>
<form style='margin-left:50px;' action='complains/save' method='post'>
	<h4>ข้อมูลผู้ร้องเรียน</h4>
	<div class="form-group">
		<label for="name">ชื่อ - นามสกุล</label>
		
		<span class="wrap_input">
			<?php echo form_input('prename', false, 'class="form-control" style="width:80px;" placeholder="คำนำหน้า"'); ?>
		</span>
		<span class="wrap_input">
			<?php echo form_input('firstname', false, 'class="form-control" style="width:200px;" placeholder="ชื่อจริง"'); ?>
		</span>
		<span class="wrap_input">
			<?php echo form_input('lastname', false, 'class="form-control" style="width:200px;" placeholder="นามสกุล"'); ?>
		</span>
	</div>
	
	<div class="form-group">
		<label for="name">เลขที่บัตรประชาชน </label>
		
		<span class="wrap_input">
			<?php echo form_input('idcard[]', false, ' class="form-control idcard" style="width:9px;" maxlength="1"'); ?>
		</span>
		<span class="wrap_input">
			<?php echo form_input('idcard[]', false, ' class="form-control idcard" style="width:36px;" maxlength="4"'); ?>
		</span>
		<span class="wrap_input">
			<?php echo form_input('idcard[]', false, ' class="form-control idcard" style="width:45px;" maxlength="5"'); ?>
		</span>
		<span class="wrap_input">
			<?php echo form_input('idcard[]', false, ' class="form-control idcard" style="width:18px;" maxlength="2"'); ?>
		</span>
		<span class="wrap_input">
			<?php echo form_input('idcard[]', false, ' class="form-control idcard" style="width:9px;" maxlength="1"'); ?>
		</span>
	</div>
	
	
	<div class="form-group">
		<label for="name">ที่อยู่ บ้านเลขที่  </label>
		
		<span class="wrap_input">
			<?php echo form_textarea('address', false, ' class="form-control" style="width:300px; height:120px;" placeholder="ที่อยู่ บ้านเลขที่"'); ?>
		</span>
	</div>
	
	<div class="form-group">
		<span class="wrap_input" style='text-align:left;'>
			<label for="name">จังหวัด  </label>
			<?php echo form_dropdown('province', get_option('id', 'title', 'ma_province order by title asc'), false, 'class="form-control"', '-จังหวัด-'); ?>
		</span>
		
		<span class="wrap_input" style='text-align:left;'>
			<label for="name">อำเภอ  </label>
			<span class="wrap_input"><?php echo form_dropdown('amphur', array(), false, 'class="form-control"', '- กรุณาเลือกข้อมูลจังหวัด -'); ?></span>
		</span>
	</div>
	
	<div class="form-group">
		
		<span class="wrap_input" style='text-align:left;'>
			<label for="name">ตำบล  </label>
			<?php echo form_dropdown('district', array(), false, 'class="form-control"', '- กรุณาเลือกข้อมูลอำเภอ -'); ?>
		</span>
		
		<span class="wrap_input" style='text-align:left;'>
			<label for="name">รหัสไปรษณีย์  </label>
			<?php echo form_input('postcode', false, ' class="form-control" style="text-align:center; width:80px;" maxlength="5" '); ?>
		</span>
	</div>
	
	
	<div class="form-group">
		<label for="name">โทรศัพท์พื้นฐาน </label>
		<span class="wrap_input"> <?php echo form_input('basicphone', false, ' class="form-control" style="width:300px;" maxlength="80" placeholder="โทรศัพท์พื้นฐาน"'); ?> </span>
	</div>
	
	<div class="form-group">
		<label for="name">โทรศัพท์มือถือ </label>
		<span class="wrap_input"> <?php echo form_input('mobilephone', false, ' class="form-control" style="width:300px;" maxlength="80" placeholder="โทรศัพท์มือถือ"'); ?> </span>
	</div>
	
	<div class="form-group">
		<label for="name">โทรสาร </label>
		<span class="wrap_input"> <?php echo form_input('faxnumber', false, ' class="form-control" style="width:300px;" maxlength="80" placeholder="โทรสาร"'); ?> </span>
	</div>
	
	<div class="form-group">
		<label for="name">อีเมล์ </label>
		<span class="wrap_input"> <?php echo form_input('email', false, ' class="form-control" style="width:300px;" maxlength="80" placeholder="อีเมล์"'); ?> </span>
	</div>
	<hr>
	<div class='form-group' style='text-align:center;'>
		<label>ท่านต้องการให้ติดต่อกลับจากหน่วยงานที่รับเรื่องร้องเรียนหรือไม่</label>
		<div style='margin-bottom:20px;'>
			<span><?php echo form_radio('rdo_1', 1); ?> ต้องการ</span>
			<span><?php echo form_radio('rdo_1', 2); ?> ไม่ต้องการ</span>
		</div>
		
		<label>ช่องทางที่ท่านต้องการให้ติดต่อกลับ</label>
		<div>
			 <span><?php echo form_radio('rdo_2', 1); ?> ตามที่อยู่ด้านบน</span>
			 <span><?php echo form_radio('rdo_2', 2); ?> e-mail</span>
			 <span><?php echo form_radio('rdo_2', 3); ?> โทรศัพท์บ้าน </span>
			 <span><?php echo form_radio('rdo_2', 4); ?> โทรศัพท์มือถือ</span>
		</div>
	</div>
	<hr>
	
	<h4>ข้อมูลผู้ร้องเรียน</h4>
	<div class="form-group">
		<label for="name">ผู้ถูกร้องเรียน (ชื่อ-นามสกุล/องค์กร) <span style='color:#f00;'>*</span></label>
		<span class="wrap_input"> <?php echo form_input('offender', false, ' class="form-control" style="width:300px;" maxlength="80" placeholder="ผู้ถูกร้องเรียน (ชื่อ-นามสกุล/องค์กร)"'); ?> </span>
	</div>
	
	<div class="form-group">
		<label for="name">รายละเอียดการร้องเรียน <span style='color:#f00;'>*</span></label>
		
		<span class="wrap_input">
			<?php echo form_textarea('detail', false, ' class="form-control" style="width:300px; height:120px;" placeholder="รายละเอียดการร้องเรียน"'); ?>
		</span>
	</div>
	
	<div class="form-group">
		<label for="name">เอกสารประกอบ</label>
		
		<span class="wrap_input">
			<input type='file'>
		</span>
	</div>
	
	<div class="form-group">
		<label for="name">หน่วยงาน/บุคคลที่ท่านเคยแจ้งเรื่องร้องเรียนนี้</label> 
		<span class="wrap_input"> <?php echo form_textarea('complaint_past', false, ' class="form-control" style="width:300px; height:120px;" placeholder="หน่วยงาน/บุคคลที่ท่านเคยแจ้งเรื่องร้องเรียนนี้"'); ?> </span>
	</div>
	 
	<div class="form-group">
		<label for="name">เรื่องร้องเรียนนี้อยู่ระหว่างการฟ้องร้องหรือพิจารณาคดีในชั้นศาลหรือไม่</label>
		<span><?php echo form_radio('rdo_3', 1); ?> ใช่</span>
		<span><?php echo form_radio('rdo_3', 2); ?> ไม่ใช่</span>
	</div>
	
	<? 
		echo form_submit(false, 'ส่งคำร้อง', 'class="btn btn-success" onclick="if(!confirm(\'กรุณายืนยันการบันทึกข้อมูล\')) return false;"').' ';
		echo anchor('', 'ย้อนกลับ', 'class="btn btn-danger"'); 
	?>
</form>


<script language='javascript'>
	function option_loading(type, obj) {
		if(type == 'loading') {
			obj.attr('disabled', 'disabled');
			obj.html('<option value="">Loading...</option>');
		} else if(type == 'on') {
			obj.attr('disabled', false);
		} else if(type == 'off') {
			obj.attr('disabled', 'disabled');
		}
	}
	
	$(function(){
		option_loading('off', $('[name=amphur]'));
		option_loading('off', $('[name=district]'));
		
		$('[name=province]').on('change', function(){
			option_loading('loading', $('[name=amphur]'));
			id = $(this).val();
			$.get('<?php echo site_url(); ?>complains/goption_address/amphur/'+id, function(data){
				if(data == 'empty') {
					$('[name=amphur]').html('<option value="">- กรุณาเลือกข้อมูลจังหวัด -</option>');
				} else {
					$('[name=amphur]').html(data);
					option_loading('on', $('[name=amphur]'));
				}

				//Loading district
				option_loading('loading', $('[name=district]'));
				$('[name=district]').html('<option value="">- กรุณาเลือกข้อมูลอำเภอ -</optioN>');
			});
		});
		
		$('[name=amphur]').on('change', function(){
			option_loading('loading', $('[name=district]'));
			id = $(this).val();
			$.get('<?php echo site_url(); ?>complains/goption_address/district/'+id, function(data){
				if(data == 'empty') {
					$('[name=district]').html('<option value="">- กรุณาเลือกข้อมูลอำเภอ -</optioN>');
				} else {
					$('[name=district]').html(data);
					option_loading('on', $('[name=district]'));
				}
			});
		});
	});
</script>