<?php

/*第一步 微信公众平台登陆*/

/*配置开始*/
header("content-Type: text/html; charset=utf-8");
//require_once("../file.php");

include'../config.php';
$siurl=$url."weixin";
/*配置结束*/


/*
$wxname=$_REQUEST['uname'];
$pwd=$_REQUEST['pwd'];*/

//echo $wxname."<br/>".$pwd."<br/>".$food;
    $username = urlencode($wxname);
    $pwd = md5($pwd);
$array=login($username,$pwd);
$cookie=$array[cookie];
$cookies=$array[cookies];
$token=$array[token];
//var_dump($cookie);
/*第二步 微信公众平台登陆函数获取
cookie cookies token
以数组方式输出*/
//var_dump($token);
if($token==""){
  echo "密码不正确";
}else{

include './sub1.php';
  
}


   	function login($username,$pwd)
	{
		$url = "http://mp.weixin.qq.com/cgi-bin/login?lang=zh_CN";
		$post_data = "username=".$username."&pwd=".$pwd."&imgcode=&f=json";
		$cookie = "pgv_pvid=5841388204";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		curl_setopt($ch, CURLOPT_COOKIE, $cookie);    
		curl_setopt($ch, CURLOPT_REFERER, "	http://mp.weixin.qq.com/cgi-bin/loginpage?t=wxm2-login&lang=zh_CN");
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1521.3 Safari/537.36");
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
		$output = curl_exec($ch);
		curl_close($ch);
        list($header, $body) = explode("\r\n\r\n", $output);  
	    preg_match_all("/set\-cookie:([^\r\n]*)/i", $header, $matches);
 	    $cookie = $matches[1][0].$matches[1][1].$matches[1][2];
		$cookie = str_replace(array('Path=/',' ; Secure; HttpOnly','=;'),array('','','='), $cookie);
		$cookie = 'pgv_pvid=5841388204;'.$cookie;
     	$data = json_decode($body,true);
		$result = explode('token=',$data[ErrMsg]);
        $array=array(
       'cookie' => $cookie,
	   'cookies' => $output,
        'token' => $result[1],
      );
           return $array;
}
function getmessage($token,$cookie,$cookies)
	{    
    $url = "https://mp.weixin.qq.com/cgi-bin/contactmanage?t=user/index&pagesize=10&pageidx=0&type=0&groupid=0&token=$token&lang=zh_CN";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_COOKIE, $cookie);    
	curl_setopt($ch, CURLOPT_REFERER, "https://mp.weixin.qq.com/cgi-bin/home?t=home/index&lang=zh_CN&token=$token");
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1521.3 Safari/537.36");
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
	$output = curl_exec($ch);
      // var_dump($output);//全部消息
	
      //var_dump($output);//全部消息
	curl_close($ch);
      /*分组截取*/
      $bbb= (strpos($output,"[{"));
      $ccc= (strpos($output,"}]"));
      $aaa= substr($output,$bbb+1,$ccc-1); 
      //var_dump($aaa);
      
      /*分组结束*/
      
     
$b= (strpos($output,"contacts"));
$c= (strpos($output,"contacts"));
$a= substr($output,$b+1,$c-1); 
      $b= (strpos($a,'['));
$c= (strpos($a,']'));
$a= substr($a,$b+1,$c-1); 
      $deng=$a;
       $deng= preg_replace('/[\{]+/i','',$deng);
       $deng= preg_replace('/[\}]+/i','',$deng);
       $deng= preg_replace('/[\"]+/i','',$deng);
       $deng= preg_replace('/[\nick_name]+/i','',$deng);
  $deng= preg_replace('/[\rr:groupd:]+/i','',$deng);
      $deng="103,".$deng;
       $deng=str_replace(',','=',$deng);
       
      $q=explode('==',$deng,10000);
      $q=$q[0];
      //var_dump($q);
       return $q;
    
	}
//var_dump(getmessage($token,$cookie,$cookies));//测试是否成功抓取最新一条消息



/*第四步 微信公众平台获取用户详细信息*/
function sixi($token,$fakeid,$cookie,$cookies)
	{
     $url = "https://mp.weixin.qq.com/cgi-bin/getcontactinfo";
	$post= "token=$token&lang=zh_CN&t=ajax-getcontactinfo&fakeid=$fakeid";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER,$cookies);  //设置头信息的地方  
    curl_setopt($ch, CURLOPT_HEADER, 0);   
    curl_setopt($ch, CURLOPT_COOKIE, $cookie); 
	curl_setopt($ch, CURLOPT_REFERER, "https://mp.weixin.qq.com/cgi-bin/message?t=message/list&count=20&day=7&token=$token&lang=zh_CN");
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);	
	$output = curl_exec($ch);
   	curl_close($ch);
	return $output;
	}
//var_dump(sixi($token,$fakeid,$cookie,$cookies));//测试是否成功抓取到用户的资料
//var_dump($fakeid);


/*第五步 微信公众平台获取用户头像*/
function gethead($token,$fakeid,$cookie)
	{  
      
      
		$url = "http://mp.weixin.qq.com/cgi-bin/getheadimg?token=".$token."&fakeid=".$fakeid;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_COOKIE, $cookie);    
		curl_setopt($ch, CURLOPT_REFERER, "http://mp.weixin.qq.com/cgi-bin/getmessage?t=wxm-message&token=".$token."&lang=zh_CN&count=50");
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1521.3 Safari/537.36");
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
		$output = curl_exec($ch);
      curl_close($ch);
      // var_dump($output);
      $img=$output;
     
      // $output=$imgurl;
      
      //echo "<img src='{$img}' width='50'>";
      return $img;//storge中的头像地址
	}
//var_dump(gethead($token,$fakeid,$cookie));
/*公众平台账户信息采集*/
function getme($token,$cookie,$cookies)
	{    
    $url = "https://mp.weixin.qq.com/cgi-bin/userinfopage?t=wxm-setting&token=$token&lang=zh_CN";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_COOKIE, $cookie);    
	curl_setopt($ch, CURLOPT_REFERER, "https://mp.weixin.qq.com/cgi-bin/home?t=home/index&lang=zh_CN&token=$token");
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1521.3 Safari/537.36");
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
	$output = curl_exec($ch);
    var_dump($output);//全部消息
	curl_close($ch);
    
}
//var_dump(getme($token,$cookie,$cookies));
/*第六步 微信公众平台获取用户语音*/
function getvoice($token,$messageid,$cookie)
	{  
      //$url = "https://mp.weixin.qq.com/cgi-bin/getvoicedata?msgid=".$messageid."&fileid=&token=".$token."&lang=zh_CN";
      
      $url = "https://mp.weixin.qq.com/cgi-bin/getvoicedata";
	$post= "msgid=$messageid&fileid=&token=$token&lang=zh_CN";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_COOKIE, $cookie);    
      curl_setopt($ch, CURLOPT_REFERER, "http://mp.weixin.qq.com/cgi-bin/getvoicedate?t=wxm-message&token=".$token."&lang=zh_CN&count=50");
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:18.0) Gecko/20100101 Firefox/18.0");
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);	
	$output = curl_exec($ch);
   	curl_close($ch);
	return $output;
	}
/*第7步 微信公众平台获取用户video*/
function getvideo($token,$messageid,$cookie)
	{  
      //$url = "https://mp.weixin.qq.com/cgi-bin/cgi-bin/getvideodata?msgid=100001740&fileid=&token=1351856158
      
      $url = "https://mp.weixin.qq.com/cgi-bin/getvideodata";
	$post= "msgid=$messageid&fileid=&token=$token";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_COOKIE, $cookie);    
      curl_setopt($ch, CURLOPT_REFERER, "http://mp.weixin.qq.com/cgi-bin/getimgdata?token=$token&msgid=$messageid&mode=small&source=&fileId=");
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:18.0) Gecko/20100101 Firefox/18.0");
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);	
	$output = curl_exec($ch);
   	curl_close($ch);
	return $output;
	}
	
	
/*公众平台模拟发送消息*/
//$txt="http://13.foxconn20130410.duapp.com/?fakeid=$fakeid";
$txt=urldecode($_REQUEST['send']);
$sendid=urldecode($_REQUEST['fakeid']);
function send($txt,$sendid,$cookie,$cookies,$token){
    //发送消息给指定人
	

	
	
    $url ="https://mp.weixin.qq.com/cgi-bin/singlesend?t=ajax-response&lang=zh_CN"; 
	$post="type=1&content=$txt&error=false&imgcode=&tofakeid=$sendid&token=$token&ajax=1";
    	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, $cookies);  //设置头信息的地方  
curl_setopt($ch, CURLOPT_HEADER, 0);   
	
    curl_setopt($ch, CURLOPT_COOKIE, $cookie); 

	curl_setopt($ch, CURLOPT_REFERER, "https://mp.weixin.qq.com/cgi-bin/singlemsgpage?fromfakeid=$sendid&count=20&t=wxm-singlechat&token=$token&token=$token&lang=zh_CN");
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:18.0) Gecko/20100101 Firefox/18.0");
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
	
	  curl_setopt($ch, CURLOPT_POST, 1);
	 curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	
	$output = curl_exec($ch);
			//curl_close($output); 
			//$output =array();
			//return $output;
	curl_close($ch);
	return $output;
  
	}
//var_dump(send($txt,$sendid,$cookie,$cookies,$token));
/*新增时间戳*/
function datetime($token,$cookie,$cookies)
	{    
    $url = "https://mp.weixin.qq.com/cgi-bin/message?t=message/list&count=20&day=7&token=$token&lang=zh_CN";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_COOKIE, $cookie);    
	curl_setopt($ch, CURLOPT_REFERER, "https://mp.weixin.qq.com/cgi-bin/contactmanage?t=user/index&token=$token&lang=zh_CN&pagesize=10&pageidx=0&type=0&groupid=0");
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1521.3 Safari/537.36");
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
	$output = curl_exec($ch);
      // var_dump($output);//全部消息
	curl_close($ch);
    $u_msg=substr($output,(strpos($output,"{\"msg_item\":")+13));
    $abc=substr($u_msg,(strpos($u_msg,"{\"msg_item\":[\":")+1));
    $u=stripos($abc,"}");
    $aaaa=substr($abc,0,$u);
      // var_dump($aaaa);
      $u_m=str_replace(',','&',$aaaa);
      $u_m=str_replace("\"","",$u_m);
      $u_m=str_replace(":","=",$u_m);
$u_m="?$u_m";
      //$u_m=substr($u_m,(strpos($u_m,"?")+1));
      parse_str($u_m); 
      //var_dump(1);
      $date=$date_time;
      return $date;
    }

//var_dump(datetime($token,$cookie,$cookies));
?>