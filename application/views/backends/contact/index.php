<section class="content-header">
  <h1>
	<?php echo lang('msg_dashboard'); ?>
	<small><?php echo lang('msg_contact'); ?></small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#"><?php echo lang('msg_dashboard'); ?></a></li>
	<li class="active"><?php echo lang('msg_contact'); ?></li>
  </ol>
</section>

<section class="content">

	<h4>
		<?php if(isset($search_title)){?>
		<?php echo $search_title;?>
		<?php }; ?>
	</h4>

    <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"><?php echo lang('msg_contact'); ?></h3>

          <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="search-query form-control pull-right" placeholder="<?php echo lang('msg_search');?>" value="<?php echo (isset($_GET['query'])) ? $_GET['query'] : ''; ?>">
              
                <script type="text/javascript">
                $('.search-query').keypress(function(e) {
                    var code = (e.keyCode ? e.keyCode : e.which);
                    if (code == 13) {
                        var q = $('.search-query').val();
                        if (q != "") {
                            location.href ="<?php echo base_url().'admin/contact/search';?>?query=" + q;
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
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tbody>
            <tr>
              <th width="100px" style="text-align:center"><a href=""><?php echo lang('msg_id');?></a></th>
              <th><?php echo lang('msg_full_name'); ?></th>
              <th><?php echo lang('msg_email');?></th>
              <th><?php echo lang('msg_content') ?></th>
              <th><?php echo lang('msg_is_read'); ?></th>
              <th width="160px"><?php echo lang('msg_operation');?></th>
            </tr>
            <?php if(isset($list) && $list!=null)
            foreach($list as $r){?>
                <tr>
                    <td style="text-align:center;"><?php echo $r->id;?></td>
                    <td><?php echo $r->full_name; ?></td>
                    <td><?php echo $r->email;?></td>
                    <td><?php echo $r->content; ?></td>
                    <td>
                        <?php 
                            if($r->is_read==1){
                                echo '<span class="label label-success">'.lang('msg_yes').'</span>';
                            }else{
                                echo '<span class="label label-danger">'.lang('msg_no').'</span>';
                            }
                        ?>
                    </td>
                    <td>
                      <a class="btn btn-primary btn-sm" href="<?php echo base_url().'admin/contact/mark_as_read?id='.$r->id?>"><?php echo lang('msg_mark_read'); ?></a>
                      <!-- <a class="btn btn-danger btn-sm" href="<?php echo base_url().'admin/contact/reply?id='.$r->id;?>"><?php echo lang('msg_reply');?></a> -->
                      <a class="btn btn-danger btn-sm" href="<?php echo base_url().'admin/contact/delete?id='.$r->id;?>" onclick="return confirm('<?php echo lang('msg_confirm_delete');?>')"><?php echo lang('msg_delete');?></a>
                    </td>
                </tr>
                <?php }?>
          </tbody></table>
          <center><?php if(isset($page_link)) echo $page_link;?></center>
        </div>
        <!-- /.box-body -->
      </div>
  </section>