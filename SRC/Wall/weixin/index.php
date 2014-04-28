<?php
header("content-Type: text/html; charset=utf-8");
require(dirname(__FILE__) . "/wechat.php");
//require("../../Lanrain/Lib/ORG/Wechat.class.php");
include("db.php");
define("MOREN", "title|欢迎关注{$weixin_name}#pic|@title|1.\t上墙#pic|#url|{$weixin_wxq}@title|2.\t投票#pic|#url|{$weixin_vote}@title|回复对应的数字进入对应的模块#pic|@title|回复【取消】或【退出】返回主菜单");//丢包后默认回复
define("FLAG", "@");//星标标识，默认为 @,用户对话里包含此标识则设置为星标，用于留言
//配置结束

$w = new Wechat(TOKEN, DEBUG);
if (isset($_GET['echostr'])) 
{
    $w->valid();
    exit();
}
//回复用户
$w->reply("reply_cb");
exit();

function reply_cb($request, $w)//消息回复主函数
{
    $to = $request['ToUserName'];
    $from = $request['FromUserName'];
	$time = $w->get_creattime();
    if ($w->get_msg_type() == "location") //发送位置接口
	{
		$lacation = "x@".(string)$request['Location_X']."@".(string)$request['Location_Y'];
		$lacation = urlencode(str_replace('\.','\\\.',$lacation));
		$lacation = urldecode(xiaojo($lacation,$from,$to));
		return  $lacation;
    }
    else if ($w->get_msg_type() == "image")//返回图片地址
	{ 
		$PicUrl = $request['PicUrl'];
		$pic = urldecode(xiaojo("&".$PicUrl,$from,$to));
		//$w->set_funcflag();
		return $pic;
    }
	else if ($w->get_msg_type() == "voice") //用户发语音时回复语音或音乐,请在此配置默认语音回复
	{
    
		return array(
			"title" =>  "你好",
			"description" =>  "亲爱的主人",           
			"murl" =>  "http://weixen-file.stor.sinaapp.com/b/xiaojo.mp3",//语音地址，建议自定义一个语音
			"hqurl" =>  "http://weixen-file.stor.sinaapp.com/b/xiaojo.mp3",
		);
    }
	else if ($w->get_msg_type() == "event")//事件检测
	{ 
		if ($w->get_event_type() == "subscribe")//首次关注回复请在后台设置关键词为 "subscribe" 的图文、文本或语音规则
		{
             $sql_flag="replace`weixin_flag` (`openid`,`flag`,`vote`,`nickname`) VALUES ('$from','-1','1','$nicheng')";
        		mysql_query($sql_flag);
          include("sub.php");	
        
          $sisi= "title|【{$nickname}】欢迎关注我们的平台#pic|http://f.hiphotos.baidu.com/pic/w%3D230/sign=a34574e90d3387449cc5287f610ed937/30adcbef76094b36f9ce3154a2cc7cd98d109d2e.jpg@title|1.\t上墙#pic|@title|2.\t投票#pic|@title|回复对应的数字进入对应的模块#pic|@title|回复【取消】或【退出】返回主菜单";//开场百
  $sub= media(urldecode($sisi));
  if($nickname==""){$sub="欢迎关注，回复1进入上墙模式";}
          return $sub;
          //include './baeinsert.php';//可以在这里进行保存的
		}
		elseif($w->get_event_type() == "unsubscribe")
		{
            
           $sql_flag="replace`weixin_flag` (`openid`,`flag`,`vote`,`nickname`) VALUES ('$from','-1','1','$nicheng')";
        		mysql_query($sql_flag);
			$unsub = media(urldecode( MOREN));
			return $unsub;
		}
		elseif($w->get_event_type() == "click")
		{
			$menukey = $w->get_event_key();
			$menu = xiaojo($menukey,$from,$to);
			return $menu;
		}
		else
		{
			$menukey = $w->get_event_key();
			return $menukey;
		}
    }
    $content = trim($request['Content']);
   	$firsttime = $content;
	if ($content !== "") //发纯文本
    {
     
        //$w->set_funcflag(); //如果有必要的话，加星标，方便在web处理
		$content = $w->biaoqing($content); //表情处理
		if(strstr($content,FLAG))//如果有星标的标记则设为星标(用于留言)
		{ 
			$w->set_funcflag();
		}
        /*
        //执行判断，1进入上墙系统，2是投票
        //
        */
        $sql_check="SELECT * FROM `weixin_flag` where `openid` = '$from'";
        $query_check=mysql_query($sql_check);
        $check = mysql_fetch_row($query_check);
        if(!$check[0]){
            	$sql_flag="replace`weixin_flag` (`openid`,`flag`,`vote`,`nickname`) VALUES ('$from','-1','1','$nicheng')";
        		mysql_query($sql_flag);
            
        }
        if($content=='取消' || $content=='退出'){
                $reply = "title|欢迎关注{$weixin_name}#pic|@title|1.\t上墙#pic|@title|2.\t投票#pic|@title|回复对应的数字进入对应的模块#pic|@title|回复【取消】或【退出】返回主菜单";

                $sql_flag="UPDATE  `weixin_flag` SET `flag` = '-1'  WHERE  `openid` =  '{$from}';";
        		mysql_query($sql_flag);
            }
        if($check[1]==1){
            
            
        	if($content=='取消' || $content=='退出'){
                $reply = "title|欢迎关注{$weixin_name}#pic|@title|1.\t上墙#pic|@title|2.\t投票#pic|@title|回复对应的数字进入对应的模块#pic|@title|回复【取消】或【退出】返回主菜单";

                $sql_flag="UPDATE  `weixin_flag` SET `flag` = '-1'  WHERE  `openid` =  '{$from}';";
        		mysql_query($sql_flag);
            }else{
				
              file_get_contents("http://www.bestchoice88.com/Wall/1.php");//该地址为1.php上传后的地址
                $sql_name="UPDATE  `weixin_flag` SET `nickname` = '$nicheng'  WHERE  `openid` =  '{$from}';";
        		mysql_query($sql_name);    
 
   				
                $reply = "title|发送成功#pic|#url|{$weixin_wxq}@title|你已经成功发送，等待审核通过即可上墙了\n\nPs：点击查看大屏幕#url|{$weixin_wxq}@title|回复【取消】或【退出】返回主菜单";	
                }
            
        }
        
			
            
      
        if($check[1]=='2' || $check[1]=='4'){
            $sql_vote_check="SELECT * FROM `weixin_flag` where `openid` = '$from'";
        		$query_vote_check=mysql_query($sql_vote_check);
                $vote_check = mysql_fetch_row($query_vote_check);
                $vote_check=$vote_check[2];
                
                $sql_vote="SELECT * FROM `weixin_vote` ";
        		$query_vote=mysql_query($sql_vote);
            
            
            
			if($content=='取消' || $content=='退出'){
                $reply = "title|欢迎关注{$weixin_name}#pic|@title|1.\t上墙#pic|@title|2.\t投票#pic|@title|回复对应的数字进入对应的模块#pic|@title|回复【取消】或【退出】返回主菜单";

                $sql_flag="UPDATE  `weixin_flag` SET `flag` = '-1'  WHERE  `openid` =  '{$from}';";
        		mysql_query($sql_flag);
            }
                
        		
                
                elseif($content=='投票'&&$vote_check=='1'){
                    while($vote = mysql_fetch_row($query_vote)){
                    $name=$vote[1];
                    $id=$vote[0];
                        $idout.="【".$id."】".$name."\n";
                }
                    $reply = "title|投票系统\n每人只能投一票#pic|@title|输入选手名字面的序号进行投票\n\n".$idout."@title|回复【取消】或【退出】返回主菜单";
                }
                    
                elseif($vote_check!=='9' && ($content=='1' || $content=='2' ||$content=='3' ||$content=='4' ||$content=='5' ||$content=='6' ||$content=='7' ||$content=='8' ||$content=='9' ||$content=='10' ||$content=='11' ||$content=='12' ||$content=='13' ||$content=='14' ||$content=='15')){
                    $sql_tou="UPDATE  `weixin_vote` SET `res` = `res`+1  WHERE  `id` =  '$content';";
        			mysql_query($sql_tou);
                       $sql_vote_yes="UPDATE  `weixin_flag` SET `vote` = '9'  WHERE  `openid` =  '{$from}';";
                		mysql_query($sql_vote_yes);
                    $sql_vote="SELECT * FROM `weixin_vote` WHERE  `id` =  '$content';";
                    $query_vote=mysql_query($sql_vote);
                    $vote = mysql_fetch_row($query_vote);
                    $name=$vote[1];
                    $res=$vote[2];
                    $reply = "title|投票成功#pic|#url|{$weixin_vote}@title|你成功地把宝贵的一票投给了\n\n【{$content}】号选手【{$name}】\n\nTa目前有【{$res}】票\n\n点击得票查看详情#url|{$weixin_vote}@title|发送【结果】查看最新数据#url|{$weixin_vote}@title|回复【取消】或【退出】返回主菜单";
                }
                 
            
            	 elseif($vote_check=='9' && ($content=='1' || $content=='2' ||$content=='3' ||$content=='4' ||$content=='5' ||$content=='6' ||$content=='7' ||$content=='8' ||$content=='9' ||$content=='10' ||$content=='11' ||$content=='12' ||$content=='13' ||$content=='14' ||$content=='15')){
                     $sql_vote="SELECT * FROM `weixin_vote` WHERE  `id` =  '$content';";
                    $query_vote=mysql_query($sql_vote);
                    $vote = mysql_fetch_row($query_vote);
                    $name=$vote[1];
                    $res=$vote[2];
                     $reply = "title|投票失败\n每人只能投一票#pic|#url|{$weixin_vote}@title|你已经投了1票给\n\n【{$content}】号选手【{$name}】\n\nTa目前有【{$res}】票\n\n点击查看得票详情#url|{$weixin_vote}@title|发送【结果】查看最新数据#url|{$weixin_vote}@title|回复【取消】或【退出】返回主菜单";
                }
                    
                elseif(($content=='结果' && $vote_check=='9') ||($content=='投票'&& $vote_check=='9')){
               
                while($vote = mysql_fetch_row($query_vote)){
                    $name=$vote[1];
                    $res=$vote[2];
               	$resout.=$name."------>    【".$res."】票\n";
                }
        
        	$reply = "title|你已经投过票了\n每人只能投一票#pic|#url|{$weixin_vote}@title|投票结果\n\n".$resout."\n\n点击得票查看详情#url|{$weixin_vote}@title|回复【取消】或【退出】返回主菜单";
                }
            
            else{
            
            
             $reply = "title|投票模式#pic|@title|你已经进入了投票模式\n\n发送【投票】进行投票，每人一票\n\n点击查看得票详情@title|回复【取消】或【退出】返回主菜单";
            
            }
    
        }
        
        
        if(($check[1]!=='1') &&  ($check[1]!=='2')){
            if($content=="1"){
                $sql_check="UPDATE  `weixin_flag` SET `flag` = '1'  WHERE  `openid` =  '{$from}';";
        		mysql_query($sql_check);
              
				$reply = "title|上墙模式#pic|#url|{$weixin_wxq}@title|你已经进入了上墙模式\n\n直接发送内容就可以有机会上墙了#url|{$weixin_wxq}@title|回复【取消】或【退出】返回主菜单#url|{$weixin_wxq}";
                }
            else if($content=="2"){
                $sql_check="UPDATE  `weixin_flag` SET `flag` = '2'  WHERE  `openid` =  '{$from}';";
        		mysql_query($sql_check);
              
				$reply = "title|投票模式#pic|#url|{$weixin_vote}@title|你已经进入了投票模式\n\n发送【投票】进行投票，每人一票@title|回复【取消】或【退出】返回主菜单";
            }else{
                $reply = MOREN ;
            }
                
                
        }
        
        
        
        /*
        
		if($reply=="")
		{
			$reply = MOREN ;
		}*/
        $reply = media(urldecode( $reply));
		return  $reply;

    }
	else
	{
		return  MOREN;
	}
    
}






?>