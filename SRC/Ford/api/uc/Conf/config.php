<?php
$db_config = include_once (PINPHP_PATH . 'data/config/db.php');
$uc_config =  array(
    'DEFAULT_MODULE' => 'index',
);
return array_merge($db_config, $uc_config);