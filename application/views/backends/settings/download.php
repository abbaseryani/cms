<section class="content-header">
  <h1>
	<?php echo lang('msg_settings'); ?>
	<small><?php echo lang('msg_ads'); ?></small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#"><?php echo lang('msg_dashboard'); ?></a></li>
    <li><a href="#"><?php echo lang('msg_settings'); ?></a></li>
	<li class="active"><?php echo lang('msg_ads'); ?></li>
  </ol>
</section>

<section class="content">
    <!--show alert messager-->
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo lang('msg_ads'); ?></h3>
        </div>

	<form class="form-horizontal" id="form" method="post" action="" enctype="multipart/form-data">

			<div class="form-group">
				<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_allow_download');?></label>
				<div class="controls col-md-10">
					<select class="form-control" name="allow_download">
						<option <?php if($obj['allow_download']=='0'){ echo 'selected';} ?>  value="0">
							<?php echo lang('msg_off'); ?></option>

						<option <?php if($obj['allow_download']=='1'){ echo 'selected';} ?>  value="1"><?php echo lang('msg_on'); ?></option>
					</select>
				</div>
			</div>


			<div class="form-group">
				<div class="col-md-10 col-md-offset-2">
					<button type="submit" class="btn btn-primary" >
						<?php echo lang('msg_save');?>
					</button>
					<a href="<?php echo base_url();?>admin/settings/reset_download" class="btn btn-default">
						<?php echo lang('reset_default');?>
					</a>
				</div>
			</div>

	</form>
</div>

</div>
</section>