<?php
foreach ($variable as $key => $value) {
	echo Modules::run("home/inc_".$value->module);
	echo "<div class=\"clr\"></div>";
}