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
		              <label>ADDRESS</label>
		              <textarea class="form-control" name="org_address"><?php echo @$rs->org_address;?></textarea>
	            </div>	
	            <div class="form-group">
		              <label>CODE</label>
		              <input type="text" class="form-control" name="org_code" value="<?php echo @$rs->org_code;?>">
	            </div>	 
				<div class="form-group">
		              <label>STATE</label>
		              <?php echo form_dropdown('state_id',get_option('id','state_name','acm_state','order by id asc'),@$rs->state_id,'class="form-control"','--- STATE ---') ?>
	            </div>	
	            <div class="form-group">
		              <label>COUNTRY</label>
		              <?php echo form_dropdown('country_id',get_option('id','country_name','acm_country','order by id asc'),@$rs->country_id,'class="form-control"','--- COUNTRY ---') ?>
	            </div>	
	            <div class="form-group">
		              <label>EMAIL</label>
		              <input type="text" class="form-control" name="org_email" value="<?php echo @$rs->org_email;?>">
	            </div>
	            <div class="form-group">
		              <label>LATITUDE</label>
		              <input type="text" class="form-control" name="org_latitude" value="<?php echo @$rs->org_latitude;?>">
	            </div>
	            <div class="form-group">
		              <label>LONGITUDE</label>
		              <input type="text" class="form-control" name="org_longitude" value="<?php echo @$rs->org_longitude;?>">
	            </div>
	            <div class="form-group">
		              <label>DESCRIPTION</label>
		              <textarea class="form-control" name="org_description"><?php echo @$rs->org_description;?></textarea>
	            </div>
	            <div class="form-group">
		              <label for="exampleInputEmail1">DETAIL</label>
		              <textarea class="form-control"  name="org_detail" id="detail" ><?=@$rs->org_detail;?></textarea>
	            </div>
	            <table>
	            	<tr>
	            		<td>
				            <div class="form-group">
					              <label for="exampleInputEmail1">Create By / Created Date</label>
					              <div class="input-group" style="width:350px;">
						              <span class="input-group-addon"><i class="fa fa-user"></i></span>
						              <input type="text" class="form-control" disabled="disabled" id="register_date" name="register_date"  value="<?php echo @$rs->create_name.'  '.@$rs->created;?>">
					              </div>
				            </div>			
	            		</td>
	            		<td>
	            			<div class="form-group">
					              <label for="exampleInputEmail1">Update By / Updated Date</label>
					              <div class="input-group" style="width:350px;">
						              <span class="input-group-addon"><i class="fa fa-user"></i></span>
						              <input type="text" class="form-control" disabled="disabled" id="register_date" name="register_date"  value="<?php echo @$rs->update_name.'  '.@$rs->updated;?>">
					              </div>
				            </div>
	            		</td>
	            	</tr>
	            </table>
	            <div class="form-group">
	            	  <input type="hidden" name="id" value="<?php echo @$rs->id;?>">
		              <input type="submit" class="btn btn-primary" value="Save">		              
	            </div>          	            	           	           
            </div>            
			</form>						
		</div><!-- /.box -->
	</div>
  </div>
</section>

<!-- Load TinyMCE -->
<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/tinymce/config.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	
	tiny("org_detail","");
	
});
</script>
