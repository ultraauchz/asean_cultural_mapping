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
			  	<label for="search">Title</label> 
			  	<input type="text" name="search" class="form-control" placeholder="Enter Heritage Title" value="<?=@$_GET['search'];?>">
			  </div>
			  <div class="col-xs-3">
			  	<label for="coutry_id">Country</label> 
			  	<?php echo form_dropdown("country_id",get_option("id","country_name","acm_country"," ORDER BY country_name ASC"),@$_GET["country_id"],"class=\"form-control\" style=\"display:inline;\" ","-- Select Country --","")?>
			  </div>
			  <div class="col-xs-3">
			  	<br>
			  	<input type="submit" name="b" class="btn btn-primary" value="Search">
			  </div>
			</div>
			</form>
			
			<div class="box-body">
			<?php echo $variable->pagination()?>
			<table id="example1" class="table table-bordered table-striped table-hover table_data">
				<thead>
					<tr>
						<th style="width:70px;">NO</th>
						<th>TITLE</th>
						<th>COUNTRY</th>
						<th style="width: 160px;" >CREATED/UPDATED DATE</th>
						<th class="th_manage">Manage</th>						
					</tr>
				</thead>
				
				<tbody>
					<?php 
						foreach ($variable as $key => $value):
							$no++;
					?>
					<tr>
						<td><?php echo $no;?></td>						
						<td>
							<?php echo $value->title?>							
						</td>
						<td><?php echo $value->country->country_name?></td>
						<td><small><?php echo $value->created."<br />".$value->updated?></small></td>
						<td>
							<a href="admin/heritages/form/<?php echo $value->id?>" class="btn btn-primary" ><span class="glyphicon glyphicon-wrench" ></span> Edit</a>
							<a href="admin/heritages/delete/<?php echo $value->id?>" class="btn btn-danger" onclick="return confirm('ต้องการลบ <?php echo $value->title?> หรือไม่')" ><span class="glyphicon glyphicon-trash" ></span> Delete</a>
						</td>
					</tr>
					<?php endforeach?>
				</tbody>
				<tfoot>
					<tr>
						<th>NO</th>
						<th>TITLE</th>
						<th>COUNTRY</th>
						<th style="width: 160px;" >CREATED/UPDATED DATE</th>
						<th class="th_manage">Manage</th>						
					</tr>
				</tfoot>
			</table>
			<div style="text-align:right;">
			  	<a href="admin/<?php echo $modules_name;?>/form" class="btn btn-info"><li class="fa fa-plus"></li> Create new</a>
			</div>
			<?php echo $variable->pagination()?>
			</div>
		</div>
	</div>
</div>	
</section>