<?php echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n"?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url>
		<loc><?php echo base_url()?></loc>
		<priority>1.0</priority>
	</url>
	
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
	<url>
		<loc><?php echo @xml_convert(base_url($links))?></loc>
		<priority>0.5</priority>
	</url>
	<?php endforeach?>
	
</urlset>