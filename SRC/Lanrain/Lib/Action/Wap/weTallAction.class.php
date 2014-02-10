<?php
  class weTallAction extends BaseAction{
    public function index(){
    	//广告位
    	$weTallad = M("adforhome");
    	//所有品牌
    	$broadlist=M("brandlist")->select();
    	//一级菜单
    	$iteml["pid"]="0";
    	$item_l1=M("item_cate")->where($iteml)->select();
    	
    	//二级菜单	
    	$iteml2["pid"]=array("NEQ","0");
    	$item_l2=M("item_cate")->where($iteml2)->select();
    	
    	$data["status"]=1;
    	$data["checkstatus"]=1;
    	$data["boadid"]=array(array('eq',1),array('eq',2),array('eq',3),'or');
    	$weTallboard = $weTallad->where($data)->select();
    	
    	$this->assign("weTallboard",$weTallboard);
    	$this->assign("brandlist",$broadlist);
    	$this->assign("item1",$item_l1);
    	$this->assign("item",$item_l1);
    	$this->assign("itemtwo",$item_l2);
        $this->display();
    }
  }
?>