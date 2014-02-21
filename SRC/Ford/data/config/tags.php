<?php

// 行为插件
return array(
    /**
     +------------------------------------------------------------------------------
     * 系统标签
     +------------------------------------------------------------------------------
     */
    'app_begin' => array(
        'check_ipban', //禁止IP
        'load_lang', //语言
    ),
    'view_template' => array(
        'basic_template','_overlay'=>1, //自动定位模板文件
    ),
    'view_filter' => array(
        'content_replace', //路径替换
    ),

    /**
     +------------------------------------------------------------------------------
     * 用户行为标签
     +------------------------------------------------------------------------------
     */
    //登陆
    'login_begin' => array(
    ),
    'login_end' => array(
        'alter_score', // 积分
    ),
    //注册
    'register_begin' => array(
    ),
    'register_end' => array(
        'alter_score', // 积分
    ),
    //发布分享
    'pubitem_end' => array(
        'alter_score', // 积分
    ),
    //添加喜欢
    'likeitem_end' => array(
        'alter_score', // 积分
    ),
    //添加到专辑
    'joinalbum_end' => array(
        'alter_score', // 积分
    ),
    //转发分享
    'fwitem_end' => array(
        'alter_score', // 积分
    ),
    //发表评论
    'pubcmt_end' => array(
        'alter_score', // 积分
    ),
    //创建专辑
    'addalbum_end' => array(),
    //删除分享
    'delitem_end' => array(
        'alter_score', // 积分
    ),
    //删除专辑
    'delalbum_end' => array(),
);