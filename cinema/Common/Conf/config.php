<?php
return array(
	'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'xycinema',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'xy_',    // 数据库表前缀
	
    'SHOW_PAGE_TRACE'       =>  false,
    
    'DEFAULT_MODULE'        =>  'Home',
    'DEFAULT_CONTROLLER'        =>  'Home',
    'DEFAULT_ACTION'        =>  'index',
    'MODULE_ALLOW_LIST'     =>  array('Home','Admin'),
    'TMPL_CACHE_ON'         =>  false,

    'URL_MODEL'             =>  2,

    'THINK_EMAIL' => array(
        'SMTP_HOST'   => 'smtp.sina.com',
        'SMTP_PORT'   => '25',
        'SMTP_USER'   => 'zkhdev@sina.com',
        'SMTP_PASS'   => 'DEV1234',
        'FROM_EMAIL'  => 'zkhdev@sina.com',
        'FROM_NAME'   => '想映电影',
        'REPLY_EMAIL' => 'zkhdev@sina.com',
        'REPLY_NAME'  => '想映电影'
    )
); 