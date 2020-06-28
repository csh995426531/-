<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:64:"/data/www/y5g/public/../application/index/view/setting/type.html";i:1593316534;s:48:"/data/www/y5g/application/index/view/layout.html";i:1592482662;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>库存管理系统</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/static/lib/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/lib/layuiadmin/style/admin.css" media="all">

    <script>
        /^http(s*):\/\//.test(location.href) || alert('请先部署到 localhost 下再访问');
    </script>
    <script src="/static/lib/layuiadmin/layui/layui.js"></script>
    <script>
        layui.config({
            base: '/static/lib/layuiadmin/' //静态资源所在路径
        }).extend({
            index: 'lib/index' //主入口模块
        }).use(['index', 'admin', 'carousel']);
    </script>
</head>

    <div class="layui-fluid">
        <div class="layui-card">
            <!-- 表格 -->
            <div class="layui-card-body">
                <table id="table-list" lay-filter="table-list"></table>
                <script type="text/html" id="toolbarDemo">
                    <div class="layui-btn-container">
                      <button class="layui-btn layui-btn-sm" lay-event="addItem">录入</button>
                    </div>
                </script>
            </div>
        </div>
    </div>
    <script>
        layui.use(['index', 'contlist', 'table', 'jquery'], function () {
            var table = layui.table
            var form = layui.form
            var jquery = layui.jquery
            var $ = layui.jquery

            table.render({
                elem: '#table-list'
                , url: '/setting/typeList' //数据接口
                ,toolbar: '#toolbarDemo' //开启头部工具栏，并为其绑定左侧模板
                , parseData: function (res) { //res 即为原始返回的数据
                    return {
                        "code": 0, //解析接口状态
                        "msg": res.message, //解析提示文本
                        "count": res.total, //解析数据长度
                        "data": res.data //解析数据列表
                    };
                }, page: true //开启分页
                , cols: [[ //表头
                    { field: 'id', title: 'ID', minWidth: 60, sort: true, fixed: 'left' }
                    , {
                        field: 'category', title: '类别', minWidth: 80,templet: function(d){
                        if(d.category != null){return d.category.data} else {return ''}
                    }}
                    , {
                        field: 'itemName', title: '名称', minWidth: 80,templet: function(d){
                        if(d.itemName != null){return d.itemName.data} else {return ''}
                    }}
                    , {
                        field: 'itemNetwork', title: '网络模式', minWidth: 80,templet: function(d){
                        if(d.itemNetwork != null){return d.itemNetwork.data} else {return ''}
                    }}
                    , {
                        field: 'data', title: '型号值', minWidth: 80
                    }
                    , {
                        fixed: 'right', title: '操作', minWidth: 100, templet: function (d) {
                            if (d.status == 1) {
                                var str = '<a class="layui-btn-sm layui-btn layui-btn-danger" onclick="stopItem(this,' + d.id + ')" data-href="/setting/delType?id=' + d.id + '" >停用</a>';
                            } else {
                                var str = '<a class="layui-btn-sm layui-btn" onclick="openItem(this,' + d.id + ')" data-href="/setting/openType?id=' + d.id + '" >启用</a>';
                            }
                            return str += '<a class="layui-btn-sm layui-btn layui-btn-normal" onclick="edit(this,' + d.id + ')" data-href="/popup/type?id=' + d.id + '" >修改</a>';
                        }
                    }
                ]]
            });

            //头工具栏事件
            table.on('toolbar(table-list)', function(obj){
                var checkStatus = table.checkStatus(obj.config.id);
                var data = checkStatus.data;
                var arr = new Array();
                layui.$.each(data, function(k, v){
                    arr. push(v.id);
                })

                switch(obj.event){
                    case 'addItem':
                        var url = '/popup/type';
                        layer.open({
                            type: 2
                            , title: '录入'
                            , content: [url, 'no']
                            , maxmin: true
                            , area: ['80%', '50%']
                            , yes: function (index, layero) {
                                //点击确认触发 iframe 内容中的按钮提交
                                var submit = layero.find('iframe').contents().find("#save");
                                submit.click();
                            }
                        });
                    break;
                    //自定义头工具栏右侧图标 - 提示
                    case 'LAYTABLE_TIPS':
                        layer.alert('这是工具栏右侧自定义的一个图标按钮');
                    break;
                };
            });

        })

        //修改
        function edit(obj,id) {
            layer.open({
                type: 2
                , title: '修改'
                , content: [layui.$(obj).data('href'), 'no']
                , maxmin: true
                , area: ['80%', '50%']
                , yes: function (index, layero) {
                    //点击确认触发 iframe 内容中的按钮提交
                    var submit = layero.find('iframe').contents().find("#save");
                    submit.click();
                }
            });
        }

        //启用
        function openItem(obj, id) {
            layer.confirm('确认要启用吗？', function (index) {
                //发异步
                var url = layui.$(obj).data('href');
                layui.$.post(url, { id: id}, function (res) {
                    layer.msg("success!", {
                        icon: 1,
                        time: 1000
                    }, function (index) {
                        layui.table.reload('table-list'); //重载表格
                        layer.close(index); //再执行关闭 
                    })
                });
                return false;
            });
        }

        //停用
        function stopItem(obj, id) {
            layer.confirm('确认要停用吗？', function (index) {
                //发异步
                var url = layui.$(obj).data('href');
                layui.$.post(url, { id: id}, function (res) {
                    layer.msg("success!", {
                        icon: 1,
                        time: 1000
                    }, function (index) {
                        layui.table.reload('table-list'); //重载表格
                        layer.close(index); //再执行关闭 
                    })
                });
                return false;
            });
        }
    </script>

</html>