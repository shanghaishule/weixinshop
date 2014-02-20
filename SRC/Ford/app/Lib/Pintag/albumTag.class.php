<?php
/**
 * 专辑模板标签解析
 *
 * @author andery
 */
class albumTag {

    /**
     * 专辑分类
     * 如果用户传入了非默认field,order则直接查询数据库，所以不推荐传入这些参数
     * @param array $options 
     */
    public function cate($options) {
        $options['field'] = isset($options['field']) ? trim($options['field']) : '*';
        $options['where'] = isset($options['where']) ? trim($options['where']) : '';
        $options['num'] = isset($options['num']) ? intval($options['num']) : 0;
        $options['order'] = isset($options['order']) ? trim($options['order']) : 'ordid';
        if ($options['field'] != '*' || $options['where'] || $options['order'] != 'ordid') {
            $album_cate_mod = M('album_cate');
            $map = array('status'=>'1');
            $select = $album_cate_mod->field($options['field']); //字段
            $options['where'] && $map['_string'] = $options['where'];
            $select->where($map); //条件
            $options['num'] && $select->limit($options['num']); //个数
            $select->order($options['order']); //排序
            $data = $select->select();
        } else {
            //分类缓存
            if (false === $cate_list = F('album_cate_list')) {
                $cate_list = D('album_cate')->cate_cache();
            }
            $options['num'] && $cate_list = array_slice($cate_list, 0, $options['num']);
            $data = $cate_list;
        }
        return $data;
    }
    
    /**
     * 专辑列表
     * @param array $options 
     */
    public function lists($options) {
        $options['field'] = isset($options['field']) ? trim($options['field']) : '*';
        $options['cateid'] = isset($options['cateid']) ? intval($options['cateid']) : 0;
        $options['uid'] = isset($options['uid']) ? intval($options['uid']) : 0;
        $options['where'] = isset($options['where']) ? trim($options['where']) : '';
        $options['num'] = isset($options['num']) ? intval($options['num']) : 0;
        $options['order'] = isset($options['order']) ? trim($options['order']) : 'ordid,id DESC';
        
        $album_mod = M('album');
        $select = $album_mod->field($options['field']); //字段
        //条件
        $map = array('status'=>'1');
        $options['cateid'] && $map['cate_id'] = $options['cateid'];
        $options['uid'] && $map['uid'] = $options['uid'];
        $options['where'] && $map['_string'] = $options['where'];
        $select->where($map);
        $options['num'] && $select->limit($options['num']); //数量
        $select->order($options['order']); //排序
        $data = $select->select();
        if ($data) {
            foreach ($data as $key=>$val) {
                $data[$key]['cover'] = unserialize($val['cover_cache']);
            }
        }
        return $data;
    }
}