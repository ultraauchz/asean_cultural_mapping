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
		              <?php echo form_dropdown('user_type_id',get_option('id','title','acm_user_type'),@$value->user_type_id,'class="form-control"','--select user type--');?>		              
	            </div>
	            <div class="form-group">
		              <label for="exampleInputEmail1">Username</label>
		              <input type="text" class="form-control" name="username" value="<?php echo @$value->username;?>">		              
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
		              <div class="col-xs-2">
		              	<input type="text" class="form-control" name="firstname" placeholder="Firstname" value="<?php echo @$value->firstname;?>"> 
		              </div>
		              <div class="col-xs-2">
		              	<input type="text" class="form-control" name="lastname" placeholder="Lastname" value="<?php echo @$value->lastname;?>">
		              </div>
		              <div class="clearfix"></div>
	            </div>
	            <div class="form-group">
		              <label for="exampleInputEmail1">Organization</label>
		              <?php echo form_dropdown('org_id',get_option('id','org_name','acm_organization'),@$value->org_id,'class="form-control required"','--select organization--');?>		              
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
	            <div class="form-group">
		              <label for="exampleInputEmail1">Status</label><br>
		              <input type="checkbox" name="status" value="1" <?php if(@$value->status=='1')echo 'checked="checked"';?>> Actived		              
	            </div>
	            <table>
	            	<tr>
	            		<td>
				            <div class="form-group">
					              <label for="exampleInputEmail1">Create By / Created Date</label>
					              <div class="input-group" style="width:350px;">
						              <span class="input-group-addon"><i class="fa fa-user"></i></span>
						              <input type="text" class="form-control" disabled="disabled" id="register_date" name="register_date"  value="<?php echo '  '.@$item['created_date'];?>">
					              </div>
				            </div>			
	            		</td>
	            		<td>
	            			<div class="form-group">
					              <label for="exampleInputEmail1">Update By / Updated Date</label>
					              <div class="input-group" style="width:350px;">
						              <span class="input-group-addon"><i class="fa fa-user"></i></span>
						              <input type="text" class="form-control" disabled="disabled" id="register_date" name="register_date"  value="<?php echo @$item['update_name'].'  '.@$item['updated_date'];?>">
					              </div>
				            </div>
	            		</td>
	            	</tr>
	            </table>
	            <div class="form-group">
	            	  <input type="hidden" name="id" value="<?php echo @$value->id;?>">
		              <input type="submit" class="btn btn-primary" value="Save">	
		              <a href="admin/settings/<?php echo $modules_name;?>/index" class="btn btn-default">Back</a>	              
	            </div>          	            	           	           
            </div>            
			</form>						
		</div><!-- /.box -->
	</div>
</div>
</section>