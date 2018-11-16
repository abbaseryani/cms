<?php
$CI =& get_instance();
?>

<?php
if($CI->session->flashdata('msg_ok')){
	echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>'.$CI->session->flashdata('msg_ok').'</div>';
}
?>

<section class="content-header">
  <h1>
	<?php echo lang('msg_settings'); ?>
	<small><?php echo lang('msg_payments'); ?></small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#"><?php echo lang('msg_dashboard'); ?></a></li>
    <li><a href="#"><?php echo lang('msg_settings'); ?></a></li>
	<li class="active"><?php echo lang('msg_payments'); ?></li>
  </ol>
</section>

<section class="content">
    <!--show alert messager-->
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo lang('msg_payments'); ?></h3>
        </div>

	<form class="form-horizontal" id="form" method="post" action="" enctype="multipart/form-data">
	    	
			<div class="form-group">

				<label class="control-label col-md-2" for="txtName"><?php echo lang('public_key');?></label>
				<div class="col-md-10">
				  <input type="text" name="public_key" class="form-control" placeholder="Stripe - <?php echo lang('public_key');?>" value="<?php echo $obj['public_key']; ?>"></input>
			    </div>
				</div>

					<div class="form-group">
				<label class="control-label col-md-2" for="txtName"><?php echo lang('secret_key');?></label>
				<div class="col-md-10">
				  <input type="text" name="secret_key" class="form-control" placeholder="Stripe - <?php echo lang('secret_key');?>" value="<?php echo $obj['secret_key']; ?>"></input>
			    </div>
				</div>

				<div class="form-group">
					<div class="col-md-10 col-md-offset-2">
						<button type="submit" class="btn btn-primary">
							<?php echo lang('msg_save');?>
						</button>
						<a href="<?php echo base_url();?>admin/settings/reset_payments_settings" class="btn btn-default">
							<?php echo lang('reset_default');?>
						</a>
					</div>
				</div>
	</form>
</div>

</div>
</section>