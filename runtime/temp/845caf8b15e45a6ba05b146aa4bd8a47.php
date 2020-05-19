<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:63:"/data/www/y5g/public/../application/index/view/item/income.html";i:1587368219;s:48:"/data/www/y5g/application/index/view/layout.html";i:1589513789;}*/ ?>
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
                    <th>ID</th>
                    <th>审核状态</th>
                     <!-- <th>型号</th>-->
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
                    <td><span><?php echo $temp['id']; ?></span></td>
                    <td><span><?php echo $temp->getStatusName(); ?></span></td>
                      <!-- <th><span><?php echo $temp['item']['itemType']['data']; ?></span></th>-->
                    <th><span><?php echo $temp['item']['itemName']['data']; ?></span></th>
                    <th><span><?php echo $temp['item']['itemNetwork']['data']; ?></span></th>
                    <th><span><?php echo $temp['item']['itemFeature']['data']; ?></span></th>
                    <th><span><?php echo $temp['item']['itemAppearance']['data']; ?></span></th>
                   
                    <th><a href="https://checkcoverage.apple.com/cn/zh/?sn=<?php echo $temp['item']['number']; ?>" target="_blank"><span><?php echo $temp['item']['number']; ?></span></a></th>
                    <th><span><?php echo $temp['item']['itemEdition']['data']; ?></span></th>
                    <!-- <th><span><?php echo $temp['item']['memo']; ?></span></th> -->
                    <th><span><?php echo $temp['item']['price']; ?></span></th>
                    <th><span><?php echo $temp['item']['itemChannel']['data']; ?></span></th>
                    <td><span><?php echo $temp['createUser']['username']; ?></span></td>
                    <td><span><?php echo $temp['create_time']; ?></span></td>
                
                    <td class="actions">
                        <!--<a class="btn btn-small btn-danger" data-toggle="modal" href="#removeItem">删除</a>-->
                        <?php if($temp['create_user_id'] == $userId): ?>
                        <a class="btn btn-small btn-success update-item" data-id="<?php echo $temp['id']; ?>" data-value="1" data-href="<?php echo url('addIncome'); ?>">修改</a>
                        <?php endif; ?>
                        <!--<a class="btn btn-small btn-danger delete-item" data-id="<?php echo $temp['id']; ?>" data-value="0" data-href="<?php echo url('deleteAgree'); ?>">删除</a>-->
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

        $(".delete-item").click(function(){
            var url = $(this).data('href');
            var id = $(this).data('id');
            $.post(url, {id:id}, function (res) {
                alert(res.data);
                window.location.replace("<?php echo url('income');?>");
            })
        })

        $(".update-item").click(function(){
            var url = $(this).data('href');
            var id = $(this).data('id');
            url = url + '?id=' + id;
            window.location.replace(url);
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
</html>