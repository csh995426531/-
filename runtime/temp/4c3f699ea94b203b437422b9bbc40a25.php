<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:66:"/data/www/y5g/public/../application/index/view/item/inventory.html";i:1589888942;s:48:"/data/www/y5g/application/index/view/layout.html";i:1589513789;}*/ ?>
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

    <div class="layui-fluid">
        <div class="layui-card">
            <div class="layui-form layui-card-header layuiadmin-card-header-auto">
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <select name="type_id">
                            <option value=""> - 型号 - </option>
                            <?php foreach($types as $type): ?>
                            <option value="<?php echo $type['data']; ?>" <?php echo \think\Request::instance()->get('type_id')==$type['data']?'selected' :''; ?>><?php echo $type['data']; ?>
                                </opion>
                                <?php endforeach; ?>
                        </select>
                    </div>
                    <span id="data-all" style="display:none"><?php echo json_encode($data); ?></span>
                    <div class="layui-inline">
                        <select id="name_id" name="name_id" lay-filter="name_id"
                            data-href="<?php echo url('/index/item/changeName'); ?>">
                            <option value=""> - 名称 - </option>
                            <?php foreach($names as $name): ?>
                            <option value="<?php echo $name['data']; ?>" <?php echo \think\Request::instance()->get('name_id')==$name['data']?'selected' :''; ?>><?php echo $name['data']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="layui-inline">
                        <select id="network_id" name="network_id">
                            <option value=""> - 网络模式 - </option>
                            <?php foreach($networks as $network): ?>
                            <option value="<?php echo $network['data']; ?>" <?php echo \think\Request::instance()->get('network_id')==$network['data']?'selected' :''; ?>>
                                <?php echo $network['data']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="layui-inline">
                        <select id="feature_id" name="feature_id" lay-filter="feature_id" class="form-control">
                            <option value=""> - 配置 - </option>
                            <?php foreach($features as $feature): ?>
                            <option value="<?php echo $feature['data']; ?>" <?php echo \think\Request::instance()->get('feature_id')==$feature['data']?'selected' :''; ?>>
                                <?php echo $feature['data']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="layui-inline">
                        <select id="appearance_id" name="appearance_id">
                            <option value=""> - 外观 - </option>
                            <?php foreach($appearances as $appearance): ?>
                            <option value="<?php echo $appearance['data']; ?>" <?php echo \think\Request::instance()->get('appearance_id')==$appearance['data']?'selected'
                                :''; ?>><?php echo $appearance['data']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="layui-inline">
                        <select name="edition_id" id='edition_id'>
                            <option value=""> - 固件版本 - </option>
                            <?php foreach($editions as $edition): ?>
                            <option value="<?php echo $edition['data']; ?>" <?php echo \think\Request::instance()->get('edition_id')==$edition['data']?'selected' :''; ?>>
                                <?php echo $edition['data']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="layui-inline">
                        <input type="text" name="keyword" placeholder="序列号" value="<?php echo \think\Request::instance()->get('keyword'); ?>"
                            autocomplete="off" class="layui-input">

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
        layui.use(['index', 'contlist', 'table', 'jquery'], function () {
            var table = layui.table
            var form = layui.form
            var jquery = layui.jquery
            var $ = layui.jquery

            table.render({
                elem: '#table-list'
                , url: '/index/item/inventoryList' //数据接口
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
                    , {
                        field: 'itemType', title: '型号', minWidth: 80, templet: function (d) {
                            if (d.itemType != null) { return d.itemType.data } else { return '' }
                        }
                    }
                    , {
                        field: 'itemCategory', title: '分类', minWidth: 120, templet: function (d) {
                            if (d.itemCategory != null) { return d.itemCategory.data } else { return '' }
                        }
                    }
                    , {
                        field: 'itemName', title: '名称', minWidth: 120, templet: function (d) {
                            if (d.itemType != null) {
                                return '<div title="' + d.memo + '" style="cursor: pointer">' + d.itemName.data + '</div>'
                            } else { return '' }
                        }
                    }
                    , {
                        field: 'itemNetwork', title: '网络模式', minWidth: 120, templet: function (d) {
                            if (d.itemNetwork != null) { return d.itemNetwork.data } else { return '' }
                        }
                    }
                    , {
                        field: 'itemFeature', title: '配置', minWidth: 120, templet: function (d) {
                            if (d.itemFeature != null) { return d.itemFeature.data } else { return '' }
                        }
                    }
                    , {
                        field: 'itemAppearance', title: '外观', minWidth: 120, templet: function (d) {
                            if (d.itemAppearance != null) { return d.itemAppearance.data } else { return '' }
                        }
                    }
                    , {
                        field: 'itemEdition', title: '版本', minWidth: 120, templet: function (d) {
                            if (d.itemEdition != null) { return d.itemEdition.data } else { return '' }
                        }
                    }
                    , {
                        field: 'number', title: '序列号', minWidth: 150, templet: function (d) {
                            return '<a lay-text="综合查询" lay-href="/index/item/search?keyword=' + d.number + '"><span style="color:coral;cursor: pointer;">' + d.number + '</span></a>';
                        }
                    }
                    , {
                        field: 'price', title: '参考售价', minWidth: 120, sort: true, templet: function (d) {
                            return (d.price * 1.1 + 120).toFixed(2);
                        }
                    }
                    , {
                        field: 'memo', title: '备注', minWidth: 120, templet: function (d) {
                            return '<div title="' + d.memo + '" style="cursor: pointer">' + d.memo + '</div>';
                        }
                    }
                    , {
                        field: 'status', title: '状态', minWidth: 80, templet: function (d) {
                            return '<div title="' + d.prepare + '" style="cursor: pointer">' + d.statusName + '</div>';
                        }
                    }
                    , {
                        field: 'age', title: '库龄', minWidth: 80, sort: true, templet: function (d) {
                            return d.age + '天';
                        }
                    }
                    , {
                        fixed: 'right', title: '操作', minWidth: 100, templet: function (d) {
                            if (d.status == "<?php echo \app\index\model\Item::STATUS_NORMAL;?>") {
                                return '<a class="layui-btn-sm layui-btn layui-btn-normal" onclick="member_prepare(this,' + d.id + ')" data-href="/index/popup/prepareItem?id=' + d.id + '" lay-text="预售出库">预售</a>';
                            } else if (d.status == "<?php echo \app\index\model\Item::STATUS_PREPARE;?>") {
                                return '<a class="layui-btn-sm layui-btn layui-btn-danger" onclick="member_del(this,' + d.id + ')" data-id="' + d.id + '" href="javascript:;" data-href="/index/item/cancelPrepare" >取消预售</a>';
                            } else {
                                return ''
                            }
                        }
                    }
                ]]
            });

            //监听选择名称
            form.on('select(name_id)',
                function (obj) {
                    var val = obj.value;
                    var data;
                    if (val != '') {
                        var url = obj.elem.getAttribute('data-href');
                        layui.$.get(url, { name: val }, function (res) {
                            data = res.data;
                            reset(data);
                        })
                    } else {
                        data = jquery.parseJSON(layui.$("#data-all").html());
                        reset(data);
                    }
                }
            );

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

        /*用户-取消预售*/
        function member_del(obj, id) {
            layer.confirm('确认要取消预售吗？', function (index) {
                //发异步取消预售数据
                var url = layui.$(obj).data('href');
                layui.$.post(url, { id: id }, function (res) {
                    layer.msg("已取消预售!", {
                        icon: 1,
                        time: 1000
                    }, function (index) {
                        layui.table.reload('table-list'); //重载表格
                        layer.close(index); //再执行关闭 
                    })
                });
                return false;
            });
        }

        /*用户-预售*/
        function member_prepare(obj, id) {
            layer.open({
                type: 2
                , title: '预售'
                , content: [layui.$(obj).data('href'), 'no']
                , maxmin: true
                , area: ['550px', '300px']
                , yes: function (index, layero) {
                    //点击确认触发 iframe 内容中的按钮提交
                    var submit = layero.find('iframe').contents().find("#save");
                    submit.click();
                }
            });
        }

        //重置对应的网络模式
        function reset(data) {
            var features_str = '<option value=""> - 配置 - </option>';
            // $("select[name=feature_id]").append(features_str);
            layui.$.each(data.features, function (k, v) {
                features_str += '<option value="' + v.data + '"> ' + v.data + ' </option>';
            })

            var networks_str = '<option value=""> - 网络模式 - </option>';
            layui.$.each(data.networks, function (k, v) {
                networks_str += '<option value="' + v.data + '"> ' + v.data + ' </option>';
            })

            var appearances_str = '<option value=""> - 外观 - </option>';
            layui.$.each(data.appearances, function (k, v) {
                appearances_str += '<option value="' + v.data + '"> ' + v.data + ' </option>';
            })

            layui.$('#feature_id').html(features_str);
            layui.$('#network_id').html(networks_str);
            layui.$('#appearance_id').html(appearances_str);
            layui.form.render('select');
        }
    </script>

</html>