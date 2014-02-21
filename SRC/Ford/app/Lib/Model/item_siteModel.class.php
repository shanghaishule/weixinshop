<?php
class item_siteModel extends Model
{

    protected $_validate = array(
        array('code', 'require', '{%item_site_code_empty}'),
        array('name', 'require', '{%item_site_name_empty}'),
        array('domain', 'require', '{%item_site_domain_empty}')
    );

    //获取已经安装的接口
    public function get_installed() {
        $installed_list = array();
        $installed_res = $this->select();
        foreach ($installed_res as $val) {
            $installed_list[$val['code']] = $val;
        }
        return $installed_list;
    }

    //获取未安装接口信息
    public function get_file_info($code) {
        return include(LIB_PATH . 'Pinlib/itemcollect/'.$code.'/info.php');
    }

    /**
     * 接口缓存
     */
    public function site_cache() {
        $item_site_list = array();
        $result = $this->field('id,code,name,domain,url,config')->where('status=1')->order('ordid')->select();
        foreach ($result as $val) {
            $val['config'] = unserialize($val['config']);
            $item_site_list[$val['code']] = $val;
        }
        F('item_site_list', $item_site_list);
        return $item_site_list;
    }

    /**
     * 更新则删除缓存
     */
    protected function _before_write(&$data) {
        F('item_site_list', NULL);
    }

    /**
     * 删除也删除缓存
     */
    protected function _after_delete($data, $options) {
        F('item_site_list', NULL);
    }
}