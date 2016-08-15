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

    <title>选择场次 - 想映电影院</title>

    <div>
        <div class="container">
            <img src="<?php echo (IMG_URL); ?>/nav1.png" class="img-responsive" alt="" id="ordernav"/>
            <br/>
            <div class="text-center" style="width: 100%"><h1><?php echo ($mname); ?></h1></div>
            <br/>
            <?php if(!empty($citys)): ?><div id="ticketcontent">
                    <div class="col-md-3 col-md-offset-1">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="glyphicon glyphicon-map-marker"></span>&nbsp;选择城市</h3>
                            </div>
                            <ul class="list-group" id="cityul">
                                <?php if(is_array($citys)): foreach($citys as $key=>$ci): ?><a class="list-group-item" href="javascript:void(0)" onclick="getticketbymovie(this)" mid="<?php echo ($mid); ?>"><?php echo ($ci); ?></a><?php endforeach; endif; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="glyphicon glyphicon-tags"/>&nbsp;选择电影票</h3>
                            </div>
                            <ul class="list-group" id="ticketul"></ul>
                        </div>
                    </div>
                    <div style="clear: both"></div>
                </div>
                <?php else: ?>
                <div class="text-center" style="width: 100%"><h2>最近没有该电影票销售</h2></div><?php endif; ?>
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

    <script src="<?php echo (JS_URL); ?>/selectticket.js"></script>

</body>
</html>