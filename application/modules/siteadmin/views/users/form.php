<script language="JavaScript" type="text/javascript">
$(document).ready(function(){
	$('[name=chk_bill]').click(function(){
		 if($(this).is(':checked'))
		 {
		 	document.getElementById('ship_name').value =  document.getElementById('name').value;
				document.getElementById('ship_address').value =  document.getElementById('bill_address').value;
				document.getElementById('ship_city').value =  document.getElementById('bill_city').value;
				document.getElementById('ship_state').value =  document.getElementById('bill_state').value;
				document.getElementById('ship_zipcode').value =  document.getElementById('bill_zipcode').value;
				$('[name=ship_country]').val($('[name=bill_country]').val());
				document.getElementById('ship_tel').value =  document.getElementById('bill_tel').value;			
		 }
	})
})
/*
		if(document.getElementById('chk_bill').checked ==true)		
		{
				document.getElementById('ship_fname').value =  document.getElementById('bill_fname').value;
				document.getElementById('ship_lname').value =  document.getElementById('bill_lname').value;
				document.getElementById('ship_addr1').value =  document.getElementById('bill_addr1').value;
				document.getElementById('ship_addr2').value =  document.getElementById('bill_addr2').value;
				document.getElementById('ship_city').value =  document.getElementById('bill_city').value;
				document.getElementById('ship_state').value =  document.getElementById('bill_state').value;
				document.getElementById('ship_zipcode').value =  document.getElementById('bill_zipcode').value;
				document.getElementById('ship_country').value =  document.getElementById('bill_country').value;
				document.getElementById('ship_tel').value =  document.getElementById('bill_tel').value;																																
		}*/
</script>
<?php echo bread_crumb($menu_id);?>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
		<div class="box">
			<form method="post" action="siteadmin/users/save" enctype="multipart/form-data">
			<div class="box-header">
			  <h3 class="box-title">Add/Edit Admin User</h3>			  
			</div><!-- /.box-header -->
			
			<div class="box-body">
				<table class="table table-bordered table-strip table-register table-hover">
                  <tbody>
                  <tr>
                    <th height="31" colspan="2" valign="middle">
                    	Username & Password
                    </th>
                  </tr>                  
                  <tr>
                      <td valign="middle" >
                      	Username:
                      	<span class="Txt_red_8">*</span> 
                      </td>
                      <td valign="middle" style="width:550px;">
                      	<div class="form-group">
                      	<input name="username" type="text" class="form-control" id="username" required="required" maxlength="50" value="<?php echo $rs['username'];?>">
                      	</div>
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	Password:
                      	<span class="Txt_red_8">*</span> 
                      </td>
                      <td valign="middle">
                      	<input name="password" type="password" class="form-control" id="password" data-minlength="6" maxlength="15">                      	 
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	Verify Password:
                      	<span class="Txt_red_8">*</span> 
                      </td>
                      <td valign="middle">
                      	<input name="vpassword" type="password" class="form-control" id="vpassword" data-minlength="6" maxlength="15" data-match="#password" data-match-error="Whoops, these don't match">
                      	<div class="help-block with-errors"></div>
                      </td>
                  </tr>
                  <tr>
                    <th height="31" colspan="2" valign="middle">
                    	Billing Information
                    </th>
                  </tr>  
                  <tr>
                      <td valign="middle">
                      	Full Name: 
                      	<span class="Txt_red_8">*</span>
                      </td>
                      <td valign="middle">
                      	<input name="name" type="text" class="form-control" id="name" maxlength="100" required="required" value="<?php echo  $rs['name'];?>">
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	Address:
                      	<span class="Txt_red_8">*</span> 
                      </td>
                      <td valign="middle">                      	
                      	<textarea name="bill_address" id="bill_address" class="form-control" required="required"><?php echo  $rs['bill_address'];?></textarea>
                      </td>
                  </tr>                  
                  <tr>
                      <td valign="middle">
                      	City or APO/FPO:
                      	<span class="Txt_red_8">*</span>  
                      </td>
                      <td valign="middle">
                      	<input name="bill_city" type="text" class="form-control" id="bill_city" maxlength="100" required="required" value="<?php echo  $rs['bill_city'];?>">
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	State/Province:
                      	<span class="Txt_red_8">*</span>
                      </td>
                      <td valign="middle">
                      	<input name="bill_state" type="text" class="form-control" id="bill_state" maxlength="100" required="required" value="<?php echo $rs['bill_state'];?>">                      
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	Zip/Postal Code:
                      	<span class="Txt_red_8">*</span> 
                      </td>
                      <td valign="middle">
                      	<input name="bill_zipcode" type="text" class="form-control" id="bill_zipcode" maxlength="30" required="required" value="<?php echo $rs['bill_zipcode'];?>">            
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	Country:
                      	<span class="Txt_red_8">*</span>
                      </td>
                      <td valign="middle">
						<?php echo form_dropdown('bill_country',get_option('id','country_name','countries order by country_name'),$rs['bill_country'],'class="form-control" required="required"','--select country--');?>
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	Telephone:
                      	<span class="Txt_red_8">*</span> 
                      </td>
                      <td valign="middle">
                      	<input name="bill_tel" type="text" class="form-control" id="bill_tel" maxlength="50" required="required" value="<?php echo $rs['bill_tel'];?>">
                      </td>
                  </tr>
                  <tr>
                      <td width="110" valign="middle">
                      	Email:
                      	<span class="Txt_red_8">*</span> 
                      </td>
                      <td width="204" valign="middle">
                      	<input name="email" type="email" class="form-control" id="email" placeholder="Email" data-error="Bruh, that email address is invalid"  maxlength="100" required="required" value="<?php echo $rs['email'];?>">
                      </td>
                  </tr>
                  <tr>
                      <th height="31" colspan="2" valign="middle">
                      	Shipping Information
                      </th>
                    </tr>
                    <tr>
                      <td  valign="middle"></td>
                      <td  valign="middle">
                      	<input name="chk_bill" type="checkbox" id="chk_bill" value="1" >
                      	Use Billing Info
                      </td>
                    </tr>
                  <tr>
                      <td valign="middle">
                      	Full Name: 
                      	<span class="Txt_red_8">*</span>
                      </td>
                      <td valign="middle">
                      	<input name="ship_name" type="text" class="form-control" id="ship_name" maxlength="100" required="required" value="<?php echo $rs['ship_name'];?>">
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	Address:
                      	<span class="Txt_red_8">*</span> 
                      </td>
                      <td valign="middle">                      	
                      	<textarea name="ship_address" id="ship_address" class="form-control" required="required"><?php echo $rs['ship_address'];?></textarea>
                      </td>
                  </tr>                  
                  <tr>
                      <td valign="middle">
                      	City or APO/FPO:
                      	<span class="Txt_red_8">*</span>  
                      </td>
                      <td valign="middle">
                      	<input name="ship_city" type="text" class="form-control" id="ship_city" maxlength="100" required="required" value="<?php echo $rs['ship_city'];?>">
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	State/Province:
                      	<span class="Txt_red_8">*</span>
                      </td>
                      <td valign="middle">
                      	<input name="ship_state" type="text" class="form-control" id="ship_state" maxlength="100" required="required" value="<?php echo $rs['ship_state'];?>">               
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	Zip/Postal Code:
                      	<span class="Txt_red_8">*</span> 
                      </td>
                      <td valign="middle">
                      	<input name="ship_zipcode" type="text" class="form-control" id="ship_zipcode" maxlength="30" required="required" value="<?php echo $rs['ship_zipcode'];?>">                      
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	Country:
                      	<span class="Txt_red_8">*</span>
                      </td>
                      <td valign="middle">
						<?php echo form_dropdown('ship_country',get_option('id','country_name','countries order by country_name'),$rs['ship_country'],'class="form-control" required="required"','--select country--');?>
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	Telephone:
                      	<span class="Txt_red_8">*</span> 
                      </td>
                      <td valign="middle">
                      	<input name="ship_tel" type="text" class="form-control" id="ship_tel" maxlength="50" required="required" value="<?php echo $rs['ship_tel'];?>">
                      </td>
                  </tr>
                   
                </tbody>
                </table>                
      				<div class="form-group" style="text-align:center;">
	            	  <input type="hidden" name="id" value="<?php echo @$rs['id'];?>">
		              <input type="submit" class="btn btn-primary" value="Save">
		              <input type="button" class="btn btn-default" value="Back" onclick="history.back();">			              
	            	</div>
            </div>
			</form>						
		</div><!-- /.box -->
	</div>
  </div>
</section>