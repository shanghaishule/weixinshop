<?php

class MemberAction extends BackAction
{	
	public $_mod_;
	public function _initialize() {
        $this->_mod_ = M('user');
    }

	public function index() {
    	$mod = $this->_mod_;
    	//dump($mod);exit;
    	$this->_list($mod);
    	$this->display();
    }


}
?>