<?php
  class weTallAction extends BaseAction{
    public function index(){
    	$weTallad = M("adforhome");
    	$data["status"]=1;
    	$data["checkstatus"]=1;
    	$data["boadid"]=array(array('eq',1),array('eq',2),array('eq',3),'or');
    	$weTallboard = $weTallad->where($data)->select();
    	$this->assign("weTallboard",$weTallboard);echo "hi";
        $this->display();
    }
  }
?>