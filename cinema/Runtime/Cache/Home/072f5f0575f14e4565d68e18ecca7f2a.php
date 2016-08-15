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

    <title>确认订单 - 想映电影院</title>

    <div>
        <div class="container">
            <img src="<?php echo (IMG_URL); ?>/nav3.png" class="img-responsive" alt="" id="ordernav"/>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <table id="ordertable" class="table table-striped text-center">
                        <thead>
                        <tr>
                            <th>影片</th>
                            <th>影院</th>
                            <th>日期</th>
                            <th>时间</th>
                            <th>语言/制式</th>
                            <th>影厅</th>
                            <th>座位</th>
                            <th>可获积分</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><?php echo ($order["movie"]); ?></td>
                            <td><?php echo ($order["cinema"]); ?></td>
                            <td><?php echo ($order["date"]); ?></td>
                            <td><?php echo ($order["time"]); ?></td>
                            <td><?php echo ($order["language"]); ?>/<?php echo ($order["standard"]); ?></td>
                            <td><?php echo ($order["cinema"]); ?></td>
                            <td><?php echo ($order["o_seatlist"]); ?></td>
                            <td><?php echo ($order["points"]); ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <h3>确认订单</h3><hr/>
            <div class="row">
                <div class="col-md-3">
                    <div class="well">
                        <p>会员<?php echo (session('u_name')); ?>您好：</p><br/>
                        <p>&nbsp;&nbsp;您当前绑定的手机号是：</p>
                        <h4 class="text-warning">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo (session('u_phone')); ?></h4>
                    </div>
                </div>
                <div class="col-md-9">
                    <br/><p>票数：<?php echo ($order["ticketnum"]); ?> 张</p>
                    <p>购票单价：¥<?php echo ($order["price"]); ?></p><br/>
                    <form action="/cinema/Home/Order/pay/o_id/44.html" method="post">
                        <h4>可享受优惠：</h4><br/>
                        <div>
                            <label class="checkbox-inline">
                                <input type="radio" name="privilege" value="0" checked>&nbsp;无优惠
                            </label>
                        </div>
                        <hr/>
                        <h4>可选支付方式：</h4><br/>
                        <div class="row">
                            <div class="col-md-9">
                                <label class="checkbox-inline">
                                    <input type="radio" name="paystyle" value="1" checked>&nbsp;支付宝支付
                                </label>
                                <label class="checkbox-inline">
                                    <input type="radio" name="paystyle" value="2">&nbsp;微信支付
                                </label>
                            </div>
                            <div class="col-md-3">
                                <p>支付金额：¥<?php echo ($order["o_price"]); ?></p>
                            </div>
                        </div>
                        <hr/><br/>
                        <div class="row">
                            <div class="col-md-3 col-md-offset-9">
                                <h4>总价：¥<?php echo ($order["o_price"]); ?></h4><br/>
                                <button type="submit" class="btn btn-warning btn-lg">确认付款</button>
                            </div>
                        </div>
                    </form>
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

    <script src="<?php echo (JS_URL); ?>/selectseat.js"></script>

</body>
</html>