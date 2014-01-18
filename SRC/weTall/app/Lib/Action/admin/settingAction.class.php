<?php

class settingAction extends backendAction {

    public function _initialize() {
        parent::_initialize();
        $this->_mod = D('setting');
    }

    public function index() {
        $type = $this->_get('type', 'trim', 'index');
        $this->display($type);
    }
    
    public function user() {
        $this->display();
    }

    public function edit() {
        $setting = $this->_post('setting', ',');
        
        if (!empty($_FILES['weixin_img']['name'])) {
        	 $date_dir = date('ym/d/'); //上传目录
                $result = $this->_upload($_FILES['weixin_img'], 'weixin/'.$date_dir);
                if ($result['error']) {
                    $this->error($result['info']);
                } else {
                    $data['img'] = $date_dir . $result['info'][0]['savename'];
                }
                $setting['weixin_img']=$data['img'];
            }
            
            if (!empty($_FILES['weixinshop_img']['name'])) {
        	 $date_dir = date('ym/d/'); //上传目录
                $result = $this->_upload($_FILES['weixinshop_img'], 'weixin/'.$date_dir);
                if ($result['error']) {
                    $this->error($result['info']);
                } else {
                    $data['img'] = $date_dir . $result['info'][0]['savename'];
                }
                $setting['weixinshop_img']=$data['img'];
            }
            

        foreach ($setting as $key => $val) {
            $val = is_array($val) ? serialize($val) : $val;
            $this->_mod->where(array('name' => $key))->save(array('data' => $val));
        }
        $type = $this->_post('type', 'trim', 'index');
        $this->success(L('operation_success'));
    }

    public function ajax_mail_test() {
        $email = $this->_get('email', 'trim');
        !$email && $this->ajaxReturn(0);
        //发送
        $mailer = mailer::get_instance();
        if ($mailer->send($email, L('send_test_email_subject'), L('send_test_email_body'))) {
            $this->ajaxReturn(1);
        } else {
            $this->ajaxReturn(0);
        }
    }

}