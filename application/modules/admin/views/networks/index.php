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
			  	<span>Network name</span> 
			  	<input type="text" name="search" class="form-control" placeholder="Enter Network Name / ABBR" value="<?=@$_GET['search'];?>">
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
			      	<th style="width:100px;">Ordering</th>
			        <th>NO</th>			        
			        <th>Name</th>			        
			        <th>Code</th>
			        <th class="th_manage">Manage</th>
			      </tr>
			    </thead>
			    <tbody>
					<?php foreach ($result as $key => $item):
						$no++;
					?>
						<tr>
							<td>
								<?php if($perm->can_create=='y'){?>
								<a class="btn btn-default" href="admin/networks/ordering?search=<?php echo @$_GET['search'];?>&mode=up&id=<?=$item->id;?>&page=<?php echo $page;?>">
				                    <i class="fa fa-angle-up"></i> 
				                </a>
				                <a class="btn btn-default" href="admin/networks/ordering?search=<?php echo @$_GET['search'];?>&mode=down&id=<?=$item->id;?>&page=<?php echo $page;?>">
				                    <i class="fa fa-angle-down"></i> 
				                </a>
				                <?php } ?>
							</td>
							<td><?php echo $no;?></td>							
							<td><?php echo $item->title;?></td>
							<td><?php echo $item->code;?></td>
							<td>
								<?php if($perm->can_create == 'y'){?>
								<a href="admin/<?php echo $modules_name;?>/form/<?php echo $item->id?>" class="btn btn-primary" ><span class="glyphicon glyphicon-wrench" ></span> Edit</a>
								<?php }else{ ?>
								<a href="admin/<?php echo $modules_name;?>/form/<?php echo $item->id?>" class="btn btn-info" ><span class="glyphicon glyphicon-search" ></span> View</a>
								<?php } ?>
								<?php if($perm->can_delete =='y'){?>
								<a href="admin/<?php echo $modules_name;?>/delete/<?php echo $item->id?>" class="btn btn-danger btn_delete"><span class="glyphicon glyphicon-trash" ></span> Delete</a>
								<?php } ?>
							</td>
						</tr>
					<?php endforeach;?>	      
			    </tbody>
			    <tfoot>
			      <tr>
			      	<th>Ordering</th>
			      	<th>NO</th>
			        <th>Name</th>
			        <th>Code</th>				        
			        <th class="th_manage">Manage</th>
			      </tr>
			    </tfoot>
			  </table>
			  <?php if($perm->can_create=='y'){?>
			  <div style="text-align:right;">
			  	<a href="admin/<?php echo $modules_name;?>/form" class="btn btn-info"><li class="fa fa-plus"></li> Create new</a>
			  </div>
			  <?php } ?>
			  <?php echo $result->pagination()?>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div>
  </div>
</section>