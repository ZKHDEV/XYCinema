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

    <title>电影详情 - 想映电影院</title>

    <div>
        <div class="container">
            <div class="col-md-3">
                <div id="moviediv" class="text-center">
                    <img id="moviepic" class="img-responsive" src="<?php echo (UPLOAD_URL); ?>/<?php echo ($movie["m_frontcover"]); ?>" alt=""/>
                    <div class="btn-group-vertical">
                        <a href="/cinema/Home/Order/ticket/m_id/<?php echo ($movie["m_id"]); ?>" class="btn btn-danger btn-lg">选座购票</a>
                        <?php if(!empty($_SESSION['u_id'])): if(empty($exiwant)): ?><a id="wantlink" href="javascript:void(0)" onclick="subwant(this)" mid="<?php echo ($movie["m_id"]); ?>" class="btn btn-info btn-lg">我想看</a>
                                <?php else: ?>
                                <a disabled class="btn btn-info btn-lg">已添加</a><?php endif; endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <h1><?php echo ($movie["m_name"]); ?></h1><hr/>
                <p>导演：<?php echo ($movie["m_director"]); ?></p>
                <p>主演：<?php echo ($movie["m_star"]); ?></p>
                <p>类型：<?php echo ($movie["m_type"]); ?></p>
                <p>国家/地区：<?php echo ($movie["m_country"]); ?></p>
                <p>语言：<?php echo ($movie["m_language"]); ?></p>
                <p>版本：<?php echo ($movie["m_version"]); ?></p>
                <p>上映日期：<?php echo ($movie["m_showdate"]); ?></p>
                <p>片长：<?php echo ($movie["m_length"]); ?></p>
                <br/>
                <h3>影片剧情</h3><hr/>
                <p><?php echo ($movie["m_descride"]); ?></p>
                <br/>
                <h3>预告片</h3><hr/>
                <embed src="<?php echo ($movie["m_advance"]); ?>" allowFullScreen="true" quality="high" width="480" height="400" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash"></embed>
                <br/>
                <?php if(!empty($stages)): ?><h3>精彩剧照</h3><hr/>
                    <ul class="list-inline" id="stagelist">
                        <?php if(is_array($stages)): foreach($stages as $key=>$stage): ?><li><a target="_blank" href="<?php echo (UPLOAD_URL); ?>/<?php echo ($stage["s_url"]); ?>"><img width="195px" src="<?php echo (UPLOAD_URL); ?>/<?php echo ($stage["sm_url"]); ?>" alt=""/></a></li><?php endforeach; endif; ?>
                    </ul><?php endif; ?>
                <br/>
                <h3>影评</h3><hr/>
                <div class="jumbotron commentdiv">
                    <?php if(empty($_SESSION['u_id'])): ?><a href="/cinema/Home/Manager/login" class="btn btn-info btn-lg">请 先 登 录</a>
                        <?php else: ?>
                        <form action="/cinema/Home/Movie/comment" method="post" autocomplete="off">
                            <input type="hidden" name="c_movieid" value="<?php echo ($movie["m_id"]); ?>">
                            <textarea id="comtext" name="c_content" class="form-control" rows="5" maxlength="140" placeholder="有你参与更精彩 ！"></textarea>
                            <button type="submit" class="btn btn-danger btn-lg">提 交</button>
                        </form>
                        <?php if(!empty($mycomments)): ?><br/>
                            <h4>我的影评</h4>
                            <hr/>
                            <?php if(is_array($mycomments)): foreach($mycomments as $key=>$comment): ?><div>
                                    <p><?php echo ($comment["c_content"]); ?></p>
                                    <p class="pull-right fromp">--- 我 <?php echo ($comment["c_subtime"]); ?> &nbsp;&nbsp;&nbsp; <a href="/cinema/Home/Movie/delete/c_id/<?php echo ($comment["c_id"]); ?>">删除</a></p>
                                </div>
                                <hr/><?php endforeach; endif; endif; endif; ?>
                </div>
                <?php if(!empty($comments)): ?><div class="jumbotron commentdiv">
                        <h4>全部影评</h4>
                        <hr/>
                        <?php if(is_array($comments)): foreach($comments as $key=>$comment): ?><div>
                                <p><?php echo ($comment["c_content"]); ?></p>
                                <p class="pull-right fromp">--- <?php echo ($comment["user"]); ?> <?php echo ($comment["c_subtime"]); ?></p>
                            </div>
                            <hr/><?php endforeach; endif; ?>
                    </div><?php endif; ?>
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
        function subwant(target) {
            var mid=$(target).attr('mid');
            $.post("/cinema/Home/Movie/wantsee",{"m_id":mid},function (data) {
                if(data==='ok') {
                    $("#wantlink").html("已添加");
                    $("#wantlink").attr("disabled","none");
                }
                else{
                    alert('操作失败，请重试');
                }
            });
        }
    </script>

</body>
</html>