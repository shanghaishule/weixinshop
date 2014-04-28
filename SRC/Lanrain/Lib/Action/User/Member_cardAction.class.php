<?php
class Member_cardAction extends UserAction{
	public function _initialize() {
		parent::_initialize();
		$this->token=session('token');
		$this->assign('token',$this->token);
		//权限
		if ($this->token!=$_GET['token']){
			//exit();
		}
		$this->wxuser_db=M("Wxuser");
		//获取所在组的开卡数量
		$thisWxUser=$this->wxuser_db->where(array('token'=>$this->token))->find();
		$thisUser=M("Users")->where(array('id'=>$thisWxUser['uid']))->find();
		$thisGroup=M("User_group")->where(array('id'=>$thisUser['gid']))->find();
		$this->wxuser_db->where(array('token'=>$this->token))->save(array('allcardnum'=>$thisGroup['create_card_num']));
		$can_cr_num = $thisWxUser['allcardnum'] - $thisWxUser['yetcardnum'];
		if($can_cr_num > 0){
			$data['cardisok'] = 1;
			$this->wxuser_db->where(array('uid'=>session('uid'),'token'=>session('token')))->save($data);
		}
	}
	//会员卡配置
	public function index(){
		//检查权限和功能
		$this->checkauth('huiyuanka','huiyuanka'); 
		
		$data=M('Member_card_set')->where(array('token'=>$_SESSION['token']))->find();
		if(IS_POST){
			$_POST['token']=$_SESSION['token'];			
			if($data==false){				
				$this->all_insert('Member_card_set');
			}else{
				$_POST['id']=$data['id'];
				$this->all_save('Member_card_set');
			}
		}else{
			if($data==false){
				$data=array (
  'id' => '2',
  'token' => 'PigCms',
  'cardname' => C('site_name').'会员卡',
  'logo' => '/tpl/User/default/common/images/cart_info/logo-card.png',
  'bg' => './tpl/User/default/common/images/card/card_bg15.png',
  'diybg' => '/tpl/User/default/common/images/card/card_bg17.png',
  'msg' => '微时代会员卡，方便携带收藏，永不挂失',
  'numbercolor' => '#000000',
  'vipnamecolor' => '#121212',
  'Lastmsg' => '/tpl/User/default/common/images/cart_info/news.jpg',
  'vip' => '/tpl/User/default/common/images/cart_info/vippower.jpg',
  'qiandao' => '/tpl/User/default/common/images/cart_info/qiandao.jpg',
  'shopping' => '/tpl/User/default/common/images/cart_info/shopping.jpg',
  'memberinfo' => '/tpl/User/default/common/images/cart_info/user.jpg',
  'membermsg' => '/tpl/User/default/common/images/cart_info/vippower.jpg',
  'contact' => '/tpl/User/default/common/images/cart_info/addr.jpg',
  'create_time' => '0',
);
			}
			$this->assign('card',$data);
			$this->display();
		}
	}
	public function privilege(){
		$data=M('Member_card_vip')->where(array('token'=>$_SESSION['token']))->order('id desc')->select();
		$this->assign('data_vip',$data);
		$this->display();	
	}	
	public function privilege_add(){
		if(IS_POST){
			$this->all_insert('Member_card_vip','/privilege');
		}else{			
			$this->display();	
		}
		
	}
	public function privilege_edit(){
		if(IS_POST){
			$_POST['id']=$this->_get('id');
			$this->all_save('Member_card_vip','/privilege');
		}else{
			$data=M('Member_card_vip')->where(array('token'=>session('token'),'id'=>$this->_get('id')))->find();
			if($data!=false){
				$this->assign('vip',$data);
				$this->display();
			}else{
				$this->error('非法操作');
			}
			
		}
		
	}
	public function privilege_del(){
			$data=M('Member_card_vip')->where(array('token'=>session('token'),'id'=>$this->_get('id')))->delete();
			if($data==false){
				$this->error('服务器繁忙请稍后再试');
			}else{
				$this->success('操作成功',U('Member_card/privilege',array('id'=>$data_vip['id'])));
			
			}
	}
	//生成会员卡列表
	public function create(){
		$data=M('Member_card_create');
		if (IS_POST){//删除操作
			for ($i=0;$i<50;$i++){
				$data->where(array('id'=>$_POST['id_'.$i]))->delete();
				//删除的时候得删除userinfo里的信息
			}
			$this->success('删除成功',U('Member_card/create',array('token'=>session('token'))));
		}else {
			$count      = $data->where(array('token'=>$_SESSION['token']))->count();
			$Page       = new Page($count,15);
			$show       = $Page->show();
			$list = $data->where(array('token'=>$_SESSION['token']))->limit($Page->firstRow.','.$Page->listRows)->select();
			//计算领取张数
			$count    =M('member_card_create')->where(array('token'=>$_SESSION['token']))->count();
			$usecount =M('member_card_create')->where('token="'.$_SESSION['token'] .'" and wecha_id !=""')->count();

			$this->assign("usecount",$usecount);
			$this->assign("count",$count);
			$this->assign("ucount",$count - $usecount);
			$this->assign('page',$show);
			$this->assign('data_vip',$list);
			$this->display();
		}
	}

	public function getuserinfo(){
		$wecha_id = $this->_get("id");

		$uinfo = M('Userinfo')->where(array('wecha_id'=>$wecha_id ,'token'=>$_SESSION['token']))->order('id DESC')->find();
		$this->assign('list',$uinfo);
	
		$this->display();	
	}

	//创建会员卡
	public function create_add(){ 
		 
		$card=M("Wxuser")->where(array('uid'=>session('uid'),'token'=>$_SESSION['token']))->find();
		if($card['cardisok'] == 2){ //不可以创建
		 	$this->error('您的开卡数量已经用完.请充值或者续费升级.');
		 	return;
		} 


		if(IS_POST){
			$end=(int)$_POST['end'];			
			$stat=(int)$_POST['stat'];
		 
			if($end==false||$stat==false){$this->error('卡号起始值或结束值都不能为空');}

			if($end > 65535 || $stat <= 0){
				$this->error('卡号起始值不能为0或结束值不能超过65535');
				return;
			}
			
			$num=$end - $stat;
			if($num <=0 ){
				$this->error('开始卡号不能大于结束卡号');
				return;
			}
			
			$group_cread_num=M('User_group')->field('create_card_num,create_card_num')->where(array('id'=>session('gid')))->find();
			//echo $num.'-'.$group_cread_num['create_card_num'];exit;
			if(($num>$group_cread_num['create_card_num'])){
			 $this->error('你当前的vip等级只允许创建'.$group_cread_num['create_card_num'].'张卡');exit;
			}	

			//------------------------------------
			// tp_wxuser 
			//------------------------------------

			$markcard = M("Wxuser")->where(array('uid'=>session('uid'),'token'=>session('token')))->find();
			$can_cr_num = $group_cread_num['create_card_num'] - $markcard['yetcardnum']; //还剩下几张

			if( $num > $can_cr_num ){
				$this->error("您本月开卡数量只剩下 " . $can_cr_num ." 张！");exit;
			}

			for($i=1;$i<=$num;$i++){
				 $data['number']=$_POST['title'].($stat+=1);
				 $data['token']=session('token');
				 M('member_card_create')->data($data)->add();
			}		
			 
  			 
  			$back = M('Wxuser')->where(array('uid'=>session('uid'),'token'=>session('token')))->setInc('yetcardnum',$num);
  			 M('Wxuser')->where(array('uid'=>session('uid'),'token'=>session('token')))->setInc('totalcardnum',$num);
  			$markcard = M("Wxuser")->where(array('uid'=>session('uid'),'token'=>session('token')))->find();
  			$can_cr_num = $markcard['allcardnum'] - $markcard['yetcardnum'];
  			if($can_cr_num <= 0){
  				$data['cardisok'] = 2;
  				M('Wxuser')->where(array('uid'=>session('uid'),'token'=>session('token')))->save($data);	
  			}
			
			if($back!=false){
				$this->success('恭喜您共开了'.$num.'张会员卡',U('Member_card/create',array('token'=>session('token'))));
			}else{
				$this->error('服务器繁忙请稍后再试');
			}
		}else{
			$markcard = M("Wxuser")->where(array('uid'=>session('uid'),'token'=>session('token')))->find();
			$can_cr_num = $markcard['allcardnum'] - $markcard['yetcardnum'];
			$this->assign('count',$markcard['allcardnum']);
			$this->assign('cancrnum',$can_cr_num);
			$this->display();
		}
	}
	
	//会员优惠卷
	public function coupon(){
		$data=M('Member_card_coupon')->where(array('token'=>$_SESSION['token']))->order('id desc')->select();

		$this->assign('data_vip',$data);
		$this->display();	
	}
	public function coupon_edit(){
		if(IS_POST){			
			$this->all_save('Member_card_coupon','/coupon');
		}else{
			$data=M('Member_card_coupon')->where(array('token'=>session('token'),'id'=>$this->_get('id')))->find();
			if($data!=false){
				$this->assign('vip',$data);
				$this->display();
			}else{
				$this->error('非法操作');
			}
			
		}
		
	}	
	public function coupon_add(){
		if(IS_POST){			
			$this->all_insert('Member_card_coupon','/coupon');
		}else{
			
			$this->display();	
		}
		
	}
	public function coupon_del(){
			$data=M('Member_card_coupon')->where(array('token'=>session('token'),'id'=>$this->_get('id')))->delete();
			if($data==false){
				$this->error('服务器繁忙请稍后再试');
			}else{
				$this->success('操作成功',U('Member_card/coupon',array('id'=>$data_vip['id'])));
			
			}
	}
	//会员礼卷
	public function integral(){
		$data=M('Member_card_integral')->where(array('token'=>$_SESSION['token']))->order('id desc')->select();
		$this->assign('data_vip',$data);
		$this->display();	
	}
	public function integral_edit(){
		if(IS_POST){			
			$this->all_save('Member_card_integral','/integral');
		}else{
			$data=M('Member_card_integral')->where(array('token'=>session('token'),'id'=>$this->_get('id')))->find();
			if($data!=false){
				$this->assign('vip',$data);
				$this->display();
			}else{
				$this->error('非法操作');
			}
			
		}
		
	}	
	public function integral_add(){
		if(IS_POST){			
			$this->all_insert('Member_card_integral','/integral');
		}else{
			$this->display();	
		}
		
	}
	public function integral_del(){
			$data=M('Member_card_integral')->where(array('token'=>session('token'),'id'=>$this->_get('id')))->delete();
			if($data==false){
				$this->error('服务器繁忙请稍后再试');
			}else{
				$this->success('操作成功',U('Member_card/integral',array('id'=>$data_vip['id'])));
			
			}
	}
	//会员详情
	public function info(){
		$data=M('Member_card_info')->where(array('token'=>$_SESSION['token']))->find();
		if(IS_POST){
			//dump($_POST);EXIT;
			$_POST['token']=$_SESSION['token'];			
			if($data==false){				
				$this->all_insert('Member_card_info','/info');
			}else{
				$_POST['id']=$data['id'];
				$this->all_save('Member_card_info','/info');
			}
		}else{
			$this->assign('info',$data);
			$contact=M('Member_card_contact')->where(array('token'=>$_SESSION['token']))->order('sort desc')->select();
			$this->assign('contact',$contact);
			$this->display();
		}	
	}
	public function contact(){
		if(IS_POST){			
			$this->all_insert('Member_card_contact','/info');
		}else{
				$this->error('非法操作');	
		}
	
	}
	public function contact_edit(){
		if(IS_POST){			
			$this->all_save('Member_card_contact','/info');
		}else{
			$this->error('非法操作');			
		}		
	}

	/**
	*积分设置 设置会员卡积分策略及会员卡级别
	*
	*/
	public function exchange(){
		$data=M('Member_card_exchange')->where(array('token'=>$_SESSION['token']))->find();
		if(IS_POST){
			$_POST['token']=$_SESSION['token'];	
			$_POST['create_time'] = time();		
			if($data==false){				
				$this->all_insert('Member_card_exchange','/exchange');
			}else{
				$_POST['id']=$data['id'];
				$this->all_save('Member_card_exchange','/exchange');
			}
		}else{
			$this->assign('exchange',$data);
			$this->display();
		}	
	}
}
?>