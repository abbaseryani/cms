<section class="content-header">
  <h1>
   <?php echo lang('msg_dashboard'); ?>
   <small><?php echo lang('msg_overview'); ?></small>
 </h1>
 <ol class="breadcrumb">
   <li><a href="#"><i class="fa fa-dashboard"></i><?php echo lang('msg_home'); ?></a></li>
   <li class="active"><?php echo lang('msg_dashboard'); ?></li>
 </ol>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?php echo $categories;?></h3>
            <p><?php echo lang('msg_categories'); ?></p>
          </div>

          <a href="<?php echo base_url() ?>admin/categories" class="small-box-footer"><?php echo lang('msg_more_info'); ?> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?php echo $audios;?></h3>
            <p><?php echo lang('msg_mp3') ?></p>
          </div>
   
          <a href="<?php echo base_url() ?>admin/audios" class="small-box-footer"><?php echo lang('msg_more_info'); ?> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?php echo $artists;?></h3>
            <p><?php echo lang('msg_artists'); ?></p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="<?php echo base_url() ?>admin/artists" class="small-box-footer"><?php echo lang('msg_more_info'); ?> <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3><?php echo $albums;?></h3>
            <p><?php echo lang('msg_albums'); ?></p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="<?php echo base_url() ?>admin/albums" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>

  </div>

</section>
