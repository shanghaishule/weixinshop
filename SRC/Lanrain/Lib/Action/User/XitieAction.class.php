<?php
class XitieAction extends UserAction{
	public $token;
	public $xitie_model;
	//public $selfform_input_model;
	//public $selfform_value_model;
	public function _initialize() {
		parent::_initialize();
		$this->xitie_model=M('Xitie');
		//$this->selfform_input_model=M('Selfform_input');
		//$this->selfform_value_model=M('Selfform_value');
		$this->token=session('token');
		$this->assign('token',$this->token);
		$this->assign('module','Xitie');
	}
	public function index(){
		//检查权限和功能
		$this->checkauth('WeiXitie','WeiXitie');
		
		$where=array('token'=>$this->token);
		if(IS_POST){
			$key = $this->_post('searchkey');
			if(empty($key)){
				$this->error("关键词不能为空");
			}

			$where['title|man_name|girl_name|message|address'] = array('like',"%$key%");
			$list = $this->xitie_model->where($where)->order('time DESC')->select();
			$count      = $this->xitie_model->where($where)->count();
			$Page       = new Page($count,20);
			$show       = $Page->show();
			$this->assign('key',$key);
		}else {
			$count      = $this->xitie_model->where($where)->count();
			
			$Page       = new Page($count,20);
			$show       = $Page->show();
			$list=$this->xitie_model->where($where)->order('time DESC')->select();
		}
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->display();
		
	}
	public function add(){ 
		if(IS_POST){
			$_POST['token'] = $this->token;
			$this->all_insert();
		}else{
			$set=array();
			$set['time']=time()+10*24*3600;
			$this->assign('set',$set);
			$this->display('set');
		}
	}
	public function set(){
        $id = intval($this->_get('id')); 
		$checkdata = $this->xitie_model->where(array('id'=>$id))->find();
		if(empty($checkdata)||$checkdata['token']!=$this->token){
            $this->error("没有相应记录.您现在可以添加.",U('Xitie/add'));
        }
		if(IS_POST){ 
            $where=array('id'=>$this->_post('id'),'token'=>$this->token);
			$check=$this->xitie_model->where($where)->find();
			if($check==false)$this->error('非法操作');
			if($this->xitie_model->create()){
				if($this->xitie_model->where($where)->save($_POST)){
					$this->success('修改成功',U('Xitie/index',array('token'=>$this->token)));
					$keyword_model=M('Keyword');
					$keyword_model->where(array('token'=>$this->token,'pid'=>$id,'module'=>'Xitie'))->save(array('keyword'=>$_POST['keyword']));
				}else{
					$this->error('操作失败');
				}
			}else{
				$this->error($this->xitie_model->getError());
			}
		}else{
			$this->assign('isUpdate',1);
			
			$this->assign('set',$checkdata);
			$this->display();	
		
		}
	}
	public function del(){
		if($this->_get('token')!=$this->token){$this->error('非法操作');}
        $id = intval($this->_get('id'));
        if(IS_GET){                              
            $where=array('id'=>$id,'token'=>$this->token);
            $check=$this->xitie_model->where($where)->find();
            if($check==false)   $this->error('非法操作');

            $back=$this->xitie_model->where($where)->delete();
            if($back==true){
            	//$keyword_model=M('Keyword');
            	//$keyword_model->where(array('token'=>$this->token,'pid'=>$id,'module'=>'Xitie'));
                $this->success('操作成功',U('Xitie/index',array('token'=>$this->token)));
            }else{
                 $this->error('服务器繁忙,请稍后再试',U('Xitie/index',array('token'=>$this->token)));
            }
        }        
	}
	public function infos(){
		$where['xid'] = $this->_get('id');
		$where['token'] = $this->_get('token');
		if(IS_POST){
			$key = $this->_post('searchkey');
			if(empty($key)){
				$this->error("关键词不能为空");
			}

			$where['name|content'] = array('like',"%$key%");
			$list = M('Zhufu')->where($where)->order('time DESC')->select();
			$count      = M('Zhufu')->where($where)->count();
			$Page       = new Page($count,20);
			$show       = $Page->show();
			$this->assign('key',$key);
		}else {
			$count      = M('Zhufu')->where($where)->count();
			
			$Page       = new Page($count,20);
			$show       = $Page->show();
			$list=M('Zhufu')->where($where)->order('time DESC')->select();
		}
		
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->display();
	}
	public function delinfos(){
		if($this->_get('token')!=$this->token){$this->error('非法操作');}
        $id = intval($this->_get('id'));
        if(IS_GET){                              
            $where=array('id'=>$id,'token'=>$this->token);
            $check=M('Zhufu')->where($where)->find();
            if($check==false)   $this->error('非法操作');

            $back=M('Zhufu')->where($where)->delete();
            if($back==true){
            	//$keyword_model=M('Keyword');
            	//$keyword_model->where(array('token'=>$this->token,'pid'=>$id,'module'=>'Xitie'));
                $this->success('操作成功',U('Xitie/infos',array('token'=>$this->token,'id'=>$check['xid'])));
            }else{
                 $this->error('服务器繁忙,请稍后再试',U('Xitie/infos',array('token'=>$this->token,'id'=>$check['xid'])));
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