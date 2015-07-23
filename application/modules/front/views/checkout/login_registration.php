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
	$('#registerForm').validator();
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
<div id="col-page">
    	<div id="breadcrumb"><a href="front/home">HOME</a> > Check Out > Log in & Registration</div>
		<div class="title-page">Check Out > Log in & Registration</div>
		<br>
		<div class="login-box-body">
        <p class="login-box-msg">Log in Your Account</p>
        <form id="loginForm" enctype="multipart/form-data" method="post" data-toggle="validator"action="front/checkout/login">
          <div class="form-group has-feedback">
            <input type="text" name="username" class="form-control" placeholder="Username">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">    
              <div class="checkbox icheck">
              </div>                        
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
      	</form>
      </div>
      <br>
      
      <div class="title-page">Register Account</div>
		<br>
		      	<form id="registerForm" enctype="multipart/form-data" method="post" data-toggle="validator"action="front/checkout/register">
                <table class="table table-bordered table-strip table-register">
                  <tbody>
                  <tr>
                    <th height="31" valign="middle">
                    	Username & Password
                    </th>
                  </tr>                  
                  <tr>
                      <td valign="middle">
                      	<div class="form-group">
                      		<label for="username" class="control-label">Username:<span class="Txt_red_8">*</span></label>
                      		<input name="username" type="text" class="form-control" id="username" required="required" maxlength="50">
                      	</div>
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	<div class="form-group">
    						<label for="inputPassword" class="control-label">Password:<span class="Txt_red_8">*</span></label>
                      		<input type="password" name="password" data-minlength="6" class="form-control" id="inputPassword" placeholder="Password" required>
                      		<span class="help-block">Minimum of 6 characters</span>
                      	</div>
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	<div class="form-group">
    					 <label for="inputPassword" class="control-label">Verify Password:<span class="Txt_red_8">*</span></label> 
                      	 <input type="password" name="vpassword" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Whoops, these don't match" placeholder="Confirm" required>
      					 <div class="help-block with-errors"></div>
      					</div>
                      </td>
                  </tr>
                  <tr>
                    <th height="31" valign="middle">
                    	Billing Information
                    </th>
                  </tr>  
                  <tr>
                      <td valign="middle">
                      	<div class="form-group">
    					 <label for="inputPassword" class="control-label">Full Name:<span class="Txt_red_8">*</span></label> 
                      	 <input name="name" type="text" class="form-control" id="name" maxlength="100" required="required">
                      	</div>
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">     
                      	<div class="form-group">     
                      	<label for="bill_address" class="control-label">Address:<span class="Txt_red_8">*</span></label>             	
                      	<textarea name="bill_address" id="bill_address" class="form-control" required="required"></textarea>
                      	</div>
                      </td>
                  </tr>                  
                  <tr>
                      <td valign="middle">
                      	<div class="form-group">     
                      		<label for="bill_city" class="control-label">City or APO/FPO:<span class="Txt_red_8">*</span></label>     
                      		<input name="bill_city" type="text" class="form-control" id="bill_city" maxlength="100" required="required">
                      	</div>
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	<div class="form-group">
    						<label for="bill_state" class="control-label">State/Province:<span class="Txt_red_8">*</span></label>
                      		<input name="bill_state" type="text" class="form-control" id="bill_state" maxlength="100" required="required">
                      	</div>                      
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	<div class="form-group">
    						<label for="bill_zipcode" class="control-label">Zip/Postal Code:<span class="Txt_red_8">*</span></label>
                      		<input name="bill_zipcode" type="text" class="form-control" id="bill_zipcode" maxlength="30" required="required">
                      	</div>                      
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	<div class="form-group">
    						<label for="bill_country" class="control-label">Country:<span class="Txt_red_8">*</span></label>
							<?php echo form_dropdown('bill_country',get_option('id','country_name','countries order by country_name'),'','id="bill_country" class="form-control" required="required"','--select country--');?>
						</div>
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	<div class="form-group">
    						<label for="bill_tel" class="control-label">Telephone:<span class="Txt_red_8">*</span></label>
                      		<input name="bill_tel" type="text" class="form-control" id="bill_tel" maxlength="50" required="required">
                      	</div>
                      </td>
                  </tr>
                  <tr>
                      <td width="204" valign="middle">
                      	<div class="form-group">
    						<label for="email" class="control-label">Email:<span class="Txt_red_8">*</span></label>
                      		<input name="email" type="email" class="form-control" id="email" placeholder="Email" data-error="that email address is invalid"  maxlength="100" required="required">
                      		 <div class="help-block with-errors"></div>
                      	</div>
                      </td>
                  </tr>
                  <tr>
                      <th height="31" valign="middle">
                      	Shipping Information
                      </th>
                    </tr>
                    <tr>
                      <td  valign="middle">
                      	<input name="chk_bill" type="checkbox" id="chk_bill" value="1" >
                      	Use Billing Info
                      </td>
                    </tr>
                  <tr>
                      <td valign="middle">
                      	<div class="form-group">
    						<label for="ship_name" class="control-label">Full Name:<span class="Txt_red_8">*</span></label>
                      		<input name="ship_name" type="text" class="form-control" id="ship_name" maxlength="100" required="required">
                      	</div>
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">          
                      	<div class="form-group">
    						<label for="ship_address" class="control-label">Address:<span class="Txt_red_8">*</span></label>            	
                      		<textarea name="ship_address" id="ship_address" class="form-control" required="required"></textarea>
                      	</div>
                      </td>
                  </tr>                  
                  <tr>
                      <td valign="middle">
                      	<div class="form-group">
    						<label for="ship_city" class="control-label">City or APO/FPO:<span class="Txt_red_8">*</span></label>   
                      		<input name="ship_city" type="text" class="form-control" id="ship_city" maxlength="100" required="required">
                      	</div>
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	<div class="form-group">
    						<label for="ship_state" class="control-label">State/Province:<span class="Txt_red_8">*</span></label>   
                      		<input name="ship_state" type="text" class="form-control" id="ship_state" maxlength="100" required="required">
                      	</div>                      
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	<div class="form-group">
    						<label for="ship_zipcode" class="control-label">Zip/Postal Code:<span class="Txt_red_8">*</span></label>   
                      		<input name="ship_zipcode" type="text" class="form-control" id="ship_zipcode" maxlength="30" required="required">
                      	</div>                      
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	<div class="form-group">
    						<label for="ship_country" class="control-label">Country:<span class="Txt_red_8">*</span></label>   
							<?php echo form_dropdown('ship_country',get_option('id','country_name','countries order by country_name'),'','id="ship_country" class="form-control" required="required"','--select country--');?>
						</div>
                      </td>
                  </tr>
                  <tr>
                      <td valign="middle">
                      	<div class="form-group">
    						<label for="ship_tel" class="control-label">Telephone:<span class="Txt_red_8">*</span></label>  
                      		<input name="ship_tel" type="text" class="form-control" id="ship_tel" maxlength="50" required="required">
                      	</div>
                      </td>
                  </tr>
                    <tr>
                    	<th colspan="2" style="text-align:center;">
                    		<input type="submit" name="submit" value="Register" class="btn btn-primary">
                    	</th>
                    </tr>
                </tbody>
                </table>              
      			</form>                
</div>