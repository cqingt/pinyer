layui.use(['form','layer','laydate','table','laytpl'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery,
        laydate = layui.laydate,
        laytpl = layui.laytpl,
        table = layui.table;

    //添加验证规则
    form.verify({
        oldPwd : function(value, item){
            if(value.length != 6){
                return "密码错误，请重新输入！";
            }
        },
        newPwd : function(value, item){
            if(value.length < 6){
                return "密码长度不能小于6位";
            }
        },
        confirmPwd : function(value, item){
            if(!new RegExp($("#oldPwd").val()).test(value)){
                return "两次输入密码不一致，请重新输入！";
            }
        }
    });

    form.on("submit(changePwd)",function(data){
        $.ajax({
            type: 'post',
            url: '/adm/user/changePwd',
            data: {
                password: data.field.password,
                new_password: data.field.new_password,
                new_repassword: data.field.new_repassword,
            },
            dataType: 'json',
            success: function (result) {
                if (result.code == 200) {
                    layer.msg('密码更新成功！');
                    setTimeout(function () {
                        top.window.location.href = '/adm/login/logout';
                    }, 500)
                } else {
                    layer.msg(result.msg);
                }
            }
        });
    });

    //控制表格编辑时文本的位置【跟随渲染时的位置】
    $("body").on("click",".layui-table-body.layui-table-main tbody tr td",function(){
        $(this).find(".layui-table-edit").addClass("layui-"+$(this).attr("align"));
    });

})