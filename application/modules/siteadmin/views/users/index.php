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
			  	<span>Fullname / Username</span> 
			  	<input type="text" name="search" class="form-control" placeholder="Enter Fullname / Username" value="<?=@$_GET['search'];?>">
			  </div>
			  <div class="col-xs-3">
			  	<br>
			  	<input type="submit" name="b" class="btn btn-primary" value="Search">
			  </div>
			</div>
			</form>
			<div class="box-body">
			  <?php echo $pagination;?>
			  <table id="example1" class="table table-bordered table-striped table-hover table_data">
			    <thead>
			      <tr>
			        <th>Fullname</th>
			        <th>Username</th>
			        <th>Register date</th>
			        <th class="th_manage">Manage</th>
			      </tr>
			    </thead>
			    <tbody>
					<?php foreach($rs as $item): ?>
						<tr>
							<td><?php echo $item['name'];?></td>
							<td><?php echo $item['username'];?></td>
							<td><?php echo $item['registerdate'];?></td>
							<td>
								<a class="btn btn-info" href="siteadmin/users/form/<?=$item['id'];?>">
				                    <i class="fa fa-edit"></i> Edit
				                </a>
								<a class="btn btn-danger btn_delete" href="siteadmin/users/delete/<?php echo $item['id'];?>">
				                    <i class="fa fa-trash-o"></i> delete
				                </a>
							</td>
						</tr>
					<?php endforeach;?>	      
			    </tbody>
			    <tfoot>
			      <tr>
			        <th>Fullname</th>
			        <th>Username</th>
			        <th>Register date</th>
			        <th>Manage</th>
			      </tr>
			    </tfoot>
			  </table>
			  <div style="text-align:right;">
			  	<a href="siteadmin/users/form" class="btn btn-info"><li class="fa fa-plus"></li> Create new</a>
			  </div>
			  <?php echo $pagination;?>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div>
  </div>
</section>