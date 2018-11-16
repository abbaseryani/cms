<script type="text/javascript" src="<?php echo base_url() ?>statics/jquery-tokeninput/jquery.tokeninput.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>statics/jquery-tokeninput/token-input.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>statics/jquery-tokeninput/token-input-facebook.css"/>
  <link rel="stylesheet" media="screen" type="text/css" href="<?php echo base_url()?>statics/colorpicker/css/colorpicker.css" />
  <script type="text/javascript" src="<?php echo base_url() ?>statics/colorpicker/js/colorpicker.js"></script>

<section class="content-header">
  <h1>
   Dashboard
   <small><?php echo lang('msg_overview'); ?></small>
 </h1>
 <ol class="breadcrumb">
   <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Dashboard</li>
 </ol>
</section>

<section class="content">
  <div class="container-fluid">

    <!--end show alert messager-->
    <div class="row ">

      <form id="form" method="post" action="" enctype="multipart/form-data">

        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo lang('send_push'); ?></h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form">
            <div class="box-body">
              <div class="form-group">
                <label for="title"><?php echo lang('msg_title');?></label>
                <input type="text" rows="6" name="title" class="form-control" id="title" value="<?php echo $obj['app_name']; ?>"/>
              </div>


            <div class="form-group">
               <label  for="title_color">Title Color</label>
                <input type="text" rows="6" id="title_color" name="title_color" class="form-control" />
            </div>

            <div class="form-group">
              <label for="push_content"><?php echo lang('push_content');?></label>
              <textarea rows="6" name="content" placeholder="<?php echo lang('push_content_placeholder'); ?>" class="form-control" id="push_content"></textarea>
            </div>


            <div class="form-group">
               <label  for="title_color">Content Color</label>
                <input type="text" rows="6" id="content_color" name="content_color" class="form-control" />
            </div>

            <div class="form-group">
              <label for="image"><?php  echo lang('msg_image').' ('.lang('msg_optional').')'; ?></label>
              <input type="file" name="image" class="form-control"/>
               <p class="help-block">Default image is app logo you set in general setting</p>
            </div>

            <div class="form-group">
              <label for="category"><?php echo lang('msg_categories'); ?></label>
              <input type="text" name="category" id="category" class="form-control" />
              <p class="help-block">To directly open category when tap on notification</p>
            </div>

            <div class="form-group">
              <label for="artist"><?php echo lang('msg_artists'); ?></label>
              <input type="text" name="artist" id="artist" class="form-control" />
              <p class="help-block">To directly open artist when tap on notification</p>
            </div>

            <div class="form-group">
              <label for="track"><?php echo lang('msg_mp3'); ?></label>
              <input type="text" name="track" id="track" class="form-control" />
              <p class="help-block">To directly open mp3 when tap on notification</p>
            </div>

            <div class="form-group">
              <label for="track"><?php echo lang('msg_external_url'); ?></label>
              <input type="url" name="external_url" id="url" class="form-control" placeholder="example: http://google.com.vn" />
              <p class="help-block">To open external link</p>
            </div>

            <input type="hidden" name="selected_categories" id="selected_categories"/>
            <input type="hidden" name="selected_artist" id="selected_artist"/>
            <input type="hidden" name="selected_track" id="selected_track" />


          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary"><?php echo lang('msg_send');?></button>
          </div>
        </form>
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
    var categories=[];
    var artists=[];
    var tracks =[];


    $("#category").tokenInput(
      "<?php echo base_url() ?>api/categories_api/categories",
      {
        tokenLimit: 1,
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
          $('#selected_categories').val(item.id);
          $('#artist').tokenInput("clear");
          $('#track').tokenInput("clear");
        },
        onDelete:function(item){
          $('#selected_categories').val('');
        },
        preventDuplicates:true
      });


    $("#artist").tokenInput(
      "<?php echo base_url() ?>api/artists_api/artists",
      { tokenLimit:1,
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
          $('#selected_artist').val(item.id);
          $('#category').tokenInput("clear");
          $('#track').tokenInput("clear");
        },
        onDelete:function(item){
          $('#selected_artist').val('');
        },
        preventDuplicates:true
      });


    $("#track").tokenInput(
      "<?php echo base_url() ?>api/audios_api/audios",
      { tokenLimit:1,
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
          tracks.push(item.id);
          $('#selected_track').val(item.id);
          $('#artist').tokenInput("clear");
          $('#category').tokenInput("clear");
        },
        onDelete:function(item){
          removeA(tracks,item.id);
          $('#selected_track').val('');
        },
        preventDuplicates:true
      });

    $('#title_color').ColorPicker({
      color: '#0000ff',
      onShow: function (colpkr) {
        $(colpkr).fadeIn(500);
        return false;
      },
      onHide: function (colpkr) {
        $(colpkr).fadeOut(500);
        return false;
      },
      onChange: function (hsb, hex, rgb) {
        $('#title_color').val('ff'+hex);
      }
    });

    $('#content_color').ColorPicker({
      color: '#0000ff',
      onShow: function (colpkr) {
        $(colpkr).fadeIn(500);
        return false;
      },
      onHide: function (colpkr) {
        $(colpkr).fadeOut(500);
        return false;
      },
      onChange: function (hsb, hex, rgb) {
        console.log(rgb);
        $('#content_color').val('ff'+hex);
      }
    });

  });


</script>


