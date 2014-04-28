<?php
header("Content-type: text/html; charset=utf-8");
include("db.php");
$xsname=$_REQUEST['xsname'];
if(isset($_REQUEST['check'])){
foreach($xsname as $k => $v)
{
$k=$k+1;
$sql1="UPDATE  `weixin_vote` SET  `name` =  '{$v}' where `id` = '{$k}';";
$query1=mysql_query($sql1,$link) or die(mysql_error());
}
}
?>