<h2><?php echo $value->title?></h2>
<small style="display: block;" ><?php echo mysql_to_th($value->created,"F",TRUE)?></small>
<small style="display: block;" >(อ่านแล้ว <?php echo $value->views?> ครั้ง)</small>
<hr />

<?php if($value->image_path):?>
<div style="text-align: center;" >
<img src="<?php echo $value->image_path?>" class="img-polaroid" style="margin: auto;" />
</div>
<div class="clearfix" >&nbsp;</div>
<?php endif?>

<?php echo $value->detail?>
    
<hr />
    
<?php if($value->file_path):?>
<a href="contents/download/<?php echo $value->id?>" title="<?php echo $value->title?>" target="_blank" >
	<button type="button" class="btn btn-primary" > <span class="icon-download-alt"></span> ดาวน์โหลด</button>
</a>
<?php endif?>

<br />
<p style="display: inline;margin-top: 20px;">
	<a href="#" id="show_comments"><?php echo (count($comment->all) != '')?count($comment->all):''; ?> Comments</a> | 
	<a href="#" id="add_comments" add_show="show">Add Comments</a> |
	<div class="fb-share-button" data-href="<?php echo base_url().'contents/view/'.$value->slug ?>" data-layout="button"></div>
</p>

<div id="add_comments_detail" style="display: none">
	<!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>
        <form id="form_comment" role="form" action="contents/save_comment/<?php echo $value->id?>" method="post" role="form">
        	<div class="form-group">
        		<label for="title" class="col-sm-2 control-label" >ชื่อ</label>
        		<div class="col-lg-4" >
                	<input type="text" name="name_comment" maxlength="250" class="form-control">
               	</div>
            </div>
            
            <div class="form-group">
            	<label for="title" class="col-sm-2 control-label" >E-mail</label>
        		<div class="col-lg-4" >
                	<input type="text" name="email" maxlength="250" class="form-control">
                </div>
            </div>
            
            <div class="form-group">
            	<label for="title" class="col-sm-2 control-label" >Comment</label>
        		<div class="col-lg-4" >
                	<textarea name="comment" rows="5" style="width: 600px" class="form-control"></textarea>
                </div>
            </div>
            
            <div class="form-group">
            	<label for="title" class="col-sm-2 control-label" >รหัสยืนยัน</label>
        		<div class="col-lg-4" >
        			<img src="contents/captcha" />
                	<input type="text" class="form-control" name="captcha" >
                </div>
            </div>
            <br />
            <button type="submit" id="save_comments" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <hr>
</div>

<div id="comments" style="display: none">
	<!-- Comment -->
	<?php foreach ($comment as $key => $comm) { ?>
			<div class="media">
			    <div class="media-body">
			        <h4 class="media-heading"><?php echo $comm->name_comment ?>
			            <small><?php echo ' '.mysql_to_th($comm->created, 'F', true); ?></small>
			        </h4>
			        <?php echo $comm->comment ?>
			    </div>
		    </div>
		    <hr>
	<?php } ?>
</div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/tinymce/config.js"></script>
<script type="text/javascript">
	$(function(){
		$('#show_comments').on('click', function(){
			$('#comments').show()
			return false;
		});
		
		$('#add_comments').on('click', function(){
			if ($(this).attr("add_show") == 'show') {
				$('#add_comments_detail').show()
				$(this).attr("add_show", "hide");
			} else {
				$('#add_comments_detail').hide()
				$(this).attr("add_show", "show");
			}
			
			return false;
		});
		
		
		$.validator.setDefaults({
			submitHandler:function(form){
				$('.btn-primary').attr('disabled', 'disabled');
				$('.btn-danger').attr('disabled', 'disabled');
				$.get(
					'<?php echo base_url()?>contents/chk_captcha',
					{'captcha':$('[name=captcha]').val()},
					function (data) {
						if (data == 'false') {
							alert('รหัสยืนยันไม่ถูกต้อง');
							$('[name=captcha]').focus();
							$('.btn-primary').removeAttr('disabled');
							$('.btn-danger').removeAttr('disabled');
							return false;
						} else {
							form.submit();
						}
					}
				);
		   	 }      
		});
		$( "#form_comment" ).validate({
			rules: {
				name_comment:{required:true},
				comment:{required:true},
				email:{required:true, email:true},
				captcha:{required:true, minlength: '6'},
			},
			messages:{
				name_comment:{required:'กรุณาระบุชื่อ'},
				comment:{required:'กรุณาระบุ Comment'},
				email:{required:'กรุณาระบุ E-mail', email:'กรุณาระบุ E-mail ให้ถูกต้อง'},
				captcha:{required:'กรุณาระบุรหัสยืนยัน', minlength:'กรุณาระบุอย่างน้อย 6 ตัว'},
			},
			errorPlacement: function(error, element) {
			    error.insertAfter(element);
			}
		});
	});
</script>