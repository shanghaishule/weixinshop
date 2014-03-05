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
			/*
			$where['display']=2;
			$where['status']=1;
			$where['pid']=2;
			$where['level']=2;
			$order['sort']='asc';
			$nav=M('node')->where($where)->order($order)->select();
			$this->assign('nav',$nav);
			
			$title = M('node')->where('id=2')->find();
			$this->assign('title',$title[title]);
			*/
			$this->assign('title',"欢迎");
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
		$shop_mod = M('wecha_shop');
		$shop_cnt = $shop_mod->count();
		//$shop_info = $shop_mod->select();
		
		$order_mod = M('item_order');
		$order_cnt = $order_mod->where('status=4')->count();
		$order_amt = $order_mod->where('status=4')->sum('order_sumPrice');
		
		$this->assign('shop_cnt',$shop_cnt);
		$this->assign('order_amt',$order_amt);
		$this->display();
	}
}