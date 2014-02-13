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
	    $item_orders= $item_order->where('orderId='.$orderId.' and userId='.$this->visitor->info['id'].' and status=3')->find();
	    if(!is_array($item_orders))
	    {
	    	$this->error('该订单不存在!');
	    }
	    $data['status']=4;//收到货
	    if($item_order->where('orderId='.$orderId.' and userId='.$this->visitor->info['id'])->save($data))
	    {
	    	$order_detail=M('order_detail');
	    	$order_details = $order_detail->where('orderId='.$orderId)->select();
	    	foreach ($order_details as $val)
	    	{
	    		$item->where('id='.$val['itemId'])->setInc('buy_num',$val['quantity']);
	        }
	        
	        //交易完成商家信誉加上1点
	        $dataTall["tokenTall"]=$item_orders["tokenTall"];
	        $shopcredit=M("wecha_shop");
	        $shopDetail=$shopcredit->where($dataTall)->find();
	        $updateCredit["credit"]=$shopDetail["credit"]+1;
	        if($shopcredit->where($dataTall)->save($updateCredit)){	        
	    		$this->redirect('user/index',array('status'=>$status,'tokenTall'=>$tokenTall));
	        }
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
	    $order=$item_order->where('orderId='.$orderId.' and userId='.$this->visitor->info['id'])->find();

	    if(!is_array($order))
	    {
	  		$this->error('该订单不存在');
	    }
	    else 
	    {
		  	$data['status']=5;
		  	$data['closemsg']=$cancel_reason;
		   	if($item_order->where('orderId='.$orderId)->save($data))//设置为关闭
	   		{
	   			$order_details=$order_detail->where('orderId='.$orderId)->select();
		   		foreach ($order_details as $val)
		   		{
		   			$item->where('id='.$val['itemId'])->setInc('goods_stock',$val['quantity']);
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
	    $order=$item_order->where('orderId='.$orderId.' and userId='.$this->visitor->info['id'])->find();
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
	  		    $items= array('title'=>$val['title'],'img'=>$val['img'],'price'=>$val['price'],'quantity'=>$val['quantity'],'size'=>$val['size'],'color'=>$val['color']);
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
			$address_list = $user_address_mod->where(array('uid' => $this->visitor->info['id'], 'tokenTall' => $tokenTall))->select();
			$this->assign('address_list', $address_list);
			$items=M('item');
			$pingyou=0;
			$kuaidi=0;
			$ems=0;
			$freesum=0;
			foreach ($_SESSION['cart'] as $item)
			{
				$free= $items->field('free,pingyou,kuaidi,ems')->where(array('free' => 2, 'tokenTall' => $tokenTall))->find($item['id']);
				if(is_array($free))
				{
					$pingyou+=$free['pingyou'];
					$kuaidi+=$free['kuaidi'];
					$ems+=$free['ems'];
					$freesum+=$free['pingyou']+$free['kuaidi']+$free['ems'];
				}
			}
			
			import('Think.ORG.Cart');// 导入购物车类
	    	$cart=new Cart();
	    	$sumPrice= $cart->getPrice();
	    	 
	    	$freearr=array();
	    	if($pingyou>0)
	    	{
	    		$freearr[]=array('value'=>1,'price'=>$pingyou);
	    	}
	    	if($kuaidi>0)
	    	{
	    		$freearr[]=array('value'=>2,'price'=>$kuaidi);
	    	}
	    	if($ems>0)
	    	{
	    		$freearr[]=array('value'=>3,'price'=>$ems);
	    	}
	    	 
	    	
	    	// var_dump($freearr);
	    	$this->assign('freearr',$freearr);
	    	$this->assign('freesum',$freesum);
	    	$this->assign('sumPrice',$sumPrice);
		    //$this->assign('pingyou',$pingyou);
			//$this->assign('kuaidi',$kuaidi);
		    //$this->assign('ems',$ems);
		    
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

		if(IS_POST && count($_SESSION['cart'])>0)
		{	
			import('Think.ORG.Cart');// 导入分页类
            $cart=new Cart();	
			$user_address=M('user_address');
			$item_order=M('item_order');
			$order_detail=M('order_detail');
			$item_goods=M('item');
			$this->visitor->info['id'];//用户ID
		    $this->visitor->info['username'];//用户账号
		   
		    //生成订单号
		    $dingdanhao = date("Y-m-dH-i-s");
		    $dingdanhao = str_replace("-","",$dingdanhao);
		    $dingdanhao .= rand(1000,2000);
		   
		    $time = time();//订单添加时间
			$address_options = $this->_post('address_options','intval');//地址  0：刚填的地址 大于0历史的地址
			$shipping_id = $this->_post('shipping_id','intval');//配送方式
			$postscript = $this->_post('postscript','trim');//卖家留言
		   
			if(!empty($postscript))//卖家留言
			{
				$data['note']=$postscript;
			}
		    
		    if(empty($shipping_id))//卖家包邮
		    {
		    	$data['freetype']=0;
		    	$data['order_sumPrice']=$cart->getPrice();
		    }
		    else 
		    {
		    	$data['freetype']=$shipping_id;
		    	$data['freeprice']= $this->getFree($shipping_id);//取到运费
		    	$data['order_sumPrice']=$cart->getPrice()+$this->getFree($shipping_id);
		    	
		    	//echo $cart->getPrice()+$this->getFree($shipping_id);exit;
		    }
		   
		    $data['orderId']=$dingdanhao;//订单号
		    $data['add_time']=$time;//添加时间
		    $data['goods_sumPrice']=$cart->getPrice();//商品总额
		    $data['userId']=$this->visitor->info['id'];//用户ID
		    $data['userName']=$this->visitor->info['username'];//用户名
			if($address_options==0)
			{
				$consignee=$this->_post('consignee','trim');//真实姓名
				$sheng=$this->_post('sheng','trim');//省
				$shi=$this->_post('shi','trim');//市
				$qu=$this->_post('qu','trim');//区
				$address=$this->_post('address','trim');//详细地址
				$phone_mob=$this->_post('phone_mob','trim');//电话号码
				$save_address=$this->_post('save_address','trim');//是否保存地址
			
				$data['address_name']=$consignee;//收货人姓名
				$data['mobile']=$phone_mob;//电话号码
				$data['address']=$sheng.$shi.$qu.$address;//地址
			
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
				$address= $user_address->where('uid='.$this->visitor->info['id'])->find($address_options);//取到地址
				$data['address_name']=$address['consignee'];//收货人姓名
				$data['mobile']=$address['mobile'];//电话号码
				$data['address']=$address['sheng'].$address['shi'].$address['qu'].$address['address'];//地址
			}
			
			$data['tokenTall']=$tokenTall;
			
			if($orderid=$item_order->data($data)->add())//添加订单成功
			{
				$orders['orderId']=$dingdanhao;
				foreach ($_SESSION['cart'] as $item )
				{
					$item_goods->where('id='.$item['id'])->setDec('goods_stock',$item['num']);
					
					$orders['itemId']=$item['id'];//商品ID
					$orders['title']=$item['name'];//商品名称
					$orders['img']=$item['img'];//商品图片
					$orders['price']=$item['price'];//商品价格 
					$orders['quantity']=$item['num'];//购买数量
					$orders['size']=$item['size'];//大小
					$orders['color']=$item['color'];//颜色
					$order_detail->data($orders)->add();
				}

				$cart->clear();//清空购物车
				
				$this->assign('orderid',$orderid);//订单ID
				$this->assign('dingdanhao',$dingdanhao);//订单号
				$this->assign('order_sumPrice',$data['order_sumPrice']);
			}
			else 
			{
				$this->error('生成订单失败!');
			}
		}
		else if(isset($_GET['orderId']))
		{
			$item_order = M('item_order');
			$orderId=$_GET['orderId'];//订单号
			$orders=$item_order->where('userId='.$this->visitor->info['id'].' and orderId='.$orderId)->find();
			if(!is_array($orders))
			$this->_404();
			
			if(empty($orders['supportmetho']))//是否已有支付方式
			{
				$this->assign('orderid',$orders['id']);//订单ID
				$this->assign('dingdanhao',$orders['orderId']);//订单号
				$this->assign('order_sumPrice',$orders['order_sumPrice']);
			}else 
			{
				$alipay=M('alipay')->find();
				echo "<script>location.href='wapapli/alipayapi.php?WIDseller_email=".$alipay['alipayname']."&WIDout_trade_no=".$orderId."&WIDsubject=".$orderId."&WIDtotal_fee=".$orders['order_sumPrice']."'</script>";
				exit;
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
			$orderid=$_POST['orderid'];
			$dingdanhao=$_POST['dingdanhao'];
			$item_order=M('item_order')->where('userId='.$this->visitor->info['id'].' and orderId='.$dingdanhao)->find();
			!$item_order && $this->_404();
			if($payment_id==2)//货到付款
			{
				$data['status']=2;
				$data['supportmetho']=2;
				$data['support_time']=time();
				if(M('item_order')->where('userId='.$this->visitor->info['id'].' and orderId='.$dingdanhao)->data($data)->save())
				{
				$this->redirect('user/index');
				}else 
				{
					$this->error('操作失败!');
				}
			}elseif ($payment_id==1) //支付宝
			{
				
				
				$data['supportmetho']=1;
				
				if(M('item_order')->where('userId='.$this->visitor->info['id'].' and orderId='.$dingdanhao)->data($data)->save())
				{
					$alipay=M('alipay')->find();
					
				echo "<script>location.href='wapapli/alipayapi.php?WIDseller_email=".$alipay['alipayname']."&WIDout_trade_no=".$dingdanhao."&WIDsubject=".$dingdanhao."&WIDtotal_fee=".$item_order['order_sumPrice']."'</script>";
				
				}else 
				{
					$this->error('操作失败!');
				}
				
			}else 
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
	
}