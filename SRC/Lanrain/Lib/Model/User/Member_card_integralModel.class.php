<?php
class Member_card_integralModel extends Model{
	protected $_validate = array(
			array('title','require','礼品券名称不能为空',1),
			array('integral','require','积分必须填写',1),
			array('statdate','require','结束时间与开始时间必须选择',1),
			array('enddate','require','结束时间与开始时间必须选择',1),
			
			array('enddate', 'checkdate', '结束时间不能小于开始时间',Model::MUST_VALIDATE,'callback',3),
			array('info','require','优惠卷介绍不能为空',1),
	 );
	protected $_auto = array (    
		array('statdate','strtotime',3,'function'), 
		array('enddate','strtotime',3,'function'), 
		array('token','getToken',Model:: MODEL_BOTH,'callback'), 
		array('create_time','time',1,'function'),
		array('id','getid',Model:: MODEL_BOTH,'callback'),
	);
	function getid(){
		return $_GET['id'];
	}
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
