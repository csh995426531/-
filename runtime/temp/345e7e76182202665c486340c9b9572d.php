<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"/data/www/y5g/public/../application/index/view/item/income_agree.html";i:1571558430;s:48:"/data/www/y5g/application/index/view/layout.html";i:1571074441;}*/ ?>
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
                           <li><a href="<?php echo url('item/income'); ?>">入库待核</a></li>
                            <li><a href="<?php echo url('item/returnIncome'); ?>">退货入库</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="collapse" data-target="#item-outgo-dropdown" href="#"><i class="icon-arrow-left"></i> 产品出库 <b class="caret"></b></a>
                        <ul id="item-outgo-dropdown" class="collapse">
                            <li><a href="<?php echo url('item/outgo'); ?>">销售出库</a></li>
                            <li><a href="<?php echo url('item/specialOutgo'); ?>">维修返库</a></li>
                            <li><a href="<?php echo url('item/specialOutgo2'); ?>">盘点丢失</a></li>
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
                    <li><a href="<?php echo url('/index/statistics/profit'); ?>"><i class="icon-bar-chart"></i>数据统计</a></li>
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
                <select class="span2" name="user_id">
                    <option value=""> - 入库人 - </option>
                    <?php foreach($users as $user): ?>
                    <option value="<?php echo $user['id']; ?>" <?php echo \think\Request::instance()->get('user_id')==$user['id']?'selected' :''; ?>><?php echo $user['username']; ?></opion>
                    <?php endforeach; ?>
                </select>
                <label class="control-label" for="date">进货日期</label>
                <input type="text" class="input-xlarge span2" id="date"  name="date" value="" data-val="<?php echo \think\Request::instance()->get('date'); ?>" autocomplete="off">
                <select class="span2" name="name_id">
                    <option value=""> - 名称 - </option>
                    <?php foreach($names as $name): ?>
                    <option value="<?php echo $name['id']; ?>" <?php echo \think\Request::instance()->get('name_id')==$name['id']?'selected' :''; ?>><?php echo $name['data']; ?></option>
                    <?php endforeach; ?>
                </select>
                <select class="span2" name="channel_id">
                    <option value=""> - 进货渠道 - </option>
                    <?php foreach($channels as $channel): ?>
                    <option value="<?php echo $channel['id']; ?>" <?php echo \think\Request::instance()->get('channel_id')==$channel['id']?'selected' :''; ?>><?php echo $channel['data']; ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="btn btn-primary">搜索</button>
            </form>
        </div>
  
        <div class="span12">
            <table class="orders-table table">
                <thead>
                <tr>
                    <th>选择</th>
                    <th>ID</th>
                    <th>入库类型</th>
                    <th>型号</th>
                    <th>名称</th>
                    <th>网络模式</th>
                    <th>配置</th>
                    <th>外观</th>
                    <th>序列号</th>
                    <th>固件版本</th>
                    <th>进货价格</th>
                    <th>进货渠道</th>
                    <th>入库人</th>
                    <th>入库时间</th>
                    <th class="actions">操作</th>
                </tr>
                </thead>
                <tbody>

                <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$temp): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td><input type="checkbox" class="checkbox-checked" data-id="<?php echo $temp['id']; ?>"  /></td>
                    <td><span><?php echo $temp['id']; ?></span></td>
                    <td><span><?php echo $temp['typeName']; ?></span></td>
                    <th><span><?php echo $temp['item']['itemType']['data']; ?></span></th>
                    <th><span><?php echo $temp['item']['itemName']['data']; ?></span></th>
                    <th><span><?php echo $temp['item']['itemNetwork']['data']; ?></span></th>
                    <th><span><?php echo $temp['item']['itemFeature']['data']; ?></span></th>
                    <th><span><?php echo $temp['item']['itemAppearance']['data']; ?></span></th>
                    <th><span><?php echo $temp['item']['number']; ?></span></th>
                    <th><span><?php echo $temp['item']['itemEdition']['data']; ?></span></th>
                    <!-- <th><span><?php echo $temp['item']['memo']; ?></span></th> -->
                    <th><span><?php echo $temp['item']['price']; ?></span></th>
                    <th><span><?php echo $temp['item']['itemChannel']['data']; ?></span></th>
                    <td><span><?php echo $temp['createUser']['username']; ?></span></td>
                    <td><span><?php echo $temp['create_time']; ?></span></td>
                    <td class="actions">
                        <!--<a class="btn btn-small btn-danger" data-toggle="modal" href="#removeItem">删除</a>-->
                        <a class="btn btn-small btn-success allow-item" data-id="<?php echo $temp['id']; ?>" data-value="1" data-href="<?php echo url('allowAgree'); ?>">通过</a>
                        <a class="btn btn-small btn-danger reject-item" data-id="<?php echo $temp['id']; ?>" data-value="0" data-href="<?php echo url('rejectAgree'); ?>">拒绝</a>
                    </td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                <tr>
                    <td><label style="cursor: pointer"><input type="checkbox" id="checkbox-all"  />全选</label> </td>
                    <td colspan="14">共<?php echo $count; ?>记录 ， 共<?php echo $total; ?>金额</td>
                </tr>
                <tr>
                    <td colspan="15">
                            <a class="btn btn-small btn-success " id="allow-all" data-href="<?php echo url('allowAgree'); ?>">批量通过</a>
                            <a class="btn btn-small btn-danger" id="reject-all" data-href="<?php echo url('rejectAgree'); ?>">批量拒绝</a>
                    </td>
                </tr>
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

        $("#checkbox-all").click(function(){

            var all_checked = 1;

            $(".checkbox-checked").each(function(k, v){
              
                if ($(v).prop('checked') == false){
                    all_checked = 0;
                }
            })
            
            if (all_checked == 1) {
                $(".checkbox-checked").each(function(k, v){
                    $(v).prop('checked', false)
                })
                $("#checkbox-all").prop('checked', false)
            } else {
                $(".checkbox-checked").each(function(k, v){
                    $(v).prop('checked', true)
                })
                $("#checkbox-all").prop('checked', true)
            }
        });

        $("#allow-all").click(function(){

            var url = $(this).data('href');
            var arr = new Array();
            $(".checkbox-checked").each(function(k, v){
                if ($(v).prop('checked') == true){
                    arr. push($(v).data('id'));
                }
            })

            if (arr.length > 0) {
                $.post(url, {id:arr}, function(res) {
                        alert(res.data)
                        window.location.replace("<?php echo url('incomeAgree');?>");
                })
            }
        })

        $("#reject-all").click(function(){

            var url = $(this).data('href');
            var arr = new Array();
            $(".checkbox-checked").each(function(k, v){
                if ($(v).prop('checked') == true){
                    arr. push($(v).data('id'));
                }
            })

            if (arr.length > 0) {
                $.post(url, {id:arr}, function(res) {
                    alert(res.data)
                    window.location.replace("<?php echo url('incomeAgree');?>");
                })
            }
        })

        $.datepicker.regional['zh-CN'] = {
            closeText: '关闭',
            prevText: '<上月',
            nextText: '下月>',
            currentText: '今天',
            monthNames: ['一月', '二月', '三月', '四月', '五月', '六月',
                '七月', '八月', '九月', '十月', '十一月', '十二月'],
            monthNamesShort: ['一', '二', '三', '四', '五', '六',
                '七', '八', '九', '十', '十一', '十二'],
            dayNames: ['星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六'],
            dayNamesShort: ['周日', '周一', '周二', '周三', '周四', '周五', '周六'],
            dayNamesMin: ['日', '一', '二', '三', '四', '五', '六'],
            weekHeader: '周',
            dateFormat: 'yy-mm-dd',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: true,
            yearSuffix: '年'
        };

        $.datepicker.setDefaults( $.datepicker.regional[ "zh-CN" ] );

        $("#date").datepicker({
            dateFormat: "yy-mm-dd",
            todayHighlight: false,
            minDate: "-3600D",
            maxDate: "+0D"
        });

        var date_val = $("#date").data('val');
        if (date_val != '') {
            $('#date').datepicker("setDate", date_val);
        } else {
            $('#date').datepicker("setDate", '+0D');
        }

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