<?php

class deliveryAction extends backendAction
{

    public function _initialize() {
        parent::_initialize();
        $this->_mod = D('delivery');
    }

    public function _before_index() {
    	$tokenTall = $this->getTokenTall();
    	$this->assign('tokenTall',$tokenTall);
        $big_menu = array(
            'title' => L('添加快递'),
            'iframe' => U('delivery/add',array('tokenTall'=>$tokenTall)),
            'id' => 'add',
            'width' => '400',
            'height' => '130'
        );
        $this->assign('big_menu', $big_menu);

        //默认排序
        $this->sort = 'ordid, id';
        $this->order = 'ASC';
    }
    
    public function _before_insert($data) {
    	$tokenTall = $this->getTokenTall();
    	$data[tokenTall] = $tokenTall;
    	return $data;
    	
    }

    protected function _search() {
        $map = array();
        ($keyword = $this->_request('keyword', 'trim')) && $map['name'] = array('like', '%'.$keyword.'%');
        
        $tokenTall = $this->getTokenTall();
        $map['tokenTall'] = array('eq', $tokenTall);
        
        $this->assign('search', array(
            'keyword' => $keyword,
        	'tokenTall' => $tokenTall,
        ));
        return $map;
    }

    public function ajax_check_name() {
    	$name = $this->_get('name', 'trim');
        $id = $this->_get('id', 'intval');

        if (D('delivery')->name_exists($name, $id)) {
            $this->ajaxReturn(0, L('该名称已存在'));
        } else {
            $this->ajaxReturn(1);
        }
        
    }
    
    public function deletebrand()
    {
    	 
        $mod = D($this->_name);
      
        $pk = $mod->getPk();
        $ids = trim($this->_request($pk), ',');
        
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