<?php
class WechaWallAction extends UserAction{
     private $token;
  public function index(){
    
     $this->token=$_GET['token'];
     if($_SESSION['token'] == "") $_SESSION['token']=$this->token;
     
     $wall=M('weixin_vote');     
     $where['tokenTall']=$this->token;
     
     $this->assign('token',$this->token);
     $this->assign('count',$wall->where($where)->count());
     $this->assign("list",$wall->limit(20)->where($where)->order('res DESC')->select());
     
     $this->display();
  }
  public function Tozero(){
     $wall=M('weixin_vote');
     $data['res']=0;
     $where['tokenTall']=$_GET['token'];
     if($wall->where($where)->save($data)){
         $this->success('微信墙已经清零',U('WechaWall/index',array('token'=>$_SESSION['token'])));
     }else{
         $this->error('系统繁忙请重试',U('WechaWall/index'));
     }
  }
  public function gameAgain(){
     $wall=M('weixin_vote');
     $data['gameOverFlag']="Y";
     $where['tokenTall']=$_GET['token'];
     if($wall->where($where)->save($data)){
         $this->success('微信墙已经重新开始',U('WechaWall/index',array('token'=>$_SESSION['token'])));
     }else{
         $this->success('系统繁忙请重试',U('WechaWall/index',array('token'=>$_SESSION['token'])));
     }
  }
  public function deleteAll(){
     $wall=M('weixin_vote');
     $where['tokenTall']=$_GET['token'];
     if($wall->where($where)->delete()){
         $this->success('所有人员删除成功',U('WechaWall/index',array('token'=>$_SESSION['token'])));
     }else{
         $this->error('系统繁忙请重试',U('WechaWall/index',array('token'=>$_SESSION['token'])));
     }
  }
  public function setWall(){
       $wechawall_api=M('wechawall_api');
       $this->token=$_GET['token'];
       $whereAll['token']=$_GET['token'];
     if(IS_POST){
        if($this->token == ""){
           $this->token=$_POST['token'];
        }
        $dataG['token']=$this->token;
        $where['token']=$this->token;
        $where['url']=$_POST['url'];
        $where['email']=$_POST['email'];
        $where['password']=$_POST['password'];
        $where['descr']=$_POST['descr'];
        $where['imgurl']=$_POST['imgurl'];
        $where['tdcode']=$_POST['tdcode'];
        //$wecha_wall_xunlie=M('wecha_wall_xunlie');
       // $xunlie['id']=$_POST["xunlie"];
        //if($xunlie == ""){
	       
       // }else if($wecha_wall_xunlie->where($xunlie)->find()){
      //        $xunlie['token']=$this->token;
      //        $xunlie['right']='Y';
       //       $wecha_wall_xunlie->save($xunlie);
      //  }else{
      //      $this->error('序列码不正确，请与商家购买',U('WechaWall/setWall'));
      //  }
         if($wechawall_api->where($dataG)->find()){
                    $wechawall_api->save($where);
         	    $this->success('设置已更新',U('WechaWall/setWall',array('token'=>$_SESSION['token'])));
	        }else if($wechawall_api->add($where)){
	           $this->success('微信号已经添加至微信墙',U('WechaWall/setWall',array('token'=>$_SESSION['token'])));
	        }else{
	           $this->error('系统繁忙请重试',U('WechaWall/setWall',array('token'=>$_SESSION['token'])));
	        }
     }
     $this->assign('wechawall_api', $wechawall_api->where($whereAll)->find());
     $this->assign('token',$this->token);
     $this->display();
  }
}
?>