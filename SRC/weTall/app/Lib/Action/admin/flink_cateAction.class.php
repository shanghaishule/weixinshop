<?php
class flink_cateAction extends backendAction
{

    public function _before_index() {
        $big_menu = array(
            'title' => L('add_flink_cate'),
            'iframe' => U('flink_cate/add'),
            'id' => 'add',
            'width' => '400',
            'height' => '90'
        );
        $this->assign('big_menu', $big_menu);
        $this->sort = 'ordid';
        $this->order = 'ASC';
    }

    public function _before_delete() {
        $ids = trim($this->_request('id'), ',');
        $ids_arr = explode(',', $ids);
        foreach ($ids_arr as $val) {
            if (M('flink')->where(array('cate_id'=>$val))->count()) {
                IS_AJAX && $this->ajaxReturn(0, '分类下面存在数据，不能删除！');
                $this->error('分类下面存在数据，不能删除！');
            }
        }
    }

    public function ajax_check_name() {
        $name = $this->_get('name', 'trim');
        $id = $this->_get('id', 'intval');
        if (D('flink_cate')->name_exists($name, $id)) {
            $this->ajaxReturn(0, L('flink_cate_already_exists'));
        } else {
            $this->ajaxReturn(1);
        }
    }
}