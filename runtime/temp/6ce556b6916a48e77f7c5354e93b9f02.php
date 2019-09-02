<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:77:"/www/wwwroot/maig/public/../application/index/view/setting/outgo_channel.html";i:1562975331;s:52:"/www/wwwroot/maig/application/index/view/layout.html";i:1567309984;}*/ ?>
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
                            <li><a href="<?php echo url('item/addIncome'); ?>">进货入库</a></li>
                            <li><a href="<?php echo url('item/returnIncome'); ?>">退货入库</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="collapse" data-target="#item-outgo-dropdown" href="#"><i class="icon-arrow-left"></i> 产品出库 <b class="caret"></b></a>
                        <ul id="item-outgo-dropdown" class="collapse">
                            <li><a href="<?php echo url('item/outgo'); ?>">销售出库</a></li>
                            <li><a href="<?php echo url('item/specialOutgo'); ?>">特殊出库</a></li>
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
                    <li><a href="<?php echo url('/index/statistics/profit'); ?>"><i class="icon-bar-chart"></i>统计</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="collapse" data-target="#settings-dropdown" href="#"><i class="icon-cogs"></i> 基础设置 <b class="caret"></b></a>
                        <ul id="settings-dropdown" class="collapse">
                            <li><a href="<?php echo url('setting/category'); ?>">类别录入</a></li>
                            <li><a href="<?php echo url('setting/name'); ?>">名称录入</a></li>
                            <li><a href="<?php echo url('setting/feature'); ?>">配置录入</a></li>
                            <li><a href="<?php echo url('setting/appearance'); ?>">外观录入</a></li>
                            <li><a href="<?php echo url('setting/edition'); ?>">固件版本录入</a></li>
                            <li><a href="<?php echo url('setting/type'); ?>">网络模式型号录入</a></li>
                            <li><a href="<?php echo url('setting/incomeChannel'); ?>">进货渠道录入</a></li>
                            <li><a href="<?php echo url('setting/outgoChannel'); ?>">出货途径录入</a></li>
                            <!-- <li><a href="<?php echo url('setting/network'); ?>">网络模式录入</a></li> -->
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
                

<?php echo $message; ?>
<div class="row">

    <div class="">
        <div class="span12 listing-buttons">

            <!--<button class="btn btn-info">Action</button>-->

            <!--<button class="btn btn-success">Action</button>-->

            <button class="btn btn-primary"  data-toggle="modal" href="#addItem" >录入</button>

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
                    <th>渠道值</th>
                    <th class="actions">操作</th>
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
                    <td><span><?php echo $temp['data']; ?></span></td>
                    <td class="actions">
                        <!--<a class="btn btn-small btn-danger" data-toggle="modal" href="#removeItem">删除</a>-->
                        <!--<a class="btn btn-small btn-primary" href="form.html">Edit</a>-->
                        <?php if($temp['status'] == 1): ?>
                        <a class="btn btn-small btn-danger del-item" data-id="<?php echo $temp['id']; ?>" data-href="<?php echo url('delChannel'); ?>">停用</a>
                        <?php else: ?>
                        <a class="btn btn-small btn-success del-item" data-id="<?php echo $temp['id']; ?>" data-href="<?php echo url('openChannel'); ?>">启用</a>
                        <?php endif; ?>
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

    <div class="modal hide fade" id="addItem">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h3>录入</h3>
        </div>
        <form class="form-horizontal" method="post" id="form" data-action="<?php echo url('addChannel'); ?>">
            <fieldset>
                <input type="hidden" name="type" value="2">
                <div class="modal-body control-group">
                    <label class="control-label" for="data">值</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="data"  name="data" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal">关闭</a>
                    <button class="btn btn-success" type="button" id="submit">确定</button>
                </div>
            </fieldset>
        </form>
    </div>

    <!--<div class="span5">-->

    <!--<div class="pagination pull-left">-->
    <!--<ul>-->
    <!--<li><a href="#">Prev</a></li>-->
    <!--<li class="active">-->
    <!--<a href="#">1</a>-->
    <!--</li>-->
    <!--<li><a href="#">2</a></li>-->
    <!--<li><a href="#">3</a></li>-->
    <!--<li><a href="#">4</a></li>-->
    <!--<li><a href="#">Next</a></li>-->
    <!--</ul>-->
    <!--</div>-->

    <!--</div>-->

    <!--<div class="span5 listing-buttons pull-right">-->

    <!--<button class="btn btn-info">Action</button>-->

    <!--<button class="btn btn-success">Action</button>-->

    <!--<button class="btn btn-primary">Add New Item</button>-->

    <!--</div>-->

</div>
<script src="/static//js/jquery.min.js"></script>
<script>
    $(function(){
        $("#submit").click(function(){
            var url = $("#form").data('action');
            var data = $('#form').serialize();
            $.post(url, data, function (res) {
                alert(res.data);
                window.location.replace("<?php echo url('outgoChannel');?>");
            })
        });
        $(".del-item").click(function(){
            var url = $(this).data('href');
            var id = $(this).data('id');
            $.post(url, {id:id}, function (res) {console.log(res);
                alert(res.data);
                window.location.replace("<?php echo url('outgoChannel');?>");
            })
        })
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