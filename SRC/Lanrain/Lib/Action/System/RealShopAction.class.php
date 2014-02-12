<?php

class RealShopAction extends BackAction
{	
	public $_mod_application;
	public function _initialize() {
        $this->_mod_application = M('wecha_shop');
    }

	public function index() {
		$status=$this->_get("status","trim");
		if ($status == "4") {
			$mod = $this->_mod_application->select();;
		}else{
			if ($status == "") {
				$status = "2";
			}
			$where["HaveReal"]=$status;
	    	$mod = $this->_mod_application->where($where)->select();
		}//dump($mod);exit;
    	$this->assign("list",$mod);
    	$this->display();
    }

    public function checkNoPass(){
    	$mod = $this->_mod_application;
    	 
    	$ids["id"] = trim($this->_request('id'), ',');
    	$data["HaveReal"]="3";
    	if ($ids["id"]) {
    		if (false !== $mod->where($ids)->save($data)) {
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
    public function checkPass(){
    	$mod = $this->_mod_application;
    	
    	$ids["id"] = trim($this->_request('id'), ',');
    	$data["HaveReal"]="1";
    	if ($ids["id"]) {
    		if (false !== $mod->where($ids)->save($data)) {
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