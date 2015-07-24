<div class="col-lg-12">
    <h1 class="page-header">หน่วยงาน</h1>
</div>
<?php
	function department_list($id=null,$num) {
		if ($id){
			$list = new Department();
			$list->where('parent_id',$id);
			$list->order_by('orders', 'asc');
			$list->get();
			
			foreach ($list as $key_tmp => $tmp) {
				$number = $tmp->orders;
				$num_new = $num.'.'.$number;
?>
				<tr>
					<td><?php echo $num_new?></td>
					<td>
						<button type="button" id="<?php echo $tmp->id?>" class="btn <?php echo ($tmp->status==1) ? "btn-primary" : "btn-danger" ?>" data-loading-text="บันทึก..." value="<?php echo ($tmp->status==1) ? 1 : 0 ?>"  >
							<?php echo ($tmp->status==1) ? "On" : "Off" ?>
						</button>
					</td>
					<td><?php echo $tmp->title?></td>
					<td><a href="admin/personnels/index/<?php echo $tmp->id?>" class="btn btn-primary">บุคลากร</a></td>
					<td><small><?php echo mysql_to_th($tmp->created,"S",TRUE)."<br />".mysql_to_th($tmp->updated,"S",TRUE)?></small></td>
					<td>
						<?php if(permission("departments","create")):?>
						<a href="admin/departments/forms/<?php echo $tmp->id?>" class="btn btn-primary" style="margin-bottom: 5px" ><span class="glyphicon glyphicon-plus-sign" ></span> หน่วยงานย่อย</a><br />
						<a href="admin/departments/form/<?php echo $tmp->id?>" class="btn btn-primary" ><span class="glyphicon glyphicon-wrench" ></span> แก้ไข</a>
						<?php endif?>
						<?php if(permission("departments","delete")):?>
						<a href="admin/departments/delete/<?php echo $tmp->id?>" class="btn btn-danger" onclick="return confirm('ต้องการลบ <?php echo $tmp->title?> หรือไม่')" ><span class="glyphicon glyphicon-trash" ></span> ลบ</a>
						<?php endif?>
					</td>
				</tr>
<?php
				department_list($tmp->id, $num_new);
			}
		}	
	}
?>

<table class="table table-bordered table-hover table-responsive table-striped" >
	
	<thead>
		<tr>
			<th style="width: 80px;" >ลำดับ</th>
			<th style="width: 80px;" >สถานะ</th>
			<th>ชื่อหน่วยงาน</th>
			<tH style="width: 160px">บุคลากร</tH>
			<th style="width: 160px;" >วันที่สร้าง / วันที่แก้ไข</th>
			<th style="width: 160px;" >
				<?php if(permission("departments","create")):?>
				<a href="admin/departments/form" class="btn btn-primary" ><span class="glyphicon glyphicon-edit" ></span> เพิ่ม</a>
				<?php endif?>
			</th>
		</tr>
	</thead>
	
	<tbody>
		<?php
			foreach ($variable as $key => $value):
				$num = $key+1;
		?>
		<tr>
			<td><?php echo $value->orders; ?></td>
			<td>
				<button type="button" id="<?php echo $value->id?>" class="btn <?php echo ($value->status==1) ? "btn-primary" : "btn-danger" ?>" data-loading-text="บันทึก..." value="<?php echo ($value->status==1) ? 1 : 0 ?>"  >
					<?php echo ($value->status==1) ? "On" : "Off" ?>
				</button>
			</td>
			<td><?php echo $value->title?></td>
			<td><a href="admin/personnels/index/<?php echo $value->id?>" class="btn btn-primary">บุคลากร</a></td>
			<td><small><?php echo mysql_to_th($value->created,"S",TRUE)."<br />".mysql_to_th($value->updated,"S",TRUE)?></small></td>
			<td>
				<?php if(permission("departments","create")):?>
				<a href="admin/departments/forms/<?php echo $value->id?>" class="btn btn-primary" style="margin-bottom: 5px" ><span class="glyphicon glyphicon-plus-sign" ></span> หน่วยงานย่อย</a><br />
				<a href="admin/departments/form/<?php echo $value->id?>" class="btn btn-primary" ><span class="glyphicon glyphicon-wrench" ></span> แก้ไข</a>
				<?php endif?>
				<?php if(permission("departments","delete")):?>
				<a href="admin/departments/delete/<?php echo $value->id?>" class="btn btn-danger" onclick="return confirm('ต้องการลบ <?php echo $value->title?> หรือไม่')" ><span class="glyphicon glyphicon-trash" ></span> ลบ</a>
				<?php endif?>
			</td>
		</tr>
		<?php department_list($value->id, $value->orders) ?>
		<?php endforeach?>
	</tbody>
	
	<tfoot>
		<tr>
			<td colspan="5" ><?php //echo $variable->pagination();?></td>
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
		    $.post("admin/approve/department/"+id,{status:status});
		    return false;
		    
		});
		
	});
</script>