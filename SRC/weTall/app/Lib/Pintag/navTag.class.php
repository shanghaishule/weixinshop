<?php
/**
 * 导航标签
 *
 * @author andery
 */
class navTag {    
    /**
     * 导航列表
     * 如果用户传入了非默认field,order则直接查询数据库，所以不推荐传入这些参数
     * @param array $options 
     */
    public function lists($options) {
        $options['field'] = isset($options['field']) ? trim($options['field']) : '*';
        $options['style'] = isset($options['style']) ? trim($options['style']) : '';
        $options['where'] = isset($options['where']) ? trim($options['where']) : '';
        $options['num'] = isset($options['num']) ? intval($options['num']) : 0;
        $options['order'] = isset($options['order']) ? trim($options['order']) : 'ordid';

        if ($options['field'] != '*' || $options['where'] || $options['order'] != 'ordid') {
            $nav_mod = M('nav');
            $select = $nav_mod->field($field); //字段
            $map = array('status'=>'1');
            $options['style'] && $map = array('type' => $options['style']); //导航类型
            $select->where($map);
            $options['num'] && $select->limit($options['num']); //数量
            $select->order($options['order']); //排序
            $data = $select->select();
        } else {
            if (false === $nav_list = F('nav_list')) {
                $nav_list = D('nav')->nav_cache();
            }
            $nav_list = $nav_list[$options['style']];
            $options['num'] && $nav_list = array_slice($nav_list, 0, $options['num']);
            $data = $nav_list;
        }
        foreach ($data as $key=>$val) {
            switch ($val['alias']) {
                case 'book':
                    $data[$key]['link'] = U('book/index');
                    break;
                case 'album':
                    $data[$key]['link'] = U('album/index');
                    break;
                case 'exchange':
                    $data[$key]['link'] = U('exchange/index');
                    break;
            }
        }
        return $data;
    }
}