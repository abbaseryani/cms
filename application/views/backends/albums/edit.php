<?php
$CI =& get_instance();
?>
<script type="text/javascript" src="<?php echo base_url() ?>statics/jquery-tokeninput/jquery.tokeninput.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>statics/jquery-tokeninput/token-input.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>statics/jquery-tokeninput/token-input-facebook.css"/>

<section class="content-header">
	<h1>
		<?php echo lang('msg_albums'); ?>
		<small><?php echo lang('msg_edit_albums'); ?></small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#"><?php echo lang('msg_dashboard'); ?></a></li>
		<li><a href="#"><?php echo lang('msg_albums'); ?></a></li>
		<li class="active"><?php echo lang('msg_edit_albums'); ?></li>

	</ol>
</section>

<section class="content">
	<!--show alert messager-->
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title"><?php echo lang('msg_edit_albums'); ?></h3>
		</div>
		
		<?php
		if($CI->session->flashdata('msg_ok')){
			echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>'.$CI->session->flashdata('msg_ok').'</div>';
		}
		;?>
		<form class="form-horizontal" id="form" method="post" enctype="multipart/form-data" action="<?php echo base_url().'admin/albums/edit_post';?>">

			<input type="hidden" name="id" id="id" value="<?php echo $obj[0]->id;?>">
			<input type="hidden" name="image" value="<?php echo $obj[0]->image ?>">

			<div class="form-group">
				<label class="control-label col-sm-2" for="txtName"><?php echo lang('msg_name');?></label>
				<div class="controls col-sm-10">
					<input type="text" id="name" name="name" value="<?php echo $obj[0]->name;?>" class="form-control">
					<?php echo form_error('name');?>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="txtName"><?php echo lang('msg_artists')?></label>
				<div class="col-sm-10">
					<input type="text" id="artists" class="form-control" name="artists" value="<?php echo set_value('artists')?>">
					<?php echo form_error('artists')?>
				</div>
			</div>
			<input type="hidden" value="" name="artists_list" id="artists_list"> 

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


<script type="text/javascript">
	function removeA(arr) {
		var what, a = arguments, L = a.length, ax;
		while (L > 1 && arr.length) {
			what = a[--L];
			while ((ax= arr.indexOf(what)) !== -1) {
				arr.splice(ax, 1);
			}
		}
		return arr;
	}

	$(document).ready(function () {
		var artists=[];
		$("#artists").tokenInput(
			"<?php echo base_url() ?>api/artists_api/artists",
			{
				theme: 'facebook',
				resultsFormatter: function(item) {
					var item='<li>'+item.name+'<span style="float:right"></span></li>';
					return item;
				},
				tokenFormatter:function(item){
					var item='<li>'+item.name+'</li>';
					return item;
				},
				onAdd:function(item){
					artists.push(item.id);
					$('#artists_list').val(JSON.stringify(artists));
				},
				onDelete:function(item){
					removeA(artists,item.id);
					$('#artists_list').val(JSON.stringify(artists));
				},
				preventDuplicates:true
			});

		<?php 
		if($obj[0]->artist_id!=null){
			$artist = explode(',', $obj[0]->artist_id);
			$CI->load->model('artists_model');
			foreach ($artist as $r) {
				if($r!=0){
					$name = $CI->artists_model->get_by_id($r);
					if($name!=null){
						$name = $name[0]->name;
						?>
						$("#artists").tokenInput("add", {id: '<?php echo $r ?>',name:'<?php echo $name ?>'});
						<?php
					}
				}
			}
		}
		?>
	});
</script>