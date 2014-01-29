<?php
class accountAction extends backendAction
{
    public function _initialize() {
        parent::_initialize();
        $this->_mod_setting = D('account_setting');
    }

    public function setting(){
    	$tokenTall = $this->getTokenTall();
    	$this->assign('tokenTall',$tokenTall);
    	
    	if(IS_POST)
    	{
    		$bankname=trim($_POST['bankname']);
    		$account=trim($_POST['account']);
    		$payee=trim($_POST['payee']);
    		$mobile=trim($_POST['mobile']);
    		
    		$data['bankname']=$bankname;
    		$data['account']=$account;
    		$data['payee']=$payee;
    		$data['mobile']=$mobile;
    		$data['tokenTall']=$tokenTall;
    		
    		if(empty($_POST['id']))
    		{
    			if($this->_mod_setting->data($data)->add()!==false)
    			{
    				$this->success('新增成功!');exit;
    			}else
    			{
    				$this->error('新增失败');exit;
    			}
    		}
    		else
    		{
	    		if($this->_mod_setting->data($data)->where('id='.$_POST['id'])->save()!==false)
	    		{
	    			$this->success('修改成功!');exit;
	    		}else 
	    		{
	    			$this->error('修改失败');exit;
	    		}
    		}
    	}else{
    		$info = $this->_mod_setting->find();
    		$this->assign('info',$info);
    	}
    	
    	$this->display();
    }
}