<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:73:"/data/www/y5g/public/../application/index/view/members/update_access.html";i:1574522255;s:48:"/data/www/y5g/application/index/view/layout.html";i:1592482662;}*/ ?>
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
<?php echo $message; ?>
<div class="row">
    <div class="span12">
        <div class="">
            <div class="page-header">
                <h2>权限修改</h2>
            </div>
            <form class="form-horizontal" method="post">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="user_id">选择账号<?php echo $user_id; ?></label>
                        <div class="controls">
                            <select id="user_id" class="input-xlarge" name="user_id">
                                <?php foreach($users as $user): ?>
                                <option value="<?php echo $user['id']; ?>" data-nodes="<?php echo json_encode($user['nodes'] ); ?>" <?php echo $user_id==$user['id']?'selected' : ''; ?>><?php echo $user['username']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="nodes">选择权限</label>
                        <div class="controls">
                            <?php foreach($nodes as $parent): ?>
                                <p style="margin-top: 6px">
                                    <h5 style="font-weight: bold"><?php echo $parent['name']; ?></h5>
                                    <?php foreach($parent['children'] as $node): ?>
                                        <label style="display: initial;cursor: pointer"><input class="nodes" id="nodes_<?php echo $node['id']; ?>" type="checkbox" name="nodes[<?php echo $node['id']; ?>]" value="<?php echo $node['id']; ?>" /><?php echo $node['name']; ?></label>
                                    <?php endforeach; ?>
                                </p>
                            <?php endforeach; ?>
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
<script src="/static/js/jquery.min.js"></script>
<script>
    $(function(){

        function select_user_id() {
            var nodes = $("#user_id option:selected").data("nodes");
            $(".nodes").prop("checked",false)
            $.each(nodes, function (k,v) {

                var name = 'nodes_' + v;
                $("#"+name+"").prop("checked",true)
            })
        }

        select_user_id();

        $("#user_id").change(function() {
            select_user_id();
        })
    })
</script>
</html>