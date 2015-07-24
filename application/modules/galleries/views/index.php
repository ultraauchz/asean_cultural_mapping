<div class="span8" >
	<form>
	<input type="text" class="span7" name="q" style="margin-bottom: 0;" />
	<button type="submit" class="btn btn-default" ><i class="icon-search"></i> ค้นหา</button>
	</form>
</div>

<div class="clearfix" >&nbsp;</div>

<hr />

<h2>คลังภาพ</h2>

<ul class="thumbnails" >
	<?php foreach ($variable as $key => $value):?>
	<li class="span2" >
		<div class="thumbnail" >
			<a href="galleries/view/<?php echo $value->slug?>" title="<?php echo $value->title?>" target="_blank" >
				<img src="<?php echo (chk_image_path($value->image_path)) ? $value->image_path : (($value->image->get(1)->image_path) ? $value->image->get(1)->image_path : "images/no-image.jpg")?>" alt="<?php echo $value->title?>" />
				<div class="caption" >
					<?php echo $value->title?>
				</div>
			</a>
		</div>
	</li>
	<?php endforeach?>
</ul>