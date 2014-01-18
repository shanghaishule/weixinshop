<?php
	class User_groupAction extends BackAction{
	
		public function index(){			
			$map = array();
			$UserDB = D('User_group');
			$count = $UserDB->where($map)->count();
			$Page       = new Page($count);// 实例化分页类 传入总记录数
			// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
			$nowPage = isset($_GET['p'])?$_GET['p']:1;
			$show       = $Page->show();// 分页显示输出
			$list = $UserDB->where($map)->order('id ASC')->page($nowPage.','.C('PAGE_NUM'))->select();			
			$this->assign('list',$list);
			$this->assign('page',$show);// 赋值分页输出
			$this->display();
		}
		public function add(){
			if(IS_POST){
				$this->all_insert();
			}else{
				$this->display();
			}			
		}
		public function edit(){
			if(IS_POST){
				$this->all_save();
			}else{
				$id = $this->_get('id','intval',0);
				if(!$id)$this->error('参数错误!');
				$info = D('User_group')->getGroup(array('id'=>$id));
				$this->assign('tpltitle','编辑');				
				$this->assign('info',$info);
				$this->display('add');			
			}			
		}
		public function del(){
			$id=$this->_get('id','intval',0);
			if($id==0)$this->error('非法操作');
			$info = D('User_group')->delete($id);
			if($info==false){
				$this->success('操作成功');		
			}else{
				$this->error('操作失败');
			}
		}
	
	
	}
?>