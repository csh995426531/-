<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:63:"/data/www/y5g/public/../application/index/view/item/search.html";i:1590831923;s:48:"/data/www/y5g/application/index/view/layout.html";i:1589513789;}*/ ?>
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
                <select name="category_id" id='category_id' lay-filter="category_id" data-href="<?php echo url('/index/item/changeCategory'); ?>">
                    <option value=""> - 分类 - </option>
                    <?php foreach($categories as $category): ?>
                    <option value="<?php echo $category['data']; ?>" <?php echo \think\Request::instance()->get('category_id')==$category['data']?'selected' :''; ?>><?php echo $category['data']; ?></opion>
                    <?php endforeach; ?>
                </select>
            </div>
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
                <select name="edition_id" id='edition_id'>
                    <option value=""> - 固件版本 - </option>
                    <?php foreach($editions as $edition): ?>
                    <option value="<?php echo $edition['data']; ?>" <?php echo \think\Request::instance()->get('edition_id')==$edition['data']?'selected' :''; ?>><?php echo $edition['data']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="layui-inline">
                <select name="channel_id">
                    <option value=""> - 进货渠道 - </option>
                    <?php foreach($channels as $channel): ?>
                    <option value="<?php echo $channel['data']; ?>" <?php echo \think\Request::instance()->get('channel_id')==$channel['data']?'selected' :''; ?>><?php echo $channel['data']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="layui-inline">
                <input class="layui-input" placeholder="进货日期" name="date" type="text" id="date"
                        lay-verify="required" autocomplete="off">
            </div>
            <div class="layui-inline">
                <select name="status">
                    <option value=""> - 状态 - </option>
                    <?php if(is_array($statuses) || $statuses instanceof \think\Collection || $statuses instanceof \think\Paginator): if( count($statuses)==0 ) : echo "" ;else: foreach($statuses as $k=>$status): ?>
                    <option value="<?php echo $k; ?>" <?php echo \think\Request::instance()->get('status')==$k?'selected' :''; ?>><?php echo $status; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
              <div class="layui-inline">
                  <input type="text" name="keyword"  placeholder="序列号" value="<?php echo \think\Request::instance()->get('keyword'); ?>" autocomplete="off" class="layui-input">
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
          <!-- <script type="text/html" id="barDemo">
              <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">查看</a>
              <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
              <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
            </script> -->
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
              ,url: '/index/item/searchList' //数据接口
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
                  ,{field: 'date', title: '进货日期', minWidth:80,templet: function(d){
                      return d.date;
                  }}
                  ,{field: 'itemCategory', title: '分类', minWidth:120,templet: function(d){
                      if(d.itemCategory != null){return d.itemCategory.data} else {return ''}
                  }}
                  ,{field: 'itemName', title: '名称', minWidth:120,templet: function(d){
                      if(d.itemType != null){
                          return '<div title="' + d.memo +'" style="cursor: pointer">' + d.itemName.data + '</div>'
                      } else {return ''}
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
                  ,{field: 'itemEdition', title: '版本', minWidth: 120,templet: function(d){
                      if(d.itemEdition != null){return d.itemEdition.data} else {return ''}
                  }}
                  ,{field: 'number', title: '序列号', minWidth: 150,templet: function(d){
                      return '<a lay-text="综合查询" target="_blank" href="https://checkcoverage.apple.com/cn/zh/?sn=' + d.number + '"><span style="color:coral;cursor: pointer;">' + d.number +'</span></a>';
                  }}
                  ,{field: 'itemChannel', title: '进货渠道', minWidth: 120, sort: true,templet: function(d){
                    if(d.itemChannel != null){return d.itemChannel.data} else {return ''}
                  }}
                  ,{field: 'memo', title: '商品备注', minWidth: 120, sort: true,templet: function(d){
                    return '<div title="' + d.memo + '" style="cursor: pointer">' + d.memo + '</div>';
                  }}
                  ,{field: 'price', title: '进价', minWidth: 120, sort: true,templet: function(d){
                      return (d.price*1).toFixed(2);
                  }}
                  ,{field: 'lastOutNo', title: '最近订单号', minWidth: 120, sort: true,templet: function(d){
                      return d.lastOutNo;
                  }}
                  ,{fixed: 'right', title: '状态[历史]', minWidth: 120, sort: true,templet: function(d){
                    return '<a class="layui-btn layui-btn-normal layui-btn-sm" onclick="status_history(this,' + d.id + ')" data-href="/index/item/history?item_id=' + d.id + '">' + d.statusName + '</a>';
                  }}
              ]]
          });
  
          //监听选择名称
          form.on('select(name_id)',
              function(obj) {
                  var val = obj.value;
                  var data;
                  if (val != '') {
                      var url = obj.elem.getAttribute('data-href');
                      layui.$.get(url, {name:val}, function(res){
                          data = res.data;
                          reset(data);
                      })
                  } else {
                      data = jquery.parseJSON($layui.$("#data-all").html());
                      reset(data);
                  }
              }
          );

          form.on('select(category_id)',
            function(obj) {
                var val = obj.value;
                var data;
                if (val != '') {
                    var url = obj.elem.getAttribute('data-href');
                    layui.$.get(url, {category:val}, function(res){
                        data = res.data;
                        reset(data);
                        var types_str = '<option value=""> - 型号 - </option>';
                        layui.$.each(data.types,function(k,v){
                            types_str += '<option value="'+v.data+'"> '+v.data+' </option>';
                        })

                        var names_str = '<option value=""> - 名称 - </option>';
                        layui.$.each(data.names,function(k,v){
                            names_str += '<option value="'+v.data+'"> '+v.data+' </option>';
                        })

                        layui.$('#type_id').html(types_str);
                        layui.$('#name_id').html(names_str);
                        layui.form.render('select');
                    })
                } else {
                    data = jquery.parseJSON($("#data-all").html());
                    reset(data);

                    var types_str = '<option value=""> - 型号 - </option>';
                    layui.$.each(data.types,function(k,v){
                        types_str += '<option value="'+v.data+'"> '+v.data+' </option>';
                    })

                    var names_str = '<option value=""> - 名称 - </option>';
                    layui.$.each(data.names,function(k,v){
                        names_str += '<option value="'+v.data+'"> '+v.data+' </option>';
                    })

                    layui.$('#type_id').html(types_str);
                    layui.$('#name_id').html(names_str);
                    layui.form.render('select');
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
          ,area: ['90%', '50%']
        });
      }

    </script>
</html>