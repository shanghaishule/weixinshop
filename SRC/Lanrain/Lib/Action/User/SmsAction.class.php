<?php
class SmsAction extends UserAction{
	public function index(){
		$sms_config_model=M('Sms_config');
		if(IS_POST){
			$where=array('token'=>session('token'));
			$check=$sms_config_model->where($where)->find();
			if (!$_POST['id']){
				$this->insert('Sms_config','/index');
			}else{
				if($sms_config_model->create()){
					if($sms_config_model->where($where)->save($_POST)){
						$this->success('设置成功',U('Sms/index',array('token'=>session('token'))));
					}else{
						$this->error('操作失败');
					}
				}else{
					$this->error($sms_config_model->getError());
				}
			}
		}else{
			Vendor('sms.sms');
			$sms=new sms();
			$servers=$sms->servers;
			//检查有没有短信配置记录
			
			$smsConfig=$sms_config_model->where(array('token'=>session('token')))->find();
			$serverOptions='';
			if ($smsConfig){
				$server=$smsConfig['server'];
				$this->assign('set',$smsConfig);
				$this->assign('isUpdate',1);
			}else {
				$server='';
			}
			foreach ($servers as $k=>$s){
				if ($k==$server){
					$selected=' selected';
				}else {
					$selected='';
				}
				$serverOptions.='<option value="'.$k.'"'.$selected.'>'.$s['name'].'</option>';
			}
			$this->assign('serverOptions',$serverOptions);
			//
			$this->assign('servers',$servers);
			$this->display();
		}
	}
}


?>