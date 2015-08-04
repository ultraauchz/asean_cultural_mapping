<?php echo bread_crumb($menu_id);?>
<section class="content">
<div class="row">
    <div class="col-xs-12">
		<div class="box">
			<table class="table table-bordered table-hover table-responsive table-striped" >
				<thead>
					<tr>
						<th style="width: 80px;" >SHOW NO</th>
						<th style="width: 80px;" >STATUS</th>
						<th>TITLE</th>
						<th style="width: 160px;" >CREATED/UPDATED DATE</th>
						<th style="width: 180px;" >
							<a href="admin/<?php echo $modules_name;?>/form" class="btn btn-info"><li class="fa fa-plus"></li> Create new</a>
						</th>
					</tr>
				</thead>
				
				<tbody>
					<?php foreach ($variable as $key => $value):?>
					<tr>
						<td>
							<input type="text" class="form-control" name="orders[]" value="<?php echo $value->orders?>" style="text-align: center; width: 45px;" />
							<input type="hidden" name="id[]" value="<?php echo $value->id?>" />
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
						<td><small><?php echo mysql_to_th($value->created,"S",TRUE)."<br />".mysql_to_th($value->updated,"S",TRUE)?></small></td>
						<td>
							<a href="admin/hilights/form/<?php echo $value->id?>" class="btn btn-primary" ><span class="glyphicon glyphicon-wrench" ></span> Edit</a>
							<a href="admin/hilights/delete/<?php echo $value->id?>" class="btn btn-danger" onclick="return confirm('ต้องการลบ <?php echo $value->title?> หรือไม่')" ><span class="glyphicon glyphicon-trash" ></span> Delete</a>
						</td>
					</tr>
					<?php endforeach?>
				</tbody>
			</table>
			<!-- <div style="text-align:right;">
			  	<a href="admin/<?php echo $modules_name;?>/form" class="btn btn-info"><li class="fa fa-plus"></li> Create new</a>
			  </div> -->
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