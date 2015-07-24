<div class="other-area" >
	<?php echo @form_dropdown("area_province_id[]",get_option("id","title","ma_province","WHERE $where AND operation_center_id = $o_id  ORDER BY TITLE ASC"),null,"class=\"form-control select-province\" data-target=\"area\" data-uid=\"$uid\" style=\"display: inline; margin: 0; width: 180px;\"","-- เลือกจังหวัด --")?>
	<div id="<?php echo $uid?>-amphur" class="area-amphur" ><?php echo @form_dropdown($uid,null,null,"class=\"form-control\"  style=\"display: inline; width: 180px; margin: 0;\"","-- เลือกอำเภอ --")?></div>
	<div class="area-amphur" >
		<button type="button" class="btn btn-danger btn-delete" >ลบจังหวัด</button>
	</div>
	<div>
		<input type="text" id="<?php echo $uid?>" class="tagsinput" name="area_amphur_id[]" readonly />
	</div>
</div>

<hr class="other-area" />