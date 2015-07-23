<style>
	div .login-box-body{
		width:360px;
		height:221px;
		  background: #fff;
		  padding: 20px;
		  color: #444;
		  border:1px solid #CCCCCC;
		  color: #666;
		  margin:0 auto;
	}
	.table-register{
		width:650px;
		margin:0 auto;
	}
	.Txt_red_8{
		color:red;
	}
	#registerForm .form-control-feedback {
    pointer-events: auto;
	}
	#registerForm .form-control-feedback:hover {
	    cursor: pointer;
	}
</style>
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
</script>
<div id="col-page">
    	<div id="breadcrumb"><a href="front/home">HOME</a> > Member Profile</div>
		<div class="title-page">Member Profile</div>
		<br>
		      	<form id="registerForm" enctype="multipart/form-data" method="post" data-toggle="validator"action="front/member/update_profile">
                <table class="table table-bordered table-strip table-register">
                  <tbody>
                  <tr>
                    <th height="31" colspan="2" valign="middle">
                    	Username & Password
                    </th>
                  </tr>                  
                  <tr>
                      <td valign="middle" style="">
                      	Username:
                      	<span class="Txt_red_8">*</span> 
                      </td>
                      <td valign="middle">
                      	<div class="form-group">
                      	<input name="username" type="text" class="form-control" id="username" required="required" maxlength="50" value="<?php echo login_data('username');?>">
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
                      	<input name="name" type="text" class="form-control" id="name" maxlength="100" required="required" value="<?php echo login_data('name');?>">
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	Address:
                      	<span class="Txt_red_8">*</span> 
                      </td>
                      <td valign="middle">                      	
                      	<textarea name="bill_address" id="bill_address" class="form-control" required="required"><?php echo login_data('bill_address');?></textarea>
                      </td>
                  </tr>                  
                  <tr>
                      <td valign="middle">
                      	City or APO/FPO:
                      	<span class="Txt_red_8">*</span>  
                      </td>
                      <td valign="middle">
                      	<input name="bill_city" type="text" class="form-control" id="bill_city" maxlength="100" required="required" value="<?php echo login_data('bill_city');?>">
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	State/Province:
                      	<span class="Txt_red_8">*</span>
                      </td>
                      <td valign="middle">
                      	<input name="bill_state" type="text" class="form-control" id="bill_state" maxlength="100" required="required" value="<?php echo login_data('bill_state');?>">                      
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	Zip/Postal Code:
                      	<span class="Txt_red_8">*</span> 
                      </td>
                      <td valign="middle">
                      	<input name="bill_zipcode" type="text" class="form-control" id="bill_zipcode" maxlength="30" required="required" value="<?php echo login_data('bill_zipcode');?>">            
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	Country:
                      	<span class="Txt_red_8">*</span>
                      </td>
                      <td valign="middle">
						<?php echo form_dropdown('bill_country',get_option('id','country_name','countries order by country_name'),login_data('bill_country'),'class="form-control" required="required"','--select country--');?>
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	Telephone:
                      	<span class="Txt_red_8">*</span> 
                      </td>
                      <td valign="middle">
                      	<input name="bill_tel" type="text" class="form-control" id="bill_tel" maxlength="50" required="required" value="<?php echo login_data('bill_tel');?>">
                      </td>
                  </tr>
                  <tr>
                      <td width="110" valign="middle">
                      	Email:
                      	<span class="Txt_red_8">*</span> 
                      </td>
                      <td width="204" valign="middle">
                      	<input name="email" type="email" class="form-control" id="email" placeholder="Email" data-error="Bruh, that email address is invalid"  maxlength="100" required="required" value="<?php echo login_data('email');?>">
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
                      	<input name="ship_name" type="text" class="form-control" id="ship_name" maxlength="100" required="required" value="<?php echo login_data('ship_name');?>">
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	Address:
                      	<span class="Txt_red_8">*</span> 
                      </td>
                      <td valign="middle">                      	
                      	<textarea name="ship_address" id="ship_address" class="form-control" required="required"><?php echo login_data('ship_address');?></textarea>
                      </td>
                  </tr>                  
                  <tr>
                      <td valign="middle">
                      	City or APO/FPO:
                      	<span class="Txt_red_8">*</span>  
                      </td>
                      <td valign="middle">
                      	<input name="ship_city" type="text" class="form-control" id="ship_city" maxlength="100" required="required" value="<?php echo login_data('ship_city');?>">
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	State/Province:
                      	<span class="Txt_red_8">*</span>
                      </td>
                      <td valign="middle">
                      	<input name="ship_state" type="text" class="form-control" id="ship_state" maxlength="100" required="required" value="<?php echo login_data('ship_state');?>">               
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	Zip/Postal Code:
                      	<span class="Txt_red_8">*</span> 
                      </td>
                      <td valign="middle">
                      	<input name="ship_zipcode" type="text" class="form-control" id="ship_zipcode" maxlength="30" required="required" value="<?php echo login_data('ship_zipcode');?>">                      
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	Country:
                      	<span class="Txt_red_8">*</span>
                      </td>
                      <td valign="middle">
						<?php echo form_dropdown('ship_country',get_option('id','country_name','countries order by country_name'),login_data('ship_country'),'class="form-control" required="required"','--select country--');?>
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	Telephone:
                      	<span class="Txt_red_8">*</span> 
                      </td>
                      <td valign="middle">
                      	<input name="ship_tel" type="text" class="form-control" id="ship_tel" maxlength="50" required="required" value="<?php echo login_data('ship_tel');?>">
                      </td>
                  </tr>
                    <tr>
                    	<th colspan="2" style="text-align:center;">
                    		<input type="submit" name="submit" value="Update Profile" class="btn btn-primary">
                    	</th>
                    </tr>
                </tbody>
                </table>                
      			</form>                
</div>