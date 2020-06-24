<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:70:"/data/www/y5g/public/../application/index/view/item/return_income.html";i:1590216256;s:48:"/data/www/y5g/application/index/view/layout.html";i:1592482662;}*/ ?>
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
                  <input type="text" name="keyword" placeholder="序列号/订单号/收货人昵称" value="<?php echo \think\Request::instance()->get('keyword'); ?>"
                  autocomplete="off" class="layui-input">
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
          </div>
        </div>
      </div>
      
      <script>
        layui.use(['index', 'contlist', 'table', 'jquery'], function(){
            var table = layui.table
            var form = layui.form
            var jquery = layui.jquery
            var $ = layui.jquery

            table.render({
                elem: '#table-list'
                ,url: '/index/item/returnIncomeList' //数据接口
                ,parseData: function(res){ //res 即为原始返回的数据
                    return {
                    "code": 0, //解析接口状态
                    "msg": res.message, //解析提示文本
                    "count": res.total, //解析数据长度
                    "data": res.data //解析数据列表
                    };
                },page: true //开启分页
                ,cols: [[ //表头
                    {field: 'id', title: 'ID', minWidth:60, sort: true, fixed: 'left'}
                    ,{field: 'itemName', title: '名称', minWidth:120,templet: function(d){
                        if(d.item != null && d.item.itemName != null){return d.item.itemName.data} else {return ''}
                    }} 
                    ,{field: 'itemNetwork', title: '网络模式', minWidth: 120,templet: function(d){
                        if(d.item != null && d.item.itemNetwork != null){return d.item.itemNetwork.data} else {return ''}
                    }}
                    ,{field: 'itemFeature', title: '配置', minWidth: 120,templet: function(d){
                        if(d.item != null && d.item.itemFeature != null){return d.item.itemFeature.data} else {return ''}
                    }}
                    ,{field: 'itemAppearance', title: '外观', minWidth: 120,templet: function(d){
                        if(d.item != null && d.item.itemAppearance != null){return d.item.itemAppearance.data} else {return ''}
                    }}
                    ,{field: 'number', title: '序列号', minWidth: 150,templet: function(d){
                        return '<a target="_blank" href="https://checkcoverage.apple.com/cn/zh/?sn=' + d.item.number + '"><span style="color:coral;cursor: pointer;">' + d.item.number +'</span></a>';
                    }}
                    ,{field: 'itemEdition', title: '版本', minWidth: 120,templet: function(d){
                        if(d.item != null && d.item.itemEdition != null){return d.item.itemEdition.data} else {return ''}
                    }}
                    ,{field: 'memo', title: '备注', minWidth: 120, sort: true,templet: function(d){
                        return d.memo;
                    }}
                    ,{field: 'price', title: '销售价格', minWidth: 120, sort: true,templet: function(d){
                        return (d.price*1).toFixed(2);
                    }}
                    ,{field: 'itemChannel', title: '出货途径', minWidth: 120, sort: true,templet: function(d){
                        if(d.itemChannel != null){return d.itemChannel.data} else {return ''}
                    }}
                    ,{field: 'createUser', title: '出货人', minWidth: 120, sort: true,templet: function(d){
                        if(d.createUser != null){return d.createUser.data} else {return ''}
                    }}
                    ,{field: 'create_time', title: '出货时间', minWidth: 120, sort: true,templet: function(d){
                        return d.create_time;
                    }}
                    ,{field: 'order_no', title: '订单号', minWidth: 120, sort: true,templet: function(d){
                        return d.order_no;
                    }}
                    ,{fixed: 'right', title: '操作', minWidth: 120, sort: true,templet: function(d){
                        return '<a class="layui-btn layui-btn-sm" onclick="return_income(this,' + d.id + ')" data-value="1" data-href="/index/item/addReturnIncome?id=' + d.id + '">退货入库</a>';
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
    
        });
        
        //退货入库
        function return_income(obj, id) {
            layer.confirm('确认要退货入库吗？', function (index) {
                //发异步
                var url = layui.$(obj).data('href');
                layui.$.post(url, { id: id }, function (res) {
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