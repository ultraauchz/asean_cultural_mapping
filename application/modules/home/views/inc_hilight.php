<!-- <div id="wraphilight">
    	<div id="highlight">
            <ul>
              <li><a href="#"><img src="images/slide1.jpg" width="1399" height="387" /></a></li>
            </ul>
        </div>
      	<div id="arrowHilight">
        	<ul>
                <li class="arrowHilight-left"><a href="#">&nbsp;</a></li>
                <li class="arrowHilight-right"><a href="#">&nbsp;</a></li>
            </ul>
        </div>
        <div id="run">
            <ol>
                <li><a href="#">&nbsp;</a></li>
                <li><a href="#">&nbsp;</a></li>
                <li><a href="#" class="active">&nbsp;</a></li>
                <li><a href="#">&nbsp;</a></li>
           </ol>
        </div>
  </div> -->
  
<script>
$(document).ready(function(){
	$('.carousel').carousel({
	  interval: 5000
	})
});
</script>
	
<div id="wraphilight">
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
  	<?foreach($variable as $key=>$row):?>
  	<li data-target="#carousel-example-generic" data-slide-to="<?=$key?>" class="<?=$key==0?"active":"";?>"></li>
  	<?endforeach;?>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
  	<?foreach($variable as $key=>$row):?>
  	<div class="item <?=$key==0?"active":"";?>" align="center">
  	 <?if($row->links != ""):?>
  	 	<a href="<?=$row->links?>" target="<?=$row->target?>">
  	 <?else:?>
  	 	<?if($row->detail != ""):?>
  	 		<a href="hilights/detail/<?=$row->id?>">
  	 	<?endif;?>
  	 <?endif;?>
      <img src="<?=$row->image_path?>" alt="...">
      <div class="carousel-caption">
	    <h3><?=$row->title?></h3>
	    <p><?=$row->detail?></p>
	  </div>
	 <?=($row->links != "") || ($row->detail != "") ? "</a>" : "" ;?>
    </div>
  	<?endforeach;?>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>