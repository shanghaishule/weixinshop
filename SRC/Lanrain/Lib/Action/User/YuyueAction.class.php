<?php
//web
class YuyueAction extends UserAction{
	public $token;
	public $Yuyue_model;
	public $yuyue_order;
	//public $selfform_input_model;
	//public $selfform_value_model;
	public function _initialize() {
		parent::_initialize();
		
		//检查权限和功能
		$this->checkauth('Yuyue','Yuyue');
		

		$this->Yuyue_model=M('yuyue');
		$this->yuyue_order=M('yuyue_order');
		//$this->selfform_input_model=M('Selfform_input');
		//$this->selfform_value_model=M('Selfform_value');
		$this->token=session('token');
		$this->assign('token',$this->token);
		$this->assign('module','Yuyue');
		//dump($_SESSION);die;
	}
	
	//预约列表
	public function index(){
	
		// $where=array('token'=>$this->token);
		// if(IS_POST){
			// $key = $this->_post('searchkey');
			// if(empty($key)){
				// $this->error("关键词不能为空");
			// }
			// $where['title|man_name|girl_name|message|address'] = array('like',"%$key%");
			// $list = $this->Yuyue_model->where($where)->order('time DESC')->select();
			// $count      = $this->Yuyue_model->where($where)->count();
			// $Page       = new Page($count,20);
			// $show       = $Page->show();
			// $this->assign('key',$key);
		// }else {
			// $count      = $this->Yuyue_model->where($where)->count();
			// $Page       = new Page($count,20);
			// $show       = $Page->show();
			// $list = $this->Yuyue_model->where($where)->order('starttime DESC')->select();
		// }
		// $this->assign('list',$list);
		// $this->assign('page',$show);
		// $this->display();
		$where = array('token'=> $this->token);
		$count      = $this->Yuyue_model->where($where)->count();
		$Page       = new Page($count,20);
		$show       = $Page->show();
		$data = $this->Yuyue_model->where($where)->select();
		$this->assign('page',$show);
		$this->assign('data',$data);
		$this->display();
		
		
		
	}
	
	//添加预约
	public function add(){ 
		$_POST['token'] = $this->token;
		if(IS_POST){
			if($this->Yuyue_model->add($_POST)){
				$this->success('添加成功！',U('Yuyue/index'));
			}else{
				$this->error('添加失败！');
			}
		}else{
			$set=array();
			$set['time']=time()+10*24*3600;
			$this->assign('set',$set);
			$this->display('set');
		}
	}
	
	//修改预约
	public function set(){

        $id = intval($this->_get('id')); 
		$checkdata = $this->Yuyue_model->where(array('id'=>$id))->find();
		if(empty($checkdata)||$checkdata['token']!=$this->token){
            $this->error("没有相应记录.您现在可以添加.",U('Yuyue/add'));
        }	
		if(IS_POST){ 
            $where=array('id'=>$this->_post('id'),'token'=>$this->token);
			$check=$this->Yuyue_model->where($where)->find();
			if($check==false)$this->error('非法操作');
			if($this->Yuyue_model->create()){
				if($this->Yuyue_model->where($where)->save($_POST)){
					$this->success('修改成功',U('Yuyue/index',array('token'=>$this->token)));
					// $keyword_model=M('Keyword');
					// $keyword_model->where(array('token'=>$this->token,'pid'=>$id,'module'=>'Yuyue'))->save(array('keyword'=>$_POST['keyword']));
				}else{
					$this->error('操作失败');
				}
			}else{
				$this->error($this->Yuyue_model->getError());
			}
		}else{
		
			$this->assign('isUpdate',1);
			$this->assign('set',$checkdata);
			$this->display();	
		
		}
	}
	//删除预约
	public function del(){
		if($this->_get('token')!=$this->token){$this->error('非法操作');}
        $id = intval($this->_get('id'));
        if(IS_GET){                              
            $where=array('id'=>$id,'token'=>$this->token);
            $check=$this->Yuyue_model->where($where)->find();
            if($check==false)   $this->error('非法操作');

            $back=$this->Yuyue_model->where($where)->delete();
            if($back==true){
            	//$keyword_model=M('Keyword');
            	//$keyword_model->where(array('token'=>$this->token,'pid'=>$id,'module'=>'Yuyue'));
                $this->success('操作成功',U('Yuyue/index',array('token'=>$this->token)));
            }else{
                 $this->error('服务器繁忙,请稍后再试',U('Yuyue/index',array('token'=>$this->token)));
            }
        }        
	}
	//订单显示
	public function infos(){
		// $where['xid'] = $this->_get('id');
		// $where['token'] = $this->_get('token');
		// if(IS_POST){
		
			// $key = $this->_post('searchkey');
			// if(empty($key)){
				// $this->error("关键词不能为空");
			// }
		
			// $where['name|content'] = array('like',"%$key%");
			// $list = M('Zhufu')->where($where)->order('time DESC')->select();
			// $count      = M('Zhufu')->where($where)->count();
			// $Page       = new Page($count,20);
			// $show       = $Page->show();
			// $this->assign('key',$key);
		// }else {
			// $count      = M('Zhufu')->where($where)->count();
			
			// $Page       = new Page($count,20);
			// $show       = $Page->show();
			// $list=M('Zhufu')->where($where)->order('time DESC')->select();
		// }
		
		// $this->assign('list',$list);
		// $this->assign('page',$show);
		// $this->display();
		
		$data = $this->yuyue_order->select();
		$count = $this->Yuyue_model->where($where)->count();	
		$Page = new Page($count,20);
		$show = $Page->show();
		
		$this->assign('page',$show);
		$this->assign('data', $data);
		$this->display();
		
		
		
		
	}
	
	//删除订单
	public function delinfos(){
		if($this->_get('token')!=$this->token){$this->error('非法操作');}
        $id = intval($this->_get('id'));
        if(IS_GET){                              
            $where=array('id'=>$id,'token'=>$this->token);
            $check=M('yuyue_order')->where($where)->find();
            if($check==false)   $this->error('非法操作');
            $back=M('yuyue_order')->where($where)->delete();
            if($back==true){
            	//$keyword_model=M('Keyword');
            	//$keyword_model->where(array('token'=>$this->token,'pid'=>$id,'module'=>'Yuyue'));
                $this->success('操作成功',U('Yuyue/infos',array('token'=>$this->token,'id'=>$check['xid'])));
            }else{
                 $this->error('服务器繁忙,请稍后再试',U('Yuyue/infos',array('token'=>$this->token,'id'=>$check['xid'])));
            }
        }        
	}
	
	//处理订单
	public function setType(){
		if($this->_get('token')!=$this->token){$this->error('非法操作');}
        $id = intval($this->_get('id'));
		$type = intval($this->_get('type'));
        if(IS_GET){                              
			$where = array(
				'id'=> $id,
				'token'=> $this->token,
			);
			$data = array(
				'type'=> $type
			);
			if($this->yuyue_order->where($where)->setField($data)){
				$this->success('修改成功！',U('Yuyue/infos',array('token'=>$this->token)));
			}else{
				$this->error('修改失败！');
			}
        }
	}
	
	public function inputs(){
		$where['xid'] = $this->_get('id');
		$where['token'] = $this->_get('token');
		if(IS_POST){
			$key = $this->_post('searchkey');
			if(empty($key)){
				$this->error("关键词不能为空");
			}

			$where['name'] = array('like',"%$key%");
			$list = M('Canyu')->where($where)->order('time DESC')->select();
			$count      = M('Canyu')->where($where)->count();
			$Page       = new Page($count,20);
			$show       = $Page->show();
			$this->assign('key',$key);
		}else {
			$count      = M('Canyu')->where($where)->count();
			
			$Page       = new Page($count,20);
			$show       = $Page->show();
			$list=M('Canyu')->where($where)->order('time DESC')->select();
		}
		$num = 0;
		foreach($list as $key=>$val){
			$num += $val['number'];
		}
		
		$this->assign('num',$num);
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->display();
	}
}


?>