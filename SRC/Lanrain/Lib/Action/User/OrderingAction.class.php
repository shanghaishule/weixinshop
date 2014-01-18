<?php
class OrderingAction extends UserAction{

	public function index(){
		$this->display();
	}
	
	public function add(){
		if(IS_POST){
			$this->error('功能内测中,您无内测资格！');
		}else{
			$this->display();
		}
	}
	//配置
	public function set(){
		$ordering=M('Ordering_set')->where(array('token'=>session('token')))->find();
		//dump($ordering);
		if(IS_POST){
			if($ordering==false){				
				$this->all_insert('Ordering_set','/set');
			}else{
				$_POST['id']=$ordering['id'];
				$this->all_save('Ordering_set','/set');				
			}
		}else{
			$this->assign('ordering',$ordering);
			$this->display();
		}
	}
	public function class_list(){
		if(IS_POST){
			$this->insert('Ordering_class','/class_list');			
		}else{
			$data=M('Ordering_class');
			$count      = $data->where(array('token'=>$_SESSION['token']))->count();
			$Page       = new Page($count,12);
			$show       = $Page->show();
			$list = $data->where(array('token'=>$_SESSION['token']))->limit($Page->firstRow.','.$Page->listRows)->order('sort desc')->select();	
			$this->assign('page',$show);		
			$this->assign('list',$list);
			$this->display();
		}	
	}
	public function class_edit(){
		if($this->_get('token')!=session('token')){$this->error('非法操作');}
		if(IS_POST){
			$check=M('Ordering_class')->field('id')->where(array('token'=>$_SESSION['token'],'id'=>$this->_post('id')))->find();
			if($check==false){$this->error('非法操作');}	
			$this->all_save('Ordering_class','/class_list');
		}else{
			$this->error('非法操作');
		}
	}
	public function class_del(){		
		if($this->_get('token')!=session('token')){$this->error('非法操作');}
		$check=M('Ordering_class')->field('id')->where(array('token'=>$_SESSION['token'],'id'=>$this->_get('id')))->find();
		if($check==false){$this->error('服务器繁忙');}	
		if(M('Ordering_class')->where(array('id'=>$check['id']))->delete()){
			//M('Ordering_list')->where(array('pid'=>$check['id']))->delete();
			$this->success('操作成功');
		}else{
			$this->error('服务器繁忙,请稍后再试');
		}	
	}
}



?>