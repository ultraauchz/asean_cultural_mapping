<?php echo bread_crumb($menu_id);?>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
		<div class="box">
			<form method="post" enctype="multipart/form-data" action="admin/hilights/save/<?=@$value->id?>">
			<div class="box-header">
			  <h3 class="box-title">Add/Edit</h3>			  
			</div><!-- /.box-header -->
			
			<div class="box-body">
				<div class="form-group">
		              <label for="exampleInputEmail1">TITLE</label>
		              <input type="text" class="form-control" name="title" value="<?php echo @$value->title;?>">
	            </div>
				<div class="form-group">
		              <label for="exampleInputEmail1">DETAIL</label>
		              <textarea class="form-control"  name="detail" id="detail" ><?php echo @$value->detail;?></textarea>
	            </div>	  
	            <div class="form-group">
		              <label for="exampleInputEmail1">URL</label>
		              <input type="text" class="form-control" name="links" value="<?php echo @$value->links;?>">
	            </div>
	            <div class="form-group">
		              <label for="exampleInputEmail1">TARGET</label>
		              <?php echo form_dropdown('target',array('_blank'=>'_blank','_self'=>'_self'),@$value->target,'class="form-control"') ?>
	            </div>
	            <div class="form-group">
		              <label for="exampleInputEmail1">HILIGHT IMAGE</label>
		              <div class="input-group">
						    <input type="text" id="image_path" class="form-control" name="image_path" placeholder="select hilight image" value="<?php echo $value->image_path?>" />
						    <span class="input-group-btn">
						    	<a href="js/tinymce/plugins/filemanager/dialog.php?type=1&field_id=image_path" class="btn btn-primary iframe-btn" >เลือกไฟล์</a>
							</span>
					  </div>
	            </div>	
	            <table>
	            	<tr>
	            		<td>
				            <div class="form-group">
					              <label for="exampleInputEmail1">Create By / Created Date</label>
					              <div class="input-group" style="width:350px;">
						              <span class="input-group-addon"><i class="fa fa-user"></i></span>
						              <input type="text" class="form-control" disabled="disabled" id="register_date" name="register_date"  value="<?php echo @$value->create_name.'  '.@$value->created;?>">
					              </div>
				            </div>			
	            		</td>
	            		<td>
	            			<div class="form-group">
					              <label for="exampleInputEmail1">Update By / Updated Date</label>
					              <div class="input-group" style="width:350px;">
						              <span class="input-group-addon"><i class="fa fa-user"></i></span>
						              <input type="text" class="form-control" disabled="disabled" id="register_date" name="register_date"  value="<?php echo @$value->update_name.'  '.@$value->updated;?>">
					              </div>
				            </div>
	            		</td>
	            	</tr>
	            </table>
	            <div class="form-group">
	            	  <input type="hidden" name="id" value="<?php echo @$value->id;?>">
		              <input type="submit" class="btn btn-primary" value="Save">		
		              <a href="admin/hilights/index" class="btn btn-default">Back</a>              
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
	
	tiny("detail","");
	
});
</script>  