<?php

return array(
    'code'      => 'taobao',
    'name'      => '淘宝/天猫',
    'desc'      => '通过淘宝开放平台获取商品数据，可到 http://open.taobao.com/ 查看详细',
    'author'    => 'PinPHP TEAM',
    'domain'   => 'http://www.taobao.com,http://www.tianmao.com',
    'version'   => '1.0',
    'config'    => array(
        'app_key'   => array(        //账号
            'text'  => 'App Key',
            'desc'  => '淘宝开放平台申请应用获取',
            'type'  => 'text',
        ),
        'app_secret'       => array(        //密钥
            'text'  => 'App Secret',
            'desc'  => '淘宝开放平台申请应用获取',
            'type'  => 'text',
        )
    )
);