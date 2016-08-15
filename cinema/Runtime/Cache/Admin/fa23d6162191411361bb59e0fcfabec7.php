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


    <link rel="stylesheet" type="text/css" href="<?php echo (ADMIN_CSS_URL); ?>/select2_metro.css" />

    <link rel="stylesheet" href="<?php echo (ADMIN_CSS_URL); ?>/DT_bootstrap.css" />

    <div style="background-color:#ffffff;padding-left: 30px;padding-right: 30px">
        <h3 class="page-title">

            用户管理

        </h3>

        <ul class="breadcrumb">

            <li>

                <i class="icon-home"></i>

                <a href="/cinema/Admin/Admin/index" target="_top">主页</a>

                <i class="icon-angle-right"></i>

            </li>

            <li>用户管理</li>

        </ul>
        <!-- BEGIN EXAMPLE TABLE PORTLET-->



        <div>

            <table class="table table-striped table-hover table-bordered" id="sample_editable_1">

                <thead>

                <tr>

                    <th>用户名</th>

                    <th>手机号</th>

                    <th>邮箱</th>

                    <th>积分</th>

                    <th>会员级别</th>

                    <th>创建时间</th>

                    <th>修改时间</th>

                    <th>删除</th>

                </tr>

                </thead>

                <tbody>

                <?php if(is_array($info)): foreach($info as $key=>$user): ?><tr>

                    <td><?php echo ($user["u_name"]); ?></td>

                    <td><?php echo ($user["u_phone"]); ?></td>

                    <td><?php echo ($user["u_email"]); ?></td>

                    <td><?php echo ($user["u_points"]); ?></td>

                    <?php if($user["u_points"] < 100): ?><td>铜牌会员</td>
                        <?php elseif($user["u_points"] < 200): ?><td>银牌会员</td>
                        <?php else: ?><td>金级会员</td><?php endif; ?>

                    <td><?php echo ($user["u_subtime"]); ?></td>

                    <td><?php echo ($user["u_modifiedon"]); ?></td>

                    <td><a href="/cinema/Admin/User/delete/u_id/<?php echo ($user["u_id"]); ?>" onclick="return confirm('确定要删除吗？');">删除</a></td>

                </tr><?php endforeach; endif; ?>

                </tbody>

            </table>

        </div>


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



<!-- BEGIN PAGE LEVEL PLUGINS -->

<script type="text/javascript" src="<?php echo (ADMIN_JS_URL); ?>/select2.min.js"></script>

<script type="text/javascript" src="<?php echo (ADMIN_JS_URL); ?>/jquery.dataTables.js"></script>

<script type="text/javascript" src="<?php echo (ADMIN_JS_URL); ?>/DT_bootstrap.js"></script>

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="<?php echo (ADMIN_JS_URL); ?>/table-editable.js"></script>

<!-- END PAGE LEVEL SCRIPTS -->

<script>

    jQuery(document).ready(function() {

        TableEditable.init();

    });

</script>

<!-- END JAVASCRIPTS -->



<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>