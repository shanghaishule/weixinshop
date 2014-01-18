<?php

class ipbanAction  extends backendAction
{

    public function _initialize() {
        parent::_initialize();
        $this->_mod = D('ipban');
    }

    public function _before_index() {
        $big_menu = array(
            'title' => L('添加黑名单'),
            'iframe' => U('ipban/add'),
            'id' => 'add',
            'width' => '400',
            'height' => '130'
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

    protected function _before_insert($data) {
        $data['expires_time']=strtotime($data['expires_time']);
        return $data;
    }

    protected function _before_update($data) {
        $data['expires_time']=strtotime($data['expires_time']);
        return $data;
    }
}