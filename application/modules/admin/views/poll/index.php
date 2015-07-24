<div class="col-lg-12">
	<?php if(@$title->title):?>
    <h1 class="page-header"><?php echo $title->title?></h1>
    <?php else:?>
    <h1 class="page-header">แบบสำรวจ</h1>
    <?php endif?>
</div>

<?php if(permission("polls","create")):?>
<form action="admin/orders/ma_survey/poll" method="post" >
<?php endif?>
<table class="table table-bordered table-hover table-responsive table-striped" >
	
	<thead>
		<tr>
			<th style="width: 80px;" >ลำดับ</th>
			<th style="width: 80px;" >สถานะ</th>
			<th>ชื่อ</th>
			<th>ประเภท</th>
			<th style="width: 100px;" >จำนวนคนดู / คนตอบ</th>
			<th style="width: 160px;" >วันที่เปิดให้ทำแบบประเมิน</th>
			<th style="width: 160px;" >วันที่สร้าง / วันที่แก้ไข</th>
			<th style="width: 160px;" ><a href="admin/poll/form" class="btn btn-primary" ><span class="glyphicon glyphicon-edit" ></span> เพิ่ม</a></th>
		</tr>
	</thead>
	
	<tbody>
		<?php 
		$qtype_text = array(1 => 'โหวต', 2 => 'แบบฟอร์ม');
		foreach ($variable as $key => $value):?>
		<tr>
			<td>
				<?php if(permission("polls","create")):?>
				<input type="text" class="form-control" name="orders[]" value="<?php echo $value->orders?>" style="text-align: center; width: 45px;" />
				<input type="hidden" name="id[]" value="<?php echo $value->id?>" />
				<?php endif?>
			</td>
			<td>
				<button type="button" id="<?php echo $value->id?>" class="btn <?php echo ($value->status==1) ? "btn-primary" : "btn-danger" ?>" data-loading-text="บันทึก..." value="<?php echo ($value->status==1) ? 1 : 0 ?>"  >
					<?php echo ($value->status==1) ? "On" : "Off" ?>
				</button>
			</td>
			<td><?php echo anchor('admin/poll_report/index/'.$value->id, $value->title); ?></td>
			<td><?php echo $qtype_text[$value->question_type]; ?></td>
			<td><?php echo @number_format($value->views,0)." / ".@number_format($value->results,0)?></td>
			<td>
				<small>
				<?php 
					if($value->period_type == 1) {
						echo '<span style="color:#0a0;">ไม่กำหนด</span>';
					} else {
						//Check status
						$current = strtotime(date('Y-m-d'));
						
						$status = '<span style="color:#0a0;">เปิดให้ใช้งานปรกติ';
						$status = (strtotime($value->end_date) < $current)?'<span style="color:#f00;">เลยกำหนดการทำแบบสอบถาม':$status;
						$status = (strtotime($value->start_date) > $current)?'<span style="color:#f00;">ยังไม่ถึงกำหนดเวลาทำแบบสอบถาม':$status;
							$status .= '</span>';

						//Check null
						$value->start_date = (empty($value->start_date))?'ไม่ระบุ':mysql_to_th($value->start_date, true);
						$value->end_date = (empty($value->end_date))?'ไม่ระบุ':mysql_to_th($value->end_date, true);

						echo '<div><strong>เริ่มต้น : </strong>'.@$value->start_date.'</div>'; 
						echo '<div><strong>สิ้นสุด : </strong>'.@$value->end_date.'</div>';
						echo '<div><strong>สถานะ : </strong>'.@$status.'</div>';
					}
	 					

				?>
				</small>
			</td>
			<td><small><?php echo mysql_to_th($value->created,"S",TRUE)."<br />".mysql_to_th($value->updated,"S",TRUE)?></small></td>
			<td>
				<?php if(permission("polls","create")):?>
				<a href="admin/poll/form/<?php echo $value->id?>" class="btn btn-primary" ><span class="glyphicon glyphicon-wrench" ></span> แก้ไข</a>
				<?php endif?>
				<?php if(permission("polls","delete")):?>
				<a href="admin/poll/delete/<?php echo $value->id?>" class="btn btn-danger" onclick="return confirm('ต้องการลบ <?php echo $value->title?> หรือไม่')" ><span class="glyphicon glyphicon-trash" ></span> ลบ</a>
				<?php endif?>
			</td>
		</tr>
		<?php endforeach?>
	</tbody>
	
	<tfoot>
		<tr>
			<td colspan="8" ><?php echo $variable->pagination()?></td>
		</tr>
	</tfoot>
	
</table>
<?php if(permission("polls","create")):?>
<button type="submit" class="btn btn-primary" ><span class="glyphicon glyphicon-ok" ></span> ยืนยัน</button>
</form>
<?php endif?>

<script type="text/javascript">
	$(document).ready(function(){
		
		$('button[data-loading-text]').click(function () {
		    var btn = $(this);
		    if(btn.val()==1) {
				btn.val(0);
		    	btn.removeClass("btn-primary");
		    	btn.addClass("btn-danger");
		    	var status = 0;
		    	var textstatus = "Off";
		    } else {
				btn.val(1);
		    	btn.removeClass("btn-danger");
		    	btn.addClass("btn-primary");
		    	var status = 1;
		    	var textstatus = "On";
		    }
		    btn.button('loading');
		    setTimeout(function(){
				btn.button('reset');
				btn.html(textstatus);
		    },1000);
		    
		    var id = btn.attr("id");
		    $.post("admin/approve/survey/"+id,{status:status});
		    return false;
		    
		});
		
	});
</script>