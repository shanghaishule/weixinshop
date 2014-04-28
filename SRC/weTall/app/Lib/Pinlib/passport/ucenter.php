<?php

class ucenter_passport
{

    private $_error = 0;

    /**
     * 获取插件基本信息
     */
    public function get_info() {
        return array(
            'code' => 'ucenter', //插件代码必须和文件名保持一致
            'name' => 'UCenter', //整合插件名称
            'desc' => 'UCenter',
            'version' => '2.0', //整合插件的版本
            'author' => 'PinPHP TEAM', //开发者
            // 插件默认配置
            'config' => array(
                'uc_config' => array(
                    'text' => '应用的 UCenter 配置信息',
                    'type' => 'textarea',
                    'width' => '400',
                    'height' => '250',
                )
            )
        );
    }

    /**
     * 安装环境检测
     */
    public function install_check() {
        //检测client/data是否可写
        if (!is_dir('./api/uc/uc_client/data')) {
            $this->_error = L('uc_client_not_exists');
            return false;
        }
        if (!is_writeable('./api/uc/uc_client/data')) {
            $this->_error = L('uc_client_not_write');
            return false;
        }
        return true;
    }

    private function _ucenter_init() {
        $conf = C('pin_integrate_config');
        eval($conf['uc_config']);
        include_once ('./api/uc/uc_client/client.php');
    }

    /**
     * 注册新用户
     */
    public function register($username, $password, $email, $gender) {
        $this->_ucenter_init();
        $uc_uid = uc_user_register($username, $password, $email);
        if ($uc_uid < 0) {
            switch ($uc_uid) {
                case -1:
                    $this->_error = L('invalid_user_name');
                    break;
                case -2:
                    $this->_error = L('blocked_user_name');
                    break;
                case -3:
                    $this->_error = L('username_exists');
                    break;
                case -4:
                    $this->_error = L('email_error');
                    break;
                case -5:
                    $this->_error = L('blocked_email');
                    break;
                case -6:
                    $this->_error = L('email_exists');
                    break;
            }
            return false;
        }
        //返回本地数据
        return array(
            'uc_uid' => $uc_uid,
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'gender' => $gender
        );
    }

    /**
     * 编辑用户信息
     */
    public function edit($uid, $old_password, $data, $force = false) {
        $this->_ucenter_init();
        // UCenter修改
        $new_pwd = $new_email = '';
        if (isset($data['password'])) {
            $new_pwd  = $data['password'];
        }
        if (isset($data['email'])) {
            $new_email = $data['email'];
        }
        $uc_uid = M('user')->where(array('id'=>$uid))->getField('uc_uid');
        $info = $this->get($uc_uid);
        if (empty($info)) {
            $this->_error('no_such_user');
            return false;
        }
        $result = uc_user_edit($info['username'], $old_password, $new_pwd, $new_email, $force);
        if ($result != 1) {
            switch ($result) {
                case 0:
                case -7:
                    break;
                case -1:
                    $this->_error = L('auth_failed');
                    break;
                case -4:
                    $this->_error = L('email_error');
                    break;
                case -5:
                    $this->_error = L('blocked_email');
                    break;
                case -6:
                    $this->_error = L('email_exists');
                    break;
                case -8:
                    $this->_error = L('user_protected');
                    break;
                default:
                    $this->_error = L('unknow_error');
                    break;
            }
            return false;
        }
        //修改本地
        if (isset($data['password'])) {
            $data['password'] = md5($data['password']);
        }
        return $data;
    }

    /**
     * 删除用户
     */
    public function delete() {
        return true;
    }

    public function get($flag, $is_name = false) {
        $this->_ucenter_init();
        $user_info = uc_get_user($flag, !$is_name);
        if (empty($user_info)) {
            $this->_error('no_such_user');
            return false;
        }
        list($uc_uid, $username, $email) = $user_info;
        $uid = M('user')->where(array('uc_uid'))->getField('id');
        return array(
            'id' => $uid,
            'username' =>  $username,
            'email'     =>  $email
        );
    }

    /**
     * 验证用户
     */
    public function auth($username, $password) {
        $this->_ucenter_init();
        $result = uc_user_login($username, $password);
        if ($result[0] < 0) {
            switch ($result[0]) {
                case -1:
                    $this->_error = L('no_such_user');
                    break;
                case -2:
                    $this->_error = L('password_error');
                    break;
                case -3:
                    $this->_error = L('answer_error');
                    break;
                default:
                    $this->_error = L('unknow_error');
                    break;
            }
            return false;
        }
        return array('uc_uid'=>$result[0], 'username'=>$result[1], 'password'=>$result[2], 'email'=>$result[3]);
    }

    /**
     * 同步登陆
     */
    public function synlogin($uid) {
        $uc_uid = M('user')->where(array('id'=>$uid))->getField('uc_uid');
        return uc_user_synlogin($uc_uid);
    }

    public function synlogout() {
        $this->_ucenter_init();
        return uc_user_synlogout();
    }

    public function get_error() {
        return $this->_error;
    }
}