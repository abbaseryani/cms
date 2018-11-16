<!doctype html>
<html>
<head>
	<?php 
	$CI =& get_instance();
	$CI->load->view('backends/commons/header');
	?>
	<style>
	.error-line {
		text-align: center;
		padding-bottom: 30px;
		color: #e04646;
		}
	</style>
</head>
<body class="hold-transition login-page">
	<div class="login-box">
  <div class="login-logo">
    <a href="#"><b><?php echo SITE_NAME; ?></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg"><?php echo lang('msg_sign_in') ?></p>
	<span class="error"><?php if(isset($error_msg)) {echo $error_msg;} ?></span>
	<span class="error"><?php echo form_error('user_name')?></span>
	<span class="error"><?php echo form_error('pwd')?></span>

    <form class="form-login" method="post" action="<?php echo base_url().'admin/dashboard/login'?>">
      <div class="form-group has-feedback">
		<input name="user_name" id="user_name" type="text" class="form-control" placeholder="Username" size="50" >
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
	  	<input name="pwd" id="pwd" type="password" class="form-control" placeholder="Password" size="50">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-md-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat"><?php echo lang('sign_in_text') ?></button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
	
</body>
</html>