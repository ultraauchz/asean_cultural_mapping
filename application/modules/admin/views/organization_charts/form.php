<?php echo bread_crumb($menu_id);?>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
		<div class="box">
			<form method="post" enctype="multipart/form-data" action="admin/organization_charts/save">
			<div class="box-header">
			  <h3 class="box-title">Add/Edit</h3>			  
			</div><!-- /.box-header -->
			
			<div class="box-body">
				<div class="form-group">
		              <label>Country</label>
		              <div class="form-group">
		              <?php
					  	if( $perm->can_access_all == 'y' ){
					  		echo form_dropdown("country_id",get_option("id","country_name","acm_country"," ORDER BY country_name ASC"),@$rs->country_id,"class=\"form-control\" style=\"display:inline;\" ","-- Select Country --","");	
					  	}else{
					  		$ext_condition = $perm->can_access_all == 'y' ? '' : " WHERE id = ".$current_user->organization->country_id;
					  		echo form_dropdown("country_id",get_option("id","country_name","acm_country",$ext_condition." ORDER BY country_name ASC"),@$rs->country_id,"class=\"form-control\" style=\"display:inline;\" ");
					  	}			  	
					  ?>
	            </div>
	            <div class="form-group">
		              <label for="exampleInputEmail1">DETAIL</label>
		              <span class="span_detail_data">
		              	<textarea class="form-control"  name="detail" id="detail" ><?=@$rs->detail;?></textarea>
		              </span>
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
	
	tiny("detail","");
	
	$("select[name=country_id]").change(function(){
		var country_id = $(this).val();
		$.post('admin/organization_charts/load_detail',{
		'country_id' : country_id,
		},function(data){
			$(".span_detail_data").html(data);		
			tiny("detail","");										
		});	
	});
});
</script>
