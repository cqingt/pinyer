layui.use(['form','layer','laydate','table','laytpl'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery,
        laydate = layui.laydate,
        laytpl = layui.laytpl,
        table = layui.table;

    //新闻列表
    var tableIns = table.render({
        elem: '#newsList',
        url : '/adm/article/record',
        cellMinWidth : 95,
        page : true,
        height : "full-125",
        limit : 15,
        limits : [10,15,20,25],
        id : "newsListTable",
        cols : [[
            {type: "checkbox", fixed:"left", width:50},
            {field: 'id', title: 'ID', width:60, align:"center"},
            {field: 'title', title: '文章标题', width:350},
            {field: 'category', title: '文章分类', width:150},
            {field: 'views', title: '浏览', align:'center'},
            {field: 'likes', title: '点赞', align:'center'},
            {field: 'is_hot', title: '是否热门', align:'center', templet:function(d){
                return '<input type="checkbox" name="is_hot" lay-filter="newsHot" lay-skin="switch" lay-text="是|否" data-key="'+d.id+'" data-hot="' + d.is_hot + '" '+ (d.is_hot > 0 ? "checked" : '') + '>'
            }},
			{field: 'recommend', title: '是否推荐', align:'center', templet:function(d){
				return '<input type="checkbox" name="recommend" lay-filter="newsRecommend" lay-skin="switch" lay-text="是|否" data-key="'+d.id+'" data-recommend="' + d.recommend + '" '+ (d.recommend > 0 ? "checked" : '') + '>'
			}},
            {field: 'newsTime', title: '发布时间', align:'center', minWidth:110, templet:function(d){
                return d.created_at;//.substring(0,15);
            }},
            {title: '操作', width:170, templet:'#newsListBar',fixed:"right",align:"center"}
        ]]
    });

    //是否置顶
    form.on('switch(newsHot)', function(data){
        var _id = $(this).data('key');
        var _hot = $(this).data('hot');

        var index = layer.msg('修改中，请稍候',{icon: 16, time:false, shade:0.8});
        $.ajax({
            type: 'post',
            url: '/adm/article/setHot',
            data: {id: _id, is_hot: 1 - _hot},
            dataType: 'json',
            success: function (result) {
                if (result.code != 200) {
                    return layer.msg(result.msg);
                }
                if(data.elem.checked) {
                    layer.msg("设置热门成功！");
                } else {
                    layer.msg("取消热门成功！");
                }
            }
        });
        // setTimeout(function(){
        //     layer.close(index);
        //     if(data.elem.checked){
        //         layer.msg("置顶成功！");
        //     }else{
        //         layer.msg("取消置顶成功！");
        //     }
        // },500);
    });

	//是否推荐
	form.on('switch(newsRecommend)', function(data){
		var _id = $(this).data('key');
		var _recommend = $(this).data('recommend');

		var index = layer.msg('修改中，请稍候',{icon: 16, time:false, shade:0.8});
		$.ajax({
			type: 'post',
			url: '/adm/article/setRecommend',
			data: {id: _id, recommend: 1 - _recommend},
			dataType: 'json',
			success: function (result) {
				if (result.code != 200) {
					return layer.msg(result.msg);
				}
				if(data.elem.checked) {
					layer.msg("推荐成功！");
				} else {
					layer.msg("取消推荐成功！");
				}
			}
		});
	});

    //搜索【此功能需要后台配合，所以暂时没有动态效果演示】
    $(".search_btn").on("click",function(){
        if($(".searchVal").val() != '' || $('.category_id').val() > 0){
            table.reload("newsListTable",{
                page: {
                    curr: 1 //重新从第 1 页开始
                },
                where: {
                    key: $(".searchVal").val()  //搜索的关键字
                    ,category_id: $('.category_id').val()
                }
            })
        }else{
            layer.msg("请输入搜索的内容");
        }
    });

    //添加文章
    function addNews(edit){
        var index = layui.layer.open({
            title : "添加文章",
            type : 2,
            content : "/adm/article/create",
            success : function(layero, index){
                var body = layui.layer.getChildFrame('body', index);

                setTimeout(function(){
                    layui.layer.tips('点击此处返回文章列表', '.layui-layer-setwin .layui-layer-close', {
                        tips: 3
                    });
                },500)
            }
        })
        layui.layer.full(index);
        //改变窗口大小时，重置弹窗的宽高，防止超出可视区域（如F12调出debug的操作）
        $(window).on("resize",function(){
            layui.layer.full(index);
        })
    }

    //添加文章
    function editNews(edit){
        console.log(edit);
        var index = layui.layer.open({
            title : "修改文章",
            type : 2,
            content : "/adm/article/edit?id=" + edit.id,
            success : function(layero, index){
                var body = layui.layer.getChildFrame('body', index);

                setTimeout(function(){
                    layui.layer.tips('点击此处返回文章列表', '.layui-layer-setwin .layui-layer-close', {
                        tips: 3
                    });
                },500)
            }
        })
        layui.layer.full(index);
        //改变窗口大小时，重置弹窗的宽高，防止超出可视区域（如F12调出debug的操作）
        $(window).on("resize",function(){
            layui.layer.full(index);
        })
    }

    $(".addNews_btn").click(function(){
        addNews();
    });

    //批量删除
    $(".delAll_btn").click(function(){
        var checkStatus = table.checkStatus('newsListTable'),
            data = checkStatus.data,
            newsId = [];
        if(data.length > 0) {
            for (var i in data) {
                newsId.push(data[i].id);
            }

            layer.confirm('确定删除选中的文章？', {icon: 3, title: '提示信息'}, function (index) {

                $.ajax({
                    type: 'GET',
                    url: '/adm/article/delete',
                    data: {ids: newsId},
                    success: function (result) {
                        layer.msg('删除成功！');

                        tableIns.reload();
                        layer.close(index);
                    }
                });
            })
        }else{
            layer.msg("请选择需要删除的文章");
        }
    });

    //列表操作
    table.on('tool(newsList)', function(obj){
        var layEvent = obj.event,
            data = obj.data;

        if(layEvent === 'edit'){ //编辑
            editNews(data);
        } else if(layEvent === 'del'){ //删除
            layer.confirm('确定删除此文章？',{icon:3, title:'提示信息'},function(index){

                $.ajax({
                    type: 'GET',
                    url: '/adm/article/delete',
                    data: {ids: data.id},
                    success: function (result) {
                        layer.msg('删除成功！');

                        tableIns.reload();
                        layer.close(index);
                    }
                });
            });
        } else if(layEvent === 'look'){ //预览
            var id = obj.data.id;

        }
    });

});
