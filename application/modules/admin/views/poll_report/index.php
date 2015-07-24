<div class="col-lg-12">
    <h1 class="page-header"><? echo anchor('admin/poll/', 'แบบสำรวจ').' > '.$rs->survey->title; ?></h1>
</div>

<?php 
	function cal_perc($most = 0, $cur = 0) {
		if($most == 0 || $cur == 0) {
			return 0;
		} else {
			return str_replace('.00', null, number_format(((100/$most)*$cur), 2));
		}
	}

	if($rs->survey->question_type == 1) { 
		
		if(!empty($ans_list)) {
			foreach($ans_list as $item) {
				echo '<h4>'.$item['title'].'</h4>';
				?>
				<div class="progress">
				  <div class="progress-bar" role="progressbar" aria-valuenow="<? echo cal_perc($ans_perc['most_val'], $item['answer_amount']);  ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo cal_perc($ans_perc['most_val'], $item['answer_amount']);  ?>%;">
				    <? echo cal_perc($ans_perc['most_val'], $item['answer_amount']).'% ('.$item['answer_amount'].' คะแนน)';  ?>
				  </div>
				</div>
				<?
			}
		}
			
	} else if($rs->survey->question_type == 2) { ?>
		<table class="table table-bordered table-hover table-responsive table-striped" >
			
			<thead>
				<tr>
					<th style="width: 80px;" >ลำดับ</th>
					<th>ชื่อ</th>
					<th style="width: 160px;" >วันที่สร้าง / วันที่แก้ไข</th>
					<th style="width: 160px;" ></th>
				</tr>
			</thead>
			
			<tbody>
				<?php foreach ($rs as $key => $value):
					$no++;?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo anchor('admin/poll_report/detail/'.$value->id, $value->ip_address); ?></td>
					<td><small><?php echo mysql_to_th($value->created,"S",TRUE)."<br />".mysql_to_th($value->updated,"S",TRUE)?></small></td>
					<td>
						<a href="admin/poll_report/delete/<?php echo $value->id?>" class="btn btn-danger" onclick="return confirm('ต้องการลบ <?php echo $value->title?> หรือไม่')" ><span class="glyphicon glyphicon-trash" ></span> ลบ</a>
					</td>
				</tr>
				<?php endforeach?>
			</tbody>
			
			<tfoot>
				<tr>
					<td colspan="6" ><?php echo $rs->pagination()?></td>
				</tr>
			</tfoot>
			
		</table>
	<? }
?>
<div class='pull-right'><? echo anchor('admin/poll', form_button(null, 'ย้อนกลับ', 'class="btn btn-danger"')); ?></div>