<?php
class Alipay_configAction extends UserAction{
	public $alipay_config_db;
	public function _initialize() {
		parent::_initialize();
		$this->alipay_config_db=M('Alipay_config');
		if (!$this->token){
			exit();
		}
	}
	public function index(){
		$config = $this->alipay_config_db->where(array('token'=>$this->token))->find();
		if(IS_POST){
			$row['pid']=$this->_post('pid');
			$row['key']=$this->_post('key');
			$row['name']=$this->_post('name');
			$row['token']=$this->_post('token');
			$row['open']=$this->_post('open');
			if ($config){
				$where=array('token'=>$this->token);
				$this->alipay_config_db->where($where)->save($row);
			}else {
				$this->alipay_config_db->add($row);
			}
			$this->success('设置成功',U('Alipay_config/index',$where));
		}else{
			$this->assign('config',$config);
			$this->display();
		}
	}
}


?>