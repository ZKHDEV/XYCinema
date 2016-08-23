<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="<?php echo (PUBLIC_IMG_URL); ?>/logo.ico" />
    <link rel="stylesheet" href="<?php echo (CSS_URL); ?>/bootstrap.css">
    <link rel="stylesheet" href="<?php echo (CSS_URL); ?>/site.css">
    <link rel="stylesheet" href="<?php echo (CSS_URL); ?>/bootstrap-datetimepicker.css">
</head>
<body>
<div class="navbar navbar-default navbar-static-top" role="navigation" id="topnav">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="/cinema/Home/Home/index"><img id="logo" src="<?php echo (IMG_URL); ?>/logo.png" alt=""/></a>
        </div>
        <div>
            <div class="navbar-form navbar-left" id="placeform">
                <div class="input-group">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-default btn-danger dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-map-marker"></span>&nbsp;<span class="location"></span></button>
                        <ul class="dropdown-menu citylist"></ul>
                    </div>
                    <div class="input-group-btn">
                        <button type="button" style="width: 200px;text-align: left" class="btn btn-default btn-danger dropdown-toggle" data-toggle="dropdown"><span id="cinema"></span></button>
                        <ul class="dropdown-menu" id="cinemalist2" style="width: 200px"></ul>
                    </div>
                </div>
                <button type="button" class="btn btn-default btn-danger" data-toggle="modal" data-target="#buymodal">
                    <span class="glyphicon glyphicon-flash"></span>闪电购票
                </button>
            </div>
            <?php if(empty($_SESSION['u_id'])): ?><p class="navbar-text navbar-right"><a class="navbarlink" href="/cinema/Home/Manager/login"><span class="glyphicon glyphicon-user"></span>&nbsp;登录&nbsp;</a>&nbsp;| &nbsp;<a class="navbarlink" href="/cinema/Home/Manager/register">注册</a></p>
                <?php else: ?>
                <p class="navbar-text navbar-right"><a class="navbarlink" href="/cinema/Home/User/index"><?php echo (session('u_name')); ?>，欢迎您！</a></p><?php endif; ?>

        </div>
    </div>
</div>
<div class="modal modal-lg fade" id="buymodal" tabindex="-1" role="dialog" aria-labelledby="buymodallabel" aria-hidden="true">
    <div class="modal-dialog" id="buymodaldialog">
        <div class="modal-content" id="buymodalcontent">
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="buymodallabel">闪电购票</h4>
            </div>
            <div class="modal-body">
                <div id="buycontent">
                    <div class="col-md-4">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="glyphicon glyphicon-map-marker"/>&nbsp;选择影院</h3>
                                <div class="pull-right selecthead">
                                    <div class="btn-ground">
                                        <button type="button" class="btn btn-default dropdown-toggle headbtn" data-toggle="dropdown"><span class="location"></span></button>
                                        <ul class="dropdown-menu citylist"></ul>
                                    </div>
                                </div>
                            </div>
                            <ul id="cinemalist" class="list-group"></ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="glyphicon glyphicon-film"/>&nbsp;选择影片</h3>
                            </div>
                            <ul id="movielist" class="list-group"></ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="glyphicon glyphicon-calendar"/>&nbsp;</h3>
                                <div class="pull-right selecthead">
                                    <input type="text" onchange="getticketbydate()" class="form-control form_datetime headbtn datepicker" readonly>
                                </div>
                            </div>
                            <ul id="ticketlist" class="list-group"></ul>
                        </div>
                    </div>
                    <div style="clear: both"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<title>想映电影院</title>

<div>
    <div class="row" id="advertising">
        <div class="col-md-12">
            <div id="carousel1" class="carousel slide">
                <div class="carousel-inner">
                    <?php $__FOR_START_27634__=0;$__FOR_END_27634__=5;for($key=$__FOR_START_27634__;$key < $__FOR_END_27634__;$key+=1){ if($key == 0): ?><div class="item active">
                            <?php else: ?>
                            <div class="item"><?php endif; ?>
                        <a href="/cinema/Home/Movie/detail/m_id/<?php echo ($movies[$key]['m_id']); ?>"><img class="posterimg" src="<?php echo (UPLOAD_URL); ?>/<?php echo ($movies[$key]['m_poster']); ?>" alt=""></a>
                        <div class="carousel-caption">
                            <h1><?php echo ($movies[$key]['m_name']); ?></h1>
                        </div>
                </div><?php } ?>

                </div>
                <a class="left carousel-control" href="#carousel1" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel1" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
                <ol class="carousel-indicators">
                    <li data-target="#carousel1" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel1" data-slide-to="1"></li>
                    <li data-target="#carousel1" data-slide-to="2"></li>
                    <li data-target="#carousel1" data-slide-to="3"></li>
                    <li data-target="#carousel1" data-slide-to="4"></li>
                </ol>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <ul id="menulist" class="nav nav-pills nav-justified">
                    <li class="active"><a href="#hot" data-toggle="tab">正在热映</a></li>
                    <li><a href="#coming" data-toggle="tab">即将上映</a></li>
                </ul>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="hot">
                <br><h3 class="text-danger">正在热映：</h3><br>
                <?php $__FOR_START_25155__=0;$__FOR_END_25155__=$movierows;for($k=$__FOR_START_25155__;$k < $__FOR_END_25155__;$k+=1){ ?><div class="row">
                    <?php $__FOR_START_12793__=4*$k;$__FOR_END_12793__=4*$k+4;for($n=$__FOR_START_12793__;$n < $__FOR_END_12793__;$n+=1){ if(!empty($movies[$n])): ?><div class="col-md-3 col-sm-3 col-xs-3">
                                <div class="thumbnail text-center">
                                    <a href="/cinema/Home/Movie/detail/m_id/<?php echo ($movies[$n]['m_id']); ?>"><img class="movieimg" src="<?php echo (UPLOAD_URL); ?>/<?php echo ($movies[$n]['m_frontcover']); ?>" alt=""></a>
                                    <div class="caption">
                                        <a class="btn btn-default btn-danger seatbtn" href="/cinema/Home/Order/ticket/m_id/<?php echo ($movies[$n]['m_id']); ?>">选座购票</a>
                                    </div>
                                </div>
                            </div><?php endif; } ?>
                    </div><?php } ?>
            </div>
            <div class="tab-pane fade" id="coming">
                <br><h3 class="text-danger">即将上映：</h3><br>
                <?php $__FOR_START_28864__=0;$__FOR_END_28864__=$wmovierows;for($k=$__FOR_START_28864__;$k < $__FOR_END_28864__;$k+=1){ ?><div class="row">
                        <?php $__FOR_START_21822__=4*$k;$__FOR_END_21822__=4*$k+4;for($n=$__FOR_START_21822__;$n < $__FOR_END_21822__;$n+=1){ if(!empty($willmovies[$n])): ?><div class="col-md-3 col-sm-3 col-xs-3">
                                    <div class="thumbnail text-center">
                                        <a href="/cinema/Home/Movie/detail/m_id/<?php echo ($willmovies[$n]['m_id']); ?>"><img class="movieimg" src="<?php echo (UPLOAD_URL); ?>/<?php echo ($willmovies[$n]['m_frontcover']); ?>" alt=""></a>
                                        <div class="caption">
                                            <a class="btn btn-default btn-danger seatbtn" href="/cinema/Home/Order/ticket/m_id/<?php echo ($willmovies[$n]['m_id']); ?>">选座购票</a>
                                        </div>
                                    </div>
                                </div><?php endif; } ?>
                    </div><?php } ?>
            </div>
        </div>
    </div>
</div>


<footer>
    Copyright &copy; 2016 想映电影院-www.xyc.com. All Rights Reserved
    <ul class="list-inline">
        <li><a href="/cinema/Home/Home/about">关于我们</a></li>
        <li><a href="/cinema/Home/Home/join/area/1">加入我们</a></li>
        <li><a href="/cinema/Home/Home/connect">联系我们</a></li>
        <li><a href="/cinema/Home/Home/notice">影院公告</a></li>
    </ul>
</footer>
<script src="<?php echo (JS_URL); ?>/jquery-1.12.4.min.js"></script>
<script src="<?php echo (JS_URL); ?>/app.js"></script>
<script src="<?php echo (JS_URL); ?>/bootstrap.min.js"></script>
<script src="<?php echo (JS_URL); ?>/bootstrap-datetimepicker.js"></script>
<script src="<?php echo (JS_URL); ?>/initdatepicker.js"></script>
<script src="<?php echo (JS_URL); ?>/selectorder.js"></script>

    <script>
        $('#carousel1').carousel({
            interval: 5000
        });
    </script>

</body>
</html>