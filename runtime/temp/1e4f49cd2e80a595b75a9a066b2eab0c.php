<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:63:"/data/www/y5g/public/../application/index/view/index/index.html";i:1589022921;s:48:"/data/www/y5g/application/index/view/layout.html";i:1589022923;}*/ ?>
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
    
    <body class="index">
        <!-- 顶部开始 -->
        <div class="container">
            <div class="logo">
                <a href="./index.html">X-admin v2.2</a></div>
            <div class="left_open">
                <a><i title="展开左侧栏" class="iconfont">&#xe699;</i></a>
            </div>
            <ul class="layui-nav left fast-add" lay-filter="">
                <li class="layui-nav-item">
                    <a href="javascript:;">+新增</a>
                    <dl class="layui-nav-child">
                        <!-- 二级菜单 -->
                        <dd>
                            <a onclick="xadmin.open('最大化','http://www.baidu.com','','',true)">
                                <i class="iconfont">&#xe6a2;</i>弹出最大化</a></dd>
                        <dd>
                            <a onclick="xadmin.open('弹出自动宽高','http://www.baidu.com')">
                                <i class="iconfont">&#xe6a8;</i>弹出自动宽高</a></dd>
                        <dd>
                            <a onclick="xadmin.open('弹出指定宽高','http://www.baidu.com',500,300)">
                                <i class="iconfont">&#xe6a8;</i>弹出指定宽高</a></dd>
                        <dd>
                            <a onclick="xadmin.add_tab('在tab打开','member-list.html')">
                                <i class="iconfont">&#xe6b8;</i>在tab打开</a></dd>
                        <dd>
                            <a onclick="xadmin.add_tab('在tab打开刷新','member-del.html',true)">
                                <i class="iconfont">&#xe6b8;</i>在tab打开刷新</a></dd>
                    </dl>
                </li>
            </ul>
            <ul class="layui-nav right" lay-filter="">
                <li class="layui-nav-item">
                    <a href="javascript:;">admin</a>
                    <dl class="layui-nav-child">
                        <!-- 二级菜单 -->
                        <dd>
                            <a onclick="xadmin.open('个人信息','http://www.baidu.com')">个人信息</a></dd>
                        <dd>
                            <a onclick="xadmin.open('切换帐号','http://www.baidu.com')">切换帐号</a></dd>
                        <dd>
                            <a href="./login.html">退出</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item to-index">
                    <a href="/">前台首页</a></li>
            </ul>
        </div>
        <!-- 顶部结束 -->
        <!-- 中部开始 -->
        <!-- 左侧菜单开始 -->
        <div class="left-nav">
            <div id="side-nav">
                <ul id="nav">
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="库存查询">&#xe6b8;</i>
                            <cite>库存查询</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="xadmin.add_tab('在库查询','/index/item/inventory.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>在库查询</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('综合查询','member-list.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>综合查询</cite></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="产品入库">&#xe723;</i>
                            <cite>产品入库</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="xadmin.add_tab('采购入库','order-list.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>采购入库</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('批量入库','order-list1.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>批量入库</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('入库待核','order-list1.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>入库待核</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('退货入库','order-list1.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>退货入库</cite></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="产品出库">&#xe723;</i>
                            <cite>产品出库</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="xadmin.add_tab('销售出库','cate.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>销售出库</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('维修登记','cate.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>维修登记</cite></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="操作审核">&#xe723;</i>
                            <cite>操作审核</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="xadmin.add_tab('入库审核','city.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>入库审核</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('出库审核','city.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>出库审核</cite></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="统计功能">&#xe726;</i>
                            <cite>统计功能</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="xadmin.add_tab('30天统计','admin-list.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>30天统计</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('数据统计','admin-role.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>数据统计</cite></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="仓库盘点">&#xe6ce;</i>
                            <cite>仓库盘点</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="xadmin.add_tab('仓库盘点','echarts1.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>仓库盘点</cite></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="基础设置">&#xe6b4;</i>
                            <cite>基础设置</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="xadmin.add_tab('产品类别','unicode.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>产品类别</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('产品名称','unicode.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>产品名称</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('网络型号','unicode.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>网络型号</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('产品配置','unicode.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>产品配置</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('产品外观','unicode.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>产品外观</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('产品版本','unicode.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>产品版本</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('渠道录入','unicode.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>渠道录入</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('智能识别码录入','unicode.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>智能识别码录入</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('特殊修改','unicode.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>特殊修改</cite></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="角色管理">&#xe6b4;</i>
                            <cite>角色管理</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="xadmin.add_tab('添加账号','error.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>添加账号</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('密码修改','error.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>密码修改</cite></a>
                            </li>
                            <li>
                                <a onclick="xadmin.add_tab('权限修改','demo.html')">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>权限修改</cite></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont left-nav-li" lay-tips="系统日志">&#xe6b4;</i>
                            <cite>系统日志</cite>
                            <i class="iconfont nav_right">&#xe697;</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a onclick="xadmin.add_tab('系统日志','https://fly.layui.com/extend/sliderVerify/')" target="">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>系统日志</cite></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- <div class="x-slide_left"></div> -->
        <!-- 左侧菜单结束 -->
        <!-- 右侧主体开始 -->
        <div class="page-content">
            <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
                <ul class="layui-tab-title">
                    <li class="home">
                        <i class="layui-icon">&#xe68e;</i>我的桌面</li></ul>
                <div class="layui-unselect layui-form-select layui-form-selected" id="tab_right">
                    <dl>
                        <dd data-type="this">关闭当前</dd>
                        <dd data-type="other">关闭其它</dd>
                        <dd data-type="all">关闭全部</dd></dl>
                </div>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">
                        <iframe src='./welcome.html' frameborder="0" scrolling="yes" class="x-iframe"></iframe>
                    </div>
                </div>
                <div id="tab_show"></div>
            </div>
        </div>
        <div class="page-content-bg"></div>
        <style id="theme_style"></style>
        <!-- 右侧主体结束 -->
        <!-- 中部结束 -->
        <!-- <script>//百度统计可去掉
            var _hmt = _hmt || []; (function() {
                var hm = document.createElement("script");
                hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
            })();</script> -->
    </body>

</div>