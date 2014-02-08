<?php
class indexAction extends backendAction {

    public function _initialize() {
        parent::_initialize();
        $this->_mod = D('menu');
        $this->item_order=M('item_order');
        
    }

    public function index() {
        $this->login();   
        $top_menus = $this->_mod->admin_menu(0);
        $this->assign('top_menus', $top_menus);
        $my_admin = array('username'=>$_SESSION['admin']['username'], 'rolename'=>$_SESSION['admin']['role_id']);
        $this->assign('my_admin', $my_admin);

        $this->assign('tokenTall', $this->getTokenTall());
        $_SESSION["tokenTall"] = $this->getTokenTall();
        $this->display(); 
    }

    public function panel() {

    	$map = array();
    	$UserDB = D('info_notice');
    	/*店铺*/
    	$weChaShop = M("wecha_shop");
    	$count = $UserDB->where($map)->count();
    	$Page       = new Page($count,8);// 实例化分页类 传入总记录数
    	// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
    	$nowPage = isset($_GET['p'])?$_GET['p']:1;
    	$show       = $Page->show();// 分页显示输出
    	$list2 = $UserDB->where($map)->order('ptime DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
    	foreach ($list2 as $content){
    		if(strlen($content["content"]) > 60){
    			$content["content"] = mb_substr($content["content"], 0,33,"utf-8")."...";
    		}
    		if(strlen($content["title"]) > 10){
    			$content["title"] = mb_substr($content["title"], 0,10,"utf-8")."...";
    		}
    		$list[] = $content;
    	}
    	
    	//tax for mall
    	$tax = M("set_tax");
    	$currentTax = $tax->find();//var_dump($currentTax);die();
    	
    	$this->assign("currentTax",$currentTax);
    	$this->assign('list',$list);
    	$this->assign('page',$show);// 赋值分页输出pti

    	$tokenTall = $this->getTokenTall();
    	$weshopData["tokenTall"] = $tokenTall;
    	$weChaShopDetail = $weChaShop->where($weshopData)->find();//商城基本信息var_dump($weChaShopDetail);die();
    	$this->assign("weshopData",$weChaShopDetail);
    	$this->assign('tokenTall', $tokenTall);

    	$result2 = include './../data/conf/info.php';
    	$this->assign("weQQ",$result2["site_qq"]);
    	
        $message = array();
        if (is_dir('./install')) {
            $message[] = array(
                'type' => 'error',
                'content' => "您还没有删除 install 文件夹，出于安全的考虑，我们建议您删除 install 文件夹。",
            );
        }
        if (APP_DEBUG == true) {
            $message[] = array(
                'type' => 'error',
                'content' => "您网站的 DEBUG 没有关闭，出于安全考虑，我们建议您关闭程序 DEBUG。",
            );
        }
        if (!function_exists("curl_getinfo")) {
            $message[] = array(
                'type' => 'error',
                'content' => "系统不支持 CURL ,将无法采集商品数据。",
            );
        }
        $this->assign('message', $message);
        $system_info = array(
            'pinphp_version' => PIN_VERSION . ' RELEASE '. PIN_RELEASE .' [<a href="http://www.pinphp.com/" class="blue" target="_blank">查看最新版本</a>]',
            'server_domain' => $_SERVER['SERVER_NAME'] . ' [ ' . gethostbyname($_SERVER['SERVER_NAME']) . ' ]',
            'server_os' => PHP_OS,
            'web_server' => $_SERVER["SERVER_SOFTWARE"],
            'php_version' => PHP_VERSION,
            'mysql_version' => mysql_get_server_info(),
            'upload_max_filesize' => ini_get('upload_max_filesize'),
            'max_execution_time' => ini_get('max_execution_time') . '秒',
            'safe_mode' => (boolean) ini_get('safe_mode') ?  L('yes') : L('no'),
            'zlib' => function_exists('gzclose') ?  L('yes') : L('no'),
            'curl' => function_exists("curl_getinfo") ? L('yes') : L('no'),
            'timezone' => function_exists("date_default_timezone_get") ? date_default_timezone_get() : L('no')
        );
        $this->assign('system_info', $system_info);
        
        
        
        $buycount= M('item')->where(array('status'=>1,'tokenTall'=>$tokenTall))->count();
        $nobuycount= M('item')->where(array('status'=>0,'tokenTall'=>$tokenTall))->count();
        
        $fukuan= $this->item_order->where(array('status'=>1,'tokenTall'=>$tokenTall))->count();
        $fahuo= $this->item_order->where(array('status'=>2,'tokenTall'=>$tokenTall))->count();
        $yfahuo= $this->item_order->where(array('status'=>3,'tokenTall'=>$tokenTall))->count();
        $this->assign('count',
        array('fukuan'=>$fukuan,
        'fahuo'=>$fahuo,
        'yfahuo'=>$yfahuo,
        'buycount'=>$buycount,
        'nobuycount'=>$nobuycount
        )
        );
        
        $this->display();
    }

    public function login() {
       // if (IS_POST) {
            $username = 'admin';
            $password = 'admin';
           // $verify_code = $this->_post('verify_code', 'trim');
          //  if(session('verify') != md5($verify_code)){
          //      $this->error(L('verify_code_error'));
           // }
			$where['username'] = $username;
			$where['status'] = 1;
            $admin = M('admin')->where($where)->find();
            if (!$admin) {
                $this->error(L('admin_not_exist'));
            }
            if ($admin['password'] != md5($password)) {
                $this->error(L('password_error'));
            }
            session('admin', array(
                'id' => $admin['id'],
                'role_id' => $admin['role_id'],
                'username' => $admin['username'],
            ));
            M('admin')->where(array('id'=>$admin['id']))->save(array('last_time'=>time(), 'last_ip'=>get_client_ip()));
        //    $this->success(L('login_success'), U('index/index'));
       // } else {
       //     $this->display();
      //  }
    }

    public function logout() {
        session('admin', null);
        $this->success(L('logout_success'), U('index/login'));
        exit;
    }

    public function verify_code() {
        Image::buildImageVerify(4,1,'gif','50','24');
    }

    public function left() {
        $menuid = $this->_request('menuid', 'intval');
        if ($menuid) {
            $left_menu = $this->_mod->admin_menu($menuid);
            foreach ($left_menu as $key=>$val) {
                $left_menu[$key]['sub'] = $this->_mod->admin_menu($val['id']);
            }
        } else {
            $left_menu[0] = array('id'=>0,'name'=>'商品管理');
            $left_menu[0]['sub'] = array();
            if ($r = $this->_mod->where(array('often'=>0))->select()) {
                $left_menu[0]['sub'] = $r;
            }
            
            $left_menu[1] = array('id'=>1,'name'=>'交易管理');
            $left_menu[1]['sub'] = array();
            if ($r = $this->_mod->where(array('often'=>1))->select()) {
                $left_menu[1]['sub'] = $r;
            }
            $left_menu[2] = array('id'=>2,'name'=>'广告管理');
            $left_menu[2]['sub'] = array();
            if ($r = $this->_mod->where(array('often'=>2))->select()) {
                $left_menu[2]['sub'] = $r;
            }
            $left_menu[3] = array('id'=>3,'name'=>'账务管理');
            $left_menu[3]['sub'] = array();
            if ($r = $this->_mod->where(array('often'=>3))->select()) {
            	$left_menu[3]['sub'] = $r;
            }
            
            
            $left_menu[99] = array('id'=>99,'name'=>'店铺管理');
            $left_menu[99]['sub'] = array();
            if ($r = $this->_mod->where(array('often'=>99))->select()) {
                $left_menu[99]['sub'] = $r;
            }

            array_unshift($left_menu[0]['sub'], array('id'=>0,'name'=>'后台首页','module_name'=>'index','action_name'=>'often_menu'));
        }
        $this->assign('left_menu', $left_menu);
        $this->assign('tokenTall', $this->getTokenTall());
        $this->display();
    }

    public function often() {
        if (isset($_POST['do'])) {
            $id_arr = isset($_POST['id']) && is_array($_POST['id']) ? $_POST['id'] : '';
            $this->_mod->where(array('ofen'=>1))->save(array('often'=>0));
            $id_str = implode(',', $id_arr);
            $this->_mod->where('id IN('.$id_str.')')->save(array('often'=>1));
            $this->success(L('operation_success'));
        } else {
            $r = $this->_mod->admin_menu(0);
            $list = array();
            foreach ($r as $v) {
                $v['sub'] = $this->_mod->admin_menu($v['id']);
                foreach ($v['sub'] as $key=>$sv) {
                    $v['sub'][$key]['sub'] = $this->_mod->admin_menu($sv['id']);
                }
                $list[] = $v;
            }
            $this->assign('list', $list);
            $this->display();
        }
    }

    public function map() {
        $r = $this->_mod->admin_menu(0);
        $list = array();
        foreach ($r as $v) {
            $v['sub'] = $this->_mod->admin_menu($v['id']);
            foreach ($v['sub'] as $key=>$sv) {
                $v['sub'][$key]['sub'] = $this->_mod->admin_menu($sv['id']);
            }
            $list[] = $v;
        }
        $this->assign('list', $list);
        $this->display();
    }
}
