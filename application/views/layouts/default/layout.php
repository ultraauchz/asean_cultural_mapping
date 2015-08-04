<!DOCTYPE html>
<!-- default-index -->
<html lang="en">

<head>
    <base href="<?php echo base_url()?>" ></base>
    <meta charset="utf-8">
    <title><?php echo $template["title"]?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="css/template.css" type="text/css" rel="stylesheet"/>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/topmenu.css">
	<link href="css/style-map.css" type="text/css" rel="stylesheet"/>
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
	<!--[if IE]>
	<style type="text/css">
		#headerSection {
			display: none;
		}
		div.book a {
  			float: left;
		}
		.container {
			width: 1170px;
		}
	</style>
	<![endif]-->
	
    <!--[if IE 7]>
      <link rel="stylesheet" href="themes/font-awesome/css/font-awesome-ie7.css">
    <![endif]-->
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!-- Imbeded font from Google -->
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
</head>

<body>
<div id="wrap">
	<?php echo Modules::run("home/inc_header");?>
	<?php echo Modules::run("home/inc_menu");?>
	<div class="clearfix">&nbsp;</div>
	<div id="page">
     	<div id="wrap-page">
     		 <br>
        	 <?php echo $template["body"]?>  
        </div>
     </div>
	<?php echo Modules::run("home/inc_footer");?>
</div>	
</body>
</html>