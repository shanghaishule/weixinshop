<?php

class userAction extends userbaseAction {
	public $commetns_mod;
	public function _initialize(){
		parent::_initialize();
		$this->commetns_mod = M('comments');
	}
	
	public function ajaxlogin()
    {
       $user_name=$_POST['user_name'];
       $password=$_POST['password'];
       
       $user=M('user');
       $users= $user->field('id,username')->where("username='".$user_name."' and password='".md5($password)."'")->find(); 
       if(is_array($users))
       {
    	$data = array('status'=>1);
    	
       }else {
       	$data = array('status'=>0);
       }
    	
    	echo json_encode($data);
    	exit;
    
    }
	
    /**
     * 用户登陆
     */
    public function login() {
    	$tokenTall = $this->getTokenTall();
    	$this->assign('tokenTall', $tokenTall);
        $this->visitor->is_login && $this->redirect('user/index', array('tokenTall'=>$tokenTall));
        if (IS_POST) {
            $username = $this->_post('username', 'trim');
            $password = $this->_post('password', 'trim');
            $remember = $this->_post('remember');
            if (empty($username)) {
                IS_AJAX && $this->ajaxReturn(0, L('please_input').L('password'));
                $this->error(L('please_input').L('username'));
            }
            if (empty($username)) {
                IS_AJAX && $this->ajaxReturn(0, L('please_input').L('password'));
                $this->error(L('please_input').L('password'));
            }
            //连接用户中心
            $passport = $this->_user_server();
            $uid = $passport->auth($username, $password);
            if (!$uid) {
                IS_AJAX && $this->ajaxReturn(0, $passport->get_error());
                $this->error($passport->get_error());
            }
            //登陆
            $this->visitor->login($uid, $remember);
            //登陆完成钩子
            $tag_arg = array('uid'=>$uid, 'uname'=>$username, 'action'=>'login');
            tag('login_end', $tag_arg);
            //同步登陆
            $synlogin = $passport->synlogin($uid);
            if (IS_AJAX) {
                $this->ajaxReturn(1, L('login_successe').$synlogin);
            } else {
                //跳转到登陆前页面（执行同步操作）
                $ret_url = $this->_post('ret_url', 'trim');
                $this->success(L('login_successe').$synlogin, $ret_url);
            }
        } else {
            /* 同步退出外部系统 */
            if (!empty($_GET['synlogout'])) {
                $passport = $this->_user_server();
                $synlogout = $passport->synlogout();
            }
            if (IS_AJAX) {
                $resp = $this->fetch('dialog:login');
                $this->ajaxReturn(1, '', $resp);
            } else {
                //来路
                $ret_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : __APP__;
                $this->assign('ret_url', $ret_url);
                $this->assign('synlogout', $synlogout);
                $this->_config_seo();
                $this->display();
            }
        }
    }
    
    public function addaddress()
    {
    	//取商家token值，取不到则默认为空
    	$tokenTall = $this->getTokenTall();

    	if(IS_POST)
    	{
	    	$user_address = M('user_address');
	    	
	    	$consignee= $this->_post('consignee', 'trim');
	    	$sheng= $this->_post('sheng', 'trim');
	    	$shi= $this->_post('shi', 'trim');
	    	$qu= $this->_post('qu', 'trim');
	    	$address= $this->_post('address', 'trim');
	    	$phone_mob= $this->_post('phone_mob', 'trim');
	    	
	    	$data['uid']=$this->visitor->info['id'];
	    	$data['consignee']=$consignee;
	        $data['sheng']=$sheng;
	    	$data['shi']=$shi;
	    	$data['qu']=$qu;
	    	$data['address']=$address;
	    	$data['mobile']=$phone_mob;
    	
    		//echo $this->visitor->info['id'];
    	
	        if($user_address->data($data)->add()!==false)
	        {
	        	$this->redirect('user/address',array('tokenTall'=>$tokenTall));
	        }
    	}
    	$this->assign('tokenTall',$tokenTall);
    	$this->display();
    }

    /**
     * 用户退出
     */
    public function logout() {
        $this->visitor->logout();
        //同步退出
        $passport = $this->_user_server();
        $synlogout = $passport->synlogout();
        //跳转到退出前页面（执行同步操作）
        //取商家token值，取不到则默认为空
        $tokenTall = $this->getTokenTall();
        $this->assign('tokenTall',$tokenTall);
        $this->success(L('logout_successe').$synlogout, U('user/index',array('tokenTall'=>$tokenTall)));
    }

    /**
     * 用户绑定
     */
    public function binding() {
        $user_bind_info = object_to_array(cookie('user_bind_info'));
        $this->assign('user_bind_info', $user_bind_info);
        $this->_config_seo();
        $this->display();
    }

    /**
    * 用户注册
    */
    public function register() {
    	$tokenTall = $this->getTokenTall();
        $this->visitor->is_login && $this->redirect('user/index', array('tokenTall'=>$tokenTall));
        if (IS_POST) {
            $username = $this->_post('user_name', 'trim');
            $email = $this->_post('email','trim');
            $password = $this->_post('password', 'trim');
            $repassword = $this->_post('password_confirm', 'trim');
            if ($password != $repassword) {
                $this->error(L('inconsistent_password')); //确认密码
            }
            $gender = $this->_post('gender','intval', '0');
            //用户禁止
            $ipban_mod = D('ipban');
            $ipban_mod->clear(); //清除过期数据
            $is_ban = $ipban_mod->where("(type='name' AND name='".$username."') OR (type='email' AND name='".$email."')")->count();
            $is_ban && $this->error(L('register_ban'));
         
            //连接用户中心
            $passport = $this->_user_server();
            //注册
            $uid = $passport->register($username, $password, $email, $gender);
            !$uid && $this->error($passport->get_error());

            //注册完成钩子
            $tag_arg = array('uid'=>$uid, 'uname'=>$username, 'action'=>'register');
            //tag('register_end', $tag_arg);
            
            //登陆
            $this->visitor->login($uid);
            
            //登陆完成钩子
            $tag_arg = array('uid'=>$uid, 'uname'=>$username, 'action'=>'login');
            //tag('login_end', $tag_arg);
            
            //同步登陆
            $synlogin = $passport->synlogin($uid);
            $this->redirect('user/index', array('tokenTall'=>$tokenTall));
           // $this->success(L('register_successe').$synlogin, U('user/index'));

            exit;
        } else {
            //关闭注册
            if (!C('pin_reg_status')) {
                $this->error(C('pin_reg_closed_reason'));
            }
            $this->_config_seo();
            $this->display();
        }
    }

    /**
     * 第三方头像保存
     */
    private function _save_avatar($uid, $img) {
        //获取后台头像规格设置
        $avatar_size = explode(',', C('pin_avatar_size'));
        //会员头像保存文件夹
        $avatar_dir = C('pin_attach_path') . 'avatar/' . avatar_dir($uid);
        !is_dir($avatar_dir) && mkdir($avatar_dir,0777,true);
        //生成缩略图
        $img = C('pin_attach_path') . 'avatar/temp/' . $img;
        foreach ($avatar_size as $size) {
            Image::thumb($img, $avatar_dir.md5($uid).'_'.$size.'.jpg', '', $size, $size, true);
        }
        @unlink($img);
    }
    
    /**
     * 用户消息提示 
     */
    public function msgtip() {
        $result = D('user_msgtip')->get_list($this->visitor->info['id']);
        $this->ajaxReturn(1, '', $result);
    }

    /**
    * 基本信息修改
    */
    public function index() {
    	//取商家token值，取不到则默认为空
    	$tokenTall = $this->getTokenTall();
 	
        $item_order=M('item_order');
        $order_detail=M('order_detail');
        if(!isset($_GET['status']))
        {
      	    $status=1;
        }
        else
        {
      	    $status=$_GET['status'];
        }
      
        $item_orders= $item_order->order('id desc')->where(array('status'=>$status,userId=>$this->visitor->info['id']))->select();
        foreach ($item_orders as $key=>$val)
        {
      		$order_details = $order_detail->where("orderId='".$val['orderId']."'")->select();
	      	foreach ($order_details as $val)
	      	{
	      		$items = array('title'=>$val['title'],'img'=>$val['img'],'price'=>$val['price'],'quantity'=>$val['quantity'],'itemId'=>$val['itemId'],'size'=>$val['size'],'color'=>$val['color']);
	      		$item_orders[$key]['items'][] = $items;
	      	}
        }
      
       $this->assign('item_orders',$item_orders);
       $this->assign('status',$status);
       $this->assign('tokenTall',$tokenTall);
       $this->_config_seo();
       $this->display();
    }

    /**
     * 修改头像
     */
    public function upload_avatar() {

        if (!empty($_FILES['avatar']['name'])) {
            //会员头像规格
            $avatar_size = explode(',', C('pin_avatar_size'));
            //回去会员头像保存文件夹
            $uid = abs(intval($this->visitor->info['id']));
            $suid = sprintf("%09d", $uid);
            $dir1 = substr($suid, 0, 3);
            $dir2 = substr($suid, 3, 2);
            $dir3 = substr($suid, 5, 2);
            $avatar_dir = $dir1.'/'.$dir2.'/'.$dir3.'/';
            //上传头像
            $suffix = '';
            foreach ($avatar_size as $size) {
                $suffix .= '_'.$size.',';
            }
            $result = $this->_upload($_FILES['avatar'], 'avatar/'.$avatar_dir, array(
                'width'=>C('pin_avatar_size'), 
                'height'=>C('pin_avatar_size'),
                'remove_origin'=>true, 
                'suffix'=>trim($suffix, ','),
                'ext' => 'jpg',
            ), md5($uid));
            if ($result['error']) {
                $this->ajaxReturn(0, $result['info']);
            } else {
                $data = __ROOT__.'/data/upload/avatar/'.$avatar_dir.md5($uid).'_'.$size.'.jpg?'.time();
                $this->ajaxReturn(1, L('upload_success'), $data);
            }
        } else {
            $this->ajaxReturn(0, L('illegal_parameters'));
        }
    }

    /**
     * 修改密码
     */
    public function password() {
        if( IS_POST ){
            $oldpassword = $this->_post('oldpassword','trim');
            $password   = $this->_post('password','trim');
            $repassword = $this->_post('repassword','trim');
            !$password && $this->error(L('no_new_password'));
            $password != $repassword && $this->error(L('inconsistent_password'));
            $passlen = strlen($password);
            if ($passlen < 6 || $passlen > 20) {
                $this->error('password_length_error');
            }
            //连接用户中心
            $passport = $this->_user_server();
            $result = $passport->edit($this->visitor->info['id'], $oldpassword, array('password'=>$password));
            if ($result) {
                $msg = array('status'=>1, 'info'=>L('edit_password_success'));
            } else {
                $msg = array('status'=>0, 'info'=>$passport->get_error());
            }
            $this->assign('msg', $msg);
        }
        $this->_config_seo();
        $this->display();
    }

    /**
     * 帐号绑定
     */
    public function bind() {
        //获取已经绑定列表
        $bind_list = M('user_bind')->field('type')->where(array('uid'=>$this->visitor->info['id']))->select();
        $binds = array();
        if ($bind_list) {
            foreach ($bind_list as $val) {
                $binds[] = $val['type'];
            }
        }
        
        //获取网站支持列表
        $oauth_list = $this->oauth_list;
        foreach ($oauth_list as $type => $_oauth) {
            $oauth_list[$type]['isbind'] = '0';
            if (in_array($type, $binds)) {
                $oauth_list[$type]['isbind'] = '1';
            }
        }
        $this->assign('oauth_list', $oauth_list);
        $this->_config_seo();
        $this->display();
    }

    /**
     * 个人空间banner背景设置
     */
    public function custom() {
        $cover = $this->visitor->get('cover');
        $this->assign('cover', $cover);
        $this->_config_seo();
        $this->display();
    }

    /**
     * 取消封面
     */
    public function cancle_cover() {
        $result = M('user')->where(array('id'=>$this->visitor->info['id']))->setField('cover', '');
        !$result && $this->ajaxReturn(0, L('illegal_parameters'));
        $this->ajaxReturn(1, L('edit_success'));
    }

    /**
     * 上传封面图片
     */
    public function upload_cover() {
        if (!empty($_FILES['cover']['name'])) {
            $data_dir = date('ym/d');
            $file_name = md5($this->visitor->info['id']);
            $result = $this->_upload($_FILES['cover'], 'cover/'.$data_dir, array('width'=>'900', 'height'=>'330', 'remove_origin'=>true), $file_name);
            if ($result['error']) {
                $this->ajaxReturn(0, $result['info']);
            } else {
                $ext = array_pop(explode('.', $result['info'][0]['savename']));
                $cover = $data_dir.'/'.$file_name.'_thumb.'.$ext;
                $data = '<img src="./data/upload/cover/'.$data_dir.'/'.$file_name.'_thumb.'.$ext.'?'.time().'">';
                //更新数据
                M('user')->where(array('id'=>$this->visitor->info['id']))->setField('cover', $cover);
                $this->ajaxReturn(1, L('upload_success'), $data);
            }
        } else {
            $this->ajaxReturn(0, L('illegal_parameters'));
        }
    }

    
    public function edit_address()
    {
        $user_address_mod = M('user_address');
        $id = $this->_get('id', 'intval');
        $info = $user_address_mod->find($id);
        $this->assign('info', $info);
        //取商家token值，取不到则默认为空
        $tokenTall = $this->getTokenTall();
        $this->assign('tokenTall',$tokenTall);
    	$this->display();
    }
    
    /**
     * 收货地址
     */
    public function address() {
        $user_address_mod = M('user_address');
        $id = $this->_get('id', 'intval');
        $type = $this->_get('type', 'trim', 'edit');
        if ($id) {
            if ($type == 'del') {
                $user_address_mod->where(array('id'=>$id, 'uid'=>$this->visitor->info['id']))->delete();
                $msg = array('status'=>1, 'info'=>L('delete_success'));
                $this->assign('msg', $msg);
            } else {
                $info = $user_address_mod->find($id);
                $this->assign('info', $info);
            }
        }
        if (IS_POST) {
            $consignee = $this->_post('consignee', 'trim');
            $address = $this->_post('address', 'trim');
         	//   $zip = $this->_post('zip', 'trim');
	        $mobile = $this->_post('phone_mob', 'trim');
	        $sheng = $this->_post('sheng', 'trim');
	        $shi = $this->_post('shi', 'trim');
	        $qu = $this->_post('qu', 'trim');
            $id = $this->_post('id', 'intval');
            if ($id) {
                $result = $user_address_mod->where(array('id'=>$id, 'uid'=>$this->visitor->info['id']))->save(array(
                    'consignee' => $consignee,
                    'address' => $address,
                    // 'zip' => $zip,
                    'mobile' => $mobile,
                    'sheng' => $sheng,
                    'shi' => $shi,
                    'qu' => $qu,
                ));
                if ($result) {
                    $msg = array('status'=>1, 'info'=>L('edit_success'));
                } else {
                    $msg = array('status'=>0, 'info'=>L('edit_failed'));
                }
            } else {
                $result = $user_address_mod->add(array(
                    'uid' => $this->visitor->info['id'],
                    'consignee' => $consignee,
                    'address' => $address,
                    'zip' => $zip,
                    'mobile' => $mobile,
                ));
                if ($result) {
                    $msg = array('status'=>1, 'info'=>L('add_address_success'));
                } else {
                    $msg = array('status'=>0, 'info'=>L('add_address_failed'));
                }
            }
            $this->assign('msg', $msg);
        }
        
        $address_list = $user_address_mod->where(array('uid'=>$this->visitor->info['id']))->select();
        $this->assign('address_list', $address_list);
        //取商家token值，取不到则默认为空
        $tokenTall = $this->getTokenTall();
        $this->assign('tokenTall',$tokenTall);
        
        $this->_config_seo();
        $this->display();
    }
   
    /**
     * 检测用户
     */
    public function ajax_check() {
        $type = $this->_get('type', 'trim', 'email');
        $user_mod = D('user');
        switch ($type) {
            case 'email':
                $email = $this->_get('J_email', 'trim');
                $user_mod->email_exists($email) ? $this->ajaxReturn(0) : $this->ajaxReturn(1);
                break;
            
            case 'username':
                $username = $this->_get('J_username', 'trim');
                $user_mod->name_exists($username) ? $this->ajaxReturn(0) : $this->ajaxReturn(1);
                break;
        }
    }

    /**
     * 关注
     */
    public function follow() {
        $uid = $this->_get('uid', 'intval');
        !$uid && $this->ajaxReturn(0, L('follow_invalid_user'));
        $uid == $this->visitor->info['id'] && $this->ajaxReturn(0, L('follow_self_not_allow'));
        $user_mod = M('user');
        if (!$user_mod->where(array('id'=>$uid))->count('id')) {
            $this->ajaxReturn(0, L('follow_invalid_user'));
        }
        $user_follow_mod = M('user_follow');
        //已经关注？
        $is_follow = $user_follow_mod->where(array('uid'=>$this->visitor->info['id'], 'follow_uid'=>$uid))->count();
        $is_follow && $this->ajaxReturn(0, L('user_is_followed'));
        //关注动作
        $return = 1;
        //他是否已经关注我
        $map = array('uid'=>$uid, 'follow_uid'=>$this->visitor->info['id']);
        $isfollow_me = $user_follow_mod->where($map)->count();
        $data = array('uid'=>$this->visitor->info['id'], 'follow_uid'=>$uid, 'add_time'=>time());
        if ($isfollow_me) {
            $data['mutually'] = 1; //互相关注
            $user_follow_mod->where($map)->setField('mutually', 1); //更新他关注我的记录为互相关注
            $return = 2;
        }
        $result = $user_follow_mod->add($data);
        !$result && $this->ajaxReturn(0, L('follow_user_failed'));
        //增加我的关注人数
        $user_mod->where(array('id'=>$this->visitor->info['id']))->setInc('follows');
        //增加Ta的粉丝人数
        $user_mod->where(array('id'=>$uid))->setInc('fans');
        //提醒被关注的人
        D('user_msgtip')->add_tip($uid, 1);
        //把他的微薄推送给我
        //TODO...是否有必要？
        $this->ajaxReturn(1, L('follow_user_success'), $return);
    }

    /**
     * 取消关注
     */
    public function unfollow() {
        $uid = $this->_get('uid', 'intval');
        !$uid && $this->ajaxReturn(0, L('unfollow_invalid_user'));
        $user_follow_mod = M('user_follow');
        if ($user_follow_mod->where(array('uid'=>$this->visitor->info['id'], 'follow_uid'=>$uid))->delete()) {
            $user_mod = M('user');
            //他是否已经关注我
            $map = array('uid'=>$uid, 'follow_uid'=>$this->visitor->info['id']);
            $isfollow_me = $user_follow_mod->where($map)->count();
            if ($isfollow_me) {
                $user_follow_mod->where($map)->setField('mutually', 0); //更新他关注我的记录为互相关注
            }
            //减少我的关注人数
            $user_mod->where(array('id'=>$this->visitor->info['id']))->setDec('follows');
            //减少Ta的粉丝人数
            $user_mod->where(array('id'=>$uid))->setDec('fans');
            //删除我微薄中Ta的内容
            M('topic_index')->where(array('author_id'=>$uid, 'uid'=>$this->visitor->info['id']))->delete();
            $this->ajaxReturn(1, L('unfollow_user_success'));
        } else {
            $this->ajaxReturn(0, L('unfollow_user_failed'));
        }
    }

    /**
     * 移除粉丝
     */
    public function delfans() {
        $uid = $this->_get('uid', 'intval');
        !$uid && $this->ajaxReturn(0, L('delete_invalid_fans'));
        $user_follow_mod = M('user_follow');
        if ($user_follow_mod->where(array('follow_uid'=>$this->visitor->info['id'], 'uid'=>$uid))->delete()) {
            $user_mod = M('user');
            //减少我的粉丝人数
            $user_mod->where(array('id'=>$this->visitor->info['id']))->setDec('fans');
            //减少Ta的关注人数
            M('user')->where(array('id'=>$uid))->setDec('follows');
            //删除Ta微薄中我的内容
            M('topic_index')->where(array('author_id'=>$this->visitor->info['id'], 'uid'=>$uid))->delete();
            $this->ajaxReturn(1, L('delete_fans_success'));
        } else {
            $this->ajaxReturn(0, L('delete_fans_failed'));
        }
    }
    
    /**
     * 我的收藏
     */
    public function favi() {
    	//取商家token值，取不到则默认为空
    	$tokenTall = $this->getTokenTall();
    	
    	//$favi_mod = M('shop_favi');
    	//$favi_list = $favi_mod->where(array('userid'=>$this->visitor->info['id']))->select();
    	$userid = $this->visitor->info['id'];
    	/*店铺信息*/
    	$model=new Model();
    	$weChaShop = $model->table('tp_shop_favi a, tp_wecha_shop b')
    	->where("a.tokenTall = b.tokenTall and a.userid='".$userid."'")
    	->field("b.*, '/weTall/index.php?g=home&m=index&a=index&tokenTall=".$tokenTall."' url")
    	->select();
    	//dump($weChaShop);exit;
    	$this->assign("weshopData",$weChaShop);

    	$this->assign('tokenTall',$tokenTall);
    	$this->display();
    }
    
     /**
     *	追加评论
     */
    public function comments() {
    
    /*
        $data['user_comments']= $this->_get('user_comments', 'intval');        
    	$data['item_id'] = $_SESSION['item_id'] ;
        $data['user_name'] = $this->visitor->info['username'];
	$data['create_time'] = date('y-m-d H:i:m');

	$record= M('comments');
	$record->add($data);
	
    	$username = $this->visitor->info['username'];
    	$createtime = date('y-m-d H:i:m');
	
    */
    	$item = $this->_get('item');    	    	
    	$this->assign('item',$item);
    	$this->assign('username',$this->visitor->info['username']);
    	$this->assign('createtime',date('y-m-d H:i:m'));
    	$this->assign('tokenTall',$this->getTokenTall());
        $this->display();        
        
    } 
    
    /**
     *	插入评论
     */
    public function addcomm() {
     if($_POST){
     	     	
			if ($this->commetns_mod->create()) {
				if($this->commetns_mod->add()){
					echo '您的评论已经成功提交！';
				}else{
					echo '很遗憾，您的评论提交失败了！';
				}
			}
     	
		}
		
    }    
}