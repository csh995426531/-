<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"/data/www/y5g/public/../application/index/view/item/income_agree.html";i:1593316345;s:48:"/data/www/y5g/application/index/view/layout.html";i:1592482662;}*/ ?>
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
          <div class="layui-form layui-card-header layuiadmin-card-header-auto">
            <div class="layui-form-item">
                <div class="layui-inline">
                    <select name="user_id" id='user_id'>
                        <option value=""> - 入库人 - </option>
                        <?php foreach($users as $user): ?>
                        <option value="<?php echo $user['id']; ?>" <?php echo \think\Request::instance()->get('user_id')==$user['id']?'selected' :''; ?>><?php echo $user['username']; ?></opion>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="layui-inline">
                    <input class="layui-input" placeholder="进货日期" name="date" type="text" id="date" autocomplete="off">
                </div>
                <div class="layui-inline">
                    <select id="name_id" name="name_id">
                        <option value=""> - 名称 - </option>
                        <?php foreach($names as $name): ?>
                        <option value="<?php echo $name['id']; ?>" <?php echo \think\Request::instance()->get('name_id')==$name['id']?'selected' :''; ?>><?php echo $name['data']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="layui-inline">
                    <select  id="channel_id"name="channel_id">
                        <option value=""> - 进货渠道 - </option>
                        <?php foreach($channels as $channel): ?>
                        <option value="<?php echo $channel['id']; ?>" <?php echo \think\Request::instance()->get('channel_id')==$channel['id']?'selected' :''; ?>><?php echo $channel['data']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="layui-inline">
                    <button class="layui-btn layuiadmin-btn-list" lay-submit lay-filter="filter-search">
                    <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
                    </button>
                </div>
              </div>
          </div>
          <!-- 表格 -->
          <div class="layui-card-body">
            <table id="table-list" lay-filter="table-list"></table>
            <script type="text/html" id="toolbarDemo">
                <div class="layui-btn-container">
                  <button class="layui-btn layui-btn-sm" lay-event="batchPass">批量通过</button>
                  <button class="layui-btn layui-btn-sm" lay-event="batchReject">批量拒绝</button>
                </div>
              </script>
          </div>
        </div>
      </div>
      
      <script>
        layui.use(['laydate', 'index', 'contlist', 'table', 'jquery'], function(){
            var table = layui.table
            var form = layui.form
            var jquery = layui.jquery
            var $ = layui.jquery
            var laydate = layui.laydate

            //执行一个laydate实例
            laydate.render({
                elem: '#date' //指定元素
            });

            table.render({
                elem: '#table-list'
                ,url: '/item/incomeAgreeList' //数据接口
                ,title: '入库审核'
                ,toolbar: '#toolbarDemo' //开启头部工具栏，并为其绑定左侧模板
                ,defaultToolbar: ['filter', 'exports', 'print', { //自定义头部工具栏右侧图标。如无需自定义，去除该参数即可
                    title: '提示'
                    ,layEvent: 'LAYTABLE_TIPS'
                    ,icon: 'layui-icon-tips'
                }]
                ,parseData: function(res){ //res 即为原始返回的数据
                    return {
                    "code": 0, //解析接口状态
                    "msg": res.message, //解析提示文本
                    "count": res.total, //解析数据长度
                    "data": res.data //解析数据列表
                    };
                },page: true //开启分页
                ,cols: [[ //表头
                    {type: 'checkbox', fixed: 'left'}
                    ,{field: 'id', title: 'ID', minWidth:60, sort: true}
                    ,{field: 'date', title: '入库类型', minWidth:100,templet: function(d){
                        return d.typeName;
                    }}
                    ,{field: 'itemType', title: '型号', minWidth:100,templet: function(d){
                        if(d.item.itemType != null){return d.item.itemType.data} else {return ''}
                    }}
                    ,{field: 'itemName', title: '名称', minWidth:100,templet: function(d){
                        if(d.item.itemName != null){return d.item.itemName.data} else {return ''}
                    }} 
                    ,{field: 'itemNetwork', title: '网络模式', minWidth: 100,templet: function(d){
                        if(d.item.itemNetwork != null){return d.item.itemNetwork.data} else {return ''}
                    }}
                    ,{field: 'itemFeature', title: '配置', minWidth: 100,templet: function(d){
                        if(d.item.itemFeature != null){return d.item.itemFeature.data} else {return ''}
                    }}
                    ,{field: 'itemAppearance', title: '外观', minWidth: 100,templet: function(d){
                        if(d.item.itemAppearance != null){return d.item.itemAppearance.data} else {return ''}
                    }}
                    ,{field: 'number', title: '序列号', minWidth: 170,templet: function(d){
                        return d.item.number;
                    }}
                    ,{field: 'itemEdition', title: '版本', minWidth: 100,templet: function(d){
                        if(d.item.itemEdition != null){return d.item.itemEdition.data} else {return ''}
                    }}
                    ,{field: 'itemChannel', title: '进货渠道', minWidth: 100, sort: true,templet: function(d){
                      if(d.item.itemChannel != null){return d.item.itemChannel.data} else {return ''}
                    }}
                    ,{field: 'price', title: '进价', minWidth: 120, sort: true,templet: function(d){
                        return (d.item.price*1).toFixed(2);
                    }}
                    ,{field: 'memo', title: '商品备注', minWidth:120,templet: function(d){
                        return d.item.memo;
                    }}
                    ,{field: 'createUser', title: '入库人', minWidth:120,templet: function(d){
                        if(d.createUser != null){return d.createUser.username} else {return ''}
                    }}
                    ,{field: 'createTime', title: '入库时间', minWidth:120,templet: function(d){
                        return d.createTime;
                    }}
                    ,{fixed: 'right', title: '操作', minWidth: 140, sort: true,templet: function(d){
                        var str = '<a class="layui-btn layui-btn-sm" onclick="allowAgree(this,' + d.id + ')" data-value="1" data-href="/item/allowAgree?id=' + d.id + '">通过</a>';
                        return str + '<a class="layui-btn layui-btn-warm layui-btn-sm" onclick="rejectAgree(this,' + d.id + ')" data-value="0" data-href="/item/rejectAgree?id=' + d.id + '">拒绝</a>';
                    }}
                ]]
            });

            //监听搜索
            form.on('submit(filter-search)', function(data){
              var field = data.field;console.log()
              //执行重载
              table.reload('table-list', {
                where: field,
                page: {
                    curr: 1 //重新从第 1 页开始
                }
              });
            });
    
            layui.$('.layui-btn.layuiadmin-btn-list').on('click', function(){
              var type = layui.$(this).data('type');
              active[type] ? active[type].call(this) : '';
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
                    case 'batchPass':
                        var url = '/item/allowAgree';
                        if (arr.length > 0) {
                            $.post(url, {id:arr}, function(res) {
                                layer.msg(res.data, {
                                    icon: 1,
                                    time: 1000
                                }, function (index) {
                                    layui.table.reload('table-list'); //重载表格
                                    layer.close(index); //再执行关闭 
                                })
                            })
                        }
                    break;
                    case 'batchReject':
                        var url = '/item/rejectAgree';
                        if (arr.length > 0) {
                            $.post(url, {id:arr}, function(res) {
                                layer.msg(res.data, {
                                    icon: 1,
                                    time: 1000
                                }, function (index) {
                                    layui.table.reload('table-list'); //重载表格
                                    layer.close(index); //再执行关闭 
                                })
                            })
                        }
                    break;
                    case 'isAll':
                        layer.msg(checkStatus.isAll ? '全选': '未全选');
                    break;
                    
                    //自定义头工具栏右侧图标 - 提示
                    case 'LAYTABLE_TIPS':
                        layer.alert('这是工具栏右侧自定义的一个图标按钮');
                    break;
                };
            });
    
        });

        //通过
        function allowAgree(obj, id) {
            layer.confirm('确认要通过吗？', function (index) {
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
        //拒绝
        function rejectAgree(obj, id) {
            layer.confirm('确认要拒绝吗？', function (index) {
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