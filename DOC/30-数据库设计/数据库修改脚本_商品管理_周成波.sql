use bestchoi_shule;
/*商品表*/
alter table tp_item add `tokenTall` varchar(20) NOT NULL DEFAULT '';
/*广告和广告位*/
alter table tp_ad add `tokenTall` varchar(20) NOT NULL DEFAULT '';
alter table tp_adboard add `tokenTall` varchar(20) NOT NULL DEFAULT '';
/*商品图片*/
alter table tp_item_img add `tokenTall` varchar(20) NOT NULL DEFAULT '';
/*终端用户收货地址表
alter table tp_user_address add `tokenTall` varchar(20) NOT NULL DEFAULT '';
去除tokenTall
alter table tp_user_address drop `tokenTall`;
*/
/*终端用户表*/
alter table tp_user add `email` varchar(90) NOT NULL DEFAULT '';
