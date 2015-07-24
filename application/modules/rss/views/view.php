<?php echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n"?>
<rss version="2.0"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
	xmlns:admin="http://webns.net/mvcb/" 
	xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" 
	xmlns:content="http://purl.org/rss/1.0/modules/content/" >
    <channel>
        <title><?php echo $feed_name; ?></title>
        <link><?php echo $feed_url; ?></link>
        <description><?php echo $page_description; ?></description>
        <dc:language><?php echo $page_language; ?></dc:language>
        <dc:creator><?php echo $creator_email; ?></dc:creator>
        <dc:rights>Copyright <?php echo gmdate( "Y", time()); ?></dc:rights>

        <?php foreach ($variable as $key => $value):?>
        <item>
            <title><?php echo @xml_convert($value->title)?></title>
            <link><?php echo base_url()."contents/view/".$value->id?></link>
            <pubDate><?php echo $value->created?></pubDate>
            <description><?php echo @xml_convert(strip_tags($value->detail))?></description>
            <filename><?php echo @$value->file_path?></filename>
            <viewcount><?php echo @number_format($value->views,0)?></viewcount>
            <downloadcount><?php echo @number_format($value->downloads,0)?></downloadcount>
        </item>
        <?php endforeach?>

    </channel>
</rss>