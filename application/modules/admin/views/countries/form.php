<?php echo bread_crumb($menu_id);?>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
		<div class="box">
			<form method="post" enctype="multipart/form-data" action="admin/<?php echo $modules_name;?>/save">
			<div class="box-header">
			  <h3 class="box-title">Add/Edit</h3>			  
			</div><!-- /.box-header -->
			
			<div class="box-body">
				<div class="form-group">
		              <label for="exampleInputEmail1">Country Name</label>
		              <input type="text" class="form-control" name="country_name" value="<?php echo @$value->country_name;?>">
	            </div>	            
	            <table>
	            	<tr>
	            		<td>
				            <div class="form-group">
					              <label for="exampleInputEmail1">Create By / Created Date</label>
					              <div class="input-group" style="width:350px;">
						              <span class="input-group-addon"><i class="fa fa-user"></i></span>
						              <input type="text" class="form-control" disabled="disabled" id="register_date" name="register_date"  value="<?php echo @$item['create_name'].'  '.@$item['created_date'];?>">
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
	            </div>          	            	           	           
            </div>            
			</form>						
		</div><!-- /.box -->
	</div>
  </div>
</section>