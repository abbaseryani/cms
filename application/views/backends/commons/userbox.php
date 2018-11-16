<div class="navbar-custom-menu">
  <ul class="nav navbar-nav">
    <!-- User Account: style can be found in dropdown.less -->
            <?php
            if(isset($_SESSION['user'])){
                $user=$_SESSION['user'][0];
                
            }
            ?>
    <li class="dropdown user user-menu">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <img src="<?php echo base_url().$user->avt;?>" class="user-image" alt="User Image">
        <span class="hidden-xs">
            <?php
            if(isset($_SESSION['user'])){
                $user=$_SESSION['user'][0];
                echo $user->full_name;
            }
            ?>
        </span>
      </a>
      <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header">
          <img src="<?php echo base_url().$user->avt;?>" class="img-circle" alt="User Image">

          <p>
              <?php echo lang('msg_hello');?>, 
              <?php
              if(isset($_SESSION['user'])){
                  $user=$_SESSION['user'][0];
                  echo $user->full_name;
              }
              ?>
          </p>
        </li>
        <!-- Menu Body -->
        <li class="user-body">
          <div class="row">
            <div class="col-md-12 text-center">
              <a href="<?php echo base_url().'admin/dashboard/update_pwd';?>"><?php echo lang('msg_update_pwd');?></a>
            </div>
          </div>
          <!-- /.row -->
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
          <div class="pull-left">
            <a href="<?php echo base_url().'admin/dashboard/update_profile';?>" class="btn btn-default btn-flat"><?php echo lang('msg_update_profile');?></a>
          </div>
          <div class="pull-right">
            <a href="<?php echo base_url().'admin/dashboard/logout';?>" class="btn btn-default btn-flat"><?php echo lang('msg_logout');?></a>
          </div>
        </li>
      </ul>
    </li>
    <!-- Control Sidebar Toggle Button -->
    <li>
      <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
    </li>
  </ul>
</div>