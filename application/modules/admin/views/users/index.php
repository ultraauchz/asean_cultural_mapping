<?php echo bread_crumb($menu_id);?>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
		<div class="box">
			<form method="get" enctype="multipart/form-data">
			<div class="box-header">
			  <h3 class="box-title">Search</h3>			  
			</div><!-- /.box-header -->
			<div style="float:left;width:100%;">
				<div class="col-xs-3">
			  	<label for="search">Search</label> 
			  	<input type="text" name="search" value="<?php echo @$_GET['search'];?>" placeholder="Firstname/Lastname/Username/Email" class="form-control">
			    </div>
				<div class="col-xs-3">
			  	<label for="country_id">Country</label> 			  	
			  	<?php
			  	if( $perm->can_access_all == 'y' ){
			  		echo form_dropdown("country_id",get_option("id","country_name","acm_country"," ORDER BY country_name ASC"),@$_GET["country_id"],"class=\"form-control\" style=\"display:inline;\" ","-- Select Country --","");	
			  	}else{
			  		$ext_condition = $perm->can_access_all == 'y' ? '' : " WHERE id = ".$current_user->organization->country_id;
			  		echo form_dropdown("country_id",get_option("id","country_name","acm_country",$ext_condition." ORDER BY country_name ASC"),@$_GET["country_id"],"class=\"form-control\" style=\"display:inline;\" ");
			  	}			  	
			  	?>
				</div>
				<div class="col-xs-3">
			  	<label for="organization_id">Organization</label> 
			  	<span class="span_org_data">
			  	<?php 
			  		$country_id = $perm->can_access_all != 'n' && @$_GET['country_id'] > 0 ? $current_user->organization->country_id : @$_GET['country_id'];
			  		$ext_condition = $country_id > 0 ? " WHERE country_id = ".$country_id : "";
			  		echo form_dropdown('org_id',get_option('id','org_name','acm_organization',$ext_condition." ORDER BY org_name ASC "),@$_GET['org_id'],'class="form-control"','-- all organization --');
			  	?>
			  	</span>
				</div>
			  <div class="col-xs-3">
			  	<br>
			  	<input type="submit" name="b" class="btn btn-primary" value="Search">
			  </div>
			</div>
			</form>
		<div class="box-body">
			<?php echo $variable->pagination()?>
			<table id="example1" class="table table-bordered table-striped table-hover table_data">
			    <thead>
			      <tr>
			        <th style="width: 80px;" >Status</th>
					<th>User</th>
					<th>Firstname Lastname</th>
					<th>Organization</th>
					<th>Position</th>
					<th>Country</th>
					<th>Email</th>			        
			        <th class="th_manage">Manage</th>
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
						<td><?php echo $value->position?></td>
						<td><?php echo $value->organization->country->country_name?></td>
						<td><small><?php echo $value->email?></small></td>
						<td>
							<?php if($perm->can_create == 'y'){?>
							<a href="admin/settings/<?php echo $modules_name;?>/form/<?php echo $value->id?>" class="btn btn-primary" ><span class="glyphicon glyphicon-wrench" ></span> Edit</a>
							<?php }else{ ?>
							<a href="admin/settings/<?php echo $modules_name;?>/form/<?php echo $value->id?>" class="btn btn-info" ><span class="glyphicon glyphicon-search" ></span> View</a>
							<?php } ?>
							<?php if($perm->can_delete =='y'){?>
							<a href="admin/settings/<?php echo $modules_name;?>/delete/<?php echo $value->id?>" class="btn btn-danger btn_delete"><span class="glyphicon glyphicon-trash" ></span> Delete</a>
							<?php } ?>
						</td>
					</tr>
					<?php endforeach?>
				</tbody>
				<tfoot>
			      <tr>
			        <th style="width: 80px;" >Status</th>
					<th>User</th>
					<th>Firstname Lastname</th>
					<th>Organization</th>
					<th>Position</th>
					<th>Country</th>
					<th>Email</th>			        
			        <th class="th_manage">Manage</th>
			      </tr>
			    </tfoot>
			</table>
			<?php if($perm->can_create=='y'){?>
			<div style="text-align:right;">
			  	<a href="admin/settings/<?php echo $modules_name;?>/form" class="btn btn-info"><li class="fa fa-plus"></li> Create new</a>
			</div>
			<?php } ?>
			<?php echo $variable->pagination()?>
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
		
		$("select[name=country_id]").change(function(){
			var country_id = $(this).val();
			$.post('admin/settings/organizations/load_organizations',{
			'country_id' : country_id,
			},function(data){
				$(".span_org_data").html(data);												
			});	
		});
		
	});
</script>