<?php
@header("Content-type: text/html; charset=utf-8");
 
include '../config.php';
$cid=$v;
$ba="SELECT * 
FROM  `weixin_wall` 
WHERE  `id` ={$cid}
LIMIT 0 , 30";
$ba=mysql_query($ba,$link) or die(mysql_error());
$p=mysql_fetch_row($ba);
$messageid = $p[1];
$fakeid = $p[2];
$nicheng = $p[5];
$content = $p[4];
$imgurl = $p[6];

$result = mysql_query("SELECT * FROM  `allsql` WHERE  `fakeid` = '$fakeid'");
$row = mysql_fetch_array($result,MYSQL_ASSOC);

$sql = "INSERT INTO `allsql` (`id`,`messageid`,`fakeid`,`num`,`content`,`nickname`,`avatar`,`ret`) VALUES (NULL,'$messageid','$fakeid ','-1','$content','$nicheng','$imgurl','1')";
mysql_query($sql);  

?>