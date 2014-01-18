<?php

class AdminAction extends Action{
	
	public function index(){
		define('RES',THEME_PATH.'common');
		$this->display();
	}
	
	public function insert(){
		$username = $this->_post('username');
        $password =  $this->_post('password','md5');
		if(empty($username)||empty($password)){
			$this->error('请输入帐号密码',U('Admin/index'));
		}
		$code=$this->_post('code','intval,md5',0);
		if($code != $_SESSION['verify']){
			$this->error('验证码错误',U('Admin/index'));
		}
        //生成认证条件
        $map            =   array();
        // 支持使用绑定帐号登录
        $map['username'] = $username;
        $map['status']        = 1;
        $authInfo = RBAC::authenticate($map);
		//exit;
        //使用用户名、密码和状态的方式进行认证
		if($authInfo['password']!=$password)$this->error('账号密码不匹配，请认真填写');
        if((false == $authInfo)) {
            $this->error('帐号不存在或已禁用！');
        }else {
			session(C('USER_AUTH_KEY'), $authInfo['id']);
            session('userid',$authInfo['id']);  //用户ID
			session('username',$authInfo['username']);   //用户名
            session('roleid',$authInfo['role']);    //角色ID
            if($authInfo['username']==C('SPECIAL_USER')) {
                session(C('ADMIN_AUTH_KEY'), true);
            }
            //保存登录信息
            $User	=	M(C('USER_AUTH_MODEL'));
            $ip		=	get_client_ip();
            $data = array();
            if($ip){    //如果获取到客户端IP，则获取其物理位置
                $Ip = new IpLocation(); // 实例化类
                $location = $Ip->getlocation($ip); // 获取某个IP地址所在的位置
                $data['last_location'] = '';
                if($location['country'] && $location['country']!='CZ88.NET') $data['last_location'].=$location['country'];
                if($location['area'] && $location['area']!='CZ88.NET') $data['last_location'].=' '.$location['area'];
            }
            $data['id']	=	$authInfo['id'];
            $data['last_login_time']	=	time();
            $data['last_login_ip']	=	get_client_ip();
            $User->save($data);
			
            // 缓存访问权限
            RBAC::saveAccessList();
            redirect(U('System/index'));
        }
    }
	
	public function verify(){
		Image::buildImageVerify();
	}
	
    // 用户登出
    public function logout() {
		session(null);
		session_destroy();
		unset($_SESSION);
        if(session('?'.C('USER_AUTH_KEY'))) {
            session(C('USER_AUTH_KEY'),null);
           
            redirect(U('Home/Index/index'));
        }else {
            $this->error('已经登出！',U('Home/Index/index'));
        }
    }
}