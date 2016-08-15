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
    <link rel="stylesheet" type="text/css" href="<?php echo (ADMIN_CSS_URL); ?>/jquery.fancybox.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo (ADMIN_CSS_URL); ?>/chosen.css"/>

    <div style="background-color:#ffffff;padding-left: 30px;padding-right: 30px">
        <h3 class="page-title">

            剧照管理

        </h3>

        <ul class="breadcrumb">

            <li>

                <i class="icon-home"></i>

                <a href="/cinema/Admin/Admin/index" target="_top">主页</a>

                <i class="icon-angle-right"></i>

            </li>

            <li>

                <a href="/cinema/Admin/Movie/index">电影管理</a>

                <i class="icon-angle-right"></i>

            </li>

            <li>剧照管理</li>

        </ul>
        <!-- BEGIN EXAMPLE TABLE PORTLET-->

        <div class="row-fluid">

            <div class="span12">

                <!-- BEGIN GALLERY MANAGER PORTLET-->

                <div class="portlet box purple">

                    <div class="portlet-title">

                        <div class="caption"><i class="icon-reorder"></i>剧照管理</div>

                    </div>

                    <div class="portlet-body">

                        <!-- BEGIN GALLERY MANAGER PANEL-->

                        <div class="row-fluid">

                            <div class="span4">

                                <h3><?php echo ($movie); ?></h3>

                            </div>

                            <div class="span8">

                                <div class="pull-right">

                                    <form id="stageform" action="/cinema/Admin/Movie/stage/m_id/16" method="post" enctype="multipart/form-data">

                                    <div class="controls">

                                        <div class="fileupload fileupload-new" data-provides="fileupload">

                                            <span class="btn btn-file">

                                            <span class="fileupload-new"><i class="icon-plus"></i> 添加</span>

                                            <span class="fileupload-exists">修改</span>

                                            <input type="file" class="default" id="stageinput" name="stage" onchange="submitstage()" accept="image/jpeg,image/gif,image/png"/>

                                            </span>

                                            <span class="fileupload-preview"></span>

                                            <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none;"></a>

                                        </div>

                                    </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                        <!-- END GALLERY MANAGER PANEL-->

                        <hr class="clearfix" />

                        <!-- BEGIN GALLERY MANAGER LISTING-->

                        <?php $__FOR_START_22367__=0;$__FOR_END_22367__=$stagerows;for($k=$__FOR_START_22367__;$k < $__FOR_END_22367__;$k+=1){ ?><div class="row-fluid">

                                <?php $__FOR_START_21932__=4*$k;$__FOR_END_21932__=4*$k+4;for($n=$__FOR_START_21932__;$n < $__FOR_END_21932__;$n+=1){ if(!empty($stage[$n])): ?><div class="span3">

                                            <div class="item">

                                                <a class="fancybox-button" data-rel="fancybox-button" title="" href="<?php echo (UPLOAD_URL); ?>/<?php echo ($stage[$n]['s_url']); ?>">

                                                    <div class="zoom">

                                                        <img src="<?php echo (UPLOAD_URL); ?>/<?php echo ($stage[$n]['sm_url']); ?>" alt="Stage" />

                                                        <div class="zoom-icon"></div>

                                                    </div>

                                                </a>

                                                <div class="details">

                                                    <a href="/cinema/Admin/Movie/delstage/s_id/<?php echo ($stage[$n]['s_id']); ?>" onclick="return confirm('确定要删除吗？');" class="icon"><i class="icon-remove"></i></a>

                                                </div>

                                            </div>

                                        </div><?php endif; } ?>

                            </div><?php } ?>

                        <!-- END GALLERY MANAGER LISTING-->

                    </div>

                </div>

                <!-- END GALLERY MANAGER PORTLET-->

            </div>

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

    <script src="<?php echo (ADMIN_JS_URL); ?>/jquery.fancybox.pack.js"></script>

    <script src="<?php echo (ADMIN_JS_URL); ?>/chosen.jquery.min.js"></script>

    <script src="<?php echo (ADMIN_JS_URL); ?>/gallery.js"></script>

    <!-- END PAGE LEVEL SCRIPTS -->

    <script>

        jQuery(document).ready(function() {

            FormComponents.init();

            Gallery.init();

        });

    </script>




<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>