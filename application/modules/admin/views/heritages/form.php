<style>
  .thumb {
    width: 150px;
    border: 1px solid #000;
    margin: 10px 5px 0 0;
  }
</style>
					

<?php echo bread_crumb($menu_id);?>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
		<div class="box">
			<form method="post" enctype="multipart/form-data" action="admin/<?=@$modules_name?>/save/<?=@$rs->id?>">
			<div class="box-header">
			  <h3 class="box-title">Add/Edit</h3>			  
			</div><!-- /.box-header -->
			
			<div class="box-body">
				<div class="form-group">
		              <label for="exampleInputEmail1">TITLE</label>
		              <input type="text" class="form-control" name="title" value="<?=@$rs->title;?>">
	            </div>
	            <div class="form-group">
		              <label for="exampleInputEmail1">Location</label>
		              <input type="text" class="form-control" name="location" value="<?=@$rs->location;?>">
	            </div>
	            <div class="form-group">
		              <label>COUNTRY</label>
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
		              <label>STATE</label>
		              <span class="td_states">
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
		              <label for="exampleInputEmail1">DESCRIPTION</label>
		              <textarea class="form-control"  name="description"><?=@$rs->description;?></textarea>
	            </div>	
				<div class="form-group">
		              <label for="exampleInputEmail1">DETAIL</label>
		              <textarea class="form-control"  name="detail" id="detail" ><?=@$rs->detail;?></textarea>
	            </div>	  	            
	            <fieldset>
	            	<legend>Heritage Gallery</legend>
	            <div class="form-group">
	            	<?php if($can_save=='y'){ ?>
		            <label for="exampleInputEmail1">UPLOAD MULTIPLE IMAGE</label>
					<input type="file" id="files" name="files[]" multiple accept='image/*' />
					<?php } ?>
					<output id="list"></output>
						
					<table id="tbimg" class="table table-striped table-bordered">
						<tr>
							<th>Ordering</th>
							<th width="110">Image</th>
							<th>Detail</th>
							<th>Manage</th>
						</tr>
						<?foreach($rs->heritage_image->order_by('show_no','desc')->get() as $row):?>
						<tr>
							<td>
								<a class="btn btn-default" href="admin/heritages/ordering?heritage_id=<?=$rs->id?>&mode=up&id=<?=$row->id;?>">
				                    <i class="fa fa-angle-up"></i> 
				                </a>
				                <a class="btn btn-default" href="admin/heritages/ordering?heritage_id=<?=$rs->id?>&mode=down&id=<?=$row->id;?>">
				                    <i class="fa fa-angle-down"></i> 
				                </a>
							</td>
							<td>
								<a rel="image_group" href="uploads/heritage_image/<?=$row->image?>" class="fancybox" title="<?=@$row->image_detail?>"><img src="uploads/heritage_image/<?=$row->image?>" width="150"></a>
							</td>
							<td>
								<?php if($can_save=='y'){ ?>
								<input class="form-control" type="text" name="image_detail2[]" value="<?php echo $row->image_detail?>" style="display:inline;">	
								<? }else{ ?>
								<?php echo $row->image_detail?>
								<input class="form-control" type="hidden" name="image_detail2[]" value="<?php echo $row->image_detail?>" style="display:inline;">
								<? } ?>
							</td>
							<td>
								<?php if($can_save=='y'):?>
								<input type="hidden" name="image_id[]" value="<?=$row->id?>">
								<button class="btn btn-danger del_image" onclick="return confirm('ต้องการลบ <?php echo $row->image_detail?> หรือไม่')" ><span class="glyphicon glyphicon-trash" ></span></button>
								<?php endif;?>
							</td>
						</tr>
						<?endforeach;?>
					</table>
					
	            </div>	
	            </fieldset>
	            <?php if(@$rs->id > 0) : ?>
	            <fieldset>
	            	<legend>Responsibility of Organization</legend>
	            	<?php if($can_save=='y'):?>
	            	<a href="admin/settings/organizations/iframe_list?id=<?=@$rs->id;?>&area=admin&ctrl=heritages&action=save_heritage_organization" class="btn btn-success iframe-btn" >Add Member</a>
	            	<?php endif;?>
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
	            			foreach ($heritage_org as $key => $heritage_org_item):
								$no++; 
	            			?>
	            			<tr>
	            				<td><?php echo $no;?></td>
	            				<td><?php echo $heritage_org_item->organization->org_name;?></td>
	            				<td><?php echo $heritage_org_item->organization->country->country_name;?></td>
	            				<td>
	            					<?php if($can_save=='y'):?>
	            					<a href="admin/heritages/delete_heritage_org/<?=$heritage_org_item->id;?>" class="btn_delete btn btn-danger">X</a>
	            					<?php endif;?>
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
	            	  <?php if($can_save=='y'):?>
	            	  <input type="hidden" name="id" value="<?=@$rs->id;?>">
		              <input type="submit" class="btn btn-primary" value="Save">
		              <?php endif;?>	
		              <a href="admin/heritages/index" class="btn btn-default">Back</a>	              
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
	
	tiny("detail","");
	
});
</script>  

<script type="text/javascript">
$(document).ready(function() {
	$('.del_image').click(function(){
		console.log('click');
		var image_id = $(this).prev('input[type=hidden]').val();
		var tr = $(this).closest('tr');
		$.post('admin/heritages/image_delete/'+image_id,function(data){
			tr.fadeOut();
		});
		return false;
	});
	
	$("select[name=country_id]").change(function(){
		var country_id = $(this).val();
		$.post('admin/states/load_states',{
		'country_id' : country_id,
		},function(data){
			$(".td_states").html(data);												
		});	
	})
	
	
	$(".fancybox").fancybox();
});
</script>

<script type="text/javascript">
  // show preview of multiupload
  function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

      // Only process image files.
      if (!f.type.match('image.*')) {
        continue;
      }

      var reader = new FileReader();

      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
          // Render thumbnail.
          // var span = document.createElement('span');
          // span.innerHTML = ['<tr><td><img class="thumb" src="', e.target.result,
                            // '" title="', escape(theFile.name), '"/></td><td><input class="form-control" type="text" name="image_detail[]" style="width:50%;display:inline;"></td><td></td></tr>'].join('');
          // document.getElementById('list').insertBefore(span, null);
          $('#tbimg tr:first').after('<tr><td></td><td><img class="thumb" src="'+e.target.result+
                            '" title="'+escape(theFile.name)+'"/></td><td><input class="form-control" type="text" name="image_detail[]" style="display:inline;"></td><td></td></tr>');
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }
  }

  document.getElementById('files').addEventListener('change', handleFileSelect, false);
</script>