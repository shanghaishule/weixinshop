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

	
		// openid 与 feedback参数都可以从数据库中得到
		$feedback = $this->_mod->where(array('id'=>$id))->find();
		//dump($feedback);exit;
		//$content = 'http://api.weixin.qq.com/cgi-bin/pay/delivernotify?access_token=' . $wechat->getAccessToken($config) . '&openid=' . $feedback['openid'] . '&feedbackid=' . $feedback['feedbackid'];
		
		$content = 'https://api.weixin.qq.com/payfeedback/update?access_token='.$wechat->getAccessToken($config).'&openid='.$feedback['openid'].'&feedbackid='.$feedback['feedbackid']; 
		//dump($content);
		$result = $wechat->curlGet($content);
		
		//dump($result);exit;
		
		
		$result = json_decode($result, true);
		if ($result['errcode'] == 0) {
			//echo 'success';
			//IS_AJAX && $this->ajaxReturn(1, $result['errmsg'], '', 'edit');
			
			$this->_mod->where(array('id'=>$id))->save(array('status'=>1));
			$this->success('通知微信成功!');

		} elseif ($result['errcode'] == -1 && $result['errmsg'] == 'system error'){
			$this->_mod->where(array('id'=>$id))->save(array('status'=>1));
			$this->success('已经通知过微信,更改状态成功!');
		} else {
			//IS_AJAX && $this->ajaxReturn(0, $result['errmsg']);
			$this->error($result['errmsg']);
		}
	}
	
	
   
}
?>