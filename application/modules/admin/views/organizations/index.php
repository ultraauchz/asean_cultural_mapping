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
			  	<label for="search">Organization name</label> 
			  	<input type="text" name="search" class="form-control" placeholder="Enter Organization name" value="<?=@$_GET['search'];?>">
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
			  <?php echo $rs->pagination()?>
			  <table id="example1" class="table table-bordered table-striped table-hover table_data">
				<thead>
					<tr>
						<th style="width:50px;">
							NO
						</th>
						<th style="width: 80px;" >STATUS</th>
						<th>NAME</th>
						<th style="width: 160px;" >CREATED/UPDATED DATE</th>
						<th class="th_manage">Manage</th>
					</tr>
				</thead>
				
				<tbody>
					<?php foreach ($rs as $key => $row):
						$no++;
					?>
					<tr>
						<td><?php echo $no;?></td>
						<td>
							<button type="button" id="<?php echo $row->id?>" class="btn <?php echo ($row->status==1) ? "btn-primary" : "btn-danger" ?>" data-loading-text="บันทึก..." value="<?php echo ($row->status==1) ? 1 : 0 ?>"  >
								<?php echo ($row->status==1) ? "On" : "Off" ?>
							</button>
						</td>
						<td>
							<strong><?php echo $row->org_name?></strong>
						</td>
						<td><small><?php echo $row->created."<br />".$row->updated;?></small></td>
						<td>
							<a href="admin/settings/<?php echo $modules_name;?>/form/<?php echo $row->id?>" class="btn btn-primary" ><span class="glyphicon glyphicon-wrench" ></span> Edit</a>
							<a href="admin/settings/<?php echo $modules_name;?>/delete/<?php echo $row->id?>" class="btn btn-danger" onclick="return confirm('ต้องการลบ <?php echo $row->title?> หรือไม่')" ><span class="glyphicon glyphicon-trash" ></span> Delete</a>
						</td>
					</tr>
					<?php endforeach?>
				</tbody>
				 <tfoot>
			      <tr>
					<th>
						NO
					</th>
					<th style="width: 80px;" >STATUS</th>
					<th>NAME</th>
					<th style="width: 160px;" >CREATED/UPDATED DATE</th>
					<th style="width: 180px;" >
					</th>
				</tr>
			    </tfoot>
			</table>
			<div style="text-align:right;">
			  	<a href="admin/settings/<?php echo $modules_name;?>/form" class="btn btn-info"><li class="fa fa-plus"></li> Create new</a>
			</div>			
			<?php echo $rs->pagination()?>
			</div>
		</div>
	</div>
</div>	
</section>

<script type="text/javascript">
	$(document).ready(function(){
		
		$('button[data-loading-text]').click(function () {
		    var btn = $(this);
		    if(btn.val()==1) {
				btn.val(0);
		    	btn.removeClass("btn-primary");
		    	btn.addClass("btn-danger");
		    	var status = 0;
		    	var textstatus = "Off";
		    } else {
				btn.val(1);
		    	btn.removeClass("btn-danger");
		    	btn.addClass("btn-primary");
		    	var status = 1;
		    	var textstatus = "On";
		    }
		    btn.button('loading');
		    
		    setTimeout(function(){
				btn.button('reset');
				btn.html(textstatus);
		    },1000);
		    
		    var id = btn.attr("id");
		    $.post("admin/approve/organization/"+id,{status:status});
		    return false;
		    
		});
		
	});
</script>
