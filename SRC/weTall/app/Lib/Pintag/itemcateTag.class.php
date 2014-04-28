<?php
/**
 * 商品分类标签解析
 *
 * @author andery
 */
class itemcateTag {
    public function __construct() {
        $this->mod = D('item_cate');
    }

    /**
     * 分类标签解析
     * @param array $options
     */
    public function lists($options) {
        $options['field'] = isset($options['field']) ? trim($options['field']) : '*';
        $options['where'] = isset($options['where']) ? trim($options['where']) : '';
        $options['num'] = isset($options['num']) ? intval($options['num']) : 0;
        $options['order'] = isset($options['order']) ? trim($options['order']) : 'ordid';

        $select = $this->mod->field($field); //字段
        $map = array('status'=>'1');
        intval($options['cateid']) && $map['pid'] = $options['cateid'];
        $options['where'] && $map['_string'] = $options['where'];
        $select->where($map); //条件
        $order = isset($options['order']) ?  trim($options['order']) : $pk;
        $order = $order. ' DESC';
        $select->order($order); //排序
        intval($options['num']) && $select->limit($options['num']); //个数
        $data = $select->select();
        return $data;
    }
}