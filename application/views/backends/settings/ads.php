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
				<label class="control-label col-md-2" for="txtName"><?php echo lang('app_ad_id');?></label>
				<div class="controls col-md-10">
					<input type="text" id="app_ad_id" class="form-control" name="app_ad_id" value="<?php echo $obj['app_ad_id'];?>">
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-2" for="txtName"><?php echo lang('banner_ad_unit');?></label>
				<div class="controls col-md-10">
					<input type="text" id="banner_ad_unit" class="form-control" name="banner_ad_unit" value="<?php echo $obj['banner_ad_unit'];?>">
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-2" for="txtName"><?php echo lang('in_ad_unit');?></label>
				<div class="controls col-md-10">
					<input type="text" id="in_ad_unit" class="form-control" name="in_ad_unit" value="<?php echo $obj['in_ad_unit'];?>">
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-10 col-md-offset-2">
					<button type="submit" class="btn btn-primary" >
						<?php echo lang('msg_save');?>
					</button>
					<a href="<?php echo base_url();?>admin/settings/reset_ads" class="btn btn-default">
						<?php echo lang('reset_default');?>
					</a>
				</div>
			</div>

	</form>
</div>

</div>
</section>