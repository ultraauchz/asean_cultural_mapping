<?php
if(isset($_POST['left_login_username'])){
	login($_POST['left_login_username'],$_POST['left_login_password']);
}
?>
	<div id="header">
    	<div id="logo">&nbsp;</div>
        <div id="welcom">Welcome to ThaiComplex.com 
        	<a href="front/cart/index"><span class="cart">Cart:</span>  
        		<span class="cart-item"><?php echo number_format(GetCartItemCount(),0);?> item(s) - $<?php echo number_format(GetCartPriceTotal());?></span>
        	</a>
        </div>
        <br>
        <div id="regis">        	
        	<?php if(!is_login()){?>
        	<a href="front/member/register_form" class="register">Register</a> | 
        	<a href="front/member/register_form" class="login">Login</a>
        	<?php }else{ ?>
        		Welcome <span style="color:orange;"><a href="front/member/profile" style="color:orange;"><?php echo login_data('name');?></a>   </span> <a href="front/member/logout">Log out</a> 
        	<?php } ?>
        </div>
    </div>
    <div class="clear">&nbsp;</div>
    <!--------------------------------------------------------END Header------------------------------------------------------->  