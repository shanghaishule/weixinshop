<?php

class score_item_cateModel extends Model{

    /**
     * 检测分类是否存在
     *
     * @param string $name
     * @param int $pid
     * @return bool
     */
    public function name_exists($name, $id=0)
    {
        $pk = $this->getPk();
        $where = "name='" . $name . "'  AND ". $pk ."<>'" . $id . "'";
        $result = $this->where($where)->count($pk);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function get_name($id) {
        if (false === $cate_list = F('score_item_cate_list')) {
            $cate_list = $this->cate_cache();
        }
        if (isset($cate_list[$id])) {
            return $cate_list[$id]['name'];
        } else {
            return false;
        }
    }

    /**
     * 读取分类信息写入缓存
     */
    public function cate_cache() {
        $cate_list = array();
        $cate_data = $this->where('status=1')->order('ordid')->select();
        foreach ($cate_data as $val) {
            $cate_list[$val['id']] = $val;
        }
        F('score_item_cate_list', $cate_list);
        return $cate_list;
    }

    /**
     * 更新则删除缓存
     */
    protected function _before_write(&$data) {
        F('score_item_cate_list', NULL);
    }

    /**
     * 删除也删除缓存
     */
    protected function _after_delete($data, $options) {
        F('score_item_cate_list', NULL);
    }
}