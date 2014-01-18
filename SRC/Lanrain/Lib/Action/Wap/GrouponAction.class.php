<?php
class GrouponAction extends ProductAction{
	public $token;
	public $wecha_id;
	public $product_model;
	public $product_cat_model;
	public $isDining;
	public function __construct(){
		parent::__construct();
	}
	public function grouponIndex(){
		$where=array('token'=>$this->token,'groupon'=>1);
		$where['endtime']=array('gt',time());
		if (isset($_GET['catid'])){
			$catid=intval($_GET['catid']);
			$where['catid']=$catid;
			
			$thisCat=$this->product_cat_model->where(array('id'=>$catid))->find();
			$this->assign('thisCat',$thisCat);
		}
		if (IS_POST){
			$key = $this->_post('search_name');
            $this->redirect('/index.php?g=Wap&m=Groupon&a=grouponIndex&token='.$this->token.'&keyword='.$key);
		}
		if (isset($_GET['keyword'])){
            $where['name|intro|keyword'] = array('like',"%".$_GET['keyword']."%");
            $this->assign('isSearch',1);
		}
		$count = $this->product_model->where($where)->count();
		$this->assign('count',$count); 
		//排序方式
		$method=isset($_GET['method'])&&($_GET['method']=='DESC'||$_GET['method']=='ASC')?$_GET['method']:'DESC';
		$orders=array('time','discount','price','salecount');
		$order=isset($_GET['order'])&&in_array($_GET['order'],$orders)?$_GET['order']:'time';
		$this->assign('order',$order);
		$this->assign('method',$method);
		//
        	
		$products = $this->product_model->where($where)->order($order.' '.$method)->limit('5')->select();
		$this->assign('products',$products);
		$this->assign('metaTitle','团购');
		$this->display();
	}
	public function ajaxGrouponProducts(){
		$where=array('token'=>$this->token,'groupon'=>1);
		$page=isset($_GET['page'])&&intval($_GET['page'])>1?intval($_GET['page']):2;
		$pageSize=isset($_GET['pagesize'])&&intval($_GET['pagesize'])>1?intval($_GET['pagesize']):5;
		$start=($page-1)*$pageSize;
		$products = $this->product_model->where($where)->order('id desc')->limit($start.','.$pageSize)->select();
		$str='{"products":[';
		if ($products){
			$comma='';
			foreach ($products as $p){
				$membercount=intval($p['salecount'])+intval($p['fakemembercount']);
				$str.=$comma.'{"id":"'.$p['id'].'","catid":"'.$p['catid'].'","storeid":"'.$p['storeid'].'","name":"'.$p['name'].'","price":"'.$p['price'].'","intro":"'.$p['intro'].'","token":"'.$p['token'].'","keyword":"'.$p['keyword'].'","salecount":"'.$p['salecount'].'","logourl":"'.$p['logourl'].'","time":"'.$p['time'].'","oprice":"'.$p['oprice'].'","fakemembercount":"'.$p['fakemembercount'].'","membercount":"'.$membercount.'","enddate":"'.date('Y-m-d',$p['endtime']).'"}';
				$comma=',';
			}
		}
		$str.=']}';
		$this->show($str);
	}
}
	
?>