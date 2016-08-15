<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta charset="UTF-8">
    <title>会员登录 - 想映电影院</title>
    <link rel="shortcut icon" href="<?php echo (PUBLIC_IMG_URL); ?>/logo.ico" />
    <link rel="stylesheet" href="<?php echo (CSS_URL); ?>/bootstrap.css">
    <link rel="stylesheet" href="<?php echo (CSS_URL); ?>/site.css">
</head>
<body>
<div class="col-md-8 col-lg-9">
    <img id="loginimg" class="img-responsive" src="<?php echo (IMG_URL); ?>/login.png" alt=""/>
</div>
<div class="col-md-4 col-lg-3">
    <a href="/cinema/Home/Home/index"><img id="loginlogo" src="<?php echo (IMG_URL); ?>/logo.png" alt=""></a>
    <p><h1 id="loginhead">登录</h1></p><br/>
    <div class="col-md-11">
        <form action="/cinema/Home/Manager/login" method="post" class="form-horizontal" onsubmit="return submitform()">
            <input type="text" class="form-control" name="u_phone" id="phone" placeholder="手机号" maxlength="11"><br/>
            <input type="password" class="form-control" name="u_pwd2" id="u_pwd2" placeholder="密码" maxlength="30" autocomplete="off"><br/>
            <input type="hidden" name="u_pwd" id="u_pwd">
            <div class="col-md-8">
                <input type="text" class="form-control" style="margin-left: -15px" name="verify" id="verify" placeholder="验证码" autocomplete="off" maxlength="4">
            </div>
            <div class="col-md-4">
                <img class="verifyimg" src="/cinema/Home/Manager/verifyImg" alt=""
                     onclick="this.src='/cinema/Home/Manager/verifyImg/' + Math.random()"/>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <br/><br/><button type="submit" class="btn btn-success btn-lg btn-group-justified">登 录</button>
                </div>
            </div>
        </form>
        <br/>
        <a class="btn-link" href="/cinema/Home/Manager/register">注册新账户</a>
        <a class="btn-link pull-right" href="/cinema/Home/Manager/forget">忘记密码</a>
    </div>
    <div class="row">
        <div id="loginfooter" class="col-md-12">
            <p>&copy; 2016 想映电影院-www.xyc.com</p>
            <p>All Rights Reserved</p>
        </div>
    </div>
</div>

<script src="<?php echo (JS_URL); ?>/jquery-1.12.4.min.js"></script>
<script src="<?php echo (JS_URL); ?>/bootstrap.min.js"></script>
<script src="<?php echo (JS_URL); ?>/jquery.md5.js"></script>
<script>
    function submitform(){
        if($('#phone').val()=='' || $('#u_pwd2').val()==''){
            alert('用户名或密码不能为空！');
            return false;
        }
        if($('#verify').val()==''){
            alert('验证码不能为空！');
            return false;
        }
        $("#u_pwd").val($.md5($('#u_pwd2').val()));
        $("#u_pwd2").attr('disabled','true');
        return true;
    }
</script>
</body>
</html>