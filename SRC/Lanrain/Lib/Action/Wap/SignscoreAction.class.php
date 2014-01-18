<?php
/**
* 会员签到
*
*/

class SignscoreAction extends BaseAction {

    //显示
    public function index(){
        $agent = $_SERVER['HTTP_USER_AGENT']; 
        if(!strpos($agent,"MicroMessenger")) {
            echo '此功能只能在微信浏览器中使用';exit;
        }     
        $token    =  $this->_get('token');
        $wecha_id = $this->_get('wecha_id');
        $cardsign   = M('Member_card_sign');  //签到表 
        $where    = array('token'=>$token,'wecha_id'=>$wecha_id,'score_type'=>1);  
        $sign = $cardsign->where($where)->order('sign_time desc')->find();
         
       
        if($sign == null){ //第一次来签到
            $cardsign->add($where);           
            $sign = $cardsign->where($where)->order('id desc')->find();
        }

        $get_card=M('member_card_create')->where(array('wecha_id'=>$wecha_id))->find();
        //木有领卡 ,跳到领卡页面。
        if(empty($get_card)){
            Header("Location: ".C('site_url').'/'.U('Wap/Card/vip',array('token'=>$this->_get('token'),'wecha_id'=>$this->_get('wecha_id')))); 
            exit('领卡后才可以签到.');
        }
        $set_exchange = M('Member_card_exchange')->where(array('token'=>$token))->find();
        $this->assign('set_exchange',$set_exchange);
        //var_dump($set_exchange);exit;
        if(empty($set_exchange)){
            exit("该商家尚未设置该功能.");
        }

        if(IS_POST){
            //1.开始签到
            //exit('开始签到');
            // Userinfo 总积分 = 签到总积分 + 消费总积分 和 连续签到计数器
            //  tp_member_card_sign   会员签到表
            //  Member_card_exchange   商家后台积分设置
            $whereinfo =  array('token'=>$token,'wecha_id'=>$wecha_id);
            $userinfo = M('Userinfo')->where($whereinfo)->find();
            //是否连续签够了 6 天,如果是就奖励 20 个积分

           //检查 计数器是否等于 6 天，够了就增加 预设好的积分
           // var_dump($userinfo);exit;
           if($userinfo['continuous'] == 6){
                //先添加今天签到积分 22 分
                $data['expense']    =  $set_exchange['everyday'] + $set_exchange['continuation'];
                $data['is_sign'] = 1;
                $data['sign_time']  = time();
                $cardsign->where($where)->save($data);
                //签到总积分 = 原签到总积分 + 今天签到积分；
                //总积分 = 原总积分 + 今天签到积分；
                $da['sign_score']  = $userinfo['sign_score'] + $data['expense'];
                $da['total_score'] = $userinfo['total_score'] + $data['expense'];
                $da['continuous']  = 0; //清空计数器
                M('Userinfo')->where($whereinfo)->save($da);  
                $signined = 1;
           }else{
               //exit('还没够 6 天');
                //是否是连续签到，如果不是，清空计数器
                if ((time() - $sign['sign_time']) > 86400 ) {  // 判断时间是否大于24小时
                       //exit('清零计数器，继续签到');
                       $da['continuous']  = 0; //清空计数器
                       M('Userinfo')->where($whereinfo)->save($da);

                        $data['sign_time']  = time();
                        $data['is_sign']    = 1; 
                        $data['score_type'] = 1;
                        $data['token']      = $token;
                        $data['wecha_id']   = $wecha_id;
                        $data['expense']    = $set_exchange['everyday'];
                        $cardsign->where($where)->save($data);

                        $da['total_score'] = $userinfo['total_score'] +  $data['expense'];
                        $da['sign_score']  = $userinfo['sign_score'] + $data['expense'];
                        $da['continuous']  =  1;
                        M('Userinfo')->where($whereinfo)->save($da); 
                         $signined = 1;
                }else{
                    //是连续签到
                   //  exit('是连续签到 ');
                    $data['sign_time']  = time();
                    $data['is_sign']    = 1; 
                    $data['score_type'] = 1;
                    $data['token']      = $token;
                    $data['wecha_id']   = $wecha_id;
                    $data['expense']    = $set_exchange['everyday'];
                    $cardsign->data($data)->add(); 
 
                    $da['total_score'] = $userinfo['total_score'] +  $data['expense'];
                    $da['sign_score']  = $userinfo['sign_score'] + $data['expense'];
                    $da['continuous']  = $userinfo['continuous'] + 1;
                    M('Userinfo')->where($whereinfo)->save($da);
                     $signined = 1;
                }    
           }

        }else{ //Not POST 
           // var_dump($sign);
            //刚刚进入页面判断是否签到过了 
            $today = date('Y-m-d',time());
            $itoday = date('Y-m-d',$sign['sign_time']); 
            //echo $itoday.'==='.$today;exit;
            if($itoday == $today){
                 $signined = 1;   
            }      
            
           
        } 

        $cardset = M('Member_card_set')->where(array('token'=>$token))->find(); 
        $sign   = $cardsign->where($where)->order('sign_time desc')->limit(6)->select();     
        $userinfo = M('Userinfo')->where(array('token'=>$token,'wecha_id'=>$wecha_id))->find(); 
        $this->assign('userinfo',$userinfo);
        $this->assign('sign',$sign);
        $this->assign('signined',$signined);
        $cardset['continuation']=$set_exchange['continuation'];
        $this->assign('cardset',$cardset);
        /*
        var_dump($userinfo);
        var_dump($sign);
        var_dump($cardset);
        exit;
        */
        $this->display();
    }

    //-----------------------------------
    //  消费记录 
    //-----------------------------------
    public function expend(){
         $agent = $_SERVER['HTTP_USER_AGENT']; 
        if(!strpos($agent,"MicroMessenger")) {
            echo '此功能只能在微信浏览器中使用';exit;
        }     
        $token    =  $this->_get('token');
        $wecha_id = $this->_get('wecha_id');
        $cardsign   = M('Member_card_sign');  
        $where    = array('token'=>$token,'wecha_id'=>$wecha_id,'score_type'=>2);

        $cardset = M('Member_card_set')->where(array('token'=>$token))->find(); //获取banner的logo
        $sign   = $cardsign->where($where)->order('sign_time')->limit(6)->select();  //消费积分    
        $userinfo = M('Userinfo')->where(array('token'=>$token,'wecha_id'=>$wecha_id))->find(); //获取总积分,签到积分,签到天数
       
        $this->assign('userinfo',$userinfo);
        $this->assign('sign',$sign);
        $this->assign('signined',$signined);
        $this->assign('cardset',$cardset);

        $this->display();
    }

} 

