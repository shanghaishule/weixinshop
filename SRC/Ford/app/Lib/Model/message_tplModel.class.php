<?php

class message_tplModel extends Model{

    //自动完成
    protected $_auto = array(
        array('add_time', 'time', 1, 'function'),
    );

    /**
     * 获取邮件模板内容
     */
    public function get_mail_info($alias, $data = array()) {
        return $this->_fetch_tpl($alias, $data, 'mail');
    }

    /**
     * 获取短信模板内容
     */
    public function get_msg_info($alias, $data = array()) {
        return $this->_fetch_tpl($alias, $data, 'msg');
    }

    protected function _before_write($data){
        $this->_set_tpl($data['alias'], $data['type'], $data['content']);
    }

    /**
     * 模板写入到文件
     */
    private function _set_tpl($alias, $type, $content) {
        $tpl_file = $this->_get_tplfile($alias, $type);
        file_put_contents($tpl_file, $content);
    }

    /**
     * 获取模板文件
     */
    private function _get_tplfile($alias, $type) {
        return PIN_DATA_PATH . $type . '_tpl/' . $alias . '.html';
    }

    private function _fetch_tpl($alias, $data, $type) {
        $tpl_file = $this->_get_tplfile($alias, $type);
        if (!is_file($tpl_file)) {
            return false;
        }
        $tpl_data = array(
            'site_name' => C('pin_site_name'),
            'send_time' => date('Y-m-d H:i:s'),
        );
        $tpl_data = array_merge($tpl_data, $data);
        //实例化视图类
        $view = Think::instance('View');
        //模板变量传值
        $view->assign($tpl_data);
        return $view->fetch($tpl_file);
    }
}