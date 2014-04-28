 <?php
	        include("db.php");
		$token=$_GET['token'];//"oe6eXt8XE4HIaBY0GZOhx6wYiQ8I";//
	        $c_name=$_GET['c_name'];//"3";//
	        $resInt=$c_name;
	        $flag="Y";
	        $tokenTall=$_GET['tokenTall'];

	        if($resInt != ""){
		        $sql="select * from tp_weixin_vote where token='".$token."' and tokenTall='".$tokenTall."'";
		        $resultGame=mysql_query($sql,$link);
		        while($row=mysql_fetch_row($resultGame)){
			        $resInt = $row[2] + $resInt;
			        $flag=$row[3];
		        }
		        if($flag == "X"){				
				if($resInt>=500){
				$resInt=500;
				}
				$sql1="UPDATE tp_weixin_vote SET res=".$resInt." where token='".$token."' and tokenTall='".$tokenTall."'";				
				$query1=mysql_query($sql1,$link) or die(mysql_error());
				if($resInt==500){
				$sql2="UPDATE tp_weixin_vote SET gameOverFlag='Y' where tokenTall='".$tokenTall."'";
				$query2=mysql_query($sql2,$link) or die(mysql_error());
				}
				$showtime=$resInt;
				echo $showtime;
			}
			else {
				$showtime= "游戏没有开始";
				echo $showtime;
			}
		}

?>