<?php
class UserAction extends BaseAction{
	protected function _initialize(){
		parent::_initialize();
		$userinfo=M('User_group')->where(array('id'=>session('gid')))->find();
		$users=M('Users')->where(array('id'=>$_SESSION['uid']))->find();
		$this->assign('thisUser',$users);
		//dump($users);
		$this->assign('viptime',$users['viptime']);
		if(session('uid')){
			if($users['viptime']<time()){
				session(null);
				session_destroy();
				unset($_SESSION);
				$this->error('您的帐号已经到期，请充值后再使用');
			}
		}
		$wecha=M('Wxuser')->field('wxname,wxid,headerpic,weixin')->where(array('token'=>session('token'),'uid'=>session('uid')))->find();
		$this->assign('wecha',$wecha);
		$this->assign('token',session('token'));
		//
		$this->assign('userinfo',$userinfo);
		if(session('uid')==false){
			$this->redirect('Home/Index/login');
		}
	}
	
	public function checkauth($funname, $modname){
		//检查权限
		$func = M('Function')->where(array('funname'=>$funname))->find();
		if ($func['gid'] > session('gid')) {
			$this->error('您没有该模块的使用权限,请升级您的账号！');
		}
		
		//检查模块是否勾选
		$token_open=M('token_open')->field('queryname')->where(array('token'=>session('token')))->find();
		if(!strpos($token_open['queryname'],$modname)){
			$this->error('您还未开启该模块的使用,请到功能模块中添加！',U('Function/index',array('token'=>session('token'),'id'=>session('wxid'))));
		}
	}
}
