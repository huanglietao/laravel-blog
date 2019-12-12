/**
 * Created by yly on 2019/12/11.
 */

$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
layui.use('table', function(){
    var table = layui.table;

    //方法级渲染
    table.render({
        elem: '#LAY_table_user'
        ,url: 'user/getChild'
        ,cols: [[
            {field:'id', title: 'ID',sort:true}
            ,{field:'name', title: '用户名'}
            ,{field:'message', title: '信息'}
            ,{field:'phone', title: '电话'}
            ,{field:'create_at', title: '创建时间'}
            ,{fixed: 'right', title:'操作', toolbar: '#barDemo', width:150}
        ]]
        ,id: 'testReload'
        ,page: true
        ,height: 310
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
});
