<?php
if (is_file('./data/install.lock')) {
    header('Location: ./');
    exit;
}
/* 应用名称*/
define('APP_NAME', 'install');
/* 应用目录*/
define('APP_PATH', './install/');
/* DEBUG开关*/
define('APP_DEBUG', false);
require("./_core/setup.php");