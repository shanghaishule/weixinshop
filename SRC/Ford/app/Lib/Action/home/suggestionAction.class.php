<?php
class suggestionAction extends frontendAction{
	public $liuyan_mod;
	
	public function _initialize(){
		parent::_initialize();
		$this->liuyan_mod = M('liuyan');
	}

	public function index(){
		$user = $this->_session('user_info');
		if ($user) {
			$uid = $user['id'];
			$username = $user['username'];
		}else{
			$uid = '0';
			$username = '匿名';
		}
		
		//dump($user);exit;
		$this->assign('uid',$uid);
		$this->assign('username',$username);
		
		$createtime = time();
		$this->assign('createtime',$createtime);
		$tokenTall = $this->getTokenTall();
		$this->assign('tokenTall',$tokenTall);
		
		$this->assign('wecha_id',$uid);
		
		$this->display();
	}

	public function add(){
		if($_POST){
			if ($this->liuyan_mod->create()) {
				if($this->liuyan_mod->add()){
					echo '您的留言已经成功提交！感谢您的大力支持！';
				}else{
					echo '很遗憾，您的留言保存失败了！';
				}
			}
		}
	}
	
	public function showinfo(){
		$liuyan = $this->liuyan_mod->select();
		$this->assign('liuyan',$liuyan);
		$this->display();
	}
}
?>