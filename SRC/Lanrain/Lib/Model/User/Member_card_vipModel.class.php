<?php
class Member_card_vipModel extends Model{
	protected $_validate = array(
			array('title','require','会员特权名称不能为空',1),
			array('group','require','会员特权组必须选择',1),
			array('type','require','有效期必须选择',1),
			array('info','require','会员卡名称不能为空',1),
			array('enddate', 'checkdate', '结束时间不能小于开始时间',Model::MUST_VALIDATE,'callback',3),
	 );
	protected $_auto = array (    
		array('statdate','strtotime',3,'function'), 
		array('enddate','strtotime',3,'function'), 
		
		array('token','getToken',Model:: MODEL_BOTH,'callback'), 
		array('create_time','time',1,'function'),
	);
	function getToken(){	
		return $_SESSION['token'];
	}
	function checkdate(){	
		 if(strtotime($_POST['enddate'])<strtotime($_POST['statdate'])){
			 return false;
		}else{
			return true;
		}
	}
}

?>
