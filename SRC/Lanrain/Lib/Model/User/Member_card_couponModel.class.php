<?php
class Member_card_couponModel extends Model{
	protected $_validate = array(
			array('title','require','优惠卷名称不能为空',1),
			array('group','require','优惠卷会员组必须选择',1),
			array('type','require','优惠卷有效期必须选择',1),
			array('info','require','优惠卷介绍不能为空',1),
			array('people','require','领卷次数不能为空',1),
			array('enddate', 'checkdate', '结束时间不能小于开始时间',Model::MUST_VALIDATE,'callback',3),
			array('price', 'checktype', '选择现金抵用券,必须输入金额',Model::MUST_VALIDATE,'callback',3),
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
	function checktype(){	
		 if($_POST['type']==0){
			 if(empty($_POST['price'])){
				return false;	
			 }else{
				return true;
			 }
		}else{
			return true;
		}
	}
}

?>
