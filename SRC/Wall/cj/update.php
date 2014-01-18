<?php
@header("Content-type: text/html; charset=utf-8");
 
include '../config.php';
 $query = mysql_query("SELECT * 
FROM  `weixin_wall` 
WHERE  `status` =1
LIMIT 0 , 100000"); 
echo "<a href='./index.php'>进入抽奖</a><br/>";
//var_dump($row);
        while($row=mysql_fetch_array($query)){ 
       
          echo $row[id]; 
          $id=$row[id];
          $imgurl= urldecode($row[avatar]);
        
          $name=$row[nickname];
          
          echo "{$id}<img width='100' height='100' src='{$imgurl}'>{$name}<br>";
          //weixin_wall` SET  `status` =  '0' WHERE  `weixin_wall`.`id` =5;
           $sqll = "update weixin_wall set status=0 where id=$id"; 
         $queryy = mysql_query($sqll);
        }