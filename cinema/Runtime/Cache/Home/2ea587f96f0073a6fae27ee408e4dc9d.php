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

    <title>选座订票 - 想映电影院</title>

    <div>
        <div class="container">
            <img src="<?php echo (IMG_URL); ?>/nav2.png" class="img-responsive" alt="" id="ordernav"/>
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
                            <th>积分</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><?php echo ($ticket["movie"]); ?></td>
                            <td><?php echo ($ticket["cinema"]); ?></td>
                            <td><?php echo ($ticket["t_date"]); ?></td>
                            <td><?php echo ($ticket["t_time"]); ?></td>
                            <td><?php echo ($ticket["t_language"]); ?>/<?php echo ($ticket["t_standard"]); ?></td>
                            <td><?php echo ($ticket["room"]); ?></td>
                            <td><?php echo ($ticket["t_points"]); ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="text-center">
                        <img src="<?php echo (IMG_URL); ?>/screen.png" alt=""/><br/><br/>

                        <div class="seatdiv">
                            <?php $__FOR_START_3082__=1;$__FOR_END_3082__=12;for($row=$__FOR_START_3082__;$row < $__FOR_END_3082__;$row+=1){ ?><ul class="seatlist">
                                    <?php $__FOR_START_23675__=1;$__FOR_END_23675__=15;for($col=$__FOR_START_23675__;$col < $__FOR_END_23675__;$col+=1){ $n = $row*14-14+$col; $url = ADMIN_IMG_URL; $colnum=$col-$mincol+1; $rownum=$row-$minrow+1; if(in_array($row*14-14+$col,$room['seats'])) if(in_array($row*14-14+$col,$room['disseatarr'])) echo "<li><img src='$url/fseat.png'/></li>"; else echo "<li><a href='javascript:void(0)' class='seatlink' col='$colnum' row='$rownum' num='$n' sel='0'><img src='$url/eseat.png'/></a></li>"; else echo "<li><div class='eseatdiv'>&nbsp;</div></a></li>"; } ?>
                                </ul>
                                <div class="seatclear"></div><?php } ?>
                        </div>

                        <hr class="bghr"/>
                        <ul class="list-group list-inline" id="zjlist">
                            <li><img src="<?php echo (IMG_URL); ?>/eseat.png" alt=""/>可选座位</li>
                            <li><img src="<?php echo (IMG_URL); ?>/sseat.png" alt=""/>已选座位</li>
                            <li><a sel="2"><img src="<?php echo (IMG_URL); ?>/fseat.png" alt=""/></a>不可选座位</li>
                        </ul>
                        <p>本影厅共有座位<?php echo ($room["totalcount"]); ?>个，当前已售<?php echo ($room["discount"]); ?>个</p><br/>
                    </div>
                    <p class="error">特别提示：</p>
                    <p>下单前请仔细核对影片、影院、场次、手机号等信息。</p>
                    <p>下单后请在15分钟内完成支付，超时系统将不保留座位。</p>
                    <p>每笔订单最多可以选择6个座位，请选择连续的座位。</p>
                </div>
                <div class="col-md-3" id="confirmseatdiv">
                    <img class="img-responsive" src="<?php echo (UPLOAD_URL); ?>/<?php echo ($movie["m_frontcover"]); ?>" alt=""/><br/><br/>
                    <form action="/cinema/Home/Order/submitorder" method="post" class="form-horizontal" onsubmit="return checkform()">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="seatlist">座位:</label>
                            <div class="col-md-9">
                                <textarea type="text" id="seatlist" name="o_seatlist" rows="3" class="form-control" readonly></textarea>
                                <input type="hidden" id="seats" name="o_seats"/>
                                <input type="hidden" name="o_ticketid" value="<?php echo ($ticket["t_id"]); ?>"/>
                                <input type="hidden" name="price" value="<?php echo ($ticket["t_price"]); ?>"/>
                            </div>
                        </div>
                        <br/>
                        <div class="form-group">
                            <label class="col-md-3 control-label">已选择</label>
                            <div class="col-md-2">
                                <p id="seatnump" class="form-control-static">0</p>
                            </div>
                            <label class="col-md-7 control-label">个座位,再次点击取消</label>
                        </div>
                        <br/>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-danger btn-lg" onclick="return checkseat()">选座确认</button>
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