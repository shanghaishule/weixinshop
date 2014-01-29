<?php

class StatisticsAction extends BackAction
{
	public function _initialize() {
        $account_status = array(
        		0=>'已生成，未对账',
        		1=>'商城已对账，商家未对账',
        		2=>'商城未对账，商家已对账',
        		3=>'商城已对账，商家已对账',
        		4=>'已付款',
        		5=>'已作废'
        );
        $this->assign('account_status',$account_status);
        $this->_mod_setting = D('account_setting');
        $this->_mod_bill_mst = D('account_bill_mst');
        $this->_mod_bill_dtl = D('account_bill_dtl');
    }

	public function index() {
    	$map = $this->_search();
    	//dump($map);exit;
    	$mod = $this->_mod_bill_mst;
    	!empty($mod) && $this->_list($mod, $map);
    	$this->display();
    }
    
    protected function _search() {
    	$map = array();
    	($billnum = $this->_request('billnum', 'trim')) && $map['billnum'] = array('like', '%'.$billnum.'%');
    	($time_start = $this->_request('time_start', 'trim')) && $map['gen_time'][] = array('egt', strtotime($time_start));
    	($time_end = $this->_request('time_end', 'trim')) && $map['gen_time'][] = array('elt', strtotime($time_end)+(24*60*60-1));
    	if( $_GET['status']==null ){
    		$status = -1;
    	}else{
    		$status = intval($_GET['status']);
    	}
    	$status>=0 && $map['status'] = array('eq',$status);
    
    	$this->assign('search', array(
    			'billnum' => $billnum,
    			'time_start' => $time_start,
    			'time_end' => $time_end,
    			'status' =>$status,
    	));
    	return $map;
    }
    
    public function edit() {
    	$id = $this->_get('id','intval');
    	$account_master = $this->_mod_bill_mst->where(array('id'=>$id))->find();
    	$account_detail = $this->_mod_bill_dtl->where('billnum='.$account_master['billnum'])->select();
    	$this->assign('account_detail',$account_detail);
    	$this->assign('account_master', $account_master);
    	$this->display();
    }

    public function status()
    {
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

    			$data['duizhang']=$this->_session('uname');
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
    		
    			$data['pay']=$this->_session('uname');
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
    	$mod = $this->_mod_bill_mst;
    	//需要删除主从表
    	
    	
    	
    	
    	$ids = trim($this->_request('id'), ',');
    	if ($ids) {
    		if (false !== $mod->delete($ids)) {
    			IS_AJAX && $this->ajaxReturn(1, L('operation_success'));
    			$this->success(L('operation_success'));
    		} else {
    			IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
    			$this->error(L('operation_failure'));
    		}
    	} else {
    		IS_AJAX && $this->ajaxReturn(0, L('illegal_parameters'));
    		$this->error(L('illegal_parameters'));
    	}
    }
}
?>