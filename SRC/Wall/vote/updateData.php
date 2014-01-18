<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script id="jquery_183" type="text/javascript" class="library" src="js/jquery-1.8.3.min.js"></script>
<link rel="stylesheet" href="css/vote.css" type="text/css">
<title>摇一摇抽奖</title>
</head>
<body>
<?php
include("db.php");
 $tokenTall=$_GET["tokenTall"];
$num=0;$totalNum=0;
$sql3="SELECT * FROM  `tp_weixin_vote` where tokenTall='".$tokenTall."' ORDER BY res DESC";
$query3=mysql_query($sql3,$link) or die(mysql_error());
while($q=mysql_fetch_row($query3)){
 $totalNum=$totalNum+1;
}
echo "<div class='totalpeple'>总共参加人数：".$totalNum."人</div>";
$sql2="SELECT * FROM  `tp_weixin_vote` where tokenTall='".$tokenTall."' ORDER BY res DESC";
$query2=mysql_query($sql2,$link) or die(mysql_error());
$gameoverflag="x";
while($q=mysql_fetch_row($query2)){
$k=$q[0];$num=$num+1;
$showtime=$q[2];
if($q[3] == 'X') $gameoverflag = 'y';
$processBar=$showtime/5.56;
@$b=$showtime/5;
if(($num%4)==1 and $num <= 11){
?>

<div class="progressbar"  data-perc="<?php echo $b?>">
        
	<div class="ff" style="color:#00ff00"><h2><?=$q[1]?></h2></div>
    <div class="gg" style="color:#ef5b9c"><h2><?=$showtime/5?></h2></div>
	<div  class="bar"><span></span></div>
	<div class="label"><span></span></div>	
</div>
<?php } if(($num%4)==2 and $num <= 11){?>

<div class="progressbar" data-perc="<?php echo $b?>">

	<div class="ff" style="color:#00ff00"><h2><?=$q[1]?></h2></div>
    <div class="gg" style="color:#ef5b9c"><h2><?=$showtime/5?></h2></div>
	<div class="bar color2"><span></span></div>
	<div class="label"><span></span></div>
</div>
<?php } if(($num%4)==3 and $num <= 11){?>
<div class="progressbar" data-perc="<?php echo $b?>">

	<div class="ff" style="color:#00ff00"><h2><?=$q[1]?></h2></div>
    <div class="gg" style="color:#ef5b9c"><h2><?=$q[2]/5?></h2></div>
	<div  class="bar color3"><span></span></div>
	<div class="label"><span></span></div>
</div>
<?php } if($num%4==0 and $num <= 11){?>
<div class="progressbar" data-perc="<?php echo $b?>">

	<div class="ff" style="color:#00ff00"><h2><?=$q[1]?></h2></div>
    <div class="gg" style="color:#ef5b9c"><h2><?=$showtime/5?></h2></div>
	<div width="<?=$processBar?>" class="bar color4"><span></span></div>
	<div class="label"><span></span></div>
</div>
<?php } }
if($gameoverflag=="x"){
  echo "<img src='images/gameover.png'>";
}

?>
		
</body>
</html>