<?php
class DiyformAction extends UserAction{		
	public function index(){				
		$token_open=M('token_open')->field('queryname')->where(array('token'=>session('token')))->find();
		if(!strpos($token_open['queryname'],'diyform')){
            $this->error('您还未开启该模块的使用权,请到功能模块中添加',U('Function/index',array('token'=>session('token'),'id'=>session('wxid'))));
		}		 
		$data=M('Diyform');
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
            $list = M('Diyform')->where($map)->select();             
             
        }
		$this->assign('page',$show);		
		$this->assign('list',$list);
		$this->display('index');		
	}
	 
	public function set(){		
        $id = $this->_get('id'); 
		$checkdata = M('Diyform')->where(array('token'=>$_SESSION['token'],'id'=>$id))->find();
		if(empty($checkdata)){
            $this->error("没有商家记录.您现在可以添加.",U('Diyform/add',array('token'=>session('token'))));
        }
		if(IS_POST){ 
            $_POST['id']        = $this->_post('id');
            $_POST['token']     = session('token');
            $_POST['keyword']   = $this->_post('keyword');            
            $data=D('Diyform');
            $where=array('id'=>$this->_post('id'),'token'=>$this->_post('token'));
			$check=$data->where($where)->find();
			if($check==false)$this->error('非法操作');
			if($data->create()){
				if($data->where($where)->save($_POST)){
					$data1['pid']=$_POST['id'];
					$data1['module']='Diyform';
					$data1['token']=session('token');
					$da['keyword']=$_POST['keyword'];
					M('Keyword')->where($data1)->save($da);
					$this->success('修改成功',U('Diyform/index',array('token'=>session('token'))));
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
			$this->error('开发中');
			//dump($_POST);EXIT;
            $data['keyword']=$this->_post('keyword');
            $data['formtitle']=$this->_post('formtitle');
            $data['title']=$this->_post('title');
            $data['address']=$this->_post('address');
            $data['picurl']=$this->_post('picurl ');
            $data['info']=$this->_post('info');
			$add=M('Diyform_set')->add($data);
            if($add!=false){
				$data['name']=$this->_post('name');
				$data['qq']=$this->_post('qq');
				$data['tel']=$this->_post('tel');
				$data['add']=$this->_post('add');
				$data['sex']=$this->_post('sex');
				$data['age']=$this->_post('age');
				$data['birth']=$this->_post('birth');
				$data['birth']=$this->_post('birth');
			}else{
				$this->error('操作失败');
			}
		  }else{
			$this->display('set');
		  }
	}

	public function index_del(){

		if($this->_get('token')!=session('token')){$this->error('非法操作');}
        $id = $this->_get('id');

        if(IS_GET){                              
            $where=array('id'=>$id,'token'=>session('token'));
            $data=M('Diyform');
            $check=$data->where($where)->find();
            if($check==false)   $this->error('非法操作');

            $back=$data->where($wehre)->delete();
            if($back==true){
                M('Keyword')->where(array('pid'=>$id,'token'=>session('token'),'module'=>'Diyform'))->delete();
                $this->success('操作成功',U('Diyform/index',array('token'=>session('token'))));
            }else{
                 $this->error('服务器繁忙,请稍后再试',U('Diyform/index',array('token'=>session('token'))));
            }
        }        
	}

    public function lists(){
        $data=M('Diyform_list_add');
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
             M('Diyform_list_add')->data($data)->add();
             $this->success('操作成功');
             //$this->display('list');
        }else{
			$this->display();
		}
    }

     public function list_edit(){
        
            $id = $this->_get('id');
            $token = session('token');
            $list_add = M('Diyform_list_add')->where(array('id'=>$id,'token'=>$token))->find();
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
                 M('Diyform_list_add')->where($where)->save($data);
                 $this->success('操作成功',U('Diyform/index',array('token'=>session('token'))));

            }else{
				$this->assign('list',$list_add);
				$this->display('list_add');
			}
    }
	public function list_del(){
		$id = $this->_get('id');
            $token = session('token');
		 $data = M('Diyform_list_add')->where(array('id'=>$id,'token'=>$token))->delete();
		if($data==false){
			$this->error('删除失败');
		}else{
			$this->success('操作成功');
		}
	
	}



    public function admin(){

        $hid = $this->_get('id');        
        $data=M('Diyform_order');
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
           M('Diyform_order')->where(array('id'=>$id,'token'=>$token))->save($da);
           $this->success('操作成功',U('Diyform/admin',array('token'=>session('token'),'id'=>$hid)));
           
        }else{
			$this->display();
		}
    }


}


?>