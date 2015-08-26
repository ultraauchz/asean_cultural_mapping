<?php echo bread_crumb($menu_id);?>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
		<div class="box">
			<form method="post" enctype="multipart/form-data" action="admin/settings/organizations/save/<?=@$rs->id?>">
			<div class="box-header">
			  <h3 class="box-title">Add/Edit</h3>			  
			</div><!-- /.box-header -->
			
			<div class="box-body">
				<div class="form-group">
		              <label>NAME</label>
		              <input type="text" class="form-control" name="org_name" value="<?php echo @$rs->org_name;?>">
	            </div>
	            <div class="form-group">
		              <label>CODE</label>
		              <input type="text" class="form-control" name="org_code" value="<?php echo @$rs->org_code;?>">
	            </div>	
				<div class="form-group">
		              <label>ADDRESS</label>
		              <textarea class="form-control" name="org_address"><?php echo @$rs->org_address;?></textarea>
	            </div>		            
	            <div class="form-group">
		              <label>COUNTRY</label>
		              <?php
					  	if( $perm->can_access_all == 'y' ){
					  		echo form_dropdown("country_id",get_option("id","country_name","acm_country"," where zone='ASEAN' ORDER BY country_name ASC"),@$rs->country_id,"class=\"form-control\" style=\"display:inline;\" ","-- Select Country --","");	
					  	}else{
					  		$ext_condition = $perm->can_access_all == 'y' ? '' : " WHERE id = ".$current_user->organization->country_id;
					  		echo form_dropdown("country_id",get_option("id","country_name","acm_country",$ext_condition." ORDER BY country_name ASC"),@$rs->country_id,"class=\"form-control\" style=\"display:inline;\" ");
					  	}			  	
					  ?>
	            </div> 
				<div class="form-group">
		              <label>STATE</label>
		              <span class="span_state_id">
		              <?php
		              	$country_id = $rs->country_id > 0 ? $rs->country_id : $current_user->organization->country_id;
		              	$ext_condition = @$country_id > 0 ? " WHERE country_id = ".$country_id : "";
		              	echo form_dropdown('state_id',get_option('id','state_name','acm_state',$ext_condition.' order by id asc'),@$rs->state_id,'class="form-control"','--- STATE ---') 
		              ?>
		              </span>
	            </div>
	            <div class="form-group">
		              <label>ZIPCODE</label>
		              <input type="text" class="form-control" name="zipcode" value="<?php echo @$rs->zipcode;?>">
	            </div>	
	            <div class="form-group">
		              <label>EMAIL</label>
		              <input type="email" class="form-control" name="org_email" value="<?php echo @$rs->org_email;?>">
	            </div>
	            <div class="col-xs-2" style="padding:0px;">
	            <div class="form-group">
		              <label>LATITUDE</label>
		              <input type="text" class="form-control" name="org_latitude" value="<?php echo @$rs->org_latitude;?>">
	            </div>
	            </div>
	            <div class="col-xs-2" style="padding-left:5px;">
	            <div class="form-group">
		              <label>LONGTITUDE</label>
		              <input type="text" class="form-control" name="org_longitude" value="<?php echo @$rs->org_longitude;?>">
	            </div>
	            </div>
	            <div class="clearfix"></div>
	            <div class="form-group">
		              <label>DESCRIPTION</label>
		              <textarea class="form-control" name="org_description"><?php echo @$rs->org_description;?></textarea>
	            </div>
	            <div class="form-group">
		              <label for="exampleInputEmail1">DETAIL</label>
		              <textarea class="form-control"  name="org_detail" id="detail" ><?=@$rs->org_detail;?></textarea>
	            </div>
	            <?php if(@$rs->id > 0) : ?>
	            <fieldset>
	            	<legend>Network Membership</legend>
	            	<?php if($perm->can_create=='y'){?>
	            	<a href="admin/networks/iframe_list?id=<?=@$rs->id;?>&area=admin&ctrl=settings/organizations&action=save_network_organization" class="btn btn-success iframe-btn" >Add Member</a>
	            	<?php } ?>
	            	<table class="table table-bordered">
	            		<thead>
	            			<tr>
	            				<th>No.</th>
	            				<th>Network Name</th>
	            				<th>Code</th>
	            				<th>Manage</th>
	            			</tr>
	            		</thead>
	            		<tbody>
	            			<?php
	            			$no = 0; 
	            			foreach ($network_org as $key => $network_org_item):
								$no++; 
	            			?>
	            			<tr>
	            				<td><?php echo $no;?></td>
	            				<td><?php echo $network_org_item->network->title;?></td>
	            				<td><?php echo $network_org_item->network->code;?></td>
	            				<td>
	            					<?php if($perm->can_create=='y'){?>
	            					<a href="admin/settings/organizations/delete_network_org/<?=$network_org_item->id;?>" class="btn_delete btn btn-danger">X</a>
	            					<?php } ?>
	            				</td>
	            			</tr>
	            			<?php endforeach;?>
	            		</tbody>
	            	</table>
	            </fieldset>  
	            <?php endif;?>
	            <table>
	            	<tr>
	            		<td>
				            <div class="form-group">
					              <label for="exampleInputEmail1">Create By / Created Date</label>
					              <div class="input-group" style="width:350px;">
						              <span class="input-group-addon"><i class="fa fa-user"></i></span>
						              <?php 
						              $user = @$rs->created_by > 0 ? user($rs->created_by) : '';
									  $username = $rs->created_by > 0 ? $user->titulation.' '.$user->firstname.' '.$user->lastname : '';
									  ?>
						              <input type="text" class="form-control" disabled="disabled" id="register_date" name="register_date"  value="<?php echo @$username.'  '.@$rs->created;?>">
					              </div>
				            </div>			
	            		</td>
	            		<td>
	            			<div class="form-group">
					              <label for="exampleInputEmail1">Update By / Updated Date</label>
					              <div class="input-group" style="width:350px;">
						              <span class="input-group-addon"><i class="fa fa-user"></i></span>
						              <?php 
						              $user = @$rs->updated_by > 0 ? user($rs->updated_by) : '';
									  $username = @$rs->updated_by > 0 ? $user->titulation.' '.$user->firstname.' '.$user->lastname : '';
									  ?>
						              <input type="text" class="form-control" disabled="disabled" id="register_date" name="register_date"  value="<?php echo @$username.'  '.@$rs->updated;?>">
					              </div>
				            </div>
	            		</td>
	            	</tr>
	            </table>
	            <div class="form-group">
	            	 <?php if($perm->can_create=='y'){ ?>
	            	  <input type="hidden" name="id" value="<?php echo @$rs->id;?>">
		              <input type="submit" class="btn btn-primary" value="Save">
		             <?php } ?>		    
		              <a href="admin/settings/organizations/index" class="btn btn-default">Back</a>          
	            </div>          	            	           	           
            </div>            
			</form>						
		</div><!-- /.box -->
	</div>
  </div>
</section>

<!-- Load TinyMCE -->
<script type="text/javascript">
$(document).ready(function() {
	
	tiny("org_detail","");
	
	$("select[name=country_id]").change(function(){
		var country_id = $(this).val();
		$.post('admin/states/load_states',{
		'country_id' : country_id,
		},function(data){
			$(".span_state_id").html(data);												
		});	
	})
	
});
</script>
