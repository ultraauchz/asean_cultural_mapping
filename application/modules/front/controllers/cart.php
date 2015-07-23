<?php
class cart extends Front_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('product_model','product');		
	}
	
	public function index()
	{
		//$this->db->debug = true;
		$data['cart'] = @$_SESSION['cart'];			
		$this->template->build('cart/index',$data);
	}
	public function aj_add_cart()
	{		
		if(count(@$_SESSION['cart'])>0)$cart = @$_SESSION['cart'];
		$product_id = $_POST['product_id'];
		$qty = @$_POST['product_qty']!='' ? $_POST['product_qty'] : 1;		
		$cart[$product_id]['id']=$product_id;
		$cart[$product_id]['qty']= $qty;
		$product_data = $this->product->get_row($product_id);
		if($qty > $product_data['qty']){
			echo $product_data['qty'];	
		}else{
		$_SESSION['cart'] = $cart;		
		$this->load->view('left_cart.php');
		}
	}
	public function empty_cart(){
		$_SESSION['cart'] = null;
		redirect('front/cart/index');
	}
	public function submit(){
		$this->update();
		if(@$_POST['mode']=='checkout'){
			redirect('front/checkout/index');	
		}else{
			redirect('front/cart/index');
		}
	}
	public function update()
	{
		$_SESSION['cart'] = null;
		if(isset($_POST['product_id'])){
			foreach($_POST['product_id'] as $key=>$item){
				if($_POST['product_id'][$key]){
						$product_id = $_POST['product_id'][$key];
						$qty = $_POST['cart_qty'][$key];
						$cart[$product_id]['id']=$product_id;
						$cart[$product_id]['qty']= $qty;						
				}
			}
			$_SESSION['cart'] = @$cart;	
		}											
	}
	public function checkout(){
		
			foreach($_POST['product_id'] as $key=>$item){
				if($_POST['product_id'][$key]){
					$cart[$_POST['product_id'][$key]]['id'] = $_POST['product_id'][$key];
					$cart[$_POST['product_id'][$key]]['qty'] = $_POST['qty'][$key];
				}
			}
			//$_SESSION['shipping_method'] = $_POST['shipping_method'];
			$_SESSION['cart'] = $cart;
		redirect('checkout');
	}
	public function LoadCartTable($cart=FALSE,$verify_code=FALSE,$return_value = FALSE){
		
		
		$data_list ='<table class="tbCart">';
		$data_list .='<tr><th>ลำดับ</th><th colspan="2">ชื่อสินค้า</th><th style="text-align:right;">ราคา/ชิ้น</th><th>จำนวน</th><th style="text-align:center;">ลบ</th><th style="text-align:right;">รวม(บาท)</th></tr>';
		$gtotal = 0;
		include "include/simpleimage.php";
		$item_index = 0;
		$shipping_price = 0;
		$free_shipping_flag = FALSE;
		if(count($cart)>0){
		foreach($cart as $item):
			if($item['id']>0 && $item['qty'] > 0 ){
			$item_index++;
			$product = GetProductDetail($item['id']);
			$price = $product['price'];
			$total = $price * $item['qty'];
			$gtotal = $gtotal + $total;
			$product_id = $item['id'].'|';
			$product_qty = $item['qty'].'|';	
			$product_image = GetProductImageName($product['product_image_1'],'200x200');
			
			if($free_shipping_flag == FALSE){
				
					if($product['shipping_price']<1)$free_shipping_flag = TRUE;
					if($shipping_price ==0)$shipping_price = $product['shipping_price'];					
					if($shipping_price > $product['shipping_price'])$shipping_price = $product['shipping_price'];			
				
			}
			if($product_image!=''){
				$fullpath = "product/".$product_image;
				if (file_exists($fullpath)) {
					$image = new SimpleImage();
				   	 $image->load($fullpath);								     
				     $img_width = $image->getWidth();
					 $img_height = $image->getHeight();					 
					 $image_tag_style = $img_width > $img_height ? 'width=80"' : 'height="80"';
				}
			}
	
		$data_list .='<tr>';
		$data_list .='<td>'.$item_index.'</td>';
		$data_list .='<td><img src="product/'.$product_image.'" '.$image_tag_style.'></td>';
		$data_list .='<td>'.$product['product_code'].'<br>'.$product['name_th'].'<input type="hidden" name="product_id[]" id="product_id" class="pid" value="'.$item['id'].'"></td>';		
		$data_list .='<td style="text-align:right; white-space: nowrap;">฿ '.number_format($price,2).'</td>';
		$data_list .='<td>';
		$data_list .='<input type="text" name="qty[] id="qty" class="qty" size="3" style="text-align:right" value="'.$item['qty'].'">';		
		$data_list.='</td>';
		$data_list .='<td style="text-align:center;"><img src="images/icon/delete.png" name="btnDelete" id="btnDelete" style="cursor:pointer;" class="vtip" title="ลบรายการนี้"></td>';
		$data_list .='<td style="text-align:right;" class="amt">฿ '.number_format($total,2).'</td>';
		$data_list .='</tr>';
			} 
		endforeach;	
		}
		else
		{
			$lbl_empty_cart ='ไม่มีรายการสินค้าในตะกร้า' ;
			$data_list.='<tr><td colspan="7" align="center" style="height:100px;">'.$lbl_empty_cart.'</td></tr>';	
		}
		
		if($free_shipping_flag==TRUE || $gtotal > 500){
				$shipping_price = 0;
		}
		$data_list.='<tr>';
		$data_list .='<td align="right" colspan="6"><b>รวมทั้งหมด</b></td>';		
		$data_list .='<td align="right" class="total" id="total">';
		$data_list .=number_format($gtotal,2);
		$data_list .='</td>';		
		$data_list .='</tr>';
		
		
		$data_list.='<tr>';
		$data_list .='<td align="right" colspan="6"><b>ค่าขนส่งไปรณีย์</b></td>';		
		$data_list .='<td align="right" class="shipping">'.$shipping_price.'</td>';		
		$data_list .='</tr>';
		$data_list.='<tr>';
		$data_list .='<td align="right" style="text-align:right; color:#C00; font-weight:700;" colspan="6"><span class="subtotal" style="text-align:right; color:#C00; font-weight:700;">ยอดรวมสุทธิ</span></td>';		
		$data_list .='<td align="right" style="text-align:right; color:#C00; font-weight:700;"  class="subtotal" id="subtotal">';
		$data_list .='<span class="subtotal" style="text-align:right; color:#C00; font-weight:700;">'.number_format(($gtotal+$shipping_price),2).'</span>';
		$data_list .='</td>';		
		$data_list .='</tr>';
		$data_list .='</table>';
		if($return_value==FALSE)
			echo $data_list;
		else
			return $data_list;
		
	}
	public function update_left_data_cart(){		
		if(@$_SESSION['cart']!='')
		{
			$i=0;
			foreach($_SESSION['cart'] as $item):		
				if($item['id']>0 && $item['qty'] > 0 ){
					$product = GetProductDetail($item['id']);
					$i++;
					echo "<span>".$i.") ".$product['name_th']." <b>[".$item['qty']."]</b></span>";	
				}
			endforeach;
		 }else{			
			echo "<span><b>ไม่มีรายการสินค้าในตะกร้า</b></span>";
		} 
	}
}
?>