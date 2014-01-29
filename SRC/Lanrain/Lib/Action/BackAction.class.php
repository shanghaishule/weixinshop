<?php
class BackAction extends BaseAction{
	protected $pid;
	protected function _initialize(){		
		if(!isset($_SESSION['username'])){$this->error('非法操作',U('System/Admin/index'));}
		parent::_initialize();
		if (C('USER_AUTH_ON') && !in_array(MODULE_NAME, explode(',', C('NOT_AUTH_MODULE')))) {
            if (!RBAC::AccessDecision()) {
                //检查认证识别号
                if (!$_SESSION [C('USER_AUTH_KEY')]) {
                    //跳转到认证网关
                    redirect(PHP_FILE . C('USER_AUTH_GATEWAY'));
                }
                // 没有权限 抛出错误
                if (C('RBAC_ERROR_PAGE')) {
                    // 定义权限错误页面
                    redirect(C('RBAC_ERROR_PAGE'));
                } else {
                    if (C('GUEST_AUTH_ON')) {
                        $this->assign('jumpUrl', PHP_FILE . C('USER_AUTH_GATEWAY'));
                    }
                    // 提示错误信息
                    $this->error(L('_VALID_ACCESS_'));
                }
            }
        }
		$this->show_menu();
	}
	
	private function show_menu(){
		$this->pid=$this->_get('pid','intval')?$this->_get('pid','intval'):2;
		$where['level']=$this->_get('level','intval');
		$where['pid']=$this->pid;
		$title=rawurldecode($this->_get('title'));
		$where['status']=1;
		$where['display']=array('gt',0);
		$order['sort']='asc';
		$nav=M('Node')->where($where)->order($order)->select();
		$this->assign('title',$title);
		$this->assign('nav',$nav);
	}
	
	protected function _list($model, $map = array(), $sort_by='', $order_by='', $field_list='*', $pagesize=20)
	{
		//排序
		$mod_pk = $model->getPk();
	
		if ($this->_request("sort", 'trim')) {
			$sort = $this->_request("sort", 'trim');
		} else if (!empty($sort_by)) {
			$sort = $sort_by;
		} else if ($this->sort) {
			$sort = $this->sort;
		} else {
			$sort = $mod_pk;
		}
		if ($this->_request("order", 'trim')) {
			$order = $this->_request("order", 'trim');
		} else if (!empty($order_by)) {
			$order = $order_by;
		} else if ($this->order) {
			$order = $this->order;
		} else {
			$order = 'DESC';
		}
	
		//如果需要分页
		if ($pagesize) {
			$count = $model->where($map)->count($mod_pk);
			$pager = new Page($count, $pagesize);
		}
		$select = $model->field($field_list)->where($map)->order($sort . ' ' . $order);
		$this->list_relation && $select->relation(true);
		if ($pagesize) {
			$select->limit($pager->firstRow.','.$pager->listRows);
			$page = $pager->show();
			$this->assign("page", $page);
		}
		$list = $select->select();
		$this->assign('list', $list);
		$this->assign('list_table', true);
	}
}