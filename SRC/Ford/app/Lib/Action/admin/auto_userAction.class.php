<?php

class auto_userAction extends backendAction
{

    public function _initialize() {
        parent::_initialize();
        $this->_mod = M('auto_user');
    }

    public function _before_index() {
        $big_menu = array(
            'title' => L('添加马甲'),
            'iframe' => U('auto_user/add'),
            'id' => 'add',
            'width' => '400',
            'height' => '170'
        );
        $this->assign('big_menu', $big_menu);
    }

    protected function _search() {
        $map = array();
        ($keyword = $this->_request('keyword', 'trim')) && $map['name'] = array('like', '%'.$keyword.'%');
        $this->assign('search', array(
            'keyword' => $keyword,
        ));
        return $map;
    }

    public function ajax_check_name() {
        $name = $this->_get('name', 'trim');
        $id = $this->_get('id', 'intval');
        if (D('auto_user')->name_exists($name, $id)) {
            $this->ajaxReturn(0, L('该名称已存在'));
        } else {
            $this->ajaxReturn(1);
        }
    }
}