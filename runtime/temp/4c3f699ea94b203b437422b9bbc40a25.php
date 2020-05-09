<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:66:"/data/www/y5g/public/../application/index/view/item/inventory.html";i:1589026824;s:48:"/data/www/y5g/application/index/view/layout.html";i:1589022923;}*/ ?>
<!doctype html>
<html class="x-admin-sm">
    <head>
        <meta charset="UTF-8">
        <title>库存管理</title>
        <meta name="renderer" content="webkit|ie-comp|ie-stand">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
        <meta http-equiv="Cache-Control" content="no-siteapp" />
        <link rel="stylesheet" href="/static/css/font.css">
        <link rel="stylesheet" href="/static/css/xadmin.css">
        <!-- <link rel="stylesheet" href="/static/css/theme5.css"> -->
        <script src="/static/lib/layui/layui.js" charset="utf-8"></script>
        <script type="text/javascript" src="/static/js/xadmin.js"></script>
        <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
        <!--[if lt IE 9]>
          <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
          <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script>
            // 是否开启刷新记忆tab功能
            // var is_remember = false;
        </script>
    </head>

<div class="main-area dashboard">
    
    <body>
        <div class="x-nav">
          <span class="layui-breadcrumb">
            <a href="">首页</a>
            <a href="">演示</a>
            <a>
              <cite>导航元素</cite></a>
          </span>
          <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload()" title="刷新">
            <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
        </div>
        <div class="layui-fluid">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body ">
                            <form class="layui-form layui-col-space5" method="get">
                                <div class="layui-input-inline layui-show-xs-block">
                                    <select  name="type_id">
                                        <option value=""> - 型号 - </option>
                                        <?php foreach($types as $type): ?>
                                        <option value="<?php echo $type['data']; ?>" <?php echo \think\Request::instance()->get('type_id')==$type['data']?'selected' :''; ?>><?php echo $type['data']; ?></opion>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <span id="data-all" style="display:none"><?php echo json_encode($data); ?></span>
                                <div class="layui-input-inline layui-show-xs-block">
                                    <select id="name_id" name="name_id"  data-href="<?php echo url('changeName'); ?>">
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
                                    <select  id="feature_id"name="feature_id" >
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
                             
                                        <th><a onclick="xadmin.open('库存搜索','<?php echo url('search'); ?>?keyword=<?php echo $temp['number']; ?>','','',true)"><span style="color:coral;cursor: pointer;"><?php echo $temp['number']; ?></span></a></th>
                    
                                      <th><span>><?php echo $temp['price']*1.1+120; ?></span></th>
                                      <th title="<?php echo $temp['memo']; ?>" style="cursor: pointer"><span><?php echo mb_strlen($temp->memo) > 6 ? mb_substr($temp->memo, 0, 6).'…' : $temp->memo; ?></span></th>
                                      
                                      
                                        <th title="<?php echo $temp['prepare']; ?>" style="cursor: pointer"><span><?php echo $temp['statusName']; ?></span></th>
                                        <th><span><?php echo floor((time() - strtotime($temp->date)) / 86400); ?>天</span></th>
                                        <td class="actions">
                                            <!--<a class="btn btn-small btn-danger" data-toggle="modal" href="#removeItem">删除</a>-->
                                            <?php if ($temp->status == \app\index\model\Item::STATUS_NORMAL) {?>
                                            <a class="layui-btn layui-btn-" onclick="xadmin.open('预售出库','<?php echo url('/index/popup/prepareItem'); ?>?id=<?php echo $temp['id']; ?>',600,300)" title="预售出库" href="javascript:;">
                                                <i class="layui-icon"></i>预售
                                            </button>
                                            <?php }elseif($temp->status == \app\index\model\Item::STATUS_PREPARE){?>
                                            <!-- <a class="btn btn-small btn-danger cancelPrepare-item" data-id="<?php echo $temp['id']; ?>" data-value="0" data-href="<?php echo url('cancelPrepare'); ?>">取消</a> -->
                                            <a title="删除" onclick="member_del(this,<?php echo $temp['id']; ?>)" href="javascript:;">
                                                <i class="layui-icon">&#xe640;</i>
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
    </body>
    <script>
      layui.use(['laydate','form'], function(){
        var laydate = layui.laydate;
        var  form = layui.form;


        // 监听全选
        form.on('checkbox(checkall)', function(data){

          if(data.elem.checked){
            $('tbody input').prop('checked',true);
          }else{
            $('tbody input').prop('checked',false);
          }
          form.render('checkbox');
        }); 
        
        //执行一个laydate实例
        laydate.render({
          elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
          elem: '#end' //指定元素
        });


      });

       /*用户-停用*/
      function member_stop(obj,id){
          layer.confirm('确认要停用吗？',function(index){

              if($(obj).attr('title')=='启用'){

                //发异步把用户状态进行更改
                $(obj).attr('title','停用')
                $(obj).find('i').html('&#xe62f;');

                $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                layer.msg('已停用!',{icon: 5,time:1000});

              }else{
                $(obj).attr('title','启用')
                $(obj).find('i').html('&#xe601;');

                $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                layer.msg('已启用!',{icon: 5,time:1000});
              }
              
          });
      }

      /*用户-删除*/
      function member_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){
              //发异步删除数据
              $(obj).parents("tr").remove();
              layer.msg('已删除!',{icon:1,time:1000});
          });
      }



      function delAll (argument) {
        var ids = [];

        // 获取选中的id 
        $('tbody input').each(function(index, el) {
            if($(this).prop('checked')){
               ids.push($(this).val())
            }
        });
  
        layer.confirm('确认要删除吗？'+ids.toString(),function(index){
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
        });
      }
    </script>

</div>