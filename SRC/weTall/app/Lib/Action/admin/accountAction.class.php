<?php
class accountAction extends backendAction
{
    public function _initialize() {
        parent::_initialize();
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
    	//var_dump($map);exit;
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
    	
    	$tokenTall = $this->getTokenTall();
    	$map['tokenTall'] = array('eq', $tokenTall);
    
    	$this->assign('search', array(
    			'billnum' => $billnum,
    			'time_start' => $time_start,
    			'time_end' => $time_end,
    			'status' =>$status,
    			'tokenTall' => $tokenTall,
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
    
    public function setting(){
    	$tokenTall = $this->getTokenTall();
    	$this->assign('tokenTall',$tokenTall);
    	
    	if(IS_POST)
    	{
    		$bankname=trim($_POST['bankname']);
    		$account=trim($_POST['account']);
    		$payee=trim($_POST['payee']);
    		$mobile=trim($_POST['mobile']);
    		
    		$data['bankname']=$bankname;
    		$data['account']=$account;
    		$data['payee']=$payee;
    		$data['mobile']=$mobile;
    		$data['tokenTall']=$tokenTall;
    		
    		if(empty($_POST['id']))
    		{
    			if($this->_mod_setting->data($data)->add()!==false)
    			{
    				$this->success('新增成功!');exit;
    			}else
    			{
    				$this->error('新增失败');exit;
    			}
    		}
    		else
    		{
	    		if($this->_mod_setting->data($data)->where('id='.$_POST['id'])->save()!==false)
	    		{
	    			$this->success('修改成功!');exit;
	    		}else 
	    		{
	    			$this->error('修改失败');exit;
	    		}
    		}
    	}else{
    		$info = $this->_mod_setting->find();
    		$this->assign('info',$info);
    	}
    	
    	$this->display();
    }
    

    
}