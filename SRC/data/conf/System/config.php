<?php
return array(
	'USER_AUTH_ON'              =>  true,
    'USER_AUTH_TYPE'			=>  2,		// 默认认证类型 1 登录认证 2 实时认证
    'USER_AUTH_KEY'             =>  'user_id',	// 用户认证SESSION标记
    'ADMIN_AUTH_KEY'			=>  'administrator',
    'USER_AUTH_MODEL'           =>  'User',	// 默认验证数据表模型
    'AUTH_PWD_ENCODER'          =>  'md5',	// 用户认证密码加密方式
    'USER_AUTH_GATEWAY'         =>  '?g=Admin&m=Admin&a=index',// 默认认证网关
    'NOT_AUTH_MODULE'           =>  'Admin,Index',	// 默认无需认证模块
    'REQUIRE_AUTH_MODULE'       =>  '',		// 默认需要认证模块
	'NOT_AUTH_ACTION'           =>  'index',		// 默认无需认证操作
    'REQUIRE_AUTH_ACTION'       =>  '',		// 默认需要认证操作
    'GUEST_AUTH_ON'             =>  false,    // 是否开启游客授权访问
    'GUEST_AUTH_ID'             =>  0,        // 游客的用户ID
	'RBAC_ROLE_TABLE'			=>	'tp_role',
	'RBAC_USER_TABLE'			=>	'tp_role_user',
	'RBAC_ACCESS_TABLE'			=>	'tp_access',
	'RBAC_NODE_TABLE'			=>	'tp_node',
	'SPECIAL_USER'				=>	'admin',
);