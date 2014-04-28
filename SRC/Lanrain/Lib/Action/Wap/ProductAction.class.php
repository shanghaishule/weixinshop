<?php
class ProductAction extends BaseAction{
	public $token;
	public $wecha_id;
	public $product_model;
	public $product_cat_model;
	public $isDining;
	public function __construct(){
		
		$agent = $_SERVER['HTTP_USER_AGENT']; 
		if(!strpos($agent,"MicroMessenger")) {
		//	echo '此功能只能在微信浏览器中使用';exit;
		}
		
		$this->token		= $this->_get('token');
		$this->assign('token',$this->token);
		$this->wecha_id	= $this->_get('wecha_id');
		if (!$this->wecha_id){
			//$this->wecha_id='';
		}
		$this->assign('wecha_id',$this->wecha_id);
		$this->product_model=M('Product');
		$this->product_cat_model=M('Product_cat');
		//define('RES',THEME_PATH.'common');
		//define('STATICS',TMPL_PATH.'static');
		$this->assign('staticFilePath',str_replace('./','/',THEME_PATH.'common/css/product'));
		//购物车
		$calCartInfo=$this->calCartInfo();
		$this->assign('totalProductCount',$calCartInfo[0]);
		$this->assign('totalProductFee',$calCartInfo[1]);
		//是否是餐饮
		if (isset($_GET['dining'])&&intval($_GET['dining'])){
			$this->isDining=1;
			$this->assign('isDining',1);
		}
	}
	function remove_html_tag($str){  //清除HTML代码、空格、回车换行符
		//trim 去掉字串两端的空格
		//strip_tags 删除HTML元素

		$str = trim($str);
		$str = @preg_replace('/<script[^>]*?>(.*?)<\/script>/si', '', $str);
		$str = @preg_replace('/<style[^>]*?>(.*?)<\/style>/si', '', $str);
		$str = @strip_tags($str,"");
		$str = @ereg_replace("\t","",$str);
		$str = @ereg_replace("\r\n","",$str);
		$str = @ereg_replace("\r","",$str);
		$str = @ereg_replace("\n","",$str);
		$str = @ereg_replace(" ","",$str);
		$str = @ereg_replace("&nbsp;","",$str);
		return trim($str);
	}
	public function cats(){
		$catWhere=array('parentid'=>0,'token'=>$this->token);
		if (isset($_GET['parentid'])){
			$parentid=intval($_GET['parentid']);
			$catWhere['parentid']=$parentid;
			
			$thisCat=$this->product_cat_model->where(array('id'=>$parentid))->find();
			$this->assign('thisCat',$thisCat);
			$this->assign('parentid',$parentid);
		}
		if ($this->isDining){
			$catWhere['dining']=1;
		}else {
			$catWhere['dining']=0;
		}
		$cats = $this->product_cat_model->where($catWhere)->order('id asc')->select();
		$this->assign('cats',$cats);
		$this->assign('metaTitle','商品分类');
		$this->display();
	}
	public function products(){
		$where=array('token'=>$this->token);
		if (isset($_GET['catid'])){
			$catid=intval($_GET['catid']);
			$where['catid']=$catid;
			
			$thisCat=$this->product_cat_model->where(array('id'=>$catid))->find();
			$this->assign('thisCat',$thisCat);
		}
		if (IS_POST){
			$key = $this->_post('search_name');
            $this->redirect('/index.php?g=Wap&m=Product&a=products&token='.$this->token.'&keyword='.$key);
		}
		if (isset($_GET['keyword'])){
            $where['name|intro|keyword'] = array('like',"%".$_GET['keyword']."%");
            $this->assign('isSearch',1);
		}
		$count = $this->product_model->where($where)->count();
		$this->assign('count',$count); 
		//排序方式
		$method=isset($_GET['method'])&&($_GET['method']=='DESC'||$_GET['method']=='ASC')?$_GET['method']:'DESC';
		$orders=array('time','discount','price','salecount');
		$order=isset($_GET['order'])&&in_array($_GET['order'],$orders)?$_GET['order']:'time';
		$this->assign('order',$order);
		$this->assign('method',$method);
		//
        	
		$products = $this->product_model->where($where)->order($order.' '.$method)->limit('5')->select();
		$this->assign('products',$products);
		$this->assign('metaTitle','商品');
		$this->display();
	}
	public function ajaxProducts(){
		$where=array('token'=>$this->token);
		if (isset($_GET['catid'])){
			$catid=intval($_GET['catid']);
			$where['catid']=$catid;
		}
		$page=isset($_GET['page'])&&intval($_GET['page'])>1?intval($_GET['page']):2;
		$pageSize=isset($_GET['pagesize'])&&intval($_GET['pagesize'])>1?intval($_GET['pagesize']):5;
		$start=($page-1)*$pageSize;
		$products = $this->product_model->where($where)->order('id desc')->limit($start.','.$pageSize)->select();
		$str='{"products":[';
		if ($products){
			$comma='';
			foreach ($products as $p){
				$str.=$comma.'{"id":"'.$p['id'].'","catid":"'.$p['catid'].'","storeid":"'.$p['storeid'].'","name":"'.$p['name'].'","price":"'.$p['price'].'","token":"'.$p['token'].'","keyword":"'.$p['keyword'].'","salecount":"'.$p['salecount'].'","logourl":"'.$p['logourl'].'","time":"'.$p['time'].'","oprice":"'.$p['oprice'].'"}';
				$comma=',';
			}
		}
		$str.=']}';
		$this->show($str);
	}
	public function header(){
		$this->display();
	}
	public function product(){
		$where=array('token'=>$this->token);
		if (isset($_GET['id'])){
			$id=intval($_GET['id']);
			$where['id']=$id;
		}
		$product=$this->product_model->where($where)->find();
		$this->assign('product',$product);
		if ($product['endtime']){
			$leftSeconds=intval($product['endtime']-time());
			$this->assign('leftSeconds',$leftSeconds);
		}
		$this->assign('metaTitle',$product['name']);
		$product['intro']=str_replace(array('&lt;','&gt;','&quot;','&amp;nbsp;'),array('<','>','"',' '),$product['intro']);
		$intro=$this->remove_html_tag($product['intro']);
		$intro=mb_substr($intro,0,30,'utf-8');
		$this->assign('intro',$intro);
		//分店信息
		$company_model=M('Company');
		$branchStoreCount=$company_model->where(array('token'=>$this->token,'isbranch'=>1))->count();
		$this->assign('branchStoreCount',$branchStoreCount);
		//销量最高的商品
		$sameCompanyProductWhere=array('token'=>$this->token,'id'=>array('neq',$product['id']));
		if ($product['dining']){
			$sameCompanyProductWhere['dining']=1;
		}
		if ($product['groupon']){
			$sameCompanyProductWhere['groupon']=1;
		}
		if (!$product['groupon']&&!$product['dining']){
			$sameCompanyProductWhere['groupon']=array('neq',1);
			$sameCompanyProductWhere['dining']=array('neq',1);
		}
		$products=$this->product_model->where($sameCompanyProductWhere)->limit('salecount DESC')->limit('0,5')->select();
		$this->assign('products',$products);
		$this->display();
	}
	public function productDetail(){
		$where=array('token'=>$this->token);
		if (isset($_GET['id'])){
			$id=intval($_GET['id']);
			$where['id']=$id;
		}
		$product=$this->product_model->where($where)->find();
		$product['intro']=str_replace(array('&lt;','&gt;','&quot;','&amp;nbsp;'),array('<','>','"',' '),$product['intro']);
		$this->assign('product',$product);
		$this->assign('metaTitle',$product['name']);
		
		$this->display();
	}
	public function company($display=1){
		//店铺信息
		$company_model=M('company');
		$where=array('token'=>$this->token);
		if (isset($_GET['id'])){
			$where['id']=intval($_GET['id']);
		}
		$thisCompany=$company_model->where($where)->find();
		$this->assign('thisCompany',$thisCompany);
		//分店信息
		$branchStores=$company_model->where(array('token'=>$this->token,'isbranch'=>1))->order('taxis ASC')->select();
		$branchStoreCount=count($branchStores);
		$this->assign('branchStoreCount',$branchStoreCount);
		$this->assign('branchStores',$branchStores);
		$this->assign('metaTitle','公司信息');
		if($display){
		$this->display();
		}
	}
	public function companyMap(){
		$this->apikey=C('baidu_map_api');
		$this->assign('apikey',$this->apikey);
		$this->company(0);
		$this->display();
	}
	public function addProductToCart(){//商品id|商品价格|商品数量,
		
		$count=isset($_GET['count'])?intval($_GET['count']):1;
		$carts=$this->_getCart();
		$id=intval($_GET['id']);
		if (key_exists($id,$carts)){
			$carts[$id]['count']++;
		}else {
			$carts[$id]=array('count'=>1,'price'=>floatval($_GET['price']));
		}
		$_SESSION['session_cart_products']=serialize($carts);
		$calCartInfo=$this->calCartInfo();
		echo $calCartInfo[0].'|'.$calCartInfo[1];
	}
	public function calCartInfo($carts=''){
		$totalFee=0;
		$totalCount=0;
		if (!$carts){
			$carts=$this->_getCart();
		}
		if ($carts){
			foreach ($carts as $c){
				if ($c){
					$totalFee+=floatval($c['price'])*$c['count'];
					$totalCount+=intval($c['count']);
				}
			}
		}
		return array($totalCount,$totalFee);
	}
	function _getCart(){
		if (!isset($_SESSION['session_cart_products'])||!strlen($_SESSION['session_cart_products'])){
			$carts=array();
		}else {
			$carts=unserialize($_SESSION['session_cart_products']);
		}
		return $carts;
	}
	public function cart(){
		$totalFee=0;
		$totalCount=0;
		$products=array();
		$ids=array();
		$carts=$this->_getCart();
		foreach ($carts as $k=>$c){
			if (is_array($c)){
				$productid=$k;
				$price=$c['price'];
				$count=$c['count'];
				//
				if (!in_array($productid,$ids)){
					array_push($ids,$productid);
				}
				$totalFee+=$price*$count;
				$totalCount+=$count;
			}
		}
		if (count($ids)){
			$list=$this->product_model->where(array('id'=>array('in',$ids)))->select();
		}
		//判断是不是餐饮
		$isDining=0;
		if ($list){
			$i=0;
			foreach ($list as $p){
				$list[$i]['count']=$carts[$p['id']]['count'];
				if ($p['dining']){
					$isDining=1;
				}
				$i++;
			}
		}
		$this->assign('cartIsDining',$isDining);
		$this->assign('products',$list);
		//
		$this->assign('totalFee',$totalFee);
		$this->assign('metaTitle','购物车');
		$this->display();
	}
	public function deleteCart(){
		$products=array();
		$ids=array();
		$carts=$this->_getCart();
		foreach ($carts as $k=>$c){
			$i=0;
			if (strlen($c)){
				$productid=$k;
				$price=$c['price'];
				$count=$c['count'];
				//
				if ($_GET['id']!=$productid){
					$products[$productid]=array('price'=>$price,'count'=>$count);
				}
				$i++;
			}
		}
		$_SESSION['session_cart_products']=serialize($products);
		$this->redirect(U('Product/cart',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'])));
	}
	public function ajaxUpdateCart(){
		$carts=$this->_getCart();
		$g_id=intval($_GET['id']);
		$g_count=intval($_GET['count']);
		if ($carts){
			foreach ($carts as $k=>$c){
				if ($g_id==$k){
					$carts[$k]['count']=$g_count;
				}
			}
		}
		$_SESSION['session_cart_products']=serialize($carts);
		$calCartInfo=$this->calCartInfo();
		echo $calCartInfo[0].'|'.$calCartInfo[1];
	}
	public function orderCart(){
		if (isset($_GET['cartIsDining'])&&intval($_GET['cartIsDining'])){
			$cartIsDining=1;
			$this->assign('cartIsDining',1);
		}
		$userinfo_model=M('Userinfo');
		$thisUser=$userinfo_model->where(array('token'=>$this->token,'wecha_id'=>$this->wecha_id))->find();
		$this->assign('thisUser',$thisUser);
		//是否要支付
		$alipay_config_db=M('Alipay_config');
		$alipayConfig=$alipay_config_db->where(array('token'=>$this->token))->find();
		$this->assign('alipayConfig',$alipayConfig);
		//
		if (IS_POST){
			$row=array();
			$carts=$this->_getCart();
			//
			$allCartInfo=$this->calCartInfo($carts);
			$totalFee=$allCartInfo[1];
			//
			$cartsCount=0;
			//
			$isGroupon=0;
			$productids=array();
			foreach ($carts as $k=>$c){
				array_push($productids,$k);
			}
			//把团购、普通购物和餐饮分开
			$normalCart=array();
			$grouponCart=array();
			$diningCart=array();
			$productsByKey=array();
			//
			$orderName='';
			if (count($productids)){
				$products=$this->product_model->where(array('id'=>array('in',$productids)))->select();
				if ($products){
					$t=0;
					foreach ($products as $p){
						$productsByKey[$p['id']]=$p;
						if ($t==0){
							$orderName=$p['name'];
						}
						$t++;
					}
				}
				foreach ($carts as $k=>$c){
					$thisProduct=$productsByKey[$k];
					if ($thisProduct['groupon']==1){
						$grouponCart[$k]=$c;
						$carts[$k]['type']='groupon';
					}else {
						if ($thisProduct['dining']==1){
							$diningCart[$k]=$c;
							$carts[$k]['type']='dining';
						}else {
							$normalCart[$k]=$c;
							$carts[$k]['type']='normal';
						}
					}
					$cartsCount++;
				}
			}
			$orderid=$this->wecha_id.time();
			$row['orderid']=$orderid;
			$orderid=$row['orderid'];
			//
			$row['truename']=$this->_post('truename');
			$row['tel']=$this->_post('tel');
			$row['address']=$this->_post('address');
			
			
			$row['token']=$this->token;
			$row['wecha_id']=$this->wecha_id;
			if (!$row['wecha_id']){
				$row['wecha_id']='null';
			}
			//
			$buytimestamp=$this->_post('buytimestamp');//购买时间
			if ($buytimestamp){
				$row['year']=date('Y',$buytimestamp);
				$row['month']=date('m',$buytimestamp);
				$row['day']=date('d',$buytimestamp);
				$row['hour']=$this->_post('hour');
			}
			$time=time();
			$row['time']=$time;
			//分别加入3类订单
			$orderids=array();//用于存储插入的各类订单id
			$product_cart_model=M('product_cart');
			if ($cartsCount){
				if (count($grouponCart)){
					$calCartInfo=$this->calCartInfo($grouponCart);
					$row['total']=$calCartInfo[0];
					$row['price']=$calCartInfo[1];
					$row['diningtype']=0;
					$row['buytime']='';
					$row['tableid']=0;
					$row['info']=serialize($grouponCart);
					//
					$row['groupon']=1;
					$row['dining']=1;
					$groupon_rt=$product_cart_model->add($row);
					$orderids['groupon']=$groupon_rt;
				}
				if (count($diningCart)){
					$calCartInfo=$this->calCartInfo($diningCart);
					$row['total']=$calCartInfo[0];
					$row['price']=$calCartInfo[1];
					//
					$row['diningtype']=intval($this->_post('diningtype'));
					$row['buytime']=$buytimestamp?$row['month'].'月'.$row['day'].'日'.$row['hour'].'点':'';
					$row['tableid']=intval($this->_post('tableid'));
					$row['info']=serialize($diningCart);
					//
					$row['groupon']=0;
					$row['dining']=1;
					$dining_rt=$product_cart_model->add($row);
					$orderids['dining']=$dining_rt;
				}
				if (count($normalCart)){
					$calCartInfo=$this->calCartInfo($normalCart);
					$row['total']=$calCartInfo[0];
					$row['price']=$calCartInfo[1];
					//
					$row['diningtype']=0;
					$row['buytime']='';
					$row['tableid']=0;
					$row['info']=serialize($normalCart);
					//
					$row['groupon']=0;
					$row['dining']=0;
					$normal_rt=$product_cart_model->add($row);
					$orderids['normal']=$normal_rt;
				}
			}else {
				if (intval($this->_post('tableid'))&&$this->_post('buytimestamp')){//只是预定餐桌
					$row['total']=0;
					$row['price']=0;
					//
					$row['diningtype']=intval($this->_post('diningtype'));
					$row['buytime']=$buytimestamp?$row['month'].'月'.$row['day'].'日'.$row['hour'].'点':'';
					$row['tableid']=intval($this->_post('tableid'));
					$row['info']=serialize($diningCart);
					//
					$row['groupon']=0;
					$row['dining']=1;
					$orderDining_rt=$product_cart_model->add($row);
				}
			}
			//
			if ($normal_rt||$groupon_rt||$dining_rt||$orderDining_rt){
				$product_model=M('product');
				$product_cart_list_model=M('product_cart_list');
				$crow=array();
				if ($cartsCount){
					foreach ($carts as $k=>$c){
						$crow['cartid']=intval($orderids[$c['type']]);
						$crow['productid']=$k;
						$crow['price']=$c['price'];
						$crow['total']=$c['count'];
						$crow['wecha_id']=$row['wecha_id'];
						$crow['token']=$row['token'];
						$crow['time']=$time;
						$product_cart_list_model->add($crow);
						$product_model->where(array('id'=>$k))->setInc('salecount',$c['count']);
					}
				}
				$_SESSION['session_cart_products']='';
				//保存个人信息
				if ($_POST['saveinfo']){
					$userRow=array('tel'=>$row['tel'],'truename'=>$row['truename'],'address'=>$row['address']);
					if ($thisUser){
						$userinfo_model->where(array('id'=>$thisUser['id']))->save($userRow);
					}else {
						$userRow['token']=$this->token;
						$userRow['wecha_id']=$this->wecha_id;
						$userRow['wechaname']='';
						$userRow['qq']=0;
						$userRow['sex']=-1;
						$userRow['age']=0;
						$userRow['birthday']='';
						$userRow['info']='';
						//
						$userRow['total_score']=0;
						$userRow['sign_score']=0;
						$userRow['expend_score']=0;
						$userRow['continuous']=0;
						$userRow['add_expend']=0;
						$userRow['add_expend_time']=0;
						$userRow['live_time']=0;
						$userinfo_model->add($userRow);
					}
				}
				
			}
			if ($alipayConfig['open']){
				$this->redirect(U('Alipay/pay',array('token'=>$this->token,'wecha_id'=>$this->wecha_id,'success'=>1,'price'=>$totalFee,'orderName'=>$orderName,'orderid'=>$orderid)));
			}else {
				$this->redirect(U('Product/my',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'success'=>1)));
			}
		}else {
			//如果是订餐
			if ($cartIsDining){
				//是否外卖预定等
				$diningConfig =M('Reply_info')->where(array('infotype'=>'Dining','token'=>$this->token))->find();
				$this->assign('diningConfig',$diningConfig);
				//可以预定多少天内的
				$diningConfigDetail=unserialize($diningConfig['config']);
				if (!$diningConfigDetail||!$diningConfigDetail['yudingdays']){
					$days=7;
				}else {
					$days=$diningConfigDetail['yudingdays'];
				}
				$time=time();
				$secondsOfDay=24*60*60;
				$dateTimes=array();
				for ($i=0;$i<$days;$i++){
					array_push($dateTimes,$time+$i*$secondsOfDay);
				}
				$this->assign('dateTimes',$dateTimes);
				//
				$orderHour=date('H',$time);
				$this->assign('orderHour',$orderHour);
				$hours=array();
				for ($i=0;$i<24;$i++){
					array_push($hours,$i);
				}
				$this->assign('hours',$hours);
				//
				$product_diningtable_model=M('Product_diningtable');
				$tables=$product_diningtable_model->where(array('token'=>$_GET['token']))->order('taxis ASC')->select();
				$this->assign('tables',$tables);
			}
			//
			$this->assign('metaTitle','购物车结算');
			$this->display();
		}
	}
	public function my(){
		$product_cart_model=M('product_cart');
		//$this->wecha_id
		$orders=$product_cart_model->where(array('token'=>$this->token,'wecha_id'=>$this->wecha_id))->order('time DESC')->select();
		if ($orders){
			foreach ($orders as $o){
				$products=unserialize($o['info']);
				//$firstProductID=$products
			}
		}
		$this->assign('orders',$orders);
		$this->assign('ordersCount',count($orders));
		$this->assign('metaTitle','我的订单');
		//
		//是否要支付
		$alipay_config_db=M('Alipay_config');
		$alipayConfig=$alipay_config_db->where(array('token'=>$this->token))->find();
		$this->assign('alipayConfig',$alipayConfig);
		//
		$this->display();
	}
	public function updateOrder(){
		$product_cart_model=M('product_cart');
		$thisOrder=$product_cart_model->where(array('id'=>intval($_GET['id'])))->find();
		//检查权限
		if ($thisOrder['wecha_id']!=$this->wecha_id){
			exit();
		}
		//
		$this->assign('thisOrder',$thisOrder);
		$carts=unserialize($thisOrder['info']);
		//
		$totalFee=0;
		$totalCount=0;
		$products=array();
		$ids=array();
		foreach ($carts as $k=>$c){
			if (is_array($c)){
				$productid=$k;
				$price=$c['price'];
				$count=$c['count'];
				//
				if (!in_array($productid,$ids)){
					array_push($ids,$productid);
				}
				$totalFee+=$price*$count;
				$totalCount+=$count;
			}
		}
		if (count($ids)){
			$list=$this->product_model->where(array('id'=>array('in',$ids)))->select();
		}
		if ($list){
			$i=0;
			foreach ($list as $p){
				$list[$i]['count']=$carts[$p['id']]['count'];
				$i++;
			}
		}
		$this->assign('products',$list);
		//
		$this->assign('totalFee',$totalFee);
		
		$this->assign('metaTitle','修改订单');
		//
		//是否要支付
		$alipay_config_db=M('Alipay_config');
		$alipayConfig=$alipay_config_db->where(array('token'=>$this->token))->find();
		$this->assign('alipayConfig',$alipayConfig);
		//
		$this->display();
	}
	public function deleteOrder(){
		$product_model=M('product');
		$product_cart_model=M('product_cart');
		$product_cart_list_model=M('product_cart_list');
		$thisOrder=$product_cart_model->where(array('id'=>intval($_GET['id'])))->find();
		//检查权限
		$id=$thisOrder['id'];
		if ($thisOrder['wecha_id']!=$this->wecha_id||$thisOrder['handled']==1){
			exit();
		}
		//
		//删除订单和订单列表
		$product_cart_model->where(array('id'=>$id))->delete();
		$product_cart_list_model->where(array('cartid'=>$id))->delete();
		//商品销量做相应的减少
		$carts=unserialize($thisOrder['info']);
		foreach ($carts as $k=>$c){
			if (is_array($c)){
				$productid=$k;
				$price=$c['price'];
				$count=$c['count'];
				$product_model->where(array('id'=>$k))->setDec('salecount',$c['count']);
			}
		}
		$this->redirect(U('Product/my',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'])));
	}
	public function index(){
		$token_open=M('token_open')->field('queryname')->where(array('token'=>$this->token))->find();
		$this->assign('shopOpen',1);
		$this->assign('diningOpen',1);
		$this->assign('grouponOpen',1);
		if(!strpos($token_open['queryname'],'shop')){
            $this->assign('shopOpen',0);
		}
		if(!strpos($token_open['queryname'],'dx')){
            $this->assign('diningOpen',0);
		}
		if(!strpos($token_open['queryname'],'etuan')){
            $this->assign('grouponOpen',0);
		}
		$this->assign('metaTitle','微信购物');
		$this->display();
	}
	public function dining(){
		//是否外卖预定等
				$diningConfig =M('Reply_info')->where(array('infotype'=>'Dining','token'=>$this->token))->find();
				$this->assign('diningConfig',$diningConfig);
		$this->assign('metaTitle','订餐');
		$this->display();
	}
	public function a(){
		$where['token']=$this->token;
		$where['diningtype']=array('gt',0);
		

		$where['printed']=0;
		$this->product_cart_model=M('product_cart');
		$count      = $this->product_cart_model->where($where)->count();
		$orders=$this->product_cart_model->where($where)->order('time ASC')->limit(0,1)->select();
		
		$now=time();
		if ($orders){
			$thisOrder=$orders[0];
			switch ($thisOrder['diningtype']){
				case 1:
					$orderType='点餐';
					break;
				case 2:
					$orderType='外卖';
					break;
				case 3:
					$orderType='预定餐桌';
					break;
			}
			
			//订餐信息
			$product_diningtable_model=M('product_diningtable');
			if ($thisOrder['tableid']) {
				$thisTable=$product_diningtable_model->where(array('id'=>$thisOrder['tableid']))->find();
				$thisOrder['tableName']=$thisTable['name'];
			}else{
				$thisOrder['tableName']='未指定';
			}
			$str="订单类型：".$orderType."\r\n订单编号：".$thisOrder['id']."\r\n姓名：".$thisOrder['truename']."\r\n电话：".$thisOrder['tel']."\r\n地址：".$thisOrder['address']."\r\n桌台：".$thisOrder['tableName']."\r\n下单时间：".date('Y-m-d H:i:s',$thisOrder['time'])."\r\n打印时间：".date('Y-m-d H:i:s',$now)."\r\n--------------------------------\r\n";
			//
			$carts=unserialize($thisOrder['info']);

			//
			$totalFee=0;
			$totalCount=0;
			$products=array();
			$ids=array();
			foreach ($carts as $k=>$c){
				if (is_array($c)){
					$productid=$k;
					$price=$c['price'];
					$count=$c['count'];
					//
					if (!in_array($productid,$ids)){
						array_push($ids,$productid);
					}
					$totalFee+=$price*$count;
					$totalCount+=$count;
				}
			}
			if (count($ids)){
				$products=$this->product_model->where(array('id'=>array('in',$ids)))->select();
			}
			if ($products){
				$i=0;
				foreach ($products as $p){
					$products[$i]['count']=$carts[$p['id']]['count'];
					$str.=$p['name']."  ".$products[$i]['count']."份  单价：".$p['price']."元\r\n";
					$i++;
				}
			}
			$str.="\r\n--------------------------------\r\n合计：".$thisOrder['price']."元\r\n     谢谢惠顾，欢迎下次光临\r\n";
			//店铺信息
			$member_card_info_model=M('Member_card_info');
			$thisCompany=$member_card_info_model->where(array('token'=>$this->token))->find();
			$str.="     ".$thisCompany['info']."\r\n
			";
			//
			$str=iconv('utf-8','gbk',$str);
			//设置为打印过了
			$this->product_cart_model->where(array('id'=>$thisOrder['id']))->save(array('printed'=>1));
			echo "CMD=01	FLAG=0	MESSAGE=成功	DATETIME=".date('YmdHis',$now)."	ORDERCOUNT=".$count."	ORDERID=".$thisOrder['id']."	PRINT=".$str;
		}else {
			echo "CMD=01	FLAG=1	MESSAGE=no order now	DATETIME=".date('YmdHis',time())."\r\n
	";
		}
	}
	/**
	 * 检查某时间段内是否已经有和桌子被预定
	 *
	 */
	public function ajaxTables(){
		$token=$this->_get('token');
		$time=$this->_get('time');
		$hour=intval($this->_get('hour'));
		$year=date('Y',$time);
		$month=date('m',$time);
		$day=date('d',$time);
		$occupiedTables=array();
		$product_cart_model=M('product_cart');
		$otableWhere=array();
		$otableWhere['token']=$token;
		$otableWhere['hour']=array('between',array($hour-3,$hour+3));//三个小时内不能再定
		$otableWhere['year']=$year;
		$otableWhere['month']=$month;
		$otableWhere['day']=$day;
		$otables=$product_cart_model->where($otableWhere)->select();
		$str='';
		$comma='';
		if ($otables){
			foreach ($otables as $t){
				if (!in_array($t['tableid'],$occupiedTables)){
					$str.=$comma.$t['tableid'];
					array_push($occupiedTables,$t['tableid']);
					$comma=',';
				}
			}
		}
		echo $str;
	}
}

?>