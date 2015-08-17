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
		              <?php echo form_dropdown('country_id',get_option('id','country_name','acm_country','order by id asc'),@$rs->country_id,'class="form-control"','--- COUNTRY ---') ?>
	            </div> 
				<div class="form-group">
		              <label>STATE</label>
		              <?php echo form_dropdown('state_id',get_option('id','state_name','acm_state','order by id asc'),@$rs->state_id,'class="form-control"','--- STATE ---') ?>
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
		            <label for="exampleInputEmail1">UPLOAD MULTIPLE IMAGE</label>
		              
					<input type="file" id="files" name="files[]" multiple accept='image/*' />
					<output id="list"></output>
						
					<table id="tbimg" class="table table-striped table-bordered">
						<tr>
							<th width="110">image</th>
							<th>detail</th>
							<th>delete</th>
						</tr>
						<?foreach($rs->heritage_image->get() as $row):?>
						<tr>
							<td>
								<a rel="image_group" href="uploads/heritage_image/<?=$row->image?>" class="fancybox" title=""><img src="uploads/heritage_image/<?=$row->image?>" width="150"></a>
							</td>
							<td><input class="form-control" type="text" name="image_detail2[]" value="<?=$row->image_detail?>" style="display:inline;"></td>
							<td>
								<input type="hidden" name="image_id[]" value="<?=$row->id?>">
								<button class="btn btn-danger del_image" onclick="return confirm('ต้องการลบ <?php echo $row->image_detail?> หรือไม่')" ><span class="glyphicon glyphicon-trash" ></span></button>
							</td>
						</tr>
						<?endforeach;?>
					</table>
					
	            </div>	
	            </fieldset>
	            <?php if(@$rs->id > 0) : ?>
	            <fieldset>
	            	<legend>Responsibility of Organization</legend>
	            	<a href="admin/organizations/iframe_list?id=<?=@$rs->id;?>&area=admin&ctrl=heritages&action=save_heritage_organization" class="btn btn-success iframe-btn" >Add Member</a>
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
	            					<a href="admin/heritage/delete_heritage_org/<?=$heritage_org_item->id;?>" class="btn_delete btn btn-danger">X</a>
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
						              <input type="text" class="form-control" disabled="disabled" id="register_date" name="register_date"  value="<?=@$rs->create_name.'  '.@$rs->created;?>">
					              </div>
				            </div>			
	            		</td>
	            		<td>
	            			<div class="form-group">
					              <label for="exampleInputEmail1">Update By / Updated Date</label>
					              <div class="input-group" style="width:350px;">
						              <span class="input-group-addon"><i class="fa fa-user"></i></span>
						              <input type="text" class="form-control" disabled="disabled" id="register_date" name="register_date"  value="<?=@$rs->update_name.'  '.@$rs->updated;?>">
					              </div>
				            </div>
	            		</td>
	            	</tr>
	            </table>
	            <div class="form-group">
	            	  <input type="hidden" name="id" value="<?=@$rs->id;?>">
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
          $('#tbimg tr:first').after('<tr><td><img class="thumb" src="'+e.target.result+
                            '" title="'+escape(theFile.name)+'"/></td><td><input class="form-control" type="text" name="image_detail[]" style="display:inline;"></td><td></td></tr>');
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }
  }

  document.getElementById('files').addEventListener('change', handleFileSelect, false);
</script>