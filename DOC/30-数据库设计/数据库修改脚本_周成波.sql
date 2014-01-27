use bestchoi_shule;
/*商品表，加tokenTall*/
alter table tp_item add `tokenTall` varchar(20) NOT NULL DEFAULT '';
/*广告，加tokenTall*/
alter table tp_ad add `tokenTall` varchar(20) NOT NULL DEFAULT '';
/*订单表，加tokenTall*/
alter table tp_item_order add `tokenTall` varchar(20) NOT NULL DEFAULT '';

/*终端用户表，加email*/
alter table tp_user add `email` varchar(90) NOT NULL DEFAULT '';

/*隐藏：商品分类、品牌管理 often=1 => 0
update tp_menu set often = 0 where id in(56,291);
*/
/*隐藏：注册登录 often=6 => 0*/
update tp_menu set often = 0 where id in(286);

/*快递表，加tokenTall*/
alter table tp_delivery add `tokenTall` varchar(20) NOT NULL DEFAULT '';

/*发货地址表，加tokenTall*/
alter table tp_address add `tokenTall` varchar(20) NOT NULL DEFAULT '';

/*平台广告表，加tokenTall*/
alter table tp_adforhome add `tokenTall` varchar(20) NOT NULL DEFAULT '';
