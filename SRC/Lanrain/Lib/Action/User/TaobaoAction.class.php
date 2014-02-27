<?php
class TaobaoAction extends UserAction{
	public function index(){
		if($this->_get('token')!=session('token')){$this->error('非法操作');}
		
		//检查权限和功能
		$this->checkauth('api','api');
		
		if(IS_POST){
			$data['keyword']=$this->_post('keyword');
			$data['token']=$this->_get('token');
			$data['time']=time();
			$data['title']=$this->_post('title');
			$data['picurl']=$this->_post('picurl');
			$data['homeurl']=$this->_post('homeurl');
			if($data['keyword']&&$data['title']&&$data['picurl']&&$data['homeurl']){
				$sql=M('Taobao')->data($data)->add();
				if($sql){
					$this->success('操作成功');
				}else{
					$this->error('服务繁忙，请稍候再试');
				}
			}else{
				$this->error('所有表单都必须填写');
			}
		}else{
			$data=M('Taobao')->where(array('token'=>$this->_get('token')))->find();
			$this->assign('taobao',$data);
			$this->display();
		}
	}
	public function edit(){
		if(IS_POST){
			$data['keyword']=$this->_post('keyword');
			$data['title']=$this->_post('title');
			$data['picurl']=$this->_post('picurl');
			
			$data['homeurl']=$this->_post('homeurl');
			if($data['keyword']&&$data['title']&&$data['homeurl']){
				$sql=M('Taobao')->where(array('token'=>$this->_get('token')))->save($data);
				if($sql){
					$this->success('操作成功');
				}else{
					$this->error('服务繁忙，请稍候再试');
				}
			}else{
				$this->error('非法操作');
			}
		}	
	}
}

?>