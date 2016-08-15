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

            修改电影

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

            <li>修改电影</li>

        </ul>
        <!-- BEGIN EXAMPLE TABLE PORTLET-->

        <div class="portlet box blue">

            <div class="portlet-title">

                <div class="caption"><i class="icon-reorder"></i>修改</div>

            </div>

            <div class="portlet-body form">

                <!-- BEGIN FORM-->

                <form id="movieupdateform" action="/cinema/Admin/Movie/update/m_id/16" method="post" enctype="multipart/form-data" class="form-horizontal" onsubmit="return checkUpload()">

                    <input type="hidden" name="m_id" value="<?php echo ($movie["m_id"]); ?>">
                    <input type="hidden" name="m_level" value="<?php echo ($movie["m_level"]); ?>">
                    <input type="hidden" name="m_subtime" value="<?php echo ($movie["m_subtime"]); ?>">
                    <input type="hidden" name="m_delflag" value="<?php echo ($movie["m_delflag"]); ?>">

                    <div class="control-group">

                        <label class="control-label">电影名*</label>

                        <div class="controls">

                            <input type="text" class="m-wrap" name="m_name" value="<?php echo ($movie["m_name"]); ?>" maxlength="60"/>

                            <?php if(!empty($error["m_name"])): ?><span class="help-inline"><?php echo ($error["m_name"]); ?></span><?php endif; ?>

                        </div>

                    </div>

                    <div class="control-group">

                        <label class="control-label">导演*</label>

                        <div class="controls">

                            <input type="text" class="m-wrap" name="m_director" value="<?php echo ($movie["m_director"]); ?>" maxlength="40"/>

                            <?php if(!empty($error["m_director"])): ?><span class="help-inline"><?php echo ($error["m_director"]); ?></span><?php endif; ?>

                        </div>

                    </div>

                    <div class="control-group">

                        <label class="control-label">主演*</label>

                        <div class="controls">

                            <input type="text" class="m-wrap" name="m_star" value="<?php echo ($movie["m_star"]); ?>" maxlength="100"/>

                            <?php if(!empty($error["m_star"])): ?><span class="help-inline"><?php echo ($error["m_star"]); ?></span><?php endif; ?>

                        </div>

                    </div>

                    <div class="control-group">

                        <label class="control-label">类型*</label>

                        <div class="controls">

                            <input type="hidden" id="typeselect" class="select2" style="width: 220px" value="<?php echo ($movie["m_type"]); ?>" name="m_type">

                            <?php if(!empty($error["m_type"])): ?><span class="help-inline"><?php echo ($error["m_type"]); ?></span><?php endif; ?>

                        </div>

                    </div>

                    <div class="control-group">

                        <label class="control-label">国家/地区*</label>

                        <div class="controls">

                            <select class="m-wrap" data-placeholder="Choose a Category" tabindex="1" name="m_country">

                                <?php if($movie["m_country"] == '大陆'): ?><option value="大陆" selected>大陆</option>
                                    <?php else: ?>
                                    <option value="大陆">大陆</option><?php endif; ?>

                                <?php if($movie["m_country"] == '香港'): ?><option value="香港" selected>香港</option>
                                    <?php else: ?>
                                    <option value="香港">香港</option><?php endif; ?>

                                <?php if($movie["m_country"] == '美国'): ?><option value="美国" selected>美国</option>
                                    <?php else: ?>
                                    <option value="美国">美国</option><?php endif; ?>

                                <?php if($movie["m_country"] == '韩国'): ?><option value="韩国" selected>韩国</option>
                                    <?php else: ?>
                                    <option value="韩国">韩国</option><?php endif; ?>

                                <?php if($movie["m_country"] == '台湾'): ?><option value="台湾" selected>台湾</option>
                                    <?php else: ?>
                                    <option value="台湾">台湾</option><?php endif; ?>

                                <?php if($movie["m_country"] == '法国'): ?><option value="法国" selected>法国</option>
                                    <?php else: ?>
                                    <option value="法国">法国</option><?php endif; ?>

                                <?php if($movie["m_country"] == '英国'): ?><option value="英国" selected>英国</option>
                                    <?php else: ?>
                                    <option value="英国">英国</option><?php endif; ?>

                                <?php if($movie["m_country"] == '泰国'): ?><option value="泰国" selected>泰国</option>
                                    <?php else: ?>
                                    <option value="泰国">泰国</option><?php endif; ?>

                                <?php if($movie["m_country"] == '印度'): ?><option value="印度" selected>印度</option>
                                    <?php else: ?>
                                    <option value="印度">印度</option><?php endif; ?>

                                <?php if($movie["m_country"] == '其他'): ?><option value="其他" selected>其他</option>
                                    <?php else: ?>
                                    <option value="其他">其他</option><?php endif; ?>

                            </select>

                            <?php if(!empty($error["m_country"])): ?><span class="help-inline"><?php echo ($error["m_country"]); ?></span><?php endif; ?>

                        </div>

                    </div>

                    <div class="control-group">

                        <label class="control-label">语言*</label>

                        <div class="controls">

                            <input type="text" class="m-wrap" name="m_language" value="<?php echo ($movie["m_language"]); ?>" maxlength="25"/>

                            <?php if(!empty($error["m_language"])): ?><span class="help-inline"><?php echo ($error["m_language"]); ?></span><?php endif; ?>

                        </div>

                    </div>

                    <div class="control-group">

                        <label class="control-label">版本*</label>

                        <div class="controls">

                            <input type="text" class="m-wrap" name="m_version" maxlength="10" value="<?php echo ($movie["m_version"]); ?>"/>

                            <?php if(!empty($error["m_version"])): ?><span class="help-inline"><?php echo ($error["m_version"]); ?></span><?php endif; ?>

                        </div>

                    </div>

                    <div class="control-group">

                        <label class="control-label">上映日期*</label>

                        <div class="controls">

                            <div class="input-append date date-picker"  data-date="102/2012" data-date-format="mm/dd/yyyy" data-date-viewmode="years" data-date-minviewmode="months">

                                <input class="m-wrap m-ctrl-medium date-picker" readonly size="16" type="text" id="m_showdate" name="m_showdate"/><span class="add-on"><i class="icon-calendar"></i></span>

                            </div>

                            <input type="hidden" id="h_showdate" value="<?php echo ($movie["m_showdate"]); ?>">

                            <?php if(!empty($error["m_showdate"])): ?><span class="help-inline"><?php echo ($error["m_showdate"]); ?></span><?php endif; ?>

                        </div>

                    </div>

                    <div class="control-group">

                        <label class="control-label">片长*</label>

                        <div class="controls">

                            <div class="input-append bootstrap-timepicker-component">

                                <input class="m-wrap m-ctrl-small timepicker-24" readonly type="text" id="m_length" name="m_length"/>

                                <span class="add-on"><i class="icon-time"></i></span>

                            </div>

                            <input type="hidden" id="h_length" value="<?php echo ($movie["m_length"]); ?>">

                            <?php if(!empty($error["m_length"])): ?><span class="help-inline"><?php echo ($error["m_length"]); ?></span><?php endif; ?>

                        </div>

                    </div>



                    <div class="control-group">

                        <label class="control-label">描述*</label>

                        <div class="controls">

                            <textarea class="m-wrap" rows="3" name="m_descride"><?php echo ($movie["m_descride"]); ?></textarea>

                            <?php if(!empty($error["m_descride"])): ?><span class="help-inline"><?php echo ($error["m_descride"]); ?></span><?php endif; ?>

                        </div>

                    </div>

                    <div class="control-group">

                        <label class="control-label">封面*</label>

                        <div class="controls">

                            <div class="fileupload fileupload-new" data-provides="fileupload">

                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">

                                    <img src="<?php echo (UPLOAD_URL); ?>/<?php echo ($movie["m_frontcover"]); ?>" alt="" />

                                </div>

                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>

                                <div>

                                    <span class="btn btn-file"><span class="fileupload-new">选择封面</span>

                                    <span class="fileupload-exists">修改</span>

                                    <input type="hidden" name="m_frontcover" value="<?php echo ($movie["m_frontcover"]); ?>">

                                    <input type="file" id="frontcover" class="default" name="frontcover" accept="image/jpeg,image/gif,image/png"/></span>

                                    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">移除</a>

                                </div>

                            </div>

                            <span class="label label-important">注意!</span>

											<span>

											图片格式须为"JPG/PNG/GIF"，且大小小于5MB

											</span>

                            <?php if(!empty($error["m_frontcover"])): ?><br/><span class="help-inline"><?php echo ($error["m_frontcover"]); ?></span><?php endif; ?>

                        </div>

                    </div>

                    <div class="control-group">

                        <label class="control-label">横幅海报*</label>

                        <div class="controls">

                            <div class="fileupload fileupload-new" data-provides="fileupload">

                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">

                                    <img src="<?php echo (UPLOAD_URL); ?>/<?php echo ($movie["sm_poster"]); ?>" alt="" />

                                </div>

                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>

                                <div>

													<span class="btn btn-file"><span class="fileupload-new">选择海报</span>

													<span class="fileupload-exists">修改</span>

                                                    <input type="hidden" name="m_poster" value="<?php echo ($movie["m_poster"]); ?>">

													<input type="file" id="poster" class="default" name="poster" accept="image/jpeg,image/gif,image/png"/></span>

                                    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">移除</a>

                                </div>

                            </div>

                            <span class="label label-important">注意!</span>

											<span>

											图片格式须为"JPG/PNG/GIF"，且大小小于5MB，推荐尺寸1664*542

											</span>

                            <?php if(!empty($error["m_poster"])): ?><br/><span class="help-inline"><?php echo ($error["m_poster"]); ?></span><?php endif; ?>

                        </div>

                    </div>

                    <div class="control-group">

                        <label class="control-label">预告片URL</label>

                        <div class="controls">

                            <input type="text" class="m-wrap" name="m_advance" value="<?php echo ($movie["m_advance"]); ?>"/>

                        </div>

                    </div>

                    <div class="control-group">

                        <label class="control-label">是否热映</label>

                        <div class="controls">

                            <label class="radio">

                                <?php if($movie["m_ishot"] == '1'): ?><input type="radio" name="m_ishot" value="1" checked/>
                                    <?php else: ?>
                                    <input type="radio" name="m_ishot" value="1"/><?php endif; ?>

                                是

                            </label>

                            <label class="radio">

                                <?php if($movie["m_ishot"] == '0'): ?><input type="radio" name="m_ishot" value="0" checked/>
                                    <?php else: ?>
                                    <input type="radio" name="m_ishot" value="0"/><?php endif; ?>

                                否

                            </label>

                        </div>

                    </div>

                    <div class="control-group">

                        <label class="control-label">备注</label>

                        <div class="controls">

                            <textarea class="m-wrap" rows="3" name="m_remark"><?php echo ($movie["m_remark"]); ?></textarea>

                        </div>

                    </div>

                    <div class="form-actions">

                        <button type="submit" class="btn blue">提交</button>

                        <a href="/cinema/Admin/Movie/index" type="button" class="btn">取消</a>

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

    <!-- END PAGE LEVEL SCRIPTS -->

    <script>

        jQuery(document).ready(function() {

            FormComponents.init();

            $("#typeselect").select2({
                tags: ["喜剧","恐怖","爱情","动作","科幻","武侠","战争","犯罪","惊悚","剧情"]
            });

            $("#m_showdate").val($("#h_showdate").val());
            $("#m_length").val($("#h_length").val());
        });

    </script>




<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>