<?php

class settingModel extends Model
{

    /**
     * 获取配置信息写入缓存
     */
    public function setting_cache() {
        $setting = array();
        $res = $this->getField('name,data');
        foreach ($res as $key=>$val) {
            $setting['pin_'.$key] = unserialize($val) ? unserialize($val) : $val;
        }
        F('setting', $setting);
        return $setting;
    }

    /**
     * 后台有更新则删除缓存
     */
    protected function _before_write($data, $options) {
        F('setting', NULL);
    }
}