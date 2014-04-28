<?php

class alipayAction extends backendAction
{

    public function _initialize() {
        parent::_initialize();
        $this->_mod = D('alipay');
    }

    public function index() {
     
    	if(IS_POST)
    	{
    		$alipayname=trim($_POST['alipayname']);
    		$partner=trim($_POST['partner']);
    		$key=trim($_POST['key']);
    		$data['alipayname']=$alipayname;
    		$data['partner']=$partner;
    		$data['key']=$key;
    		if(empty($_POST['id']))
    		{

    			if($this->_mod->data($data)->add()!==false)
    			{
    				$this->success('修改成功!');exit;
    			}else
    			{
    				$this->error('修改失败');exit;
    			}
    		}else
    		{
              
    		if($this->_mod->data($data)->where('id='.$_POST['id'])->save()!==false)
    		{
    				$this->success('修改成功!');exit;
    		}else 
    		{
    			$this->error('修改失败');exit;
    		}

    		}
    		
    	}else 
    	{
    		$info= $this->_mod->find();
    		$this->assign('info',$info);
    	}
    	
    	$this->display();
    }

   
    
}