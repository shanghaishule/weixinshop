<?php
@header("Content-type: text/html; charset=utf-8");
include("db.php");
$pass=$_REQUEST['pass'];
$del=$_REQUEST['DEL'];
if(isset($_REQUEST['pass'])){
$sql_num="SELECT * FROM  `weixin_wall_num` ";
$query_num=mysql_query($sql_num,$link) or die(mysql_error());
$q=mysql_fetch_row($query_num);
$num=$q[0];


$sql1="UPDATE  `weixin_wall` SET  `ret` =  '1',`num` = '{$num}' WHERE  `id` = '{$pass}';";
$pass=$v;
include'allsql.php';
$query1=mysql_query($sql1,$link) or die(mysql_error());


$sql_num="UPDATE `weixin_wall_num` SET `num` = `num`+1";
$query_num=mysql_query($sql_num,$link) or die(mysql_error());
}
if(isset($_REQUEST['del'])){
$sql_num="SELECT * FROM  `weixin_wall_num` ";
$query_num=mysql_query($sql_num,$link) or die(mysql_error());
$q=mysql_fetch_row($query_num);
$num=$q[0];


$sql1="delete * from `weixin_wall` WHERE  `id` = '{$del}';";
$query1=mysql_query($sql1,$link) or die(mysql_error());
}
?>
<script language="javascript" type="text/javascript">  
setTimeout("javascript:location.href='shenhe.php'", 1);  
</script> 