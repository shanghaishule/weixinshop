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
			$count = $this->_mod_application->count();
			$Page       = new Page($count,15);// 实例化分页类 传入总记录数
			// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
			$nowPage = isset($_GET['p'])?$_GET['p']:1;
			$show       = $Page->show();// 分页显示输出
	    	$mod = $this->_mod_application->order('id ASC')->limit($Page->firstRow.','.$Page->listRows)->select();
		}else{
			if ($status == "") {
				$status = "2";
			}
			$where["HaveReal"]=$status;
			$count = $this->_mod_application->where($where)->count();
			$Page       = new Page($count,15);// 实例化分页类 传入总记录数
			// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
			$nowPage = isset($_GET['p'])?$_GET['p']:1;
			$show       = $Page->show();// 分页显示输出
	    	$mod = $this->_mod_application->where($where)->order('id ASC')->limit($Page->firstRow.','.$Page->listRows)->select();
		}//dump($mod);exit;
		$this->assign('page',$show);// 赋值分页输出
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