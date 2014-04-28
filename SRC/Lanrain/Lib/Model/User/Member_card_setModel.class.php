<?php
	class Member_card_setModel extends Model{
	protected $_validate = array(
			array('cardname','require','会员卡名称不能为空',1),
			array('msg','require','提示信息不能为空',1),
	 );
	protected $_auto = array (    
	array('status','0'),  // 新增的时候把status字段设置为1   
	array('create_time','time',1,'function'), // 对create_time字段在更新的时候写入当前时间戳);
	);
}

?>