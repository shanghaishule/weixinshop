<?php
@header("Content-type: text/html; charset=utf-8");
include("db.php");
$pass=$_REQUEST['check'];
if(isset($_REQUEST['check'])){
foreach($pass as $v)
{
$sql_num="SELECT * FROM  `weixin_wall_num`;";
$query_num=mysql_query($sql_num,$link) or die(mysql_error());
$q=mysql_fetch_row($query_num);
$num=$q[0];

$sql1="UPDATE  `weixin_wall` SET  `ret` =  '1',`num` = '{$num}'   WHERE  `id` = '{$v}';";

include'allsql.php';
$query1=mysql_query($sql1,$link) or die(mysql_error());

$sql_num="UPDATE `weixin_wall_num` SET `num` = `num`+1";
$query_num=mysql_query($sql_num,$link) or die(mysql_error());
}
}
?>