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

    <title>查看资料 - 想映电影院</title>

    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 text-center">
                    <h2 id="vipheader">会员中心</h2>
                </div>
                <div id="vipdiv" class="col-md-8">
                    <div class="col-md-4">
                        <p>用户名：<?php echo (session('u_name')); ?></p>
                    </div>
                    <div class="col-md-4">
                        <p>绑定手机号：<?php echo (session('u_phone')); ?></p>
                        <p>会员消费积分：<?php echo ($user["u_points"]); ?></p>
                    </div>
                    <div class="col-md-4">
                        <p>会员级别：
                            <?php if($user["u_points"] < 100): ?>铜牌会员
                                <?php elseif($user["u_points"] < 200): ?>银牌会员
                                <?php else: ?>金级会员<?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
            <br/>
            <hr class="grehr"/>
            <div class="row">
                <div class="col-md-3">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">我的订单</h3>
                        </div>
                        <div class="list-group">
                            <a href="/cinema/Home/User/index" class="list-group-item">我的订单</a>
                        </div>
                    </div>
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">个人信息</h3>
                        </div>
                        <div class="list-group">
                            <p class="list-group-item active">查看资料</p>
                            <a href="/cinema/Home/User/changemsg" class="list-group-item">修改资料</a>
                            <a href="/cinema/Home/User/changepwd" class="list-group-item">修改密码</a>
                        </div>
                    </div>
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">我的影片</h3>
                        </div>
                        <div class="list-group">
                            <a href="/cinema/Home/User/comment" class="list-group-item">我的影评</a>
                            <a href="/cinema/Home/User/history" class="list-group-item">我看过的影片</a>
                            <a href="/cinema/Home/User/wantsee" class="list-group-item">我想看的影片</a>
                        </div>
                    </div>
                    <br/>
                    <a class="btn btn-warning btn-group-justified" href="/cinema/Home/Manager/logout">退出登录</a>
                </div>
                <div class="col-md-9">
                    <hr class="orghr"/>
                    <h3>用户名：<?php echo (session('u_name')); ?></h3>
                    <h3>手机号：<?php echo (session('u_phone')); ?></h3>
                    <h3>邮箱：<?php echo ($user["u_email"]); ?></h3>
                    <h3>创建时间：<?php echo ($user["u_subtime"]); ?></h3>
                    <h3>积分：<?php echo ($user["u_points"]); ?></h3>
                    <h3>等级：
                        <?php if($user["u_points"] < 100): ?>铜牌会员
                            <?php elseif($user["u_points"] < 200): ?>银牌会员
                            <?php else: ?>金级会员<?php endif; ?>
                    </h3>
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

    <script src="<?php echo (JS_URL); ?>/jquery.validate.min.js"></script>
    <script src="<?php echo (JS_URL); ?>/validate.js"></script>

</body>
</html>