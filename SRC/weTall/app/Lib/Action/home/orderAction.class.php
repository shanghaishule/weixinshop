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
			//dump(implode('、', $all_order_arr));exit;
	
			$this->assign('dingdanhao', implode('、', $all_order_arr));//所有订单
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
			$this->assign('dingdanhao',$orders['orderId']);//订单号
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
			$payment_id=$_POST['payment_id'];
			//$orderid=$_POST['orderid'];
			
			$alldingdanhao=$_POST['dingdanhao']; //取得所有订单号联成的字符串
			$all_order_arr = explode('、', $alldingdanhao); //切分成数组
			$all_order_price = 0;
			foreach ($all_order_arr as $dingdanhao){			
				$item_order=M('item_order')->where("userId='".$this->visitor->info['id']."' and orderId='".$dingdanhao."'")->find();
				!$item_order && $this->_404();
				$all_order_price = $all_order_price + floatval($item_order['order_sumPrice']);
			}
			
			if(2 == $payment_id)//货到付款
			{
				foreach ($all_order_arr as $dingdanhao){
					$data['status']=2;
					$data['supportmetho']=2;
					$data['support_time']=time();
					if(M('item_order')->where("userId='".$this->visitor->info['id']."' and orderId='".$dingdanhao."'")->data($data)->save())
					{
						//成功就继续
						//$this->redirect('user/index');
					}
					else
					{
						$this->error('操作失败!');
					}
				}
				$this->success('货到付款，保存成功！',U('user/index',array('status'=>2)));
			}
			elseif (3 == $payment_id)
			{
				// 银联支付
				//echo "payment_id:".$payment_id."<br>";
				//echo "orderid:".$orderid."<br>";
				//echo "dingdanhao:".$dingdanhao."<br>";
				//echo "item_order:";
				//print_r($item_order)."<br>";
				
				// 根据订单号获取银联流水号
				// header('Content-Type:text/html;charset=utf-8');
				require_once("wapupay/lib/upmp_service.php");
				$req['version']     		= upmp_config::$version; // 版本号
				$req['charset']     		= upmp_config::$charset; // 字符编码
				$req['transType']   		= "01"; // 交易类型
				$req['merId']       		= upmp_config::$mer_id; // 商户代码
				$req['backEndUrl']      	= upmp_config::$mer_back_end_url; // 通知URL
				$req['frontEndUrl']     	= upmp_config::$mer_front_end_url; // 前台通知URL(可选)
				$req['orderDescription']	= "订单描述";// 订单描述(可选)
				$req['orderTime']   		= date("YmdHis"); // 交易开始日期时间yyyyMMddHHmmss
				$req['orderTimeout']   		= ""; // 订单超时时间yyyyMMddHHmmss(可选)
				$req['orderNumber'] 		= date("YmdHiss"); //订单号(商户根据自己需要生成订单号)
				$req['orderAmount'] 		= "1"; // 订单金额
				$req['orderCurrency'] 		= "156"; // 交易币种(可选)
				$req['reqReserved'] 		= "透传信息"; // 请求方保留域(可选，用于透传商户信息)
				// 保留域填充方法
				$merReserved['test']   		= "test";
				$req['merReserved']   		= UpmpService::buildReserved($merReserved); // 商户保留域(可选)
				$resp = array ();
				$validResp = UpmpService::trade($req, $resp);
				// 商户的业务逻辑
				if ($validResp){
					// 服务器应答签名验证成功
					//echo "success"."<br>";
					//print_r($resp);
					$strSN = $resp['tn'];
					//echo "sn:".$strSN."<br>";
					//echo "dd:".$dingdanhao."<br>";
					//echo "<pre>";
					//var_dump($resp);
					//echo "</pre>";
				}else {
					// 服务器应答签名验证失败
					//echo "failture"."<br>";
					//print_r($resp);
				}
				// 要写入的文件名字
				$filename = 'bb.txt';
				$fh = fopen($filename, "w");
				// 订单号
				$this->assign('dingdanhao',$alldingdanhao);
				// 未加密的
				fwrite($fh, $alldingdanhao."\r\n");
				// 订单信息
				$strOrderInfo = "tn=".$strSN.",ResultURL=http://bestchoice88.com/weTall/wapupay/notify_url.php?rid=,UseTestMode=true";
				// 未加密的
				fwrite($fh, $strOrderInfo."\r\n");
				// 转换字符串
				$strOrderInfo = urlencode($strOrderInfo);
				// base64加密
				$strOrderInfo = base64_encode($strOrderInfo);
				// 转换字符串
				$strOrderInfo = urlencode($strOrderInfo);
				// 加密的
				fwrite($fh, $strOrderInfo);
				fclose($fh);
				// 银联流水号
				$this->assign('strOrderInfo',$strOrderInfo);
				// 价格总额
				$ordersumPrice=$_GET['ordersumPrice'];
				$this->assign('ordersumPrice',$ordersumPrice);
				$this->display();
			}
			elseif (1 == $payment_id)
			{
				//支付宝
				foreach ($all_order_arr as $dingdanhao){
					$data['supportmetho']=1;
					if(M('item_order')->where("userId='".$this->visitor->info['id']."' and orderId='".$dingdanhao."'")->data($data)->save())
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

}
