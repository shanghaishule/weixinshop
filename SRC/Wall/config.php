<?php
@header("Content-type: text/html; charset=utf-8");
 
define("TOKEN", "gqovxs1388298795"); //配置API
$url='http://www.bestchoice88.com/Wall/1.php';//这个填写你的1.php这个文件的地址
$weixin_name='蜀乐订餐';//这里可以配置你的微信公众账号名字，你也可以改下面的源码
$weixin_wxq='http://www.bestchoice88.com/Wall/wall/';//这里填写你的微信墙的地址
$huati='#说#';//话题内容 如：#我爱你#
$wxname='shulewh@163.com'; 
$pwd="123456di";
$siurl='http://bestchoice88.com/index.php/api/gqovxs1388298795';//注意com后面不能带有斜线 上传后的地址
		/*链接数据库*/
	$dbname = 'bestchoi_wall';//这里填写你BAE数据库的名称
 
       /*从环境变量里取出数据库连接需要的参数*/
       $host = 'localhost';
       $port ='3306';
       $user = 'bestchoi_shule';
       $pwd = 'shule_123';
 
       /*接着调用mysql_connect()连接服务器*/
        $link = @mysql_connect("{$host}:{$port}",$user,$pwd,true);
       if(!$link) {
                   die("Connect Server Failed: " . mysql_error($link));
                  }
       /*连接成功后立即调用mysql_select_db()选中需要连接的数据库*/
       if(!mysql_select_db($dbname,$link)) {
                   die("Select Database Failed: " . mysql_error($link));
                  }
		mysql_query("SET NAMES UTF8");
//以上连接数据库
?>