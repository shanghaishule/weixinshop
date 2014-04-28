<?php

@header("Content-type: text/html; charset=utf-8");
 
include 'config.php';

$messageid = $messageid;
$fakeid = $FakeId;
$nicheng = $NickName;
$content = $content;
$imgurl = $imgurl;

$result = mysql_query("SELECT * FROM  `weixin_wall` WHERE  `fakeid` = '$fakeid'");
$row = mysql_fetch_array($result,MYSQL_ASSOC);


$sql = "INSERT INTO `weixin_wall` (`id`,`messageid`,`fakeid`,`num`,`content`,`nickname`,`avatar`,`ret`) VALUES (NULL,'$messageid','$fakeid ','-1','$content','$nicheng','$imgurl','0')";
mysql_query($sql);  

?>