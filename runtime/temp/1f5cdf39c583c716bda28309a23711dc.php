<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"/www/wwwroot/maig/public/../application/index/view/index/login.html";i:1562327612;}*/ ?>
<!--<div><img src="<?php echo captcha_src(); ?>" alt="captcha" onclick="this.src='<?php echo captcha_src(); ?>'" /></div>-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>库存管理系统</title>
    <meta name="viewport" content="width=device-width">
    <link href="/static/css/login.css" rel="stylesheet" type="text/css">
</head>
<body>

<div class="login">
    <form action="" method="post" id="form">
        <div class="logo"><h1>库存管理系统</h1></div>
        <div class="login_form">
            <div class="user">
                <input class="text_value" value="" name="account" type="text" id="account" placeholder="账号">
                <input class="text_value" value="" name="pwd" type="password" id="pwd" placeholder="密码">
            </div>
            <button class="button" id="submit" type="submit">登录</button>
        </div>

        <div id="tip"></div>
        <div class="foot">
        </div>
    </form>
</div>
</body>
</html>
