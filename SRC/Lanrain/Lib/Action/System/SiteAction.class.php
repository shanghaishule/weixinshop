<?php
class SiteAction extends BackAction{
	public function _initialize() {
        parent::_initialize();  //RBAC 验证接口初始化
    }
	
	public function index(){
		
		$this->display();
	}
	public function email(){
		
		$this->display();
	}	
	public function alipay(){
		$this->display();
	}
	public function safe(){
		$this->display();
	}
	public function upfile(){
		$this->display();
	}
	public function insert(){
		$file=$this->_post('files');
		unset($_POST['files']);
		unset($_POST[C('TOKEN_NAME')]);
		
		if($this->update_config($_POST,CONF_PATH.$file)){
			$this->success('操作成功',U('Site/index',array('pid'=>6,'level'=>3)));
		}else{
			$this->success('操作失败',U('Site/index',array('pid'=>6,'level'=>3)));
		}
	}
	
	private function update_config($config, $config_file = '') {
		!is_file($config_file) && $config_file = CONF_PATH . 'web.php';
		if (is_writable($config_file)) {
			//$config = require $config_file;
			//$config = array_merge($config, $new_config);
			//dump($config);EXIT;
			file_put_contents($config_file, "<?php \nreturn " . stripslashes(var_export($config, true)) . ";", LOCK_EX);
			@unlink(RUNTIME_FILE);
			return true;
		} else {
			return false;
		}
	}
}