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

            修改影票

        </h3>

        <ul class="breadcrumb">

            <li>

                <i class="icon-home"></i>

                <a href="/cinema/Admin/Admin/index" target="_top">主页</a>

                <i class="icon-angle-right"></i>

            </li>

            <li>

                <a href="/cinema/Admin/Ticket/index">影票管理</a>

                <i class="icon-angle-right"></i>

            </li>

            <li>修改影票</li>

        </ul>
        <!-- BEGIN EXAMPLE TABLE PORTLET-->

        <div class="portlet box blue">

            <div class="portlet-title">

                <div class="caption"><i class="icon-reorder"></i>修改</div>

            </div>

            <div class="portlet-body form">

                <!-- BEGIN FORM-->

                <form id="ticketform" action="/cinema/Admin/Ticket/update" method="post" class="form-horizontal">

                    <input type="hidden" name="t_id" value="<?php echo ($ticket["t_id"]); ?>">
                    <input type="hidden" name="t_delflag" value="<?php echo ($ticket["t_delflag"]); ?>">
                    <input type="hidden" name="t_subtime" value="<?php echo ($ticket["t_subtime"]); ?>">

                    <div class="control-group">

                        <label class="control-label">电影*</label>

                        <div class="controls">

                            <select class="m-wrap" data-placeholder="Choose a Category" tabindex="1" name="t_movieid">

                                <?php if(is_array($movies)): foreach($movies as $key=>$movie): if(($movie["m_id"]) == $ticket["t_movieid"]): ?><option value="<?php echo ($movie["m_id"]); ?>" selected><?php echo ($movie["m_name"]); ?></option>
                                        <?php else: ?>
                                        <option value="<?php echo ($movie["m_id"]); ?>"><?php echo ($movie["m_name"]); ?></option><?php endif; endforeach; endif; ?>

                            </select>

                            <?php if(!empty($error["t_movieid"])): ?><span class="help-inline"><?php echo ($error["t_movieid"]); ?></span><?php endif; ?>

                        </div>

                    </div>

                    <div class="control-group">

                        <label class="control-label">影院*</label>

                        <div class="controls">

                            <select id="cinemaselect" class="m-wrap" data-placeholder="Choose a Category" tabindex="1" name="t_cinemaid">

                                <?php if(is_array($cinemas)): foreach($cinemas as $key=>$cinema): if(($cinema["c_id"]) == $ticket["t_cinemaid"]): ?><option value="<?php echo ($cinema["c_id"]); ?>" selected><?php echo ($cinema["c_name"]); ?></option>
                                        <?php else: ?>
                                        <option value="<?php echo ($cinema["c_id"]); ?>"><?php echo ($cinema["c_name"]); ?></option><?php endif; endforeach; endif; ?>

                            </select>

                            <?php if(!empty($error["t_cinemaid"])): ?><span class="help-inline"><?php echo ($error["t_cinemaid"]); ?></span><?php endif; ?>

                        </div>

                    </div>

                    <div class="control-group">

                        <label class="control-label">影厅*</label>

                        <div class="controls">

                            <select id="roomselect" class="m-wrap" data-placeholder="Choose a Category" tabindex="1" name="t_roomid">

                                <?php if(is_array($rooms)): foreach($rooms as $key=>$room): if(($room["r_id"]) == $ticket["t_roomid"]): ?><option value="<?php echo ($room["r_id"]); ?>" selected><?php echo ($room["r_name"]); ?></option>
                                        <?php else: ?>
                                        <option value="<?php echo ($room["r_id"]); ?>"><?php echo ($room["r_name"]); ?></option><?php endif; endforeach; endif; ?>

                            </select>

                            <?php if(!empty($error["t_roomid"])): ?><span class="help-inline"><?php echo ($error["t_roomid"]); ?></span><?php endif; ?>

                        </div>

                    </div>

                    <div class="control-group">

                        <label class="control-label">制式*</label>

                        <div class="controls">

                            <select class="m-wrap" data-placeholder="Choose a Category" tabindex="1" name="t_standard">

                                <?php if($ticket["t_standard"] == '2D'): ?><option value="2D" selected>2D</option>
                                    <?php else: ?>
                                    <option value="2D">2D</option><?php endif; ?>

                                <?php if($ticket["t_standard"] == '3D'): ?><option value="3D" selected>3D</option>
                                    <?php else: ?>
                                    <option value="3D">3D</option><?php endif; ?>

                            </select>

                            <?php if(!empty($error["t_standard"])): ?><span class="help-inline"><?php echo ($error["t_standard"]); ?></span><?php endif; ?>

                        </div>

                    </div>

                    <div class="control-group">

                        <label class="control-label">语言*</label>

                        <div class="controls">

                            <input type="text" class="m-wrap" name="t_language" maxlength="25" value="<?php echo ($ticket["t_language"]); ?>"/>

                            <?php if(!empty($error["t_language"])): ?><span class="help-inline"><?php echo ($error["t_language"]); ?></span><?php endif; ?>

                        </div>

                    </div>

                    <div class="control-group">

                        <label class="control-label">单价*</label>

                        <div class="controls">

                            <input class="m-wrap mask_number" type="text" name="t_price" value="<?php echo ($ticket["t_price"]); ?>"/>

                            <?php if(!empty($error["t_price"])): ?><span class="help-inline"><?php echo ($error["t_price"]); ?></span><?php endif; ?>

                        </div>

                    </div>

                    <div class="control-group">

                        <label class="control-label">票数*</label>

                        <div class="controls">

                            <input class="m-wrap mask_number" type="text" name="t_ticketnum" value="<?php echo ($ticket["t_ticketnum"]); ?>"/>

                            <?php if(!empty($error["t_ticketnum"])): ?><span class="help-inline"><?php echo ($error["t_ticketnum"]); ?></span><?php endif; ?>

                        </div>

                    </div>

                    <div class="control-group">

                        <label class="control-label">积分*</label>

                        <div class="controls">

                            <input class="m-wrap mask_number" type="text" name="t_points" value="<?php echo ($ticket["t_points"]); ?>"/>

                            <?php if(!empty($error["t_points"])): ?><span class="help-inline"><?php echo ($error["t_points"]); ?></span><?php endif; ?>

                        </div>

                    </div>

                    <div class="control-group">

                        <label class="control-label">开场日期*</label>

                        <div class="controls">

                            <div class="input-append date date-picker"  data-date="102/2012" data-date-format="mm/dd/yyyy" data-date-viewmode="years" data-date-minviewmode="months">

                                <input class="m-wrap m-ctrl-medium date-picker" readonly size="16" type="text" id="t_date" name="t_date"/><span class="add-on"><i class="icon-calendar"></i></span>

                            </div>

                            <input type="hidden" id="h_date" value="<?php echo ($ticket["t_date"]); ?>">

                            <?php if(!empty($error["t_date"])): ?><span class="help-inline"><?php echo ($error["t_date"]); ?></span><?php endif; ?>

                        </div>

                    </div>

                    <div class="control-group">

                        <label class="control-label">开场时间*</label>

                        <div class="controls">

                            <div class="input-append bootstrap-timepicker-component">

                                <input class="m-wrap m-ctrl-small timepicker-default" readonly type="text" id="t_time" name="t_time"/>

                                <span class="add-on"><i class="icon-time"></i></span>

                            </div>

                            <input type="hidden" id="h_time" value="<?php echo ($ticket["t_time"]); ?>">

                            <?php if(!empty($error["t_time"])): ?><span class="help-inline"><?php echo ($error["t_time"]); ?></span><?php endif; ?>

                        </div>

                    </div>

                    <div class="control-group">

                        <label class="control-label">是否在售*</label>

                        <div class="controls">

                            <label class="radio">

                                <?php if($ticket["t_issale"] == '1'): ?><input type="radio" name="t_issale" value="1" checked/>
                                    <?php else: ?>
                                    <input type="radio" name="t_issale" value="1"/><?php endif; ?>

                                是

                            </label>

                            <label class="radio">

                                <?php if($ticket["t_issale"] == '0'): ?><input type="radio" name="t_issale" value="0" checked/>
                                    <?php else: ?>
                                    <input type="radio" name="t_issale" value="0"/><?php endif; ?>

                                否

                            </label>

                        </div>

                    </div>

                    <div class="control-group">

                        <label class="control-label">备注</label>

                        <div class="controls">

                            <input type="text" class="m-wrap" name="t_remark" value="<?php echo ($ticket["t_remark"]); ?>"/>

                        </div>

                    </div>

                    <div class="form-actions">

                        <button type="submit" class="btn blue">提交</button>

                        <a href="/cinema/Admin/Ticket/index" type="button" class="btn">取消</a>

                    </div>

                </form>

                <!-- END FORM-->

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

    <script src="<?php echo (ADMIN_JS_URL); ?>/ticket.js"></script>

    <!-- END PAGE LEVEL SCRIPTS -->

    <script>

        jQuery(document).ready(function() {

            FormComponents.init();

            $("#t_time").val($("#h_time").val());
            $("#t_date").val($("#h_date").val());
        });

    </script>




<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>