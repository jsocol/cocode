<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="author" content="James Socol" />

	<title><?php echo $this->title; ?> - <?php echo $this->site_name; ?> - CoCode</title>
	
	<script type="text/ecmascript" src="<?php echo $GLOBALS['base_url']; ?>/javascript/jquery.js"></script>
	<script type="text/ecmascript" src="<?php echo $GLOBALS['base_url']; ?>/javascript/cocode.js"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/main.css" />
	<!--[if lte IE 7]>
	<link rel="stylesheet" type="text/css" href="<?php echo $GLOBALS['base_url']; ?>/ie.css" />
	<![endif]-->

</head>

<body>

<!-- begin #header -->
<div id="header">
	<span id="sitename"><?php echo $this->link_to($this->site_name,''); ?></span>
	<span id="by-cocode">powered by <span class="cocode"><a href="javascript:;">Cocode</a></span></span>
	
	<!-- begin #user-status -->
	<div id="user-status">
		<ul>
			<?php if($this->current_user->can('admin')): ?><li><?php echo $this->link_to('Admin',array('controller'=>'admin','action'=>'index')); ?></li><?php endif; ?>
			<?php if($this->logged_in): ?><li><?php echo $this->link_to('Create', array('controller'=>'snippet','action'=>'create')); ?></li>
			<li><?php echo $this->link_to('Profile',array('controller'=>'user','action'=>'view','id'=>$this->current_user->id)); ?></li>
			<li><?php echo $this->link_to('Settings', array('controller'=>'user','action'=>'preferences'));?></li>
			<li><?php echo $this->link_to('Log Out', array('controller'=>'user','action'=>'logout')); ?></li><?php else: ?>
			<li><?php echo $this->link_to('Log In', array('controller'=>'user','action'=>'login')); ?></li>
			<?php endif; ?>
		</ul>
	</div>
	<!-- end #user-status -->
</div>
<!-- end #header -->