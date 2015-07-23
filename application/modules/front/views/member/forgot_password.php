<style>
	div .login-box-body{
		width:500px;
		height:151px;
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
</script>
<div id="col-page">
    	<div id="breadcrumb"><a href="front/home">HOME</a> > Forgot Password</div>
		<div class="title-page">Forgot Password</div>
		<br>
		<div class="login-box-body">
        <p class="login-box-msg">Send your password</p>
        <form id="registerForm" enctype="multipart/form-data" method="post" data-toggle="validator"action="front/member/send_password">
          <div class="form-group has-feedback">
            <input type="email" name="email" class="form-control" placeholder="Enter your register email" required="required">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">    
              <div class="checkbox icheck">
              </div>                        
            </div><!-- /.col -->
            <div class="col-xs-4">
              <input type="submit" class="btn btn-primary" value="Send Password">
            </div><!-- /.col -->
          </div>
          </form>
      </div>
</div>