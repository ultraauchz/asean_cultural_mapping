<h4><a href="contents?g=<?php echo $group->id?>" title="<?php echo $group->title?>" ><?php echo $group->title?></a></h4>

<div class="col-md-8 auction" >
	<div>
		<ul>
			<?php foreach ($variable as $key => $value):?>
				<?php if((@strlen(strip_tags($value->detail))<20) && $value->file_path):?>
				<li>
					<a href="contents/view/<?php echo $value->id?>" title="<?php echo $value->title?>" target="_blank" ><?php echo $value->title?></a>
					<div class="date_news"> - <?php echo mysql_to_th($value->created,"S",FALSE)?></div>
					<div class="counter_news" >(อ่านแล้ว <?php echo $value->views?> ครั้ง)</div>
				</li>
				<?php else:?>
				<li>
					<a href="contents/view/<?php echo $value->id?>" title="<?php echo $value->title?>" target="_blank" ><?php echo $value->title?></a>
					<div class="date_news"> - <?php echo mysql_to_th($value->created,"S",FALSE)?></div>
					<div class="counter_news" >(อ่านแล้ว <?php echo $value->views?> ครั้ง)</div>
				</li>
				<?php endif?>
				<hr class="ryo" >
			<?php endforeach?>
		</ul>
	</div>
</div>

<?php echo $variable->pagination()?>

<style type="text/css" >
	.date_news {
		display: inline;
		margin-left: 5px;
	}
	.counter_news {
		display: inline;
	}
</style>