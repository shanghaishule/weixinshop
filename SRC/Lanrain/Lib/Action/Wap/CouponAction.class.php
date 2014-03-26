<?php
class CouponAction extends LotteryBaseAction{
	public $token;
	public $wecha_id;
	public $lottory_record_db;
	public $lottory_db;
	public function __construct(){
		$agent = $_SERVER['HTTP_USER_AGENT'];
		if(!strpos($agent,"icroMessenger")) {
			//echo '此功能只能在微信浏览器中使用';exit;
		}
		$this->token=$this->_get('token');
		$this->wecha_id	= $this->_get('wecha_id');
		$this->lottory_record_db=M('Lottery_record');
		$this->lottory_db=M('Lottery');
		if (!defined('RES')){
			define('RES',THEME_PATH.'common');
		}
		if (!defined('STATICS')){
			define('STATICS',TMPL_PATH.'static');
		}
	}
	public function index(){
				
		$token		= $this->token;
		$wecha_id	= $this->wecha_id;
		$id 		= $this->_get('id');
		//0.判断是否有该用户记录,没有则记录		
		$redata		= $this->lottory_record_db;
		$where 		= array('token'=>$token,'wecha_id'=>$wecha_id,'lid'=>$id);
		$record 	= $redata->where($where)->find();	
		if($record == Null){
			$redata->add($where);
			$record = $redata->where($where)->find();
		}
		
		$Lottery = $this->lottory_db->where(array('id'=>$id,'token'=>$token,'type'=>3,'status'=>1))->find();
		$this->assign('lottery',$Lottery);
		
		$data['token'] 		= $token;
		$data['wecha_id']	= $record['wecha_id'];		
		$data['lid']		= $record['lid'];
		$data['rid']		= $record['id']; 
		$data['phone']		= $record['phone']; 
		$data['usenums']	= $record['usenums'];
		$data['sendtime']	= $record['sendtime'];
		$data['canrqnums']	= $Lottery['canrqnums'];
		$data['prize']	        = $record['prize'];
		$data['money']	        = $record['money'];
		$data['sn'] = $record['sn'];			
			
		$data['fist'] 		= $Lottery['fist'];
		$data['second'] 	= $Lottery['second'];
		$data['third'] 		= $Lottery['third'];
		$data['fistnums'] 	= $Lottery['fistnums'];
		$data['secondnums']     = $Lottery['secondnums'];
		$data['thirdnums'] 	= $Lottery['thirdnums'];	
		$data['info']		= $Lottery['info'];
		$data['aginfo']		= $Lottery['aginfo'];
		$data['txt']		= $Lottery['txt'];
		$data['sttxt']		= $Lottery['sttxt'];
		$data['title']		= $Lottery['title'];
		$data['startdate']	= $Lottery['startdate'];
		$data['enddate']	= $Lottery['enddate'];				
	
		$data['fistlvs'] 	= $Lottery['fistnums'] -$Lottery['fistlucknums'];
		$data['secondlvs'] 	= $Lottery['secondnums'] -$Lottery['secondlucknums'];
		$data['thirdlvs'] 	= $Lottery['thirdnums'] -$Lottery['thirdlucknums'];
		        
		$data['firstmoney']	= $Lottery['firstmoney'];
		$data['firststartdate']	= $Lottery['firststartdate'];
		$data['firstenddate']	= $Lottery['firstenddate'];		  
		$data['secondmoney']	= $Lottery['secondmoney'];
		$data['secondstartdate']= $Lottery['secondstartdate'];
		$data['secondenddate']	= $Lottery['secondenddate'];	
		
		$data['thirdmoney']	= $Lottery['thirdmoney'];
		$data['thirdstartdate']	= $Lottery['thirdstartdate'];
		$data['thirdenddate']	= $Lottery['thirdenddate'];	
		
		$data['firstmsg'] = $Lottery['firstmoney']."元特大优惠劵发放";
		$data['secondmsg'] = $Lottery['secondmoney']."元特大优惠劵发放";
		$data['thirdmsg'] = $Lottery['thirdmoney']."元特大优惠劵发放";		
			
		//判断优惠券是否领完了		
		if($Lottery['fistlucknums']  == $Lottery['fistnums'] && 
		   $Lottery['secondlucknums'] == $Lottery['secondnums'] && 
		   $Lottery['thirdlucknums']  == $Lottery['thirdnums']){		  	
		   $data['end'] = 1;
		}else{
			if ($Lottery['enddate'] < time()) { //过期
				 $data['end'] = 2;
				 $data['endinfo'] = $Lottery['endinfo'];				 
			}else{
				//2.活动还没过期,接着是否领过了
				if ($record['islottery'] == 1) {
					 $data['end'] = 3;
					 $data['msg'] = "您已经领取过优惠券了";
					 $data['wxname']=$record['wecha_name'];	
					
				}
			}
		} 
	
		//未开放
		if ($Lottery['fist'] == '') {
			$data['firstset'] = 1;
		}
		if ($Lottery['second'] =='') {
			$data['secondset'] = 1;
		}
		if ($Lottery['third'] == '') {
			$data['thirdset'] = 1;
		}	
		
		//过期,领完					
		if ($Lottery['firstenddate'] < time()) { 
			$data['firstend'] = 1;
			$data['firstmsg'] = $Lottery['firstmoney']."元优惠劵已过期";
		}else{
			if($Lottery['fistlucknums']  == $Lottery['fistnums']){
				$data['firstout'] = 1;
				$data['firstmsg'] = $Lottery['firstmoney']."元优惠劵已领完";
			}
		}
		
		if ($Lottery['secondenddate'] < time()) { 
			$data['secondend'] = 1;
			$data['secondmsg'] = $Lottery['secondmoney']."元优惠劵已过期";
		}else{
			if($Lottery['secondlucknums']  == $Lottery['secondnums']){
				$data['secondout'] = 1;
				$data['secondmsg'] = $Lottery['secondmoney']."元优惠劵已领完";
			}
		}
		
		if ($Lottery['thirdenddate'] < time()) { 
			$data['thirdend'] = 1;
			$data['thirdmsg'] = $Lottery['thirdmoney']."元优惠劵已过期";
		}else{
			if($Lottery['thirdlucknums']  == $Lottery['thirdnums']){
				$data['thirdout'] = 1;
				$data['thirdmsg'] = $Lottery['thirdmoney']."元优惠劵已领完";
			}
		}
	                	               	                
		 $this->assign('Coupon',$data);
		 	 
		 if($data['end'] == 3 || $data['end'] == 2||$data['end'] == 1 ){ 
		 	$this->display(result);
		 }else{		  
		 	$this->display();
		 }
		 		 		 
	}
		
	public function result(){
	        
	        $token = $this->token;
	        $dtype = $this->_get('dtype');
	        $wecha_id = $this->wecha_id;
	        $id = $this->_get('id');
	        $data['islottery']= 1;
	        $Lottery = $this->lottory_db->where(array('token'=>$token,'type'=>3,'status'=>1,'id'=>$id))->find();	       
	         
	        $data['sn']    = uniqid();        

	        
		switch ($dtype){
			default:
				break;//do nothing
			case "1":				
				$data['prize']  = $Lottery['fist'];
				$data['money']  = $Lottery['firstmoney'];	
				$data['startdate']  = $Lottery['firststartdate'];
				$data['enddate']  = $Lottery['firstenddate'];
				$this->lottory_db->where(array('token'=>$token,'type'=>3,'status'=>1,'id'=>$id))->setInc('fistlucknums');
				break;
			case "2":
				$data['prize']  = $Lottery['second'];
				$data['money']  = $Lottery['secondmoney'];	
				$data['startdate']  = $Lottery['secondstartdate'];
				$data['enddate']  = $Lottery['secondenddate'];			
				$this->lottory_db->where(array('token'=>$token,'type'=>3,'status'=>1,'id'=>$id))->setInc('secondlucknums');
				break;
			case "3":
				$data['prize']  = $Lottery['third'];
				$data['money']  = $Lottery['thirdmoney'];	
				$data['startdate']  = $Lottery['thirdstartdate'];
				$data['enddate']  = $Lottery['thirdenddate'];			
				$this->lottory_db->where(array('token'=>$token,'type'=>3,'status'=>1,'id'=>$id))->setInc('thirdlucknums');
				break;
		} 		
		
		$rollback = $this->lottory_record_db->where(array('wecha_id'=>$wecha_id,'lid'=>$id))->save($data);
		$this->assign('Coupon',$data);
		$this->display();


	}	
	
	public function my(){		
		
		$wecha_id = $this->wecha_id;					
		$m=M();					
		$selsql = "select * from tp_lottery a,tp_lottery_record b where a.token = b.token and a.id=b.lid and b.islottery =1 and b.wecha_id = '".$wecha_id."'";	
		$Lottery=$m->query($selsql);
		$this->assign('Info',$Lottery);
		$this->display();
	}	
	
}

	
?>