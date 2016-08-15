<?php

header("Content-Type:text/html;charset=utf-8");

define('APP_DEBUG',true);

define('PUBLIC_IMG_URL', '/cinema/Public/img');

define('CSS_URL', '/cinema/Home/Public/css');
define('IMG_URL', '/cinema/Home/Public/img');
define('JS_URL', '/cinema/Home/Public/js');
define('FONT_URL', '/cinema/Home/Public/font');

define('ADMIN_CSS_URL', '/cinema/Admin/Public/css');
define('ADMIN_IMG_URL', '/cinema/Admin/Public/img');
define('ADMIN_JS_URL', '/cinema/Admin/Public/js');
define('ADMIN_FONT_URL', '/cinema/Admin/Public/font');

define('UPLOAD_URL', '/cinema/Public/Upload');

include '../ThinkPHP/ThinkPHP.php';