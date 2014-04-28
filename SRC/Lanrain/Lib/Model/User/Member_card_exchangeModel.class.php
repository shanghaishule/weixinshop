<?php
class Member_card_exchangeModel extends Model{
	protected $_validate = array(
			array('everyday','require','每天签到奖励积分必填',1),
			array('continuation','require','连续签到奖励积分必填',1),
			array('reward','require','消费1元奖励积分必须填写',1),
			array('cardinfo','require','会员卡使用说明必须填写',1),
			array('cardinfo2','require','积分规则说明必须填写',1),
			array('id','checkid','非法操作',2,'callback',2),
	 );
	protected $_auto = array (		
		array('token','getToken',Model:: MODEL_BOTH,'callback'),
	);
	function checkid(){
		$dataid=$this->field('id')->where(array('id'=>$_POST['id'],'token'=>session('token')))->find();
		if($dataid==false){
			return false;
		}else{
			return true;
		}
	}
	function getToken(){	
		return $_SESSION['token'];
	}
}

?>
