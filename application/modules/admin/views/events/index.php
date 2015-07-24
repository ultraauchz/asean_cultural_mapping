<div class="col-lg-12">
	<?php if(@$title->title):?>
    <h1 class="page-header"><?php echo $title->title?></h1>
    <?php else:?>
    <h1 class="page-header">กิจกรรม</h1>
    <?php endif?>
</div>

<table class="table table-bordered table-hover table-responsive table-striped" >
	
	<thead>
		<tr>
			<th style="width: 80px;" >ลำดับ</th>
			<th style="width: 80px;" >สถานะ</th>
			<th>ชื่อ</th>
			<th>วันที่</th>
			<th style="width: 160px;" >วันที่สร้าง / วันที่แก้ไข</th>
			<th style="width: 160px;" >
				<?php if(permission("events","create")):?>
				<a href="admin/events/form?g=<?php echo @$_GET["g"]?>" class="btn btn-primary" ><span class="glyphicon glyphicon-edit" ></span> เพิ่ม</a>
				<?php endif?>
			</th>
		</tr>
	</thead>
	
	<tbody>
		<?php foreach ($variable as $key => $value):?>
		<tr>
			<td><?php $no ++;
					//echo $value->id;
					echo $no;
				?>
			</td>
			<td>
				<?php if(permission("events","create")):?>
				<button type="button" id="<?php echo $value->id?>" class="btn <?php echo ($value->status==1) ? "btn-primary" : "btn-danger" ?>" data-loading-text="บันทึก..." value="<?php echo ($value->status==1) ? 1 : 0 ?>"  >
					<?php echo ($value->status==1) ? "On" : "Off" ?>
				</button>
				<?php endif?>
			</td>
			<td>
				<?php echo $value->title;
					if(!@$_GET["g"]) {
						if(@$value->event_type_id) {
							echo " <a href=\"admin/events?g=".$value->event_type_id."\" ><small>(".$value->event_type->title.")</small></a>";
						} else {
							echo " <a href=\"admin/events?g=".$value->event_type_id."\" style=\"color: #f00;\" ><small>(ไม่มีประเภท)</small></a>";
						}
					}
				?>
			</td>
			<td>
				<?php echo ($value->start_date) ? "วันที่ ".mysql_to_th($value->start_date,"F",FALSE) : null?>
				<?php echo ($value->start_date && $value->end_date) ? "<br />ถึงวันที่ ".mysql_to_th($value->end_date,"F",FALSE) : null?>
			</td>
			<td><small><?php echo mysql_to_th($value->created,"S",TRUE)."<br />".mysql_to_th($value->updated,"S",TRUE)?></small></td>
			<td>
				<?php if(permission("events","create")):?>
				<a href="admin/events/form/<?php echo $value->id?>?g=<?php echo @$_GET["g"]?>" class="btn btn-primary" ><span class="glyphicon glyphicon-wrench" ></span> แก้ไข</a>
				<?php endif?>
				<?php if(permission("events","delete")):?>
				<a href="admin/events/delete/<?php echo $value->id?>?g=<?php echo @$_GET["g"]?>" class="btn btn-danger" onclick="return confirm('ต้องการลบ <?php echo $value->title?> หรือไม่')" ><span class="glyphicon glyphicon-trash" ></span> ลบ</a>
				<?php endif?>
			</td>
		</tr>
		<?php endforeach?>
	</tbody>
	
	<tfoot>
		<tr>
			<td colspan="6" ><?php echo $variable->pagination()?></td>
		</tr>
	</tfoot>
	
</table>

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
		    $.post("admin/approve/event/"+id,{status:status});
		    return false;
		    
		});
		
	});
</script>