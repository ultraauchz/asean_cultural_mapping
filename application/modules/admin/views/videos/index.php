<div class="col-lg-12">
    <h1 class="page-header">วีดีโอ</h1>
</div>


<form action="admin/orders/ma_video/videos" method="post" >
<table class="table table-bordered table-hover table-responsive table-striped" >
	
	<thead>
		<tr>
			<th style="width: 80px;" >ลำดับ</th>
			<th style="width: 80px;" >สถานะ</th>
			<th>ชื่อ</th>
			<th style="width: 160px;" >วันที่สร้าง / วันที่แก้ไข</th>
			<th style="width: 160px;" ><a href="admin/videos/form" class="btn btn-primary" ><span class="glyphicon glyphicon-edit" ></span> เพิ่ม</a></th>
		</tr>
	</thead>
	
	<tbody>
		<?php foreach ($variable as $key => $value):?>
		<tr>
			<td>
				<?php if(permission("video","create")):?>
				<input type="text" class="form-control" name="orders[]" value="<?php echo $value->orders?>" style="text-align: center; width: 45px;" />
				<input type="hidden" name="id[]" value="<?php echo $value->id?>" />
				<?php endif?>
			</td>
			<td>
				<button type="button" id="<?php echo $value->id?>" class="btn <?php echo ($value->status==1) ? "btn-primary" : "btn-danger" ?>" data-loading-text="บันทึก..." value="<?php echo ($value->status==1) ? 1 : 0 ?>"  >
					<?php echo ($value->status==1) ? "On" : "Off" ?>
				</button>
			</td>
			<td><?php echo $value->title?> <a href="<?php echo $value->links?>" ><small>ลิงค์</small></a></td>
			<td><small><?php echo mysql_to_th($value->created,"S",TRUE)."<br />".mysql_to_th($value->updated,"S",TRUE)?></small></td>
			<td>
				<a href="admin/videos/form/<?php echo $value->id?>" class="btn btn-primary" ><span class="glyphicon glyphicon-wrench" ></span> แก้ไข</a>
				<a href="admin/videos/delete/<?php echo $value->id?>" class="btn btn-danger" onclick="return confirm('ต้องการลบ <?php echo $value->title?> หรือไม่')" ><span class="glyphicon glyphicon-trash" ></span> ลบ</a>
			</td>
		</tr>
		<?php endforeach?>
	</tbody>
	
	<tfoot>
		<tr>
			<td colspan="5" ><?php echo $variable->pagination();?></td>
		</tr>
	</tfoot>
	
</table>
<?php if(permission("video","create")):?>
<button type="submit" class="btn btn-primary" ><span class="glyphicon glyphicon-ok" ></span> ยืนยัน</button>
<?php endif?>
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
		    $.post("admin/approve/video/"+id,{status:status});
		    return false;
		    
		});
		
	});
</script>