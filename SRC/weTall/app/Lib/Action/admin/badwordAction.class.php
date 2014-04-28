
<?php

class badwordAction extends backendAction
{

    public function _initialize() {
        parent::_initialize();
        $this->_mod = D('badword');
    }

    public function _before_index() {
        $big_menu = array(
            'title' => L('添加敏感词'),
            'iframe' => U('badword/add'),
            'id' => 'add',
            'width' => '500',
            'height' => '130'
        );
        $this->assign('big_menu', $big_menu);

    }

    protected function _search() {
        $map = array();
        ($word_type = $this->_request('word_type', 'trim')) && $map['word_type'] = array('eq', $word_type);
        ($keyword = $this->_request('keyword', 'trim')) && $map['badword'] = array('like', '%'.$keyword.'%');
        $this->assign('search', array(
            'keyword' => $keyword,
            'word_type' => $word_type,
        ));
        return $map;
    }

    public function ajax_check_name() {
        $name = $this->_get('badword', 'trim');
        $id = $this->_get('id', 'intval');
        if (D('badword')->name_exists($name, $id)) {
            $this->ajaxReturn(0, L('该敏感词已存在'));
        } else {
            $this->ajaxReturn(1);
        }
    }
}