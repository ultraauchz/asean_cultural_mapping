<div id="bg-topmenu">
	<div id="topmenu">
    	<ul id="ul_top_menu">
        	<li class="menu-home"><a href="front/home" class="active">home</a></li>              
        	<li class="menu-aboutus"><a href="front/aboutus/index">about us</a></li>
        	<li class="menu-product"><a href="front/product/category/0">product</a></li>
        	<li class="menu-howto"><a href="front/howto/index">how to</a></li>
        	<li class="menu-faq"><a href="front/faq/index">f.a.q</a></li>
        	<li class="menu-feedbacks"><a href="front/feedbacks/index">Customer 's FeedBack</a></li>
        	<li class="menu-contact"><a href="front/contact/index">contact</a></li>
        </ul>
   	  <div class="tel"><? echo ContactData('contact_tel');?><br><a href="mailto:<? echo ContactData('contact_email');?>" target="_blank" class="mail"><? echo ContactData('contact_email');?></a></div>
    </div>
</div>
<? $page_type = $this->uri->segment(2, 0);?>
<script>
function set_active_menu(){
		$("#ul_top_menu").find("a").each(function(){
				$(this).removeAttr("class");
				$("li.menu-<?=$page_type;?>>a").attr("class","active");
		});
}
set_active_menu();
</script>