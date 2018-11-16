<header class="main-header">
  <!-- Logo -->
  <a href="<?php echo base_url().'admin/dashboard';?>" class="logo">
	<!-- mini logo for sidebar mini 50x50 pixels -->
	<span class="logo-mini">CMS</span>
	<!-- logo for regular state and mobile devices -->
	<span class="logo-lg"><b><?php echo lang('msg_site_name')?></b> CMS</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
	<!-- Sidebar toggle button-->
	<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
	  <span class="sr-only">Toggle navigation</span>
	</a>

    <?php
    $CI =& get_instance();
    $CI->load->view('backends/commons/userbox');
    ?>
  </nav>
</header>

<?php $CI->load->view('backends/commons/sidebar'); ?>