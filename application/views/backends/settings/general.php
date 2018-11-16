<script src='<?php echo base_url() ?>statics/tinymce/tinymce.min.js'></script>
<script type="text/javascript">
  tinymce.init({
    selector: '.about,.privacy_policy',
      force_br_newlines : true,
  force_p_newlines : false,
  forced_root_block : '' 
  });
</script>
<section class="content-header">
  <h1>
	<?php echo lang('msg_settings'); ?>
	<small><?php echo lang('msg_general'); ?></small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#"><?php echo lang('msg_dashboard'); ?></a></li>
    <li><a href="#"><?php echo lang('msg_settings'); ?></a></li>
	<li class="active"><?php echo lang('msg_general'); ?></li>
  </ol>
</section>

<section class="content">
<!--show alert messager-->
<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title"><?php echo lang('msg_general'); ?></h3>
    </div>
    
	<form class="form-horizontal" id="form" method="post" action="" enctype="multipart/form-data">
		<fieldset>

				<div class="form-group">
					<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_about');?></label>
					<div class="controls col-md-10">
						<textarea class="about" rows="10" class="form-control" id="ga_code" name="about"><?php echo $obj['about']; ?></textarea>	
					</div>
				</div>


				<div class="form-group">
					<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_privacy_policy');?></label>
					<div class="controls col-md-10">
						<textarea class="privacy_policy" rows="10" class="form-control" id="ga_code" name="privacy_policy"><?php echo html_entity_decode($obj['privacy_policy']); ?></textarea>	
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_app_name');?></label>
					<div class="controls col-md-10">
						<input type="text" class="form-control" name="app_name" id="app_name" value="<?php echo $obj['app_name']; ?>" />
					</div>
				</div>

			    <div class="form-group">
					<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_logo');?></label>
					<div class="controls col-md-10">
						<img src="<?php echo base_url().$obj['app_logo']; ?>" width="120" height="110"/>
						<input type="file" class="form-control" name="app_logo" id="app_logo" style="margin-top: 10px"/>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_version');?></label>
					<div class="controls col-md-10">
						<input type="text" class="form-control" name="version" id="version" value="<?php echo $obj['version']; ?>" />
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_address');?></label>
					<div class="controls col-md-10">
						<input type="text" class="form-control" id="address" name="address" value="<?php echo $obj['address']; ?>">
					</div>
				</div>


				<div class="form-group">
					<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_website');?></label>
					<div class="controls col-md-10">
						<input type="text" class="form-control" name="website" id="website" value="<?php echo $obj['website']; ?>" placeholder="%">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_twitter');?></label>
					<div class="controls col-md-10">
						<input type="text" class="form-control" name="twitter" id="twitter" value="<?php echo $obj['twitter']; ?>" />
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_facebook');?></label>
					<div class="controls col-md-10">
						<input type="text" class="form-control" name="facebook" id="facebook" value="<?php echo $obj['facebook']; ?>" />
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_instagram');?></label>
					<div class="controls col-md-10">
						<input type="text" class="form-control" name="instagram" id="instagram" value="<?php echo $obj['instagram']; ?>" />
					</div>
				</div>

		


				<div class="form-group">
					<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_youtube');?></label>
					<div class="controls col-md-10">
						<input type="text" class="form-control" name="youtube" id="youtube" value="<?php echo $obj['youtube']; ?>" />
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_mail');?></label>
					<div class="controls col-md-10">
						<input type="text" class="form-control" name="mail" id="mail" value="<?php echo $obj['mail']; ?>" />
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_phone');?></label>
					<div class="controls col-md-10">
						<input type="text" class="form-control" name="phone" id="phone" value="<?php echo $obj['phone']; ?>" />
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-10 col-md-offset-2">
						<button type="submit" class="btn btn-primary" >
							<?php echo lang('msg_save');?>
						</button>
						<a href="<?php echo base_url();?>admin/settings/reset_general_settings" class="btn btn-default">
							<?php echo lang('reset_default');?>
						</a>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>

</section>