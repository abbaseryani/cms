<?php
$CI =& get_instance();
?>

<section class="content-header">
  <h1>
	<?php echo lang('msg_artists'); ?>
	<small><?php echo lang('msg_edit_artists'); ?></small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#"><?php echo lang('msg_dashboard'); ?></a></li>
	<li><a href="#"><?php echo lang('msg_artists'); ?></a></li>
	<li class="active"><?php echo lang('msg_edit_artists'); ?></li>
	
  </ol>
</section>

<section class="content">
    <!--show alert messager-->
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo lang('msg_edit_artists'); ?></h3>
        </div>
		
	<?php
	if($CI->session->flashdata('msg_ok')){
		echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>'.$CI->session->flashdata('msg_ok').'</div>';
	}
	;?>
	<form class="form-horizontal" id="form" method="post" enctype="multipart/form-data" action="<?php echo base_url().'admin/artists/edit_post';?>">

		<input type="hidden" name="id" id="id" value="<?php echo $obj[0]->id;?>">
		<input type="hidden" name="path" value="<?php echo $obj[0]->image ?>">

		<div class="form-group">
			<label class="control-label col-sm-2" for="txtName"><?php echo lang('msg_name');?></label>
			<div class="controls col-sm-10">
				<input type="text" id="name" name="name" value="<?php echo $obj[0]->name;?>" class="form-control">
				<?php echo form_error('name');?>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_images');?></label>
			<div class="col-md-10">
				<img src="<?php echo ($obj[0]->image!=null)?base_url().$obj[0]->image:base_url().'statics/images/ic_avatar.png'; ?>" width="100" height="100">
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-md-2" for="txtName"></label>
			<div class="col-md-10">
				<input type="file" id="image" class="form-control" name="image">
				<span style="margin-top:5px;display:block">JPEG|JPN|PNG 5MB</span>
			</div>
		</div>


		<div class="form-group">
			<div class="col-sm-10 col-sm-offset-2">
				<button type="submit" class="btn btn-primary" >
					<?php echo lang('msg_save');?>
				</button>
			</div>
		</div>
	</form>
</div>

</div>
</section>