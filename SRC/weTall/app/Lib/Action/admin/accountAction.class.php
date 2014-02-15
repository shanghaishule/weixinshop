<?php
class accountAction extends backendAction
{
	public $shop_array = array();
	
    public function _initialize() {
        parent::_initialize();
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
        $this->_mod_bill_mst = D('account_bill_mst');
        $this->_mod_bill_dtl = D('account_bill_dtl');
        
        $account_shop = array();
        $account_shop_arr = M('item_order')->Distinct(true)->field('tokenTall')->where("tokenTall != ''")->select();
        $this->shop_array = $account_shop_arr;
        foreach ($account_shop_arr as $valarr){
        	$tokenValue = $valarr['tokenTall'];
        	$account_shop[$tokenValue] = $tokenValue;
        }
        $this->assign('account_shop',$account_shop);
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
    	if ($status >= 0) {
    		if ($status == 5) {
    			$map['status'] = array('in', '0,1');
    		}else if ($status == 6) {
    			$map['status'] = array('neq', '4');
    		}else{
    			$map['status'] = array('eq',$status);
    		}
    	}

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
    		$status = $this->_get('status','intval');
    		$account_master = $this->_mod_bill_mst->where(array('id'=>$id))->find();
    		//dump($account_master);exit;
    		$account_detail = $this->_mod_bill_dtl->where("billnum='".$account_master['billnum']."'")->select();
    		
    		$this->assign('account_detail',$account_detail);
    		$this->assign('account_master', $account_master);
    		$this->assign('status', $status);
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
    		$info = $this->_mod_setting->where(array('tokenTall'=>$tokenTall))->find();
    		$this->assign('info',$info);
    	}
    	
    	$this->display();
    }
    
    public function status()
    {
    	$id= $this->_get('id', 'trim');
    	!$id && $this->_404();
    	$status= $this->_get('status', 'trim');
    	!$status && $this->_404();
    	
    	if($status == 'shop_confirm'){
	    	$before_status_arr = $this->_mod_bill_mst->field('status')->where('id='.$id)->select();
	    	$before_status = $before_status_arr[0]['status'];
	    	//dump($before_status);exit;
	    	if($before_status == '0' || $before_status == '1' ){
	    		if($before_status == '0')
					$data['status']='2';
	    		if($before_status == '1')
	    			$data['status']='3';

	    		//dump($this->_session());exit;
	    		$data['duizhang2']=$this->_session('uname');
	    		$data['duizhang2_time']=time();
	    		
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
    
    public function genbill() {
    	if (IS_POST) {
    		//取得post参数
    		$shop = $_POST['shop'] == null ? '' : trim($_POST['shop']);
    		$start_time = $_POST['start_time'] == null ? '' : strtotime(trim($_POST['start_time']));
    		$end_time = $_POST['end_time'] == null ? '' : strtotime(trim($_POST['end_time']));

    		if ($start_time != '' && $end_time != '') {
    			if ( $start_time >= $end_time ) {
    				IS_AJAX && $this->ajaxReturn(0, '开始时间必须小于结束时间！');
    				$this->error('开始时间必须小于结束时间！');
    			}else{
    				$allcount_ok = 0;
    				$allcount_fail = 0;
    				$allstr = '';
    				if ($shop == '') {
    					$account_shop_arr = $this->shop_array;
    					foreach ($account_shop_arr as $valarr){
    						$tokenValue = $valarr['tokenTall'];
    						$rtn = $this->genbillaction($tokenValue, $start_time, $end_time);
    						if (is_array($rtn) && $rtn['success']) {
    							$allstr .= 
    							'<tr>
    								<td align="center">'.$tokenValue.'</td>
    								<td align="center" style="color:green">成功</td>
    								<td align="center">账单号：'.$rtn['msg'].'</td>
    							</tr>';
    							$allcount_ok ++;
    						}else{
    							$allstr .=
    							'<tr>
    								<td align="center">'.$tokenValue.'</td>
    								<td align="center" style="color:red">失败</td>
    								<td align="center">'.$rtn['msg'].'</td>
    							</tr>';
    							$allcount_fail ++;
    						}
    					}
    				}else{
    					$rtn = $this->genbillaction($shop, $start_time, $end_time);
    					if (is_array($rtn) && $rtn['success']) {
    							$allstr .= 
    							'<tr>
    								<td align="center">'.$tokenValue.'</td>
    								<td align="center" style="color:green">成功</td>
    								<td align="center">账单号：'.$rtn['msg'].'</td>
    							</tr>';
    							$allcount_ok ++;
    					}else{
    							$allstr .=
    							'<tr>
    								<td align="center">'.$tokenValue.'</td>
    								<td align="center" style="color:red">失败</td>
    								<td align="center">'.$rtn['msg'].'</td>
    							</tr>';
    							$allcount_fail ++;
    					}
    				}
    				
    				$resultstr =
    				'<table width="90%" cellspacing="1" class="table_list">
						<thead>
							<tr>
								<th align="center">商家</th>
								<th align="center">操作结果</th>
    							<th align="center">信息</th>
							</tr>
						</thead>
						<tbody>
							'.$allstr.'
						</tbody>
						<tfoot style="background-color:#FFFF99">
							<tr>
								<td align="center"><b>合计</b></td>
								<td align="center" colspan="2"><b><span style="color:green">成功：'.$allcount_ok.'</span><span style="color:red;margin-left:10px;">失败：'.$allcount_fail.'</span></b></td>
							</tr>
						</tfoot>
    				</table>';
    				IS_AJAX && $this->ajaxReturn(1, $resultstr, '', 'genbill');
    				$this->success('ok');
    			}
    		}else{
    			//时间段不全
    			IS_AJAX && $this->ajaxReturn(0, '必须有起止时间！');
    			$this->error('必须有起止时间！');
    		}
    		
    	} else {
    		if (IS_AJAX) {
    			$response = $this->fetch();
    			$this->ajaxReturn(1, '', $response);
    		} else {
    			$this->display();
    		}
    	}
    }
    
    function ajaxReturn($status=1, $msg='', $data='', $dialog='') {
    	$alldata = array(
    			'status' => $status,
    			'msg' => $msg,
    			'data' => $data,
    			'dialog' => $dialog,
    	);
    	 
    	// 返回JSON数据格式到客户端 包含状态信息
    	header('Content-Type:text/html; charset=utf-8');
    	exit(json_encode($alldata));
    }
    
    public function genbillaction($shop, $start_time, $end_time){
    	$rtn = array();
    	//检查是否有重复时间段
    	$rows = $this->_mod_bill_mst->where(array('tokenTall'=>$shop))->select();
    	foreach ($rows as $value){
    		if ($end_time < $value['start_time'] || $start_time > $value['end_time']) {
    			//符合要求
    		}else{
    			$rtn['success'] = false;
    			$rtn['msg'] = '该时间段内本店铺已存在其他账单！';
    			return $rtn;
    		}
    	}
    	
    	//查找时间段中的已完成订单：status=4 and 下单时间在范围中
    	//$orders = M('item_order')->where(array('tokenTall'=>$shop, 'status'=>4, 'add_time'=>array('egt',$start_time), 'add_time'=>array('elt',$end_time)))->select();
    	$where = "tokenTall='".$shop."' and status=4 and add_time>='".$start_time."' and add_time<='".$end_time."'";
    	//Log::write($where);
    	$orders = M('item_order')->where($where)->select();
    	
    	if ($orders) {
	    	//生成账单号
	    	$num = date("Y-m-dH-i-s");
	    	$num = str_replace("-","",$num);
	    	$num .= rand(1000,2000);
	    		    	
	    	//生成明细数据
	    	$dtl_data = array();
	    	$dtl = array();
	    	$orders_totalamt = 0;
	    	foreach ($orders as $key => $value){
	    		$dtl_data['billnum'] = $num;
	    		$dtl_data['itemno'] = intval($key)+1;
	    		$dtl_data['orderId'] = $value['orderId'];
	    		$dtl_data['goods_sumPrice'] = $value['goods_sumPrice'];
	    		$dtl_data['order_sumPrice'] = $value['order_sumPrice'];
	    		
	    		$dtl[] = $dtl_data;
	    		
	    		$orders_totalamt = $orders_totalamt + floatval($value['order_sumPrice']);
	    		
	    	}
	    	//生成汇总数据
	    	$mst_data = array();
	    	$mst_data['billnum'] = $num;
	    	$mst_data['status'] = 0;
	    	$mst_data['gen'] = $_SESSION['username'];
	    	$mst_data['gen_time'] = time();
	    	$mst_data['start_time'] = $start_time;
	    	$mst_data['end_time'] = $end_time;
	    	$mst_data['totalamt'] = $orders_totalamt;
	    	$rate = M('set_tax')->field('shoptax')->where(array('id'=>1))->find();
	    	$mst_data['rate'] = $rate['shoptax'];
	    	$mst_data['yingjie'] = floatval($orders_totalamt) * (1 - floatval($rate['shoptax']));
	    	$mst_data['tokenTall'] = $shop;
	    	
	    	//写入主从表
	    	foreach ($dtl as $value){
	    		$dtlrst = $this->_mod_bill_dtl->add($value);
	    		if ($dtlrst) {
	    		}else{
	    			$rtn['success'] = false;
	    			$rtn['msg'] = '生成账单失败！';
	    			return $rtn;
	    		}
	    	}
	    	
	    	$mstrst = $this->_mod_bill_mst->add($mst_data);
	    	if ($mstrst) {
	    	}else{
	    		$rtn['success'] = false;
	    		$rtn['msg'] = '生成账单失败！';
	    		return $rtn;
	    	}
	    	
	    	$rtn['success'] = true;
	    	$rtn['msg'] = $num;
	    	return $rtn;
    	}else{
    		$rtn['success'] = false;
    		$rtn['msg'] = '该时间段内没有已完成订单！';
    		return $rtn;
    	}
    }
    
    
    
}