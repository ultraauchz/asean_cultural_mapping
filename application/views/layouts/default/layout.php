<!DOCTYPE html>
<!-- default-layout -->
<html lang="en">

<head>
    <base href="<?php echo base_url()?>" ></base>
    <meta charset="utf-8">
    <title><?php echo $template["title"]?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link id="callCss" rel="stylesheet" href="css/bootstrap.2.2.1.min.css" type="text/css" media="screen" charset="utf-8" />
    <link id="callCss" rel="stylesheet" href="css/<?php echo color()?>/style.css" type="text/css" media="screen" charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.2.2.1.min.css" >
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
    <script type="text/javascript" src="js/jquery-1.11.2.js" ></script>
    <script type="text/javascript" src="js/default/bootstrap.min.js" ></script>
    <script type="text/javascript" src="js/default/script.js"></script>
    
    <script type="text/javascript" >
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-60116662-1', 'auto');
	  ga('send', 'pageview');
    
        $('#testimonial').carousel({
            interval: 10000
        })
        
        $('#myCarousel').carousel({
            interval: 7000
        })
	
	</script>
    <script>
        (function() {
            var cx = '002914653592028267119:6tsss32zr9y';
            var gcse = document.createElement('script');
            gcse.type = 'text/javascript';
            gcse.async = true;
            gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
                '//cse.google.com/cse.js?cx=' + cx;
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(gcse, s);
        })();
    </script>
	
    <!--[if IE 7]>
      <link rel="stylesheet" href="themes/font-awesome/css/font-awesome-ie7.css">
    <![endif]-->
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!-- Imbeded font from Google -->
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
    
	<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox.css" media="screen" />
    <style type="text/css" >
		<?php echo fonts()?>
		
		.pagination {
		  display: inline-block;
		  padding-left: 0;
		  margin: 20px 0;
		  border-radius: 4px;
		}
		.pagination > li {
		  display: inline;
		}
		.pagination > li > a,
		.pagination > li > span {
		  position: relative;
		  float: left;
		  padding: 6px 12px;
		  margin-left: -1px;
		  line-height: 1.42857143;
		  color: #428bca;
		  text-decoration: none;
		  background-color: #fff;
		  border: 1px solid #ddd;
		}
		.pagination > li:first-child > a,
		.pagination > li:first-child > span {
		  margin-left: 0;
		  border-top-left-radius: 4px;
		  border-bottom-left-radius: 4px;
		}
		.pagination > li:last-child > a,
		.pagination > li:last-child > span {
		  border-top-right-radius: 4px;
		  border-bottom-right-radius: 4px;
		}
		.pagination > li > a:hover,
		.pagination > li > span:hover,
		.pagination > li > a:focus,
		.pagination > li > span:focus {
		  color: #2a6496;
		  background-color: #eee;
		  border-color: #ddd;
		}
		.pagination > .active > a,
		.pagination > .active > span,
		.pagination > .active > a:hover,
		.pagination > .active > span:hover,
		.pagination > .active > a:focus,
		.pagination > .active > span:focus {
		  z-index: 2;
		  color: #fff;
		  cursor: default;
		  background-color: #428bca;
		  border-color: #428bca;
		}
		.pagination > .disabled > span,
		.pagination > .disabled > span:hover,
		.pagination > .disabled > span:focus,
		.pagination > .disabled > a,
		.pagination > .disabled > a:hover,
		.pagination > .disabled > a:focus {
		  color: #777;
		  cursor: not-allowed;
		  background-color: #fff;
		  border-color: #ddd;
		}
		
		label.error{
    		color: red;
    	}

        div#___gcse_0 {
            margin: auto;
            width: 450px;
        }
        .gsc-control-cse.gsc-control-cse-th {
            background: none;
            border: none;
        }
        .cse input.gsc-search-button, input.gsc-search-button {
            border-color: #3079ed !important;
            background-color: #4d90fe !important;
        }
    </style>
    
    
</head>

<body data-spy="scroll" data-target=".navbar">
AAAAAAAAA
	<?php echo Modules::run("home/inc_header")?>

    <!--Header Ends================================================ -->
    <div class="clr"></div>

    <div id="headerbackground">

        <div class="container">

            <div class="logoroyal">
                <img src="images/<?php echo color()?>/logo.png">
                <img src="images/<?php echo color()?>/logo_agriculture.png" style="margin-left:50px;">
                <br>
                <br>

				<gcse:search></gcse:search>
            </div>

            <?php echo Modules::run("home/inc_menu")?>

        </div>
    </div>
    <!--menu Ends================================================ -->
    <div class="clr"></div>


    <!-- Contact Section -->
    <div id="blogSection" >
        <div class="container">


            <div class="row">
                <div class="span9">
                    <div class="thumbnail">
                        <div class="blogBlk">
                            <div class="inner">
                                <?php echo $template["body"]?>
                            </div>




                        </div>
                        <!--
        <div class="pagination pull-right">
              <ul>
                <li><a href="#">Prev</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">Next</a></li>
              </ul>
        </div>  
        -->
                    </div>
                </div>

                <!-- Sidebar comumn -->
                <?php echo Modules::run("home/inc_sidebar")?>
                
            </div>
        </div>
    </div>
    <!-- Contact Section -->

    <!-- Wrapper end -->
    <?php echo Modules::run("home/inc_footer")?>

    <!-- Javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- <script type="text/javascript" src="js/default/jquery-1.9.1.min.js" ></script> -->
    <script type="text/javascript" src="js/default/jquery.scrollTo-1.4.3.1-min.js" ></script>
    <script type="text/javascript" src="js/default/jquery.easing-1.3.min.js" ></script>
    <script type="text/javascript" src="js/default/default.js" ></script>
	<script type="text/javascript" src="js/fancybox/jquery.fancybox.pack.js" ></script>
	
	<!-- jquery_validate -->
	<script type="text/javascript" src="js/jquery.validate.min.js"></script>

	<link href='js/fullcalendar-1.6.2/fullcalendar/fullcalendar.css' rel='stylesheet' />
	<script src='js/fullcalendar-1.6.2/jquery/jquery-ui-1.10.2.custom.min.js'></script>
	<script src='js/fullcalendar-1.6.2/fullcalendar/fullcalendar.js'></script>

    <script type="text/javascript">
        
        $("a.img-fancybox").fancybox({
	    	openEffect	: 'elastic',
	    	closeEffect	: 'elastic',
	    	helpers : {
	    		title : {
	    			type : 'inside'
	    		}
	    	}
        });
    </script>
    <?php echo Modules::run("analytics/tracking_script")?>
</body>

</html>