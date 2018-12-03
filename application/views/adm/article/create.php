<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>新增文章</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="<?php echo SITE_STATIC; ?>/layui/css/layui.css" media="all" />
	<link rel="stylesheet" href="<?php echo ADMIN_CSS; ?>/public.css" media="all" />
    <link href="<?php echo SITE_STATIC; ?>/uediter/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
    <style>
        .edui-container{
            margin-left:110px;
        }
    </style>
</head>
<body class="childrenBody">
<form class="layui-form layui-row layui-col-space10">
	<div class="layui-col-md9 layui-col-xs12">
		<div class="layui-row layui-col-space10">
			<div class="layui-col-md9 layui-col-xs7">
				<div class="layui-form-item magt3">
					<label class="layui-form-label">文章标题</label>
					<div class="layui-input-block">
						<input type="text" class="layui-input newsName" name="title" lay-verify="title" placeholder="请输入文章标题">
					</div>
				</div>
                <div class="layui-form-item">
                    <label class="layui-form-label">关键词</label>
                    <div class="layui-input-block">
                        <input type="text" class="layui-input keywords" name="keywords" lay-verify="keywords" placeholder="请输入关键词">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">描述</label>
                    <div class="layui-input-block">
                        <textarea placeholder="请输入描述" name="description" class="layui-textarea description" lay-verify="description"></textarea>
                    </div>
                </div>

				<div class="layui-form-item">
					<label class="layui-form-label">内容摘要</label>
					<div class="layui-input-block">
						<textarea placeholder="请输入文章摘要" name="abstract" class="layui-textarea abstract" lay-verify="abstract"></textarea>
					</div>
				</div>
			</div>
			<div class="layui-col-md3 layui-col-xs5">
				<div class="layui-upload-list thumbBox mag0 magt3">
					<img class="layui-upload-img thumbImg">
                    <input type="hidden" name="image" value="" id="thumb">
				</div>
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">文章内容</label>
            <!-- 加载编辑器的容器 -->
            <script id="container" name="content" type="text/plain" ></script>
<!--			<div class="layui-input-block" style="display: none">-->
<!--				<textarea class="layui-textarea layui-hide" name="content" lay-verify="content" id="news_content"></textarea>-->
<!--			</div>-->
		</div>
        <div class="layui-form-item magt3">
            <label class="layui-form-label">选择分类</label>
            <div class="layui-input-inline">
                <select name="category_id" lay-verify="required" class="category_id">
                    <option value=""></option>
                    <?php foreach ($categories as $category) { ?>
                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-form-item newsTop">
                <label class="layui-form-label"> 排　序</label>
                <div class="layui-input-inline">
                    <input type="number" name="position" class="layui-input position" value="255">
                </div>
				<div class="layui-form-mid layui-word-aux">越大越靠前</div>
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-form-item newsTop">
                <label class="layui-form-label"> 点  赞</label>
                <div class="layui-input-inline">
                    <input type="number" name="likes" class="layui-input position" value="<?php echo rand(50, 199); ?>">
                </div>
            </div>
        </div>

		<div class="layui-form-item">
			<div class="layui-form-item newsTop">
				<label class="layui-form-label"> 热　门</label>
				<div class="layui-input-block">
					<input type="checkbox" name="is_hot" lay-skin="switch" lay-text="是|否" class="is_hot">
				</div>
			</div>
		</div>

		<div class="layui-form-item">
			<div class="layui-form-item newsTop">
				<label class="layui-form-label"> 推　荐</label>
				<div class="layui-input-block">
					<input type="checkbox" name="recommend" lay-skin="switch" lay-text="是|否" class="recommend">
				</div>
			</div>
		</div>

        <div class="layui-form-item">
            <label class="layui-form-label"></label>
            <div class="">
                <a class="layui-btn layui-btn-sm" lay-filter="addNews" lay-submit><i class="layui-icon">&#xe609;</i>发布</a>
                <a class="layui-btn layui-btn-primary layui-btn-sm" lay-filter="look" lay-submit>预览</a>
                <a class="layui-btn layui-btn-primary layui-btn-sm cancel-window" >取消</a>
            </div>
        </div>

	</div>

</form>
<script type="text/javascript" src="<?php echo SITE_STATIC; ?>/layui/layui.js"></script>
<script type="text/javascript" src="<?php echo ADMIN_JS; ?>/newsAdd.js"></script>
<script  type="text/javascript" src="<?php echo SITE_STATIC; ?>/uediter/third-party/jquery.min.js"></script>
<!-- 配置文件 -->
<script type="text/javascript" src="<?php echo SITE_STATIC; ?>/uediter/umeditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="<?php echo SITE_STATIC; ?>/uediter/umeditor.min.js"></script>
<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UM.getEditor('container', {
        imageUrl: "/adm/upload/uediter"             //图片上传提交地址
        ,imagePath: "/upload/"                          //图片修正地址，引用了fixedImagePath,如有特殊需求，可自行配置
        ,imageFieldName: "upfile"
    });

    layui.use(['form','layer','layedit','laydate','upload'],function(){
        var form = layui.form,
            layer = parent.layer === undefined ? layui.layer : top.layer;

        form.on("submit(addNews)",function(data){

            if (data.field.content == undefined) {
                top.layer.msg('文章内容不能为空');
                return;
            }

            var index = top.layer.msg('数据提交中，请稍候',{icon: 16,time:false,shade:0.8});

            $.ajax({
                type: 'post',
                url: '/adm/article/create',
                data: {
                    title: data.field.title,
                    keywords: data.field.keywords,
                    description: data.field.description,
                    abstract: data.field.abstract,
                    image: data.field.image,
                    likes: data.field.likes,
					position: data.field.position,
                    content: data.field.content,
					recommend : data.field.recommend == "on" ? "1" : "",    //是否推荐
					is_hot : data.field.is_hot == "on" ? "1" : "",    //是否热门
                    category_id: data.field.category_id
                },
                dataType: 'json',
                success: function (result) {
                    if (result.code == 200) {
                        top.layer.close(index);
                        top.layer.msg("文章添加成功！");

                        setTimeout(function () {
                            layer.closeAll("iframe");
                            //刷新父页面
                            parent.location.reload();
                        }, 500);
                    } else {
                        top.layer.msg(result.msg);
                    }
                }
            });
        });

        form.on("submit(look)",function(data){

            $.ajax({
                type: 'post',
                url: '/adm/article/preview',
                data: {
                    title: data.field.title,
                    content: data.field.content,
                    category_id: data.field.category_id
                },
                dataType: 'json',
                success: function (result) {
                    if (result.code == 200) {
                        console.log(result.data.url);
                        window.open(result.data.url, '_blank');
                    } else {
                        top.layer.msg(result.msg);
                    }
                }
            });
        });

    });
</script>
</body>
</html>
