<?php echo bread_crumb($menu_id);?>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
		<div class="box">
			<form method="post" enctype="multipart/form-data" action="admin/networks/save">
			<div class="box-header">
			  <h3 class="box-title">Add/Edit</h3>			  
			</div><!-- /.box-header -->
			
			<div class="box-body">
				<div class="form-group">
		              <label for="exampleInputEmail1">Title</label>
		              <input type="text" class="form-control" name="title" value="<?php echo @$value->title;?>">
	            </div>
	            <div class="form-group">
		              <label for="exampleInputEmail1">Code</label>
		              <input type="text" class="form-control" name="code" value="<?php echo @$value->code;?>">
	            </div>
				<div class="form-group">
		              <label for="exampleInputEmail1">Description</label>
		              <textarea class="form-control"  name="description" id="description" ><?php echo @$value->description;?></textarea>
	            </div>
				<div class="form-group">
		              <label for="exampleInputEmail1">Detail</label>
		              <textarea class="form-control"  name="detail" id="detail" ><?php echo @$value->detail;?></textarea>
	            </div>	
	            <?php if(@$value->id > 0) : ?>
	            <fieldset>
	            	<legend>Members</legend>
	            	<?php if($perm->can_create=='y'){?>
	            	<a href="admin/settings/organizations/iframe_list?id=<?=@$value->id;?>&area=admin&ctrl=networks&action=save_network_organization" class="btn btn-success iframe-btn" >Add Member</a>
	            	<?php } ?>
	            	<table class="table table-bordered">
	            		<thead>
	            			<tr>
	            				<th>No.</th>
	            				<th>Organization Name</th>
	            				<th>Country</th>
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
	            				<td><?php echo $network_org_item->organization->org_name;?></td>
	            				<td><?php echo $network_org_item->organization->country->country_name;?></td>
	            				<td>
	            					<?php if($perm->can_create=='y'){?>
	            					<a href="admin/networks/delete_network_org/<?=$network_org_item->id;?>" class="btn_delete btn btn-danger">X</a>
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
						              $user = @$value->created_by > 0 ? user($value->created_by) : '';
									  $username = $value->created_by > 0 ? $user->titulation.' '.$user->firstname.' '.$user->lastname : '';
									  ?>
						              <input type="text" class="form-control" disabled="disabled" id="register_date" name="register_date"  value="<?php echo @$username.'  '.@$value->created;?>">
					              </div>
				            </div>			
	            		</td>
	            		<td>
	            			<div class="form-group">
					              <label for="exampleInputEmail1">Update By / Updated Date</label>
					              <div class="input-group" style="width:350px;">
						              <span class="input-group-addon"><i class="fa fa-user"></i></span>
						              <?php 
						              $user = @$value->updated_by > 0 ? user($value->updated_by) : '';
									  $username = @$value->updated_by > 0 ? $user->titulation.' '.$user->firstname.' '.$user->lastname : '';
									  ?>
						              <input type="text" class="form-control" disabled="disabled" id="register_date" name="register_date"  value="<?php echo @$username.'  '.@$value->updated;?>">
					              </div>
				            </div>
	            		</td>
	            	</tr>
	            </table>
	            <div class="form-group">
	            	  <?php if($perm->can_create=='y'){?>
	            	  <input type="hidden" name="id" value="<?php echo @$value->id;?>">
		              <input type="submit" class="btn btn-primary" value="Save">
		              <?php } ?>	
		              <a href="admin/<?php echo $modules_name;?>/index" class="btn btn-default">Back</a>	              
	            </div>          	            	           	           
            </div>            
			</form>						
		</div><!-- /.box -->
	</div>
  </div>
</section>
<script type="text/javascript">
	$(document).ready(function() {
		
		tiny("detail","");
		
	});
</script>  