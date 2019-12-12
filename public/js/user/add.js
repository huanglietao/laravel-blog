/**
 * Created by yly on 2019/12/11.
 */

$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
layui.use('table', function(){
    var form  = layui.form ;
    //监听提交
    form.on('submit(formDemo)', function(data){
        //修改操作
            var name = data.field.name;
            var message = data.field.message;
            var email = data.field.email;
            var phone = data.field.phone;
            var user_id = data.field.user_id;
            var _token = data.field._token;
            var pid = data.field.pid;
            var password = data.field.password;
            var repassword = data.field.repassword;

            $.ajax({
                url: "/add",
                type: "POST",
                dataType: "JSON",
                data: {
                    'name': name,
                    'message':message,
                    'email':email,
                    'phone':phone,
                    'user_id':user_id,
                    'pid':pid,
                    '_token':_token,
                    'password':password,
                    'repassword':repassword,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function (data) {
                    if (data.code==1){
                        layer.msg("添加成功")
                        setTimeout(function () {
                            // 获得frame索引
                            var index = parent.layer.getFrameIndex(window.name);
                            //关闭当前frame
                            parent.layer.close(index);
                            //判断是否需要刷新整个页面
                                parent.location.reload();

                        }, 1000);
                    }else{
                        if (data.error){
                            if ($(".alert-danger")){
                                $(".alert-danger").remove();
                            }

                            var html = '<div class="alert alert-danger"><ul style="color:red;">'
                            $.each(data.error,function(index,value){
                                html += '<li>'+value+'</li>'
                            });
                            html += '</ul></div>'
                            $(".mx-auto").prepend(html);
                        }else{
                            layer.msg("添加失败,请重新尝试")
                        }

                    }
                }
            });
        return false;
    }
    );
});
