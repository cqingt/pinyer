layui.use(['form','layer','layedit','laydate','upload'],function(){
    var form = layui.form
        layer = parent.layer === undefined ? layui.layer : top.layer,
        laypage = layui.laypage,
        upload = layui.upload,
        layedit = layui.layedit,
        laydate = layui.laydate,
        $ = layui.jquery;

    //用于同步编辑器内容到textarea
   // layedit.sync(editIndex);

    //上传缩略图
    upload.render({
        elem: '.thumbBox',
        url: '/adm/upload/index',
      //  method : "get",  //此处是为了演示之用，实际使用中请将此删除，默认用post方式提交
        done: function(res, index, upload){
            if (res.code == 0) {
                $('#thumb').val(res.data.filename);
                $('.thumbImg').attr('src', res.data.filename);
            } else {
                layer.msg(res.msg);
            }

            $('.thumbBox').css("background","#fff");
        }
    });

    //格式化时间
    function filterTime(val){
        if(val < 10){
            return "0" + val;
        }else{
            return val;
        }
    }
    //定时发布
    var time = new Date();
    var submitTime = time.getFullYear()+'-'+filterTime(time.getMonth()+1)+'-'+filterTime(time.getDate())+' '+filterTime(time.getHours())+':'+filterTime(time.getMinutes())+':'+filterTime(time.getSeconds());
    laydate.render({
        elem: '#release',
        type: 'datetime',
        trigger : "click",
        done : function(value, date, endDate){
            submitTime = value;
        }
    });
    form.on("radio(release)",function(data){
        if(data.elem.title == "定时发布"){
            $(".releaseDate").removeClass("layui-hide");
            $(".releaseDate #release").attr("lay-verify","required");
        }else{
            $(".releaseDate").addClass("layui-hide");
            $(".releaseDate #release").removeAttr("lay-verify");
            submitTime = time.getFullYear()+'-'+(time.getMonth()+1)+'-'+time.getDate()+' '+time.getHours()+':'+time.getMinutes()+':'+time.getSeconds();
        }
    });

    form.verify({
        title : function(val){
            if(val == ''){
                return "文章标题不能为空";
            }
        },
        keywords : function(val){
            if(val == ''){
                return "关键词不能为空";
            }
        },
        description : function(val){
            if(val == ''){
                return "描述不能为空";
            }
        },
        abstract : function(val){
            if(val == ''){
                return "文章摘要不能为空";
            }
        },
        // content : function(val){
        //     if(val == ''){
        //         return "文章内容不能为空";
        //     }
        // }
    });


    $('.cancel-window').on('click', function () {
        layer.closeAll("iframe");
        parent.location.reload();
    });

    layedit.set({
        uploadImage: {
            url: '/adm/upload/index' //接口url
            ,type: 'post' //默认post
        }
    });

    //创建一个编辑器
    //var editIndex = layedit.build('news_content');
});