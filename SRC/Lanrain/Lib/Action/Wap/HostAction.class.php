<?php
class HostAction extends BaseAction{
    public function index(){
        $agent = $_SERVER['HTTP_USER_AGENT']; 
        if(!strpos($agent,"MicroMessenger")) {
            echo '此功能只能在微信浏览器中使用';exit;
        }
        $token      = $this->_get('token'); 
        $hid         = $this->_get('hid'); 
        $where      = array('token'=>$token,'hid'=>$hid);             
        $list_add     = M('Host_list_add')->where($where)->select();   
        $hostset =  M('Host')->where(array('token'=>$token,'id'=>$hid))->find();
        $this->assign('list',$list_add);
        //company info
        $company_db=M('Company');
        $thisCompany=$company_db->where(array('token'=>$token,'isbranch'=>0))->find();
        $hostset['address']=$thisCompany['address'];
        $this->assign('set',$hostset);
      //  $this->assign('isAndroid',isAndroid());
        $this->display();
    }
    
    //首次进入，罗列在线商家
    public function online($display=1){
        $agent = $_SERVER['HTTP_USER_AGENT']; 
        if(!strpos($agent,"MicroMessenger")) {
            echo '此功能只能在微信浏览器中使用';exit;
        }
        $token      = $this->_get('token'); 
        if(empty($token))  $this->error('非法操作');

        $where      = array('token'=>$token); 
        $data=M('Host');
        $count      = $data->where( $where )->count();
        $Page       = new Page($count,7);
        $show       = $Page->show();
        $list = $data->where( $where )->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign('list',$list);
        $this->assign('show',$show);
        //
        $hid         = $this->_get('hid'); 
        $hostset =  M('Host')->where(array('token'=>$token,'id'=>$hid))->find();
        $this->assign('set',$hostset);
        if ($display){
        $this->display();
        }
    }
    public function companyDetail(){
    	$this->online(0);
    	$this->display();
    }
    public function lists(){
       $agent = $_SERVER['HTTP_USER_AGENT']; 
        if(!strpos($agent,"MicroMessenger")) {
            echo '此功能只能在微信浏览器中使用';exit;
        }
       $id    = $this->_get('id');
       $token = $this->_get('token');
       $hid = $this->_get('hid');
       $wecha_id = $this->_get('wecha_id');
       $userinfo = M('userinfo')->where(array('wecha_id'=>$wecha_id,'token'=>$token))->find();

       $host = M('Host')->where(array('id'=>$hid,'token'=>$token))->find();
       $where = array('id'=>$id,'token'=>$token);
       $types = M('Host_list_add')->where($where)->find();
	   //dump($types);
       $this->assign('types',$types);
       $save_monery = $types['price'] - $types['yhprice']; 
       $this->assign('userinfo',$userinfo);
       $this->assign('saves',$save_monery );
       $this->assign('host',$host);
        
        $this->display();

    }
    
    //在线预定
    public function book(){ 
        $agent = $_SERVER['HTTP_USER_AGENT']; 
        if(!strpos($agent,"MicroMessenger")) {
            echo '此功能只能在微信浏览器中使用';exit;
        }
        if($_POST['action'] == 'book'){           

            $data['wecha_id']  =  $this->_post('wecha_id');
            $data['book_people']  =  $this->_post('truename'); 
            $data['remarks']   =  $this->_post('remarks');  
            $data['tel']       = $this->_post('tel');  
            $data['book_num']      = $this->_post('nums'); 
            $data['book_time']  = strtotime($this->_post('dateline'));           
            $id       = $this->_post('id');
            $data['room_type'] = $this->_post('roomtype'); 
            $data['order_status'] = 3 ;
            $data['hid'] = $this->_get('hid');
            $data['token'] = $this->_get('token');

            $price = M('Host_list_add')->where(array('id'=>$id,'token'=>$data['token'],'hid'=>$data['hid']))->find();

            $data['price'] = $price['yhprice'] * $data['book_num'];
                    
          
            $order = M('Host_order')->data($data)->add();    

            if($order){
                echo'{"success":1,"msg":"恭喜,预定成功。"}';
            }else{
                echo'{"success":0,"msg":"请从新预定。"}';
            }            
            exit;
        }    
            
        
    }
}
    
?>