<?php echo bread_crumb($menu_id);?>
<section class="content">
<div class="row">
    <div class="col-xs-12">
		<div class="box">
			<table id="example1" class="table table-bordered table-striped table-hover table_data">
				<thead>
					<tr>
						<th style="width:100px;">Ordering</th>
						<th style="width: 80px;" >STATUS</th>
						<th>TITLE</th>
						<th style="width: 180px;" >CREATED/UPDATED DATE</th>
						<th class="th_manage">Manage</th>
					</tr>
				</thead>
				
				<tbody>
					<?php foreach ($variable as $key => $value):?>
					<tr>
						<td>
								<a class="btn btn-default" href="admin/<?php echo $modules_name;?>/ordering?search=<?php echo @$_GET['search'];?>&mode=up&id=<?=$value->id;?>&page=<?php echo $page;?>">
				                    <i class="fa fa-angle-up"></i> 
				                </a>
				                <a class="btn btn-default" href="admin/<?php echo $modules_name;?>/ordering?search=<?php echo @$_GET['search'];?>&mode=down&id=<?=$value->id;?>&page=<?php echo $page;?>">
				                    <i class="fa fa-angle-down"></i> 
				                </a>
						</td>
						<td>
							<button type="button" id="<?php echo $value->id?>" class="btn <?php echo ($value->status==1) ? "btn-primary" : "btn-danger" ?>" data-loading-text="บันทึก..." value="<?php echo ($value->status==1) ? 1 : 0 ?>"  >
								<?php echo ($value->status==1) ? "On" : "Off" ?>
							</button>
						</td>
						<td>
							<strong><?php echo $value->title?></strong>
							<hr />
							<img src="<?php echo $value->image_path?>" class="img-responsive" style="max-height: 150px;" />
						</td>
						<td><small><?php echo $value->created."<br />".$value->updated;?></small></td>
						<td>
							<a href="admin/hilights/form/<?php echo $value->id?>" class="btn btn-primary" ><span class="glyphicon glyphicon-wrench" ></span> Edit</a>
							<a href="admin/hilights/delete/<?php echo $value->id?>" class="btn btn-danger" onclick="return confirm('ต้องการลบ <?php echo $value->title?> หรือไม่')" ><span class="glyphicon glyphicon-trash" ></span> Delete</a>
						</td>
					</tr>
					<?php endforeach?>
				</tbody>
				<thead>
					<tr>
						<th style="width:100px;">Ordering</th>
						<th style="width: 80px;" >STATUS</th>
						<th>TITLE</th>
						<th style="width: 160px;" >CREATED/UPDATED DATE</th>
						<th class="th_manage">Manage</th>
					</tr>
				</thead>
			</table>
			 <div style="text-align:right;">
			  	<a href="admin/<?php echo $modules_name;?>/form" class="btn btn-info"><li class="fa fa-plus"></li> Create new</a>
			 </div> 
			<?php echo $variable->pagination()?>
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
		    $.post("admin/approve/hilight/"+id,{status:status});
		    return false;
		    
		});
		
	});
</script>