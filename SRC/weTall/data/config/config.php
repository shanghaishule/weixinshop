<?php
return array(
    'APP_GROUP_LIST' => 'home,admin', //分组
    'DEFAULT_GROUP' => 'home', //默认分组
    'DEFAULT_MODULE' => 'index', //默认控制器
    'TAGLIB_PRE_LOAD' => 'pin', //自动加载标签
    'APP_AUTOLOAD_PATH' => '@.Pintag,@.Pinlib,@.ORG', //自动加载项目类库
    'TMPL_ACTION_SUCCESS' => 'public:success',
    'TMPL_ACTION_ERROR' => 'public:error',
    'DATA_CACHE_SUBDIR'=>true, //缓存文件夹
    'DATA_PATH_LEVEL'=>3, //缓存文件夹层级
    'LOAD_EXT_CONFIG' => 'url,db', //扩展配置
    
    'SHOW_PAGE_TRACE' => false,
);