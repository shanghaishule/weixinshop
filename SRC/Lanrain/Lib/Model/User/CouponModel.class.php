<?php
class CouponModel extends Model{

	protected $_validate = array(
			array('keyword','require','关键词不能为空',1),
			array('title','require','优惠券名称息不能为空',1),
			array('sttxt','require','筒介不能为空',1),
			array('statdate','require','开始时间不能为空',1),			
			array('enddate','require','结束时间不能为空',1),
			array('enddate', 'checkdate', '结束时间不能小于开始时间',Model::MUST_VALIDATE,'callback',3),
			array('info','require','活动说明不能为空',1),
			array('aginfo','require','兑换券使用说明不能为空',1),
			array('endtite','require','优惠券结束公告内容不能为空',1),
			array('endinfo','require','优惠券结束说明不能为空',1),
			array('fist','require','优惠券名称不能为空',1),
			array('fistnums','require','优惠券数量不能为空',1)
	 );
	protected $_auto = array (    
		array('status','0'),  // 新增的时候把status字段设置为1   
		array('statdate','strtotime',3,'function'), 
		array('enddate','strtotime',3,'function'), 
		array('token','getToken',Model:: MODEL_BOTH,'callback'), 
		array('id','getid',Model:: MODEL_BOTH,'callback'),
	);
	
	function getToken(){	
		return $_SESSION['token'];
	}
	
	function getid(){
		return $_GET['id'];
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