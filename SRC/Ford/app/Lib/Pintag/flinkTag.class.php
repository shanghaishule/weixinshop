<?php
/**
 * 友情链接标签解析
 *
 * @author andery
 */
class flinkTag {

    /**
     * 友情链接分类
     * @param array $options 
     */
    public function cate($options) {
        $options['field'] = isset($options['field']) ? trim($options['field']) : '*';
        $options['where'] = isset($options['where']) ? trim($options['where']) : '';
        $options['num'] = isset($options['num']) ? intval($options['num']) : 0;
        $options['order'] = isset($options['order']) ? trim($options['order']) : 'ordid';
        if ($options['field'] != '*' || $options['where'] || $options['order'] != 'ordid') {
            $flink_cate_mod = M('flink_cate');
            $select = $flink_cate_mod->field($options['field']);
            $map = array('status'=>'1');
            $options['where'] && $map['_string'] = $options['where'];
            $select->where($map);
            $options['num'] && $select->limit($options['num']);
            $select->order($options['order']); 
            $data = $select->select();
        } else {
            //分类缓存
            if (false === $cate_list = F('flink_cate_list')) {
                $cate_list = D('flink_cate')->cate_cache();
            }
            $options['num'] && $cate_list = array_slice($cate_list, 0, $options['num']);
            $data = $cate_list;
        }
        return $data;
    }
    
    /**
     * 友情链接列表
     * @param array $options 
     */
    public function lists($options) {
        $options['field'] = isset($options['field']) ? trim($options['field']) : '*';
        $options['cateid'] = isset($options['cateid']) ? intval($options['cateid']) : 0;
        $options['where'] = isset($options['where']) ? trim($options['where']) : '';
        $options['style'] = isset($options['style']) ? trim($options['style']) : '';
        $options['num'] = isset($options['num']) ? intval($options['num']) : 0;
        $options['order'] = isset($options['order']) ? trim($options['order']) : 'ordid,id DESC';

        $flink_mod = M('flink');
        $select = $flink_mod->field($options['field']);
        $map = array('status'=>'1');
        $options['cateid'] && $map['cate_id'] = $options['cateid'];
        //链接类型
        switch ($options['style']) {
            case 'text' : 
                $map['img'] = array('eq', '');
                break;
            case 'img' :
                $map['img'] = array('neq', '');
                break;
        }
        //条件
        $select->where($map);
        $options['num'] && $select->limit($options['num']); //数量
        $select->order($options['order']); //排序
        $data = $select->select();
        return $data;
    }
}