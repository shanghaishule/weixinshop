<?php
/**
 *用户案例
**/
class CaseAction extends BackAction{
	public function index(){
		$db=D('Case');
		F('case',null);
		$case=$db->where('status=1')->limit(32)->select();
		F('case',$case);
		$count=$db->count();
		$page=new Page($count,25);
		$info=$db->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('info',$info);
		$this->assign('page',$page->show());
		$this->display();
	}
	public function add(){
		$this->display();
	}
	
	public function edit(){
		$id=$this->_get('id','intval');
		$info=D('Case')->find($id);
		$this->assign('info',$info);
		$this->display('add');
	}
	
	public function del(){
		$db=D('Case');
		$id=$this->_get('id','intval');
		if($db->delete($id)){
			$this->success('操作成功',U(MODULE_NAME.'/index'));
		}else{
			$this->error('操作失败',U(MODULE_NAME.'/index'));
		}
	}
	
	public function insert(){
		$thumb['width']='48';
		$thumb['height']='48';
		$arr=$this->_upload($_FILES['img'],$dir='',$thumb);
		if($arr['error']===0){
			$_POST['img']=C('site_url').$arr['info'][0]['savepath'].$arr['info'][0]['savename'];
		}else{
			$this->error($arr['info'],U('Case/index'));
		}
		$db=D('Case');
		if($db->create()){
			if($db->add()){
				$this->success('操作成功',U('Case/index'));
			}else{
				unlink($arr['info'][0]['savepath'].$arr['info'][0]['savename']);
				$this->error('操作成功',U('Case/index'));
			}
		}else{
			$this->error($db->getError(),U('Case/index'));
		}
	}
	
	public function upsave(){
		$db=D('Case');
		if($_POST['img']!=false){
			$thumb['width']='48';
			$thumb['height']='48';
			$arr=$this->_upload($_FILES['img'],$dir='',$thumb);
			if($arr['error']===0){
				$_POST['img']=C('site_url').$arr['info'][0]['savepath'].$arr['info'][0]['savename'];
			}else{
				$this->error($arr['info'],U('Case/index'));
			}
		}
		if($db->create()){
			if($db->save()){
				$this->success('操作成功',U('Case/index'));
			}else{
				unlink($arr['info'][0]['savepath'].$arr['info'][0]['savename']);
				$this->error('操作成功',U('Case/index'));
			}
		}else{
			$this->error($db->getError(),U('Case/index'));
		}
	}
	
}