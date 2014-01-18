<?php
class item_siteAction extends backendAction {

    public function _initialize() {
        parent::_initialize();
        $this->_mod = D('item_site');
    }

    public function index() {
        //获取已经安装的接口
        $list = $this->_mod->get_installed();
        //从文件夹下面读取
        $opdir = dir(LIB_PATH . 'Pinlib/itemcollect');
        while (false !== ($entry = $opdir->read())) {
            if ($entry{0} == '.') {
                continue;
            }
            if (!isset($list[$entry])) {
                $info = $this->_mod->get_file_info($entry);
                $info['status'] = '-1';
                $info['ordid'] = '0';
                $info['id'] = '0';
                $list[$entry] = $info;
            }
        }
        $this->assign('list', $list);
        $this->assign('list_table', true);
        $this->display();
    }

    /**
     * 编辑
     */
    public function edit() {
        if (IS_POST) {
            if (false === $data = $this->_mod->create()) {
                $this->ajaxReturn(0, $this->_mod->getError());
            }
            $info = $this->_mod->get_file_info($data['code']);
            foreach ($info['config'] as $key=>$val) {
                $config[$key] = $this->_post($key);
            }
            $this->_mod->config = serialize($config);
            if (false !== $this->_mod->save()) {
                $this->ajaxReturn(1, L('operation_success'), '', 'edit');
            } else {
                $this->ajaxReturn(0, L('operation_failure'), '', 'edit');
            }
        } else {
            $id = $this->_get('id', 'intval');
            $info = $this->_mod->find($id);
            $info['config'] = unserialize($info['config']);
            $this->assign('info', $info);
            //配置文件
            $file_info = $this->_mod->get_file_info($info['code']);
            $this->assign('file_info', $file_info);
            $response = $this->fetch();
            $this->ajaxReturn(1, '', $response);
        }
    }

    /**
     * 安装
     */
    public function install() {
        if (IS_POST) {
            if (false === $data = $this->_mod->create()) {
                $this->ajaxReturn(0, $this->_mod->getError());
            }
            $info = $this->_mod->get_file_info($data['code']);
            foreach ($info['config'] as $key=>$val) {
                $config[$key] = $this->_post($key);
            }
            $this->_mod->config = serialize($config);
            if ($this->_mod->add()) {
                $this->ajaxReturn(1, L('install_success'), '', 'install');
            } else {
                $this->ajaxReturn(0, L('install_failure'), '', 'install');
            }
        } else {
            $code = $this->_get('code', 'trim');
            $info = $this->_mod->get_file_info($code);
            $this->assign('info', $info);
            $response = $this->fetch();
            $this->ajaxReturn(1, '', $response);
        }
    }
}