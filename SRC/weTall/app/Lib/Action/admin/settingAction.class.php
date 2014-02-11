<?php

class settingAction extends backendAction {

    public function _initialize() {
        parent::_initialize();
        $this->_mod = M('wecha_shop');
    }

    public function index() {
    	$where["tokenTall"]=$_SESSION["tokenTall"];
        $wecha_shop = $this->_mod->where($where)->find();
        $this->assign("wecha_shop",$wecha_shop);
        $this->display();
    }
    
    public function user() {
        $this->display();
    }

    public function edit() {
//         $setting = $this->_post('setting', ',');
        
//         if (!empty($_FILES['weixin_img']['name'])) {
//         	 $date_dir = date('ym/d/'); //上传目录
//                 $result = $this->_upload($_FILES['weixin_img'], 'weixin/'.$date_dir);
//                 if ($result['error']) {
//                     $this->error($result['info']);
//                 } else {
//                     $data['img'] = $date_dir . $result['info'][0]['savename'];
//                 }
//                 $setting['weixin_img']=$data['img'];
//             }
            
//             if (!empty($_FILES['weixinshop_img']['name'])) {
//         	 $date_dir = date('ym/d/'); //上传目录
//                 $result = $this->_upload($_FILES['weixinshop_img'], 'weixin/'.$date_dir);
//                 if ($result['error']) {
//                     $this->error($result['info']);
//                 } else {
//                     $data['img'] = $date_dir . $result['info'][0]['savename'];
//                 }
//                 $setting['weixinshop_img']=$data['img'];
//             }
            

//         foreach ($setting as $key => $val) {
//             $val = is_array($val) ? serialize($val) : $val;
//             $this->_mod->where(array('name' => $key))->save(array('data' => $val));
//         }
        $data=$_POST;
        $weChaShop = M("wecha_shop");
        
        $wechaData1["tokenTall"] = $_SESSION["tokenTall"];
        $weChaShop->where($wechaData1)->save($data);

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