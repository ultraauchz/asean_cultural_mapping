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
    <link id="callCss" rel="stylesheet" href="css/bootstrap.2.2.1.min.css" type="text/css" media="screen" charset="utf-8" />
    <link id="callCss" rel="stylesheet" href="css/<?php echo color()?>/style.css" type="text/css" media="screen" charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.2.2.1.min.css" >
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
    <script type="text/javascript" src="js/jquery-1.11.2.js" ></script>
    <script type="text/javascript" src="js/default/bootstrap.min.js" ></script>
    <script type="text/javascript" src="js/default/script.js"></script>
    
    <script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-60116662-1', 'auto');
	  ga('send', 'pageview');

		$('#myCarousel').carousel({
	  		interval: 500
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
    
    <style type="text/css" >
		<?php echo fonts()?>
		.carousel-control {
			top: 50%;
		}
		.btn_menu li {
			margin: 10px 10px 0 0;
		}
		.tile1 {
			height: 315px;
			margin: 0 20px 15px 10px;
		}
		.tile2 {
			height: 315px;
		}
		.listnews li {
			height: 50px;
		}

		.thumbnails>li {
			margin: 10px 0;
		}
		
		#portfolioSection {
			padding: 20px 0;
		}

		#portfolioSection .container .row .span3,#portfolioSection .container .row .span2 {
			height: 160px;
			text-align: center;
		}

		#portfolioSection .container .row .span3 a .blockDtl,#portfolioSection .container .row .span2 a .blockDtl {
			font-size: 17px;
			font-weight: bold;
		}

		.book {
			margin: 0 0 0 6%;
			background: url(images/default/km/shelf.png) no-repeat bottom;
		}

		.book a {
			padding: 10px 0 10px 0;
		}

		#portfolioSection .tab-pane .row .span3 {
			height: 80px;
		}
		
		ul.thumbnails li.span3,ul.thumbnails li.span2 {
			text-align: center;
			font-size: 17.5px;
			margin: 10px 0;
			font-family: inherit;
			font-weight: bold;
			line-height: 20px;
			color: inherit;
			text-rendering: optimizelegibility;
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

    <?php echo Modules::run("home/inc_hilight")?>
    
    <div class="clr"></div>

    <!-- Sectionone block ends======================================== -->

    <div id="welcomeSection">
        <div class="container run">
        	<marquee>
        		<?php echo Modules::run("home/inc_slidetext")?>
        	</marquee>
        </div>
    </div>
    <div class="clr"></div>
    
    <?php echo Modules::run("home/inc_layout")?>

    <!-- Contact Section -->
    <?php echo Modules::run("home/inc_contact")?>
    <!-- Wrapper end -->

    <?php echo Modules::run("home/inc_footer")?>
    
    <!-- Javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="js/default/jquery-1.9.1.min.js"></script>
    <script src="js/default/jquery.scrollTo-1.4.3.1-min.js" type="text/javascript"></script>
    <script src="js/default/jquery.easing-1.3.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    <script src="js/default/default.js"></script>
    <script type="text/javascript">
        $('#testimonial').carousel({
            interval: 10000
        })
        $('#myCarousel').carousel({
            interval: 7000
        })
		
		$.validator.setDefaults({
			submitHandler:function(form){
				$('#contact-submit').attr('disabled', 'disabled');
				$.get('contacts_us/chk_captcha',
						{'captcha':$('[name=captcha]').val()},	function (data) {
						if (data == 'false') {
							alert('รหัสยืนยันไม่ถูกต้อง');
							$('[name=captcha]').focus();
							$('#contact-submit').removeAttr('disabled');
							return false;
						} else {
							var foo = $("#form_comment").serialize();
							$.post("home/ecsss",foo ,function(data) {
								alert(data);
							});
							form.reset();
						}
					}
				);
		   	 }      
		});
		
		$("#form_comment").validate({
			rules: {
				name_contect:{required:true},
				detail:{required:true},
				title:{required:true},
				email:{required:true, email:true},
				captcha:{required:true, minlength: '6'},
			},
			messages:{
				name_contect:{required:'กรุณาระบุชื่อ'},
				detail:{required:'กรุณาระบุ Comment'},
				title:{required:'กรุณาระบุ หัวเรื่อง'},
				email:{required:'กรุณาระบุ E-mail', email:'กรุณาระบุ E-mail ให้ถูกต้อง'},
				captcha:{required:'กรุณาระบุรหัสยืนยัน', minlength:'กรุณาระบุอย่างน้อย 6 ตัว'},
			},
			errorPlacement: function(error, element) {
			    error.insertAfter(element);
			}
		});
    </script>
    <?php echo Modules::run("analytics/tracking_script")?>
</body>

</html>