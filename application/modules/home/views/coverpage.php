<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <base href="<?php echo base_url()?>" ></base>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo ($value->title) ? $value->title : "กรมฝนหลวงและการบินเกษตร"?></title>

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" >
	
</head>

<body>

    <div class="container" >
        <?php echo $value->detail?>

        <div style="text-align: center;" >
			<a href="<?php echo base_url("index")?>" title="เข้าสู่เว็บไซต์"  >เข้าสู่เว็บไซต์</a>
		</div>
    </div>
</body>

</html>
