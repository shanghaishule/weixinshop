<?php
/**
 * 积分商品
 *
 * @author andery
 */
class scoreitemTag {

    /**
     * 积分商品分类
     * 如果用户传入了非默认field,order则直接查询数据库，所以不推荐传入这些参数
     * @param array $options 
     */
    public function cate($options) {
        $options['field'] = isset($options['field']) ? trim($options['field']) : '*';
        $options['where'] = isset($options['where']) ? trim($options['where']) : '';
        $options['num'] = isset($options['num']) ? intval($options['num']) : 0;
        $options['order'] = isset($options['order']) ? trim($options['order']) : 'ordid';
        if ($options['field'] != '*' || $options['where'] || $options['order'] != 'ordid') {
            $score_item_cate_mod = M('score_item_cate');
            $pk = $score_item_cate_mod->getPk();
            $map = array('status' => '1');
            $select = $score_item_cate_mod->field($options['field']); //字段
            $options['where'] && $map['_string'] = $options['where'];
            $select->where($map); //条件
            $options['num'] && $select->limit($options['num']); //个数
            $order = $options['order'] ? $options['order'] : $pk . ' DESC';
            $select->order($order); //排序
            $data = $select->select();
        } else {
            //积分商品分类缓存
            if (false === $cate_list = F('score_item_cate_list')) {
                $cate_list = D('score_item_cate')->cate_cache();
            }
            $options['num'] && $cate_list = array_slice($cate_list, 0, $options['num']);
            $data = $cate_list;
        }
        return $data;
    }
    
    /**
     * 积分商品列表
     * @param array $options 
     */
    public function lists($options) {
        $score_item_mod = M('score_item');
        $pk = $score_item_mod->getPk();

        $options['field'] = isset($options['field']) ? trim($options['field']) : '*';
        $options['cateid'] = isset($options['cateid']) ? intval($options['cateid']) : 0;
        $options['where'] = isset($options['where']) ? trim($options['where']) : 0;
        $options['num'] = isset($options['num']) ? trim($options['num']) : 0;
        $options['order'] = isset($options['order']) ? trim($options['order']) : 'ordid,'.$pk.' DESC';

        $select = $score_item_mod->field($options['field']); //字段        
        //条件
        $map = array('status' => '1');
        $options['cateid'] && $map['cate_id'] = $options['cateid'];
        $options['where'] && $map['_string'] = $options['where'];
        $select->where($map); //数量
        $options['num'] && $select->limit($options['num']); //排序
        $select->order($options['order']); 
        $data = $select->select();
        return $data;
    }
}