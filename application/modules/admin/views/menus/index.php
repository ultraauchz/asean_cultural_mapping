<div class="col-lg-12">
    <h1 class="page-header">เมนู</h1>
</div>

<form action="admin/orders/ma_menu/menus" method="post" >
<table class="table table-bordered table-hover table-responsive table-striped" >
	
	<thead>
		<tr>
			<th style="width: 80px;" >ลำดับ</th>
			<th style="width: 80px;" >สถานะ</th>
			<th>ชื่อ</th>
			<th style="width: 160px;" >วันที่สร้าง / วันที่แก้ไข</th>
			<th style="width: 160px;" ><a href="admin/menus/form" class="btn btn-primary" ><span class="glyphicon glyphicon-edit" ></span> เพิ่ม</a></th>
		</tr>
	</thead>
	
	<tbody>
		<?php
			foreach ($variable as $key => $value):
				if($value->parent_id==0):
        			switch ($value->route) {
						case 1:
							$links = $value->links;
							break;
						case 2:
							$links = $value->links;
							break;
						case 3:
							$links = "m/".$value->slug;
							break;
						default:
							$links = "#";
							break;
					}
		?>
		<tr>
			<td>
				<input type="text" class="form-control" name="orders[]" value="<?php echo $value->orders?>" style="text-align: center; width: 45px;" />
				<input type="hidden" name="id[]" value="<?php echo $value->id?>" />
			</td>
			<td>
				<button type="button" id="<?php echo $value->id?>" class="btn <?php echo ($value->status==1) ? "btn-primary" : "btn-danger" ?>" data-loading-text="บันทึก..." value="<?php echo ($value->status==1) ? 1 : 0 ?>"  >
					<?php echo ($value->status==1) ? "On" : "Off" ?>
				</button>
			</td>
			<td><?php echo $value->title?> <a href="<?php echo $links?>" target="_blank" ><small>ลิงค์</small></a></td>
			<td><small><?php echo mysql_to_th($value->created,"S",TRUE)."<br />".mysql_to_th($value->updated,"S",TRUE)?></small></td>
			<td>
				<a href="admin/menus/form/<?php echo $value->id?>" class="btn btn-primary" ><span class="glyphicon glyphicon-wrench" ></span> แก้ไข</a>
				<a href="admin/menus/delete/<?php echo $value->id?>" class="btn btn-danger" onclick="return confirm('ต้องการลบ <?php echo $value->title?> หรือไม่')" ><span class="glyphicon glyphicon-trash" ></span> ลบ</a>
			</td>
		</tr>
			<?php
				foreach ($roots as $num => $row):
					if($row->parent_id==$value->id):
	        			switch ($row->route) {
							case 1:
								$links = $row->links;
								break;
							case 2:
								$links = $row->links;
								break;
							case 3:
								$links = "m/".$row->slug;
								break;
							default:
								$links = "#";
								break;
						}
			?>
				<tr>
					<td style="padding-left: 20px;" >
						<input type="text" class="form-control" name="orders[]" value="<?php echo $row->orders?>" style="text-align: center; width: 45px;" />
						<input type="hidden" name="id[]" value="<?php echo $row->id?>" />
					</td>
					<td>
						<button type="button" id="<?php echo $row->id?>" class="btn <?php echo ($row->status==1) ? "btn-primary" : "btn-danger" ?>" data-loading-text="บันทึก..." value="<?php echo ($row->status==1) ? 1 : 0 ?>"  >
							<?php echo ($row->status==1) ? "On" : "Off"; ?>
						</button>
					</td>
					<td style="padding-left: 40px;" >--  <?php echo $row->title; ?> 
						<a href="<?php echo $links?>" target="_blank" ><small>ลิงค์</small></a>
					</td>
					<td><small><?php echo mysql_to_th($row->created,"S",TRUE)."<br />".mysql_to_th($row->updated,"S",TRUE)?></small></td>
					<td>
						<a href="admin/menus/form/<?php echo $row->id?>" class="btn btn-primary" ><span class="glyphicon glyphicon-wrench" ></span> แก้ไข</a>
						<a href="admin/menus/delete/<?php echo $row->id?>" class="btn btn-danger" onclick="return confirm('ต้องการลบ <?php echo $row->title?> หรือไม่')" ><span class="glyphicon glyphicon-trash" ></span> ลบ</a>
					</td>
				</tr>
			<?php
					endif;
				endforeach; 
			?>
		<?php endif?>
		<?php endforeach?>
	</tbody>
	
	<tfoot>
		<tr>
			<td colspan="5" ><button type="submit" class="btn btn-primary" ><span class="glyphicon glyphicon-ok" ></span> ยืนยัน</button></td>
		</tr>
	</tfoot>
	
</table>
</form>

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
		    $.post("admin/approve/menu/"+id,{status:status});
		    return false;
		    
		});
		
	});
</script>