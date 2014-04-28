<?php
class FlashModel extends Model{
	protected $_validate =array(
		
	);
	
	protected $_auto = array (
		array('token','gettoken',self::MODEL_INSERT,'callback'),
	);
	
	public function gettoken(){
		return session('token');
	}
	
	
}