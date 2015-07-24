<div class="col-lg-12">
    <h1 class="page-header">หมวดหมู่หนังสืออิเล็กทรอนิกส์</h1>
</div>



<?php if(permission("ebook_groups","create")):?>
<form action="admin/orders/ebook_group/ebook_groups" method="post" >
<?php endif?>
<table class="table table-bordered table-hover table-responsive table-striped" >
	
	<thead>
		<tr>
			<th style="width: 80px;" >ลำดับ</th>
			<th style="width: 80px;" >สถานะ</th>
			<th>ชื่อ</th>
			<th style='width:120px;'>จำนวนหนังสือในหมวดหมู่</th>
			<th style="width: 160px;" >วันที่สร้าง / วันที่แก้ไข</th>
			<th style="width: 160px;" >
				<?php if(permission("ebook_groups","create")):?>
				<a href="admin/ebook_groups/form" class="btn btn-primary" ><span class="glyphicon glyphicon-edit" ></span> เพิ่ม</a>
				<?php endif?>
			</th>
		</tr>
	</thead>
	
	<tbody>
		<?php foreach ($rs as $key => $value): ?>
		<tr>
			<td>
				<?php if(permission("ebook_groups","create")):?>
				<input type="text" class="form-control" name="orders[]" value="<?php echo $value->orders?>" style="text-align: center; width: 45px;" />
				<input type="hidden" name="id[]" value="<?php echo $value->id?>" />
				<?php endif?>
			</td>
			<td>
				<?php if(permission("ebook_groups","delete")):?>
				<button type="button" id="<?php echo $value->id?>" class="btn <?php echo ($value->status==1) ? "btn-primary" : "btn-danger" ?>" data-loading-text="บันทึก..." value="<?php echo ($value->status==1) ? 1 : 0 ?>"  >
					<?php echo ($value->status==1) ? "On" : "Off" ?>
				</button>
				<?php endif?>
			</td>
			
			<td> <strong><?php echo $value->title?></strong> </td>
			<td> <? echo count($value->ebook->all); ?> เล่ม</td>
			<td><small><?php echo mysql_to_th($value->created,"S",TRUE)."<br />".mysql_to_th($value->updated,"S",TRUE)?></small></td>
			<td>
				<?php if(permission("ebook_groups","create")):?>
				<a href="admin/ebook_groups/form/<?php echo $value->id?>" class="btn btn-primary" ><span class="glyphicon glyphicon-wrench" ></span> แก้ไข</a>
				<?php endif?>
				<?php if(permission("ebook_groups","delete")):?>
				<a href="admin/ebook_groups/delete/<?php echo $value->id?>" class="btn btn-danger <? echo (count($value->ebook->all))?'disabled':null; ?>" onclick="return confirm('ต้องการลบ <?php echo $value->title?> หรือไม่')" ><span class="glyphicon glyphicon-trash" ></span> ลบ</a>
				<?php endif?>
			</td>
		</tr>
		<?php endforeach?>
	</tbody>
	
	<? if(count($rs->all) >= 20) { ?> 
		<tfoot>
			<tr>
				<td colspan="6" ><?php echo $rs->pagination()?></td>
			</tr>
		</tfoot>
	<? } ?>
</table>

<?php if(permission("ebook_groups","create")):?>
<button type="submit" class="btn btn-primary" ><span class="glyphicon glyphicon-ok" ></span> ยืนยัน</button>
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
		    $.post("admin/approve/ebook_group/"+id,{status:status});
		    return false;
		    
		});
		
	});
</script>