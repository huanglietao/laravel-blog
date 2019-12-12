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

            $.ajax({
                url: "/edit",
                type: "POST",
                dataType: "JSON",
                data: {
                    'name': name,
                    'message':message,
                    'email':email,
                    'phone':phone,
                    'user_id':user_id,
                    '_token':_token,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function (data) {
                    if (data.code==1){
                        layer.msg("修改成功")
                        setTimeout(function () {
                            // 获得frame索引
                            var index = parent.layer.getFrameIndex(window.name);
                            //关闭当前frame
                            parent.layer.close(index);
                            //刷新页面
                            parent.location.reload();
                        }, 2000);
                    }else{
                        layer.msg("修改失败,请重新尝试")

                    }
                }
            });
            return false;
    }
    );
});
