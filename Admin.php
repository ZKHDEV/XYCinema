<?php
    header('Content-Type:text/html;charset=utf-8');
    require_once("SqlHelper.php");
    $dal=new DAL;
    $selectSql="select * from `match`";
    $dbrecordset=$dal::query($selectSql);
    $matches=$dbrecordset->getAllRows(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/app.css">   
</head>
<body>
    <h2>Title</h2><hr>
    <a id="add-btn" class="def-btn" href="#">添加</a>
    <table class="admin-table">
    <thead>
    <tr>
        <th>id</th>
        <th>h_id</th>
        <th>g_id</th>
        <th>h_score</th>
        <th>g_score</th>
        <th>m_time</th>
        <th>修改</th>
        <th>删除</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($matches as $m):?>
        <tr>
            <td><?php echo $m['id'];?></td>
            <td><?php echo $m['h_id'];?></td>
            <td><?php echo $m['g_id'];?></td>
            <td><?php echo $m['h_score'];?></td>
            <td><?php echo $m['g_score'];?></td>
            <td><?php echo $m['m_time'];?></td>
            <td><a href="update?id=<?php echo $m['id'];?>">修改</a></td>
            <td><a href="delete?id=<?php echo $m['id'];?>">删除</a></td>
        </tr>
    <?php endforeach;?>
    </tbody> 
    </table>


    <script src="js/jquery-1.12.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/page.js"></script>
</body>
</html>