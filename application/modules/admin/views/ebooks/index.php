<div class="col-lg-12">
    <h1 class="page-header">
    	หนังสืออิเล็กทรอนิกส์ <? if(!empty($_GET['g'])) { echo $cat->title; } ?> 
    </h1>
</div>


<?php if(permission("ebooks","create")):?>
<form action="admin/orders/ebook/ebooks" method="post" >
<?php endif?>
<table class="table table-bordered table-hover table-responsive table-striped" >
	
	<thead>
		<tr>
			<th style="width: 60px;" >ลำดับ</th>
			<th style="width: 80px;" >สถานะ</th>
			<th>ชื่อ</th>
			<th>หมวดหมู่</th>
			<th style="width:100px;">จำนวนหน้า</th>
			<th style="width:100px;">จำนวนชม</th>
			<th style="width: 160px;" >วันที่สร้าง / วันที่แก้ไข</th>
			<th style="width: 160px;" >
				<?php if(permission("ebooks","create")):?>
				<a href="admin/ebooks/form?g=<? echo @$_GET['g']; ?>" class="btn btn-primary" ><span class="glyphicon glyphicon-edit" ></span> เพิ่ม</a>
				<?php endif;
					if(permission("ebooks","views")):
					echo anchor('admin/ebooks/report', 'รายงาน', 'class="btn btn-success"');
					endif;
				?>
			</th>
		</tr>
	</thead>
	
	<tbody>
		<?php
		
		if(count($rs->result_array()) == 0) {
			echo '<tr><td colspan="7" style="text-align:center; color:#aaa; line-height:30px;">ไม่พบข้อมูล</td></tr>';
		} 
		foreach ($rs->result() as $key => $value): 
			@$value->ebook_groups = new Ebook_group($value->ebook_group_id);
			@$value->ebook_detail = new Ebook_detail();
			$value->ebook_detail->where('ebook_id', $value->id)->get();
		?>
			<tr>
				<td>
					<?php if(permission("ebooks","create")):?>
					<input type="text" class="form-control" name="orders[]" value="<?php echo $value->orders?>" style="text-align: center; width: 45px;" />
					<input type="hidden" name="id[]" value="<?php echo $value->id?>" />
					<?php endif?>
				</td>
				<td>
					<?php if(permission("ebooks","create")):?>
					<button type="button" id="<?php echo $value->id?>" class="btn <?php echo ($value->status==1) ? "btn-primary" : "btn-danger" ?>" data-loading-text="บันทึก..." value="<?php echo ($value->status==1) ? 1 : 0 ?>"  >
						<?php echo ($value->status==1) ? "On" : "Off" ?>
					</button>
					<?php endif?>
				</td>
				<td> <strong><?php echo $value->title?></strong> </td>
				<td><? echo $value->ebook_groups->title; ?></td>
				<td class='text-right'><? echo count($value->ebook_detail->all); ?></td>
				<td class='text-right'><? echo (empty($value->viewer))?0:$value->viewer; ?></td>
				<td><small><?php echo mysql_to_th($value->created,"S",TRUE)."<br />".mysql_to_th($value->updated,"S",TRUE)?></small></td>
				<td>
					<?php if(permission("ebooks","create")):?>
					<a href="admin/ebooks/form/<?php echo $value->id?>" class="btn btn-primary" ><span class="glyphicon glyphicon-wrench" ></span> แก้ไข</a>
					<?php endif?>
					<?php if(permission("ebooks","delete")):?>
					<a href="admin/ebooks/delete/<?php echo $value->id?>" class="btn btn-danger" onclick="return confirm('ต้องการลบ <?php echo $value->title?> หรือไม่')" ><span class="glyphicon glyphicon-trash" ></span> ลบ</a>
					<?php endif?>
				</td>
			</tr>
		<?php endforeach?>
	</tbody>
	
	<? if(count($rs->result_array()) >= 20) { ?> 
		<tfoot>
			<tr>
				<td colspan="6" ><?php echo $rs->pagination()?></td>
			</tr>
		</tfoot>
	<? } ?>
</table>

<?php if(permission("ebooks","create")):?>
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
		    $.post("admin/approve/ebook/"+id,{status:status});
		    return false;
		    
		});
		
	});
</script>