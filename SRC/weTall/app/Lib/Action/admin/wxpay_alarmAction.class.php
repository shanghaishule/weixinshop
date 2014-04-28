<?php
class wxpay_alarmAction extends backendAction {
	public function _initialize() {
		parent::_initialize();
		$this->_mod = M('wxpay_alarm');
	}
	
	
	protected function _search() {
		$map = array();
		/*
		//只能看到自己的
		$tokenTall = $this->getTokenTall();
		$me = M('wxpay')->where(array('tokenTall'=>$tokenTall))->find();
		$map['appid'] = array('eq', $me['appId']);
		*/
		
		($errortype = $this->_request('errortype', 'trim')) && $map['errortype'] = array('like', '%'.$errortype.'%');
		$this->assign('search', array(
				'errortype' => $errortype,
		));
		return $map;
	}
	

   
}
?>