<?php
// 本类由系统自动生成，仅供测试用途
header("content-type:text/html;charset=utf-8");
class WeixinAction extends Action {
	
	

	public function wenben($fromUsername, $toUsername, $time, $contentStr)
	{
		//////文本链接的处理/ ///
		$str=$contentStr;
	    $reg = '/\shref=[\'\"]([^\'"]*)[\'"]/i';
		preg_match_all($reg , $str , $out_ary);//正则：得到href的地址
		$src_ary = $out_ary[1];
       if(!empty($src_ary))//存在
      {
      	$comment=$src_ary[0];
      	if(stristr($comment,$_SERVER['SERVER_NAME']))
      	{
      		if(stristr($comment,"?"))
      		{
      			$links=$comment."&key=".$fromUsername;
      			$contentStr= str_replace($comment,$links,$str);
      		}else
      		{
      			$links=$comment."?key=".$fromUsername;
      			$contentStr= str_replace($comment,$links,$str);
      		}
      	}
      }
		
      	//////文本链接的处理 END////
      
		     $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
              		$msgType = "text";
                	//$contentStr =$contentStr;
                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
            	echo $resultStr;
	}
	public function tuwen($textTpl,$fromUsername, $toUsername, $time,$count)
	{
              		$msgType = "news";
                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType,$count);
            	echo $resultStr;
	}
	
	public function index(){
		import('Think.ORG.Weixin');// 导入微信类

		$wechat = new Weixin();
		$wechat->valid();
		//$wechat->responseMsg();

		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		if (!empty($postStr)){
			$key_word=M('keyword');

			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			$fromUsername = trim($postObj->FromUserName);//发送方帐号（一个OpenID）
			$toUsername = $postObj->ToUserName;//开发者微信号 
			$keyword = trim($postObj->Content);//用户发来的信息
			$RX_TYPE = trim($postObj->MsgType);//类型
			$EventKey=trim($postObj->EventKey);//事件KEY值
			$Event=$postObj->Event;//事件类型
			$time = time();
			
			if($fromUsername!='')
			{
			 	$user= M('user')->field('id,username')->where("username='".$fromUsername."'")->find();
			 	if($user)
			 	{
			 	
			 	}else 
			 	{
			 		$date=time();
        			$data['username']=$fromUsername;//用户名
        			$data['reg_time']=$date;
        			$data['last_time']=$date;
        			$userid= M('user')->add($data);
			 	}
			}
			
			
			
			if($RX_TYPE=='event')
			{
			
			//**自定义点击事件**//
			if($Event=='CLICK')
			{

				if($EventKey!='')
				{
					 $where=array('key'=>$EventKey);
					 $custom_key= M('custom_menu')->where($where)->find();
					$key_list= $key_word->where("kyword='".$custom_key['keyword']."'")->find();
					//$key_list= $key_word->where("kyword='".$EventKey."'")->find();
					if(is_array($key_list))
					{
						if($key_list['type']==1)//文本
						{
							$this->wenben($fromUsername, $toUsername, $time,$key_list['kecontent']);
						}else //图文
						{
							$titles                   = unserialize($key_list['titles']);
							$imageinfo                = unserialize($key_list['imageinfo']);
							$linkinfo                 = unserialize($key_list['linkinfo']);

							$textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							 <ArticleCount>%s</ArticleCount> 
                            <Articles>";
							for($i=0;$i<count($titles);$i++)
							{
								if(stristr($linkinfo[$i],$_SERVER['SERVER_NAME']))
								{
									if(stristr($linkinfo[$i],"?"))
									{
										$links=$linkinfo[$i]."&key=".$fromUsername;
									}else
									{
										$links=$linkinfo[$i]."?key=".$fromUsername;
									}
								}else{
									$links=$linkinfo[$i];
								}
								
								if(stristr($imageinfo[$i],$_SERVER['SERVER_NAME']))
								{
								$images=$imageinfo[$i];
								}else
								{
								$images="http://".$_SERVER['SERVER_NAME'].'/'.$imageinfo[$i];
								}
								
								
								$textTpl.= " <item>
                           <Title><![CDATA[".$titles[$i]."]]></Title> 
                           <Description><![CDATA[".$titles[$i]."]]></Description>
                          <PicUrl><![CDATA[".$images."]]></PicUrl>
                           <Url><![CDATA[".$links."]]></Url>
                           </item>";
						 /*  $textTpl.= " <item>
                           <Title><![CDATA[".$titles[$i]."]]></Title> 
                           <Description><![CDATA[".$titles[$i]."]]></Description>
                          <PicUrl><![CDATA[http://".$_SERVER['SERVER_NAME'].'/'.$imageinfo[$i]."]]></PicUrl>
                           <Url><![CDATA[".$links."]]></Url>
                           </item>";*/
							}
							$textTpl.= "</Articles>
                           <FuncFlag>0</FuncFlag>
                           </xml> 
							";
							$this->tuwen($textTpl,$fromUsername, $toUsername, $time,count($titles));
						}

					}

				}
			}
				
				if($Event=='subscribe')
				{
					$key_list= $key_word->where("isfollow=1")->find();
					if(is_array($key_list))//关注时回复
					{
						if($key_list['type']==1)//文本
						{
							$this->wenben($fromUsername, $toUsername, $time,$key_list['kecontent']);
						}else //图文
						{

							$titles                   = unserialize($key_list['titles']);
							$imageinfo                = unserialize($key_list['imageinfo']);
							$linkinfo                 = unserialize($key_list['linkinfo']);

							$textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							 <ArticleCount>%s</ArticleCount> 
                            <Articles>";
							for($i=0;$i<count($titles);$i++)
							{
								if(stristr($linkinfo[$i],$_SERVER['SERVER_NAME']))
								{
									if(stristr($linkinfo[$i],"?"))
									{
										$links=$linkinfo[$i]."&key=".$fromUsername;
									}else
									{
										$links=$linkinfo[$i]."?key=".$fromUsername;
									}
								}else{
									$links=$linkinfo[$i];
								}
                            if(stristr($imageinfo[$i],$_SERVER['SERVER_NAME']))
								{
								$images=$imageinfo[$i];
								}else
								{
								$images="http://".$_SERVER['SERVER_NAME'].'/'.$imageinfo[$i];
								}
								
								
								$textTpl.= " <item>
                           <Title><![CDATA[".$titles[$i]."]]></Title> 
                           <Description><![CDATA[".$titles[$i]."]]></Description>
                          <PicUrl><![CDATA[".$images."]]></PicUrl>
                           <Url><![CDATA[".$links."]]></Url>
                           </item>";
							}
							$textTpl.= "</Articles>
                           <FuncFlag>0</FuncFlag>
                           </xml> 
							";
							$this->tuwen($textTpl,$fromUsername, $toUsername, $time,count($titles));
						}
					}
				}
			}
				
			if(!empty($keyword))
			{
				$key_list= $key_word->where("kyword='".$keyword."'")->find();
				if(is_array($key_list))
				{
					if($key_list['type']==1)//文本
					{
						$this->wenben($fromUsername, $toUsername, $time,$key_list['kecontent']);
					}else //图文
					{
							$titles                   = unserialize($key_list['titles']);
							$imageinfo                = unserialize($key_list['imageinfo']);
							$linkinfo                 = unserialize($key_list['linkinfo']);
						
                    $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							 <ArticleCount>%s</ArticleCount> 
                            <Articles>";
                    for($i=0;$i<count($titles);$i++)
                    {
                    	if(stristr($linkinfo[$i],$_SERVER['SERVER_NAME']))
                    	{
                    		if(stristr($linkinfo[$i],"?"))
                    		{
                    			$links=$linkinfo[$i]."&key=".$fromUsername;
                    		}else
                    		{
                    			$links=$linkinfo[$i]."?key=".$fromUsername;
                    		}
                    	}else{
                    		$links=$linkinfo[$i];
                    	}
                    	   if(stristr($imageinfo[$i],$_SERVER['SERVER_NAME']))
								{
								$images=$imageinfo[$i];
								}else
								{
								$images="http://".$_SERVER['SERVER_NAME'].'/'.$imageinfo[$i];
								}
								
								
								$textTpl.= " <item>
                           <Title><![CDATA[".$titles[$i]."]]></Title> 
                           <Description><![CDATA[".$titles[$i]."]]></Description>
                          <PicUrl><![CDATA[".$images."]]></PicUrl>
                           <Url><![CDATA[".$links."]]></Url>
                           </item>";
                    }
                          $textTpl.= "</Articles>
                           <FuncFlag>0</FuncFlag>
                           </xml> 
							";
                    $this->tuwen($textTpl,$fromUsername, $toUsername, $time,count($titles));
					}

				}else //自动回复
				{
					$key_list= $key_word->where("ismess=1")->find();
					if(is_array($key_list))//是否存在
					{
						if($key_list['type']==1)//文本
						{
							$this->wenben($fromUsername, $toUsername, $time, $key_list['kecontent']);
						}else //图文
						{
							$titles                   = unserialize($key_list['titles']);
							$imageinfo                = unserialize($key_list['imageinfo']);
							$linkinfo                 = unserialize($key_list['linkinfo']);

							$textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							 <ArticleCount>%s</ArticleCount> 
                            <Articles>";
                    for($i=0;$i<count($titles);$i++)
                    {
                    	if(stristr($linkinfo[$i],$_SERVER['SERVER_NAME']))
                    	{
                    		if(stristr($linkinfo[$i],"?"))
                    		{
                    			$links=$linkinfo[$i]."&key=".$fromUsername;
                    		}else
                    		{
                    			$links=$linkinfo[$i]."?key=".$fromUsername;
                    		}
                    	}else{
                    		$links=$linkinfo[$i];
                    	}
                    	
                    	   if(stristr($imageinfo[$i],$_SERVER['SERVER_NAME']))
								{
								$images=$imageinfo[$i];
								}else
								{
								$images="http://".$_SERVER['SERVER_NAME'].'/'.$imageinfo[$i];
								}
								
								
								$textTpl.= " <item>
                           <Title><![CDATA[".$titles[$i]."]]></Title> 
                           <Description><![CDATA[".$titles[$i]."]]></Description>
                          <PicUrl><![CDATA[".$images."]]></PicUrl>
                           <Url><![CDATA[".$links."]]></Url>
                           </item>";
                    }
                          $textTpl.= "</Articles>
                           <FuncFlag>0</FuncFlag>
                           </xml> 
							";
                    $this->tuwen($textTpl,$fromUsername, $toUsername, $time,count($titles));
						}
					}else
					{

					}
				}


			}else{
				echo "Input something...";
			}

		}else {
			echo "";
			exit;
		}

	}
	
	
    
}