<?php
	class LotteryModel extends Model{
	protected $_validate = array(
			array('keyword','require','关键词不能为空',1),
			array('title','require','兑奖信息不能为空',1),
			array('sttxt','require','简介不能为空',1),
			array('statdate','require','开始时间不能为空',1),
			array('enddate','require','结束时间不能为空',1),
			array('info','require','活动说明不能为空',1),
			//array('aginfo','require','重复抽奖信息不能为空',1),
			array('endtite','require','活动结束公告内容不能为空',1),
			array('endinfo','require','活动结束说明不能为空',1),
			array('fist','require','一等奖奖品不能为空',1),
			array('fistnums','require','一等奖奖品数量不能为空',1),
			array('allpeople','require','预计抽奖人数不能为空',1),
	 );
	protected $_auto = array (    
	array('status','0'),  // 新增的时候把status字段设置为1   
	array('createtime','time',1,'function'), // 对create_time字段在更新的时候写入当前时间戳);
	);
}

?>