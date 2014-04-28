<?php

class ApplicationAction extends BackAction
{	
	public $_mod_application;
	public function _initialize() {
        $this->_mod_application = M('application');
    }

	public function index() {
    	$mod = $this->_mod_application;
    	//dump($mod);exit;
    	$this->_list($mod);
    	$this->display();
    }

    public function delete()
    {
    	$mod = $this->_mod_application;

    	$ids = trim($this->_request('id'), ',');
    	if ($ids) {
    		if (false !== $mod->delete($ids)) {
    			IS_AJAX && $this->ajaxReturn(1, L('operation_success'));
    			$this->success(L('operation_success'));
    		} else {
    			IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
    			$this->error(L('operation_failure'));
    		}
    	} else {
    		IS_AJAX && $this->ajaxReturn(0, L('illegal_parameters'));
    		$this->error(L('illegal_parameters'));
    	}
    	
    }

}
?>