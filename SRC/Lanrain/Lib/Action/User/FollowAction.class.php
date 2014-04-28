<?php
/**
 *关注回复
**/
class FollowAction extends UserAction{
	public function index(){
		$db=D('Follow');
		$where['uid']=$_SESSION['uid'];
		$where['token']=$_SESSION['token'];
		$res=$db->where($where)->find();
		$this->assign('call',$res);
		$this->display();
	}
	public function sends(){
		$sms = new Sms("http://www.189lt.com:9000/servlet/UserServiceAPI","can","654123",1);
		$txt = $sms->sendsms("13257089190","开始咯");
	}
	public function insert(){
		C('TOKEN_ON',false);
		$db=D('Call');
		$where['uid']=$_SESSION['uid'];
		$where['token']=$_SESSION['token'];
		$res=$db->where($where)->find();
		if($res==false){
			$where['phone_account']=$this->_post('phone_account','trim');
			if(isset($_POST['phone_password'])){
				$where['phone_password']=$this->_post('phone_password','trim');
			}		
			if($where['phone_account']==false){$this->error('标题必须填写');}
			$id=$db->data($where)->add();
			if($id){
				$this->success('添加成功',U('Call/index'));
			}else{
				$this->error('添加失败',U('Call/index'));
			}
		}else{
			$where['id']=$res['id'];
			$where['phone_account']=$this->_post('phone_account','trim');

			if(isset($_POST['phone_password'])){
				$where['phone_password']=$this->_post('phone_password','trim');
			}		
			if($db->save($where)){
				$this->success('更新成功',U('Call/index'));
			}else{
				$this->error('更新失败',U('Call/index'));
			}
		}
	}
}
?>