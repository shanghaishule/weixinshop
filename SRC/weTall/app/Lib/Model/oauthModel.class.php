<?php
class oauthModel extends Model
{
    //获取已经安装的接口
    public function get_installed() {
        $installed_list = array();
        $installed_res = $this->order('ordid')->select();
        foreach ($installed_res as $val) {
            $installed_list[$val['code']] = $val;
        }
        return $installed_list;
    }

    //缓存有效接口
    public function oauth_cache() {
        $oauth_list = array();
        $oauth_data = $this->field('code,name,config')->where(array('status'=>'1'))->order('ordid')->select();
        foreach ($oauth_data as $val) {
            $oauth_list[$val['code']] = $val;
        }
        F('oauth_list', $oauth_list);
        return $oauth_list;
    }

    //获取未安装接口信息
    public function get_file_info($code) {
        return include(LIB_PATH . 'Pinlib/oauth/'.$code.'/info.php');
    }

    /**
     * 更新则删除缓存
     */
    protected function _before_write($data, $options) {
        F('oauth_list', NULL);
    }

    /**
     * 删除也删除缓存
     */
    protected function _after_delete($data, $options) {
        F('oauth_list', NULL);
    }
}