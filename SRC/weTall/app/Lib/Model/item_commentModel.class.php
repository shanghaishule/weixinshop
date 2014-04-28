<?php

class item_commentModel extends Model
{
    protected $_auto = array (array('add_time','time',1,'function'));

    /**
     * 新增评论更新商品评论数和评论缓存字段
     */
    protected function _after_insert($data,$options) {
        $item_mod = D('item');
        $item_mod->where(array('id'=>$data['item_id']))->setInc('comments');
        $item_mod->update_comments($data['item_id'], array(
            'id' => $data['id'],
            'uid' => $data['uid'],
            'uname' => $data['uname'],
            'info' => $data['info']
        ));
    }
}