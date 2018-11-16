<section class="content-header">
  <h1>
	<?php echo lang('msg_settings'); ?>
	<small><?php echo lang('push'); ?></small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#"><?php echo lang('msg_dashboard'); ?></a></li>
    <li><a href="#"><?php echo lang('msg_settings'); ?></a></li>
	<li class="active"><?php echo lang('push'); ?></li>
  </ol>
</section>

<section class="content">
    <!--show alert messager-->
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo lang('push'); ?></h3>
        </div>

	<form class="form-horizontal" id="form" method="post" action="" enctype="multipart/form-data">

			<div class="form-group">
				<label class="control-label col-md-2" for="txtName"><?php echo lang('onesignal_app_id');?></label>
				<div class="controls col-md-10">
					<input type="text" id="host" class="form-control" name="app_id" value="<?php echo $obj['app_id'];?>">
					<?php echo form_error('host');?>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-2" for="txtName"><?php echo lang('onesignal_rest_api_key');?></label>
				<div class="controls col-md-10">
					<input type="text" id="user" class="form-control" name="rest_key" value="<?php echo $obj['rest_key'];?>">
					<?php echo form_error('user');?>
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-10 col-md-offset-2">
					<button type="submit" class="btn btn-primary" >
						<?php echo lang('msg_save');?>
					</button>
					<a href="<?php echo base_url();?>admin/settings/reset_push" class="btn btn-default">
						<?php echo lang('reset_default');?>
					</a>
				</div>
			</div>

	</form>
</div>

</div>
</section>