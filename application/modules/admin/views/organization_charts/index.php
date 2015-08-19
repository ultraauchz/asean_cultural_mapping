<?php echo bread_crumb($menu_id);?>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
		<div class="box">			
			<div class="box-body">
			  <?php echo $result->pagination()?>
			  <table id="example1" class="table table-bordered table-striped table-hover table_data">
			    <thead>
			      <tr>
			        <th style="width:50px;">NO</th>		
			        <th>Country</th>
			        <th>URL</th>	        
			        <th class="th_manage">Manage</th>
			      </tr>
			    </thead>
			    <tbody>
					<?php foreach ($result as $key => $item):
						$no++;
					?>
						<tr>
							<td><?php echo $no;?></td>		
							<td><?php echo $item->country->country_name;?></td>		
							<td><a href="<?php echo base_url().'organizations/chart/'.$item->country_id;?>" target="_blank"><?php echo base_url().'organizations/chart/'.$item->country_id;?></a></td>			
							<td>
								<?php if($perm->can_create == 'y'){?>
								<a href="admin/<?php echo $modules_name;?>/form/<?php echo $item->id?>" class="btn btn-primary" ><span class="glyphicon glyphicon-wrench" ></span> Edit</a>
								<?php }else{ ?>
								<a href="admin/<?php echo $modules_name;?>/form/<?php echo $item->id?>" class="btn btn-info" ><span class="glyphicon glyphicon-search" ></span> View</a>
								<?php } ?>
							</td>
						</tr>
					<?php endforeach;?>	      
			    </tbody>
			    <tfoot>
			      <tr>
			      	<th>NO</th>
			      	<th>Country</th>
			      	<th>URL</th>
			        <th class="th_manage">Manage</th>
			      </tr>
			    </tfoot>
			  </table>
			  <!--
			  <?php if($perm->can_create=='y'){?>
			  <div style="text-align:right;">
			  	<a href="admin/<?php echo $modules_name;?>/form" class="btn btn-info"><li class="fa fa-plus"></li> Create new</a>
			  </div>
			  <?php } ?>
			  -->
			  <?php echo $result->pagination()?>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div>
  </div>
</section>