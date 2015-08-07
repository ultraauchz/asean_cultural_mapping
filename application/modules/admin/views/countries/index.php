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
			  	<span>Country name</span> 
			  	<input type="text" name="search" class="form-control" placeholder="Enter Country name" value="<?=@$_GET['search'];?>">
			  </div>
			  <div class="col-xs-3">
			  	<br>
			  	<input type="submit" name="b" class="btn btn-primary" value="Search">
			  </div>
			</div>
			</form>
			<div class="box-body">
			  <?php echo $result->pagination()?>
			  <table id="example1" class="table table-bordered table-striped table-hover table_data">
			    <thead>
			      <tr>
			        <th>NO</th>			        
			        <th>Name</th>			        
			        <th class="th_manage">Manage</th>
			      </tr>
			    </thead>
			    <tbody>
					<?php foreach ($result as $key => $item):
						$no++;
					?>
						<tr>
							<td><?php echo $no;?></td>							
							<td><?php echo $item->country_name;?></td>
							<td>
								<a class="btn btn-info" href="admin/<?php echo $modules_name;?>/form/<?=$item->id;?>">
				                    <i class="fa fa-edit"></i> Edit
				                </a>
								<a class="btn btn-danger btn_delete" href="admin/<?php echo $modules_name;?>/delete/<?php echo $item->id;?>">
				                    <i class="fa fa-trash-o"></i> delete
				                </a>
							</td>
						</tr>
					<?php endforeach;?>	      
			    </tbody>
			    <tfoot>
			      <tr>
			      	<th>NO</th>
			        <th>Name</th>
			        <th class="th_manage">Manage</th>
			      </tr>
			    </tfoot>
			  </table>
			  <div style="text-align:right;">
			  	<a href="admin/<?php echo $modules_name;?>/form" class="btn btn-info"><li class="fa fa-plus"></li> Create new</a>
			  </div>
			  <?php echo $result->pagination()?>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div>
  </div>
</section>