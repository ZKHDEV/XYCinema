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

    <title>会员中心 - 想映电影院</title>
    
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
                            <p class="list-group-item active">我的订单</p>
                        </div>
                    </div>
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">个人信息</h3>
                        </div>
                        <div class="list-group">
                            <a href="/cinema/Home/User/permsg" class="list-group-item">查看资料</a>
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
                    <?php if(!empty($orders)): if(is_array($orders)): foreach($orders as $key=>$order): ?><br/>
                            <div class="row orderitem">
                                <div class="col-md-1">

                                </div>
                                <div class="col-md-6">
                                    <div class="ticket">
                                        <div><?php echo ($order["date"]); ?></div>
                                        <div><?php echo ($order["time"]); ?></div>
                                        <div>
                                            <h3><?php echo ($order["movie"]); ?>(<?php echo ($order["standard"]); ?>)</h3>
                                            <?php switch($order["o_state"]): case "0": ?><img src="<?php echo (IMG_URL); ?>/wyz.png" alt=""/><?php break;?>
                                                <?php case "1": ?><img src="<?php echo (IMG_URL); ?>/yyz.png" alt=""/><?php break;?>
                                                <?php case "2": ?><img src="<?php echo (IMG_URL); ?>/cyz.png" alt=""/><?php break;?>
                                                <?php case "3": ?><img src="<?php echo (IMG_URL); ?>/tyz.png" alt=""/><?php break; endswitch;?>
                                        </div>
                                        <div>总价：¥<?php echo ($order["o_price"]); ?>元</div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="btn-group">
                                        <?php if($order["o_state"] == 0): ?><a type="button" href="/cinema/Home/Order/pay/o_id/<?php echo ($order["o_id"]); ?>" class="btn btn-warning">马上付款</a>
                                            <a type="button" href="/cinema/Home/Order/cancel/o_id/<?php echo ($order["o_id"]); ?>" onclick="return confirm('确认取消此订单？');" class="btn btn-danger">取消订单</a>
                                            <?php else: ?>
                                            <a type="button" href="/cinema/Home/User/order/o_id/<?php echo ($order["o_id"]); ?>" class="btn btn-primary">查看订单</a>
                                            <a type="button" href="/cinema/Home/Order/delete/o_id/<?php echo ($order["o_id"]); ?>" onclick="return confirm('确认删除此订单？');" class="btn btn-danger">删除订单</a><?php endif; ?>
                                    </div>
                                </div>
                            </div><?php endforeach; endif; ?>
                        <?php else: ?>
                            <h1>你还没有任何订单！</h1><?php endif; ?>
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

</body>
</html>