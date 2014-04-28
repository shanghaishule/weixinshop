<?php
class TextAction extends BackAction{

	public function index(){
		$img_db=D('Text');
		$wx_db=D('Wxuser');
		$count=$img_db->count();
		$page=new Page($count,25);
		$info=$img_db->limit($page->firstRow.','.$page->listRows)->select();
		foreach($info as $key=>$val){
			$where['token']=$val['token'];
			$where['uid']=$val['uid'];
			$res=$wx_db->where($where)->find();
			$info[$key]['wxname']=$res['wxname'];
			
		}
		$this->assign('page',$page->show());
		$this->assign('info',$info);
		$this->display();
	}
	
	// public function add(){
		// $this->display();
	// }
	
	// public function edit(){
		// $db=D('Article');
		// $id=$this->_get('id','intval');
		// $info=$db->find($id);
		// $this->assign('info',$info);
		// $this->display();
	// }
	
	// public function insert(){
		// C('TOKEN_ON',false);
		// $this->all_insert();
	// }
	
	// public function _update(){
		// C('TOKEN_ON',false);
		// $this->all_save();
	// }
	
	public function del(){
		C('TOKEN_ON',false);
		$id=$this->_get('id','intval');
		$pid=$this->_get('pid','intval');
		if(D('Text')->delete($id)){
			$this->success('操作成功',U(MODULE_NAME.'/index',array('pid'=>$pid)));
		}else{
			$this->error('操作失败',U(MODULE_NAME.'/index',array('pid'=>$pid)));
		}
	}
	
}