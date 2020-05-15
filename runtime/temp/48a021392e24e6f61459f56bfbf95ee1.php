<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:63:"/data/www/y5g/public/../application/index/view/item/search.html";i:1589441482;s:48:"/data/www/y5g/application/index/view/layout.html";i:1589513701;}*/ ?>
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
</head>

    <body>
        <div class="x-nav">
          <span class="layui-breadcrumb">
            <a href="">首页</a>
            <a href="">库存查询</a>
            <a>
              <cite>综合查询</cite></a>
          </span>
          <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload()" title="刷新">
            <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
        </div>
        <div class="layui-fluid">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body ">
                            <form class="layui-form layui-col-space5" method="get">
                                <div class="layui-input-inline layui-show-xs-block">
                                    <select name="category_id" id='category_id' lay-filter="category_id" data-href="<?php echo url('/index/item/changeCategory'); ?>">
                                        <option value=""> - 分类 - </option>
                                        <?php foreach($categories as $category): ?>
                                        <option value="<?php echo $category['data']; ?>" <?php echo \think\Request::instance()->get('category_id')==$category['data']?'selected' :''; ?>><?php echo $category['data']; ?></opion>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="layui-input-inline layui-show-xs-block">
                                    <select name="type_id" id='type_id'>
                                        <option value=""> - 型号 - </option>
                                        <?php foreach($types as $type): ?>
                                        <option value="<?php echo $type['data']; ?>" <?php echo \think\Request::instance()->get('type_id')==$type['data']?'selected' :''; ?>><?php echo $type['data']; ?></opion>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <span id="data-all" style="display:none"><?php echo json_encode($data); ?></span>
                                <div class="layui-input-inline layui-show-xs-block">
                                    <select id="name_id" name="name_id" lay-filter="name_id" data-href="<?php echo url('/index/item/changeName'); ?>">
                                        <option value=""> - 名称 - </option>
                                        <?php foreach($names as $name): ?>
                                        <option value="<?php echo $name['data']; ?>" <?php echo \think\Request::instance()->get('name_id')==$name['data']?'selected' :''; ?>><?php echo $name['data']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="layui-input-inline layui-show-xs-block">
                                    <select id="network_id" name="network_id">
                                        <option value=""> - 网络模式 - </option>
                                        <?php foreach($networks as $network): ?>
                                        <option value="<?php echo $network['data']; ?>" <?php echo \think\Request::instance()->get('network_id')==$network['data']?'selected' :''; ?>><?php echo $network['data']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="layui-input-inline layui-show-xs-block">
                                    <select  id="feature_id"name="feature_id" lay-filter="feature_id" class="form-control">
                                        <option value=""> - 配置 - </option>
                                        <?php foreach($features as $feature): ?>
                                            <option value="<?php echo $feature['data']; ?>" <?php echo \think\Request::instance()->get('feature_id')==$feature['data']?'selected' :''; ?>><?php echo $feature['data']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="layui-input-inline layui-show-xs-block">
                                    <select id="appearance_id" name="appearance_id">
                                        <option value=""> - 外观 - </option>
                                        <?php foreach($appearances as $appearance): ?>
                                            <option value="<?php echo $appearance['data']; ?>" <?php echo \think\Request::instance()->get('appearance_id')==$appearance['data']?'selected' :''; ?>><?php echo $appearance['data']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="layui-input-inline layui-show-xs-block">
                                    <select name="edition_id" id='edition_id'>
                                        <option value=""> - 固件版本 - </option>
                                        <?php foreach($editions as $edition): ?>
                                        <option value="<?php echo $edition['data']; ?>" <?php echo \think\Request::instance()->get('edition_id')==$edition['data']?'selected' :''; ?>><?php echo $edition['data']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="layui-input-inline layui-show-xs-block">
                                    <select name="channel_id">
                                        <option value=""> - 进货渠道 - </option>
                                        <?php foreach($channels as $channel): ?>
                                        <option value="<?php echo $channel['data']; ?>" <?php echo \think\Request::instance()->get('channel_id')==$channel['data']?'selected' :''; ?>><?php echo $channel['data']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="layui-input-inline layui-show-xs-block">
                                    <select name="date">
                                        <option value=""> - 进货日期 - </option>
                                        <?php foreach($dates as $date): ?>
                                        <option value="<?php echo $date; ?>" <?php echo \think\Request::instance()->get('date')==$date?'selected' :''; ?>><?php echo $date; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <!-- <div class="layui-input-inline layui-show-xs-block">
                                    <input class="layui-input" placeholder="开始日" name="start" id="start">
                                </div> -->
                                <div class="layui-input-inline layui-show-xs-block">
                                    <select name="status">
                                        <option value=""> - 状态 - </option>
                                        <?php if(is_array($statuses) || $statuses instanceof \think\Collection || $statuses instanceof \think\Paginator): if( count($statuses)==0 ) : echo "" ;else: foreach($statuses as $k=>$status): ?>
                                        <option value="<?php echo $k; ?>" <?php echo \think\Request::instance()->get('status')==$k?'selected' :''; ?>><?php echo $status; ?></option>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                </div>
                                <div class="layui-inline layui-show-xs-block">
                                    <input type="text" name="keyword"  placeholder="序列号" value="<?php echo \think\Request::instance()->get('keyword'); ?>" autocomplete="off" class="layui-input">
                                </div>
                                <div class="layui-inline layui-show-xs-block">
                                    <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                                </div>
                            </form>
                        </div>
                        <div class="layui-card-body layui-table-body layui-table-main">
                            <table class="layui-table layui-form">
                                <thead>
                                  <tr>
                                    <th>ID</th>
                                    <th>进货日期</th>
                                    <th>商品分类</th>
                                    <th>商品名称</th>
                                    <th>网络模式</th>
                                    <th>配置</th>
                                    <th>外观</th>
                                    <th>序列号</th>
                                    <th>版本</th>
                                    <th>进货渠道</th>
                                    <th>商品备注</th>
                                    <th>进价</th>
                                    <th>最近订单号</th>
                                    <th>状态[历史]</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$temp): $mod = ($i % 2 );++$i;?> 
                                    <tr>
                                        <td><span><?php echo $temp['id']; ?></span></td>
                                        <th><span><?php echo $temp['date']; ?></span></th>
                                        <th><span><?php echo $temp['itemCategory']['data']; ?></span></th>
                                        <th><span><?php echo $temp['itemName']['data']; ?></span></th>
                                        <th><span><?php echo $temp['itemNetwork']['data']; ?></span></th>
                                        <th><span><?php echo $temp['itemFeature']['data']; ?></span></th>
                                        <th><span><?php echo $temp['itemAppearance']['data']; ?></span></th>
                                        <th><a href="https://checkcoverage.apple.com/cn/zh/?sn=<?php echo $temp['number']; ?>" target="_blank"><span><?php echo $temp['number']; ?></span></a></th>
                                        <th><span><?php echo $temp['itemEdition']['data']; ?></span></th>
                                         <th><span><?php echo $temp['itemChannel']['data']; ?></span></th>
                                        <th title="<?php echo $temp['memo']; ?>" style="cursor: pointer"><span><?php echo mb_strlen($temp->memo) > 6 ? mb_substr($temp->memo, 0, 6).'…' : $temp->memo; ?></span></th>
                                        <th><span><?php echo $temp['price']*1; ?></span></th>
                                        <th><span><?php echo $temp['lastOutNo']; ?></span></th>
                                        <td class="actions">
                                            <a class="layui-btn layui-btn-normal layui-btn-sm" href="<?php echo url('/index/item/history',['item_id'=>$temp['id']]); ?>"><?php echo $temp['statusName']; ?></a>
                                        </td>
                                        <!-- <td class="actions"> -->
                                             <!--<a class="btn btn-small btn-info" href="<?php echo url('item/history',['item_id'=>$temp['id']]); ?>">历史</a>-->
                                            <!--<a class="btn btn-small btn-danger" data-toggle="modal" href="#removeItem">删除</a>-->
                                            <!--<a class="btn btn-small btn-success allow-item" data-id="<?php echo $temp['id']; ?>" data-value="1" data-href="<?php echo url('allowAgree'); ?>">通过</a>-->
                                            <!--<a class="btn btn-small btn-danger reject-item" data-id="<?php echo $temp['id']; ?>" data-value="0" data-href="<?php echo url('rejectAgree'); ?>">拒绝</a>-->
                                        <!-- </td> -->
                                    </tr>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="layui-card-body ">
                            <div class="page">
                                <?php echo $lists->render(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </body>
    <script>
    layui.use(['laydate','form','jquery'], function(){
        var laydate = layui.laydate;
        var form = layui.form;
        var jquery = layui.jquery;
        
        //执行一个laydate实例
        laydate.render({
          elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
          elem: '#end' //指定元素
        });
        
        //监听选择名称
        form.on('select(name_id)',
            function(obj) {
                var val = obj.value;
                var data;
                if (val != '') {
                    var url = obj.elem.getAttribute('data-href');
                    $.get(url, {name:val}, function(res){
                        data = res.data;
                        reset(data);
                    })
                } else {
                    data = jquery.parseJSON($("#data-all").html());
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
                    $.get(url, {category:val}, function(res){
                        data = res.data;
                        reset(data);
                        var types_str = '<option value=""> - 型号 - </option>';
                        $.each(data.types,function(k,v){
                            types_str += '<option value="'+v.data+'"> '+v.data+' </option>';
                        })

                        var names_str = '<option value=""> - 名称 - </option>';
                        $.each(data.names,function(k,v){
                            names_str += '<option value="'+v.data+'"> '+v.data+' </option>';
                        })

                        $('#type_id').html(types_str);
                        $('#name_id').html(names_str);
                        layui.form.render('select');
                    })
                } else {
                    data = jquery.parseJSON($("#data-all").html());
                    reset(data);

                    var types_str = '<option value=""> - 型号 - </option>';
                    $.each(data.types,function(k,v){
                        types_str += '<option value="'+v.data+'"> '+v.data+' </option>';
                    })

                    var names_str = '<option value=""> - 名称 - </option>';
                    $.each(data.names,function(k,v){
                        names_str += '<option value="'+v.data+'"> '+v.data+' </option>';
                    })

                    $('#type_id').html(types_str);
                    $('#name_id').html(names_str);
                    layui.form.render('select');
                }
            }
        );
    });

    function reset(data){

       
        var features_str = '<option value=""> - 配置 - </option>';
        // $("select[name=feature_id]").append(features_str);
        $.each(data.features,function(k,v){
            features_str += '<option value="'+v.data+'"> '+v.data+' </option>';
        })

        var networks_str = '<option value=""> - 网络模式 - </option>';
        $.each(data.networks,function(k,v){
            networks_str += '<option value="'+v.data+'"> '+v.data+' </option>';
        })

        var appearances_str = '<option value=""> - 外观 - </option>';
        $.each(data.appearances,function(k,v){
            appearances_str += '<option value="'+v.data+'"> '+v.data+' </option>';
        })

        $('#feature_id').html(features_str);
        $('#network_id').html(networks_str);
        $('#appearance_id').html(appearances_str);
        layui.form.render('select');
    }
</script>

</html>