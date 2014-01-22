<?php
/**
 *网站后台
 *@package YiCms
 *@author YiCms
 **/
class SystemAction extends BackAction{
	
	public function index(){
		$where['display']=1;
		$where['status']=1;
		$order['sort']='asc';
		$nav=M('node')->where($where)->order($order)->select();	
		$roleid["role_id"] = session('roleid');
		$roleid["level"] = array(array('eq',0),array('eq',1), 'or');
		$access = M('access')->where($roleid)->select();   
		foreach ($nav as $menuNav){
			foreach ($access as $acessnav){
				if($menuNav["id"] == $acessnav["node_id"]){
					$navNode[] = $menuNav;
				}
			}
		}	
		$this->assign('nav',$navNode);
		$this->display();
	}
	
	public function menu(){
		if(empty($_GET['pid'])){
			$where['display']=2;
			$where['status']=1;
			$where['pid']=2;
			$where['level']=2;
			$order['sort']='asc';
			$nav=M('node')->where($where)->order($order)->select();			
			$this->assign('nav',$nav);
		}else{
			$roleid["pid"] = $_GET['pid'];
			$roleid["role_id"] = session('roleid');
			$roleid["level"] = array(array('neq',0),array('neq',1), 'and');
			$access = M('access')->where($roleid)->select();
			$where['title'] = array(array('neq',"首页"));
			$nav=M('node')->where($where)->select();
			foreach ($nav as $menuNav){
				foreach ($access as $acessnav){
					if($menuNav['id'] == $acessnav["node_id"]){
						$navNode[] = $menuNav;
					}
				}
			}
			$this->assign('nav',$navNode);
		}
		$this->display();
	}
	
	public function main(){
		$this->display();
	}
}