<?php
// 本类由系统自动生成，仅供测试用途
class shopcartAction extends frontendAction {
	
	public function _initialize() {
        parent::_initialize();
        import('Think.ORG.Cart');// 导入购物车类
    	$cart=new Cart();
    }
	
	
    public function index(){
    	$tokenTall = $this->getTokenTall();
	    import('Think.ORG.Cart');// 导入购物车类
	    $cart=new Cart();
	    
	    $result = array();
	    $cart_items = $_SESSION['cart'];
	    $shops = M('wecha_shop')->select();
	    foreach ($shops as $shopval){
	    	foreach ($cart_items as $cartval){
		    	if ($cartval['tokenTall'] == $shopval['tokenTall']) {
		    		$result[$shopval['tokenTall']]['name'] = $shopval['name'];
		    		$result[$shopval['tokenTall']]['credit'] = $shopval['credit'];
		    		$result[$shopval['tokenTall']]['headurl'] = $shopval['head'];
		    		$result[$shopval['tokenTall']]['HaveReal'] = $shopval['HaveReal'];
		    		$result[$shopval['tokenTall']]['item'][] = $cartval;
		    		
		    	}
	    	}
	    }
	    
	    //header("content-Type: text/html; charset=Utf-8");
	    //dump($_SESSION['cart']);exit;
	    //dump($result);exit;
	    
	    //$this->assign('item',$_SESSION['cart']);
	    $this->assign('item',$result);
	    $this->assign('sumPrice',$cart->getPrice());
		
		$this->assign('tokenTall',$tokenTall);
		$this->_config_seo();
		$this->display();
    }
    
    public function add_cart()//添加进购物车
    {
    	header("content-Type: text/html; charset=Utf-8");
    	
    	import('Think.ORG.Cart');// 导入分页类
    	$cart=new Cart();
    	
    	$goodId= $this->_post('goodId', 'intval');//商品ID
    	$quantity=$this->_post('quantity', 'intval');//购买数量
    	$size= $this->_post('size', 'intval');//大小
    	$color=$this->_post('color', 'trim');//颜色
    	   
    	$item=M('item')->field('id,title,img,price,goods_stock,tokenTall,free,pingyou,kuaidi,ems')->find($goodId);
    	$item['size'] = $size;
    	$item['color'] = $color; //mb_convert_encoding($color, "UTF-8", "GBK");
    	
    	if(!is_array($item))
    	{
    		$data=array('status'=>0,'msg'=>'不存在该商品','count'=>$cart->getCnt(),'sumPrice'=>$cart->getPrice());
    	}elseif($item['goods_stock']<$quantity){
    		$data=array('status'=>0,'msg'=>'没有足够的库存','count'=>$cart->getCnt(),'sumPrice'=>$cart->getPrice());
    	}else {
    		$result= $cart->addItem($item['id'],$item['title'],$item['price'],$quantity,$item['img'],$item['size'],$item['color'],$item['tokenTall'],$item['free'],$item['pingyou'],$item['kuaidi'],$item['ems']);
    		if($result==1)//购物车存在该商品
    		{
    			$data=array('result'=>$result,'status'=>1,'count'=>$cart->getCnt(),'sumPrice'=>$cart->getPrice(),'msg'=>'该商品已经存在购物车');
    		}else{
    			$data=array('result'=>$result,'status'=>1,'count'=>$cart->getCnt(),'sumPrice'=>$cart->getPrice(),'msg'=>'商品已成功添加到购物车');
    		}
    	}
    	
    	//$data=array('status'=>2);
    	echo json_encode($data);
    }
    
    public function remove_cart_item()//删除购物车商品
    {
    	import('Think.ORG.Cart');// 导入购物车类
    	$cart=new Cart();
    	
    	$goodId= $this->_post('itemId', 'intval');//商品ID
    	$cart->delItem($goodId);
    	$data=array('status'=>1);
    	echo json_encode($data);
    }
    
    public function change_quantity()
    {
    	import('Think.ORG.Cart');// 导入购物车类
        $cart=new Cart();
    	  
    	$itemId= $this->_post('itemId', 'intval');//商品ID
    	$quantity= $this->_post('quantity', 'intval');//购买数量
    	
    	$item=M('item')->field('goods_stock')->find($itemId);
    	if($item['goods_stock']<$quantity)
    	{
    		$data=array('status'=>0,'msg'=>'该商品的库存不足');
    	}else {
    		$cart->modNum($itemId,$quantity);
    		$data=array('status'=>1,'item'=>$cart->getItem($itemId),'sumPrice'=>$cart->getPrice());
    	}
    	echo json_encode($data);
    }
}