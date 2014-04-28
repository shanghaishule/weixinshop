<?php
  include("db.php");
  $_SESSION['tokenTall']=$_GET['tokenTall'];
  if($_SESSION['tokenTall'] == ""){
        echo "系统忙，请稍等...";
        echo $_SESSION['tokenTall'];
  }else{
          $token=$_SESSION['tokenTall'];	
	  $sql1="UPDATE tp_weixin_vote SET res=0, gameOverFlag='X' where tokenTall='".$token."'";
	  if(mysql_query($sql1,$link)){
	   header("Location: /Wall/vote/start.php?tokenTall=$token");
	  }else{
	   echo "系统故障！";
	  }
  }			
?>