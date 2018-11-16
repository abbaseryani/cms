<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <?php 
      if(isset($_SESSION['user'])){
        $user=$_SESSION['user'][0];
      }
      ?>
      <div class="pull-left image">
        <img src="<?php echo base_url().$user->avt;?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php
        echo $user->full_name;
        ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->


    <style type="text/css">
    .user-panel>.image>img{
      width: 45px;
      height: 45px;
      margin-top: 10px;
    }
  </style>
  <!-- /.search form -->
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">GENERAL</li>
    <li>
      <a href="<?php echo base_url().'admin/dashboard';?>">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
      </a>
    </li>


    <li>
      <a href="<?php echo base_url().'admin/push';?>">
        <i class="fa fa-dashboard"></i> <span><?php echo lang('push'); ?></span>
      </a>
    </li>


    <li class="treeview">
      <a href="#">
        <i class="fa fa-wrench"></i>
        <span><?php echo lang('msg_settings')?></span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="<?php echo base_url().'admin/settings/general'?>"><i class="fa fa-circle-o"></i> <?php echo lang('msg_general')?></a></li>

     <!--        <li><a href="<?php //echo base_url().'admin/settings/mail'?>"><i class="fa fa-circle-o"></i> <?php //echo lang('msg_email')?></a></li>
      <li><a href="<?php //echo base_url().'admin/settings/payments'?>"><i class="fa fa-circle-o"></i> <?php //echo lang('msg_payments')?></a></li> -->

      <li><a href="<?php echo base_url().'admin/settings/push'?>"><i class="fa fa-circle-o"></i> <?php echo lang('push')?></a></li>

      <li><a href="<?php echo base_url().'admin/settings/ads'?>"><i class="fa fa-circle-o"></i> <?php echo lang('msg_ads')?></a></li>

      <li><a href="<?php echo base_url().'admin/settings/download'?>"><i class="fa fa-circle-o"></i> <?php echo lang('msg_download')?></a></li>
    </ul>
  </li>
  <li class="header">TAXONOMY</li>
  <li class="treeview">
    <a href="#">
      <i class="fa fa-tags"></i>
      <span><?php echo lang('msg_categories')?></span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>

    <ul class="treeview-menu">
      <li><a href="<?php echo base_url().'admin/categories'?>"><i class="fa fa-circle-o"></i> <?php echo lang('msg_categories')?></a></li>
      <li><a href="<?php echo base_url().'admin/categories/create'?>"><i class="fa fa-circle-o"></i> <?php echo lang('msg_add_categories')?></a></li>
    </ul>
  </li>

  <li class="treeview">
    <a href="#">
      <i class="fa fa-tags"></i>
      <span><?php echo lang('msg_albums')?></span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>

    <ul class="treeview-menu">
      <li><a href="<?php echo base_url().'admin/albums'?>"><i class="fa fa-circle-o"></i> <?php echo lang('msg_albums')?></a></li>
      <li><a href="<?php echo base_url().'admin/albums/create'?>"><i class="fa fa-circle-o"></i> <?php echo lang('msg_add_album')?></a></li>
    </ul>
  </li>



  <li class="treeview">
    <a href="#">
      <i class="fa fa-tags"></i>
      <span><?php echo lang('msg_artists')?></span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>

    <ul class="treeview-menu">
      <li><a href="<?php echo base_url().'admin/artists'?>"><i class="fa fa-circle-o"></i> <?php echo lang('msg_artists')?></a></li>
      <li><a href="<?php echo base_url().'admin/artists/create'?>"><i class="fa fa-circle-o"></i> <?php echo lang('msg_add_artist')?></a></li>
    </ul>
  </li>

  <li class="treeview">
    <a href="#">
      <i class="fa fa-tags"></i>
      <span><?php echo lang('msg_playlists')?></span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>

    <ul class="treeview-menu">
      <li><a href="<?php echo base_url().'admin/playlists'?>"><i class="fa fa-circle-o"></i> <?php echo lang('msg_playlists')?></a></li>
      <li><a href="<?php echo base_url().'admin/playlists/create'?>"><i class="fa fa-circle-o"></i> <?php echo lang('msg_add_playlist')?></a></li>
    </ul>
  </li>

  
  <li class="header">LIST</li>

  <li class="treeview">
    <a href="#">
      <i class="fa fa-image"></i>
      <span><?php echo lang('msg_mp3')?></span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="<?php echo base_url().'admin/audios'?>"><i class="fa fa-circle-o"></i> <?php echo lang('msg_mp3')?></a></li>
      <li><a href="<?php echo base_url().'admin/audios/create'?>"><i class="fa fa-circle-o"></i> <?php echo lang('msg_add_mp3')?></a></li>
    </ul>
  </li>

  <li class="header">USER</li>
  <li class="treeview">
    <a href="#">
      <i class="fa fa-users"></i>
      <span><?php echo lang('msg_users')?></span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="<?php echo base_url().'admin/users'?>"><i class="fa fa-circle-o"></i> <?php echo lang('msg_users')?></a></li>
      <li><a href="<?php echo base_url().'admin/users/create'?>"><i class="fa fa-circle-o"></i> <?php echo lang('msg_add_users')?></a></li>
    </ul>
  </li>
<!--         <li>
          <a href="<?php //echo base_url().'admin/contact'?>">
            <i class="fa fa-envelope"></i>
            <span><?php //echo lang('msg_contact')?></span>
          </a>
        </li> -->
        
        <li class="header">MORE PRODUCTS</li>
        <li class="bg-green">
          <a href="https://codecanyon.net/user/lrandom/portfolio">
            <i class="fa fa-gift"></i>
            <span>Lrandom</span>
          </a>
        </li>

        <!-- <li class="header">DOCUMENTATION</li> -->
        <!-- <li><a href="https://lrandomdev.com/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li> -->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>