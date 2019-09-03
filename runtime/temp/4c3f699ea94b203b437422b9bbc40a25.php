<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:66:"/data/www/y5g/public/../application/index/view/item/inventory.html";i:1562607766;s:48:"/data/www/y5g/application/index/view/layout.html";i:1562801030;}*/ ?>
<!DOCTYPE html>
<html lang="en" style="height:100%">
<head>

    <meta charset="utf-8">
    <title>库存管理系统</title>
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
                <h1><i class="icon-large"></i> 库存管理系统</h1>
                <ul class="side-nav">
                    <li class="active">
                        <a href="index.html"><i class="icon-home"></i> Dashboard</a>
                    </li>
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
                            <li><a href="<?php echo url('item/income'); ?>">进货入库</a></li>
                            <li><a href="<?php echo url('item/returnIncome'); ?>">退货入库</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="collapse" data-target="#item-outgo-dropdown" href="#"><i class="icon-arrow-left"></i> 产品出库 <b class="caret"></b></a>
                        <ul id="item-outgo-dropdown" class="collapse">
                            <li><a href="<?php echo url('item/outgo'); ?>">销售出库</a></li>
                            <li><a href="<?php echo url('item/specialoutgo'); ?>">特殊出库</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="collapse" data-target="#examine-dropdown" href="#"><i class="icon-check"></i> 操作审核 <b class="caret"></b></a>
                        <ul id="examine-dropdown" class="collapse">
                            <li><a href="<?php echo url('item/incomeAgree'); ?>">入库审核</a></li>
                            <li><a href="<?php echo url('item/outgoAgree'); ?>">出库审核</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="collapse" data-target="#statistics-dropdown" href="#"><i class="icon-bar-chart"></i> 统计功能 <b class="caret"></b></a>
                        <ul id="statistics-dropdown" class="collapse">
                            <li><a href="<?php echo url('/index/statistics/income'); ?>">进货统计</a></li>
                            <li><a href="<?php echo url('/index/statistics/profit'); ?>">利润统计</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="collapse" data-target="#settings-dropdown" href="#"><i class="icon-cogs"></i> 基础设置 <b class="caret"></b></a>
                        <ul id="settings-dropdown" class="collapse">
                            <li><a href="<?php echo url('setting/category'); ?>">类别录入</a></li>
                            <li><a href="<?php echo url('setting/name'); ?>">名称录入</a></li>
                            <li><a href="<?php echo url('setting/feature'); ?>">配置录入</a></li>
                            <li><a href="<?php echo url('setting/appearance'); ?>">外观录入</a></li>
                            <li><a href="<?php echo url('setting/edition'); ?>">固件版本录入</a></li>
                            <li><a href="<?php echo url('setting/type'); ?>">型号录入</a></li>
                            <li><a href="<?php echo url('setting/incomeChannel'); ?>">进货渠道录入</a></li>
                            <li><a href="<?php echo url('setting/outgoChannel'); ?>">出货途径录入</a></li>
                            <li><a href="<?php echo url('setting/network'); ?>">网络模式录入</a></li>
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
                    <li><a href="<?php echo url('/index/log/index'); ?>"><i class="icon-book"></i> 日志 </a></li>
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

<div class="span12">

<div class="">

<form class="form-inline" method="get">
    <select class="span2" name="type_id">
        <option value=""> - 型号 - </option>
        <?php foreach($types as $type): ?>
        <option value="<?php echo $type['data']; ?>" <?php echo \think\Request::instance()->get('type_id')==$type['data']?'selected' :''; ?>><?php echo $type['data']; ?></opion>
        <?php endforeach; ?>
    </select>
    <span id="data-all" style="display:none"><?php echo json_encode($data); ?></span>
    <select class="span2" id="name_id" name="name_id"  data-href="<?php echo url('changeName'); ?>">
        <option value=""> - 名称 - </option>
        <?php foreach($names as $name): ?>
        <option value="<?php echo $name['data']; ?>" <?php echo \think\Request::instance()->get('name_id')==$name['data']?'selected' :''; ?>><?php echo $name['data']; ?></option>
        <?php endforeach; ?>
    </select>
    <select class="span2"  id="feature_id"name="feature_id" >
        <option value=""> - 配置 - </option>
        <?php foreach($features as $feature): ?>
            <option value="<?php echo $feature['data']; ?>" <?php echo \think\Request::instance()->get('feature_id')==$feature['data']?'selected' :''; ?>><?php echo $feature['data']; ?></option>
        <?php endforeach; ?>
    </select>
    <select class="span2" id="network_id" name="network_id">
        <option value=""> - 网络模式 - </option>
        <?php foreach($networks as $network): ?>
            <option value="<?php echo $network['data']; ?>" <?php echo \think\Request::instance()->get('network_id')==$network['data']?'selected' :''; ?>><?php echo $network['data']; ?></option>
        <?php endforeach; ?>
    </select>
    <select class="span2" id="appearance_id" name="appearance_id">
        <option value=""> - 外观 - </option>
        <?php foreach($appearances as $appearance): ?>
            <option value="<?php echo $appearance['data']; ?>" <?php echo \think\Request::instance()->get('appearance_id')==$appearance['data']?'selected' :''; ?>><?php echo $appearance['data']; ?></option>
        <?php endforeach; ?>
    </select>
    <input type="text" class="input-large" name="keyword" placeholder="序列号" value="<?php echo \think\Request::instance()->get('keyword'); ?>">
<button type="submit" class="btn btn-primary">搜索</button>
</form>

<div class="row">

    <div class="">
        <div class="span12 listing-buttons">
        </div>
        <div class="span12">
            <h4 class="span12">总条数：<?php echo $lists->total(); ?></h4>
            <table class="orders-table table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>入库时间</th>
                    <th>型号</th>
                    <th>分类</th>
                    <th>名称</th>
                    <th>配置</th>
                    <th>外观</th>
                    <th>序列号</th>
                    <th>固件版本</th>
                    <th>备注</th>
                    <th>进货价格</th>
                    <th>进货渠道</th>
                    <th>状态</th>
                    <!--<th class="actions">操作</th>-->
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$temp): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td><span><?php echo $temp['id']; ?></span></td>
                    <th><span><?php echo $temp['date']; ?></span></th>
                    <th><span><?php echo $temp['itemType']['data']; ?></span></th>
                    <th><span><?php echo $temp['itemCategory']['data']; ?></span></th>
                    <th><span><?php echo $temp['itemName']['data']; ?></span></th>
                    <th><span><?php echo $temp['itemFeature']['data']; ?></span></th>
                    <th><span><?php echo $temp['itemAppearance']['data']; ?></span></th>
                    <th><span><?php echo $temp['number']; ?></span></th>
                    <th><span><?php echo $temp['itemEdition']['data']; ?></span></th>
                    <th><span><?php echo $temp['memo']; ?></span></th>
                    <th><span><?php echo $temp['price']; ?></span></th>
                    <th><span><?php echo $temp['itemChannel']['data']; ?></span></th>
                    <th><span><?php echo $temp['statusName']; ?></span></th>
                    <td class="actions">
                        <!--<a class="btn btn-small btn-danger" data-toggle="modal" href="#removeItem">删除</a>-->
                        <!--<a class="btn btn-small btn-success allow-item" data-id="<?php echo $temp['id']; ?>" data-value="1" data-href="<?php echo url('allowAgree'); ?>">通过</a>-->
                        <!--<a class="btn btn-small btn-danger reject-item" data-id="<?php echo $temp['id']; ?>" data-value="0" data-href="<?php echo url('rejectAgree'); ?>">拒绝</a>-->
                    </td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
        </div>
        <div>
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
            var data = jQuery.parseJSON($("#data-all").html());
            if (val != '') {

                var url = $(this).data('href');

                var name = $(this).val();
                $.get(url, {name:name}, function(res){
                    data = res.data;
                })
            } 

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
        }); 
    })
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
<script src="/static/js/jquery.flot.min.js"></script>
<script src="/static/js/jquery.flot.resize.js"></script>
<script src="/static/js/jquery-192custom.min.js"></script>
<script type="text/javascript">
    $(function () {
        var d1 = [];
        d1.push([0, 32]);
        d1.push([1, 30]);
        d1.push([2, 24]);
        d1.push([3, 17]);
        d1.push([4, 11]);
        d1.push([5, 25]);
        d1.push([6, 28]);
        d1.push([7, 36]);
        d1.push([8, 44]);
        d1.push([9, 52]);
        d1.push([10, 53]);
        d1.push([11, 50]);
        d1.push([12, 45]);
        d1.push([13, 42]);
        d1.push([14, 40]);
        d1.push([15, 36]);
        d1.push([16, 34]);
        d1.push([17, 24]);
        d1.push([18, 17]);
        d1.push([19, 17]);
        d1.push([20, 20]);
        d1.push([21, 28]);
        d1.push([22, 36]);
        d1.push([23, 38]);

        $.plot($("#placeholder"), [ d1 ], { grid: { backgroundColor: 'white', color: '#999', borderWidth: 1, borderColor: '#DDD' }, colors: ["#FC6B0A"], series: { lines: { show: true, fill: true, fillColor: "rgba(253,108,11,0.4)" } } });
    });
</script>


</body>
</html>