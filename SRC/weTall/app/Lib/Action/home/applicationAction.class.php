<?php
class applicationAction extends frontendAction{
	public $application_mod;
	
	public function _initialize(){
		parent::_initialize();
		$this->application_mod = M('application');
	}

	public function index(){
		$user = $this->_session('user_info');
		if ($user) {
			$uid = $user['id'];
			$username = $user['username'];
			$umail = $user['email'];
		}else{
			$uid = '0';
			$username = '匿名';
			$umail = '';
		}
		
		//dump($user);exit;
		$this->assign('uid',$uid);
		$this->assign('username',$username);
		$this->assign('umail',$umail);
		
		$createtime = time();
		$this->assign('createtime',$createtime);
		$tokenTall = $this->getTokenTall();
		$this->assign('tokenTall',$tokenTall);
		
		$this->assign('wecha_id',$uid);
		
		$this->display();
	}

	public function add(){
		if($_POST){
			if ($this->application_mod->create()) {
				if($this->application_mod->add()){
					echo '您的开店申请已经成功提交！我们会尽快与您联系！';
				}else{
					echo '很遗憾，您的申请失败了！';
				}
			}
		}
	}
	
	public function showinfo(){
		$application = $this->application_mod->select();
		$this->assign('application',$application);
		$this->display();
	}
}
?>