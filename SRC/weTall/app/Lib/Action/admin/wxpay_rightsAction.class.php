<?php
class wxpay_rightsAction extends backendAction {
	public function _initialize() {
		parent::_initialize();
		$this->_mod = M('wxpay_rights');
	}
	
	
	protected function _search() {
		$map = array();
		($keyword = $this->_request('keyword', 'trim')) && $map['openid'] = array('like', '%'.$keyword.'%');
		$this->assign('search', array(
				'keyword' => $keyword,
		));
		return $map;
	}
	
	function updatefeedback(){
		
		$id = $this->_get('id', 'intval');
		
		header('Content-Type:text/html;charset=utf-8');
		$wetallroute = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
		//dump($wetallroute);exit;
		include $wetallroute."/wxpay/config.php";
		//dump($config);exit;
		include $wetallroute."/wxpay/lib.php";
		
		$wechat = new Wechat;
		$data = $wechat->getXmlArray();

		// openid 与 feedback参数都可以从数据库中得到
		$feedback = $this->_mod->where(array('id'=>$id))->find();
		
		$result = file_get_contents('http://api.weixin.qq.com/cgi-bin/pay/delivernotify?access_token=' . $wechat->getAccessToken() . '&openid=' . $feedback['openid'] . '&feedbackid=' . $feedback['feedbackid']);
		$result = json_decode($result, true);
		if ($result['errcode'] == 0) {
			//echo 'success';
			
			IS_AJAX && $this->ajaxReturn(1, $result['errmsg'], '', 'edit');
			$this->success($result['errmsg']);
			
		} else {
			IS_AJAX && $this->ajaxReturn(0, $result['errmsg']);
			$this->error($result['errmsg']);
		}
	}
	
	
   
}
?>