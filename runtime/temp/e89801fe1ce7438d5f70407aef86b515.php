<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:62:"/data/www/y5g/public/../application/index/view/item/outgo.html";i:1590217786;s:48:"/data/www/y5g/application/index/view/layout.html";i:1589513789;}*/ ?>
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
        }).use('index');
    </script>
</head>

    <div class="layui-fluid">
        <div class="layui-card">
          <div class="layui-form layui-card-header layuiadmin-card-header-auto">
            <div class="layui-form-item">
                <div class="layui-inline">
                    <select name="type_id" id='type_id'>
                        <option value=""> - 型号 - </option>
                        <?php foreach($types as $type): ?>
                        <option value="<?php echo $type['data']; ?>" <?php echo \think\Request::instance()->get('type_id')==$type['data']?'selected' :''; ?>><?php echo $type['data']; ?></opion>
                        <?php endforeach; ?>
                    </select>
                </div>
                <span id="data-all" style="display:none"><?php echo json_encode($data); ?></span>
                <div class="layui-inline">
                    <select id="name_id" name="name_id" lay-filter="name_id" data-href="<?php echo url('/index/item/changeName'); ?>">
                        <option value=""> - 名称 - </option>
                        <?php foreach($names as $name): ?>
                        <option value="<?php echo $name['data']; ?>" <?php echo \think\Request::instance()->get('name_id')==$name['data']?'selected' :''; ?>><?php echo $name['data']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="layui-inline">
                    <select id="network_id" name="network_id">
                        <option value=""> - 网络模式 - </option>
                        <?php foreach($networks as $network): ?>
                        <option value="<?php echo $network['data']; ?>" <?php echo \think\Request::instance()->get('network_id')==$network['data']?'selected' :''; ?>><?php echo $network['data']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="layui-inline">
                    <select  id="feature_id"name="feature_id" lay-filter="feature_id" class="form-control">
                        <option value=""> - 配置 - </option>
                        <?php foreach($features as $feature): ?>
                            <option value="<?php echo $feature['data']; ?>" <?php echo \think\Request::instance()->get('feature_id')==$feature['data']?'selected' :''; ?>><?php echo $feature['data']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="layui-inline">
                    <select id="appearance_id" name="appearance_id">
                        <option value=""> - 外观 - </option>
                        <?php foreach($appearances as $appearance): ?>
                            <option value="<?php echo $appearance['data']; ?>" <?php echo \think\Request::instance()->get('appearance_id')==$appearance['data']?'selected' :''; ?>><?php echo $appearance['data']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="layui-inline">
                    <input type="text" name="keyword"  placeholder="序列号" value="<?php echo \think\Request::instance()->get('keyword'); ?>" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-inline">
                    <select name="is_prepare" id="is_prepare">
                        <option value=""> - 预售 - </option>
                        <option value="1" >-  是 - </option>
                        <option value="0" >-  否 - </option>
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
                ,url: '/index/item/outgoList' //数据接口
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
                    ,{field: 'date', title: '入库时间', minWidth:120,templet: function(d){
                        return d.date;
                    }}
                    ,{field: 'itemType', title: '型号', minWidth:120,templet: function(d){
                        if(d.itemType != null){return d.itemType.data} else {return ''}
                    }}
                    ,{field: 'itemName', title: '名称', minWidth:120,templet: function(d){
                        if(d.itemName != null){return d.itemName.data} else {return ''}
                    }} 
                    ,{field: 'itemNetwork', title: '网络模式', minWidth: 120,templet: function(d){
                        if(d.itemNetwork != null){return d.itemNetwork.data} else {return ''}
                    }}
                    ,{field: 'itemFeature', title: '配置', minWidth: 120,templet: function(d){
                        if(d.itemFeature != null){return d.itemFeature.data} else {return ''}
                    }}
                    ,{field: 'itemAppearance', title: '外观', minWidth: 120,templet: function(d){
                        if(d.itemAppearance != null){return d.itemAppearance.data} else {return ''}
                    }}
                    ,{field: 'number', title: '序列号', minWidth: 170,templet: function(d){
                        return '串号:<a target="_blank" href="https://checkcoverage.apple.com/cn/zh/?sn=' + d.number + '"><span style="color:coral;cursor: pointer;">' + d.number +'</span></a>';
                    }}
                    ,{field: 'itemEdition', title: '版本', minWidth: 120,templet: function(d){
                        if(d.itemEdition != null){return d.itemEdition.data} else {return ''}
                    }}
                    ,{field: 'itemChannel', title: '进货渠道', minWidth: 120, sort: true,templet: function(d){
                      if(d.itemChannel != null){return d.itemChannel.data} else {return ''}
                    }}
                    ,{field: 'price', title: '进价', minWidth: 120, sort: true,templet: function(d){
                        return (d.price*1).toFixed(2);
                    }}
                    ,{field: 'memo', title: '商品备注', minWidth:80,templet: function(d){
                        return d.memo;
                    }}
                    ,{field: 'history', title: '状态[全]', minWidth:120,templet: function(d){
                        return '<a title="' + d.prepare + '" style="cursor: pointer" class="layui-btn layui-btn-normal layui-btn-sm" onclick="status_history(this,' + d.id + ')" data-href="/index/item/history?item_id=' + d.id + '">' + d.statusName + '</a>';
                    }}
                    ,{fixed: 'right', title: '操作', minWidth: 120, sort: true,templet: function(d){
                      if (d.status == 2 || d.status == 8) {
                        return '<a class="layui-btn layui-btn-sm" onclick="add_outgo(this,' + d.id + ')" data-value="1" data-href="/index/item/addIncome?id=' + d.id + '">出库</a>';
                      } else {
                        return ''
                      }
                    }}
                ]]
            });
    
            //监听选择名称
            form.on('select(name_id)',
                function (obj) {
                    var val = obj.value;
                    var data;
                    if (val != '') {
                        var url = obj.elem.getAttribute('data-href');
                        layui.$.get(url, { name: val }, function (res) {
                            data = res.data;
                            reset(data);
                        })
                    } else {
                        data = jquery.parseJSON(layui.$("#data-all").html());
                        reset(data);
                    }
                }
            );

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

      //重置对应的网络模式
      function reset(data){
          var features_str = '<option value=""> - 配置 - </option>';
          // $("select[name=feature_id]").append(features_str);
          layui.$.each(data.features,function(k,v){
              features_str += '<option value="'+v.data+'"> '+v.data+' </option>';
          })
  
          var networks_str = '<option value=""> - 网络模式 - </option>';
          layui.$.each(data.networks,function(k,v){
              networks_str += '<option value="'+v.data+'"> '+v.data+' </option>';
          })
  
          var appearances_str = '<option value=""> - 外观 - </option>';
          layui.$.each(data.appearances,function(k,v){
              appearances_str += '<option value="'+v.data+'"> '+v.data+' </option>';
          })
  
          layui.$('#feature_id').html(features_str);
          layui.$('#network_id').html(networks_str);
          layui.$('#appearance_id').html(appearances_str);
          layui.form.render('select');
      }

      //状态历史
      function status_history(obj,id) {
        layer.open({
          type: 2
          ,title: '状态历史'
          ,content:  [layui.$(obj).data('href'), 'no']
          ,maxmin: true
          ,area: ['900px', '600px']
        });
      }
  
      </script>
</html>