<?php
if (!is_file('./data/install.lock')) {
    header('Location: ./install.php');
    exit;
}
/* 当前PinPHP程序版本 */
define('PIN_VERSION', '5.0');
/* 当前PinPHP程序Release */
define('PIN_RELEASE', '20121127');
/* 应用名称*/
define('APP_NAME', 'app');
/* 应用目录*/
define('APP_PATH', './app/');
/* 数据目录*/
define('PIN_DATA_PATH', './data/');
/* 扩展目录*/
define('EXTEND_PATH', APP_PATH . 'Extend/');
/* 配置文件目录*/
define('CONF_PATH', PIN_DATA_PATH . 'config/');
/* 数据目录*/
define('RUNTIME_PATH', PIN_DATA_PATH . 'runtime/');
/* HTML静态文件目录*/
define('HTML_PATH', PIN_DATA_PATH . 'html/');
/* DEBUG开关*/
define('APP_DEBUG', true);
require("./_core/setup.php");