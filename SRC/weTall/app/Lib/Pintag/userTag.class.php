<?php
/**
 * 用户模板标签解析
 *
 * @author andery
 */
class userTag {
    
    /**
     * 专辑列表
     * @param array $options 
     */
    public function lists($options) {
        $options['field'] = isset($options['field']) ? trim($options['field']) : '*';
        $options['where'] = isset($options['where']) ? trim($options['where']) : '';
        $options['num'] = isset($options['num']) ? intval($options['num']) : 0;
        $options['order'] = isset($options['order']) ? trim($options['order']) : 'id DESC';
        
        $user_mod = M('user');
        $select = $user_mod->field($options['field']); //字段
        //条件
        $map = array('status'=>'1');
        $options['where'] && $map['_string'] = $options['where'];
        $select->where($map);
        $options['num'] && $select->limit($options['num']); //数量
        $select->order($options['order']); //排序
        return $select->select();
    }
}