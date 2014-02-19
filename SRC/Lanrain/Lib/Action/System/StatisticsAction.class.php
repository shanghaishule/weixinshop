<?php

class StatisticsAction extends BackAction
{	
	public function _initialize() {
        $account_status = array(
        		0=>'已生成，未对账',
        		1=>'商城已对账，店铺未对账',
        		2=>'商城未对账，店铺已对账',
        		3=>'商城已对账，店铺已对账',
        		4=>'已付款',
        		5=>'--所有--未对账--',
        		6=>'--所有--未付款--',
        );
        $this->assign('account_status',$account_status);
        
        $this->_mod_setting = D('account_setting');
        $this->_mod_bill_mst = M('account_bill_mst');
        $this->_mod_bill_dtl = D('account_bill_dtl');
        $this->_mod_shop = D('wecha_shop');
        
        $shopinfo = $this->_mod_shop->select();
        $this->assign('shopinfo',$shopinfo);
        
        $account_shop = array();
        $account_shop_arr = $this->_mod_bill_mst->Distinct(true)->field('tokenTall')->select();
        foreach ($account_shop_arr as $valarr){
        	$tokenValue = $valarr['tokenTall'];
        	foreach ($shopinfo as $valarr2){
        		if ($tokenValue == $valarr2['tokenTall']) {
        			$account_shop[$tokenValue] = $valarr2['name'];
        		}
        	}
        }
        $this->assign('account_shop',$account_shop);
        //dump($account_shop);exit;
        $order_status=array(1=>'待付款',2=>'待发货',3=>'待收货',4=>'完成',5=>'关闭');
        $this->assign('order_status',$order_status);
        
        
    }

	public function index() {
    	$map = $this->_search();
    	$mod = $this->_mod_bill_mst;
    	!empty($mod) && $this->_list($mod, $map);
    	$this->display();
    }
    
    protected function _search() {
    	$map = array();

    	($billnum = $this->_request('billnum', 'trim')) && $map['billnum'] = array('like', '%'.$billnum.'%');
    	$time_start = $this->_request('time_start', 'trim');
    	$time_end = $this->_request('time_end', 'trim');
    	if($time_start && $time_end){
    	    $map['gen_time'] = array('between', array(strtotime($time_start), strtotime($time_end)+(24*60*60-1)));
    	} else if($time_start) {
    	    $map['gen_time'] = array('egt', strtotime($time_start));
    	} else if($time_end) {
    	    $map['gen_time'] = array('elt', strtotime($time_end)+(24*60*60-1));
    	}

    	if( $_GET['status']==null ){
    		$status = -1;
    	}else{
    		$status = intval($_GET['status']);
    	}
    	//$status>=0 && $map['status'] = array('eq',$status);
    	if ($status >= 0) {
    		if ($status == 5) {
    			$map['status'] = array('in', '0,2');
    		}else if ($status == 6) {
    			$map['status'] = array('neq', '4');
    		}else{
    			$map['status'] = array('eq',$status);
    		}
    	}
    	
    	if( $_GET['shop']==null ){
    		$shop = -1;
    	}else{
    		$shop = trim($_GET['shop']);
    	}
    	if($shop>=0){
    		$map['tokenTall'] = array('eq',$shop);
    	}
    	
    	$this->assign('search', array(
    			'billnum' => $billnum,
    			'time_start' => $time_start,
    			'time_end' => $time_end,
    			'status' =>$status,
    			'shop' =>$shop,
    	));

    	return $map;
    }
    
    public function edit() {
    	$id = $this->_get('id','intval');
    	//$account_master = $this->_mod_bill_mst->where(array('id'=>$id))->find();
    	
    	$modelmst = new Model();
    	/*
    	$account_master = $modelmst->table("tp_account_bill_mst m, tp_account_setting c")
    	->where("m.tokenTall=c.tokenTall and m.id='".$id."'")
    	->field("m.*, c.bankname, c.account, c.payee, c.mobile")
    	->find();
    	*/
    	
    	$account_master = $modelmst->table('tp_account_bill_mst m')->join('tp_account_setting c on m.tokenTall=c.tokenTall')->where("m.id='".$id."'")->field('m.*, c.bankname, c.account, c.payee, c.mobile')->find();
    	
    	$model=new Model();
    	$account_detail=$model->table("tp_account_bill_dtl m, tp_item_order c")
    	->where("m.orderId=c.orderId and m.billnum='".$account_master['billnum']."'")
    	->field("m.*, c.add_time, c.status")
    	->select();
    	
    	//$account_detail = $this->_mod_bill_dtl->where('billnum='.$account_master['billnum'])->select();
    	$this->assign('account_detail',$account_detail);
    	$this->assign('account_master', $account_master);
    	$this->display();
    }

    public function status()
    {
    	//dump($_SESSION);exit;
    	
    	$id= $this->_get('id', 'trim');
    	!$id && $this->_404();
    	$status= $this->_get('status', 'trim');
    	!$status && $this->_404();
    	
    	$before_status_arr = $this->_mod_bill_mst->field('status')->where('id='.$id)->select();
    	$before_status = $before_status_arr[0]['status'];
    	
    	if($status == 'mall_confirm'){
    		if($before_status == '0' || $before_status == '2' ){
    			if($before_status == '0')
    				$data['status']='1';
    			if($before_status == '2')
    				$data['status']='3';

    			$data['duizhang']=$_SESSION['username'];
    			$data['duizhang_time']=time();
    	   
    			if($this->_mod_bill_mst->where('id='.$id)->save($data))
    			{
    				$this->success('操作成功!');
    			}else{
    				$this->error('操作失败!');
    			}
    		}else{
    			$this->error('前置状态错误!');
    		}
    	}elseif ($status == 'haspay'){
    		if($before_status == '3'){
    			$data['status']='4';
    		
    			$data['pay']=$_SESSION['username'];
    			$data['pay_time']=time();
    		
    			if($this->_mod_bill_mst->where('id='.$id)->save($data))
    			{
    				$this->success('操作成功!');
    			}else{
    				$this->error('操作失败!');
    			}
    		}else{
    			$this->error('前置状态错误!');
    		}
    	}
    
    
    }
    
    public function delete()
    {
    	$mod_mst = $this->_mod_bill_mst;
    	$mod_dtl = $this->_mod_bill_dtl;
    	$ids = trim($this->_request('id'), ',');
    	if ($ids) {
    		$billmst = $mod_mst->where("id = '".$ids."'")->select();
    		if ($billmst[0]['status'] != '0') {
    			$this->error('状态不正确！');
    		}else{
    			//需要删除主从表
    			$dtldel = $mod_dtl->where("billnum = '".$billmst[0]['billnum']."'")->delete();
    			$dtlmst = $mod_mst->where("id = '".$ids."'")->delete();

	    		if (false !== $dtldel && false !== $dtlmst) {
	    			$this->success('删除成功');
	    		} else {
	    			$this->error('删除失败');
	    		}
    		}
    	} else {
    		$this->error('参数错误');
    	}
    }

}
?>