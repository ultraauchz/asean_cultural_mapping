<div class="col-lg-12">
    <?php if($rs->title):?>
	<h1 class="page-header"><?php echo $rs->title?></h1>
    <?php else:?>
	<h1 class="page-header">จัดการหมวดหมู่ - หนังสืออิเล็กทรอนิกส์</h1>
    <?php endif?>
</div>

<form class="form-horizontal" role="form" action="admin/ebook_groups/save/<?php echo $rs->id?>" method="post" enctype="multipart/form-data">
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ชื่อหมวดหมู่</label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="title" placeholder="กรอกชื่อเรื่อง" value="<?php echo $rs->title?>" />
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" ></span> Submit</button>
			<a href="admin/ebook_groups/" class="btn btn-danger" > Cancel</a>
		</div>
	</div>
</form>
