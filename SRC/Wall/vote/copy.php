<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- <meta http-equiv="refresh" content="1" /> -->
<title>摇一摇抽奖</title>

<link rel="stylesheet" href="css/vote.css" type="text/css">
<script id="jquery_183" type="text/javascript" class="library" src="js/jquery-1.8.3.min.js"></script>
</head>
<body>
<?php
include("db.php");
 
$sql1="select sum(`res`)  from `tp_weixin_vote`;";
$query1=mysql_query($sql1,$link) or die(mysql_error());
$sum=mysql_fetch_row($query1);
$sum=$sum[0];
$sql2="SELECT * FROM  `tp_weixin_vote`";
$query2=mysql_query($sql2,$link) or die(mysql_error());
while($q=mysql_fetch_row($query2)){
$k=$q[0];
$a=$q[2];
@$b=($a/$sum)*100;
if(($k%4)==1){
?>

<div class="progressbar" data-perc="<?php echo $b?>">
	<div class="ff" style="color:#00ff00"><h2><?=$q[1]?></h2></div>
    <div class="gg" style="color:#ef5b9c"><h2><?=$q[2]?></h2></div>
	<div class="bar"><span></span></div>
	<div class="label"><span></span></div>	
</div>
<?php } if(($k%4)==2){?>

<div class="progressbar" data-perc="<?php echo $b?>">
	<div class="ff" style="color:#00ff00"><h2><?=$q[1]?></h2></div>
    <div class="gg" style="color:#ef5b9c"><h2><?=$q[2]?></h2></div>
	<div class="bar color2"><span></span></div>
	<div class="label"><span></span></div>
</div>
<?php } if(($k%4)==3){?>
<div class="progressbar" data-perc="<?php echo $b?>">
	<div class="ff" style="color:#00ff00"><h2><?=$q[1]?></h2></div>
    <div class="gg" style="color:#ef5b9c"><h2><?=$q[2]?></h2></div>
	<div class="bar color3"><span></span></div>
	<div class="label"><span></span></div>
</div>
<?php } if($k%4==0){?>
<div class="progressbar" data-perc="<?php echo $b?>">
	<div class="ff" style="color:#00ff00"><h2><?=$q[1]?></h2></div>
    <div class="gg" style="color:#ef5b9c"><h2><?=$q[2]?></h2></div>
	<div class="bar color4"><span></span></div>
	<div class="label"><span></span></div>
</div>
<?php } }?>

	    		<script>$(function() {
		
	$('.progressbar').each(function(){
		var t = $(this),
			dataperc = t.attr('data-perc'),
			barperc = Math.round(dataperc*5.56);
		t.find('.bar').animate({width:barperc}, dataperc*25);
		t.find('.label').append('<div class="perc"></div>');
		
		function perc() {
			var length = t.find('.bar').css('width'),
				perc = Math.round(parseInt(length)/5.56),
				labelpos = (parseInt(length)-2);
			t.find('.label').css('left', labelpos);
			t.find('.perc').text(perc+'%');
		}
		perc();
		setInterval(perc, 0); 
	});
});</script>
</body>
</html>