layui.use(['form','layer','jquery'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery;

    //登录按钮
    form.on("submit(login)",function(data){
        var that = $(this);
        that.text("登录中...").attr("disabled","disabled").addClass("layui-disabled");

        $.ajax({
            url: '/adm/login/enter',
            type: 'post',
            data: $('form').serialize(),
            dataType: 'json',
            success: function (result) {
                if (result.code != 200) {
                    layer.msg(result.msg);

                    that.text("登录").attr("disabled", false).removeClass("layui-disabled");
                    $('.verifyImg').trigger('click');
                } else {
                    layer.msg('登录成功');
                    setTimeout(function(){
                        window.location.href = "/adm/index/";
                    }, 1000);
                }
            }
        });

        return false;
    });

    //表单输入效果
    $(".loginBody .input-item").click(function(e){
        e.stopPropagation();
        $(this).addClass("layui-input-focus").find(".layui-input").focus();
    });

    $(".loginBody .layui-form-item .layui-input").focus(function(){
        $(this).parent().addClass("layui-input-focus");
    });

    $(".loginBody .layui-form-item .layui-input").blur(function(){
        $(this).parent().removeClass("layui-input-focus");
        if($(this).val() != ''){
            $(this).parent().addClass("layui-input-active");
        }else{
            $(this).parent().removeClass("layui-input-active");
        }
    })
});
