<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:69:"/data/www/y5g/public/../application/index/view/statistics/profit.html";i:1592559014;s:48:"/data/www/y5g/application/index/view/layout.html";i:1592482662;}*/ ?>
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
        }).use(['index', 'admin', 'carousel']);
    </script>
</head>

  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md6">
        <div class="layui-card">
          <div class="layui-card-header">筛选条件</div>
          <form class="layui-form" method="get">
            <div class="layui-card-body" style="height: 600px;">
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">开始日期</label>
                        <div class="layui-input-inline">
                            <input class="layui-input" placeholder="开始日期" name="start_date" type="text" id="start_date" value="<?php echo \think\Request::instance()->get('start_date'); ?>"
                             autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">结束日期</label>
                        <div class="layui-input-inline">
                            <input class="layui-input" placeholder="结束日期" name="end_date" type="text" id="end_date" value="<?php echo \think\Request::instance()->get('end_date'); ?>"
                             autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">产品名称</label>
                        <div class="layui-input-inline">
                            <select id="name_id" class="" name="name_id" lay-filter="outgo_channel_id">
                                <option value="0"> -  - </option>
                                <?php foreach($names as $name): ?>
                                <option value="<?php echo $name['id']; ?>" <?php echo \think\Request::instance()->get('name_id')==$name['id']?'selected' :''; ?>><?php echo $name['data']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">进货渠道</label>
                        <div class="layui-input-inline">
                            <select id="income_channel_id" class="" name="income_channel_id" lay-filter="outgo_channel_id">
                                <option value="0"> -  - </option>
                                <?php foreach($income_channels as $channel): ?>
                                <option value="<?php echo $channel['id']; ?>" <?php echo \think\Request::instance()->get('income_channel_id')==$channel['id']?'selected' :''; ?>><?php echo $channel['data']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">进货人</label>
                        <div class="layui-input-inline">
                            <select id="create_user_id" class="" name="create_user_id" lay-filter="outgo_channel_id">
                                <option value="0"> -  - </option>
                                <?php foreach($create_users as $createUser): ?>
                                <option value="<?php echo $createUser['id']; ?>" <?php echo \think\Request::instance()->get('create_user_id')==$createUser['id']?'selected' :''; ?>><?php echo $createUser['username']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">出货途径</label>
                        <div class="layui-input-inline">
                            <select id="outgo_channel_id" class="" name="outgo_channel_id" lay-filter="outgo_channel_id">
                                <option value="0"> -  - </option>
                                <?php foreach($outgo_channels as $channel): ?>
                                <option value="<?php echo $channel['id']; ?>" <?php echo \think\Request::instance()->get('outgo_channel_id')==$channel['id']?'selected' :''; ?>><?php echo $channel['data']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <button class="layui-btn layuiadmin-btn-list" name="sub" value="search">搜索</button>
                    </div>
                    <div class="layui-inline">
                        <button class="layui-btn layuiadmin-btn-list" name="sub" value="excel">导出excel</button>
                    </div>
                </div>
            </div>
          </form>
        </div>
      </div>
      <div class="layui-col-md6">
        <div class="layui-card">
          <div class="layui-card-header">筛选结果</div>
          <div class="layui-card-body" style="height: 600px;">
            <div class="layui-carousel layadmin-carousel layadmin-dataview" data-anim="fade" lay-filter="LAY-index-heaparea">

                <p>进货总数量：<?php echo $income_count; ?></p>
                <p>进货总价格：<?php echo $income_price; ?></p>
                <p>平均进货价格：<?php echo $ave_income_price; ?></p>
                <p>销售总数量：<?php echo $outgo_count; ?></p>
                <p>平均销售价格：<?php echo $ave_outgo_price; ?></p>
                <p>总利润：<?php echo $profit; ?></p>
                <p>平均利润：<?php echo $ave_profit; ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


<script>
    layui.use(['laydate', 'form', 'layer'], function () {
        var laydate = layui.laydate;
        $ = layui.jquery;
        var form = layui.form,
        layer = layui.layer;

        //执行一个laydate实例
        laydate.render({
          elem: '#start_date' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
          elem: '#end_date' //指定元素
        });
        //监听搜索
        form.on('submit(filter-search)', function(data){
            var field = data.field;console.log(field)


        });
    })
</script>



</html>