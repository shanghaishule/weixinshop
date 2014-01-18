<?php
class AlipayAction extends UserAction{
	public function index(){		
		$group=M('User_group')->field('id,name,price')->where('price>0')->select();
		$user=M('User_group')->field('price')->where(array('id'=>session('gid')))->find();
		$this->assign('group',$group);
		$this->assign('user',$user);
		$this->display();
	}
	public function post(){
		if($this->_post('price')==false||$this->_post('uname')==false)$this->error('价格和用户名必须填写');
		import("@.ORG.Alipay.AlipaySubmit");
		//支付类型
		$payment_type = "1";
		//必填，不能修改
		//服务器异步通知页面路径
		$notify_url = C('site_url').U('User/Alipay/notify');
		//需http://格式的完整路径，不能加?id=123这类自定义参数
		//页面跳转同步通知页面路径
		$return_url = C('site_url').U('User/Alipay/return_url');
		//需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
		//卖家支付宝帐户
		$seller_email = trim(C('alipay_name'));
		 //商户订单号
		$out_trade_no = session('uname').time();
		//商户网站订单系统中唯一订单号，必填
		//订单名称
		$subject ='充值vip'.$this->_post('group').'会员'.$this->_post('num').'个月';
		//必填
		//付款金额
		$total_fee =(int)$_POST['price'];
		//必填
		//商品数量
		$quantity = "1";
		$logistics_fee = "0.00";
		//必填，即运费
		//物流类型
		$logistics_type = "EXPRESS";
		//必填，三个值可选：EXPRESS（快递）、POST（平邮）、EMS（EMS）
		//物流支付方式
		$logistics_payment = "SELLER_PAY";
		//必填，两个值可选：SELLER_PAY（卖家承担运费）、BUYER_PAY（买家承担运费）
		//订单描述
		$body = $subject;
		$data=M('Indent')->data(			
		array('uid'=>session('uid'),'title'=>$subject,'uname'=>$this->_post('uname'),'gid'=>$this->_post('gid'),'create_time'=>time(),'indent_id'=>$out_trade_no,'price'=>$total_fee))->add();
		$show_url = rtrim(C('site_url'),'/');
		//构造要请求的参数数组，无需改动
		$parameter = array(
			"service" => "create_partner_trade_by_buyer",
			"partner" =>trim(C('alipay_pid')),
			"payment_type"	=> $payment_type,
			"notify_url"	=> $notify_url,
			"return_url"	=> $return_url,
			"seller_email"	=> $seller_email,
			"out_trade_no"	=> $out_trade_no,
			"subject"	=> $subject,
			"price"	=> $total_fee,
			"quantity"	=> $quantity,
			"logistics_fee"	=> $logistics_fee,
			"logistics_type"	=> $logistics_type,
			"logistics_payment"	=> $logistics_payment,
			"body"	=> $body,
			"show_url"	=> $show_url,	
			"_input_charset"	=> trim(strtolower(strtolower('utf-8')))
		);
		//建立请求
		$alipaySubmit = new AlipaySubmit($this->setconfig());
		$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
		echo $html_text;
	}
	public function setconfig(){
		$alipay_config['partner']		= trim(C('alipay_pid'));
		//安全检验码，以数字和字母组成的32位字符
		$alipay_config['key']			= trim(C('alipay_key'));
		//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
		//签名方式 不需修改
		$alipay_config['sign_type']    = strtoupper('MD5');
		//字符编码格式 目前支持 gbk 或 utf-8
		$alipay_config['input_charset']= strtolower('utf-8');
		//ca证书路径地址，用于curl中ssl校验
		//请保证cacert.pem文件在当前文件夹目录中
		$alipay_config['cacert']    = getcwd().'\\Lanrain\\Lib\\ORG\\Alipay\\cacert.pem';
		//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
		$alipay_config['transport']    = 'http';		
		return $alipay_config;
	}
	//同步数据处理
	public function return_url (){
		import("@.ORG.Alipay.AlipayNotify");
		$alipayNotify = new AlipayNotify($this->setconfig());
		$verify_result = $alipayNotify->verifyReturn();
		
		if($verify_result) {
			//商户订单号
			$out_trade_no = $_GET['out_trade_no'];
			//支付宝交易号
			$trade_no = $_GET['trade_no'];
			//交易状态
			$trade_status = $_GET['trade_status'];
			if($_GET['trade_status'] == 'WAIT_SELLER_SEND_GOODS') {
					$indent=M('Indent')->field('id,price')->where(array('index_id'=>$out_trade_no))->find();
					if($indent!==false){
						//$back=M('Users')->where(array('id'=>$indent['uid']))->setInc('money',$indent['price']);
						$back=M('Indent')->where(array('id'=>$indent['id']))->setField('status',1);
						if($back!=false){
							$this->success('充值成功',U('Home/Index/index'));
						}else{
							$this->error('充值失败,请在线客服,为您处理',U('Home/Index/index'));
						}
					}else{						
						$this->error('订单不存在',U('Home/Index/index'));
					
					}
			}else {			
				$this->error('请勿重复操作',U('Home/Index/index'));
			}
		}else {			
			$this->error('充值失败 ,请在线客服,为您处理',U('Home/Index/index'));
		
	}
	}
	public function notify(){
		import("@.ORG.Alipay.alipay_notify");
		$alipayNotify = new AlipayNotify($this->setconfig());
		$html_text = $alipaySubmit->buildRequestHttp($parameter);
				
	}
	//发货
	public function send(){
	import("@.ORG.Alipay.AlipaySubmit");
		//计算得出通知验证结果
		$alipaySubmit = new AlipaySubmit($this->setconfig());
		$html_text = $alipaySubmit->buildRequestHttp($parameter);
		  //支付宝交易号
        $trade_no = $this->_get('WIDtrade_no');
        //必填
        //物流公司名称
        $logistics_name = '韵达快运';
        //三个值可选：POST（平邮）、EXPRESS（快递）、EMS（EMS）
	/************************************************************/
	//构造要请求的参数数组，无需改动
		$parameter = array(
				"service" => "send_goods_confirm_by_platform",
				"partner" => trim($alipay_config['partner']),
				"trade_no"	=> $trade_no,
				"logistics_name"	=> $logistics_name,
				"invoice_no"	=> $invoice_no,
				"transport_type"	=> $transport_type,
				"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
		);
	//建立请求
	$alipaySubmit = new AlipaySubmit($alipay_config);
	$html_text = $alipaySubmit->buildRequestHttp($parameter);
	//解析XML
	//注意：该功能PHP5环境及以上支持，需开通curl、SSL等PHP配置环境。建议本地调试时使用PHP开发软件
	$doc = new DOMDocument();
	$doc->loadXML($html_text);
		M('Indent')->where(array('id'=>$this->_get('id')))->setField('status',3);
	if( ! empty($doc->getElementsByTagName( "alipay" )->item(0)->nodeValue) ) {
		$alipay = $doc->getElementsByTagName( "alipay" )->item(0)->nodeValue;
		echo $alipay;
	}

	}
	
}



?>