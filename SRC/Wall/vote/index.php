<!DOCTYPE html>
<?php 
   if($_GET['tokenTall'] == ""){
   //header("Location: error.php");
   }else{
   
   $_SESSION['tokenTall']=$_GET['tokenTall'];
   $tokenTall=$_SESSION['tokenTall'];

   }
?>

<html> 
<head><title></title> 
<meta http-equiv="content-type" content="text/html;charset=utf8" />
<link rel="stylesheet" href="css/index.css" type="text/css">
<script language='javascript' type='text/javascript'> 
   
        var secs =10; //倒计时的秒数 
	var URL ; 
	function Load(url){ 
		URL =url; 
		for(var i=secs;i>=0;i--) 
		{ 
		window.setTimeout('doUpdate(' + i + ')', (secs-i) * 1000);  
		} 
	} 
	function doUpdate(num) 
	{ 
		var realnum=num ;		
 		document.getElementById("ShowDiv").style.display="";
 		document.getElementById("ShowDiv").style.width="230px";
 		document.getElementById("ShowDiv").style.height="230px";
 		document.getElementById("ShowDiv").style.fontSize="160px";
		if(realnum == 10){
		document.getElementById('ShowDiv').innerHTML = "<br><br><br><br>" + 10 ; 
		}else{
		document.getElementById('ShowDiv').innerHTML = "<br><br><br><br>&nbsp;" + realnum ; 
		}		
		$("#ShowDiv").animate({width:"250px",height:"250px",fontSize:"190px"},400);
		
	       setTimeout("$('#ShowDiv').fadeOut()",500)
	if(num == 0) { window.location=URL; } 
	}
</script> 
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">
</script>
<script>
$(document).ready(function(){
  $("p").click(function(){
    $(this).hide();
     Load("/Wall/vote/resetData.php?tokenTall=<?=$tokenTall?>");
  });
});
</script>
<script>
var xmlHttp2=new XMLHttpRequest();;
function createXMLHttpRequest(){
	if(window.ActiveXObject){
	
	     var XmlHttpVersions = new Array("MSXML2.XMLHTTP.6.0", "MSXML2.XMLHTTP.5.0", "MSXML2.XMLHTTP.4.0", "MSXML2.XMLHTTP.3.0", "MSXML2.XMLHTTP", 		"Microsoft.XMLHTTP");
        for (var i = 0; i < XmlHttpVersions.length && !xmlHttp2; i++) {
            try {
               xmlHttp2 = new ActiveXObject(XmlHttpVersions[i]);
            }
            catch (e) {
            }
            
        }
		 
	}
	else if(window.XMLHttpRequest){
		xmlHttp2 = new XMLHttpRequest();
	}
}
function start(){
	createXMLHttpRequest();
	var url="numpeople.php?tokenTall=<?=$tokenTall?>";
	xmlHttp2.open("GET",url,true);
	xmlHttp2.onreadystatechange = callback;
	xmlHttp2.send(null);
	
}
function callback(){
	if(xmlHttp2.readyState == 4){
		if(xmlHttp2.status == 200 ){
			document.getElementById("totalNum").innerHTML = xmlHttp2.responseText;
			setTimeout("start()",1);
		
	         }
	}
}
  
</script>
</head> 
<body onload="start()"> 
<div class="index">
<div  id="totalNum" ></div> 
<div  id="ShowDiv" ></div> 

<div class="start"><p><br><img width="20%" height="20%" src="images/start2.png"/></p></div>

</div>
<div class="tdcode">
<?php
  include("db.php");
  $sql="select * from tp_wechawall_api where token='".$tokenTall."'";
  $result=mysql_query($sql,$link);
  $numTotal=0;
  while($q=mysql_fetch_row($result)){
    $imgurl=$q[6];
  }

  if($imgurl != ""){

  echo "<img height='200' width='200' src='".$imgurl."'/>";
}?>
</div>
</body> 
</html>