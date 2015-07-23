<link href="media/css/template.css" type="text/css" rel="stylesheet"/>
<link href="media/css/leftmenu.css" type="text/css" rel="stylesheet"/>
<link href="media/plugin/pnotify/pnotify.custom.min.css" type="text/css" rel="stylesheet"/>

<link href="themes/admin/medias/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />.

 <!-- jQuery 2.1.3 -->
<script src="themes/admin/medias/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="themes/admin/medias/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="media/plugin/validator.js" type="text/javascript"></script>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<script src="media/plugin/pnotify/pnotify.custom.min.js"></script>
<script>
	$(document).ready(function(){
		//$(".datepicker").datepicker({ format: 'yyyy-mm-dd' });
		$('.btn_delete').click(function(){
			if(confirm('Delete this item?')){
				return true;
			}else{
				return false;
			}
		});
		
		$(".btn-cart1").click(function(){
			var product_id = $(this).closest('div').find('[name=hd_product_id]').val();
			var product_qty = 1;
			$.post('front/cart/aj_add_cart',{
					'product_id' : product_id,
					'product_qty' : product_qty
				},function(data){
				$('#yourcart').html(data);					
				new PNotify({
			    title: 'Add to cart complete!',
			    text: 'Your select product add to cart.',
			    icon: 'glyphicon glyphicon-shopping-cart'
				})						
			})		
				
		})
		
		$(".btn-cart2").click(function(){
			var product_id = $('[name=product_id]').val();
			var product_qty = $('[name=cartAdd]').val();			
			$.post('front/cart/aj_add_cart',{
					'product_id' : product_id,
					'product_qty' : product_qty
			},function(data){
				$('#yourcart').html(data);
				if(data < product_qty)			
				{
					new PNotify({
				    title: 'Can not add to cart!!!',
				    text: 'Products are not enough We have only '+data+' pieces”.',
				    icon: 'glyphicon glyphicon-exclamation-sign',
				    type:'error'
					})
				}else{
					new PNotify({
				    title: 'Add to cart complete!',
				    text: 'Your select product add to cart.',
				    icon: 'glyphicon glyphicon-shopping-cart'
					})		
				}		
			})			
		})
		
		$(".number").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
	     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
	        //display error message
	        $("#errmsg").html("Digits Only").show().fadeOut("slow");
	               return false;
	    }
	   });
	})
</script>