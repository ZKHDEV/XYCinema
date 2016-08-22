<?php
function checkLogin()
{
    session_start();
    if(empty($_SESSION['u_name'])||empty($_SESSION['u_pwd']))
    {
        header('Location:login.php');
        die;
    }
    else
    {
        require_once("tool/SqlHelper.php");
        $dal=new DAL;
        $selectSql="select * from admin where uname=? and pwd=?";
        $params=array($_SESSION['u_name'],$_SESSION['u_pwd']);
        $dbrecordset=$dal::query($selectSql,$params);
        $user=$dbrecordset->next(); 
        if(!$user)
        {
            header('Location:login.php');
            die;
        }
    }
}