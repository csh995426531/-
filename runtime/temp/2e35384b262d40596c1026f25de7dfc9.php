<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:61:"/data/www/y5g/public/../application/index/view/log/index.html";i:1592993335;s:48:"/data/www/y5g/application/index/view/layout.html";i:1592482662;}*/ ?>
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
    <div class="layui-card">
        <div class="layui-form layui-card-header layuiadmin-card-header-auto">
            <div class="layui-form-item">
                <div class="layui-inline">
                    <input class="layui-input" placeholder="日期" name="date" type="text" id="date"
                     autocomplete="off">
                </div>
                <div class="layui-inline">
                    <select id="user_id" name="user_id" lay-filter="user_id">
                        <option value="0"> - 操作人 - </option>
                        <?php foreach($users as $user): ?>
                        <option value="<?php echo $user['id']; ?>" <?php echo \think\Request::instance()->get('user_id')==$user['id']?'selected' :''; ?>><?php echo $user['username']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="layui-inline">
                    <select name="action">
                        <option value="0"> - 操作菜单 - </option>
                        <?php foreach($actions as $action): ?>
                        <option value="<?php echo $action; ?>" <?php echo \think\Request::instance()->get('action')==$action?'selected' :''; ?>><?php echo $action; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="layui-inline">
                    <select name="response">
                        <option value="0"> - 操作结果 - </option>
                        <?php foreach($responses as $key => $response): ?>
                        <option value="<?php echo $key; ?>" <?php echo \think\Request::instance()->get('response')==$key?'selected' :''; ?>><?php echo $response; ?></option>
                        <?php endforeach; ?>
                    </select>
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
    layui.use(['laydate', 'index', 'contlist', 'table', 'jquery'], function () {
        var table = layui.table
        var form = layui.form
        var jquery = layui.jquery
        var $ = layui.jquery
        var laydate = layui.laydate

        //执行一个laydate实例
        laydate.render({
            elem: '#date' //指定元素
            ,range: '~'
        });

        table.render({
            elem: '#table-list'
            , url: '/index/log/indexList' //数据接口
            , parseData: function (res) { //res 即为原始返回的数据
                return {
                    "code": 0, //解析接口状态
                    "msg": res.message, //解析提示文本
                    "count": res.total, //解析数据长度
                    "data": res.data //解析数据列表
                };
            }, page: true //开启分页
            , cols: [[ //表头
                { field: 'id', title: 'ID', minWidth: 60, sort: true, fixed: 'left' }
                , { field: 'create_time', title: '操作时间', minWidth: 60, sort: true, fixed: 'left' }
                , { field: 'username', title: '操作人', minWidth: 60, sort: true, templet: function (d) {
                        if (d.user != null) { return d.user.username } else { return '' }
                } }
                , {
                    field: 'action', title: '操作菜单', minWidth: 120
                }
                , {
                    field: 'request', title: '操作内容', minWidth: 120
                }
                , {
                    field: 'response', title: '操作结果', minWidth: 120
                }
            ]]
        });

        //监听搜索
        form.on('submit(filter-search)', function (data) {
            var field = data.field; console.log()
            //执行重载
            table.reload('table-list', {
                where: field,
                page: {
                    curr: 1 //重新从第 1 页开始
                }
            });
        });

        layui.$('.layui-btn.layuiadmin-btn-list').on('click', function () {
            var type = layui.$(this).data('type');
            active[type] ? active[type].call(this) : '';
        });

    });
</script>
</html>