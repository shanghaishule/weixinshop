
<?php
include("db.php");
 $tokenTall=$_GET["tokenTall"];
$totalNum=0;
$sql3="SELECT * FROM  `tp_weixin_vote` where tokenTall='".$tokenTall."' ORDER BY res DESC";
$query3=mysql_query($sql3,$link) or die(mysql_error());
while($q=mysql_fetch_row($query3)){
 $totalNum=$totalNum+1;
}
echo "已经参加人数：".$totalNum."人";


?>
