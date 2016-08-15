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


    <link rel="stylesheet" type="text/css" href="<?php echo (ADMIN_CSS_URL); ?>/bootstrap-fileupload.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (ADMIN_CSS_URL); ?>/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (ADMIN_CSS_URL); ?>/chosen.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (ADMIN_CSS_URL); ?>/select2_metro.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (ADMIN_CSS_URL); ?>/jquery.tagsinput.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (ADMIN_CSS_URL); ?>/clockface.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (ADMIN_CSS_URL); ?>/bootstrap-wysihtml5.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (ADMIN_CSS_URL); ?>/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (ADMIN_CSS_URL); ?>/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (ADMIN_CSS_URL); ?>/colorpicker.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (ADMIN_CSS_URL); ?>/bootstrap-toggle-buttons.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (ADMIN_CSS_URL); ?>/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (ADMIN_CSS_URL); ?>/datetimepicker.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (ADMIN_CSS_URL); ?>/multi-select-metro.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (ADMIN_CSS_URL); ?>/bootstrap-modal.css"/>

    <div style="background-color:#ffffff;padding-left: 30px;padding-right: 30px">
        <h3 class="page-title">

            查看影厅

        </h3>

        <ul class="breadcrumb">

            <li>

                <i class="icon-home"></i>

                <a href="/cinema/Admin/Admin/index" target="_top">主页</a>

                <i class="icon-angle-right"></i>

            </li>

            <li>

                <a href="/cinema/Admin/Cinema/index">影院管理</a>

                <i class="icon-angle-right"></i>

            </li>

            <li>

                <a href="/cinema/Admin/Cinema/room/c_id/<?php echo ($c_id); ?>">影厅管理</a>

                <i class="icon-angle-right"></i>

            </li>

            <li>查看影厅</li>

        </ul>
        <!-- BEGIN EXAMPLE TABLE PORTLET-->

        <h3 style="margin-left: 150px">影厅名:&nbsp;<?php echo ($room["r_name"]); ?><br/>
            已选座位数:&nbsp;<?php echo ($room["r_count"]); ?>
        </h3>

        <div class="seatdiv">
            <?php $__FOR_START_3324__=1;$__FOR_END_3324__=12;for($row=$__FOR_START_3324__;$row < $__FOR_END_3324__;$row+=1){ ?><ul class="seatlist">
                    <?php $__FOR_START_32645__=1;$__FOR_END_32645__=15;for($col=$__FOR_START_32645__;$col < $__FOR_END_32645__;$col+=1){ $n = $row*14-14+$col; $url = ADMIN_IMG_URL; if(in_array($row*14-14+$col,$room['seats'])) echo "<li><img src='$url/sseat.png'/></li>"; else echo "<li><img src='$url/eseat.png'/></li>"; } ?>
                    <li><h2>&nbsp;<?php echo ($row); ?></h2></li>
                </ul>
                <div class="seatclear"></div><?php } ?>
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



    <script type="text/javascript" src="<?php echo (ADMIN_JS_URL); ?>/ckeditor.js"></script>

    <script type="text/javascript" src="<?php echo (ADMIN_JS_URL); ?>/bootstrap-fileupload.js"></script>

    <script type="text/javascript" src="<?php echo (ADMIN_JS_URL); ?>/chosen.jquery.min.js"></script>

    <script type="text/javascript" src="<?php echo (ADMIN_JS_URL); ?>/select2.min.js"></script>

    <script type="text/javascript" src="<?php echo (ADMIN_JS_URL); ?>/wysihtml5-0.3.0.js"></script>

    <script type="text/javascript" src="<?php echo (ADMIN_JS_URL); ?>/bootstrap-wysihtml5.js"></script>

    <script type="text/javascript" src="<?php echo (ADMIN_JS_URL); ?>/jquery.tagsinput.min.js"></script>

    <script type="text/javascript" src="<?php echo (ADMIN_JS_URL); ?>/jquery.toggle.buttons.js"></script>

    <script type="text/javascript" src="<?php echo (ADMIN_JS_URL); ?>/bootstrap-datepicker.js"></script>

    <script type="text/javascript" src="<?php echo (ADMIN_JS_URL); ?>/bootstrap-datetimepicker.js"></script>

    <script type="text/javascript" src="<?php echo (ADMIN_JS_URL); ?>/clockface.js"></script>

    <script type="text/javascript" src="<?php echo (ADMIN_JS_URL); ?>/date.js"></script>

    <script type="text/javascript" src="<?php echo (ADMIN_JS_URL); ?>/daterangepicker.js"></script>

    <script type="text/javascript" src="<?php echo (ADMIN_JS_URL); ?>/bootstrap-colorpicker.js"></script>

    <script type="text/javascript" src="<?php echo (ADMIN_JS_URL); ?>/bootstrap-timepicker.js"></script>

    <script type="text/javascript" src="<?php echo (ADMIN_JS_URL); ?>/jquery.inputmask.bundle.min.js"></script>

    <script type="text/javascript" src="<?php echo (ADMIN_JS_URL); ?>/jquery.input-ip-address-control-1.0.min.js"></script>

    <script type="text/javascript" src="<?php echo (ADMIN_JS_URL); ?>/jquery.multi-select.js"></script>

    <script src="<?php echo (ADMIN_JS_URL); ?>/bootstrap-modal.js" type="text/javascript" ></script>

    <script src="<?php echo (ADMIN_JS_URL); ?>/bootstrap-modalmanager.js" type="text/javascript" ></script>

    <!-- END PAGE LEVEL PLUGINS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->

    <script src="<?php echo (ADMIN_JS_URL); ?>/app.js"></script>

    <script src="<?php echo (ADMIN_JS_URL); ?>/form-components.js"></script>

    <script src="<?php echo (ADMIN_JS_URL); ?>/jquery.validate.min.js"></script>

    <script src="<?php echo (ADMIN_JS_URL); ?>/validate.js"></script>

    <script src="<?php echo (ADMIN_JS_URL); ?>/seats.js"></script>

    <!-- END PAGE LEVEL SCRIPTS -->



<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>