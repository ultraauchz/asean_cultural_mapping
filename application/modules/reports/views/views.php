<h2><?php echo $value->title?></h2>
<small><?php echo mysql_to_th($value->created,"F",TRUE)?></small>
<hr />

<?php echo $value->detail?>
    
<hr />
    
<?php if($value->file_path):?>
<a href="reports/download/<?php echo $value->id?>" title="<?php echo $value->title?>" target="_blank" >
	<button type="button" class="btn btn-primary" > <span class="icon-download-alt"></span> ดาวน์โหลด</button>
</a>
<?php endif?>