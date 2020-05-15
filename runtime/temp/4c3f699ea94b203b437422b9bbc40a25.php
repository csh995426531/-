<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:66:"/data/www/y5g/public/../application/index/view/item/inventory.html";i:1589515005;s:48:"/data/www/y5g/application/index/view/layout.html";i:1589513789;}*/ ?>
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
<body>

    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-form layui-card-header layuiadmin-card-header-auto">
                        <form class="layui-form layui-col-space5" method="get">
                            <div class="layui-input-inline layui-show-xs-block">
                                <select  name="type_id">
                                    <option value=""> - 型号 - </option>
                                    <?php foreach($types as $type): ?>
                                    <option value="<?php echo $type['data']; ?>" <?php echo \think\Request::instance()->get('type_id')==$type['data']?'selected' :''; ?>><?php echo $type['data']; ?></opion>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <select  name="type_id">
                                <option value=""> - 型号 - </option>
                            </select>
                            <span id="data-all" style="display:none"><?php echo json_encode($data); ?></span>
                            <div class="layui-input-inline layui-show-xs-block">
                                <select id="name_id" name="name_id" lay-filter="name_id" data-href="<?php echo url('/index/item/changeName'); ?>">
                                    <option value=""> - 名称 - </option>
                                    <?php foreach($names as $name): ?>
                                    <option value="<?php echo $name['data']; ?>" <?php echo \think\Request::instance()->get('name_id')==$name['data']?'selected' :''; ?>><?php echo $name['data']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="layui-input-inline layui-show-xs-block">
                                <select id="network_id" name="network_id">
                                    <option value=""> - 网络模式 - </option>
                                    <?php foreach($networks as $network): ?>
                                    <option value="<?php echo $network['data']; ?>" <?php echo \think\Request::instance()->get('network_id')==$network['data']?'selected' :''; ?>><?php echo $network['data']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="layui-input-inline layui-show-xs-block">
                                <select  id="feature_id"name="feature_id" lay-filter="feature_id" class="form-control">
                                    <option value=""> - 配置 - </option>
                                    <?php foreach($features as $feature): ?>
                                        <option value="<?php echo $feature['data']; ?>" <?php echo \think\Request::instance()->get('feature_id')==$feature['data']?'selected' :''; ?>><?php echo $feature['data']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="layui-input-inline layui-show-xs-block">
                                <select id="appearance_id" name="appearance_id">
                                    <option value=""> - 外观 - </option>
                                    <?php foreach($appearances as $appearance): ?>
                                        <option value="<?php echo $appearance['data']; ?>" <?php echo \think\Request::instance()->get('appearance_id')==$appearance['data']?'selected' :''; ?>><?php echo $appearance['data']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="layui-input-inline layui-show-xs-block">
                                <select name="edition_id" id='edition_id'>
                                    <option value=""> - 固件版本 - </option>
                                    <?php foreach($editions as $edition): ?>
                                    <option value="<?php echo $edition['data']; ?>" <?php echo \think\Request::instance()->get('edition_id')==$edition['data']?'selected' :''; ?>><?php echo $edition['data']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="layui-inline layui-show-xs-block">
                                <input type="text" name="keyword"  placeholder="序列号" value="<?php echo \think\Request::instance()->get('keyword'); ?>" autocomplete="off" class="layui-input">
                            </div>
                            <div class="layui-inline layui-show-xs-block">
                                <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                            </div>
                        </form>
                    </div>
                    <div class="layui-card-body layui-table-body layui-table-main">
                        <table class="layui-table layui-form">
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>型号</th>
                                <th>分类</th>
                                <th>名称</th>
                                <th>网络模式</th>
                                <th>配置</th>
                                <th>外观</th>
                                <th>版本</th>
                                <th>序列号</th>
                                <th>参考售价</th>  
                                <th>备注</th> 
                                <th>状态</th>
                                <th>库龄</th>
                                <th class="actions">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php if(is_array($lists) || $lists instanceof \think\Collection || $lists instanceof \think\Paginator): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$temp): $mod = ($i % 2 );++$i;?> 
                                <tr  <?php if ($temp->status == \app\index\model\Item::STATUS_PREPARE) {echo 'style="background-color:#DCDCDC"';} ?> >
                                    <td><span><?php echo $temp['id']; ?></span></td>
                                    <th><span><?php echo $temp['itemType']['data']; ?></span></th>
                                    <th><span><?php echo $temp['itemCategory']['data']; ?></span></th>
                                    <th title="<?php echo $temp['memo']; ?>" style="cursor: pointer"><span><?php echo $temp['itemName']['data']; ?></span></th>
                                    <th><span><?php echo $temp['itemNetwork']['data']; ?></span></th>
                                    <th><span><?php echo $temp['itemFeature']['data']; ?></span></th>
                                    <th><span><?php echo $temp['itemAppearance']['data']; ?></span></th>
                                    <th><span><?php echo $temp['itemEdition']['data']; ?></span></th>
                                    <!-- <th><a href="<?php echo url('search'); ?>?keyword=<?php echo $temp['number']; ?>"><span style="color:coral;cursor: pointer;"><?php echo $temp['number']; ?></span></a></th> -->
                                    <th><a onclick="xadmin.open('综合查询','<?php echo url('search'); ?>?keyword=<?php echo $temp['number']; ?>','','',true)"><span style="color:coral;cursor: pointer;"><?php echo $temp['number']; ?></span></a></th>
                                    <th><span>><?php echo $temp['price']*1.1+120; ?></span></th>
                                    <th title="<?php echo $temp['memo']; ?>" style="cursor: pointer"><span><?php echo mb_strlen($temp->memo) > 6 ? mb_substr($temp->memo, 0, 6).'…' : $temp->memo; ?></span></th>
                                    <th title="<?php echo $temp['prepare']; ?>" style="cursor: pointer"><span><?php echo $temp['statusName']; ?></span></th>
                                    <th><span><?php echo floor((time() - strtotime($temp->date)) / 86400); ?>天</span></th>
                                    <td class="actions">
                                        <!--<a class="btn btn-small btn-danger" data-toggle="modal" href="#removeItem">删除</a>-->
                                        <?php if ($temp->status == \app\index\model\Item::STATUS_NORMAL) {?>
                                        <a class="layui-btn layui-btn-normal" onclick="xadmin.open('预售出库','<?php echo url('/index/popup/prepareItem'); ?>?id=<?php echo $temp['id']; ?>',600,300)" title="预售出库" href="javascript:;">
                                            <i class="layui-icon"></i>预售
                                        </button>
                                        <?php }elseif($temp->status == \app\index\model\Item::STATUS_PREPARE){?>
                                        <!-- <a class="btn btn-small btn-danger cancelPrepare-item" data-id="<?php echo $temp['id']; ?>" data-value="0" data-href="<?php echo url('cancelPrepare'); ?>">取消</a> -->
                                        <a class="layui-btn layui-btn-danger" onclick="member_del(this,<?php echo $temp['id']; ?>)" href="javascript:;" data-href="<?php echo url('/index/item/cancelPrepare'); ?>" title="取消预售" >
                                            <i class="layui-icon"></i>取消预售
                                        </a>
                                        <?php }?>
                                    </td>
                                  
                                </tr>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="layui-card-body ">
                        <div class="page">
                            <?php echo $lists->render(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
  
    <script>
    layui.use(['laydate','form','jquery'], function(){
        var laydate = layui.laydate;
        var form = layui.form;
        var jquery = layui.jquery;
        
        //执行一个laydate实例
        laydate.render({
          elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
          elem: '#end' //指定元素
        });
        
        //监听选择名称
        form.on('select(name_id)',
            function(obj) {
                var val = obj.value;
                var data;
                if (val != '') {
                    var url = obj.elem.getAttribute('data-href');
                    $.get(url, {name:val}, function(res){
                        data = res.data;
                        reset(data);
                    })
                } else {
                    data = jquery.parseJSON($("#data-all").html());
                    reset(data);
                }
            }
        );
    });

    /*用户-取消预售*/
    function member_del(obj,id){
        layer.confirm('确认要取消预售吗？',function(index){
            //发异步取消预售数据
            var url = $(obj).data('href');
            $.post(url, {id:id}, function (res) {
                layer.msg("已取消预售!", {
                    icon:1,
                    time:1000
                },function() {
                    //关闭当前frame
                    xadmin.close();
                    // 可以对父窗口进行刷新 
                    xadmin.father_reload();
                })
            });
            return false;
        });
    }


    function reset(data){
      var $ = layui.$
      ,form = layui.form
      ,table = layui.table;
      
      //监听搜索
      form.on('submit(LAY-app-forumreply-search)', function(data){
        var field = data.field;
        
        //执行重载
        table.reload('LAY-app-forumreply-list', {
          where: field
        });
      });
      
      var active = {
        batchdel: function(){
          var checkStatus = table.checkStatus('LAY-app-forumreply-list')
          ,checkData = checkStatus.data; //得到选中的数据
  
          if(checkData.length === 0){
            return layer.msg('请选择数据');
          }
        
          layer.confirm('确定删除吗？', function(index) {
            
            //执行 Ajax 后重载
            /*
            admin.req({
              url: 'xxx'
              //,……
            });
            */
            table.reload('LAY-app-forumreply-list');
            layer.msg('已删除');
          });
        }
      }
      
      $('.layui-btn.layuiadmin-btn-replys').on('click', function(){
        var type = $(this).data('type');
        active[type] ? active[type].call(this) : '';
      });
    });
    </script>
  </body>
</html>