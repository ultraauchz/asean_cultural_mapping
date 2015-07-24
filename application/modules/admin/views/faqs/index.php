<div class="col-lg-12">
	<?php if(@$title->title):?>
    <h1 class="page-header"><?php echo $title->title?></h1>
    <?php else:?>
    <h1 class="page-header">FAQ</h1>
    <?php endif?>
</div>

<?php if(permission("faqs","create")):?>
<form action="admin/orders/ma_faqs/faqs" method="post" >
<?php endif?>
<table class="table table-bordered table-hover table-responsive table-striped" >
	
	<thead>
		<tr>
			<th style="width: 80px;" >ลำดับ</th>
			<th style="width: 80px;" >สถานะ</th>
			<th>คำถาม</th>
			<th>คำตอบ</th>
			<th style="width: 160px;" >วันที่สร้าง / วันที่แก้ไข</th>
			<th style="width: 160px;" >
				<?php if(permission("faqs","create")):?>
				<a href="admin/faqs/form?g=<?php echo @$_GET["g"]?>" class="btn btn-primary" ><span class="glyphicon glyphicon-edit" ></span> เพิ่ม</a>
				<?php endif?>
			</th>
		</tr>
	</thead>
	
	<tbody>
		<?php foreach ($variable as $key => $value):?>
		<tr>
			<td>
				<?php if(permission("faqs","create")):?>
				<input type="text" class="form-control" name="orders[]" value="<?php echo $value->orders?>" style="text-align: center; width: 45px;" />
				<input type="hidden" name="id[]" value="<?php echo $value->id?>" />
				<?php endif?>
			</td>
			<td>
				<?php if(permission("faqs","create")):?>
				<button type="button" id="<?php echo $value->id?>" class="btn <?php echo ($value->status==1) ? "btn-primary" : "btn-danger" ?>" data-loading-text="บันทึก..." value="<?php echo ($value->status==1) ? 1 : 0 ?>"  >
					<?php echo ($value->status==1) ? "On" : "Off" ?>
				</button>
				<?php endif?>
			</td>
			<td>
				<strong><?php echo $value->question?></strong>
			</td>
			<td><?=$value->answer?></td>
			<td><small><?php echo mysql_to_th($value->created,"S",TRUE)."<br />".mysql_to_th($value->updated,"S",TRUE)?></small></td>
			<td>
				<?php if(permission("faqs","create")):?>
				<a href="admin/faqs/form/<?php echo $value->id?>" class="btn btn-primary" ><span class="glyphicon glyphicon-wrench" ></span> แก้ไข</a>
				<?php endif?>
				<?php if(permission("faqs","delete")):?>
				<a href="admin/faqs/delete/<?php echo $value->id?>" class="btn btn-danger" onclick="return confirm('ต้องการลบ <?php echo $value->question?> หรือไม่')" ><span class="glyphicon glyphicon-trash" ></span> ลบ</a>
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
<?php if(permission("faqs","create")):?>
<button type="submit" class="btn btn-primary" ><span class="glyphicon glyphicon-ok" ></span> ยืนยัน</button>
<?php if(@$_GET["g"]):?>
<input type="hidden" name="g" value="<?php echo @$_GET["g"]?>" />
<?php endif?>
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
		    $.post("admin/approve/faq/"+id,{status:status});
		    return false;
		    
		});
		
	});
</script>