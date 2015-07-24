<style type='text/css'>
	.page {
		display:inline-block;
		height:230px;
		width:170px;
		border:solid 1px #aaa;
		margin:5px;
	}
		.page>img {
			width:100%;
			height:100%;
		}
	.page:hover {
		border:solid 1px #555;
	}
	
	.tabs_tools {
		text-align:right;
		padding:5px;
		position:absolute;
		width:170px;
	/*display:none;/**/
	}
</style>

<div style='padding:0px 5px; margin-bottom:10px;'>
	<? if($rs->all) { ?> 
		<a href='admin/ebooks/example/<? echo $id; ?>' target='_blank' class="btn btn-warning"><span class='glyphicon glyphicon-book'></span> Example</a>
	<? } else { ?>
		<a href='admin/ebooks/example/<? echo $id; ?>' target='_blank' class="btn btn-warning disabled"><span class='glyphicon glyphicon-book'></span> Example</a>
	<? } ?>
</div>
<div>
<?
	foreach($rs as $item) {
		echo '<div class="page">';
			echo '<div class="tabs_tools">';
				echo '<span class="btn btn-danger btn-sm btn_delfile" rel="'.$item->id.'" onclick="return (confirm(\'กรุณายืนยันการลบข้อมูล\'))?true:false;" style="padding:5px 6px 2px 6px;"><span class="glyphicon glyphicon-remove"></span></span>';
			echo '</div>';
			echo '<img src="uploads/ebook/'.$item->tmp_name.'"/>';
		echo '</div>';
	}
?>
</div>