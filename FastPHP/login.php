<?php
    header('Content-Type:text/html;charset=utf-8');
    if(!empty($_POST))
    {
        if(empty($_POST['uname']) || empty($_POST['pwd']))
        {
            header('Refresh:2;URL=login.php');
            echo '用户名或密码不能为空';
            die;
        }
        session_start();
        if(strtolower($_POST['validate']) !== strtolower($_SESSION['code']))
        {
            header('Refresh:2;URL=login.php');
            echo '验证码错误';
            die;
        }

        unset($_SESSION['code']);

        require_once("tool/SqlHelper.php");
        $dal=new DAL;
        $selectSql="select * from admin where uname=?";
        $params=$_POST['uname'];
        $dbrecordset=$dal::query($selectSql,$params);
        $user=$dbrecordset->next(); 
        if($user)
        {
            if($user['pwd']===$_POST['pwd'])
            {
                $_SESSION['u_name']=$_POST['uname'];
                $_SESSION['u_pwd']=$_POST['pwd'];
                header('Location:admin.php');
                die;
            }
        }
        header('Refresh:2;URL=login.php');
        echo '用户名或密码错误';
        die;
    }   
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta charset="UTF-8">
        <title>后台管理登录</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/app.css">
    </head>

    <body id="loginbody">
        <div id="logindiv" class="col-md-4 col-md-offset-4 text-center">
            <h1>登录</h1>
            <form id="loginform" class="form-horizontal" action="" method="post" onsubmit="onlogin()">
                <input class="form-control" type="text" name="uname" id="uname" required="required" placeholder="用户名">
                <input class="form-control" type="password" id="pwd" required="required" placeholder="密码">
                <input type="hidden" name="pwd" id="h_pwd">
                <div class="col-md-8">
                    <input type="text" class="form-control" required="required" name="validate" id="validate" placeholder="验证码" autocomplete="off">
                </div>
                <div class="col-md-4">
                    <img id="valiimg" src="tool/captcha.php" onclick="this.src='tool/Captcha.php/'+ Math.random()" alt="验证码" />
                </div>
                <button type="submit" class="btn btn-lg btn-block btn-info ">登 录</button>
            </form>
        </div>

        <script src="js/jquery-1.12.4.min.js "></script>
        <script src="js/bootstrap.min.js "></script>
        <script src="js/jquery.md5.js "></script>
        <script>
            function onlogin() {
                $("#h_pwd ").val($.md5($('#pwd').val()));
                $("#pwd ").attr('disabled', 'true');
            }
        </script>
    </body>

    </html>