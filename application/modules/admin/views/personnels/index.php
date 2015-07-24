<div class="col-lg-12">
    <h1 class="page-header">บุคลากร (<?php echo $dept->title; ?>)</h1>
</div>
<?php
	function personnels_list($id=null,$num, $department_id) {
		if ($id){
			$list = new Personnel('');
			$list->where('department_id',$department_id);
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
					<td><?php echo $tmp->fname.' '.$tmp->lname?></td>
					<td><small><?php echo mysql_to_th($tmp->created,"S",TRUE)."<br />".mysql_to_th($tmp->updated,"S",TRUE)?></small></td>
					<td>
						<a href="admin/personnels/forms/<?php echo $tmp->department_id;?>/<?php echo $tmp->id ?>" class="btn btn-primary" style="margin-bottom: 5px" ><span class="glyphicon glyphicon-plus-sign" ></span> บุคลาการภายใต้</a><br />
						<a href="admin/personnels/form/<?php echo $tmp->department_id; ?>/<?php echo $tmp->id?>" class="btn btn-primary" ><span class="glyphicon glyphicon-wrench" ></span> แก้ไข</a>
						<a href="admin/personnels/delete/<?php echo $tmp->department_id; ?>/<?php echo $tmp->id?>/<?php echo $tmp->parent_id?>" class="btn btn-danger" onclick="return confirm('ต้องการลบ <?php echo $tmp->title?> หรือไม่')" ><span class="glyphicon glyphicon-trash" ></span> ลบ</a>
					</td>
				</tr>
<?php
				personnels_list($tmp->id, $num_new, $tmp->department_id);
			}
		}	
	}
?>
<table class="table table-bordered table-hover table-responsive table-striped" >
	
	<thead>
		<tr>
			<th style="width: 80px;" >ลำดับ</th>
			<th style="width: 80px;" >สถานะ</th>
			<th>ชื่อบุคลากร</th>
			<th style="width: 160px;" >วันที่สร้าง / วันที่แก้ไข</th>
			<th style="width: 160px;" ><a href="admin/personnels/form/<?php echo $dept->id; ?>" class="btn btn-primary" ><span class="glyphicon glyphicon-edit" ></span> เพิ่ม</a></th>
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
			<td><?php echo $value->fname.' '.$value->lname?></td>
			<td><small><?php echo mysql_to_th($value->created,"S",TRUE)."<br />".mysql_to_th($value->updated,"S",TRUE)?></small></td>
			<td>
				<a href="admin/personnels/forms/<?php echo $dept->id;?>/<?php echo $value->id ?>" class="btn btn-primary" style="margin-bottom: 5px" ><span class="glyphicon glyphicon-plus-sign" ></span> บุคลาการภายใต้</a><br />
				<a href="admin/personnels/form/<?php echo $dept->id; ?>/<?php echo $value->id?>" class="btn btn-primary" ><span class="glyphicon glyphicon-wrench" ></span> แก้ไข</a>
				<a href="admin/personnels/delete/<?php echo $dept->id; ?>/<?php echo $value->id?>/<?php echo $value->parent_id?>" class="btn btn-danger" onclick="return confirm('ต้องการลบ <?php echo $value->title?> หรือไม่')" ><span class="glyphicon glyphicon-trash" ></span> ลบ</a>
			</td>
		</tr>
		<?php personnels_list($value->id, $value->orders, $value->department_id) ?>
		<?php endforeach?>
	</tbody>
	
	<tfoot>
		<tr>
			<td colspan="5" ><?php echo $variable->pagination();?></td>
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
		    $.post("admin/approve/personnel/"+id,{status:status});
		    return false;
		    
		});
		
	});
</script>