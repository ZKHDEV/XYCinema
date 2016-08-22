<?php
    require_once("tool/CheckLogin.php");
    checkLogin();
    header('Content-Type:text/html;charset=utf-8');

    if(empty($_GET))
    {
        echo '信息不存在';
        die;
    }

    require_once("tool/SqlHelper.php");
    $dal=new DAL;
    if(!empty($_POST))
    {
        date_default_timezone_set(PRC);
        $_POST['modifiedon']=date("Y-m-d H:i:s");

        if($_FILES['file']['error']!==4)
        {
            require_once("tool/Upload.php");
            $_POST['photo']=upload();
        }

        $sql="update userinfo set name=?,age=?,phone=?,email=?,photo=?,modifiedon=? where id=?";
        $params=array($_POST['name'],$_POST['age'],$_POST['phone'],$_POST['email'],$_POST['photo'],$_POST['modifiedon'],$_GET['id']);
        $rows=$dal::update($sql,$params);
        if($rows)
        {
            header('Refresh:1;URL=admin.php');
            echo '修改成功';
            die;
        }
        else
        {
            echo '修改失败，请重试';
        }
    }
    else
    {      
        $selectSql="select * from userinfo where id=?";
        $dbrecordset=$dal::query($selectSql,$_GET['id']);
        $user=$dbrecordset->next(); 
    }
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta charset="UTF-8">
        <title>修改用户</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/app.css">
    </head>

    <body>
        <div class="container">
            <h2>修改用户 <a href="admin.php" class="btn btn-danger btn-xs">返回</a></h2>
            <hr>
            <div class="col-md-4">
                <form id="form1" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">姓名*</label>
                        <input type="text" name="name" id="name" class="form-control" autofocus="autofocus" required="required" maxlength="10" value="<?php echo $user['name'];?>">
                    </div>
                    <div class="form-group">
                        <label for="age">年龄*</label>
                        <input type="number" name="age" id="age" class="form-control" required="required" maxlength="2" value="<?php echo $user['age'];?>">
                    </div>
                    <div class="form-group">
                        <label for="phone">手机号*</label>
                        <input type="text" name="phone" id="phone" class="form-control" required="required" pattern="^(((13[0-9]{1})|(15[0-9]{1}))+\d{8})$" value="<?php echo $user['phone'];?>">
                    </div>
                    <div class="form-group">
                        <label for="email">邮箱*</label>
                        <input type="email" name="email" id="email" class="form-control" required="required" value="<?php echo $user['email'];?>">
                    </div>
                    <input type="hidden" name="photo" value="<?php echo $user['photo'];?>">
                    <div class="form-group">
                        <label for="inputfile">照片</label>
                        <input type="file" id="inputfile" name="file" onchange="checkfile()" accept="image/jpeg,image/gif,image/png">
                        <p class="text-danger">注意：照片格式须为"jpg,gif,png"，大小须小于5MB。</p>
                    </div>
                    <button type="submit" class="btn btn-large btn-success" style="margin-bottom: 100px">提交</button>
                    <button type="reset" class="btn btn-large btn-info" style="margin-bottom: 100px">重置</button>
                </form>
            </div>
        </div>
        <script src="js/jquery-1.12.4.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/validate.js"></script>
    </body>

    </html>