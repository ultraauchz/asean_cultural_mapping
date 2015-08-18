<?php echo bread_crumb($menu_id);?>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
		<div class="box">
			<form method="get" enctype="multipart/form-data">
			<div class="box-header">
			  <h3 class="box-title">Search</h3>			  
			</div><!-- /.box-header -->
			<div style="float:left;width:100%;">
				<div class="col-xs-3">
			  	<label for="country_id">Country</label> 			  	
			  	<?php
			  	if( $perm->can_access_all == 'y' ){
			  		echo form_dropdown("country_id",get_option("id","country_name","acm_country"," ORDER BY country_name ASC"),@$_GET["country_id"],"class=\"form-control\" style=\"display:inline;\" ","-- Select Country --","");	
			  	}else{
			  		$ext_condition = $perm->can_access_all == 'y' ? '' : " WHERE id = ".$current_user->organization->country_id;
			  		echo form_dropdown("country_id",get_option("id","country_name","acm_country",$ext_condition." ORDER BY country_name ASC"),@$_GET["country_id"],"class=\"form-control\" style=\"display:inline;\" ");
			  	}			  	
			  	?>
				</div>
				<div class="col-xs-3">
			  	<label for="organization_id">Organization</label> 
			  	<span class="span_org_data">
			  	<?php 
			  		$country_id = $perm->can_access_all != 'n' && @$_GET['country_id'] > 0 ? $current_user->organization->country_id : @$_GET['country_id'];
			  		$ext_condition = $country_id > 0 ? " WHERE country_id = ".$country_id : "";
			  		echo form_dropdown('org_id',get_option('id','org_name','acm_organization',$ext_condition." ORDER BY org_name ASC "),@$_GET['org_id'],'class="form-control"','-- all organization --');
			  	?>
			  	</span>
				</div>
			</div>
			<div style="float:left;width:100%;">
			  <div class="col-xs-3">
			  	<label for="search">Firstname/Lastname</label> 
			  	<input type="text" name="search" class="form-control" placeholder="Enter Firstname/Lastname" value="<?=@$_GET['search'];?>">
			  </div>
			  <div class="col-xs-1">
			  	<label for="search">Start Date</label> 
			  	<input type="text" name="start_date" class="form-control datepicker" value="<?=@$_GET['start_date'];?>">
			  </div>
			  <div class="col-xs-1">
			  	<label for="search">End Date</label> 
			  	<input type="text" name="end_date" class="form-control datepicker" value="<?=@$_GET['end_date'];?>">
			  </div>
			  <div class="col-xs-3">
			  	<br>
			  	<input type="submit" name="submit" class="btn btn-primary" value="Search">
			  </div>
			</div>
			</form>
			<div class="box-body">
			  <?php echo $result->pagination()?>
			  <table id="example1" class="table table-bordered table-striped table-hover table_data">
			    <thead>
			      <tr>
			        <th style="width:50px;">NO</th>		
			        <th>LOG DATE</th>
			        <th>USER</th>
			        <th>ORGANIZATION</th>
			        <th>COUNTRY</th>	        
			        <th>MENU</th>
			        <th>ACTION</th>
			        <th>DESCRIPTION</th>			        			        
			      </tr>
			    </thead>
			    <tbody>
					<?php foreach ($result as $key => $item):
						$no++;
					?>
						<tr>
							<td><?php echo $no;?></td>		
							<td><?php echo $item->log_date;?></td>					
							<td><?php echo $item->user->titulation.' '.$item->user->firstname.' '.$item->user->lastname;?></td>
							<td><?php echo $item->user->organization->org_name;?></td>
							<td><?php echo $item->user->organization->country->country_name;?></td>
							<td><?php echo $item->menu->title;?></td>
							<td><?php echo $item->action;?></td>
							<td><?php echo $item->description;?></td>							
						</tr>
					<?php endforeach;?>	      
			    </tbody>
			    <tfoot>
			      <tr>
			      	<th style="width:50px;">NO</th>		
			        <th>LOG DATE</th>
			        <th>USER</th>
			        <th>ORGANIZATION</th>
			        <th>COUNTRY</th>		        
			        <th>MENU</th>
			        <th>ACTION</th>
			        <th>DESCRIPTION</th>
			      </tr>
			    </tfoot>
			  </table>
			  <?php echo $result->pagination()?>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div>
  </div>
</section>
<script type="text/javascript">
$(document).ready(function() {
	
	
	$("select[name=country_id]").change(function(){
		var country_id = $(this).val();
		$.post('admin/settings/organizations/load_organizations',{
		'country_id' : country_id,
		},function(data){
			$(".span_org_data").html(data);												
		});	
	})
	
});
</script>