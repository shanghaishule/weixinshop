<?php 
/*第一步 微信公众平台登陆*/

/*配置开始*/
header("content-Type: text/html; charset=utf-8");
require_once("./weixin.php");

$wxname="shulewh@163.com"; 
$pwd="123456di";
$siurl="http://bestchoice88.com/index.php/api/gqovxs1388298795";//注意com后面不能带有斜线 上传后的地址
$sixian=new weixin();
$username = urlencode($wxname);
$pwd = md5($pwd);
$array=$sixian->login($username,$pwd);
$cookie=$array[cookie];
$cookies=$array[cookies];
$token=$array[token];
if($token==""){
  echo "密码不正确";
}else{

  
  $nickName=$sixian->getmessage($token,$cookie,$cookies);
  echo $nickName["nick_name"];
  $fakeid=$nickName["fakeid"];
   $img=$sixian->gethead($token,$fakeid,$cookie);
   $filename ="{$fakeid}.jpg";//要生成的图片名字
$jpg = $img;//得到post过来的二进制原始数据
$file = fopen("img/".$filename,"w");//打开文件准备写入
fwrite($file,$jpg);//写入
fclose($file);//关闭
$imgurl ="http://www.bestchoice88.com/Wall/img/".$filename;
   echo "<img src='{$imgurl}' width='50'>";
   echo $imgurl;
}
?>