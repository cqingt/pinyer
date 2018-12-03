<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>文章列表</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="<?php echo SITE_STATIC; ?>/layui/css/layui.css" media="all" />
	<link rel="stylesheet" href="<?php echo ADMIN_CSS; ?>/public.css" media="all" />
</head>
<body class="childrenBody">
<form class="layui-form">
	<blockquote class="layui-elem-quote quoteBox">
		<form class="layui-form">
			<div class="layui-inline">
				<div class="layui-input-inline">
                    <select name="category_id" lay-verify="required" class="category_id">
                        <option value=""></option>
                        <?php foreach ($categories as $category) { ?>
                            <option value="<?php echo $category['id']; ?>" ><?php echo $category['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="layui-input-inline">
					<input type="text" class="layui-input searchVal" placeholder="请输入搜索的内容" />
				</div>
				<a class="layui-btn search_btn" data-type="reload">搜索</a>
			</div>
			<div class="layui-inline">
				<a class="layui-btn layui-btn-normal addNews_btn">添加文章</a>
			</div>
			<div class="layui-inline">
				<a class="layui-btn layui-btn-danger layui-btn-normal delAll_btn">批量删除</a>
			</div>
		</form>
	</blockquote>
	<table id="newsList" lay-filter="newsList"></table>
	<!--审核状态-->
	<script type="text/html" id="newsStatus">
		{{#  if(d.newsStatus == "1"){ }}
		<span class="layui-red">等待审核</span>
		{{#  } else if(d.newsStatus == "0"){ }}
		<span class="layui-blue">已存草稿</span>
		{{#  } else { }}
			审核通过
		{{#  }}}
	</script>

	<!--操作-->
	<script type="text/html" id="newsListBar">
		<a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
		<a class="layui-btn layui-btn-xs layui-btn-danger" lay-event="del">删除</a>
		<a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="look" target="_blank" href="/news/detail?id={{ d.id }}">预览</a>
	</script>
</form>
<script type="text/javascript" src="<?php echo SITE_STATIC; ?>/layui/layui.js"></script>
<script type="text/javascript" src="<?php echo ADMIN_JS; ?>/newsList.js"></script>
</body>
</html>