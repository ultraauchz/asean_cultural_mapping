<?php echo bread_crumb($menu_id);?>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
		<div class="box">

		<form>		
			<div class="box-header">
				  <h3 class="box-title">Search</h3>			  
			</div><!-- /.box-header -->
			Username/Firstname/Lastname
			<input type="text" class="form-control" name="u" value="<?php echo @$_GET["u"]?>" style="display: inline-block; width: 100px;" />
			Organization
			<?php echo form_dropdown("org_id",get_option("id","org_name","acm_organization"," ORDER BY org_name ASC"),@$_GET["org_id"],"class=\"form-control\" style=\"display:inline;width: 150px;\" ","-- Select Organization --","")?>
			Status
			<select class="form-control" name="s" style="display: inline-block; width:80px;" >
				<option value="0" <?php if(@$_GET["s"]==0) echo "selected"?> >Actived</option>
				<option value="1" <?php if(@$_GET["s"]==1) echo "selected"?> >Inactived</option>
			</select>
			
			<button type="submit" class="btn btn-default" >ค้นหา</button>
		</form>
		<div class="box-body">
			<table class="table table-bordered table-hover table-responsive table-striped" >
				
				<thead>
					<tr>
						<th style="width: 80px;" >สถานะ</th>
						<th>User</th>
						<th>Firstname Lastname</th>
						<th>Organization</th>
						<th>Country</th>
						<th>Email</th>
						<th style="width: 160px;" ><a href="admin/settings/users/form" class="btn btn-primary" ><span class="glyphicon glyphicon-edit" ></span> เพิ่ม</a></th>
					</tr>
				</thead>
				
				<tbody>
					<?php foreach ($variable as $key => $value):?>
					<tr>
						<td>
							<button type="button" id="<?php echo $value->id?>" class="btn <?php echo ($value->status==1) ? "btn-primary" : "btn-danger" ?>" data-loading-text="บันทึก..." value="<?php echo ($value->status==1) ? 1 : 0 ?>"  >
								<?php echo ($value->status==1) ? "On" : "Off" ?>
							</button>
						</td>
						<td><?php echo $value->username?></td>
						<td><?php echo $value->firstname." ".$value->lastname?></td>
						<td><?php echo $value->organization->org_name?></td>
						<td><?php echo $value->country->country_name?></td>
						<td><small><?php echo $value->email?></small></td>
						<td>
							<a href="admin/settings/users/form/<?php echo $value->id?>" class="btn btn-primary" ><span class="glyphicon glyphicon-wrench" ></span> แก้ไข</a>
							<a href="admin/settings/users/delete/<?php echo $value->id?>" class="btn btn-danger" onclick="return confirm('ต้องการลบ <?php echo $value->title?> หรือไม่')" ><span class="glyphicon glyphicon-trash" ></span> ลบ</a>
						</td>
					</tr>
					<?php endforeach?>
				</tbody>
				
				<tfoot>
					<tr>
						<td colspan="7" ><?php echo $variable->pagination()?></td>
					</tr>
				</tfoot>
				
			</table>
		</div>
		</div><!-- /.box -->
	</div>
  </div>
</section>		
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
		    $.post("admin/approve/user/"+id,{status:status});
		    return false;
		    
		});
		
	});
</script>