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
	}
		.wrap_input input, .wrap_input select {
			margin:0px;
		}
/*Progres*/
	.progress_box {
		background:#efefef;
		margin-bottom:1px;
		padding:5px 10px;
	} 
	
	.progress_box .created {
		color:#999;
	}
	
</style>

<h3>ร้องเรียน/ร้องทุกข์</h3>
<form action='admin/complains/save/<?php echo $rs->id; ?>' method='post'>
	<div style='background:#eee; padding:10px 20px; border-radius:4px; border:solid 1px #aaa; text-align:center;'>
		<div class="form-group">
			<label for="name" style='margin-bottom:0px;'>สถานะการดำเนินงาน : </label>
			<span class="wrap_input"> <?php echo form_dropdown('status_complain', $status_complain_text, $rs->status_complain, 'class="form-control"'); ?> </span>
	 
			<label for="name" style='margin-bottom:0px; margin-left:10px;'>สถานะผลการร้องเรียน : </label>
			<span class="wrap_input"> <?php echo form_dropdown('status_result', $status_result_text, $rs->status_result, 'class="form-control"'); ?> </span>
			
			<? 
				echo form_submit(false, 'บันทึก', 'class="btn btn-sm btn-success"').' '; 
				echo anchor('admin/complains', 'ย้อนกลับ', 'class="btn btn-sm btn-danger"');
			?>
		</div>
	</div>
	
	
	<h4>ข้อมูลผู้ร้องเรียน</h4>
	<div style='margin-left:20px;'>
		<div class="form-group">
			
			<span class="wrap_input" style='text-align:left; min-width:400px;'>
				<label for="name">ชื่อ - นามสกุล : </label>
				<span class="wrap_input"> <?php echo $rs->prename.' '.$rs->firstname.' '.$rs->lastname; ?> </span>
			</span>
			
			<span class="wrap_input" style='text-align:left;'>
				<label for="name">เลขที่บัตรประชาชน  : </label>
				<span class="wrap_input"> <?php echo $rs->idcard; ?> </span>
			</span>
		</div>
		
		
		<div class="form-group">
			<label for="name">ที่อยู่ บ้านเลขที่   : </label><br>
			<span class="wrap_input" style='min-height:60px;'> <?php echo $rs->address; ?> </span>
		</div>
		
		<div class="form-group">
			
			<span class="wrap_input" style='text-align:left; min-width:400px;'>
				<label for="name">จังหวัด   : </label>
				<?php echo $rs->province; ?>
			</span>
			
			<span class="wrap_input" style='text-align:left;'>
				<label for="name">อำเภอ   : </label>
				<?php echo $rs->district; ?>
			</span>
		</div>
		
		<div class="form-group">
			
			<span class="wrap_input" style='text-align:left; min-width:400px;'>
				<label for="name">ตำบล   : </label>
				<?php echo $rs->subdistrict; ?>
			</span>
			
			<span class="wrap_input" style='text-align:left;'>
				<label for="name">รหัสไปรษณีย์   : </label>
				<?php echo $rs->postcode; ?>
			</span>
		</div>
		
		
		
		<div class="form-group">
			
			<span class="wrap_input" style='text-align:left; min-width:400px;'>
				<label for="name">โทรศัพท์พื้นฐาน  : </label>
				<?php echo $rs->basicphone; ?>
			</span>
			
			<span class="wrap_input" style='text-align:left;'>
				<label for="name">โทรศัพท์มือถือ   : </label>
				<?php echo $rs->mobilephone; ?>
			</span>
		</div>
		
		<div class="form-group">
			
			<span class="wrap_input" style='text-align:left; min-width:400px;'>
				<label for="name">โทรสาร  : </label>
				<?php echo $rs->faxnumber; ?>
			</span>
			
			<span class="wrap_input" style='text-align:left;'>
				<label for="name">อีเมล์   : </label>
				<?php echo $rs->email; ?>
			</span>
		</div>
	</div>
		
		<hr>
		<div style='margin-left:20px;'>
			<div class='form-group' >
				<label>ท่านต้องการให้ติดต่อกลับจากหน่วยงานที่รับเรื่องร้องเรียนหรือไม่ : </label>
				<div style='margin-bottom:20px;'>
					<?php echo $rdo1_text[$rs->rdo_1]; ?>
				</div>
				
				<label>ช่องทางที่ท่านต้องการให้ติดต่อกลับ : </label>
				<div>
					<?php echo $rdo2_text[$rs->rdo_2]; ?>
				</div>
			</div>
		</div>
		<hr>
	
	
	<h4>ข้อมูลผู้ร้องเรียน</h4>
	<div style='margin-left:20px;'>
		<div class="form-group">
			<label for="name">ผู้ถูกร้องเรียน (ชื่อ-นามสกุล/องค์กร) : </label>
			<span class="wrap_input"> <?php echo $rs->offender; ?> </span>
		</div>
		
		<div class="form-group">
			<label for="name">รายละเอียดการร้องเรียน  : </label><br>
			<span class="wrap_input" style='min-height:60px;'> <?php echo $rs->detail; ?> </span>
		</div>
		
		<div class="form-group">
			<label for="name">หน่วยงาน/บุคคลที่ท่านเคยแจ้งเรื่องร้องเรียนนี้  : </label><br>
			<span class="wrap_input" style='min-height:60px;'> <?php echo $rs->complaint_past; ?> </span>
		</div>
		
		<div class='form-group' >
			<label>ท่านต้องการให้ติดต่อกลับจากหน่วยงานที่รับเรื่องร้องเรียนหรือไม่ : </label>
			<div style='margin-bottom:20px;'>
				<?php echo $rdo3_text[$rs->rdo_3]; ?>
			</div>
		</div>
	</div>
<hr>

	 <div id="send_mail">
		<h4><?php echo form_checkbox('send_mail', 1, false, 'id="check_send_mail"'); ?> แจ้งผู้ร้องเรียน </h4>
		
		<div id='sector_send_mail' style='margin-left:20px;'>
			<div class="form-group">
				<label for="name">E - mail : <?php echo $rs->email; ?> </label><br>
				<div class="wrap_input"> <?php echo form_textarea(false, false, 'class="form-control" style="width:400px; height:150px;"'); ?> </div>
			</div>
		</div>
	</div>
</form>


<hr>
<h4>บันทึกความก้าวหน้า</h4>
<div style='margin-left:20px;'>
	<div class="form-group">
		<label for="name">ผู้บันทึกความก้าวหน้า : <?php echo user()->firstname.' '.user()->lastname; ?> </label><br>
		<div class="wrap_input"> <?php echo form_textarea('send_mail_detail', false, 'class="form-control" style="width:400px; height:150px;" id="box_memo"'); ?> </div>
		<div style='width:400px; text-align:right;'><?php echo form_button(false, 'บันทึกความก้าวหน้า' ,'class="btn btn-success" id="btn_save_progress"'); ?></div>
	</div>
</div>

<div id='progress_list'></div>
<BR><BR>
	
<script language='javascript'>
	function progress_list_load() { $.get('admin/complains/list_progress/<?php echo $rs->id; ?>', function(data){ $('#progress_list').html(data); }); }
	
	
	function check_send_mail() {
		if($('[name=status_complain]').val() == 10) {
			$('#send_mail').show();
		} else {
			$('#send_mail').hide();
		}
			
	}
	
	function check_send_mail_box() {
		if(!$('#check_send_mail').prop('checked')) {
			$('#sector_send_mail').hide();
		} else {
			$('#sector_send_mail').show();
		}
	}
	
	$(function(){
		check_send_mail();
		$('[name=status_complain]').on('change', function(){
			check_send_mail();
		});
		
		check_send_mail_box();
		$('[name=send_mail]').on('click', function(){
			check_send_mail_box();
		});
		
		progress_list_load();
		$('#btn_save_progress').on('click', function(){
			
			$.get('admin/complains/save_progress', {
				"detail" : $('#box_memo').val(),
				"ma_complain_id" : '<?php echo $rs->id; ?>'
			}, function(data){
				$('#box_memo').val('');
				progress_list_load();
			});			
		});
	});
</script>


