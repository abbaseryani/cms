<?php
$CI =& get_instance();
?> 
<script type="text/javascript" src="<?php echo base_url() ?>statics/jquery-tokeninput/jquery.tokeninput.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>statics/jquery-tokeninput/token-input.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>statics/jquery-tokeninput/token-input-facebook.css"/>

<script src="<?php echo base_url(); ?>statics/fileupload/js/vendor/jquery.ui.widget.js"></script>
<script src="<?php echo base_url(); ?>statics/fileupload/js/jquery.iframe-transport.js"></script>
<script src="<?php echo base_url(); ?>statics/fileupload/js/jquery.fileupload.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>statics/jquery.blockUI.js"></script>
<script src='<?php echo base_url() ?>statics/tinymce/tinymce.min.js'></script>
<script type="text/javascript">
	tinymce.init({
		selector: '#description',
		force_br_newlines : true,
		force_p_newlines : false,
		forced_root_block : '' 
	});
</script>

<section class="content-header">
	<h1>
		<?php echo lang('msg_audios'); ?>
		<small><?php echo lang('msg_edit_audio'); ?></small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#"><?php echo lang('msg_dashboard'); ?></a></li>
		<li><a href="#"><?php echo lang('msg_audios'); ?></a></li>
		<li class="active"><?php echo lang('msg_edit_audio'); ?></li>

	</ol>
</section>

<section class="content">
	<!--show alert messager-->
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title"><?php echo lang('msg_edit_audio'); ?></h3>
		</div>
		
		<div>
			<?php
			if($CI->session->flashdata('msg_ok')){
				echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>'.$CI->session->flashdata('msg_ok').'</div>';
			}
			?>
			<?php
			if($CI->session->flashdata('msg_error')){
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>'.$CI->session->flashdata('msg_error').'</div>';
			}
			?>
		</div>

		<form class="form-horizontal" id="form" method="post" action="edit_post" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo $obj[0]->id; ?>">
			<div class="form-group">
				<label class="control-label col-sm-2" for="txtName"><?php echo lang('msg_audios')?></label>
				<div class="col-sm-4">
					<div class="drag-drop-zone-wrapper">
						<div class="progress" style="margin-top:10px;margin-left:5px">
							<div class="bar" style="width: 0%;">   
							</div>
						</div>
						<span class="fileinput-button drag-drop-zone">
							<span class="text" style="margin-top: 85px;display: block;"><i class="fa fa-plus"></i>&nbsp;Drag and drop file here or click !</span>
							<input type="file" id="fudAudio" name="file_audio" class="fudFile"  multiple="true" />
						</span>
					</div>	

					<div class="audio-preview" style="border: 1px solid #ccc;margin-top:15px;margin-left:5px">
						<audio controls>
							<source src="<?php echo $obj[0]->path; ?>"
								type='audio/mp4'>
								<p>Your user agent does not support the HTML5 Audio element.</p>
							</audio>
						</div>
					</div>
				</div>

				<div class="form-group" >
					<label class="control-label col-sm-2"><?php echo lang('msg_path');?></label>
					<div class="col-sm-10">
						<input type="text" class="form-control path" name="path" value="<?php echo str_replace(base_url(),'',$obj[0]->path); ?>">
						<?php echo form_error('path');?>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2"><?php echo lang('msg_name');?></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="name" name="name" value="<?php echo $obj[0]->name; ?>">
						<?php echo form_error('name');?>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2"><?php echo lang('msg_duration');?></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="duration" name="duration" value="<?php echo $obj[0]->duration; ?>">
						<?php echo form_error('duration');?>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2" for="txtName"><?php echo lang('msg_tags')?></label>
					<div class="col-sm-10">
						<input type="text" id="tags" class="form-control" name="tags" value="<?php echo $obj[0]->tags?>" placeholder="ex: natural,animal">
						<?php echo form_error('tags')?>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2" for="txtName"><?php echo lang('msg_categories')?></label>
					<div class="col-sm-10">
						<?php 
						$select_categories = $obj[0]->categories_id;
						$select_categories = explode(',', $select_categories);
						foreach ($categories as $r) {
							?>
							<input type="checkbox" name="categories[]" value="<?php echo $r->id ?>"
							<?php if(in_array($r->id, $select_categories)){echo 'checked';} ?>
							> 

							<span><?php echo $r->name; ?></span>
							<br>
							<?php 
							
						}
						
						?>
						<?php echo form_error('categories')?>
					</div>
				</div>


				<div class="form-group">
					<label class="control-label col-sm-2" for="txtName"><?php echo lang('msg_description')?></label>
					<div class="col-sm-10">
						<textarea cols="100" id="description" name="description" class="form-control" style="height: 150px;resize:none">
							<?php echo $obj[0]->description;?>
						</textarea>
						<?php echo form_error('description')?>
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
					<label class="control-label col-sm-2" for="txtName"><?php echo lang('msg_albums')?></label>
					<div class="col-sm-10">
						<input type="text" id="albums" class="form-control" name="albums" value="<?php echo set_value('albums')?>">
						<?php echo form_error('albums')?>
					</div>
				</div>
				<input type="hidden" value="" name="albums_list" id="albums_list">

				<div class="form-group">
					<label class="control-label col-sm-2" for="txtName"><?php echo lang('msg_playlists')?></label>
					<div class="col-sm-10">
						<input type="text" id="playlists" class="form-control" name="playlists" value="<?php echo set_value('playlists')?>">
						<?php echo form_error('playlists')?>
					</div>
				</div>
				<input type="hidden" value="" name="playlists_list" id="playlists_list">

				<div class="form-group">
					<label class="control-label col-md-2" for="txtName"><?php echo lang('msg_thumb');?></label>
					<div class="col-md-10">
						<img src="<?php echo ($obj[0]->thumb!=null)?base_url().$obj[0]->thumb:base_url().'statics/images/ic_avatar.png'; ?>" width="100" height="100">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2" for="txtName"><?php echo lang('msg_thumbnail')?></label>
					<div class="col-sm-10">
						<input type="file" name="image" id="image">
						<?php if(isset($error['error_upload_file'])){?>
							<span class="help-inline msg-error" generated="true"><?php echo $error['error_upload_file']?></span>
						<?php }; ?>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<button type="submit" class="btn btn-primary" >
							<?php echo lang('msg_save')?>
						</button>
						<button type="reset" class="btn">
							<?php echo lang('msg_reset')?>
						</button>
					</div>
				</div>
				

			</form>
			<!--end form-->
		</div>
		<!--end container fluid-->
	</section>



	<style type="text/css">

	.progress{
		display: block;
		overflow: hidden;
		position: relative;
		border: 1px solid #CCCCCC;
		height: 15px;
		background: #ffffff;
		margin-bottom: 15px;
		width: 250px;
	}

	.bar {
		height: 100%;
		background: #2586D0
	}

	.drag-drop-zone-wrapper{
		position: relative;
		display: block;
		margin: 0px auto;
	}

	.fileinput-button {
		overflow: hidden;
		position: relative;
		height: 200px;
		margin-left: 5px;
		margin-right: 5px;
		background: white;
		background:  white;
		border: 4px dashed #3B92D5;
		cursor: pointer;
		display: inline-block;
		font-size: 14px;
		line-height: 20px;
		margin-bottom: 0;
		padding: 4px 12px;
		text-align: center;
		vertical-align: middle;
	}

	.fileinput-button:hover{
		background: #D6F6FA
	}

	.fudFile {
		cursor: pointer;
		direction: ltr;
		font-size: 23px;
		margin: 0;
		opacity: 0;
		position: absolute;
		right: 0;
		top: 0;
		transform: translate(-300px, 0px) scale(4);
		-webkit-transform: translate(-300px, 0px) scale(4);
		-ms-transform:translate(-300px, 0px) scale(4);
		width: 100%;
		height: 100%;
	}
</style>

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
		var playlists=[];

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

		$("#albums").tokenInput(
			"<?php echo base_url() ?>api/albums_api/albums",
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
					$('#albums_list').val(item.id);
				},
				onDelete:function(item){
					$('#albums_list').val();
				},
				preventDuplicates:true,
				tokenLimit:1
			});

		$("#playlists").tokenInput(
			"<?php echo base_url() ?>api/playlists_api/playlists",
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
					playlists.push(item.id);
					$('#playlists_list').val(JSON.stringify(playlists));
				},
				onDelete:function(item){
					removeA(playlists,item.id);
					$('#playlists_list').val(JSON.stringify(playlists));
				},
				preventDuplicates:true
			});


		$('#fudAudio').fileupload({
			url:'<?php echo base_url() ?>admin/audios/add_audio',
			dataType: 'json',
			formData: {'id':1},
			add:function(e,data){
				$('.audio-preview audio').trigger("pause");
				$('.path').val('');
				data.submit();
			},
			progressall: function (e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				$('.progress .bar').css('width',progress + '%');
			},
			started:function(){
				$('.progress .bar').css('width',0 + '%');  
			},
			autoUpload:false,
			dropZone:$('.drag-drop-zone'),
			done: function (e, data) {
				result=data.result;
				if(result.success==1){
					$('.path').val(result.path);
					$('.audio-preview audio').attr("src","<?php echo base_url() ?>"+result.path);
				}else{
					alert('upload failed, try again');
				}
				$('.progress .bar').css('width',0 + '%');  
			}
		});
		//end config file
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

		if($obj[0]->album_id!=null){
			$albums = explode(',', $obj[0]->album_id);
			$CI->load->model('albums_model');
			foreach ($albums as $r) {
				if($r!=0){
					$name = $CI->albums_model->get_by_id($r);
					if($name!=null){
						$name = $name[0]->name;
						?>
						$("#albums").tokenInput("add", {id: '<?php echo $r ?>',name:'<?php echo $name ?>'});
						<?php
					}
				}
			}
		}


		if($obj[0]->playlist_id!=null){
			$playlists = explode(',', $obj[0]->playlist_id);
			$CI->load->model('playlists_model');
			foreach ($playlists as $r) {
				if($r!=0){
					$name = $CI->playlists_model->get_by_id($r);
					if($name!=null){
						$name = $name[0]->name;
						?>
						$("#playlists").tokenInput("add", {id: '<?php echo $r ?>',name:'<?php echo $name ?>'});
						<?php
					}
				}
			}
		}
		?>
	});
    //end ready jquery

</script>



