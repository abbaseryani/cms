<section class="content-header">
  <h1>
	<?php echo lang('msg_settings'); ?>
	<small><?php echo lang('msg_email'); ?></small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#"><?php echo lang('msg_dashboard'); ?></a></li>
    <li><a href="#"><?php echo lang('msg_settings'); ?></a></li>
	<li class="active"><?php echo lang('msg_email'); ?></li>
  </ol>
</section>

<section class="content">
    <!--show alert messager-->
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo lang('msg_email'); ?></h3>
        </div>
        
	<form class="form-horizontal" id="form" method="post" action="" enctype="multipart/form-data">

			<div class="form-group">
				<label class="control-label col-md-2" for="txtName"><?php echo lang('smtp_host');?></label>
				<div class="controls col-md-10">
					<input type="text" id="host" class="form-control" name="host" value="<?php echo $obj['smtp_host'];?>">
					<?php echo form_error('host');?>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-2" for="txtName"><?php echo lang('smtp_user');?></label>
				<div class="controls col-md-10">
					<input type="text" id="user" class="form-control" name="user" value="<?php echo $obj['smtp_user'];?>">
					<?php echo form_error('user');?>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-2" for="txtName"><?php echo lang('smtp_pwd');?></label>
				<div class="controls col-md-10">
					<input type="password" id="pwd" class="form-control" name="pwd" value="<?php echo $obj['smtp_pass'];?>">
					<?php echo form_error('pwd');?>
				</div>
			</div>


			<div class="form-group">
				<label class="control-label col-md-2" for="txtName"><?php echo lang('smtp_port');?></label>
				<div class="controls col-md-10">
					<input type="text" id="port" class="form-control" name="port" value="<?php echo $obj['smtp_port'];?>">
					<?php echo form_error('port');?>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-2" for="txtName"><?php echo lang('mailpath');?></label>
				<div class="controls col-md-10">
					<input type="text" id="mail_path" class="form-control" name="mail_path" value="<?php echo $obj['mailpath'];?>">
					<?php echo form_error('port');?>
				</div>
			</div>


			<div class="form-group">
				<label class="control-label col-md-2" for="txtName"><?php echo lang('from_user');?></label>
				<div class="controls col-md-10">
					<input type="text" id="from_user" class="form-control" name="from_user" value="<?php echo $obj['from_user'];?>">
					<?php echo form_error('from_name');?>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-2" for="txtName"><?php echo lang('from_email');?></label>
				<div class="controls col-md-10">
					<input type="text" id="from_email" class="form-control" name="from_email" value="<?php echo $obj['from_email'];?>">
					<?php echo form_error('from_email');?>
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-10 col-md-offset-2">
					<button type="submit" class="btn btn-primary" >
						<?php echo lang('msg_save');?>
					</button>
					<a href="<?php echo base_url();?>admin/settings/reset_mail_settings" class="btn btn-default">
						<?php echo lang('reset_default');?>
					</a>
				</div>
			</div>

	</form>
</div>

</div>
</section>