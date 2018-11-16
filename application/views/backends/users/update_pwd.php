<section class="content-header">
  <h1>
	<?php echo lang('msg_users'); ?>
	<small><?php echo lang('msg_update_pwd'); ?></small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#"><?php echo lang('msg_dashboard'); ?></a></li>
	<li><a href="#"><?php echo lang('msg_users'); ?></a></li>
	<li class="active"><?php echo lang('msg_update_pwd'); ?></li>
	
  </ol>
</section>

<section class="content">
    <!--show alert messager-->
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo lang('msg_update_pwd'); ?></h3>
        </div>
	<!--show alert messager-->
	<?php if(isset($data['error_msg'])){?>
	<div class="alert alert-danger"><?php echo $data['error_msg'];?></div>
	<?php };?>

	<?php if(isset($data['success_msg'])){?>
	<div class="alert alert-success"><?php echo $data['success_msg'];?></div>
	<?php }?>

	<!--end show alert messager-->
	<form class="form-horizontal" id="form" method="post" action="" enctype="multipart/form-data">
		<fieldset>
			<input type="hidden" name="id" id="id" value="<?php echo $obj[0]->id;?>">

			<div class="form-group">
				<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_old_pwd');?></label>
				<div class="col-md-10">
					<input type="password" id="old_pwd" class="form-control" name="old_pwd"  value="<?php echo set_value('old_pwd');?>">
					<?php echo form_error('old_pwd');?>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_new_pwd');?></label>
				<div class="col-md-10">
					<input type="password" id="new_pwd" class="form-control" name="new_pwd" value="<?php echo set_value('new_pwd');?>">
					<?php echo form_error('new_pwd');?>
				</div>
			</div>


			<div class="form-group">
				<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_cfm_pwd');?></label>
				<div class="col-md-10">
					<input type="password" id="cfm_pwd" class="form-control" name="cfm_pwd" value="<?php echo set_value('cfm_pwd');?>">
					<?php echo form_error('cfm_pwd');?>
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-offset-2 col-md-10">
					<button type="submit" class="btn btn-primary" >
						<?php echo lang('msg_save');?>
					</button>
				</div>
			</div>
		</fieldset>
	</form>
</div>
</section>