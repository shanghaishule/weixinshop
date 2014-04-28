<?php
class adboardModel extends Model {
    /**
     * 检测分类是否存在
     */
    public function name_exists($name, $id=0) {
        $where = "name='" . $name . "' AND id<>'" . $id . "'";
        $result = $this->where($where)->count('id');
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    //获取广告位模板
    public function get_tpl_list() {
        $cfg_files = glob(LIB_PATH.'Widget/advert/*.config.php');
        $tpl_list = array();
        foreach ($cfg_files as $file) {
            $basefile = basename($file);
            $key = str_replace('.config.php', '', $basefile);
            $tpl_list[$key] = include_once($file);
            $tpl_list[$key]['alias'] = $key;
        }
        return $tpl_list;
    }
}