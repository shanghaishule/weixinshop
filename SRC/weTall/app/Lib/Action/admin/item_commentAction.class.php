<?php
class item_commentAction extends backendAction
{
    public function _initialize() {
        parent::_initialize();
        $this->_mod = M('item_comment');
    }

    public function index() {
        $prefix = C(DB_PREFIX);

        if ($this->_request("sort", 'trim')) {
            $sort = $this->_request("sort", 'trim');
        } else {
            $sort = $prefix.'item_comment.id';
        }
        if ($this->_request("order", 'trim')) {
            $order = $this->_request("order", 'trim');
        } else {
            $order = 'DESC';
        }

        $p = $this->_get('p','intval',1);
        $this->assign('p',$p);
        
        $where = '1=1';
        $keyword = $this->_request('keyword','trim','');
        $keyword && $where .= " AND ((".$prefix."user.username LIKE '%".$keyword."%') OR (".$prefix."item.title LIKE '%".$keyword."%') OR (".$prefix."item_comment.info LIKE '%".$keyword."%') )";
        $search = array();
        $keyword && $search['keyword'] = $keyword;
        $this->assign('search',$search);

        $count = $this->_mod->join($prefix.'user ON '.$prefix.'user.id='.$prefix.'item_comment.uid')->join($prefix.'item ON '.$prefix.'item.id='.$prefix.'item_comment.item_id')->where($where)->count($prefix.'item_comment.id');
        $pager = new Page($count,20);
        $list  = $this->_mod->field($prefix.'item_comment.*,'.$prefix.'user.username,'.$prefix.'item.title as item_name,'.$prefix.'item.img')->join($prefix.'user ON '.$prefix.'user.id='.$prefix.'item_comment.uid')->join($prefix.'item ON '.$prefix.'item.id='.$prefix.'item_comment.item_id')->where($where)->order($sort . ' ' . $order)->limit($pager->firstRow.','.$pager->listRows)->select();
        $this->assign('list',$list);
        $this->assign('page',$pager->show());

        $this->assign('list_table', true);

        $this->display();
    }
    
    /**
     * 删除
     */
    public function delete()
    {
        $ids = trim($this->_request('id'), ',');
        if ($ids) {
            $item_ids = $this->_mod->where(array('id'=>array('in', $ids)))->getField('item_id', true);
            if (false !== $this->_mod->delete($ids)) {
                $item_mod = D('item');
                foreach ($item_ids as $item_id) {
                    $item_mod->update_comments($item_id);
                }
                IS_AJAX && $this->ajaxReturn(1, L('operation_success'));
            } else {
                IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
            }
        } else {
            IS_AJAX && $this->ajaxReturn(0, L('illegal_parameters'));
        }
    }
}