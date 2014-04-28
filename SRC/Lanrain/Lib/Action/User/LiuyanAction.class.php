<?php
/**
 *文本回复
**/
class LiuyanAction extends UserAction{
	//留言列表
	public function index(){
		$db=D('Liuyan');
		
		/*$where['u1id']=session('uid');
		$where['token']=session('token');
		$count=$db->where($where)->count();
		$page=new Page($count,25);
		$info=$db->where($where)->order('createtime DESC')->limit($page->firstRow.','.$page->listRows)->select();
		/*foreach($info as $ke=>$va){
			$info[$ke]['tiaourl'] = rtrim(C('site_url'), '/') . U('Wap/Index/content', array('token' => $where['token'],'id' => $va['id']));
		}
		foreach($info as $ke=>$va){
			if(empty($va['uid'])){
				$info[$ke]['uid'] = U('liuyan/index');
			}
		}
		$this->assign('page',$page->show());
		$this->assign('info',$info);*/
		
		//$where['uid']=session('uid');
		$where['token']=session('token');
		// print_r($where);
		$count=$db->where($where)->count();
		$page=new Page($count,25);
		$info=$db->where($where)->order('createtime DESC')->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('page',$page->show());
		$this->assign('username',$username);
		$this->assign('info',$info);
		$this->display();
	}
	//添加留言试图
	public function add(){
		//$class=M('Classify')->where(array('token'=>session('token')))->select();
		//if($class==false){$this->error('请先添加3G网站分类',U('Classify/index',array('token'=>session('token'))));}
		//$db=M('Classify');
		//$where['token']=session('token');
		// $info=$db->where($where)->select();
		//$info=$db->select();
		//$info=$db->where($where)->order('createtime DESC')->limit($page->firstRow.','.$page->listRows)->select();
		// $this->assign('info',$info);
		$this->uid = session('uid');
		$this->token = session('token');
		$this->uptatetime = time();
		$this->createtime = time();
		$this->display();
	}
	//添加留言处理
	public function runAdd(){

		if(IS_POST){
			if($_POST['re']==''){
				$_POST['updatetime'] = null;
			}
			$db = D('Liuyan');
			if($db->add($_POST)){
				$this->success('添加成功',U('Liuyan/index'));
			}else{
				$this->error('添加失败');
			}
			
		}else{
			$this->error('非法操作');
		}
	}
	//回复留言视图
	public function edit(){
		//$db=M('Classify');
		// $where['token']=session('token');
		// $info=$db->where($where)->select();
		// $where['id']=$this->_get('id','intval');
		// $where['uid']=session('uid');
		// $res=D('liuyan')->where($where)->find();
		// $this->assign('info',$res);
		// $this->assign('res',$info);
		$db = D('Liuyan');
		$this->uid = session('uid');
		$this->token = session('token');
		$this->uptatetime = time();
		$id = $_GET['id'];
		$this->info = $db->find($id);
		$this->display();
	}
	public function runEdit(){
		if(IS_POST){
			$db = D('Liuyan');
			if($db->save($_POST)){
				$this->success('回复成功',U('Liuyan/index'));
			}else{
				$this->error('回复失败');
			}
			
		}else{
			$this->error('非法操作');
		}
	}
	//删除留言 
	public function del(){
		// $where['id']=$this->_get('id','intval');
		// $where['uid']=session('uid');
		// if(D(MODULE_NAME)->where($where)->delete()){
			// M('Keyword')->where(array('pid'=>$id,'token'=>session('token'),'module'=>'liuyan'))->delete();
			// $this->success('操作成功',U(MODULE_NAME.'/index'));
		// }else{
			// $this->error('操作失败',U(MODULE_NAME.'/index'));
		// }
		$id = $_GET['id'];
		if(IS_GET){
			$db = D('Liuyan');
			if($db->delete($id)){
				$this->success('删除成功',U('Liuyan/index'));
			}else{
				$this->error('删除失败');
			}
			
		}else{
			$this->error('非法操作');
		}
	}
	
}
?>