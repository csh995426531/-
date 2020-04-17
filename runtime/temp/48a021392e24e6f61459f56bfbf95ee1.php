<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:63:"/data/www/y5g/public/../application/index/view/item/search.html";i:1575553202;s:48:"/data/www/y5g/application/index/view/layout.html";i:1577343457;}*/ ?>
<!DOCTYPE html>
<html lang="en" style="height:100%">
<head>

    <meta charset="utf-8">
    <title>库存管理</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="http://fonts.googleapis.com/css?family=Oxygen|Marck+Script" rel="stylesheet" type="text/css">
    <link href="/static/css/bootstrap.css" rel="stylesheet">
    <link href="/static/css/font-awesome.css" rel="stylesheet">
    <link href="/static/css/admin.css" rel="stylesheet">
    <link href="/static/css/jquery-192custom.min.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>
<body style="height:100%">

<div class="container-fluid " style="padding: 0px;height:100%">
    <div class="row" style="height:100%">
        <div class="span2" style="width: 9.3%;background: #484646;height:100%">
            <div class="main-left-col" style="border-right: 0px solid #F1F1F1; ">
                <h1><i class="icon-large"></i> <img src="/bg.png"></h1>
                <ul class="side-nav">
                    <li><a href="<?php echo url('/index/statistics/index'); ?>"><i class="icon-home"></i>库存主页</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="collapse" data-target="#item-dropdown" href="#"><i class="icon-th"></i> 库存查询 <b class="caret"></b></a>
                        <ul id="item-dropdown" class="collapse">
                            <li><a href="<?php echo url('item/inventory'); ?>">在库查询</a></li>
                           
                            <li><a href="<?php echo url('item/search'); ?>">综合查询</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="collapse" data-target="#item-income-dropdown" href="#"><i class="icon-share-alt"></i> 产品入库 <b class="caret"></b></a>
                        <ul id="item-income-dropdown" class="collapse">
                            <li><a href="<?php echo url('item/addIncome'); ?>">采购入库</a></li>
                            <li><a href="<?php echo url('item/addIncome2'); ?>">批量入库</a></li>
                            <li><a href="<?php echo url('item/income'); ?>">入库待核</a></li>
                            <li><a href="<?php echo url('item/returnIncome'); ?>">退货入库</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="collapse" data-target="#item-outgo-dropdown" href="#"><i class="icon-arrow-left"></i> 产品出库 <b class="caret"></b></a>
                        <ul id="item-outgo-dropdown" class="collapse">
                            <li><a href="<?php echo url('item/outgo'); ?>">销售出库</a></li>
                            <li><a href="<?php echo url('item/specialOutgo'); ?>">维修登记</a></li>
                           <!--  <li><a href="<?php echo url('item/specialOutgo2'); ?>">仓库盘点</a></li>!-->
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="collapse" data-target="#examine-dropdown" href="#"><i class="icon-check"></i> 操作审核 <b class="caret"></b></a>
                        <ul id="examine-dropdown" class="collapse">
                            <li><a href="<?php echo url('item/incomeAgree'); ?>">入库审核</a></li>
                            <li><a href="<?php echo url('item/outgoAgree'); ?>">出库审核</a></li>
                        </ul>
                    </li>
                    <!-- <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="collapse" data-target="#statistics-dropdown" href="#"><i class="icon-bar-chart"></i> 统计功能 <b class="caret"></b></a>
                        <ul id="statistics-dropdown" class="collapse">
                            <li><a href="<?php echo url('/index/statistics/income'); ?>">进货统计</a></li>
                            <li><a href="<?php echo url('/index/statistics/profit'); ?>">利润统计</a></li>
                        </ul>
                    </li> -->
               <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="collapse" data-target="#statistics-dropdown" href="#"><i class="icon-bar-chart"></i> 统计功能 <b class="caret"></b></a>
                        <ul id="statistics-dropdown" class="collapse">
                            <li><a href="<?php echo url('/index/statistics/index'); ?>">30天统计</a></li>                                                                         
                             <li><a href="<?php echo url('/index/statistics/profit'); ?>">数据统计</a></li>
                             </ul>
                    </li>

                               <li><a href="<?php echo url('item/specialOutgo2'); ?>"><i class="icon-check"></i>仓库盘点</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="collapse" data-target="#settings-dropdown" href="#"><i class="icon-cogs"></i> 基础设置 <b class="caret"></b></a>
                        <ul id="settings-dropdown" class="collapse">
                            <li><a href="<?php echo url('setting/category'); ?>">产品类别</a></li>
                            <li><a href="<?php echo url('setting/name'); ?>">产品名称</a></li>
                           <li><a href="<?php echo url('setting/type'); ?>">网络型号</a></li>
                            <li><a href="<?php echo url('setting/feature'); ?>">产品配置</a></li>
                            <li><a href="<?php echo url('setting/appearance'); ?>">产品外观</a></li>
                            <li><a href="<?php echo url('setting/edition'); ?>">产品版本</a></li>
                            <li><a href="<?php echo url('setting/incomeChannel'); ?>">渠道录入</a></li>
                            <!-- <li><a href="<?php echo url('setting/outgoChannel'); ?>">出货途径</a></li> -->
                            <!-- <li><a href="<?php echo url('setting/network'); ?>">网络模式录入</a></li> -->
                            <li><a href="<?php echo url('setting/special'); ?>">特殊修改</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="collapse" data-target="#members-dropdown" href="#"><i class="icon-group"></i> 角色管理 <b class="caret"></b></a>
                        <ul id="members-dropdown" class="collapse">
                            <li><a href="<?php echo url('members/add'); ?>">添加账号</a></li>
                            <li><a href="<?php echo url('members/updatePwd'); ?>">密码修改</a></li>
                            <li><a href="<?php echo url('members/updateAccess'); ?>">权限修改</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo url('/index/log/index'); ?>"><i class="icon-book"></i> 系统日志 </a></li>
                </ul>

            </div> <!-- end main-left-col -->

        </div> <!-- end span2 -->

        <div class="span10" style="width: 82%;    margin-left: 2%;height:100%">

            <div class="secondary-masthead span12">

                <ul class="nav nav-pills pull-right">
                    <li>
                        <a href="<?php echo url('index/index/index'); ?>"><i class="icon-globe"></i> 首页</a>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-user"></i> <?php echo think\Session::get('user_name');?><b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo url('logout'); ?>">登出</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="breadcrumb">
                    <a href="<?php echo url('index/index/index'); ?>">库存系统</a>
                    <?php echo isset($breadcrumb) && !empty($breadcrumb) ? '/ <a href="#">'.$breadcrumb.'</a>' : '';?>
                </ul>

            </div>


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

        </div> <!-- end span10 -->

    </div> <!-- end row -->

</div> <!-- end container -->

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/bootstrap.js"></script>
<script src="/static/js/excanvas.min.js"></script>
<!-- <script src="/static/js/jquery.flot.min.js"></script> -->
<!-- <script src="/static/js/jquery.flot.resize.js"></script> -->
<script src="/static/js/jquery-192custom.min.js"></script>
<script type="text/javascript">
    // $(function () {
    //     var d1 = [];
    //     d1.push([0, 32]);
    //     d1.push([1, 30]);
    //     d1.push([2, 24]);
    //     d1.push([3, 17]);
    //     d1.push([4, 11]);
    //     d1.push([5, 25]);
    //     d1.push([6, 28]);
    //     d1.push([7, 36]);
    //     d1.push([8, 44]);
    //     d1.push([9, 52]);
    //     d1.push([10, 53]);
    //     d1.push([11, 50]);
    //     d1.push([12, 45]);
    //     d1.push([13, 42]);
    //     d1.push([14, 40]);
    //     d1.push([15, 36]);
    //     d1.push([16, 34]);
    //     d1.push([17, 24]);
    //     d1.push([18, 17]);
    //     d1.push([19, 17]);
    //     d1.push([20, 20]);
    //     d1.push([21, 28]);
    //     d1.push([22, 36]);
    //     d1.push([23, 38]);

    //     // $.plot($("#placeholder"), [ d1 ], { grid: { backgroundColor: 'white', color: '#999', borderWidth: 1, borderColor: '#DDD' }, colors: ["#FC6B0A"], series: { lines: { show: true, fill: true, fillColor: "rgba(253,108,11,0.4)" } } });
    // });
</script>


</body>
</html>