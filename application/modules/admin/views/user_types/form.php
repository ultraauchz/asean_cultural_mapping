<?php echo bread_crumb($menu_id);?>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
		<div class="box">
			<form method="post" enctype="multipart/form-data" action="admin/settings/<?php echo $modules_name;?>/save">
			<div class="box-header">
			  <h3 class="box-title">Add/Edit</h3>			  
			</div><!-- /.box-header -->
			
			<div class="box-body">
				<div class="form-group">
		              <label for="exampleInputEmail1">User Type Name</label>
		              <input type="text" class="form-control" name="title" value="<?php echo @$value->title;?>">
	            </div>	         
	            <fieldset>
	            	<legend>Permission</legend>
	            	<table class="table table-bordered table-hover">
	            		<tr>
	            			<th style="width:300px;">Menu</th>
	            			<th>Action</th>
	            		</tr>
	            		<?php foreach($menus as $key=> $menu_item):?>
	            		<tr>
	            			<td><?php echo $menu_item->title;?></td>
	            			<td>
	            				<?php
	            					$perm = get_permission($menu_item->id, @$value->id, null);
	            					if($menu_item->have_view_access)
									{												
										$checked = $perm->can_view == 'y' ? 'checked="checked"' : "";							
										echo '<div class="checkbox" style="margin-right:25px;display:inline;">												
    												<label>
														<input type="checkbox" name="chk_'.$menu_item->id.'_view_access" value="y" '.$checked.'> Can View
													</label>
											  </div>';
									} 
	            				?>
	            				<?php
	            					if($menu_item->have_create_access)
									{
										$checked = $perm->can_create == 'y' ? 'checked="checked"' : "";		
										echo '<div class="checkbox" style="margin-right:25px;display:inline;">												
    												<label>
														<input type="checkbox" name="chk_'.$menu_item->id.'_create_access" value="y" '.$checked.'> Can Create/Edit
													</label>
											 </div>';
									} 
	            				?>
	            				<?php
	            					if($menu_item->have_delete_access)
									{
										$checked = $perm->can_delete == 'y' ? 'checked="checked"' : "";		
										echo '<div class="checkbox" style="margin-right:25px;display:inline;">												
    												<label>
														<input type="checkbox" name="chk_'.$menu_item->id.'_delete_access" value="y" '.$checked.'> Can Delete
													</label>
											 </div>';
									} 
	            				?>
	            				<?php
	            					if($menu_item->have_access_all)
									{
										$checked = $perm->can_access_all == 'y' ? 'checked="checked"' : "";
										echo '<div class="checkbox" style="margin-right:25px;display:inline;">												
    												<label>
														<input type="checkbox" name="chk_'.$menu_item->id.'_access_all" value="y" '.$checked.'> Can Access All
													</label>
											 </div>';
									} 
	            				?>
	            			</td>
	            		</tr>
	            		<?php endforeach;?>
	            	</table>
	            </fieldset>   
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
	            	  <?php
	            	  if($sperm->can_create=='y'){ ?>
	            	  <input type="hidden" name="id" value="<?php echo @$value->id;?>">
		              <input type="submit" class="btn btn-primary" value="Save">
		              <?php } ?>	
		              <a href="admin/settings/<?php echo $modules_name;?>/index" class="btn btn-default">Back</a>	              
	            </div>          	            	           	           
            </div>            
			</form>						
		</div><!-- /.box -->
	</div>
</div>
</section>