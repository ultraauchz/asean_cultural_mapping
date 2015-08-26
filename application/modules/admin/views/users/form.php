<?php echo bread_crumb($menu_id);?>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
		<div class="box">
			<form method="post" enctype="multipart/form-data" action="admin/settings/<?php echo $modules_name;?>/save/<?php echo @$value->id;?>">
			<div class="box-header">
			  <h3 class="box-title">Add/Edit</h3>			  
			</div><!-- /.box-header -->
			
			<div class="box-body">
				<div class="form-group">
		              <label for="exampleInputEmail1">User Type</label>
		              <?php
		              if($modules_name=='profile'){
		              	echo form_dropdown('user_type_id',get_option('id','title','acm_user_type'),@$value->user_type_id,'class="form-control" disabled="disabled"','--select user type--');
		              }else{
		              	echo form_dropdown('user_type_id',get_option('id','title','acm_user_type'),@$value->user_type_id,'class="form-control"','--select user type--');
					  }
		              ?>		              
	            </div>
	            <div class="form-group">
		              <label for="exampleInputEmail1">Username</label>
		              <?php
		              if($modules_name=='profile'){
		              	echo $value->username;
		              }else{
		              	echo '<input type="text" class="form-control" name="username" value="'.@$value->username.'">';
					  }
		              ?>
		              		             
	            </div>	         	            
	            <div class="form-group">
		              <label for="exampleInputEmail1">Password</label>
		              <input type="password" class="form-control" name="password">		              
	            </div>
	            <div class="form-group">
		              <label for="exampleInputEmail1">Confirm Password</label>
		              <input type="password" class="form-control" name="confirm_password">		              
	            </div>
	            <div class="form-group">
		              <label for="exampleInputEmail1">Fullname</label><br>
		              <div class="col-xs-1" style="padding:0px;">
		              	<input type="text" class="form-control" name="titulation" placeholder="Titulation" value="<?php echo @$value->titulation;?>">
		              </div>
		              <div class="col-xs-3">
		              	<input type="text" class="form-control" name="firstname" placeholder="Firstname" value="<?php echo @$value->firstname;?>"> 
		              </div>
		              <div class="col-xs-3">
		              	<input type="text" class="form-control" name="lastname" placeholder="Lastname" value="<?php echo @$value->lastname;?>">
		              </div>
		              <div class="clearfix"></div>
	            </div>
	            <div class="form-group">
		              <label for="exampleInputEmail1">Organization</label>
		              <?php
		              if($modules_name=='profile'){
		              	echo $value->organization->org_name;
		              }else{
		              	$country_id = $perm->can_access_all != 'n' && @$_GET['country_id'] > 0 ? $current_user->organization->country_id : @$value->country_id;
					  	$ext_condition = $country_id > 0 ? " WHERE country_id = ".$country_id : ""; 
		              	echo form_dropdown('org_id',get_option('id','org_name','acm_organization', $ext_condition." ORDER BY org_name ASC "),@$value->org_id,'class="form-control required"','--select organization--');
					  }
		              ?>	
	            </div>
	            <div class="form-group">
		              <label for="exampleInputEmail1">Position</label>
		              <input type="text" class="form-control" name="position" value="<?php echo @$value->position;?>">		              
	            </div>
	            <div class="form-group">
		              <label for="exampleInputEmail1">Tel</label>
		              <input type="text" class="form-control" name="tel" value="<?php echo @$value->tel;?>">		              
	            </div>	            
	            <div class="form-group">
		              <label for="exampleInputEmail1">Email</label>
		              <input type="email" class="form-control" name="email" value="<?php echo @$value->email;?>">		              
	            </div>
	            <?php if($modules_name!='profile'){ ?>
	            <div class="form-group">
		              <label for="exampleInputEmail1">Status</label><br>
		              <input type="checkbox" name="status" value="1" <?php if(@$value->status=='1')echo 'checked="checked"';?>> Actived		              
	            </div>
	            <?php } ?>
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
	            	  <?php if($perm->can_create=='y' || $modules_name == 'profile'){ ?>
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