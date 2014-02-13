<?php
class indexAction extends frontendAction {
    
    public function index() {
    	//取商家token值，取不到则默认为空
    	$tokenTall = $this->getTokenTall();
    	$_SESSION["tokenTall"]=$tokenTall;
    	
    	/*****首页广告***/
    	$ad= M('ad');
    	$where = array('board_id'=>1, 'status'=>1, 'tokenTall'=>$tokenTall);
    	$ads = $ad->field('url,content,desc')->where($where)->limit(5)->order('ordid asc')->select();
        $this->assign('ad',$ads);
        /*****首页广告end******/
        
        /****最新商品*****/
        $where = array('news'=>1, 'tokenTall'=>$tokenTall);
        $news = $this->getItem($where);
        /****最新商品 END*****/
         
        /****推荐商品*****/
        $where = array('tuijian'=>1, 'tokenTall'=>$tokenTall);
        $tuijian = $this->getItem($where);
        /****推荐商品 END*****/
        
        /*店铺信息*/
        $weChaShop = M("wecha_shop");
        if($tokenTall == ""){
          $weshopData["tokenTall"] = $_SESSION["tokenTall"];
        }else{
        	$weshopData["tokenTall"] = $tokenTall;
        }
        $weChaShopDetail = $weChaShop->where($weshopData)->find();//var_dump($weshopData);die();
        $this->assign("weshopData",$weChaShopDetail);
        
        $this->assign('news',$news);
        $this->assign('tuijian',$tuijian);
        $this->_config_seo();
        $this->display();
    }
    public function search() {
    	$sortBy=$this->_get("sortid","trim");
    	if($sortBy == ""){
    		$sortBy = "'add_time DESC'";
    	}
    	if(IS_POST){
    		$keyword=$this->_post("txtkeyword","trim");
    		$method=$this->_post("method");
    		
    		$tokenTall = $this->getTokenTall();
    		if($tokenTall != ""){
    			$token= $tokenTall;
    		}else{
    			$token=$_SESSION["tokenTall"];
    		}
    		if($keyword == ""){
    			$this->error("请输入关键字！");
    		}
    		else if($method=="local"){
    			$this->nextPage($method, $keyword, $token,$sortBy);
                $_SESSION['keyword']=$keyword;
                $_SESSION['token']=$token;
                $_SESSION['method']=$method;
    		}else if($method=="weFig"){
    			$this->nextPage($method, $keyword,$sortBy);
                $_SESSION['keyword']=$keyword;
                $_SESSION['method']=$method;
    		}else{
    			$this->nextPage($method, $keyword,$sortBy);
    			$_SESSION['keyword']=$keyword;
    			$_SESSION['method']=$method;
    		}
    	}else{
    		$itemid=$this->_get("itemid","trim");
    		$brandid=$this->_get("brandid","trim");
    		$method2=$this->_get("method","trim");
    		if($method2 != ""){
    			$this->nextPagetuan($_SESSION['token'],$method2,$sortBy);
    		}else if ($brandid != ""){
    			$this->nextPageBrand($_SESSION['token'],$brandid,$sortBy);
    		}else if ($itemid != "") {
    			$this->nextPageCate($_SESSION['token'],$itemid,$sortBy);
    		}else if($_SESSION['method'] == "local"){
    		    $this->nextPage($_SESSION['method'], $_SESSION['keyword'], $_SESSION['token'],$sortBy);
    		}else{
    			$this->nextPage($_SESSION['method'], $_SESSION['keyword'],$sortBy);
    		}
    	}
    }
    public function nextPagetuan($token,$itemid,$sortBy){
    	$tokenTall = $token;
    	$this->assign('tokenTall',$tokenTall);
    	
    	switch ($itemid) {
    		case "new": $method="0";break;
    		case "recom":$method="1";break;
    		case "free":$method="2";break;
    		case "fuzhuang":$itemCate="服装鞋帽";break;
    		case "shuma":$itemCate="数码家电";break;
    		case "shenghuo":$itemCate="生活用品";break;
    		case "tushu":$itemCate="图书";break;
    		case "huazhuang":$itemCate="化妆用品";break;
    		case "meishi":$itemCate="食品";break;
    	}
    
    	$item = M("item");
    	if($itemCate == ""){
    		$condition["tuijian"] = $method;
    	}else{
    		$name["name"]=$itemCate;
    		$item_cate=M("item_cate")->where($name)->select();
    		foreach ($item_cate as $val){
    			$data["pid"]=$val["id"];
    			$itemID=M("item_cate")->where($data)->select();
    		}
    		foreach ($itemID as $varL){
    			$condition2[]=$varL["id"];
    		}
    		$condition["cate_id"]=array('in',$condition2);
    	}    	
    
    	if(count($condition2) != 0 or $method != ""){
    		$count = $item->where($condition)->count();   	
	    	$Page       = new Page($count,10);// 实例化分页类 传入总记录数
	    	// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
	    	$nowPage = isset($_GET['p'])?$_GET['p']:1;
	    	$show       = $Page->show();// 分页显示输出
	    	$carryrecord  = $item->where($condition)->order($sortBy)->limit($Page->firstRow.','.$Page->listRows)->select();
    	}
	    	
    	$this->assign("item",$carryrecord);
    	$this->assign("itemcate","Y");
    	$this->assign('page',$show);// 赋值分页输出pti
    	$this->assign("count",$count);
    	$this->display();
    }
    public function nextPageBrand($token,$itemid,$sortBy){
    	$tokenTall = $token;
    	$this->assign('tokenTall',$tokenTall);
    	 
    	$item = M("item");
    	$condition["brand"] = $itemid;
    	$count = $item->where($condition)->count();
    	$Page       = new Page($count,10);// 实例化分页类 传入总记录数
    	// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
    	$nowPage = isset($_GET['p'])?$_GET['p']:1;
    	$show       = $Page->show();// 分页显示输出
    	$carryrecord  = $item->where($condition)->order($sortBy)->limit($Page->firstRow.','.$Page->listRows)->select();
    
    	$this->assign("item",$carryrecord);
    	$this->assign("itemcate","Y");
    	$this->assign('page',$show);// 赋值分页输出pti
    	$this->assign("count",$count);
    	$this->display();
    }
    public function nextPageCate($token,$itemid,$sortBy){
    	$tokenTall = $token;
    	$this->assign('tokenTall',$tokenTall);
    	
    	$item = M("item");
    	//if($token != ""){
    	//	$condition["tokenTall"]=$token;
    	//}
    	$condition["cate_id"] = $itemid;
    	$count = $item->where($condition)->count();
    	$Page       = new Page($count,10);// 实例化分页类 传入总记录数
    	// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
    	$nowPage = isset($_GET['p'])?$_GET['p']:1;
    	$show       = $Page->show();// 分页显示输出
    	$carryrecord  = $item->where($condition)->order($sortBy)->limit($Page->firstRow.','.$Page->listRows)->select();
    	 
    	$this->assign("item",$carryrecord);
    	$this->assign("itemcate","Y");
    	$this->assign('page',$show);// 赋值分页输出pti
    	$this->assign("count",$count);
    	$this->display();
    }
    public function nextPage($method,$keyword,$token,$sortBy){
    	if($method=="shop"){   		
    		$item = M("wecha_shop");   		
    		$condition["name"] = array("like", "%".$keyword."%");
    		$count = $item->where($condition)->count();
    		$Page       = new Page($count,10);// 实例化分页类 传入总记录数
    		// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
    		$nowPage = isset($_GET['p'])?$_GET['p']:1;
    		$show       = $Page->show();// 分页显示输出
    		$carryrecord  = $item->where($condition)->order('credit DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
    		
    		foreach ($carryrecord as $val){    			
    			$val["descr"]=mb_substr($val["descr"], 0,35,"utf-8")."...";
    			$carryrecord2[]=$val;
    		}
 
    		$this->assign("item",$carryrecord2);
    		$this->assign("method",$method);
    		$this->assign('page',$show);// 赋值分页输出pti
    		$this->assign("count",$count);
    		$this->display();
    	}else{
	    	$tokenTall = $token;
	    	$this->assign('tokenTall',$tokenTall);
	    	
	    	$item = M("item");
	    	if($token != ""){
	    	   $condition["tokenTall"]=$token;
	    	}
	    	$condition["title"] = array("like", "%".$keyword."%");
	    	$count = $item->where($condition)->count();
	    	$Page       = new Page($count,10);// 实例化分页类 传入总记录数
	    	// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
	    	$nowPage = isset($_GET['p'])?$_GET['p']:1;
	    	$show       = $Page->show();// 分页显示输出
	    	$carryrecord  = $item->where($condition)->order($sortBy)->limit($Page->firstRow.','.$Page->listRows)->select();
	    	 
	    	$this->assign("item",$carryrecord);
	    	$this->assign("method",$method);
	    	$this->assign('page',$show);// 赋值分页输出pti
	    	$this->assign("count",$count);
	    	$this->display();
    	}
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
        	$tokenTall = $this->getTokenTall();
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