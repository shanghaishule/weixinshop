<?php
class ApiAction extends UserAction{
	public function index(){
		$token_open=M('token_open')->field('queryname')->where(array('token'=>session('token')))->find();
		if(!strpos($token_open['queryname'],'api')){
			$this->error('您还开启该模块的使用权,请到功能模块中添加',U('Function/index',array('token'=>session('token'),'id'=>session('wxid'))));
		}
		$data=D('Api');
		$this->assign('api',$data->where(array('token'=>session('token'),'uid'=>session('uid')))->select());
		if(IS_POST){
			$_POST['uid']=SESSION('uid');
			$_POST['token']=SESSION('token');
			if($data->create()){				
				if($data->add()){
					$this->success('操作成功');					
				}else{
					$this->error('服务器繁忙，请稍候再试');
				}			
			}else{			
				$this->error($data->getError());
			}
		}else{
			$this->display();
		}
	}
	public function add(){
		$data=D('Api');
		if(IS_POST){
			$_POST['uid']=SESSION('uid');
			$_POST['token']=SESSION('token');
			//if(empty($_POST['home']))unset($_POST['home']);
			if($data->create()){				
				if($data->add()){
					$this->success('操作成功');					
				}else{
					$this->error('服务器繁忙，请稍候再试');
				}			
			}else{			
				$this->error($data->getError());
			}
		
		}else{
			$this->display();
		}
	}
	public function edit(){
		$data=D('Api');
		if(IS_POST){
			$_POST['token']=session('token');
			$_POST['uid']=session('uid');
			$_POST['id']=$this->_get('id','intval');
			if($data->create()){
				if($data->save()!=false){
					$this->success('操作成功');					
				}else{
					$this->error('服务器繁忙，请稍候再试');
				}			
			}else{			
				$this->error($data->getError());
			}
		}else{
			$api=$data->where(array('token'=>session('token'),'uid'=>session('uid'),'id'=>$this->_get('id','intval')))->find();
			if($api==false){$this->error('非法操作');}
			$this->assign('api',$api);
			$this->display('add');	
		}
	}
	public function setInc(){
		if($this->_get('id')==true){
			$data=D('Api');
			$vo['id']=$this->_get('id','intval');
			$vo['token']=session('token');
			$set=$data->where($vo)->find();
			if($set!=false){
				$type=$this->_get('type','intval');
				if($type==1){
					$back=$data->where($vo)->setInc('status');
					if($back!=false){
						$this->success('操作成功');
					}else{
						$this->error('操作失败');
					}
				}else{
					$back=$data->where($vo)->setDec('status');
					if($back!=false){
						$this->success('操作成功');
					}else{
						$this->error('操作失败');
					}
				}
			}else{
				$this->error('无权限修改');
			}
		}else{
			$this->error('非法操作');
		}
	
	}
	public function del(){
		$data['id']=$this->_get('id','intval');
		$data['token']=session('token');
		$re=M('Api')->where($data)->find();
		if($re==false){
			$this->error('非法操作');
		}else{
			$del=M('Api')->where($data)->delete();
			if($del==false){
				$this->error('服务器繁忙');
			}else{
				$this->success('删除成功');
			}
		}
	}




}


?>