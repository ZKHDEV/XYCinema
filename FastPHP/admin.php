<?php
    require_once("tool/CheckLogin.php");
    checkLogin();
    header('Content-Type:text/html;charset=utf-8');
    require_once("tool/SqlHelper.php");
    $dal=new DAL;
    $selectSql="select * from `userinfo` where delflag=0";
    $dbrecordset=$dal::query($selectSql);
    $users=$dbrecordset->getAllRows(); 
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta charset="UTF-8">
        <title>用户管理</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/app.css">
    </head>

    <body>
        <div class="container">
            <h2>用户管理 <a href="logout.php" class="btn btn-danger btn-xs">注销</a></h2>

            <hr><a style="margin: 20px 0" class="btn btn-success" href="add.php">添加</a><br>
            <table id="admin-table" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>姓名</th>
                        <th>年龄</th>
                        <th>手机号</th>
                        <th>邮箱</th>
                        <th>相片</th>
                        <th>创建时间</th>
                        <th>修改时间</th>
                        <th>修改</th>
                        <th>删除</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $item):?>
                    <tr>
                        <td>
                            <?php echo $item['id'];?>
                        </td>
                        <td>
                            <?php echo $item['name'];?>
                        </td>
                        <td>
                            <?php echo $item['age'];?>
                        </td>
                        <td>
                            <?php echo $item['phone'];?>
                        </td>
                        <td>
                            <?php echo $item['email'];?>
                        </td>
                        <td>
                            <?php 
                                if(!empty($item['photo']))
                                {
                                    echo "<img src='upload/".$item['photo']."' alt='photo' style='height:100px'>";
                                }
                            ?>
                        </td>
                        <td>
                            <?php echo $item['subtime'];?>
                        </td>
                        <td>
                            <?php echo $item['modifiedon'];?>
                        </td>
                        <td><a href="update.php?id=<?php echo $item['id'];?>">修改</a></td>
                        <td><a href="delete.php?id=<?php echo $item['id'];?>" onclick="return confirm('确认删除？');">删除</a></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <script src="js/jquery-1.12.4.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/page.js"></script>
    </body>

    </html>