<?php
/**
 * 第三方程序会员数据整合插件管理程序
 */
class integrateAction extends backendAction {

    /**
     * 会员数据整合插件列表
     */
    public function index() {
        $path = LIB_PATH . 'Pinlib/passport/';
        $opdir  = dir($path);
        $list = array();
        while (false !== ($file = $opdir->read())) {
            if (!preg_match("/^.*?\.php$/", $file)) {
                continue;
            }
            $code = explode('.', $file);
            $mod = passport::uc($code[0]);
            $info = $mod->get_info();
            $list[$file] = $info;
        }
        $this->assign('list', $list);
        $this->display();
    }

    /**
     * 安装会员整合插件
     */
    public function install() {
        if (IS_POST) {
            $code = $this->_post('code', 'trim');
            $mod = passport::uc($code);
            $info = $mod->get_info();
            foreach ($info['config'] as $key => $val) {
                $config[$key] = $this->_post($key);
            }
            $config = serialize($config);
            //保存到配置表
            D('setting')->where(array('name'=>'integrate_code'))->setField('data', $code);
            D('setting')->where(array('name'=>'integrate_config'))->setField('data', $config);
            $this->success(L('operation_success'), U('integrate/index'));
        } else {
            $code = $this->_get('code', 'trim');
            if ($code == 'default') {
                D('setting')->where(array('name'=>'integrate_code'))->setField('data', $code);
                D('setting')->where(array('name'=>'integrate_config'))->setField('data', '');
                $this->success(L('operation_success'), U('integrate/index'));
            } else {
                $mod = passport::uc($code);
                //安装之前环境检测
                if (!$mod->install_check()) {
                    $this->error($mod->get_error());
                }
                //获取配置
                $info = $mod->get_info();
                $this->assign('info', $info);
                $this->display();
            }
        }
    }

    /**
     * 配置会员整合插件
     */
    public function setting() {
        if (IS_POST) {
            $code = $this->_post('code', 'trim');
            $mod = passport::uc($code);
            $info = $mod->get_info();
            foreach ($info['config'] as $key => $val) {
                $config[$key] = $this->_post($key);
            }
            $config = serialize($config);
            //保存到配置表
            D('setting')->where(array('name'=>'integrate_code'))->setField('data', $code);
            D('setting')->where(array('name'=>'integrate_config'))->setField('data', $config);
            $this->success(L('operation_success'), U('integrate/index'));
        } else {
            $code = $this->_get('code', 'trim');
            $mod = passport::uc($code);
            //获取配置项
            $info = $mod->get_info();
            $this->assign('info', $info);
            //获取配置值
            $this->assign('icv', C('pin_integrate_config'));
            $this->display();
        }
    }
}