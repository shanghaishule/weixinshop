<?php


    class weixin{

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
    $url = "https://mp.weixin.qq.com/cgi-bin/message?t=message/list&count=20&day=7&token=$token&lang=zh_CN";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_COOKIE, $cookie);    
	curl_setopt($ch, CURLOPT_REFERER, "https://mp.weixin.qq.com/cgi-bin/contactmanage?t=user/index&token=$token&lang=zh_CN&pagesize=10&pageidx=0&type=0&groupid=0");
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1521.3 Safari/537.36");
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
	$output = curl_exec($ch);
    //var_dump($output);全部消息
	curl_close($ch);
    $u_msg=substr($output,(strpos($output,"{\"msg_item\":")+13));
    $abc=substr($u_msg,(strpos($u_msg,"{\"msg_item\":[\":")+1));
    $u=stripos($abc,"}");
    $aaaa=substr($abc,0,$u);
    $aaaa=preg_replace('/["]+/i','',$aaaa);
    $a=array();
    foreach (explode(',',$aaaa) as $aaaa){
    list($k,$v)=explode(':',$aaaa);
    $a[$k]=$v;
}
	return $a;
	}



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
  function setImgtoFold($jpg,$filename){
   $file = fopen($filename,"w+");//打开文件准备写入
   fwrite($file,$jpg);//写入
   fclose($file);//关闭
  }

}
?>