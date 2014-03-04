<?php

class orderAction extends userbaseAction {

	public function zhifu()
	{
		$this->_config_seo();
		$this->display();
	}
	
	public  function cancelOrder()//取消订单
	{
		//取商家token值，取不到则默认为空
		$tokenTall = $this->getTokenTall();
		$this->assign('tokenTall',$tokenTall);
		
		$orderId=$_GET['orderId'];
	    !$orderId && $this->_404();
	    $this->assign('orderId',$orderId);
	    $this->_config_seo();
	    $this->display();
	}
	
	
	public function confirmOrder()//确认收货
	{
		//取商家token值，取不到则默认为空
		$tokenTall = $this->getTokenTall();
		$this->assign('tokenTall',$tokenTall);
	
		$orderId=$_GET['orderId'];
		$status=$_GET['status'];
		!$orderId && $this->_404();
		$item_order=M('item_order');
		$item=M('item');
		$item_orders= $item_order->where("orderId='".$orderId."' and userId='".$this->visitor->info['id']."' and status=3")->find();
		if(!is_array($item_orders))
		{
			$this->error('该订单不存在!');
		}
		$data['status']=4;//收到货
		if($item_order->where("orderId='".$orderId."' and userId='".$this->visitor->info['id']."'")->save($data))
		{
			$order_detail=M('order_detail');
			$order_details = $order_detail->where("orderId='".$orderId."'")->select();
			foreach ($order_details as $val)
			{
				$item->where("id='".$val['itemId']."'")->setInc('buy_num',$val['quantity']);
			}
			$this->redirect('user/index',array('status'=>$status,'tokenTall'=>$tokenTall));
		}else
		{
			$this->error('确定收货失败');
		}
		 
	}
	
	public function closeOrder()//关闭订单
	{
		//取商家token值，取不到则默认为空
		$tokenTall = $this->getTokenTall();
		$this->assign('tokenTall',$tokenTall);
			
		$orderId=$_POST['orderId'];
		$cancel_reason=$_POST['cancel_reason'];
		!$orderId && $this->_404();
		$item_order=M('item_order');
		$item=M('item');
		$order_detail=M('order_detail');
		$order=$item_order->where("orderId='".$orderId."' and userId='".$this->visitor->info['id']."'")->find();
	
		if(!is_array($order))
		{
			$this->error('该订单不存在');
		}
		else
		{
			$data['status']=5;
			$data['closemsg']=$cancel_reason;
			if($item_order->where("orderId='".$orderId."'")->save($data))//设置为关闭
			{
				$order_details=$order_detail->where("orderId='".$orderId."'")->select();
				foreach ($order_details as $val)
				{
					$item->where("id='".$val['itemId']."'")->setInc('goods_stock',$val['quantity']);
				}
				$this->redirect('user/index',array('tokenTall'=>$tokenTall));
			}else{
				$this->error('关闭订单失败!');
			}
		}
	
	}
	
	public  function checkOrder()//查看订单
	{
		//取商家token值，取不到则默认为空
		$tokenTall = $this->getTokenTall();
		$this->assign('tokenTall',$tokenTall);
	
		$orderId=$_GET['orderId'];
		!$orderId && $this->_404();
		$status=$_GET['status'];
		$item_order=M('item_order');
		$order=$item_order->where("orderId='".$orderId."' and userId='".$this->visitor->info['id']."'")->find();
		if(!is_array($order))
		{
			$this->error('该订单不存在');
		}
		else
		{
			$order_detail=M('order_detail');
			$order_details= $order_detail->where("orderId='".$order['orderId']."'")->select();
			$item_detail=array();
			foreach ($order_details as $val)
			{
				$items= array('title'=>$val['title'],'img'=>$val['img'],'price'=>$val['price'],'quantity'=>$val['quantity']);
				//$order[$key]['items'][]=$items;
				$item_detail[]=$items;
			}
		}
	
		$this->assign('item_detail',$item_detail);
		$this->assign('order',$order);
	
		$this->_config_seo();
		$this->display();
	}
	
	
	public function jiesuan(){//结算
		$tokenTall = $this->getTokenTall();
		$this->assign('tokenTall',$tokenTall);
		if(count($_SESSION['cart'])>0)
		{
			$user_address_mod = M('user_address');
			$address_list = $user_address_mod->where(array('uid' => $this->visitor->info['id']))->select();
			$this->assign('address_list', $address_list);
				
			//购物车按店铺分组
			$result = $this->cart_by_group();
				
			//按订单整合物流方式（合并各个商品的物流方式和金额）
			foreach ($result as $key => $value){
				$free_style = 1;
				$pingyou = 0;
				$kuaidi = 0;
				$ems = 0;
				foreach ($value['item'] as $items){
					if ($items['free'] == '2') {
						$free_style = 2;
						$pingyou += floatval($items['pingyou']);
						$kuaidi += floatval($items['kuaidi']);
						$ems += floatval($items['ems']);
					}
				}
				$result[$key]['free'] = $free_style;
				$result[$key]['pingyou'] = $pingyou;
				$result[$key]['kuaidi'] = $kuaidi;
				$result[$key]['ems'] = $ems;
			}
				
			//header("content-Type: text/html; charset=Utf-8");
			//dump($result);exit;
			$this->assign('allinfo',$result);
			 
			import('Think.ORG.Cart');// 导入购物车类
			$cart=new Cart();
			$sumPrice= $cart->getPrice();
			$this->assign('sumPrice',$sumPrice);
	
			$this->_config_seo();
			$this->display();
		}else
		{
			$this->redirect('shopcart/index', array('tokenTall'=>$tokenTall));
		}
	}
	
	
	public function pay()//出订单
	{
		//取商家token值，取不到则默认为空
		$tokenTall = $this->getTokenTall();
		$this->assign('tokenTall',$tokenTall);

		//header("content-Type: text/html; charset=Utf-8");
		//dump($_POST);exit;
	
		if(IS_POST && count($_SESSION['cart'])>0)
		{
			import('Think.ORG.Cart');// 导入购物车类
			$cart=new Cart();
			$user_address=M('user_address');
			$item_order=M('item_order');
			$order_detail=M('order_detail');
			$item_goods=M('item');
			$this->visitor->info['id'];//用户ID
			$this->visitor->info['username'];//用户账号
			 
			//收货地址begin
			$addr = array();
			$address_options = $this->_post('address_options','intval');//0：刚填的地址；大于0：历史地址
			if($address_options==0)
			{
				$consignee=$this->_post('consignee','trim');//真实姓名
				$sheng=$this->_post('sheng','trim');//省
				$shi=$this->_post('shi','trim');//市
				$qu=$this->_post('qu','trim');//区
				$address=$this->_post('address','trim');//详细地址
				$phone_mob=$this->_post('phone_mob','trim');//电话号码
				$save_address=$this->_post('save_address','trim');//是否保存地址
	
				$addr['address_name']=$consignee;//收货人姓名
				$addr['mobile']=$phone_mob;//电话号码
				$addr['address']=$sheng.$shi.$qu.$address;//地址
	
				if($save_address)//保存地址
				{
					$add_address['uid']=$this->visitor->info['id'];
					$add_address['consignee']=$consignee;
					$add_address['address']=$address;
					$add_address['mobile']=$phone_mob;
					$add_address['sheng']=$sheng;
					$add_address['shi']=$shi;
					$add_address['qu']=$qu;
			   
					$user_address->data($add_address)->add();
				}
			}else{
				$address= $user_address->where("uid='".$this->visitor->info['id']."'")->find($address_options);//取到地址
				$addr['address_name']=$address['consignee'];//收货人姓名
				$addr['mobile']=$address['mobile'];//电话号码
				$addr['address']=$address['sheng'].$address['shi'].$address['qu'].$address['address'];//地址
			}
			//收货地址end
	
			//把购物车的商品按商家分组
			$result = $this->cart_by_group();
				
			//header("content-Type: text/html; charset=Utf-8");
			//dump($result);exit;
	
			$all_order_arr = array();  //所有生成的订单单号集合
			$all_order_price = 0;  //所有生成的订单总额
	
			//按店铺生成订单
			foreach ($result as $key => $value){
				$data = array();
				//生成订单号
				$dingdanhao = date("Y-m-dH-i-s");
				$dingdanhao = str_replace("-","",$dingdanhao);
				$dingdanhao .= rand(1000,2000);
				$time = time();//订单添加时间
			  
				$goods_sum = 0;
				foreach ($value['item'] as $items){
					$goods_sum = $goods_sum + (floatval($items['price']) * floatval($items['num']));
				}
	
				$free_sum = 0;
				$freetype = $this->_post('free_'.$key,'intval');//配送方式
				if($freetype == 0){ //卖家包邮
					$free_sum = 0;
				}else{
					$free_sum = $this->_post('freefee_'.$key,'intval');//取到运费
				}
		   
				$postscript = '';//卖家留言
				$postscript = $this->_post('mymsg_'.$key,'trim');//卖家留言
	
				$data['orderId']=$dingdanhao;//订单号
				$data['add_time']=$time;//添加时间
				$data['goods_sumPrice']=$goods_sum;//商品总额
				$data['order_sumPrice']=$goods_sum+$free_sum;//订单总额
				$data['note']=$postscript;
				$data['userId']=$this->visitor->info['id'];//用户ID
				$data['userName']=$this->visitor->info['username'];//用户名
				$data['address_name']=$addr['address_name'];//收货人姓名
				$data['mobile']=$addr['mobile'];//电话号码
				$data['address']=$addr['address'];//地址
				$data['freetype'] = $freetype;//配送方式
				$data['freeprice'] = $free_sum;//配送金额
				$data['tokenTall']=$key;
	
				$all_order_arr[] = $dingdanhao;
				$all_order_price = $all_order_price + $goods_sum + $free_sum;
			  
			  
				if($orderid=$item_order->data($data)->add())//添加订单汇总
				{
					$orders = array();
					$orders['orderId']=$dingdanhao;
					foreach ($value['item'] as $item)
					{
						$item_goods->where('id='.$item['id'])->setDec('goods_stock',$item['num']);
	
						$orders['itemId']=$item['id'];//商品ID
						$orders['title']=$item['name'];//商品名称
						$orders['img']=$item['img'];//商品图片
						$orders['price']=$item['price'];//商品价格
						$orders['quantity']=$item['num'];//购买数量
						$orders['size']=$item['size'];//购买大小
						$orders['color']=$item['color'];//购买颜色
	
						$order_detail->data($orders)->add();  //添加订单明细
					}
	
				}
				else
				{
					$this->error('生成订单失败!');
				}
	
			}
	
			$cart->clear();//清空购物车
			 
			//$this->assign('orderid',$orderid);//订单ID
			//$this->assign('dingdanhao',$dingdanhao);//订单号
			//$this->assign('order_sumPrice',$data['order_sumPrice']);
	
			//header("content-Type: text/html; charset=Utf-8");
			//dump(implode(',', $all_order_arr));exit;
	
			//重新生成一个合并订单号，用于支付，并将原订单号和合并订单号的关联关系写入表中。
			$merge = date("Y-m-dH-i-s");
			$merge = str_replace("-","",$merge);
			$merge .= rand(1000,2000);
			foreach ($all_order_arr as $order){
				$data1['orderid'] = $order;
				$data1['mergeid'] = $merge;
				M('order_merge')->where("orderid='".$order."'")->delete();
				M('order_merge')->data($data1)->add();
			}
			
			//$this->assign('dingdanhao', implode(',', $all_order_arr));//所有订单
			
			//所有订单号
			$this->assign('allorderid', $all_order_arr);

			//支付号
			$this->assign('dingdanhao', $merge);
			
			$this->assign('order_sumPrice',$all_order_price);//总金额
			$this->assign('order_zhifu','0');
	
		}
		else if(isset($_GET['orderId']))
		{
			$item_order = M('item_order');
			$orderId=$_GET['orderId'];//订单号
			$orders=$item_order->where("userId='".$this->visitor->info['id']."' and orderId='".$orderId."'")->find();
			if(!is_array($orders))
				$this->_404();

			$this->assign('orderid',$orders['id']);//订单ID
			
			/* 
			 * 不能这么干，应该发起查询，如果没有支付，则再进行支付。by zcb
			//重新生成一个合并订单号，用于支付，并将原订单号和合并订单号的关联关系写入表中。
			$merge = date("Y-m-dH-i-s");
			$merge = str_replace("-","",$merge);
			$merge .= rand(1000,2000);
			M('order_merge')->where("orderid='".$orderId."'")->delete();
			M('order_merge')->data(array('orderid'=>$orderId, 'mergeid'=>$merge))->add();
			*/
			$merge = M('order_merge')->where(array('orderid'=>$orderId))->find();
			//支付号
			$this->assign('dingdanhao', $merge['mergeid']);
			//订单号
			$this->assign('allorderid',array($orderId));
			
			$this->assign('order_sumPrice',$orders['order_sumPrice']);
			$this->assign('order_exist','1');
			
			if(empty($orders['supportmetho']))//是否已有支付方式
			{
				$this->assign('order_zhifu','0');
			}else
			{
				//$alipay=M('alipay')->find();
				//echo "<script>location.href='wapapli/alipayapi.php?WIDseller_email=".$alipay['alipayname']."&WIDout_trade_no=".$orderId."&WIDsubject=".$orderId."&WIDtotal_fee=".$orders['order_sumPrice']."'</script>";
				//exit;
				$this->assign('order_zhifu',$orders['supportmetho']);
			}
		}
		else
		{
			$this->redirect('user/index',array('tokenTall'=>$tokenTall));
		}
		
		$this->display();
	}
	
	
	public function end()
	{
		
		if(IS_POST)
		{	
			//支付方式
			$payment_id=$_POST['payment_id'];
			//$orderid=$_POST['orderid'];
			
			$alldingdanhao=$_POST['dingdanhao']; //取得支付号
			$all_order_arr = M('order_merge')->where("mergeid='".$alldingdanhao."'")->select();

			$all_order_price = 0;
			
			//xxl start
			$orderinfos = array();
			$orderInfo = array();
			//xxl end
			foreach ($all_order_arr as $dingdanhao){			
				$item_order=M('item_order')->where("userId='".$this->visitor->info['id']."' and orderId='".$dingdanhao['orderid']."'")->find();
				!$item_order && $this->_404();
				$all_order_price = $all_order_price + floatval($item_order['order_sumPrice']);
				
				//xxl start 短信提醒
				$order_detail=M('order_detail');
				$order_title_arr = $order_detail->field('title')->where("orderId='".$dingdanhao['orderid']."'")->select();				
				$order_titles = "";
				foreach ($order_title_arr as $order_title){					
					$order_titles = $order_titles.$order_title['title']." ";
				}

				$orderInfo['orderid']=$dingdanhao['orderid'];
				$orderInfo['address_name']=$item_order['address_name'];
				$orderInfo['mobile']=$item_order['mobile'];
				$orderInfo['title']=$order_titles;
				$orderinfos[] = $orderInfo;
				
				//xxl end
			}
			//xxl start
			$_SESSION['orderinfos'] = $orderinfos;
			//xxl end
			
			
			if(2 == $payment_id)//货到付款
			{
				foreach ($all_order_arr as $dingdanhao){
					$data['status']=2;
					$data['supportmetho']=2;
					$data['support_time']=time();
					if(M('item_order')->where("userId='".$this->visitor->info['id']."' and orderId='".$dingdanhao['orderid']."'")->data($data)->save())
					{
						//成功就继续
						//$this->redirect('user/index');
					}
					else
					{
						$this->error('操作失败!');
					}
				}
				//短信提醒 xxl start
				$this->send_tel_mail();
				//xxl end
				$this->success('货到付款，保存成功！',U('user/index',array('status'=>2)));
				
				
			}
			elseif (3 == $payment_id)
			{
				// 银联支付
				// 订单支付号
				$this->assign('dingdanhao',$alldingdanhao);
				// 价格总额
				$ordersumPrice=$_GET['ordersumPrice'];
				$this->assign('ordersumPrice',$ordersumPrice);
				
				//先查一下，看看是否已经支付过
				if ($this->orderUpmpQuery($alldingdanhao) == "not_paid"){
					// 根据订单号获取银联流水号
					header('Content-Type:text/html;charset=utf-8');
					require_once("wapupay/lib/upmp_service.php");
					$req['version']     		= upmp_config::$version; // 版本号
					$req['charset']     		= upmp_config::$charset; // 字符编码
					$req['transType']   		= "01"; // 交易类型
					$req['merId']       		= upmp_config::$mer_id; // 商户代码
					$req['backEndUrl']      	= $this->_server('HTTP_ORIGIN')."/weTall/wapupay/yinlian_notify_back.php"; // 后台通知URL
					$req['frontEndUrl']     	= ""; // 前台通知URL(可选)  //经过沟通,银联还未实现这个功能.
					$req['orderDescription']	= "微指购订单支付";// 订单描述(可选)
					$req['orderTime']   		= substr($alldingdanhao, 0, 14);    //date("YmdHis"); // 交易开始日期时间yyyyMMddHHmmss
					$req['orderTimeout']   		= ""; // 订单超时时间yyyyMMddHHmmss(可选)
					$req['orderNumber'] 		= $alldingdanhao;  //支付号
					$req['orderAmount'] 		= $all_order_price*100; // 订单金额，精确到分 ，1块请输入100
					$req['orderCurrency'] 		= "156"; // 交易币种(可选)
					$req['reqReserved'] 		= ""; // 请求方保留域(可选，用于透传商户信息)
					// 保留域填充方法
					$merReserved['test']   		= "test";
					$req['merReserved']   		= UpmpService::buildReserved($merReserved); // 商户保留域(可选)
					
					$resp = array ();
					$validResp = UpmpService::trade($req, $resp);
					
					// 商户的业务逻辑
					if ($validResp){
						// 服务器应答签名验证成功
						// 写入文件
						$filename = 'order_push.txt';
						$fh = fopen($filename, "w");
						//请求报文
						fwrite($fh, "订单推送请求报文：". $this->transUpmpInfo($req)."\r\n");
						//应答报文
						fwrite($fh, "订单推送应答报文：". $this->transUpmpInfo($resp)."\r\n");
	
						// 准备支付控件所需信息
						// urlEncode(base64(tn=流水号,resultURL=urlEcode(交易结果展示url),usetestmode=true|false))
						$strOrderInfo = "tn=".$resp['tn'].",ResultURL=".urlencode($this->_server('HTTP_ORIGIN')."/weTall/index.php?m=order&a=notify_kongjian&dingdanhao=".$alldingdanhao."&rid=").",UseTestMode=true";
						// base64加密
						$strOrderInfo = base64_encode($strOrderInfo);
						// 转换字符串
						$strOrderInfo = urlencode($strOrderInfo);					
						// 输出支付控件所需信息到页面
						$this->assign('strOrderInfo',$strOrderInfo);
						
						//关闭文件
						fclose($fh);
						//成功信息
						$connectInfo = '1';
					}else {
						// 服务器应答签名验证失败
						//echo "failture"."<br>";
						$connectInfo = '0';
					}
				}else if ($this->orderUpmpQuery($alldingdanhao) == "paid"){
					foreach ($all_order_arr as $dingdan){
						$data['status']=2;
						$data['supportmetho']=3;
						$data['support_time']=time();
						M('item_order')->where("orderId='".$dingdan['orderid']."' and status=1")->data($data)->save();
					}
					$connectInfo = '2';
				}
				
				$this->assign('connectInfo', $connectInfo);
				$this->display();
			}
			elseif (1 == $payment_id)
			{
				//支付宝
				foreach ($all_order_arr as $dingdanhao){
					$data['supportmetho']=1;
					if(M('item_order')->where("userId='".$this->visitor->info['id']."' and orderId='".$dingdanhao['orderid']."'")->data($data)->save())
					{
						//成功就继续
					}else
					{
						$this->error('操作失败!');
					}
				}
				$alipay=M('alipay')->find();
				echo "<script>location.href='wapapli/alipayapi.php?WIDseller_email=".$alipay['alipayname']."&WIDout_trade_no=".$alldingdanhao."&WIDsubject=".$alldingdanhao."&WIDtotal_fee=".$all_order_price."'</script>";
			
			}
			else 
			{
				$this->error('操作失败!');
			}
		}
	}
	
	
	public function  getFree($type)
	{
		import('Think.ORG.Cart');
		$cart=new Cart();
		$money=0;
		$items=M('item');
	
		$method=array(1=>'pingyou',2=>'kuaidi',3=>'ems');
		//echo $method[$type];exit;
		foreach ($_SESSION['cart'] as $item)
		{
			$free= $items->field('free,pingyou,kuaidi,ems')->where('free=2')->find($item['id']);
			if(is_array($free))
			{
				$money+=$free[$method[$type]];
			}
		}
		return $money;
	}
	
	function cart_by_group(){
		//把购物车的商品按商家分组
		$result = array();
		$cart_items = $_SESSION['cart'];
		$shops = M('wecha_shop')->select();
		foreach ($shops as $shopval){
			foreach ($cart_items as $cartval){
				if ($cartval['tokenTall'] == $shopval['tokenTall']) {
					$result[$shopval['tokenTall']]['tokenTall'] = $shopval['tokenTall'];
					$result[$shopval['tokenTall']]['name'] = $shopval['name'];
					$result[$shopval['tokenTall']]['credit'] = $shopval['credit'];
					$result[$shopval['tokenTall']]['headurl'] = $shopval['head'];
					$result[$shopval['tokenTall']]['HaveReal'] = $shopval['HaveReal'];
					$result[$shopval['tokenTall']]['item'][] = $cartval;
				}
			}
		}
		return $result;
	}
	
	
	/*银联支付控件通知*/
	function notify_kongjian(){
		header('Content-Type:text/html;charset=utf-8');
		$rid = $_REQUEST['rid'];
		if ("0"==$rid){
			// 支付成功
			$alldingdanhao=$_REQUEST['dingdanhao']; //取得支付号
			
			if ($this->orderUpmpQuery($alldingdanhao) == "not_paid"){
				$all_order_arr = M('order_merge')->where("mergeid='".$alldingdanhao."'")->select();
				foreach ($all_order_arr as $dingdanhao){
					$data['status']=2;
					$data['supportmetho']=3;
					$data['support_time']=time();
					M('item_order')->where("orderId='".$dingdanhao['orderid']."' and status=1")->data($data)->save();
				}
			}
			
			$this->success('支付成功！',U('user/index',array('status'=>2)));
		}else if ("-1"==$rid){
			$this->error('支付取消！',U('user/index',array('status'=>1)));
		}else {
			$this->error('支付失败！',U('user/index',array('status'=>1)));
		}
	}

	
	/**
	 * 短信提醒
	 */
	function send_tel_mail() {
		 
		$Token = $this->getTokenTall();		
		$info=M('call')->where(array('token'=>$Token))->find();
		
		$user=$info['phone_account'];//短信平台帐号
		$pass=md5($info['phone_password']);//短信平台密码
		$smsstatus=$info['status'];//短信平台状态
	
		//短信提醒设置时
		if ($smsstatus == 1) {		
			//商家电话
			$shop_tel=M('wecha_shop')->field("phone")->where(array('tokenTall'=>$Token))->find();
			foreach ($_SESSION['orderinfos'] as $orderinfo){		
				//商家短信提醒
				$content = "顾客".$orderinfo['address_name']."在您微店已下单购买\"".$orderinfo['title']."\"商品,订单号为：".$orderinfo['orderid']." 您尽快为顾客安排发货";				
				$smsrs = file_get_contents('http://api.smsbao.com/sms?u='.$user.'&p='.$pass.'&m='.$shop_tel['phone'].'&c='.urlencode($content));
				//用户信息
				$content = "您在微指购商城购买的\"".$orderinfo['title']."\"商品,订单号为：".$orderinfo['orderid']." 请 微信搜索\"微指购\"+关注 查询物流信息！";
				$smsrs = file_get_contents('http://api.smsbao.com/sms?u='.$user.'&p='.$pass.'&m='.$orderinfo['mobile'].'&c='.urlencode($content));
			}			
		}				
		
	}
	
	/**
	 * 银联请求和应答转换为字符串
	 *
	 */
	function transUpmpInfo($arr){
		$return = "";
		foreach ($arr as $key => $value){
			$return .= $key ."=". $value ."&";
		}
		$return = rtrim($return,'&');
		return $return;
	}
	
	/*订单银联查询接口*/
	public function orderUpmpQuery($num="")
	{
		$zhifuhao=$num;
		if ($zhifuhao != "") {
			header('Content-Type:text/html;charset=utf-8');
			require_once("wapupay/lib/upmp_service.php");
			
			//需要填入的部分
			$req['version']     	= upmp_config::$version; // 版本号
			$req['charset']     	= upmp_config::$charset; // 字符编码
			$req['transType']   	= "01"; // 交易类型
			$req['merId']       	= upmp_config::$mer_id; // 商户代码
			$req['orderTime']   	= substr($zhifuhao, 0, 14); // 交易开始日期时间yyyyMMddHHmmss或yyyyMMdd
			$req['orderNumber'] 	= $zhifuhao;
			// 保留域填充方法
			$merReserved['test']   	= "test";
			$req['merReserved']   	= UpmpService::buildReserved($merReserved); // 商户保留域(可选)
			
			$resp = array ();
			$validResp = UpmpService::query($req, $resp);
			
			// 商户的业务逻辑
			if ($validResp){
				// 服务器应答签名验证成功
				// 写入文件
				$filename = 'order_query.txt';
				$fh = fopen($filename, "w");
				//请求报文
				fwrite($fh, "订单查询请求报文：". $this->transUpmpInfo($req)."\r\n");
				//应答报文
				fwrite($fh, "订单查询应答报文：". $this->transUpmpInfo($resp)."\r\n");
				//关闭文件
				fclose($fh);
				
				if (""!=$resp['transStatus'] && "00"==$resp['transStatus']) {
					return "paid";
				}else{
					return "not_paid";
				}
			}else {
				// 服务器应答签名验证失败
				//echo "failture"."<br>";
				return "服务器应答签名验证失败";
			}

		}else {
			return "参数为空";
		}
	}

}
