<div class="col-lg-12">
    <h1 class="page-header">
    	บันทึกการใช้งาน 
    </h1>
</div>

<div class='col-lg-12' style='padding:10px 0px;'>
	<form action='' method='get'> 
		<?php
			for ($i=0; $i < 60; $i++) { 
				$m[] = sprintf("%02d",$i);
			}

			for ($i=0; $i < 24; $i++) { 
				$h[] = sprintf("%02d",$i);
			}
		?>
		ค้นหา 
		ช่วงเวลาเริ่มต้น 
			วันที่ <?php echo form_input('sch_s_d', @$_GET['sch_s_d'], 'style="display:inline-block; width:110px;" class="form-control datepicker" data-date-format="yyyy-mm-dd" readonly="readonly" '); ?> 
			เวลา <?php echo form_dropdown('sch_s_h', $h, @$_GET['sch_s_h'], 'style="display:inline-block; width:70px;" class="form-control"', '- -'); ?>
			: <?php echo form_dropdown('sch_s_m', $m, @$_GET['sch_s_m'], 'style="display:inline-block; width:70px;" class="form-control"', '- -'); ?>
		 - สิ้นสุด 
			 วันที่ <?php echo form_input('sch_e_d', @$_GET['sch_e_d'], 'style="display:inline-block; width:110px;" class="form-control datepicker" data-date-format="yyyy-mm-dd" readonly="readonly" '); ?> 
			เวลา <?php echo form_dropdown('sch_e_h', $h, @$_GET['sch_e_h'], 'style="display:inline-block; width:70px;" class="form-control"', '- -'); ?>
			 : <?php echo form_dropdown('sch_s_m', $m, @$_GET['sch_s_m'], 'style="display:inline-block; width:70px;" class="form-control"', '- -'); ?>
		 <?php echo form_submit(false, 'ค้นหา', 'class="btn btn-default"'); ?>
	 </form>
</div>

<table class="table table-bordered table-hover table-responsive table-striped" >
	<thead>
		<tr>
			<th style="width: 80px;" >สถานะ</th>
			<th>รายละเอียด</th>
			<th>วันที่</th>
			<th style="width:200px;">ผู้ดำเนินการ</th>
		</tr>
	</thead>
	
	<tbody>
		<?php 
		if(empty($variable->all)) {
			echo '<tr><td colspan="5" style="text-align:center; color:#aaa; line-height:30px;">ไม่พบข้อมูล</td></tr>';
		} 
		foreach ($variable as $item):?>
			<tr>
				<td><?php echo $item->type; ?> </td>
				<td><?php echo $item->detail; ?> </td>
				<td><?php echo mysql_to_th($item->created,"F",TRUE); ?> </td>
				<td><?php echo $item->user->firstname." ".$item->user->lastname; ?> </td>
			</tr>
		<?php endforeach?>
	</tbody>
	
	<tfoot>
		<tr>
			<td colspan="5" ><?php echo $variable->pagination()?></td>
		</tr>
	</tfoot>
</table>

<link rel="stylesheet" href="js/datepicker/css/datepicker.css" />
<script type="text/javascript" src="js/datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/tinymce/config.js"></script>
<script type="text/javascript">
	$(document).ready(function() {

		$(".datepicker").datepicker();
		
	});
</script>