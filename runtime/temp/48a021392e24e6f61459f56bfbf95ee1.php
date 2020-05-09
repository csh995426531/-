<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:63:"/data/www/y5g/public/../application/index/view/item/search.html";i:1575553202;s:48:"/data/www/y5g/application/index/view/layout.html";i:1589022923;}*/ ?>
<!doctype html>
<html class="x-admin-sm">
    <head>
        <meta charset="UTF-8">
        <title>库存管理</title>
        <meta name="renderer" content="webkit|ie-comp|ie-stand">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
        <meta http-equiv="Cache-Control" content="no-siteapp" />
        <link rel="stylesheet" href="/static/css/font.css">
        <link rel="stylesheet" href="/static/css/xadmin.css">
        <!-- <link rel="stylesheet" href="/static/css/theme5.css"> -->
        <script src="/static/lib/layui/layui.js" charset="utf-8"></script>
        <script type="text/javascript" src="/static/js/xadmin.js"></script>
        <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
        <!--[if lt IE 9]>
          <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
          <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script>
            // 是否开启刷新记忆tab功能
            // var is_remember = false;
        </script>
    </head>

<div class="main-area dashboard">
    
<div class="row">

    <div class="">
        <div class="span12">

                <form class="form-inline" method="get">
                <select class="span2" name="category_id" id='category_id' data-href="<?php echo url('changeCategory'); ?>">
                    <option value=""> - 分类 - </option>
                    <?php foreach($categories as $category): ?>
                    <option value="<?php echo $category['data']; ?>" <?php echo \think\Request::instance()->get('category_id')==$category['data']?'selected' :''; ?>><?php echo $category['data']; ?></opion>
                    <?php endforeach; ?>
                </select>
                <select class="span2" name="type_id" id='type_id'>
                    <option value=""> - 型号 - </option>
                    <?php foreach($types as $type): ?>
                    <option value="<?php echo $type['data']; ?>" <?php echo \think\Request::instance()->get('type_id')==$type['data']?'selected' :''; ?>><?php echo $type['data']; ?></opion>
                    <?php endforeach; ?>
                </select>
                <span id="data-all" style="display:none"><?php echo json_encode($data); ?></span>
                <select class="span2" name="name_id" id='name_id' data-href="<?php echo url('changeName'); ?>">
                    <option value=""> - 名称 - </option>
                    <?php foreach($names as $name): ?>
                    <option value="<?php echo $name['data']; ?>" <?php echo \think\Request::instance()->get('name_id')==$name['data']?'selected' :''; ?>><?php echo $name['data']; ?></option>
                    <?php endforeach; ?>
                </select>
                <select class="span2" name="network_id" id='network_id'>
                    <option value=""> - 网络模式 - </option>
                    <?php foreach($networks as $network): ?>
                    <option value="<?php echo $network['data']; ?>" <?php echo \think\Request::instance()->get('network_id')==$network['data']?'selected' :''; ?>><?php echo $network['data']; ?></option>
                    <?php endforeach; ?>
                </select>
                <select class="span2" name="feature_id" id='feature_id'>
                    <option value=""> - 配置 - </option>
                    <?php foreach($features as $feature): ?>
                    <option value="<?php echo $feature['data']; ?>" <?php echo \think\Request::instance()->get('feature_id')==$feature['data']?'selected' :''; ?>><?php echo $feature['data']; ?></option>
                    <?php endforeach; ?>
                </select>
                <select class="span2" name="appearance_id" id='appearance_id'>
                    <option value=""> - 外观 - </option>
                    <?php foreach($appearances as $appearance): ?>
                    <option value="<?php echo $appearance['data']; ?>" <?php echo \think\Request::instance()->get('appearance_id')==$appearance['data']?'selected' :''; ?>><?php echo $appearance['data']; ?></option>
                    <?php endforeach; ?>
                </select>
                <select class="span2" name="edition_id" id='edition_id'>
                    <option value=""> - 固件版本 - </option>
                    <?php foreach($editions as $edition): ?>
                    <option value="<?php echo $edition['data']; ?>" <?php echo \think\Request::instance()->get('edition_id')==$edition['data']?'selected' :''; ?>><?php echo $edition['data']; ?></option>
                    <?php endforeach; ?>
                </select>
                <select class="span2" name="channel_id">
                    <option value=""> - 进货渠道 - </option>
                    <?php foreach($channels as $channel): ?>
                    <option value="<?php echo $channel['data']; ?>" <?php echo \think\Request::instance()->get('channel_id')==$channel['data']?'selected' :''; ?>><?php echo $channel['data']; ?></option>
                    <?php endforeach; ?>
                </select>
                <select class="span2" name="date">
                    <option value=""> - 进货日期 - </option>
                    <?php foreach($dates as $date): ?>
                    <option value="<?php echo $date; ?>" <?php echo \think\Request::instance()->get('date')==$date?'selected' :''; ?>><?php echo $date; ?></option>
                    <?php endforeach; ?>
                </select>
                <select class="span2" name="status">
                    <option value=""> - 状态 - </option>
                    <?php if(is_array($statuses) || $statuses instanceof \think\Collection || $statuses instanceof \think\Paginator): if( count($statuses)==0 ) : echo "" ;else: foreach($statuses as $k=>$status): ?>
                    <option value="<?php echo $k; ?>" <?php echo \think\Request::instance()->get('status')==$k?'selected' :''; ?>><?php echo $status; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
                <input type="text" class="input-large" name="keyword" placeholder="序列号" value="<?php echo \think\Request::instance()->get('keyword'); ?>">
                <button type="submit" class="btn btn-primary">搜索</button>
            </form>
        </div>

        <div class="row">

            <div class="span12 listing-buttons">

                <!--<button class="btn btn-info">Action</button>-->

                <!--<button class="btn btn-success">Action</button>-->

                <!--<button class="btn btn-primary"  data-toggle="modal" href="#addItem" >录入</button>-->

            </div>

            <div class="span12">

                <!--<div class="page-header">-->
                <!--<div class="btn-group pull-right">-->
                <!--<button class="btn dropdown-toggle" data-toggle="dropdown">-->
                <!--<i class="icon-download-alt"></i> Export-->
                <!--<span class="caret"></span>-->
                <!--</button>-->
                <!--<ul class="dropdown-menu">-->
                <!--<li><a href="">CSV</a></li>-->
                <!--<li><a href="">Excel</a></li>-->
                <!--<li><a href="">PDF</a></li>-->
                <!--</ul>-->
                <!--</div>-->
                <!--<h2>Listings</h2>-->
                <!--</div>-->
                <h4 class="span12">总条数：<?php echo $lists->total(); ?></h4>
                <table class="orders-table table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>进货日期</th>
                         <!--<th>型号</th>-->
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
                 
                           <!--<th class="actions">轨迹</th>-->
                    </tr>
                    </thead>
                    <tbody>
                    <!--<tr>-->
                    <!--<td><a href="form.html">Listing title</a> <span class="label label-info">Item Status</span><br /><span class="meta">Added Today</span></td>-->
                    <!--<td class="actions">-->
                    <!--<a class="btn btn-small btn-danger" data-toggle="modal" href="#removeItem">Remove</a>-->
                    <!--<a class="btn btn-small btn-primary" href="form.html">Edit</a>-->
                    <!--</td>-->
                    <!--</tr>-->
                    <!--<tr>-->
                    <!--<td><a href="form.html">Listing title</a> <span class="label label-warning">Item Status</span><br /><span class="meta">Added Today</span></td>-->
                    <!--<td class="actions">-->
                    <!--<a class="btn btn-small btn-danger" data-toggle="modal" href="#removeItem">Remove</a>-->
                    <!--<a class="btn btn-small btn-primary" href="form.html">Edit</a>-->
                    <!--</td>-->
                    <!--</tr>-->
                    <!--<tr>-->
                    <!--<td><a href="form.html">Listing title</a> <span class="label label-important">Item Status</span><br /><span class="meta">Added Today</span></td>-->
                    <!--<td class="actions">-->
                    <!--<a class="btn btn-small btn-danger" data-toggle="modal" href="#removeItem">Remove</a>-->
                    <!--<a class="btn btn-small btn-primary" href="form.html">Edit</a>-->
                    <!--</td>-->
                    <!--</tr>-->
                    <!--<tr>-->
                    <!--<td><a href="form.html">Listing title</a> <span class="label label-inverse">Item Status</span><br /><span class="meta">Added Today</span></td>-->
                    <!--<td class="actions">-->
                    <!--<a class="btn btn-small btn-danger" data-toggle="modal" href="#removeItem">Remove</a>-->
                    <!--<a class="btn btn-small btn-primary" href="form.html">Edit</a>-->
                    <!--</td>-->
                    <!--</tr>-->
                    <!--<tr>-->
                    <!--<td><a href="form.html">Listing title</a> <span class="label label-success">Item Status</span><br /><span class="meta">Added Today</span></td>-->
                    <!--<td class="actions">-->
                    <!--<a class="btn btn-small btn-danger" data-toggle="modal" href="#removeItem">Remove</a>-->
                    <!--<a class="btn btn-small btn-primary" href="form.html">Edit</a>-->
                    <!--</td>-->
                    <!--</tr>-->
                    <!--<tr>-->
                    <!--<td><a href="form.html">Listing title</a> <span class="label">Item Status</span><br /><span class="meta">Added Today</span></td>-->
                    <!--<td class="actions">-->
                    <!--<a class="btn btn-small btn-danger" data-toggle="modal" href="#removeItem">Remove</a>-->
                    <!--<a class="btn btn-small btn-primary" href="form.html">Edit</a>-->
                    <!--</td>-->
                    <!--</tr>-->

                    <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$temp): $mod = ($i % 2 );++$i;?>
                    <tr>
                        <td><span><?php echo $temp['id']; ?></span></td>
                        <th><span><?php echo $temp['date']; ?></span></th>
                          <!--<th><span><?php echo $temp['itemType']['data']; ?></span></th>-->
                        <th><span><?php echo $temp['itemCategory']['data']; ?></span></th>
                        <th><span><?php echo $temp['itemName']['data']; ?></span></th>
                        <th><span><?php echo $temp['itemNetwork']['data']; ?></span></th>
                        <th><span><?php echo $temp['itemFeature']['data']; ?></span></th>
                        <th><span><?php echo $temp['itemAppearance']['data']; ?></span></th>
                           <!--<th><span><?php echo $temp['number']; ?></span></th>-->
                        <th><a href="https://checkcoverage.apple.com/cn/zh/?sn=<?php echo $temp['number']; ?>" target="_blank"><span><?php echo $temp['number']; ?></span></a></th>

                        <th><span><?php echo $temp['itemEdition']['data']; ?></span></th>
                         <th><span><?php echo $temp['itemChannel']['data']; ?></span></th>
                        <th title="<?php echo $temp['memo']; ?>" style="cursor: pointer"><span><?php echo mb_strlen($temp->memo) > 6 ? mb_substr($temp->memo, 0, 6).'…' : $temp->memo; ?></span></th>
                        <th><span><?php echo $temp['price']*1; ?></span></th>
                       
                           <th><span><?php echo $temp['lastOutNo']; ?></span></th>
                        <!--<th><span><?php echo $temp['statusName']; ?></span></th>-->
                     	 <td class="actions">
                            <a class="btn btn-small btn-info" href="<?php echo url('item/history',['item_id'=>$temp['id']]); ?>"><?php echo $temp['statusName']; ?></a>
                                         
                      
                        <td class="actions">
                             <!--<a class="btn btn-small btn-info" href="<?php echo url('item/history',['item_id'=>$temp['id']]); ?>">历史</a>-->
                            <!--<a class="btn btn-small btn-danger" data-toggle="modal" href="#removeItem">删除</a>-->
                            <!--<a class="btn btn-small btn-success allow-item" data-id="<?php echo $temp['id']; ?>" data-value="1" data-href="<?php echo url('allowAgree'); ?>">通过</a>-->
                            <!--<a class="btn btn-small btn-danger reject-item" data-id="<?php echo $temp['id']; ?>" data-value="0" data-href="<?php echo url('rejectAgree'); ?>">拒绝</a>-->
                        </td>
                    </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="pull-right">
                <?php echo $lists->render(); ?>
            </div>
        </div>
    </div>
    <script src="/static/js/jquery.min.js"></script>
    <script>
        $(function(){
            $(".allow-item, .reject-item").click(function(){
                var url = $(this).data('href');
                var id = $(this).data('id');
                $.post(url, {id:id}, function (res) {
                    alert(res.data);
                    window.location.replace("<?php echo url('incomeAgree');?>");
                })
            })

            $("#name_id").change(function(){
                var val = $(this).val();
                var data;
                if (val != '') {

                    var url = $(this).data('href');

                    var name = $(this).val();
                    $.get(url, {name:name}, function(res){
                        data = res.data;
                        reset(data);
                    })
                } else {
                    data = jQuery.parseJSON($("#data-all").html());
                    reset(data);
                }
            }); 

            $("#category_id").change(function(){
                var val = $(this).val();
                var data;
                if (val != '') {

                    var url = $(this).data('href');
                    $.get(url, {category:val}, function(res){
                        data = res.data;console.log(data);
                        reset(data);

                        var types_str = '<option value=""> - 型号 - </option>';
                        $.each(data.types,function(k,v){
                            types_str += '<option value="'+v.data+'"> '+v.data+' </option>';
                        })

                        var names_str = '<option value=""> - 分类 - </option>';
                        $.each(data.names,function(k,v){
                            names_str += '<option value="'+v.data+'"> '+v.data+' </option>';
                        })

                        $('#type_id').html(types_str);
                        $('#name_id').html(names_str);
                    })
                } else {
                    data = jQuery.parseJSON($("#data-all").html());
                    reset(data);

                    var types_str = '<option value=""> - 型号 - </option>';
                    $.each(data.types,function(k,v){
                        types_str += '<option value="'+v.data+'"> '+v.data+' </option>';
                    })

                    var names_str = '<option value=""> - 分类 - </option>';
                    $.each(data.names,function(k,v){
                        names_str += '<option value="'+v.data+'"> '+v.data+' </option>';
                    })

                    $('#type_id').html(types_str);
                    $('#name_id').html(names_str);
                }
            })
        })

        function reset(data){
            var features_str = '<option value=""> - 配置 - </option>';
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
        }
    </script>
</div>