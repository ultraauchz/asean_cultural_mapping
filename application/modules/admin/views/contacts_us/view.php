<div class="col-lg-12">
    <h1 class="page-header">ติดต่อเรา</h1>
</div>

<form class="form-horizontal" role="form" method="post" >
	
	<div class="form-group">
		<label for="title" class="col-sm-2 control-label" >ชื่อ</label>
		<div class="col-lg-4" >
        	<?php echo $value->name_contect; ?>
       	</div>
    </div>
    
    <div class="form-group">
    	<label for="title" class="col-sm-2 control-label" >E-mail</label>
		<div class="col-lg-4" >
        	<?php echo $value->email; ?>
        </div>
    </div>
    
     <div class="form-group">
    	<label for="title" class="col-sm-2 control-label" >หัวเรื่อง</label>
		<div class="col-lg-4" >
        	<?php echo $value->title; ?>
        </div>
    </div>
    
    <div class="form-group">
    	<label for="title" class="col-sm-2 control-label" >Comment</label>
		<div class="col-lg-4" >
			<?php echo $value->detail; ?>
        </div>
    </div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<a href="admin/contacts_us" class="btn btn-danger" > Cancel</a>
		</div>
	</div>
	
</form>