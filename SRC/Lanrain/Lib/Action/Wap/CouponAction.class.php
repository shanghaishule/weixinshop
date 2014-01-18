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
		$Lottery 	= $this->lottory_db->where(array('id'=>$id,'token'=>$token,'type'=>3,'status'=>1))->find();
		$this->assign('lottery',$Lottery);
		//var_dump($Lottery);
		//0. 判断优惠券是否领完了
		if($Lottery['fistlucknums']  == $Lottery['fistnums'] && 
		   $Lottery['secondlucknums'] == $Lottery['secondnums'] && 
		   $Lottery['thirdlucknums']  == $Lottery['thirdnums']){		  	
		   $data['end'] = 1;
		   //$data['msg'] = "您来晚了,优惠券已经被领完了.";
			 
		}else{
			if ($Lottery['enddate'] < time()) { //过期
			         echo $Lottery['enddate'];
				 $data['end'] = 2;
				 $data['endinfo'] = $Lottery['endinfo'];				 
				 $data['endimg']  = empty($Lottery['endpicurl']) ? 1 : $Lottery['endpicurl']; 
			}else{
				//2.活动还没过期,接着是否领过了
				if ($record['islottery'] == 1) {
					 $data['end'] = 3;
					 $data['msg'] = "您已经领取过优惠券了";
					 $data['wxname']=$record['wecha_name'];	
					 $data['sn']  = $record['sn'];	
					 $data['myprize'] 	= $record['prize'];	 
				}else{ 
					
					//是否已经够次数
					if ($record['usenums'] >= $Lottery['canrqnums'] ) {
						$data['prizetype'] = 4; //啥都没了
					  	$data['zjl']	  = 0;
						$data['usenums']  = $record['usenums'];
					  	$data['winprize']	   = "抽奖次数已经用完";
						//exit;	
					}else{
						//3.没有领过,次数没达到,开始随机发放优惠券
						$this->lottory_record_db->where(array('id'=>$record['id']))->setInc('usenums');
						$record['usenums']=intval($record['usenums'])+1;
						//排除没有设置的优惠券
						//奖品数 != 已经领取该奖品数 => 还有奖品
						$prizeType=intval($this->get_prize($Lottery));
						switch ($prizeType){
							default:
								$data['prizetype'] = 4; //啥都没了
								$data['zjl']	  = 0;
								$data['winprize']	   = "真不走运，没有抽中";
								break;
							case 1:
								$data['prizetype'] = 1; 
								$data['sncode'] = uniqid();
								$data['winprize']	   = $Lottery['fist'];
								$data['zjl']	   = 1;
								$this->lottory_db->where(array('id'=>$id))->setInc('fistlucknums');
								break;
							case 2:
								$data['prizetype'] = 2; 
								$data['winprize']  = $Lottery['second'];
								$data['zjl']	   = 1;
								$data['sncode']    = uniqid();
								$this->lottory_db->where(array('id'=>$id))->setInc('secondlucknums');
								break;
							case 3:
								$data['prizetype'] = 3;
								$data['winprize']	   = $Lottery['third'];
								$data['zjl']	   = 1;
								$data['sncode'] = uniqid();
								$this->lottory_db->where(array('id'=>$id))->setInc('thirdlucknums');
								break;
						}  	
				  	 
				   }//以上没领过
				}//在没达到次数 
			}
			
		} 
	
		$data['token'] 		= $token;
		$data['wecha_id']	= $record['wecha_id'];		
		$data['lid']		= $record['lid'];
		$data['rid']		= $record['id']; 
		$data['phone']		= $record['phone']; 
		$data['usenums']	= $record['usenums'];
		$data['sendtime']	= $record['sendtime'];
		$data['canrqnums']	= $Lottery['canrqnums'];
		$data['fist'] 		= $Lottery['fist'];
		$data['second'] 	= $Lottery['second'];
		$data['third'] 		= $Lottery['third'];
		$data['fistnums'] 	= $Lottery['fistnums'];
		$data['secondnums'] = $Lottery['secondnums'];
		$data['thirdnums'] 	= $Lottery['thirdnums'];	
		$data['info']		= $Lottery['info'];
		$data['aginfo']		= $Lottery['aginfo'];
		$data['txt']		= $Lottery['txt'];
		$data['sttxt']		= $Lottery['sttxt'];
		$data['title']		= $Lottery['title'];
		$data['statdate']	= $Lottery['statdate'];
		$data['enddate']	= $Lottery['enddate'];		
		$this->assign('Coupon',$data);
		//var_dump($data);exit();
		$this->display();
	}
	
	//中奖后填写信息
	public function add(){
		 if($_POST['action'] ==  'add' ){
			$lid 				= $this->_post('lid');
			$wechaid 			= $this->_post('wechaid');
			$data['sn']			= $this->_post('sncode');
			$data['phone'] 		= $this->_post('tel');
			$data['prize']		= $this->_post('winprize');
			$data['wecha_name'] = $this->_post('wxname');
			$data['time']		= time(); 
			$data['islottery']	= 1;
			$data['usenums']	= 1;			

			$rollback = $this->lottory_record_db->where(array('lid'=> $lid,
				'wecha_id'=>$wechaid))->save($data);
			
			echo'{"success":1,"msg":"恭喜！尊敬的<font color=red>'.$data['wecha_name'].'</font>请您保持手机通畅！你的领奖序号:<font color=red>'.$data['sn'].'</font>"}';
			exit;	
		}
	}
	public function exchange(){
		 if(IS_POST){
		 	$Lottery 	= $this->lottory_db->where(array('id'=>intval($_POST['id']),'type'=>3))->find();
		 	if ($Lottery['parssword']!=trim($this->_post('parssword'))){
		 		echo'{"success":0,"msg":"兑奖密码不正确"}';exit;
		 	}else {
		 		$data['sendtime']		= time(); 
		 		$data['sendstutas']	= 1;
		 		$this->lottory_record_db->where(array('id'=> intval($_POST['rid'])))->save($data);
		 		echo'{"success":1,"msg":"兑奖成功"}';
		 	}
		}
	}
}
	
?>