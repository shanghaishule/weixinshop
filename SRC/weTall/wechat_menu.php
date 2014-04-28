<?php
header("Content-type: text/html; charset=utf-8");  
$ACCESS_TOKEN="wyec3i3MwTyWj0nt3CIAJeldOH8TPPtu7wmh-4qPRTcByXOEyZlEZm-mzECs4hO5tS7WlUsi4pUbgprCGe_z5SqrKgQx3uCfCFLjaKc3-IIXDjGqN2XSZbDaHYwv6U0NxYmyOJebtnsTueb6Xv1y7A";

$data = ' {
     "button":[
     {	
          "name":"案例展示",
           "sub_button":[
            {
               "type":"click",
               "name":"车联",
               "key":"cl"
            },
            {
               "type":"click",
               "name":"餐饮",
               "key":"cy"
            },
            {
               "type":"click",
               "name":"婚纱",
               "key":"hs"
            },
            {
               "type":"click",
               "name":"微信商城",
               "key":"gw"
            },
            {
               "type":"click",
               "name":"果蔬",
               "key":"gs"
            }
			]
      },
      {
         "name":"互动模块",
           "sub_button":[
            {
               "type":"click",
               "name":"刮刮乐",
               "key":"ty"
            },
            {
               "type":"click",
               "name":"幸运机",
               "key":"ty"
            },
            {
               "type":"click",
               "name":"抽奖转盘",
               "key":"ty"
            }
			]
      },
      {
           "name":"会员模块",
           "sub_button":[
            {
               "type":"click",
               "name":"微信会员卡",
               "key":"ty"
            },
            {
               "type":"click",
               "name":"微团购",
               "key":"ty"
            },
            {
               "type":"click",
               "name":"微投票",
               "key":"ty"
            }
			]
       }
	   ]
 }';
 $ch = curl_init(); 
 //https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=ACCESS_TOKEN
 curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$ACCESS_TOKEN); 
 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
 curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
 curl_setopt($ch, CURLOPT_AUTOREFERER, 1); 
 curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
 $tmpInfo = curl_exec($ch); 
 if (curl_errno($ch)) {  
 
	echo 'Errno'.curl_error($ch);
 }
 
 	//$arr= json_decode($tmpInfo,true);
	
 	
  
 
 curl_close($ch); 
 var_dump($tmpInfo);  
 
 


?>