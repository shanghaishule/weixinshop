<?php

@header("Content-type: text/html; charset=utf-8");
 
 include '../config.php';
//以上连接数据库
$ba="select count(*) 
FROM  `weixin_wall` 
LIMIT 0 , 3000000";
$ba=mysql_query($ba,$link) or die(mysql_error());
$p1=mysql_fetch_row($ba);
$all=$p1[0];
$lastid=$_REQUEST['lastid'];
if($lastid==0){$lastid=$all-4;}
$num=$lastid+1;
//$sql1="SELECT * FROM  `msg` order by `mid` desc limit 3";
$sql1="SELECT * 
FROM  `weixin_wall` 
WHERE  `id` ={$num}";
$query1=mysql_query($sql1,$link) or die(mysql_error());

$q=mysql_fetch_row($query1);
$id=$q[0];
$fakeid=$q[2];
$num=$num;
$content=$q[4];
$nickname=$q[5];
$avatar=$q[6];
$ret=$q[7];
if($q<>false){
@$msg=array(data=>array(array("id"=>$id,"fakeid"=>$fakeid,"num"=>$num,"content"=>$content,"nickname"=>$nickname,"avatar"=>$avatar)),ret=>1);
echo $msg=json_encode($msg);
}
else{
@$msg=array(data=>array(),ret=>0);
echo $msg=json_encode($msg);
}


?>