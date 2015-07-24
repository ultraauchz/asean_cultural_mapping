<?
	function get_coverpage($id = null) {
		$book = new Ebook($id);
		$coverpage = (count($book->ebook_detail->all))?'uploads/ebook/'.$book->ebook_detail->tmp_name:'images/ebooks/book_nocoverpage.png';
		echo '<img src="'.$coverpage.'" style="height:100%; width:100%;" />';
	}
?>
<style type='text/css'>
	.shelf2 {
		background:url(images/ebooks/shelf.png) ;
		background-repeat:no-repeat ;
		background-size:100%;
		background-position:bottom;
		
		padding:0px 20px;
		padding-bottom:65px;
		
	}
	.wrap_books {
		display:inline-block;
		width:25%;
		text-align:center;
	}
	.books {
		width:120px; 
		height:160px; 
		display:inline-block;
		background:#eee;
	}
</style>


<div class="col-lg-12">
    <h3 class="page-header">
    	หนังสืออิเล็กทรอนิกส์
    </h3>
</div>
<div style='text-align:center;'>
	<? echo $rs->pagination(); ?>
</div>
<div>
<?
	$col = 0;
	foreach($rs as $item) {
		if($col == 0) {
			echo '<div class="shelf2">';
		}

			echo '<span class="wrap_books">';
				echo '<a href="ebooks/book/'.$item->id.'" target="_blank"/>';
					echo '<span class="books">';
							echo '<span style="background:#eee; display:inline-block; width:120px; height:160px; position:absolute; background:url(images/ebooks/book_shadow.png);"></span>';
							echo get_coverpage($item->id);
						
					echo '</span>';
				echo '</a>';
			echo '</span>';
		
		if($col == 3) {
			echo '</div>';
			$col = 0;
		} else {
			$col++;
		}
	}
	if($col != 0) {
		echo '</div>';
	}
?>
</div>
<div style='text-align:center;'>
	<? echo $rs->pagination(); ?>
</div>