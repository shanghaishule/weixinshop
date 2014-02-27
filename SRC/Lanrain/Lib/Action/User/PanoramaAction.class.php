<?php
class PanoramaAction extends UserAction{
	public $panorama_model;
	public function _initialize() {
		parent::_initialize();
		
		$this->panorama_model=M('Panorama');
	}
	public function index(){
		//检查权限和功能
		$this->checkauth('Panorama','Panorama');
		
		if (IS_POST){
			
		}else{
			$where=array('token'=>$this->token);
			$count      = $this->panorama_model->where($where)->count();
			$Page       = new Page($count,20);
			$show       = $Page->show();
			$list=$this->panorama_model->where($where)->order('taxis ASC')->select();
			$this->assign('list',$list);

			$this->assign('page',$show);
			$this->display();
		}
	}

	public function add(){ 
		if(IS_POST){
			$_POST['token'] = $this->token;
			$this->insert('Panorama','/index?token='.$this->token);
		}else{
			$set=array();
			//$set['time']=time()+10*24*3600;
			$this->assign('set',$set);
			$this->display('set');
		}
	}

	
	public function set(){
		if($this->isGet()){
			 $id = intval($this->_get('id')); 
			$checkdata = $this->panorama_model->where(array('id'=>$id))->find();
	
			
			if(empty($checkdata)||$checkdata['token']!=$this->token){
	            $this->error("没有相应记录.您现在可以添加.",U('Panorama/add'));
	        }
	        $this->assign('isUpdate',1);	
			$this->assign('set',$checkdata);
			$this->display();	
		}
       
		if($this->isPost()){ 
            $where=array('id'=>$this->_post('id'),'token'=>$this->token);
			$check=$this->panorama_model->where($where)->find();
			if($check==false)$this->error('非法操作');
			if($this->panorama_model->create()){
				if($this->panorama_model->where($where)->save($_POST)){
					$this->success('修改成功',U('Panorama/index',array('token'=>$this->token)));
					//$keyword_model=M('Keyword');
					//$keyword_model->where(array('token'=>$this->token,'pid'=>$id,'module'=>'Panorama'))->save(array('keyword'=>$_POST['keyword']));
				}else{
					$this->error('操作失败');
				}
			}else{
				$this->error($this->panorama_model->getError());
			}
		}
	}
	public function delete(){
        $id = intval($this->_get('id'));
        if(IS_GET){                              
            $where=array('id'=>$id,'token'=>$this->token);
            $check=$this->panorama_model->where($where)->find();
            if($check==false)   $this->error('非法操作');

            $back=$this->panorama_model->where($wehre)->delete();
            if($back==true){
            	//$keyword_model=M('Keyword');
            	//$keyword_model->where(array('token'=>$this->token,'pid'=>$id,'module'=>'Panorama'))->delete();
                $this->success('操作成功',U('Panorama/index',array('token'=>$this->token)));
            }else{
                 $this->error('服务器繁忙,请稍后再试',U('Panorama/index',array('token'=>$this->token)));
            }
        }        
	}
	
	
}


?>