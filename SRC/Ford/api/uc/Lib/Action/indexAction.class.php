<?php
define('UC_CLIENT_VERSION', '1.6.0');
define('UC_CLIENT_RELEASE', '20110501');

define('API_DELETEUSER', 1);
define('API_RENAMEUSER', 1);
define('API_GETTAG', 1);
define('API_SYNLOGIN', 1);
define('API_SYNLOGOUT', 1);
define('API_UPDATEPW', 1);
define('API_UPDATEBADWORDS', 1);
define('API_UPDATEHOSTS', 1);
define('API_UPDATEAPPS', 1);
define('API_UPDATECLIENT', 1);
define('API_UPDATECREDIT', 1);
define('API_GETCREDIT', 1);
define('API_GETCREDITSETTINGS', 1);
define('API_UPDATECREDITSETTINGS', 1);
define('API_ADDFEED', 1);
define('API_RETURN_SUCCEED', '1');
define('API_RETURN_FAILED', '-1');
define('API_RETURN_FORBIDDEN', '1');

define('IN_API', true);
define('CURSCRIPT', 'api');

class indexAction extends Action {

    public function _initialize() {
        $integrate_config = M('setting')->where(array('name'=>'integrate_config'))->getField('data');
        $conf = unserialize($integrate_config);
        eval($conf['uc_config']);
        include_once APP_PATH . 'uc_client/client.php';
        include_once PINPHP_PATH . 'app/Lib/Model/userModel.class.php';
        $this->_user_mod = D('user');
    }

    public function index() {
        $get = $post = array();
        $code = @$_GET['code'];
        parse_str(uc_authcode($code, 'DECODE', UC_KEY), $get);
        if(get_magic_quotes_gpc()) {
            $get = uc_stripslashes($get);
        }
        $timestamp = time();
        if($timestamp - $get['time'] > 3600) {
            exit('Authracation has expiried');
        }
        if(empty($get)) {
            exit('Invalid Request');
        }
        $action = $get['action'];

        include_once APP_PATH . 'uc_client/lib/xml.class.php';
        $post = xml_unserialize(file_get_contents('php://input'));

        if(in_array($get['action'], array('test', 'deleteuser', 'renameuser', 'gettag', 'synlogin', 'synlogout', 'updatepw', 'updatebadwords', 'updatehosts', 'updateapps', 'updateclient', 'updatecredit', 'getcreditsettings', 'updatecreditsettings'))) {
            exit($this->$get['action']($get, $post));
        } else {
            exit(API_RETURN_FAILED);
        }
    }

    /**
     * 检测通信
     */
    public function test($get, $post) {
        return API_RETURN_SUCCEED;
    }

    /**
     * 删除用户
     */
    public function deleteuser($get, $post) {
        if (!API_DELETEUSER) {
            return API_RETURN_FORBIDDEN;
        }
        $this->_user_mod->delete($get['ids']);

        return API_RETURN_SUCCEED;
    }

    /**
     * 修改用户名
     */
    public function renameuser() {
        if(!API_RENAMEUSER) {
            return API_RETURN_FORBIDDEN;
        }
        $uc_uid = $get['uid'];
        $usernameold = $get['oldusername'];
        $usernamenew = $get['newusername'];
        //更新其他表用户名放到用户模型
        if (!$this->_user_mod->rename(array('uc_uid'=>$uc_uid, 'username'=>$usernameold), $usernamenew)) {
            return API_RETURN_FAILED;
        }
        return API_RETURN_SUCCEED;
    }

    /**
     * 修改密码
     */
    public function updatepw() {
        return API_RETURN_SUCCEED;
    }
    
    /**
     * 同步登陆 
     */
    public function synlogin($get, $post) {
        if(!API_SYNLOGIN) {
            return API_RETURN_FORBIDDEN;
        }
        header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
        $username = trim($get['username']);
        $login_time = $get['time'];

        $user_info = $this->_user_mod->field('id,username')->where(array('username'=>$username))->find();
        if (!$user_info) {
            $uc_user = uc_get_user($username);
            $user_id = $this->_user_mod->add(array(
                'uc_uid' => $uc_user['uid'],
                'username' => $uc_user['username'],
                'password' => md5(time() . rand(100000, 999999)),
                'email' => $uc_user['email'],
            ));
            $user_info = array('id' => $user_id, 'username' => $username);
        }

        //登陆
        $this->_api_visitor()->assign_info($user_info);

        // 更新用户信息
        $this->_user_mod->where(array('id'=>$user_info['id']))->save(array(
            'last_time' => $login_time,
            'last_ip' => get_client_ip(),
        ));

        return API_RETURN_SUCCEED;
    }
    
    /**
     * 同步退出
     */
    public function synlogout($get, $post) {
        header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
        $this->_api_visitor()->logout();

        return API_RETURN_SUCCEED;
    }

    /**
     * 更新应用列表
     */
    public function updateapps($get, $post) {
        if (!API_UPDATEAPPS) {
            return API_RETURN_FORBIDDEN;
        }
        $UC_API = $post['UC_API'];
        //note 写 app 缓存文件
        $cachefile = APP_PATH.'uc_client/data/cache/apps.php';
        $fp = fopen($cachefile, 'w');
        $s = "<?php\r\n";
        $s .= '$_CACHE[\'apps\'] = '.var_export($post, TRUE).";\r\n";
        fwrite($fp, $s);
        fclose($fp);

        return API_RETURN_SUCCEED;
    }

    /**
     * 更新客户端缓存
     */
    function updateclient($get, $post) {
        if (!API_UPDATECLIENT) {
            return API_RETURN_FORBIDDEN;
        }
        $cachefile = APP_PATH.'uc_client/data/cache/settings.php';
        $fp = fopen($cachefile, 'w');
        $s = "<?php\r\n";
        $s .= '$_CACHE[\'settings\'] = '.var_export($post, TRUE).";\r\n";
        fwrite($fp, $s);
        fclose($fp);

        return API_RETURN_SUCCEED;
    }

    /**
     * 访问者
     */
    private function _api_visitor() {
        include_once (PINPHP_PATH . 'app/Lib/Pinlib/user_visitor.class.php');
        return new user_visitor();
    }
}