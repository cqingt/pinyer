<!DOCTYPE html>
<html class="loginHtml">
<head>
	<meta charset="utf-8">
	<title>管理后台登录</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<link rel="icon" href="../../favicon.ico">
	<link rel="stylesheet" href="<?php echo SITE_STATIC; ?>/layui/css/layui.css" media="all" />
	<link rel="stylesheet" href="<?php echo ADMIN_CSS; ?>/public.css" media="all" />
</head>
<body class="loginBody">
	<form class="layui-form">
		<div class="login-title">
			<strong>管理系统登录</strong>
		</div>
		<div class="layui-form-item input-item">
			<label for="userName">用户名</label>
			<input type="text" placeholder="请输入用户名" autocomplete="off" name="username" id="username" class="layui-input" lay-verify="required">
		</div>
		<div class="layui-form-item input-item">
			<label for="password">密码</label>
			<input type="password" placeholder="请输入密码" autocomplete="off" name="password" id="password" class="layui-input" lay-verify="required">
		</div>
		<div class="layui-form-item input-item" id="imgCode">
			<label for="code">验证码</label>
			<input type="text" placeholder="请输入验证码" autocomplete="off" id="code" class="layui-input" name="code" lay-verify="required">
<!--			<img src="--><?php //echo ADMIN_IMAGE; ?><!--/code.jpg">-->
            <img src="<?php echo site_url('adm/login/captcha');?>" alt="验证码" class="verifyImg" onclick="this.src='/adm/login/captcha?t=' + Math.random();">
		</div>
		<div class="layui-form-item" style="margin-top:30px;">
			<button class="layui-btn layui-block" lay-filter="login" lay-submit>登录</button>
		</div>

	</form>
	<script type="text/javascript" src="<?php echo SITE_STATIC; ?>/layui/layui.js"></script>
	<script type="text/javascript" src="<?php echo ADMIN_JS; ?>/login.js"></script>
<!--	<script type="text/javascript" src="--><?php //echo ADMIN_JS; ?><!--/cache.js"></script>-->
</body>
</html>