<?php
class indexAction extends frontendAction {
    
    public function index() {
    	//取商家token值，取不到则默认为空
    	$tokenTall = $this->_get('tokenTall', 'trim', '');
    	
    	/*****首页广告***/
    	$ad= M('ad');
    	$where = array('board_id'=>1, 'status'=>1, 'tokenTall'=>$tokenTall);
    	$ads = $ad->field('url,content,desc')->where($where)->order('ordid asc')->select();
        $this->assign('ad',$ads);
        /*****首页广告end******/
        
        /****最新商品*****/
        $where = array('news'=>1, 'tokenTall'=>$tokenTall);
        $news = $this->getItem($where);
         /****最新商品 END*****/
         
          /****推荐商品*****/
        $where = array('tuijian'=>1, 'tokenTall'=>$tokenTall);
        $tuijian = $this->getItem($where);
      
        $this->assign('news',$news);
        $this->assign('tuijian',$tuijian);
        $this->_config_seo();
        $this->display();
    }
    
    public function getItem($where = array())
    {
    	$where_init = array('status'=>'1');
        $where =array_merge($where_init, $where);
    	
    	return $item=M('item')->where($where)->select();
    }
    
    
    public function ajaxLogin()
    {
    	
        $user_name=$_POST['user_name'];
        $password=$_POST['password'];
       
        $user=M('user');
        $users= $user->where("username='".$user_name."' and password='".md5($password)."'")->find(); 
        if(is_array($users))
        {
        	$tokenTall = $this->_get('tokenTall', 'trim', '');
    		$data = array('status'=>1, 'url'=>U('user/index', array('tokenTall'=>$tokenTall)));
    		$_SESSION['user_info']=$users;
        }else {
       		$data = array('status'=>0);
        }
    	
		echo json_encode($data);
    	exit;
    }
    
    public function ajaxRegister()
    {
    	$username = $_GET['user_name'];
    	$user = M('user');
    	$count = $user->where("username='".$username."'")->find();
    	if(is_array($count))
    	{
        	echo 'false';
    	}else 
    	{
    		echo 'true';
    	}
    }
    
    public function ajaxCheckuser()
    {
    	$username = $_GET['user_name'];
    	$user = M('user');
    	$count = $user->where("username='".$username."'")->find();
    	if(is_array($count))
    	{
    		echo 'true';
    	}
    	else
    	{
    		echo 'false';
    	}
    	
    }
    
}