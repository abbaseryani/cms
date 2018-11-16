<section class="content-header">
  <h1>
	<?php echo lang('msg_dashboard'); ?>
	<small><?php echo lang('msg_users'); ?></small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#"><?php echo lang('msg_dashboard'); ?></a></li>
	<li class="active"><?php echo lang('msg_users'); ?></li>
  </ol>
</section>

<section class="content">
	
	<div class="page-header controls-wrapper">
		<a href="<?php echo base_url().'admin/users/create';?>" class="btn btn-primary"><?php echo lang('msg_add');?></a>
	</div>

	<!--show alert messager-->
	<h4>
		<?php if(isset($search_title))
		echo $search_title;?>

	</h4>
	<!--end show alert messager-->
    <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"><?php echo lang('msg_users'); ?></h3>

          <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="search-query form-control pull-right" placeholder="<?php echo lang('msg_search');?>" value="<?php echo (isset($_GET['query'])) ? $_GET['query'] : ''; ?>">
              
                <script type="text/javascript">
                $('.search-query').keypress(function(e) {
                    var code = (e.keyCode ? e.keyCode : e.which);
                    if (code == 13) {
                        var q = $('.search-query').val();
                        if (q != "") {
                            location.href ="<?php echo base_url().'admin/users/search';?>?query=" + q;
                        }
                    }
                })
                </script>
             
              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding" style="padding-bottom: 120px!important">
          <table class="table table-hover">
            <tbody>
            <tr>
              <th width="100px" style="text-align:center"><a href=""><?php echo lang('msg_id');?></a></th>
              <th><?php echo lang('msg_user_name');?></th>
              <th><?php echo lang('msg_full_name');?></th>
              <th><?php echo lang('msg_email');?></th>
              <th><?php echo lang('msg_address');?></th>
              <th><?php echo lang('msg_phone');?></th>
              <th><?php echo lang('msg_status');?></th>
              <th width="150px"><?php echo lang('msg_operation');?></th>

            </tr>
            <?php if(isset($list) && $list!=null)
            foreach($list as $r){?>
                <tr>
                    <td style="text-align:center;"><?php echo $r->id;?></td>
                    <td><?php echo $r->user_name;?></td>
                    <td><?php echo $r->full_name;?></td>
                    <td><?php echo $r->email;?></td>
                    <td><?php echo $r->address;?></td>
                    <td><?php echo $r->phone;?></td>
                    <td><?php
                        if($r->activated == 1){
                            echo '<span class="label label-success" >'.lang('msg_activate').'</span>';
                        }else{
                            echo '<span class="label label-danger">'.lang('msg_deactivate').'</span>';
                        }
                        ?></td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">
                                    <?php echo lang('msg_operation');?>
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" style="right:0; left: auto">
                                    <li>
                                        <a href="<?php echo base_url().'admin/users/activate?id='.$r->id;?>">
                                            <?php echo lang('msg_activate');?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url().'admin/users/lock?id='.$r->id;?>">
                                            <?php echo lang('msg_deactivate');?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url().'admin/users/edit_get?id='.$r->id;?>">
                                            <?php echo lang('msg_edit');?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url().'admin/users/delete?id='.$r->id;?>" onclick="return confirm('<?php echo lang('msg_confirm_delete');?>')"><?php echo lang('msg_delete');?></a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php }?>
          </tbody></table>
          <center><?php if(isset($page_link)) echo $page_link;?></center>
        </div>
        <!-- /.box-body -->
      </div>
    
</section>