<?php

class ipbanModel extends Model {

    /**
     * 清理过期记录
     */
    public function clear() {
        $this->where('expires_time <> 0 AND expires_time < '.time())->delete();
    }

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
}