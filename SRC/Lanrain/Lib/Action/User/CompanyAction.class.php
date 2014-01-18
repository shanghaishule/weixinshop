<?php
class CompanyAction extends UserAction{
	public $token;
	public $isBranch;
	public $company_model;
	public function _initialize() {
		parent::_initialize();
		$this->token=session('token');
		$this->assign('token',$this->token);
		//权限
		if ($this->token!=$_GET['token']){
			exit();
		}
		//是否是分店
		$this->isBranch=0;
		if (isset($_GET['isBranch'])&&intval($_GET['isBranch'])){
			$this->isBranch=1;
		}
		$this->assign('isBranch',$this->isBranch);
		//
		$this->company_model=M('Company');
	}
	public function index(){
		$where=array('token'=>$this->token);
		if ($this->isBranch){
			$id=intval($_GET['id']);
			$where['id']=$id;
			$where['isbranch']=1;
		}else {
			$where['isbranch']=0;
		}
		$thisCompany=$this->company_model->where($where)->find();
		if(IS_POST){
			if (!$thisCompany){
				if ($this->isBranch){
					$this->insert('Company',U('Company/branches',array('token'=>$this->token,'isBranch'=>$this->isBranch)));
				}else {
					$this->insert('Company',U('Company/index',array('token'=>$this->token,'isBranch'=>$this->isBranch)));
				}
			}else {
				if($this->company_model->create()){
					if($this->company_model->where($where)->save($_POST)){
						if ($this->isBranch){
							$this->success('修改成功',U('Company/branches',array('token'=>$this->token,'isBranch'=>$this->isBranch)));
						}else{
							$this->success('修改成功',U('Company/index',array('token'=>$this->token,'isBranch'=>$this->isBranch)));
						}
					}else{
						$this->error('操作失败');
					}
				}else{
					$this->error($this->company_model->getError());
				}
			}
			
		}else{
			$this->assign('set',$thisCompany);
			$this->display();
		}
	}
	public function branches(){
		$branches=$this->company_model->where(array('isbranch'=>1,'token'=>$this->token))->order('taxis ASC')->select();
		$this->assign('branches',$branches);
		$this->display();
	}
	public function delete(){
		$where=array('token'=>$this->token,'isbranch'=>1,'id'=>intval($_GET['id']));
		$rt=$this->company_model->where($where)->delete();
		if($rt==true){
			$this->success('删除成功',U('Company/branches',array('token'=>$this->token,'isBranch'=>1)));
		}else{
			$this->error('服务器繁忙,请稍后再试',U('Company/branches',array('token'=>$this->token,'isBranch'=>1)));
		}
	}
}


?>