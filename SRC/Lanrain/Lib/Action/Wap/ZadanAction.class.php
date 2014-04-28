<?php
class ZadanAction extends BaseAction{
	public function index(){
		
		$agent = $_SERVER['HTTP_USER_AGENT']; 
		////if(!strpos($agent,"icroMessenger")) {
		//	echo '此功能只能在微信浏览器中使用';exit;
		//}
	 
		$token	  =  $this->_get('token');
		$wecha_id = $this->_get('wecha_id');
		if (!$wecha_id){
			$wecha_id='null';
		}
		
		$id 	  = $this->_get('id');
		$redata	  = M('Lottery_record');
		$where	  = array('token'=>$token,'wecha_id'=>$wecha_id,'lid'=>$id);
		$record   = $redata->where($where)->find();	
		if($record == Null){
			$redata->add($where);
			//sleep(1);
			$record =$redata->where($where)->find();
		} 

		$Lottery =	M('Lottery')->where(array('id'=>$id,'token'=>$token,'type'=>4))->find(); 
		$data = array();
		
		if ($Lottery['enddate'] < time()) {
			 $data['usenums'] = 3;
			 $data['endinfo'] = $Lottery['endinfo'];
			 $this->assign('Zadan',$data);
			 $this->display();
			 exit();
		}
		
			if ($record['islottery'] == 1) {
				
				$data['usenums'] = 2;
				$data['sncode']	 = $record['sn'];
				$data['uname']	 = $record['wecha_name'];				 
				$data['winprize']	= $record['prize'];
			}else{
			
				if ($record['usenums'] >= $Lottery['canrqnums'] ) {
					//次数已经达到限定
					$data['usenums'] = 1;
					$data['winprize']	= '抽奖次数已用完';
				}else{
					
					M('Lottery_record')->where(array('id'=>$record['id']))->setInc('usenums');
					$record = M('Lottery_record')->where(array('id'=>$record['id']))->find();
					$firstNum=intval($Lottery['fistnums'])-intval($Lottery['fistlucknums']);
					$secondNum=intval($Lottery['secondnums'])-intval($Lottery['secondlucknums']);
					$thirdNum=intval($Lottery['thirdnums'])-intval($Lottery['thirdlucknums']);
					$fourthNum=intval($Lottery['fournums'])-intval($Lottery['fourlucknums']);
					$fifthNum=intval($Lottery['fivenums'])-intval($Lottery['fivelucknums']);
					$sixthNum=intval($Lottery['sixnums'])-intval($Lottery['sixlucknums']);
					$multi=intval($Lottery['canrqnums']);//最多抽奖次数
					$prize_arr = array(
					'0' => array('id'=>1,'prize'=>'一等奖','v'=>$firstNum,'start'=>0,'end'=>$firstNum),
					'1' => array('id'=>2,'prize'=>'二等奖','v'=>$secondNum,'start'=>$firstNum,'end'=>$firstNum+$secondNum),
					'2' => array('id'=>3,'prize'=>'三等奖','v'=>$thirdNum,'start'=>$firstNum+$secondNum,'end'=>$firstNum+$secondNum+$thirdNum),
					'3' => array('id'=>4,'prize'=>'谢谢参与','v'=>(intval($Lottery['allpeople']))*$multi-($firstNum+$secondNum+$thirdNum),'start'=>$firstNum+$secondNum+$thirdNum,'end'=>intval($Lottery['allpeople'])*$multi)
					);


					foreach ($prize_arr as $key => $val) { 
					    $arr[$val['id']] = $val; 
					} 
			 		if ($Lottery['allpeople'] == 1) {
	 
						if ($Lottery['fistlucknums'] <= $Lottery['fistnums']) {
							$rid = 1;	
						}else{
							$rid = 4;	
						}			
					 
					}else{
						$rid = $this->get_rand($arr,intval($Lottery['allpeople'])*$multi); 
					}
					
				
					$winprize = $prize_arr[$rid-1]['prize'];
					$zjl = false;
					
					switch($rid){
						case 1:
								 
							if ($Lottery['fistlucknums'] > $Lottery['fistnums']) {
								 $zjl = false; 
								 $winprize = '谢谢参与';
							}else{
								
								$zjl	= true;						
							    M('Lottery')->where(array('id'=>$id))->setInc('fistlucknums');
							}
						break;
							
						case 2:
							if ($Lottery['secondlucknums'] > $Lottery['secondnums']) {
									$zjl = false;
									$winprize = '谢谢参与';
							}else{
								//判断是否设置了2等奖&&数量
								if(empty($Lottery['second']) && empty($Lottery['secondnums'])){
									$zjl = false;
									$winprize = '谢谢参与';
								}else{ //输出中了二等奖
									$zjl	= true;						
									M('Lottery')->where(array('id'=>$id))->setInc('secondlucknums');
								}	 
								
							}
						break;
							
						case 3:
							if ($Lottery['thirdlucknums'] > $Lottery['thirdnums']) {
								 $zjl = false;
								 $winprize = '谢谢参与';
							}else{
								if(empty($Lottery['third']) && empty($Lottery['thirdnums'])){
									$zjl = false;
									$winprize = '谢谢参与';
								}else{  
									$zjl	= true;						
									M('Lottery')->where(array('id'=>$id))->setInc('thirdlucknums');
								}	 
								
							}
						break;
							
						default:
								$zjl = false;
								$winprize = '谢谢参与';
								break;
					}
				
				//$data['prizeid']  	= $rid;
				$data['zjl'] 		= $zjl;
				$data['wecha_id']	= $record['wecha_id'];		
				$data['lid']		= $record['lid'];			
				$data['winprize']	= $winprize;
			} //end if;
		} // end first if; 
		
		$data['usecout'] 	= intval($record['usenums']);
		$data['canrqnums']	= $Lottery['canrqnums'];
		$data['fist'] 		= $Lottery['fist'];
		$data['second'] 	= $Lottery['second'];
		$data['third'] 		= $Lottery['third'];
		$data['fistnums'] 	= $Lottery['fistnums'];
		$data['secondnums'] = $Lottery['secondnums'];
		$data['thirdnums'] 	= $Lottery['thirdnums'];		
		$data['info']		= $Lottery['info'];
		$data['endinfo']		= $Lottery['endinfo'];
		$data['txt']		= $Lottery['txt'];
		$data['sttxt']		= $Lottery['sttxt'];
		$data['title']		= $Lottery['title'];
		$data['statdate']	= $Lottery['statdate'];
		$data['enddate']	= $Lottery['enddate'];
	
		$this->assign('Zadan',$data);

		$prizeStr='<p>一等奖: '.$Lottery['fist'];
		if ($Lottery['displayjpnums']){
			$prizeStr.='奖品数量:'.$Lottery['fistnums'];
		}
		$prizeStr.='</p>';
		if ($Lottery['second']){
			$prizeStr.='<p>二等奖: '.$Lottery['second'];
			if ($Lottery['displayjpnums']){
				$prizeStr.='奖品数量:'.$Lottery['secondnums'];
			}
			$prizeStr.='</p>';
		}
		if ($Lottery['third']){
			$prizeStr.='<p>三等奖: '.$Lottery['third'];
			if ($Lottery['displayjpnums']){
				$prizeStr.='奖品数量:'.$Lottery['thirdnums'];
			}
			$prizeStr.='</p>';
		}
		$this->assign('prizeStr',$prizeStr);
		
		$this->display();
		
	}
	protected function get_rand($proArr,$total) { 
		    $result = 7; 
		    $randNum = mt_rand(1, $total); 
		    foreach ($proArr as $k => $v) {
		    	
		    	if ($v['v']>0){//奖项存在或者奖项之外
		    		if ($randNum>$v['start']&&$randNum<=$v['end']){
		    			$result=$k;
		    			break;
		    		}
		    	}
		    }
		    return $result; 
	}
	
	

	public function add(){
		if($_POST['action'] ==  'add'  ){
			$lid 				= $this->_post('lid');
			$wechaid 			= $this->_post('wechaid');
			$data['phone'] 		= $this->_post('tel');
			$data['wecha_name'] = $this->_post('wxname');
			$data['prize']		= $this->_post('prize');
			$data['islottery'] 	= 1;
			$data['time']		= time();
			$data['sn']			= uniqid();
			$rollback = M('Lottery_record')->where(array('lid'=> $lid,
				'wecha_id'=>$wechaid))->save($data);
			echo'{"success":1,"msg":"恭喜！尊敬的'.$data['wecha_name'].'请您保持手机通畅！请您牢记的领奖号:'.$data['sn'].'"}';
			exit;
		}
/*
		$record = M('Lottery_record');
		$data['phone'] 		= $this->_post('tel');
		$data['wecha_name'] = $this->_post('wxname');
		$data['islottery'] 	= 1;
		$data['time']		= time();
		$data['sn']			= uniqid();
		$rollback = $record->where(array('lid'=>$this->_post('lid') ,
				'wecha_id'=>$this->_post('wechaid') ))->save($data);
				
				*/
	}
	
}
?>