<?php
class indexAction extends frontendAction {

    public function index() {
    	//取商家token值，取不到则默认为空
    	$tokenTall = $this->getTokenTall();
    	$_SESSION["tokenTall"]=$tokenTall;
    	
    	//判断是微信的环境
    	$systemBrowse="X";
    	$agent = $_SERVER['HTTP_USER_AGENT'];
    	if(!strpos($agent,"icroMessenger")) {
    		$systemBrowse="Y";
    	}
    	
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
        
        /*收藏*/
        if ($_SESSION['user_info']) {
        	$userid = $_SESSION['user_info']['id'];
        	$shopfav_mod = M('shop_favi');
        	$wheredata = array('userid'=>$userid, 'tokenTall'=>$tokenTall);
        	if ($shopfav_mod->where($wheredata)->find()) {
        		$favi = "yes";
        	}else{
        		$favi = "no";
        	}
        }else{
        	$favi = "no";
        }
        
        //首次进入首页
        $index_num2 = $_SESSION["index_num2"];
        if ($index_num2 == "") {
        	$index_num2 = 0;
        }
        $index_num2 = $index_num2 + 1;
        $_SESSION["index_num2"] = $index_num2;
        
        $this->assign('favi',$favi);
        $this->assign("systemBrowse",$systemBrowse);
        $this->assign("index_num2",$_SESSION["index_num2"]);
        $this->assign('news',$news);
        $this->assign('tuijian',$tuijian);
        $this->_config_seo();
        $this->display();
    }
    public function search() {
    	//排序字段和方式的获得
    	$sortByStr=$this->_get("sortid","trim");
    	$sortmethod=$this->_get("sortmethod","trim");
    	if($sortByStr == "" or $sortmethod == ""){
    		$sortBy = "add_time desc";
    		$sortByStr="add_time";
    		$sortmethod="desc";
    	}else{
    		
	    	if ($_SESSION["sortstr"] == $sortByStr) {    			
		    	if($sortmethod == "asc"){
		    		$sortmethod="desc";
		    	}else{
		    		$sortmethod="asc";
		    	}
	    	}else{
	    		$sortmethod="desc";
	    	}
	    	$sortBy = $sortByStr." ".$sortmethod;
	    }
    	$this->assign("sortfield",$sortByStr);
    	$_SESSION["sortstr"]=$sortByStr;
    	$this->assign("sortmethod",$sortmethod);
    	if(IS_POST){
    	 //搜索关键字时候	
    		$keyword=$this->_post("txtkeyword","trim");
    		//搜索的方式本店，微指购，店铺
    		$method=$this->_post("method");
    		
    		$tokenTall = $this->getTokenTall();
    		if($tokenTall != ""){
    			$token= $tokenTall;
    		}else{
    			$token=$_SESSION["tokenTall"];
    		}
    		$this->assign("method",$method);
    		if($keyword == ""){
    			$this->error("请输入关键字！");
    		}
    		else if($method=="local"){//本店
    			$this->nextPage($method, $keyword,$sortBy, $token);
                $_SESSION['keyword']=$keyword;
                $_SESSION['token']=$token;
                $_SESSION['method']=$method;
    		}else if($method=="weFig"){//微指购
    			$this->nextPage($method, $keyword,$sortBy);
                $_SESSION['keyword']=$keyword;
                $_SESSION['method']=$method;
    		}else{//店铺内搜索微指购
    			$this->nextPage($method, $keyword,$sortBy);
    			$_SESSION['keyword']=$keyword;
    			$_SESSION['method']=$method;
    		}
    		
    	}else{
    		$itemid=$this->_get("itemid","trim");
    		$brandid=$this->_get("brandid","trim");
    		$method2=$this->_get("method","trim");
    		if($method2 != "local" and $method2 != "weFig" and $method2 != "shop" and $method2 != ""){//类别搜索
    			$this->assign("method",$method2);
    			$this->nextPagetuan($_SESSION['token'],$method2,$sortBy);
    		}else if ($brandid != ""){//品牌
    			//$this->assign("method",$brandid);
    			$this->assign("brandid",$brandid);
    			$this->nextPageBrand($_SESSION['token'],$brandid,$sortBy);
    		}else if ($itemid != "") {//新品上市  服装鞋帽等
    			//$this->assign("method",$itemid);
    			$this->assign("itemid",$itemid);
    			$this->nextPageCate($_SESSION['token'],$itemid,$sortBy);
    		}else if($_SESSION['method'] == "local"){//本店搜索
    			$this->assign("method",$_SESSION['method']); 
    		    $this->nextPage($_SESSION['method'], $_SESSION['keyword'],$sortBy, $_SESSION['token']);
    		}else{//关键字搜索后的分页
    			$this->assign("method",$_SESSION['method']);
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
    		case "free":$itemCate="餐饮娱乐";break;
    		case "fuzhuang":$itemCate="服装鞋帽";break;
    		case "shuma":$itemCate="手机数码";break;
    		case "shenghuo":$itemCate="家用电器";break;
    		case "tushu":$itemCate="母婴用品";break;
    		case "huazhuang":$itemCate="美妆饰品";break;
    		case "meishi":$itemCate="百货食品";break;
    	}
    	
    	$item = M("item");
    	if($itemCate == ""){
    		if ($method=="0") {
    			$condition["news"] = "1";
    		}else{
    		    $condition["tuijian"] = $method;
    		}
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
	    	//var_dump($carryrecord);die();
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
    public function nextPage($method,$keyword,$sortBy,$token){
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
	    	//echo $keyword."hi";die();
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
    		$user->where("username='".$user_name."' and password='".md5($password)."'")->save(array('last_login_time'=>time()));
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
    //收藏
    public function favi()
    {
    	//dump($_SESSION);exit;
    	//0-未登录 1-保存成功 2-保存失败 3-无动作类型
    	header("content-Type: text/html; charset=Utf-8");
    	$tokenTall = $this->getTokenTall();
    	if($_POST['act']){
    		$act = $_POST['act'];
    		if ($_SESSION['user_info']) {
	    		$userid = $_SESSION['user_info']['id'];
	    		$shopfav_mod = M('shop_favi');
	    		$insdata = array('userid'=>$userid, 'tokenTall'=>$tokenTall);
	    		if ($shopfav_mod->where($insdata)->find()) {
	    			//已经有记录的情况下
	    			if ($act == "add") {
	    				//收藏
	    				$data = array('status'=>2);
	    			}else{
	    				//取消收藏
	    				if($shopfav_mod->where($insdata)->delete()){
	    					//成功
	    					$data = array('status'=>1);
	    				}else{
	    					//失败
	    					$data = array('status'=>2);
	    				}
	    			}
	    			
	    		}else{
	    			//没有记录的情况下
	    			if ($act == "add") {
	    				//收藏
		    			if ($shopfav_mod->add($insdata)) {
		    				//成功
		    				$data = array('status'=>1);
		    			}else{
		    				//失败
		    				$data = array('status'=>2);
		    			}
	    			}else{
	    				//取消收藏
	    				//成功
	    				$data = array('status'=>1);
	    			}
	    		}
	    	}else{
	    		//当前未登录
	    		$data = array('status'=>0, 'url'=>U('user/index', array('tokenTall'=>$tokenTall)));
	    	}
    	}else{
    		//没有动作类型
    		$data = array('status'=>3);
    	}
    	
    	echo json_encode($data);
    }
    
    
    //商家信息
    public function shopinfo()
    {
    	
    	/*店铺信息*/
    	$weChaShop = M("wecha_shop");
    	if($tokenTall == ""){
    		$weshopData["tokenTall"] = $_SESSION["tokenTall"];
    	}else{
    		$weshopData["tokenTall"] = $tokenTall;
    	}
    	$weChaShopDetail = $weChaShop->where($weshopData)->find();//var_dump($weshopData);die();
    	$this->assign("weshopData",$weChaShopDetail);

//dump($weChaShopDetail["name"]);

		/*创店时间*/
    	$weUser = M("wxuser");
    	$weUserDetail = $weUser->where($weshopData)->find();//var_dump($weshopData);die();
    	$weUserDetail["createtime"] = date('Y-m-d h:m:s',$weUserDetail["createtime"]);
    	$this->assign("wxuserData",$weUserDetail);
//dump($weUserDetail["createtime"]);
    	
    	/*宝贝数量*/
    	$weItem = M("item");
    	$weItemCount = $weItem->where($weshopData)->count();//var_dump($weshopData);die();
    	$this->assign("weItemCount",$weItemCount);
//dump($weItemCount);

    	/*人气指数*/
    	$weShopFavi = M("shop_favi");
    	$weShopFaviCount = $weShopFavi->where($weshopData)->count();//var_dump($weshopData);die();
    	$this->assign("weshopFaviCount",$weShopFaviCount);
//dump($weShopFaviCount);

    	/*好评率*/
    	$item_id["item_id"]= $weChaShopDetail["id"];
    	$allNum = M("comments")->count();
    	$goodNum = M("comments")->where($item_id)->count();
    	
    	$rate = $goodNum/$allNum*100;
    	$this->assign("rate",$rate);
//dump($allNum);
//dump($goodNum);
//dump($rate);    	
//dump($weChaShopDetail["phone"]);
//die();

		
    	 
    	
    	$this->display();
    	
    }    
    	 

}
