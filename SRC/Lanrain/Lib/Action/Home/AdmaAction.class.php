<?php
class AdmaAction extends BaseAction{
	//关注回复
	public function index(){
		if($this->_get('token')!=false){
			$adma=M('Adma')->where(array('token'=>$this->_get('token')))->find();
			if($adma==false){
				$this->error('不在的宣传页',U('Home/Index/index'));
			}else{
				$this->assign('adma',$adma);
			}
		}else{
			$this->error('身份验证失败',U('Home/Index/index'));
		}
		$this->display();
	}

}
?>