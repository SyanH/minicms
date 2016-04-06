<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>后台管理</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="Expires" content="0">
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Cache-control" content="no-cache">
	<meta http-equiv="Cache" content="no-cache">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->assets('module.admin@assets/css/normalize.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->assets('module.admin@assets/css/base.css'); ?>">    
	<link rel="stylesheet" type="text/css" href="<?php echo $this->assets('module.admin@assets/css/style.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->assets('module.admin@assets/css/font-awesome.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->assets('module.admin@assets/css/perfect-scrollbar.min.css'); ?>">
</head>
<body>
	<div class="sidebar">
		<h1 class="logo">
			<a href="#"><i class="fa fa-home"></i>后台管理</a>
		</h1>
		<nav>
			<p><a href="#"><i class="fa fa-bars"></i>控制台</a></p>
			<div class="show">
				<a href="#" class="current"><i class="fa fa-angle-double-right"></i>概要</a>
				<a href="#"><i class="fa fa-angle-double-right"></i>个人设置</a>
				<a href="#"><i class="fa fa-angle-double-right"></i>插件</a>
				<a href="#"><i class="fa fa-angle-double-right"></i>主题</a>
			</div>
			<p><a href="#"><i class="fa fa-bars"></i>攒写</a></p>
			<div>
				<a href="#"><i class="fa fa-angle-double-right"></i>攒写文章</a>
				<a href="#"><i class="fa fa-angle-double-right"></i>攒写页面</a>
			</div>
			<p><a href="#"><i class="fa fa-bars"></i>管理</a></p>
			<div>
				<a href="#"><i class="fa fa-angle-double-right"></i>文章</a>
				<a href="#"><i class="fa fa-angle-double-right"></i>页面</a>
				<a href="#"><i class="fa fa-angle-double-right"></i>评论</a>
				<a href="#"><i class="fa fa-angle-double-right"></i>分类</a>
				<a href="#"><i class="fa fa-angle-double-right"></i>标签</a>
				<a href="#"><i class="fa fa-angle-double-right"></i>文件</a>
				<a href="#"><i class="fa fa-angle-double-right"></i>用户</a>
			</div>
			<p><a href="#"><i class="fa fa-bars"></i>控制台</a></p>
			<div>
				<a href="#"><i class="fa fa-angle-double-right"></i>概要</a>
				<a href="#"><i class="fa fa-angle-double-right"></i>个人设置</a>
				<a href="#"><i class="fa fa-angle-double-right"></i>插件</a>
				<a href="#"><i class="fa fa-angle-double-right"></i>主题</a>
			</div>
		</nav>
	</div>
	<div class="main">
		<div class="main-header grid">
			<div class="row">
				<div class="col">
					<a href="#"><i class="fa fa-comments"></i>评论 <span class="badge badge-black">6</span></a>
					<a href="#"><i class="fa fa-bar-chart"></i>内容 <span class="badge badge-green">4</span></a>
					<a href="#"><i class="fa fa-weibo"></i>消息 <span class="badge badge-yellow">6</span></a>
				</div>
				<div class="col text-right">
					<img class="user-img" src="<?php echo $this->pathUrl('module.admin@assets/images/user.jpg'); ?>">
					<a href="#"><i class="fa fa-sign-out"></i>退出</a>
				</div>
			</div>
		</div>