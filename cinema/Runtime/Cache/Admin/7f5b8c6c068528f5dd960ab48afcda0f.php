<?php if (!defined('THINK_PATH')) exit();?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8" />

    <title>登录</title>

    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <meta content="" name="description" />

    <meta content="" name="author" />

    <!-- BEGIN GLOBAL MANDATORY STYLES -->

    <link href="<?php echo (ADMIN_CSS_URL); ?>/bootstrap.min.css" rel="stylesheet" type="text/css"/>

    <link href="<?php echo (ADMIN_CSS_URL); ?>/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>

    <link href="<?php echo (ADMIN_CSS_URL); ?>/font-awesome.min.css" rel="stylesheet" type="text/css"/>

    <link href="<?php echo (ADMIN_CSS_URL); ?>/style-metro.css" rel="stylesheet" type="text/css"/>

    <link href="<?php echo (ADMIN_CSS_URL); ?>/style.css" rel="stylesheet" type="text/css"/>

    <link href="<?php echo (ADMIN_CSS_URL); ?>/style-responsive.css" rel="stylesheet" type="text/css"/>

    <link href="<?php echo (ADMIN_CSS_URL); ?>/default.css" rel="stylesheet" type="text/css" id="style_color"/>

    <link href="<?php echo (ADMIN_CSS_URL); ?>/uniform.default.css" rel="stylesheet" type="text/css"/>

    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL STYLES -->

    <link href="<?php echo (ADMIN_CSS_URL); ?>/login.css" rel="stylesheet" type="text/css"/>

    <!-- END PAGE LEVEL STYLES -->

    <link rel="shortcut icon" href="<?php echo (PUBLIC_IMG_URL); ?>/logo.ico" />

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->

<body class="login">

<!-- BEGIN LOGO -->

<div class="logo">

    <!--<img src="<?php echo (ADMIN_IMG_URL); ?>/logo-big.png" alt="" />-->

</div>

<!-- END LOGO -->

<!-- BEGIN LOGIN -->

<div class="content">

    <!-- BEGIN LOGIN FORM -->

    <form class="login-form" role="form" action="login" method="post" autocomplete="off">

        <input type="hidden" id="admin_pwd" name="a_pwd"/>

        <h3 class="form-title">登 录</h3>

        <div class="alert alert-error hide">

            <button class="close" data-dismiss="alert"></button>

            <span>Enter any username and password.</span>

        </div>

        <div class="control-group">

            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->

            <label class="control-label visible-ie8 visible-ie9">Username</label>

            <div class="controls">

                <div class="input-icon left">

                    <i class="icon-user"></i>

                    <input class="m-wrap placeholder-no-fix" type="text" placeholder="用户名" name="a_name" autofocus/>

                </div>

            </div>

        </div>

        <div class="control-group">

            <label class="control-label visible-ie8 visible-ie9">Password</label>

            <div class="controls">

                <div class="input-icon left">

                    <i class="icon-lock"></i>

                    <input class="m-wrap placeholder-no-fix" type="password" placeholder="密码" id="admin_pwd2"/>

                </div>

            </div>

        </div>

        <div class="control-group">

            <label class="control-label visible-ie8 visible-ie9">Password</label>

            <div class="controls">

                <div class="input-icon left">

                    <i class="icon-check"></i>

                    <input class="m-wrap placeholder-no-fix" type="text" placeholder="验证码" name="verify" />

                </div>

                <br><img src="/cinema/Admin/Manager/verifyImg" onclick="this.src='/cinema/Admin/Manager/verifyImg/'+Math.random()" />
            </div>

        </div>

        <div class="form-actions">

            <button type="submit" class="btn green pull-right" onclick="submitform()">

            登录

            </button>

        </div>

    </form>

    <!-- END LOGIN FORM -->

</div>

<!-- END LOGIN -->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

<!-- BEGIN CORE PLUGINS -->

<script src="<?php echo (ADMIN_JS_URL); ?>/jquery-1.10.1.min.js" type="text/javascript"></script>

<script src="<?php echo (ADMIN_JS_URL); ?>/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>

<script src="<?php echo (ADMIN_JS_URL); ?>/jquery.md5.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->

<script src="<?php echo (ADMIN_JS_URL); ?>/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>

<script src="<?php echo (ADMIN_JS_URL); ?>/bootstrap.min.js" type="text/javascript"></script>

<!--[if lt IE 9]>

<script src="<?php echo (ADMIN_JS_URL); ?>/excanvas.min.js"></script>

<script src="<?php echo (ADMIN_JS_URL); ?>/respond.min.js"></script>

<![endif]-->

<script src="<?php echo (ADMIN_JS_URL); ?>/jquery.slimscroll.min.js" type="text/javascript"></script>

<script src="<?php echo (ADMIN_JS_URL); ?>/jquery.blockui.min.js" type="text/javascript"></script>

<script src="<?php echo (ADMIN_JS_URL); ?>/jquery.cookie.min.js" type="text/javascript"></script>

<script src="<?php echo (ADMIN_JS_URL); ?>/jquery.uniform.min.js" type="text/javascript" ></script>

<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->

<script src="<?php echo (ADMIN_JS_URL); ?>/jquery.validate.min.js" type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="<?php echo (ADMIN_JS_URL); ?>/app.js" type="text/javascript"></script>

<script src="<?php echo (ADMIN_JS_URL); ?>/login.js" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->

<script>

    jQuery(document).ready(function() {

        App.init();

        //Login.init();

    });

    function submitform(){
        $("#admin_pwd").val($.md5($('#admin_pwd2').val()));
        $("#admin_pwd2").attr('disabled','true');
    }

</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>