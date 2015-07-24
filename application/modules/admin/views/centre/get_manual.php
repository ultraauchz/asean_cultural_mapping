
<?php if(permission("centre","extra")):?>
<form action="admin/orders/ma_centre_manual/centre" method="post" >
<?php endif?>
<table class="table table-bordered table-hover table-striped" >
	<thead>
		<tr>
			<th style="width: 80px;" >ลำดับ</th>
			<th>ชื่อ</th>
			<th style="width: 160px;" >วันที่สร้าง / วันที่แก้ไข</th>
			<th style="width: 180px;" ><a href="admin/centre/manage/form_manual" class="btn btn-primary" ><span class="glyphicon glyphicon-edit" ></span> เพิ่ม</a></th>
		</tr>
	</thead>
	
	<tbody>
		<?php foreach ($variable as $key => $value):?>
		<tr>
			<td>
				<?php if(permission("centre","extra")):?>
				<input type="text" class="form-control" name="orders[]" value="<?php echo $value->orders?>" style="text-align: center; width: 45px;" />
				<input type="hidden" name="id[]" value="<?php echo $value->id?>" />
				<?php endif?>
			</td>
			<td>
				<?php echo $value->title?>
				<?php if($value->links && $value->link_type==2):?>
				&nbsp;<a href="<?php echo $value->links?>" class="label label-primary" title="<?php echo $value->title?>" target="_blank" >ลิงค์</a>
				<?php endif?>
			</td>
			<td><small><?php echo mysql_to_th($value->created,"S",TRUE)."<br />".mysql_to_th($value->updated,"S",TRUE)?></small></td>
			<td>
				<a href="admin/centre/manage/form_manual/<?php echo $value->id?>" class="btn btn-primary" title="แก้ไข : <?php echo $value->title?>" ><span class="glyphicon glyphicon-wrench" ></span> แก้ไข</a>
				<a href="admin/centre/manage/delete_manual/<?php echo $value->id?>" class="btn btn-danger" title="ลบ : <?php echo $value->title?>" onclick="return confirm('ต้องการลบ <?php echo $value->title?> หรือไม่')" ><span class="glyphicon glyphicon-trash" ></span> ลบ</a>
			</td>
		</tr>
			<?php foreach ($roots as $num => $row):if($row->parent==$value->id):?>
			<tr>
				<td>
					<?php if(permission("centre","extra")):?>
					<input type="text" class="form-control" name="orders[]" value="<?php echo $row->orders?>" style="text-align: center; width: 45px;" />
					<input type="hidden" name="id[]" value="<?php echo $row->id?>" />
					<?php endif?>
				</td>
				<td>
					<?php echo '-- '.$row->title?>
					<?php if($row->links && $row->link_type==2):?>
					&nbsp;<a href="<?php echo $row->links?>" class="label label-primary" title="<?php echo $row->title?>" target="_blank" >ลิงค์</a>
					<?php endif?>
				</td>
				<td><small><?php echo mysql_to_th($row->created,"S",TRUE)."<br />".mysql_to_th($row->updated,"S",TRUE)?></small></td>
				<td>
					<a href="admin/centre/manage/form_manual/<?php echo $row->id?>" class="btn btn-primary" title="แก้ไข : <?php echo $row->title?>" ><span class="glyphicon glyphicon-wrench" ></span> แก้ไข</a>
					<a href="admin/centre/manage/delete_manual/<?php echo $row->id?>" class="btn btn-danger" title="ลบ : <?php echo $row->title?>" onclick="return confirm('ต้องการลบ <?php echo $row->title?> หรือไม่')" ><span class="glyphicon glyphicon-trash" ></span> ลบ</a>
				</td>
			</tr>
			<?php endif;endforeach;?>
		<?php endforeach?>
	</tbody>
	
	<tfoot>
		<tr>
			<td colspan="4">&nbsp;</td>
		</tr>
	</tfoot>
	
</table>
<?php if(permission("centre","extra")):?>
<button type="submit" class="btn btn-primary" ><span class="glyphicon glyphicon-ok" ></span> ยืนยัน</button>
<input type="hidden" name="redirect" value="admin/centre/manage" >
</form>
<?php endif?>