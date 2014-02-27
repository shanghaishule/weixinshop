<?php
  class weTallAction extends BaseAction{
    public function index(){
    	//判断是微信的环境
    	$systemBrowse="X";
    	$agent = $_SERVER['HTTP_USER_AGENT'];
    	if(!strpos($agent,"icroMessenger")) {
    		$systemBrowse="Y";
    	}
    	$index_num = $_SESSION["index_num"];
    	if ($index_num == "") {
    		$index_num = 0;
    	}
    	$index_num = $index_num + 1;
    	$_SESSION["index_num"] = $index_num;
    	//广告位
    	$weTallad = M("adforhome");
    	//所有品牌
    	$where["display"] = '1';
    	$broadlist=M("brandlist")->where($where)->select(); 
    	//一级菜单
    	$iteml["pid"]="0";
    	$item_l1=M("item_cate")->where($iteml)->limit(3)->select();
    	
    	//二级菜单	
    	$iteml2["pid"]=array("NEQ","0");
    	$item_l2=M("item_cate")->where($iteml2)->select();
    	
    	//商品
    	$goodbuy=M("item")->limit(4)->order('rand()')->select();
    	foreach ($goodbuy as $vallist){
    		$itemLm=$vallist;
    		$itemLm["title"]=mb_substr($vallist["title"], 0,17,"utf-8");
    		$goods[]=$itemLm;
    	}
    	//var_dump($goods);
    	$data["status"]=1;
    	$data["checkstatus"]=1;
    	$data["boadid"]=array(array('eq',1),array('eq',2),array('eq',3),'or');
    	$weTallboard = $weTallad->where($data)->order("id asc")->select();
    	
    	$this->assign("cartNum",count($_SESSION['cart']));	
    	$this->assign("weTallboard",$weTallboard);
    	$this->assign("systemBrowse",$systemBrowse);
    	$this->assign("brandlist",$broadlist);
    	$this->assign("index_num",$_SESSION["index_num"]);
    	$this->assign("item1",$item_l1);
    	$this->assign("goods",$goods);
    	$this->assign("item",$item_l1);
    	$this->assign("itemtwo",$item_l2);
        $this->display();
    }
    public function allCate(){
    	
    	//一级菜单
    	$iteml["pid"]="0";
    	$item_l1=M("item_cate")->where($iteml)->select();
    	 
    	//二级菜单
    	$iteml2["pid"]=array("NEQ","0");
    	$item_l2=M("item_cate")->where($iteml2)->select();
    	 
    	$this->assign("cartNum",count($_SESSION['cart']));
    	$this->assign("item1",$item_l1);
    	$this->assign("item",$item_l1);
    	$this->assign("itemtwo",$item_l2);
    	$this->display();
    }
    public function allBrand(){
    	$broadlist=M("brandlist")->select();
    	$this->assign("brandlist",$broadlist);
    	$this->display();    	
    }
  }
?>