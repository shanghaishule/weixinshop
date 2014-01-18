<?php

@header("Content-type: text/html; charset=utf-8");
 
include '../config.php';

$ba="select count(*) 
FROM  `allsql` WHERE  `ret` =1
LIMIT 0 , 30000";
$ba=mysql_query($ba,$link) or die(mysql_error());
$p1=mysql_fetch_row($ba);
//var_dump($p1);
$all=$p1[0];
$lastid=$_REQUEST['lastid'];
if($lastid==0){$lastid=$all-4;}else{}
$num=$lastid+1;
//$num=$all-4;
//$sql1="SELECT * FROM  `msg` order by `mid` desc limit 3";
$sql1="SELECT * 
FROM  `allsql` 
WHERE  `ret` =1 
LIMIT $num,$all";
$query1=mysql_query($sql1,$link) or die(mysql_error());

$q=mysql_fetch_row($query1);
$id=$q[0];
$fakeid=$q[2];
$num=$num;
$content=$q[4];
$nickname=$q[5];
$avatar=$q[6];
$ret=$q[7];
if($q[3]){
@$msg=array(data=>array(array("id"=>$id,"fakeid"=>$fakeid,"num"=>$num,"content"=>$content,"nickname"=>$nickname,"avatar"=>$avatar)),ret=>1);
echo $msg=json_encode($msg);
}
if(!$q[3]){
@$msg=array(data=>array(),ret=>0);
echo $msg=json_encode($msg);
}


?>