<?php
class ShareAction extends BaseAction{
     public function index(){
        $agent = $_SERVER['HTTP_USER_AGENT']; 
        //if(!strpos($agent,"MicroMessenger")) {
        //    echo '此功能只能在微信浏览器中使用';exit;
       // }     
        $token    = $_SESSION['token'];//fflqia1387704099";//
        $wecha_id = $_SESSION['wecha_id']; //"oQf_5jhyKMMJVTXPbIM8rwnda-Uo";//
        $where    = array('token'=>$token,'wecha_id'=>$wecha_id,'score_type'=>1);  

        $get_card=M('member_card_create')->where(array('wecha_id'=>$wecha_id))->find();
        //木有领卡 ,跳到领卡页面。
        if(empty($get_card)){
            Header("Location: http://www.bestchoice88.com/index.php?g=Wap&m=Card&a=vip&token=$token&wecha_id=$wecha_id"); 
            exit('领卡后才可以才可以送积分哦!');
        }
        
        $set_exchange = M('Member_card_exchange')->where(array('token'=>$token))->find();    
        $this->assign('shareData',$set_exchange);     
        if(empty($set_exchange)){
            exit("该商家尚未设置该功能.");
        }
        $shared = $_GET["shared"];
        $shareOp = $_GET["shareOp"];
        $b = "confirm";
        if($shared != "" and (strpos($shareOp, $b) or strpos($shareOp, "ok"))){
            $whereinfo =  array('token'=>$token,'wecha_id'=>$wecha_id);
            $userinfo = M('Userinfo')->where($whereinfo)->find(); 
            $score = 1;       	
            switch($shared){
              case "M":
                if( $userinfo['sharedM'] == "Y") $score = 0.02;
                else $score = 1;
              break;
              case "Y": if( $userinfo['shared'] == "Y") $score = 0.04;else $score = 1; break;
              case "W": if( $userinfo['sharedW'] == "Y") $score = 0.05;else $score = 1; break;
              default:
                 break;
            }
        	   
	     if(isset($userinfo) and $userinfo["id"] !== "" ){	     
		     if($shared == "Y") {
		        $da['shared'] = "Y";		       
		     }else if($shared == "M"){
		        $da['sharedM'] = "Y";
		     }else{
		        $da['sharedW'] = "Y";
		     }
		     $Iscore = ceil($set_exchange["shareFriend"]*$score);
		     if($Iscore != $set_exchange["shareFriend"]){
		           echo "恭喜你，重复分享成功！送上<span style='color:red;'>".$Iscore."</span>个积分。";
		     }else{
		          echo "恭喜你，分享成功！送上<span style='color:red;'>".$Iscore."</span>个积分。";
		     }
                     $da['total_score'] = $userinfo['total_score'] + $Iscore;
		     M('Userinfo')->where($whereinfo)->save($da);
	     }else{

	     }   
        }
        $this->display();
     }
    
}
?>