<div class="col-lg-12">
    <h1 class="page-header">เรื่องร้องเรียน</h1>
</div>

<table class="table table-bordered table-hover table-responsive table-striped" >
	<thead>
		<tr>
			<th style="width: 80px;" >ลำดับ</th>
			<th>รายละเอียด</th>
			<th style='width:150px;'>สถานะการดำเนินงาน</th>
			<th style='width:140px;'>สถานะการสอบสวน</th>
			<th style='width:250px;'>ติดต่อ</th>
			<th style="width: 160px;" >วันที่สร้าง / วันที่แก้ไข</th>
			<th style='width:110px;'>รายละเอียด</th>
		</tr>
	</thead>
	
	<tbody>
		<?php
			foreach ($rs as $key => $value):
				$no++;
			?>
		<tr>
			<td class='text-center'><?php echo $no; ?></td>
			<td> <?php echo $value->detail; ?> </td>
			<td> <?php echo @$status_complain_text[$value->status_complain];?>
				
			</td>
			<td> <?php echo @$status_result_text[$value->status_result]; ?></td>
			<td>
				<?php
					echo '<div><strong>ชื่อ - นามสกุล : </strong>'.$value->prename.' '.$value->firstname.' '.$value->lastname.'</div>';
					if($value->rdo_1 == 1) {
						echo '<strong>ต้องการให้ติดต่อกลับ ทาง '.$rdo2_text[$value->rdo_2].'</strong><br>';
						echo $value->{$rdo2_field[$value->rdo_2]};
					}
					
					echo '<div><strong>'.@$rdo3_text[$value->rdo_3].'</strong></div>';
				?>
			</td>
			<td><small><?php echo mysql_to_th($value->created,"S",TRUE)."<br />".mysql_to_th($value->updated,"S",TRUE)?></small></td>
			<td>
				<?php
					if(permission("complains","views")):
						echo anchor('admin/complains/detail/'.$value->id, 'รายละเอียด', 'class="btn btn-warning"');
					endif;
				?>
			</td>
			
		</tr>
		<?php endforeach?>
	</tbody>
	
	<?php if(@$rs->paged->total_pages > 1) { ?>
		<tfoot>
			<tr>
				<td colspan="4" ><?php echo $rs->pagination();?></td>
			</tr>
		</tfoot>
	<?php } ?>
	
</table>