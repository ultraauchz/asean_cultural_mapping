<h2>Sitemap</h2>

<ul>
	<li>เมนู
		<ul>
			<?php 
				foreach ($menus as $key => $menu):
					switch ($menu->route) {
						case 1:
							$links = $menu->links;
							break;
						case 2:
							$links = $menu->links;
							break;
						case 3:
							$links = "m/".$menu->slug;
							break;
						default:
							$links = "#";
							break;
					}
			?>
			<li>
				<a href="<?php echo $links?>" title="<?php echo $menu->title?>" ><?php echo $menu->title?></a>
					<?php if($roots->where("parent_id",$menu->id)->get(1)->result_count()):?>
					<ul>
						<?php foreach ($roots->where("parent_id",$menu->id)->get() as $num => $row):
			    			switch ($row->route) {
								case 1:
									$links = $row->links;
									break;
								case 2:
									$links = $row->links;
									break;
								case 3:
									$links = "m/".$row->slug;
									break;
								default:
									$links = "#";
									break;
							}
						?>
						<li><a href="<?php echo $links?>" title="<?php echo $row->title?>" ><?php echo $row->title?></a></li>
						<?php endforeach?>
					</ul>
					<?php endif?>
			</li>
			<?php endforeach?>
		</ul>
	</li>
	
	<li>
		ข่าว
		<ul>
			<?php foreach ($contents as $key => $content):?>
			<li><a href="contents?g=<?php echo $content->id?>" title="<?php echo $content->title?>" ><?php echo $content->title?></a></li>
			<?php endforeach?>
		</ul>
	</li>
	
</ul>