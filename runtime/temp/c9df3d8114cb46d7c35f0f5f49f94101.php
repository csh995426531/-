<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:73:"/data/www/y5g/public/../application/index/view/members/update_access.html";i:1593399268;s:48:"/data/www/y5g/application/index/view/layout.html";i:1592482662;}*/ ?>
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
        <div class="layui-col-md12">
            <div class="layui-card" style="height: 1100px;">
                <div class="layui-card-header">筛选条件</div>
                <form class="layui-form" method="get" id="form" data-action="<?php echo url('/members/updateAccess'); ?>">
                    <div class="layui-card-body" style="height: 600px;">
                        <div class="layui-form-item">
                            <div class="layui-inline">
                                <label class="layui-form-label">选择账号</label>
                                <div class="layui-input-inline">
                                    <select id="user_id" name="user_id" lay-filter="user_id"
                                        lay-verify="required">
                                        <?php foreach($users as $user): ?>
                                        <option value="<?php echo $user['id']; ?>" data-nodes="<?php echo json_encode($user['nodes'] ); ?>" <?php echo $user_id==$user['id']?'selected' : ''; ?>><?php echo $user['username']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item">

                            <div id="test12" class="demo-tree-more"></div>
                        </div>
                        <div class="layui-form-item">
                            <label for="L_repass" class="layui-form-label"></label>
                            <button class="layui-btn layui-btn-lg" lay-filter="submit" type="submit"
                                lay-submit>确定</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="all_nodes_data" style="display: none;"><?php echo json_encode($nodes); ?></div>
<script>
    layui.use(['tree', 'form','util'], function () {
        var tree = layui.tree
        , form = layui.form
        , layer = layui.layer
        , util = layui.util
        , all_nodes_data = []

        var all_nodes_data_temp = layui.$.parseJSON( layui.$('#all_nodes_data').html() );

        layui.$.each(all_nodes_data_temp, function(k, v) {
            var temp = {
                title: v.name,
                id: k,
                spread: false,
                children: []
            }

            layui.$.each(v.children, function(kk, vv) {
                var children_temp = {
                    title: vv.name,
                    id: vv.id,
                    checked: false
                }
                temp.children.push(children_temp);
            })
            all_nodes_data.push(temp);
        });
     
        all_nodes_data_temp = select_user_id(all_nodes_data);
    
        //基本演示
        tree.render({
            elem: '#test12'
            , data: all_nodes_data_temp
            , showCheckbox: true  //是否显示复选框
            , id: 'demoId1'
            , isJump: false //是否允许点击节点时弹出新窗口跳转
        });

        form.on('select(user_id)', function(){
            all_nodes_data_temp = select_user_id(all_nodes_data);
            tree.reload('demoId1', {
                elem: '#test12'
                , data: all_nodes_data_temp
                , showCheckbox: true  //是否显示复选框
                , id: 'demoId1'
                , isJump: false //是否允许点击节点时弹出新窗口跳转
            });
        });

        //监听提交
        form.on('submit(submit)',
            function (data) {
                var url = layui.$("#form").data('action');
                var checkedData = tree.getChecked('demoId1'); //获取选中节点的数据
                var data = {
                    user_id: layui.$("#user_id option:selected").val(),
                    node_ids: []
                }
                layui.$.each(checkedData, function(k1, v1) {
                    layui.$.each(v1.children, function(k2, v2) {
                        data.node_ids.push(v2.id);
                    })
                })
                layui.$.post(url, data, function (res) {
                    if (res.code == 200) {
                        layer.alert("保存成功", {
                            icon: 6
                        }, function () {
                            //关闭当前frame
                            window.layer.close();
                            // 可以对父窗口进行刷新 
                            window.location.reload();
                        })
                    } else {
                        layer.alert(res.data, {
                            icon: 5
                        })
                    }
                });
                return false;
            }
        );
    });

    function select_user_id(all_nodes_data) {
 
        all_nodes_data_temp = JSON.parse(JSON.stringify(all_nodes_data));
        nodes = layui.$("#user_id option:selected").data("nodes");

        layui.$.each(nodes, function (a,b) {

            layui.$.each(all_nodes_data_temp, function(aa, bb) {
                layui.$.each(bb.children, function(aaa, bbb) {
                    if (bbb.id == b) {
                        bbb.checked = true;
                        bb.spread = true;
                    }
                })
            })
        })
     
        return all_nodes_data_temp;
    }
</script>
</html>