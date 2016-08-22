<?php
    session_destroy();
    unset($_SESSION);
    setcookie(session_name(),'',time()-1,'/');
    header('Location:login.php');