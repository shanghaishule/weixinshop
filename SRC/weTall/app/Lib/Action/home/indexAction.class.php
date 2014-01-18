<?php
class indexAction extends frontendAction {
    
    public function index() {
    	/*****首页广告***/
    	$ad= M('ad');
    	$ads= $ad->field('url,content,desc')->where('board_id=1 and status=1')->order('ordid asc')->select();
        $this->assign('ad',$ads);
        /*****首页广告end******/
        
        /****最新商品*****/
        $wherenews=array('news'=>1);
        $news=$this->getItem($wherenews);
         /****最新商品 END*****/
         
          /****推荐商品*****/
        $wherenews=array('tuijian'=>1);
        $tuijian=$this->getItem($wherenews);
      
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
    	$data = array('status'=>1);
    	$_SESSION['user_info']=$users;
       }else {
       	$data = array('status'=>0);
       }
    	
    	echo json_encode($data);
    	exit;
    }
    public function ajaxRegister()
    {
    	$username=$_POST['user_name'];
    	$user=M('user');
    	$count=$user->where("username='".$username."'")->find();
    	if(is_array($count))
    	{
        echo 'false';
       // echo json_encode(array('user_nameData'=>true));
    	}else 
    	{
    		echo 'true';
        //echo json_encode(array('user_nameData'=>true));
    	}
    	
    
    }
    
}