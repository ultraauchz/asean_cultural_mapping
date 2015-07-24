<?php
	$attr_book['size'] = array(
		'height'=>(empty($info['height']))?750:$info['height'], 
		'width'=>(empty($info['width']))?500:$info['width']
	);
	
	
	if($rs->all) {
		require_once 'js/turnjs4/genbook_lib.php';
		$ebook = new Genbook();
		
		$ebook->set_id($book->id);
		$ebook->set_path('js/turnjs4');
		#$ebook->set_size($attr_book['size']['width'], $attr_book['size']['height']);
		$ebook->set_size(100, 900);
		
		foreach($rs as $item) {
			$ebook->set_page('uploads/ebook/'.$item->tmp_name);
		}
	}
	
	
	$ebook->set_size($book->book_width, $book->book_height);;
		
?>
<style type='text/css'>
	.container {
		width:100%;
	}
	
	.ebook {
		display:inline-block;
	}
</style>
<script language='javascript'>
	$(function(){
		function check_book_detail(object) {
			var current_page =  object.turn("page"); //หน้าปัจจุบัน			
			limit_page = object.turn('pages'); //จำนวนหน้าทั้งหมด
			
			cond1 = current_page%2 == 0; // เงื่อนไข 1 : เมื่อหน้าปัจจุบันเป็นเลขคี่
			left_page = (cond1)?current_page:current_page-1;
			right_page = (cond1)?current_page+1:current_page;
		
			left_page = (left_page < 1)?null:left_page;
			right_page = (left_page > limit_page || right_page > limit_page)?null:right_page;
			
			if(left_page) {
				$('.print_page[direction=left]').attr('disabled', false);
			} else {
				$('.print_page[direction=left]').attr('disabled', 'disabled');
			}
			
			if(right_page) {
				$('.print_page[direction=right]').attr('disabled', false);
			} else {
				$('.print_page[direction=right]').attr('disabled', 'disabled');
			}
			
			//Output
			$(".text_currentPage").text(current_page); // กำหนดให้แสดงหน้าปัจจุบัน ที่ตำแหน่ง text_currentPage
			$('#position_page_left').val(left_page);
			$('#position_page_right').val(right_page);
		}
		
		ebook = $("#<?php echo $book->id; ?>");
		check_book_detail(ebook);
		
		$('#<? echo $book->id; ?>').on('turned', function(){ // ขณะเปลี่ยนหน้า
			check_book_detail($(this));
		});
		
		$('.change_page').on('click', function(){
			direction = $(this).attr('direction');
			ebook = $("#<?php echo $book->id; ?>");

			if(direction == 'next') {
				ebook.turn('next');
			} else if(direction == 'prev') {
				ebook.turn('previous');
				
			} else if(direction == 'go') {
				define_page = $('#define_page');
				if(define_page.val()=="") {
					define_page.focus();
					alert("กรุณากรอกเลขหน้า!!");
					return false;
				}
				ebook.turn("page", define_page.val());
			}
		});
		
		$('.view_page').on('click', function(){
			direction = $(this).attr('direction');
			ebook = $("#<?php echo $book->id; ?>");
			
			book_width = ($('#book_width').val()*2);
			book_height = $('#book_height').val();
			
			if(direction == 'zoomin') {
				book_width *= 2;
				book_height *= 2;
			}
			/*
			if(direction == 'zoomin') {
				if($('#scope_zoom').val() <= 3) {
					$('#scope_zoom').val((1*$('#scope_zoom').val())+0.5);
				}
			} else if(direction == 'zoomout') {
				if($('#scope_zoom').val() >0) {
					$('#scope_zoom').val((1*$('#scope_zoom').val())-0.5);
				}	
			}
			*/
			
						
			ebook.turn('size', book_width, book_height);
			
		});
		
		$('.print_page').on('click', function(){
			id = '<? echo $book->id; ?>';
			href = 'admin/ebooks/print_page/'+id+'/'+$('#position_page_'+$(this).attr('direction')).val();
			
			$(this).attr('href', href);
		});
	});
</script>

<h2> ตัวอย่าง หนังสือ : <?php echo $book->title; ?></h2>



<?php  if(count($rs->all) != 0) { ?>
	<input type='hidden' id="scope_zoom" value="0">
	<input type='hidden' id='book_width' value='<? echo $ebook->size['width']; ?>'>
	<input type='hidden' id='book_height' value='<? echo $ebook->size['height']; ?>'>
	<div style='display:inline-block; min-width:100%; text-align:center; background:#ccc; border-radius:4px;' id="wrap_book">
		<div style='padding:20px 0px; background:#aaa;' class='hide_print'>
			<button id='zoom-in2' direction='zoomin' class='view_page btn btn-default'><span class='glyphicon glyphicon-plus'></span></button>
			<button id='zoom-out2' direction='zoomout' class='view_page btn btn-default' style='margin-right:20px;'><span class='glyphicon glyphicon-minus'></span></button>  
			
			<button direction='prev' class='change_page btn btn-default'><span class='glyphicon glyphicon-chevron-left'></span></button>

			<span style='display:inline-block;'><?php echo form_input(false, false, 'class="form-control" id="define_page" style="dispaly:inline-block; width:75px;" placeholder="ระบุหน้า"'); ?></span>
			<button id='go2' direction='go' class="change_page btn btn-default"><span class='glyphicon glyphicon-search'></span> ไปที่หน้า</button> 
			
			<?php echo '<span class="text_currentPage">1</span> / '.count($rs->all); ?> Pages

			<button direction='next' class='change_page btn btn-default'><span class='glyphicon glyphicon-chevron-right'></span></button>
		</div>
 
		<div style='display:inline-block; padding:10px;'> 
			<div style='padding-bottom:10px; '>
				<div style='display:inline-block; width:<? echo $attr_book['size']['width']; ?>px; '>
					<? echo form_input(false, false, 'id="position_page_left" style="display:none;"'); ?>
					<a href='' target='_blank' direction='left' class='print_page btn btn-primary'><span class='glyphicon glyphicon-print'></span></a>
				</div>
					
				<div style='display:inline-block; width:<? echo $attr_book['size']['width']; ?>px;'>
					<? echo form_input(false, 1, 'id="position_page_right" style="display:none;"'); ?><br>
					<a href='' target='_blank' direction='right' class='print_page btn btn-primary'><span class='glyphicon glyphicon-print'></span></a>
				</div>
			</div>
			<div style='text-align:center;'>
				<?php $ebook->get(); ?>
			</div>
		</div> 
	</div>
<?php } else {
	echo '<div style="margin-top:50px; color:#aaa; text-align:center; width:100%;">ไม่พบหนังสือ</div>';
}?>