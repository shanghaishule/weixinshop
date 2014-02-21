<?php

class message_tplAction extends backendAction
{
    public function _initialize() {
        parent::_initialize();
        $this->_mod = D('message_tpl');
    }

    protected function _search() {
        $type = $this->_get('type', 'trim');
        $map = array();
        $map['type'] = $type;
        if( $keyword = $this->_request('keyword', 'trim') ){
            $map['_string'] = "name like '%".$keyword."%' OR alias like '%".$keyword."%'";
        }
        $this->assign('search', array(
            'keyword' => $keyword,
        ));
        return $map;
    }
}