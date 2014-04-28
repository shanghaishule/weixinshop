<?php
class HostAction extends UserAction{
	public function index(){
		//检查权限和功能
		$this->checkauth('adma','adma'); 
		$data=M('Host');
		$count      = $data->where(array('token'=>$_SESSION['token']))->count();
		$Page       = new Page($count,12);
		$show       = $Page->show();
        $list = $data->where(array('token'=>$_SESSION['token']))->limit($Page->firstRow.','.$Page->listRows)->select(); 
        if(IS_POST){
             
            $key = $this->_post('searchkey');
            if(empty($key)){
                $this->error("关键词不能为空");
            }

            $map['token'] = $this->get('token'); 
            $map['keyword|title|tel2|tel'] = array('like',"%$key%"); 
            $list = M('Host')->where($map)->select();             
             
        }
		$this->assign('page',$show);		
		$this->assign('list',$list);
		$this->display();		
	}
	 
	public function set(){
		
        $id = $this->_get('id'); 
		$checkdata = M('Host')->where(array('token'=>$_SESSION['token'],'id'=>$id))->find();
		if(empty($checkdata)){
            $this->error("没有商家记录.您现在可以添加.",U('Host/add',array('token'=>session('token'))));
        }
		if(IS_POST){ 
            $_POST['id']        = $this->_post('id');
            $_POST['token']     = session('token');
            $_POST['keyword']   = $this->_post('keyword');
			
			
            $data=D('Host');
            $where=array('id'=>$this->_post('id'),'token'=>$this->_post('token'));
			$check=$data->where($where)->find();
			if($check==false)$this->error('非法操作');
			if($data->create()){
				if($data->where($where)->save($_POST)){
					$data1['pid']=$_POST['id'];
					$data1['module']='Host';
					$data1['token']=session('token');
					$da['keyword']=$_POST['keyword'];
					M('Keyword')->where($data1)->save($da);
					$this->success('修改成功',U('Host/index',array('token'=>session('token'))));
				}else{
					$this->error('操作失败');
				}
			}else{
				$this->error($data->getError());
			}
		}else{ 
			$this->assign('set',$checkdata);
			$this->display();	
		
		}
		
	}
    
	public function add(){ 
          if(IS_POST){
            $this->all_insert('Host'); 
          }else{
			$this->display('set');
		  }
	}

	public function index_del(){

		if($this->_get('token')!=session('token')){$this->error('非法操作');}
        $id = $this->_get('id');

        if(IS_GET){                              
            $where=array('id'=>$id,'token'=>session('token'));
            $data=M('Host');
            $check=$data->where($where)->find();
            if($check==false)   $this->error('非法操作');

            $back=$data->where($wehre)->delete();
            if($back==true){
                M('Keyword')->where(array('pid'=>$id,'token'=>session('token'),'module'=>'Host'))->delete();
                $this->success('操作成功',U('Host/index',array('token'=>session('token'))));
            }else{
                 $this->error('服务器繁忙,请稍后再试',U('Host/index',array('token'=>session('token'))));
            }
        }        
	}

    public function lists(){
        $data=M('Host_list_add');
        $hid = $this->_get('id');
        $count      = $data->where(array('token'=>$_SESSION['token'],'hid'=>$hid))->count();
        $Page       = new Page($count,12);
        $show       = $Page->show();
        $li = $data->where(array('token'=>$_SESSION['token'],'hid'=>$hid))->limit($Page->firstRow.','.$Page->listRows)->select(); 

        $this->assign('page',$show);        
        $this->assign('li',$li);
        $this->display();

    }

    public function list_add(){
        
        if(IS_POST){
             $data['hid']      = $this->_get('hid'); 
             if(empty($data['hid'] )){
                $this->error('链接失效。');
                exit;
             }    

             $data['type']    = $this->_post('type');            
             $data['typeinfo']= $this->_post('typeinfo');
             $data['price']   = $this->_post('price');
             $data['yhprice'] = $this->_post('yhprice');
             $data['name']    = $this->_post('name');
             $data['picurl']  = $this->_post('picurl');
             $data['url']     = $this->_post('url');
             $data['info']    = $this->_post('info');
             $data['token']   = session('token');
             if(empty($data['type']) || 
                empty($data['typeinfo'])||
                empty($data['price'])|| 
                empty($data['yhprice'])|| 
                empty($data['info']) 
                ) {
                    $this->error("不能为空.");exit;
             }
             M('Host_list_add')->data($data)->add();
             $this->success('操作成功');
             //$this->display('list');
        }else{
			$this->display();
		}
    }

     public function list_edit(){
        
            $id = $this->_get('id');
            $token = session('token');
            $list_add = M('Host_list_add')->where(array('id'=>$id,'token'=>$token))->find();
            if(IS_POST){
                 $data['type']    = $this->_post('type');
                 $data['typeinfo']= $this->_post('typeinfo');
                 $data['price']   = $this->_post('price');
                 $data['yhprice'] = $this->_post('yhprice');
                 $data['name']    = $this->_post('name');
                 $data['picurl']  = $this->_post('picurl');
                 $data['url']     = $this->_post('url');
                 $data['info']    = $this->_post('info');                  
                 if(empty($data['type']) || 
                    empty($data['typeinfo'])||
                    empty($data['price'])|| 
                    empty($data['yhprice'])|| 
                    empty($data['info']) 
                    ) {
                        $this->error("不能为空.");exit;
                 }
                 $where = array('id'=>$id,'token'=>session('token'));                 
                 M('Host_list_add')->where($where)->save($data);
                 $this->success('操作成功',U('Host/index',array('token'=>session('token'))));

            }else{
				$this->assign('list',$list_add);
				$this->display('list_add');
			}
    }
	public function list_del(){
		$id = $this->_get('id');
            $token = session('token');
		 $data = M('Host_list_add')->where(array('id'=>$id,'token'=>$token))->delete();
		if($data==false){
			$this->error('删除失败');
		}else{
			$this->success('操作成功');
		}
	
	}



    public function admin(){

        $hid = $this->_get('id');        
        $data=M('Host_order');
        $count      = $data->where(array('token'=>$_SESSION['token'],'hid'=>$hid))->count();
        $ok_count      = $data->where(array('token'=>$_SESSION['token'],'order_status'=>1,'hid'=>$hid))->count();
        $lost_count      = $data->where(array('token'=>$_SESSION['token'],'order_status'=>2,'hid'=>$hid))->count();
        $no_count      = $data->where(array('token'=>$_SESSION['token'],'order_status'=>3,'hid'=>$hid))->count();
        $Page       = new Page($count,20);
        $show       = $Page->show();
        $li = $data->where(array('token'=>$_SESSION['token'],'hid'=>$hid))->limit($Page->firstRow.','.$Page->listRows)->select(); 
        $this->assign('count',$count);
        $this->assign('ok_count',$ok_count);
        $this->assign('no_count',$no_count);
        $this->assign('lost_count',$lost_count);
        $this->assign('page',$show);        
        $this->assign('li',$li);
        if(IS_POST){
           $da['check_in']     = strtotime($this->_post('check_in'));
           $da['order_status'] = $this->_post('status');
           $id = $this->_post('id');
           $hid = $this->_post('hid');
           $token = session('token');
           M('Host_order')->where(array('id'=>$id,'token'=>$token))->save($da);
           $this->success('操作成功',U('Host/admin',array('token'=>session('token'),'id'=>$hid)));
           
        }else{
			$this->display();
		}
    }


}


?>