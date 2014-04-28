<?php
class adboardAction extends backendAction {
    public function _initialize() {
        parent::_initialize();
        $this->_mod = D('adboard');
    }

    public function _before_index() {
        $tpl_list = $this->_mod->get_tpl_list();
        $this->assign('tpl_list', $tpl_list);
        $big_menu = array(
            'title' => L('adboard_add'),
            'iframe' => U('adboard/add'),
            'id' => 'add',
            'width' => '500',
            'height' => '280'
        );
        $this->assign('big_menu', $big_menu);
    }

    public function _before_add() {
        $tpl_list = $this->_mod->get_tpl_list();
        $this->assign('tpl_list', $tpl_list);
    }

    protected function _before_insert($data) {
        if ($this->_mod->name_exists($data['name'])) {
            $this->ajaxReturn(0, L('adboard_already_exists'));
        }
    }

    public function _before_edit() {
        $tpl_list = $this->_mod->get_tpl_list();
        $this->assign('tpl_list', $tpl_list);
    }

    protected function _before_update($data) {
        if ($this->_mod->name_exists($data['name'], $data['id'])) {
            $this->ajaxReturn(0, L('adboard_already_exists'));
        }
    }

    public function ajax_check_name() {
        $name = $this->_get('name', 'trim');
        $id = $this->_get('id', 'intval');
        if ($this->_mod->name_exists($name, $id)) {
            $this->ajaxReturn(0, L('adboard_already_exists'));
        } else {
            $this->ajaxReturn();
        }
    }
}