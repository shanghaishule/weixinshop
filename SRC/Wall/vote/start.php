<?php $tokenTall=$_GET['tokenTall'];?>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf8" />
<script id="jquery_183" type="text/javascript" class="library" src="js/jquery-1.8.3.min.js"></script>
<link rel="stylesheet" href="css/vote.css" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Lustria|Niconne|McLaren' rel='stylesheet' type='text/css'>
<link href="css/styles.css" rel="stylesheet" type="text/css">
<link rel='stylesheet' id='camera-css'  href='css/camera.css' type='text/css' media='all'> 
<script type='text/javascript' src='js/jquery.min.js'></script>
<script type='text/javascript' src='js/jquery.mobile.customized.min.js'></script>
<script type='text/javascript' src='js/jquery.easing.1.3.js'></script> 
<script type='text/javascript' src='js/camera.min.js'></script> 
</head>
<script>
var xmlHttp=new XMLHttpRequest();;
function createXMLHttpRequest(){
	if(window.ActiveXObject){
	
	     var XmlHttpVersions = new Array("MSXML2.XMLHTTP.6.0", "MSXML2.XMLHTTP.5.0", "MSXML2.XMLHTTP.4.0", "MSXML2.XMLHTTP.3.0", "MSXML2.XMLHTTP", 		"Microsoft.XMLHTTP");
        for (var i = 0; i < XmlHttpVersions.length && !xmlHttp; i++) {
            try {
               xmlHttp = new ActiveXObject(XmlHttpVersions[i]);
            }
            catch (e) {
            }
            
        }
		 
	}
	else if(window.XMLHttpRequest){
		xmlHttp = new XMLHttpRequest();
	}
}
function start(){
	createXMLHttpRequest();
	var url="updateData.php?tokenTall=<?=$tokenTall?>";
	xmlHttp.open("GET",url,true);
	xmlHttp.onreadystatechange = callback;
	xmlHttp.send(null);
	
}
function callback(){
	if(xmlHttp.readyState == 4){
		if(xmlHttp.status == 200 ){
			document.getElementById("showtime").innerHTML = xmlHttp.responseText;
			setTimeout("start()",1);
		$(function() {
		
	$('.progressbar').each(function(){
		var t = $(this),
			dataperc = t.attr('data-perc'),
			barperc = Math.round(dataperc*5.56);
		t.find('.bar').stop().animate({width:barperc}, 0);
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
});	
	         }
	}
}
  
</script>
<?php
  include("db.php");
  $sql="select * from tp_wechawall_api where token='".$tokenTall."'";
  $result=mysql_query($sql,$link);
  $numTotal=0;
  while($q=mysql_fetch_row($result)){
    $numTotal = $numTotal + 1;
    $first=$q[1];
    $second=$q[3];
    $others=$q[2];
    $descr=$q[4];
    $imgurl=$q[5];
  }
  if($imgurl == "") $imgurl="images/siteBackground.jpg";
?>
<body onload="start()" style="font-family: 'Lustria', serif;font-size:100%;background: url(<?=$imgurl?>) repeat left top;margin: 0;
	padding: 0;color: #7d7d7d;text-shadow:0 0px, 1px 1px #000000;">

<header class="wrapperContainer">
	<div class="wrapper">
        <div>
            <div class="logo">
                <h1><a href="">摇 一 摇</a></h1>
                <!--<img width="100%" height="70" src="images/getheadimg.jpg"/>-->
                <div class="logoTriangle"></div>
            </div>
            <nav>
                排         行         榜<label><br>(屏幕显示前10名)</label>
            </nav>
            
        </div>
        
    </div>
</header>

<div class="wrapperContainer">
	<div class="wrapper">
	  
        <div class="welcome"> 
        <!--
             <div class="aword">
		  第一名：<?=$first?><br>
		  第二名：<?=$second?><br>
		  <?=$others?>
        
	    </div>  
	    <div class="explain">
		  活动说明：<br>		 
		  <?=$descr?>
        
	    </div>  
	    -->             
            <div class="description">
                <div class="imgzong">
                  <div class="imgaddress">
                    <img src="images/jinpai.png"/>
                  </div>
                  <div class="imgaddress">
                    <img src="images/yinpai.png"/>
                  </div>
                  <div class="imgaddress">
                    <img src="images/tongpai.png"/>
                  </div>
                  <div class="imgaddress">
                    &nbsp;&nbsp;4
                  </div><div class="imgaddress">
                    &nbsp;&nbsp;5
                  </div><div class="imgaddress">
                    &nbsp;&nbsp;6
                  </div><div class="imgaddress">
                    &nbsp;&nbsp;7
                  </div>
                  <div class="imgaddress">
                    &nbsp;&nbsp;8
                  </div><div class="imgaddress">
                    &nbsp;&nbsp;9
                  </div><div class="imgaddress">
                    &nbsp;10
                  </div>
                </div>
		<div class="voterAera">
		<p><span id="showtime">  
		</span></p>
		</div>
            </div>
            <div class="clearfloat"></div>
        </div>
        <!--end Welcome-->
	</div>
	</div><div class="clearfloat"></div>
	<!--<div class="wrapperContainer">
	    <footer>
        <p>
            Copyright &copy; <a href="http://bestchoice88.com/">蜀乐微信</a>
        </p> 
        <div class="clearfloat"></div>
    </footer>
</div>-->

</body>
</html>