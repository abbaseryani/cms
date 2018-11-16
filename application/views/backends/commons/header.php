<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Cherry -  Online MP3 CMS </title>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url().'statics/bootstrap/css/bootstrap.min.css'?>" />
<!-- <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url().'statics/bootstrap/css/bootstrap-responsive.min.css'?>"/> -->

<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url().'statics/admin-lte/css/AdminLTE.min.css'?>"/>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url().'statics/admin-lte/css/skins/_all-skins.css'?>"/>

<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url().'statics/font-awesome/css/font-awesome.min.css'?>"/>

<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery.min.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'statics/bootstrap/js/bootstrap.min.js'?>"></script>

<script type="text/javascript" src="<?php echo base_url().'statics/admin-lte/js/adminlte.min.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'statics/admin-lte/js/demo.js'?>"></script>

<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery_validation/jquery.validate.min.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery_validation/additional-methods.min.js'?>"></script>

<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url().'statics/css/index.css'?>"/>

<script type="text/javascript">
    $('document').ready(function(){
        
        //Active link menu
        var pathname = window.location.pathname;
        var hostname = window.location.hostname;
        var protocol = window.location.protocol;
        
        var domain = protocol + '//' + hostname + pathname;
        var domain_has_slash = protocol + '//' + hostname + pathname + '/';
        
        var $active = $('.sidebar-menu a[href="'+domain+'"], .sidebar-menu a[href="'+domain_has_slash+'"]');
        $active.closest('li').addClass('active');
        $active.closest('li.treeview').addClass('menu-open active');
    });
</script>