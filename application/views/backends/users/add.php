<?php
$CI =& get_instance();
?>
<section class="content-header">
  <h1>
	<?php echo lang('msg_users'); ?>
	<small><?php echo lang('msg_add_users'); ?></small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#"><?php echo lang('msg_dashboard'); ?></a></li>
	<li><a href="#"><?php echo lang('msg_users'); ?></a></li>
	<li class="active"><?php echo lang('msg_add_users'); ?></li>
	
  </ol>
</section>

<section class="content">
    <!--show alert messager-->
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo lang('msg_add_users'); ?></h3>
        </div>
	<?php
	if($CI->session->flashdata('msg_ok')){
		echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>'.$CI->session->flashdata('msg_ok').'</div>';
	}
	?>

	<form class="form-horizontal" id="form" method="post" action="" enctype="multipart/form-data">

			<div class="form-group">
				<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_user_name');?></label>
				<div class="col-md-10">
					<input type="text" id="user_name" class="form-control" name="user_name" value="<?php echo set_value('user_name');?>">
					<?php echo form_error('user_name');?>
				</div>
			</div>


			<div class="form-group">
				<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_pwd');?></label>
				<div class="col-md-10">
					<input type="password" id="pwd" name="pwd" class="form-control" value="<?php echo set_value('pwd');?>">
					<?php echo form_error('pwd');?>
				</div>
			</div>


			<div class="form-group">
				<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_full_name');?></label>
				<div class="col-md-10">
					<input type="text" id="full_name" name="full_name" class="form-control" value="<?php echo set_value('full_name');?>">
					<?php echo form_error('full_name');?>
				</div>
			</div>


			<div class="form-group">
				<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_email');?></label>
				<div class="col-md-10">
					<input type="text" id="email" name="email" class="form-control" value="<?php echo set_value('email');?>">
					<?php echo form_error('email');?>
				</div>
			</div>


			<div class="form-group">
				<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_phone');?></label>
				<div class="col-md-10">
					<input type="text" id="phone" name="phone" class="form-control" value="<?php echo set_value('phone');?>">
					<?php echo form_error('phone');?>
				</div>
			</div>


			<div class="form-group">
				<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_address');?></label>
				<div class="col-md-10">
					<input type="text" id="address" name="address" class="form-control" value="<?php echo set_value('address');?>">
					<?php echo form_error('address');?>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_perm');?></label>
				<div class="col-md-10">
					<select name="perm" class="form-control">
						<option value="<?php echo STAFF;?>"><?php echo lang('msg_staff');?></option>
						<option value="<?php echo ADMIN;?>"><?php echo lang('msg_admin');?></option>
					</select>
					<?php echo form_error('perm');?>
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-10 col-md-offset-2">
					<button type="submit" class="btn btn-primary" >
						<?php echo lang('msg_save');?>
					</button>
					<input class="btn" type="reset" value="<?php echo lang('msg_reset');?>" class="form-control">
				</div>
			</div>
	</form>
</div>
</section>