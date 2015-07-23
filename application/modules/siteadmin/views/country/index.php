<?php echo bread_crumb($menu_id);?>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
		<div class="box">
			<div class="box-body">
			  <?php echo $pagination;?>
			  <table id="example1" class="table table-bordered table-striped table-hover table_data">
			    <thead>
			      <tr>
			        <th>Country name</th>
			        <th class="th_manage">Manage</th>
			      </tr>
			    </thead>
			    <tbody>
					<?php foreach($rs as $item): ?>
						<tr>
							<td><?php echo $item['country_name'];?></td>
							<td>
								<a class="btn btn-info" href="siteadmin/<?=$module_name;?>/form/<?=$item['id'];?>">
				                    <i class="fa fa-edit"></i> Edit
				                </a>
								<a class="btn btn-danger btn_delete" href="siteadmin/<?=$module_name;?>/delete/<?=$item['id'];?>">
				                    <i class="fa fa-trash-o"></i> delete
				                </a>
							</td>
						</tr>
					<?php endforeach;?>	      
			    </tbody>
			    <tfoot>
			      <tr>
			        <th>Country name</th>
			        <th class="th_manage">Manage</th>
			      </tr>
			    </tfoot>
			  </table>
			  <div style="text-align:right;">
			  	<a href="siteadmin/<?=$module_name;?>/form" class="btn btn-info"><li class="fa fa-plus"></li> Create new</a>
			  </div>
			  <?php echo $pagination;?>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div>
  </div>
</section>