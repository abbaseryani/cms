<!DOCTYPE html>
<html>
<head>
	<meta property="og:image" content="<?php echo base_url().$obj->thumb; ?>">
	<meta property="og:image:type" content="image/png">
	<meta property="og:image:width" content="1024">
	<meta property="og:image:height" content="1024">
	<title></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>statics/bootstrap/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div>
				<h4 style="text-align: center;"><?php echo $obj->name; ?>&nbsp;|&nbsp;<a href="<?php echo base_url().'download?url='.$obj->path; ?>&name=<?php echo $obj->path; ?>">Download</a></h4>
			</div>
			<center>
				<audio
				controls
				src="<?php echo $obj->path; ?>">
				Your browser does not support the <code>audio</code> element.
			</audio>
		</center>
	</div>
</div>
</body>
</html>