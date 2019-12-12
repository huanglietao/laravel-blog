/**
 * Created by yly on 2019/12/11.
 */

$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
layui.use('table', function(){
    var table = layui.table;

    //方法级渲染
    table.render({
        elem: '#LAY_table_user'
        ,async: false
        ,url: 'user/getChild'
        ,page: { //支持传入 laypage 组件的所有参数（某些参数除外，如：jump/elem） - 详见文档
            layout: ['limit'] //自定义分页布局
            //,curr: 5 //设定初始在第 5 页
            , groups: 1 //只显示 1 个连续页码
            , first: false //不显示首页
            , last: false //不显示尾页
        }

            ,cols: [[
            {field:'id', title: 'ID',sort:true}
            ,{field:'name', title: '用户名'}
            ,{field:'message', title: '信息'}
            ,{field:'phone', title: '电话'}
            ,{field:'create_at', title: '创建时间'}
            ,{fixed: 'right', title:'操作', toolbar: '#barDemo', width:150}
        ]]
        ,id: 'testReload'






    });

    var $ = layui.$, active = {
        reload: function(){
            var demoReload = $('#demoReload');

            //执行重载
            table.reload('testReload', {
                page: {
                    curr: 1 //重新从第 1 页开始
                }
                ,where: {
                    search: {
                        name: demoReload.val()
                    }
                }
            }, 'data');
        }
    };

    //监听行工具事件
    table.on('tool(user)', function(obj){ //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
        var data = obj.data //获得当前行数据
            ,layEvent = obj.event; //获得 lay-event 对应的值


        if(layEvent === 'edit'){
            layer.open({
                type: 2,
                title:"编辑",
                content: ['/detail/'+data.id,'no'], //这里content是一个URL，如果你不想让iframe出现滚动条，你还可以content: ['http://sentsin.com', 'no']
                area: ['800px', '800px']
            });
        } else if(layEvent === 'del'){
            layer.confirm('真的删除行么', function(index){
                console.log(index);
                //删除操作
                $.ajax({
                    url: "/delUser",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        ids:data.id
                    },
                    success: function (data) {

                        $('.demoTable .layui-btn').trigger("click");
                    }
                });

                layer.close(index);
                //向服务端发送删除指令
            });
        } else if(layEvent === 'edit'){
            layer.msg('编辑操作');
        }
    });



    table.on('click','.btn-del', function(obj){
        console.log(obj);
        return;
        var data = obj.data;
        console.log(obj)
        if(obj.event === 'del'){
            layer.confirm('真的删除行么', function(index){
                obj.del();
                layer.close(index);
            });
        } else if(obj.event === 'edit'){
            layer.prompt({
                formType: 2
                ,value: data.email
            }, function(value, index){
                obj.update({
                    email: value
                });
                layer.close(index);
            });
        }
    });


    $('.demoTable .layui-btn').on('click', function(){
        var type = $(this).data('type');
        active[type] ? active[type].call(this) : '';
    });

    //修改当前会员的个人信息
    $(".master-edit-btn").click(function () {
        var id = $(this).attr("data-id");
        layer.open({
            type: 2,
            title:"编辑",
            content: ['/detail/'+id+"/1"], //这里content是一个URL，如果你不想让iframe出现滚动条，你还可以content: ['http://sentsin.com', 'no']
            area: ['800px', '800px']
        });
    })

    //添加下级会员
    $(".user-add").click(function () {
        layer.open({
            type: 2,
            title:"添加",
            content: ['/addUser'], //这里content是一个URL，如果你不想让iframe出现滚动条，你还可以content: ['http://sentsin.com', 'no']
            area: ['800px', '800px']
        });
    })

    //退出登录
    $(".master-login-out").click(function () {
        layer.confirm('确定退出当前账号嘛', function(index){
            window.location.href="/login_out"
        });
    })


});
