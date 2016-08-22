<?php
require_once("tool/CheckLogin.php");
checkLogin();
if(!empty($_GET['id']))
{
    date_default_timezone_set(PRC);
    $modifiedon=date("Y-m-d H:i:s");

    require_once("tool/SqlHelper.php");
    $dal=new DAL;
    $sql="update userinfo set delflag=1,modifiedon=? where id=?";
    $params=array($modifiedon,$_GET['id']);
    $rows = $dal::delete($sql,$params);
    if($rows)
    {
        header('Location:admin.php');
    }
    else
    {
        header('Refresh:1;URL=admin.php');
        echo '删除失败，请重试';
    }
}