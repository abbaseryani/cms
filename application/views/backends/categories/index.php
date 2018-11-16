<section class="content-header">
  <h1>
	<?php echo lang('msg_dashboard'); ?>
	<small><?php echo lang('msg_categories'); ?></small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#"><?php echo lang('msg_dashboard'); ?></a></li>
	<li class="active"><?php echo lang('msg_categories'); ?></li>
  </ol>
</section>

<section class="content">
    <!--show alert messager-->
		
	<div class="page-header controls-wrapper">
		<a href="<?php echo base_url().'admin/categories/create';?>" class="btn btn-primary"><?php echo lang('msg_add');?></a>
	</div>

	<!--show alert messager-->
	   <h4>
		<?php if(isset($data['search_title'])){ ?>
			<?php echo $data['search_title'];?>
			<?php };?>
		</h4>
		<!--end show alert messager-->
        <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><?php echo lang('msg_categories'); ?></h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="search-query form-control pull-right" placeholder="<?php echo lang('msg_search');?>" value="<?php echo (isset($_GET['query'])) ? $_GET['query'] : ''; ?>">
                  
                  	<script type="text/javascript">
                  	$('.search-query').keypress(function(e) {
                  		var code = (e.keyCode ? e.keyCode : e.which);
                  		if (code == 13) {
                  			var q = $('.search-query').val();
                  			if (q != "") {
                  				location.href ="<?php echo base_url().'admin/categories/search';?>?query=" + q;
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
                  <th width="50px"><?php echo lang('msg_thumbnail'); ?></th>
                  <th><?php echo lang('msg_name');?></th>
                  <th width="150px"><?php echo lang('msg_operation');?></th>
                </tr>
                <?php if(isset($list) && $list!=null){
                  foreach($list as $r){?>
                    <tr>
                        <td style="text-align:center;"><?php echo $r->id;?></td>
                        <td>
                            <img class="thumbnail" src="<?php echo ($r->image!=null)?base_url().$r->image:base_url().'statics/images/no_photo.png';?>" alt="<?php echo $r->name; ?>" style="width: 100%; max-height: 100px; margin: 0" />
                        </td>
                        <td><?php echo $r->name;?></td>
                        <td>
                            <a class="btn btn-info"  href="<?php echo base_url().'admin/categories/edit_get?id='.$r->id;?>"><?php echo lang('msg_edit');?></a>
                            <a class="btn btn-danger" href="<?php echo base_url().'admin/categories/delete?id='.$r->id;?>" onclick="return confirm('<?php echo lang('msg_confirm_delete');?>')"><?php echo lang('msg_delete');?></a>
                        </td>
                    </tr>
                  <?php }
                } ?>
              </tbody></table>
              <center><?php if(isset($page_link)) echo $page_link;?></center>
            </div>
            <!-- /.box-body -->
          </div>
</section>