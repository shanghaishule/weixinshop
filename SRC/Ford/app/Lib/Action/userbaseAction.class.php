<?php
/**
 * 用户控制器基类
 *
 * @author andery
 */
class userbaseAction extends frontendAction {

    public function _initialize(){
        parent::_initialize();
        //访问者控制
        if (!$this->visitor->is_login && !in_array(ACTION_NAME, array('login', 'register', 'binding', 'ajax_check'))) {
            IS_AJAX && $this->ajaxReturn(0, L('login_please'));
            $tokenTall = $this->_get('tokenTall', 'trim', '');
            $this->redirect('user/login', array('tokenTall'=>$tokenTall));
        }
        $this->_curr_menu(ACTION_NAME);
    }

    protected function _curr_menu($menu = 'index') {
        $menu_list = $this->_get_menu();
        $this->assign('user_menu_list', $menu_list);
        $this->assign('user_menu_curr', $menu);
    }

    private function _get_menu() {
        $menu = array();
        $menu = array(
            'setting' => array(
                'text' => '帐号设置',
                'submenu' => array(
                    'index' => array('text'=>'基本信息', 'url'=>U('user/index')),
                    'password' => array('text'=>'修改密码', 'url'=>U('user/password')),
                    'bind' => array('text'=>'帐号绑定', 'url'=>U('user/bind')),
                    'custom' => array('text'=>'个人封面', 'url'=>U('user/custom')),
                    'address' => array('text'=>'收货地址', 'url'=>U('user/address')),
                )
            ),
            'score' => array(
                'text' => '积分帐户',
                'submenu' => array(
                    'order' => array('text'=>'积分订单', 'url'=>U('score/index')),
                    'logs' => array('text'=>'积分记录', 'url'=>U('score/logs')),
                )
            ),
            'message' => array(
                'text' => '消息中心',
                'submenu' => array(
                    'message' => array('text'=>'我的私信', 'url'=>U('message/index')),
                    'system' => array('text'=>'系统通知', 'url'=>U('message/system')),
                )
            )
        );
        return $menu;
    }
}