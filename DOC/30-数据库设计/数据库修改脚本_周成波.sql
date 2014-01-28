use bestchoi_shule;
/*商品表，加tokenTall*/
alter table tp_item add `tokenTall` varchar(20) NOT NULL DEFAULT '';
/*广告，加tokenTall*/
alter table tp_ad add `tokenTall` varchar(20) NOT NULL DEFAULT '';
/*订单表，加tokenTall*/
alter table tp_item_order add `tokenTall` varchar(20) NOT NULL DEFAULT '';
/*终端用户表，加email*/
alter table tp_user add `email` varchar(90) NOT NULL DEFAULT '';
/*快递表，加tokenTall*/
alter table tp_delivery add `tokenTall` varchar(20) NOT NULL DEFAULT '';
/*发货地址表，加tokenTall*/
alter table tp_address add `tokenTall` varchar(20) NOT NULL DEFAULT '';
/*平台广告表，加tokenTall*/
alter table tp_adforhome add `tokenTall` varchar(20) NOT NULL DEFAULT '';


/*增加结账方式*/
insert into tp_menu(`name`,pid,module_name,action_name,`data`,remark,often)
values('结账方式管理',0,'account','setting','','',3)
/*菜单重置*/
update tp_menu set often = -1
/*商品管理、商品分类、添加商品、品牌管理*/
update tp_menu set often = 0 where id in(52,56,249,291);
/*订单管理、快递方式管理、发货地址管理*/
update tp_menu set often = 1 where id in(296,297,298);
/*广告管理*/
update tp_menu set often = 2 where id in(12);
/*结账方式管理*/
update tp_menu set often = 3 where name = '结账方式管理';
/*设置*/
update tp_menu set often = 99 where id in(275);