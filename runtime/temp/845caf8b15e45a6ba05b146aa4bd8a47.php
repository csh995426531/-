<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:63:"/data/www/y5g/public/../application/index/view/item/income.html";i:1562607969;s:48:"/data/www/y5g/application/index/view/layout.html";i:1562608158;}*/ ?>
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
                    <li><a href="<?php echo url('item/outgo'); ?>"><i class="icon-reply"></i> 销售出库 </a></li>
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
                <!--<div class="alert alert-info">-->
<!--<a class="close" data-dismiss="alert" href="#">x</a>-->
<!--<h4 class="alert-heading">Information</h4>-->
<!--This template shows how forms can be laid out for editing content.-->
<!--</div>-->

<!--<div class="alert alert-error">-->
<!--<a class="close" data-dismiss="alert" href="#">x</a>-->
<!--<h4 class="alert-heading">Error</h4>-->
<!--Example of an error message alert.-->
<!--</div>-->

<!--<div class="alert alert-success">-->
<!--<a class="close" data-dismiss="alert" href="#">x</a>-->
<!--<h4 class="alert-heading">Success</h4>-->
<!--Example of an success message alert.-->
<!--</div>-->

<!--<div class="alert alert-warning">-->
<!--<a class="close" data-dismiss="alert" href="#">x</a>-->
<!--<h4 class="alert-heading">Warning</h4>-->
<!--Example of an warning message alert.-->
<!--</div>-->

<?php echo $message; ?>
<div class="row">
    <div class="span12">
        <div class="">
            <div class="page-header">
                <h2>进货入库</h2>
            </div>
            <form class="form-horizontal" method="post" id="form">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="date">进货日期</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" id="date"  name="date" value="" autocomplete="off">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="type_id">型号</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" id="type_id" name="type_id" value="" data-href="<?php echo url('changeType'); ?>"><span id="type_message" style="color: brown"></span>
                            <input type="hidden"  id="type_status" value="1" />
                        </div>
                    </div>
                    <input type="hidden" name="category_id" id="category_id">
                    <div class="control-group">
                        <label class="control-label" for="name_id">名称</label>
                        <div class="controls">
                            <select id="name_id" class="input-xlarge" name="name_id">
                                <?php foreach($names as $name): ?>
                                    <option value="<?php echo $name['id']; ?>"  data-category-id="<?php echo $name['category_id']; ?>" data-appearance="
                                    <?php foreach($name['itemAppearance'] as $appearance): ?>
                                        <option value='<?php echo $appearance['id']; ?>'><?php echo $appearance['data']; ?></option>
                                    <?php endforeach; ?>"  data-edition="
                                    <?php foreach($name['itemEdition'] as $edition): ?>
                                        <option value='<?php echo $edition['id']; ?>'><?php echo $edition['data']; ?></option>
                                    <?php endforeach; ?>"  data-feature="
                                    <?php foreach($name['itemFeature'] as $feature): ?>
                                        <option value='<?php echo $feature['id']; ?>'><?php echo $feature['data']; ?></option>
                                    <?php endforeach; ?>"
                                    data-network="
                                    <?php foreach($name['itemNetwork'] as $network): ?>
                                        <option value='<?php echo $network['id']; ?>'><?php echo $network['data']; ?></option>
                                    <?php endforeach; ?>"
                                    ><?php echo $name['data']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="network_id">网络模式</label>
                        <div class="controls">
                            <select id="network_id" class="input-xlarge" name="network_id">
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="feature_id">配置</label>
                        <div class="controls">
                            <select id="feature_id" class="input-xlarge" name="feature_id">
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="appearance_id">外观</label>
                        <div class="controls">
                            <select id="appearance_id" class="input-xlarge" name="appearance_id">
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="number">序列号</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" id="number" name="number" value=""  data-href="<?php echo url('checkNumber'); ?>"><span id="number_message" style="color: brown"></span>
                            <input type="hidden" id="number_status" value="0"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="edition_id">固件版本</label>
                        <div class="controls">
                            <select id="edition_id" class="input-xlarge" name="edition_id">
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="memo">商品备注</label>
                        <div class="controls">
                            <textarea class="input-xlarge" name="memo" id="memo" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="price">进货价格</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" id="price" name="price" value="">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="channel_id">进货渠道</label>
                        <div class="controls">
                            <select id="channel_id" class="input-xlarge" name="channel_id">
                                <?php foreach($channels as $channel): ?>
                                    <option value="<?php echo $channel['id']; ?>"><?php echo $channel['data']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="submit"></label>
                        <button class="btn btn-success" type="submit" id="submit">确定</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

<div id="data-all" style="display: none">
    <?php foreach($names as $name): ?>
        <option value="<?php echo $name['id']; ?>" data-category-id="<?php echo $name['category_id']; ?>" data-appearance="
        <?php foreach($name['itemAppearance'] as $appearance): ?>
            <option value='<?php echo $appearance['id']; ?>'><?php echo $appearance['data']; ?></option>
        <?php endforeach; ?>"  data-edition="
        <?php foreach($name['itemEdition'] as $edition): ?>
            <option value='<?php echo $edition['id']; ?>'><?php echo $edition['data']; ?></option>
        <?php endforeach; ?>"  data-feature="
        <?php foreach($name['itemFeature'] as $feature): ?>
            <option value='<?php echo $feature['id']; ?>'><?php echo $feature['data']; ?></option>
        <?php endforeach; ?>"
        data-network="
        <?php foreach($name['itemNetwork'] as $network): ?>
            <option value='<?php echo $network['id']; ?>'><?php echo $network['data']; ?></option>
        <?php endforeach; ?>"
        ><?php echo $name['data']; ?></option>
    <?php endforeach; ?>
</div>
<script src="/static/js/jquery-1.8.3.js"></script>
<script>

    function changeNameSelected(){

        var category_id = $("#name_id option:selected").data("category-id");
        $("#category_id").val(category_id);

        var appearance_str = $("#name_id option:selected").data("appearance");
        $("#appearance_id").html(appearance_str)

        var edition_str = $("#name_id option:selected").data("edition");
        $("#edition_id").html(edition_str)

        var feature_str = $("#name_id option:selected").data("feature");
        $("#feature_id").html(feature_str)

        var network_str = $("#name_id option:selected").data("network");
        $("#network_id").html(network_str)
    }

    function changeTypeValue(){

        var type = $("#type_id").val();
        var url = $("#type_id").data('href');

        if (type == '') {

            var str = $("#data-all").html();
            $("#name_id").html(str);
            changeNameSelected();
            $("#name_id").removeAttr("readonly");
            $("#name_id").removeAttr("onmousedown");
            $("#network_id").removeAttr("readonly");
            $("#network_id").removeAttr("onmousedown");
            $("#type_message").html('')
            $("#type_status").val(1)
        } else {
            $.get(url, {type:type}, function(res) {
           
                if (res.code  == 500) {
                    alert(res.data);
                    $("#type_message").html(res.data)
                    $("#type_status").val(0)
                }  else {

                    var str = '';
                    $.each(res.data, function(k, v){

                        str += '<option value="'+v.itemName.id+'" data-category-id="'+v.itemName.category_id+'" data-appearance="';
                        $.each(v.itemName.itemAppearance, function (kk, vv){
                            str += "<option value='"+vv.id+"'>"+vv.data+"</option>";
                        })
                        str += '" data-edition="';
                        $.each(v.itemName.itemEdition, function (kk, vv){
                            str += "<option value='"+vv.id+"'>"+vv.data+"</option>";
                        })
                        str += '" data-feature="';
                        $.each(v.itemName.itemFeature, function (kk, vv){
                            str += "<option value='"+vv.id+"'>"+vv.data+"</option>";
                        })
                        str += '" data-network="';
                        str += "<option value='"+v.itemNetwork.id+"'>"+v.itemNetwork.data+"</option>";
                        str += '">'+v.itemName.data+'</option>';
                    });
                        
                    $("#name_id").html(str);
                    changeNameSelected();
                    $("#type_message").html('')
                    $("#type_status").val(1)
                }

                $("#name_id").attr("readonly","readonly");
                $("#name_id").attr("onmousedown","return false;");
                $("#network_id").attr("readonly","readonly");
                $("#network_id").attr("onmousedown","return false;");
            })      
        }
        
    }

    function changeNumber(){
        var val = $("#number").val();
        var url = $("#number").data('href');
    
        if (val == '') {

            $("#number_status").val(0);
            $("#number_message").html('序列号不能为空');
        } else {
            $.get(url, {number:val}, function(res){

                if (res.code == 200) {
                    $("#number_status").val(1);
                    $("#number_message").html('');
                } else {
                    $("#number_status").val(0);
                    $("#number_message").html(res.data);
                }
            })
        }
    }


    $(function () {

        
        $("#name_id").change(function () {
            changeNameSelected();
        });

        $("#type_id").change(function(){
            changeTypeValue();
        })

        $("#number").change(function(){
            changeNumber();
        })

        changeNameSelected();

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
            minDate: "-2D",
            maxDate: "+0D"
        });

        $('#date').datepicker("setDate", '+0D');


        $("#submit").click(function(){

            var number = $("#number").val();
            if (number == '') {
                $("#number_message").html('序列号不能为空');
            }

            var type_status = $("#type_status").val();
            var number_status = $("#number_status").val();

            if (type_status == 1 && number_status == 1) {
                $("#form").submit();
            } else {
                return false;
            }
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