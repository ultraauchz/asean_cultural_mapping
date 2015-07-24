<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <base href="<?php echo base_url()?>" ></base>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $template["title"]?></title>

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" >
	<link type="text/css" rel="stylesheet" href="js/fancybox/jquery.fancybox.css" media="screen" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    
    <!-- jquery_validate -->
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
     
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/function.js"></script>

	<script type="text/javascript" src="js/fancybox/jquery.fancybox.pack.js" ></script>
	<script type="text/javascript">
		$('.iframe-btn').fancybox({	
			'width'		: 800,
			'height'		: 600,
			'type'			: 'iframe',
	        'autoSize'  	: false
	    });
	</script>
	
	<?php echo $template['metadata']; ?>
	
	<style type="text/css">
		ul.pagination li span.current {
			z-index: 2;
			color: #fff;
			cursor: default;
			background-color: #337ab7;
			border-color: #337ab7;
		}
	</style>

</head>

<body>

    <?php echo modules::run("admin/inc_menu");?>

    <div class="container" >
        <?php echo $template["body"]?>  
    </div>
</body>

</html>