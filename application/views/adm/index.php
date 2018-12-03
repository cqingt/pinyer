<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>后台系统管理</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="icon" href="favicon.ico">
    <link rel="stylesheet" href="<?php echo SITE_STATIC; ?>/layui/css/layui.css" media="all" />
    <link rel="stylesheet" href="<?php echo ADMIN_CSS; ?>/index.css" media="all" />
</head>
<body class="main_body">
<div class="layui-layout layui-layout-admin">
    <!-- 顶部 -->
    <div class="layui-header header">
        <div class="layui-main mag0">
            <a href="#" class="logo">CMS后台管理</a>
            <!-- 显示/隐藏菜单 -->
            <a href="javascript:;" class="seraph hideMenu icon-caidan"></a>
            <!-- 顶级菜单 -->
            <ul class="layui-nav mobileTopLevelMenus" mobile>
                <li class="layui-nav-item" data-menu="contentManagement">
                    <a href="javascript:;"><i class="seraph icon-caidan"></i><cite>CMS</cite></a>
                    <dl class="layui-nav-child">
                        <dd class="layui-this" data-menu="contentManagement"><a href="javascript:;"><i class="layui-icon" data-icon="&#xe63c;">&#xe63c;</i><cite>文章管理</cite></a></dd>
                        <dd data-menu="memberCenter"><a href="javascript:;"><i class="seraph icon-icon10" data-icon="icon-icon10"></i><cite>用户中心</cite></a></dd>
<!--                        <dd data-menu="systemeSttings"><a href="javascript:;"><i class="layui-icon" data-icon="&#xe620;">&#xe620;</i><cite>系统设置</cite></a></dd>-->
                    </dl>
                </li>
            </ul>
            <!-- 顶部右侧菜单 -->
            <ul class="layui-nav top_menu">
                <li class="layui-nav-item" pc style="display: none;">
                    <a href="javascript:;" class="clearCache"><i class="layui-icon" data-icon="&#xe640;">&#xe640;</i><cite>清除缓存</cite><span class="layui-badge-dot"></span></a>
                </li>
                <li class="layui-nav-item" id="userInfo">
                    <a href="javascript:;"><img src="<?php echo ADMIN_IMAGE; ?>/face.jpg" class="layui-nav-img userAvatar" width="35" height="35"><cite class="adminName"><?php echo 'name' ?></cite></a>
                    <dl class="layui-nav-child">
<!--                        <dd><a href="javascript:;" data-url="page/user/userInfo.html"><i class="seraph icon-ziliao" data-icon="icon-ziliao"></i><cite>个人资料</cite></a></dd>-->
                        <dd><a href="javascript:;" data-url="/adm/user/changePwd"><i class="seraph icon-xiugai" data-icon="icon-xiugai"></i><cite>修改密码</cite></a></dd>
                        <dd><a href="/adm/login/logout" class="signOut"><i class="seraph icon-tuichu"></i><cite>退出</cite></a></dd>
                    </dl>
                </li>
            </ul>
        </div>
    </div>
    <!-- 左侧导航 -->
    <div class="layui-side layui-bg-black">
        <div class="user-photo">
            <a class="img" title="我的头像" ><img src="<?php echo ADMIN_IMAGE; ?>/face.jpg" class="userAvatar"></a>
            <p>你好！<span class="userName">admin</span>, 欢迎登录</p>
        </div>

        <div class="navBar layui-side-scroll" id="navBar">
            <ul class="layui-nav layui-nav-tree">
                <li class="layui-nav-item layui-this">
                    <a href="javascript:;" data-url="<?php echo site_url('adm/index/main'); ?>"><i class="layui-icon" data-icon=""></i><cite>后台首页</cite></a>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;" data-url="<?php echo site_url('adm/article/index'); ?>"><i class="layui-icon layui-icon-list" data-icon="&#xe60a;"></i><cite>文章管理</cite></a>
                </li>
                <li class="layui-nav-item" style="display: none">
                    <a href="javascript:;" data-url="<?php echo site_url('adm/system/index'); ?>"><i class="layui-icon layui-icon-user" data-icon="&#xe770;"></i><cite>用户中心</cite></a>
                </li>
               <!-- <li class="layui-nav-item">
                    <a href="javascript:;" data-url="<?php /*echo site_url('adm/system/index'); */?>"><i class="layui-icon layui-icon-set-fill" data-icon="&#xe614;"></i><cite>系统设置</cite></a>
                </li>-->
            </ul>
        </div>
    </div>
    <!-- 右侧内容 -->
    <div class="layui-body layui-form">
        <div class="layui-tab mag0" lay-filter="bodyTab" id="top_tabs_box">
            <ul class="layui-tab-title top_tab" id="top_tabs">
                <li class="layui-this" lay-id=""><i class="layui-icon">&#xe68e;</i> <cite>后台首页</cite></li>
            </ul>
            <ul class="layui-nav closeBox">
                <li class="layui-nav-item">
                    <a href="javascript:;"><i class="layui-icon caozuo">&#xe643;</i> 页面操作</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" class="refresh refreshThis"><i class="layui-icon">&#x1002;</i> 刷新当前</a></dd>
                        <dd><a href="javascript:;" class="closePageOther"><i class="seraph icon-prohibit"></i> 关闭其他</a></dd>
                        <dd><a href="javascript:;" class="closePageAll"><i class="seraph icon-guanbi"></i> 关闭全部</a></dd>
                    </dl>
                </li>
            </ul>
            <div class="layui-tab-content clildFrame">
                <div class="layui-tab-item layui-show">
                    <iframe src="<?php echo site_url('adm/index/main'); ?>"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- 底部 -->
    <div class="layui-footer footer">
        <p><span>copyright @2018 PinYer</span></p>
    </div>
</div>

<!-- 移动导航 -->
<div class="site-tree-mobile"><i class="layui-icon">&#xe602;</i></div>
<div class="site-mobile-shade"></div>

<script type="text/javascript" src="<?php echo SITE_STATIC; ?>/layui/layui.js"></script>
<script type="text/javascript" src="<?php echo ADMIN_JS; ?>/index.js"></script>
<!--<script type="text/javascript" src="--><?php //echo ADMIN_JS; ?><!--/cache.js"></script>-->
</body>
</html>