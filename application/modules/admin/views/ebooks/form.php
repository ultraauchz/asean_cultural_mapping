<div class="col-lg-12">
    <?php if($rs->title):?>
	<h1 class="page-header"><?php echo $rs->title?></h1>
    <?php else:?>
	<h1 class="page-header">หนังสืออิเล็กทรอนิกส์</h1>
    <?php endif?>
</div>


<form class="form-horizontal" role="form" action="admin/ebooks/save/<?php echo $rs->id?>" method="post" enctype="multipart/form-data">
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ชื่อหนังสือ</label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="title" placeholder="กรอกชื่อเรื่อง" value="<?php echo $rs->title?>" />
		</div>
	</div>
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >หมวดหมู่</label>
		<div class="col-lg-4" >
			<?php
				if(empty($group->id)) {
					echo form_dropdown('ebook_group_id', get_option('id', 'title', 'ebook_group'), @$rs->ebook_group_id, 'class="form-control" ', '--กรุณาเลือก--');
				} else {
					echo form_hidden('ebook_group_id', @$group->id);
					echo '<span style="line-height:35px;">'.$group->title.'</span>';
				}
					 
			?>
		</div>
	</div>
		
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ความกว้าง</label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="book_width" style="width:60px; display:inline-block;" maxlength='4' value="<?php echo $rs->book_width?>" /> px <span style='color:#aaa;'>
			(ค่าปริยายคือ <? echo @$info['width']; ?> px)</span>
		</div>
	</div>
	
	<div class="form-group" >
		<label for="title" class="col-sm-2 control-label" >ความสูง </label>
		<div class="col-lg-4" >
			<input type="text" class="form-control" name="book_height" style="width:60px; display:inline-block;" maxlength='4' value="<?php echo $rs->book_height?>" /> px <span style='color:#aaa;'>
			(ค่าปริยายคือ <? echo @$info['height']; ?> px)
		</span>
		</div>
	</div>
	
	<?php if($rs->id) { ?> 	
		<div class="form-group" >
			<label for="title" class="col-sm-2 control-label" >แนบไฟล์</label>
			<div class="col-lg-4" >
				<div class="input-group">
					<input type="file" id="file_upload" name="file_upload" multiple="true" />
				</div>
			<form>
			</div>
		</div>
	
		<div class="form-group" >
			<label for="title" class="col-sm-2 control-label" >ตัวอย่างไฟล์ภาพ</label>
			<div class="col-lg-10"  style='background:#eee; border-radius:4px; padding:20px;'>
				
				<div id='sector_review'>Loading..</div>
			</div>
		</div>
	<?php } ?>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" ></span> Submit</button>
			<a href="admin/ebooks/<?php echo (empty($group->id))?null:'?g='.$group->id; ?>" class="btn btn-danger" > Cancel</a>
		</div>
	</div>
	
</form>

<?php 

if($rs->id) { ?> 
	<script type="text/javascript">
		function load_review() {
			$.get(
				'<?php echo site_url(); ?>admin/ebooks/review/<?php echo $rs->id; ?>', 
				function(data){
					$('#sector_review').html(data);
				}
			);
		}
		
		$(function() {
			load_review();
			
			//Uploadify
			$("#file_upload").uploadify({
				'fileSizeLimit' : '<?php echo $info['size'];?>KB',
				"swf"			: 'js/uploadify/uploadify.swf',
				'fileTypeExts' : '*.gif; *.jpg; *.png; *.pdf',
				"uploader"	: '<?php echo site_url(); ?>admin/ebooks/upload/<?php echo $rs->id; ?>',
				"onQueueComplete" : function(data) {
	            	load_review();
	        	}	        	
			});
			
			//Delete files
			$('#sector_review').on('click', '.btn_delfile', function(){
				id = $(this).attr('rel');
				$.get('<?php echo site_url(); ?>admin/ebooks/file_delete/'+id, function(data){
					load_review();
				});
			});
			
		});
	</script>
<?php } ?>