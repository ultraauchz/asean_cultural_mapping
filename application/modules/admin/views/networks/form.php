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
	            <fieldset>
	            	<legend>Members</legend>
	            	<a href="admin/organizations/iframe_list?id=<?=@$value->id;?>&area=admin&ctrl=networks&action=save_network_organization" class="btn btn-success iframe-btn" >Add Member</a>
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
	            			<?php foreach ($network_org as $key => $item): ?>
	            			<tr>
	            				<td>1</td>
	            				<td><?php echo $item->organization->name;?></td>
	            				<td><?php echo $item->country->country_name;?></td>
	            				<td>
	            					<input type="button" name="btn_delete" id="btn_delete" class="btn_delete btn btn-danger" value="X">
	            				</td>
	            			</tr>
	            			<?php endforeach;?>
	            		</tbody>
	            	</table>
	            </fieldset>  
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