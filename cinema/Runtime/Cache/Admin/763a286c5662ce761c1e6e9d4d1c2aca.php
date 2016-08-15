<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>

<html lang="en" class="no-js">

<!-- BEGIN HEAD -->

<head>

    <meta charset="utf-8" />

    <title>想映电影后台管理系统</title>

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

    <link href="<?php echo (ADMIN_CSS_URL); ?>/site.css" rel="stylesheet" type="text/css"/>

    <!-- END GLOBAL MANDATORY STYLES -->

    <link rel="shortcut icon" href="<?php echo (PUBLIC_IMG_URL); ?>/logo.ico" />

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->

<body>


<link rel="shortcut icon" href="<?php echo (PUBLIC_IMG_URL); ?>/logo.ico" />
<div class="page-header-fixed">

<!-- BEGIN HEADER -->

<div class="header navbar navbar-inverse navbar-fixed-top">

    <!-- BEGIN TOP NAVIGATION BAR -->

    <div class="navbar-inner">

        <div class="container-fluid">

            <!-- BEGIN LOGO -->

            <a class="brand" href="/cinema/Admin/Admin/index">

                <p>&nbsp;&nbsp;想映电影后台管理系统</p>
                <!--<img src="<?php echo (ADMIN_IMG_URL); ?>/logo.png" alt="logo"/>-->

            </a>

            <!-- END LOGO -->

            <!-- BEGIN RESPONSIVE MENU TOGGLER -->

            <a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">

                <img src="<?php echo (ADMIN_IMG_URL); ?>/menu-toggler.png" alt="" />

            </a>

            <!-- END RESPONSIVE MENU TOGGLER -->

            <!-- BEGIN TOP NAVIGATION MENU -->

            <ul class="nav pull-right">

                <!-- BEGIN USER LOGIN DROPDOWN -->

                <li class="dropdown user">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        <span class="username"><?php echo (session('a_name')); ?></span>

                        <i class="icon-angle-down"></i>

                    </a>

                    <ul class="dropdown-menu">

                        <li><a id="changelink" href="/cinema/Admin/Manager/changepwd/a_id/<?php echo (session('a_id')); ?>" target="subwindow"><i class="icon-user"></i> 修改密码</a></li>

                        <li class="divider"></li>

                        <li><a href="/cinema/Admin/Manager/logout"><i class="icon-key"></i> 退出</a></li>

                    </ul>

                </li>

                <!-- END USER LOGIN DROPDOWN -->

            </ul>

            <!-- END TOP NAVIGATION MENU -->

        </div>

    </div>

    <!-- END TOP NAVIGATION BAR -->

</div>

<!-- BEGIN CONTAINER -->

<div class="page-container" style="background-color: #3D3D3D">

    <!-- BEGIN SIDEBAR -->

    <div class="page-sidebar sidebarmenu">

        <!-- BEGIN SIDEBAR MENU -->

        <ul class="page-sidebar-menu mainmenu">

            <br><br>

            <li class="start active">

                <a href="/cinema/Admin/User/index" target="subwindow">

                    <i class="icon-user"></i>

                    <span class="title">用户管理</span>

                    <span class="selected"></span>

                </a>

            </li>

            <li class="">

                <a href="/cinema/Admin/Movie/index" target="subwindow">

                    <i class="icon-film"></i>

                    <span class="title">电影管理</span>

                </a>

            </li>

            <li class="">

                <a href="/cinema/Admin/Cinema/index" target="subwindow">

                    <i class="icon-building"></i>

                    <span class="title">影院管理</span>

                </a>

            </li>

            <li class="">

                <a href="/cinema/Admin/Ticket/index" target="subwindow">

                    <i class="icon-ticket"></i>

                    <span class="title">影票管理</span>

                </a>

            </li>

            <li class="">

                <a href="/cinema/Admin/Order/index" target="subwindow">

                    <i class="icon-shopping-cart"></i>

                    <span class="title">订单管理</span>

                </a>

            </li>

            <li class="">

                <a href="/cinema/Admin/Comment/index" target="subwindow">

                    <i class="icon-comments"></i>

                    <span class="title">评论管理</span>

                </a>

            </li>

            <li class="">

                <a href="/cinema/Admin/Employ/index" target="subwindow">

                    <i class="icon-briefcase"></i>

                    <span class="title">招聘管理</span>

                </a>

            </li>

            <li class="">

                <a href="/cinema/Admin/Notice/index" target="subwindow">

                    <i class="icon-bullhorn"></i>

                    <span class="title">公告管理</span>

                </a>

            </li>

        </ul>

        <!-- END SIDEBAR MENU -->

    </div>

    <!-- END SIDEBAR -->

    <!-- BEGIN PAGE -->

    <iframe id="subwindow" name="subwindow" src="/cinema/Admin/User/index" frameborder="0" style="border: none;margin-left: 225px"></iframe>

    <!-- END PAGE -->

</div>

<!-- END CONTAINER -->

<!-- BEGIN FOOTER -->


    <div class="footer" style="background-color: #3D3D3D">

        <div class="footer-inner">

            2016 &copy; XYCinema

        </div>

    </div>


<!-- END FOOTER -->

</div>


<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

<!-- BEGIN CORE PLUGINS -->

<script src="<?php echo (ADMIN_JS_URL); ?>/jquery-1.10.1.min.js" type="text/javascript"></script>

<script src="<?php echo (ADMIN_JS_URL); ?>/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>

<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->

<script src="<?php echo (ADMIN_JS_URL); ?>/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>

<script src="<?php echo (ADMIN_JS_URL); ?>/bootstrap.min.js" type="text/javascript"></script>

<script src="<?php echo (ADMIN_JS_URL); ?>/jquery.slimscroll.min.js" type="text/javascript"></script>

<script src="<?php echo (ADMIN_JS_URL); ?>/jquery.blockui.min.js" type="text/javascript"></script>

<script src="<?php echo (ADMIN_JS_URL); ?>/jquery.cookie.min.js" type="text/javascript"></script>

<script src="<?php echo (ADMIN_JS_URL); ?>/jquery.uniform.min.js" type="text/javascript" ></script>

<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="<?php echo (ADMIN_JS_URL); ?>/app.js" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->

<script>

    jQuery(document).ready(function() {

        App.init(); // initlayout and core plugins

    });

</script>


    <script>
        $(function(){
            resetPosition();
            $(window).resize(resetPosition);
            $('.mainmenu').on('click','li',function () {
                if(!$(this).hasClass('start active')){
                    $('.mainmenu li').removeClass('start active');
                    $('.mainmenu li span.selected').remove();
                    $(this).addClass('start active');
                    $('.mainmenu li > a').append('<span class="selected"></span>');
                }
            });
            $('#changelink').click(function () {
                $('.mainmenu li').removeClass('start active');
                $('.mainmenu li span.selected').remove();
            });
        });

        function resetPosition(){
            var contentHeight = window.innerHeight-81;
            var contentWidth = window.innerWidth-225;
            $("#subwindow").attr('height',contentHeight);
            $("#subwindow").attr('width',contentWidth);
        }


    </script>


<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>