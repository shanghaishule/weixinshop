<?php

class addressAction extends backendAction
{

    public function _initialize() {
        parent::_initialize();
        $this->_mod = D('address');
    }
    
    public function check()
    {
    	$id = $this->_post('id', 'intval');
    	$this->_mod->where('id='.$id)->data(array('isno'=>1))->save();
        $this->_mod->where('id !='.$id)->data(array('isno'=>0))->save();
    }

    public function _before_index() {
    	$tokenTall = $this->getTokenTall();
    	$this->assign('tokenTall',$tokenTall);
        $big_menu = array(
            'title' => L('添加发货地址'),
            'iframe' => U('address/add',array('tokenTall'=>$tokenTall)),
            'id' => 'add',
            'width' => '550',
            'height' => '130'
        );
        $this->assign('big_menu', $big_menu);

        //默认排序
        $this->sort = 'ordid, id';
        $this->order = 'ASC';
    }

    protected function _search() {
        $map = array();
        ($keyword = $this->_request('keyword', 'trim')) && $map['name'] = array('like', '%'.$keyword.'%');
        
        $tokenTall = $this->getTokenTall();
        $map['tokenTall'] = array('eq', $tokenTall);
        
        $this->assign('search', array(
            'keyword' => $keyword,
        	'tokenTall' => $tokenTall,
        ));
        return $map;
    }

    
    public function edit()
    {
    	$mod = D($this->_name);
        $pk = $mod->getPk();
        if (IS_POST) {
            if (false === $data = $mod->create()) {
                IS_AJAX && $this->ajaxReturn(0, $mod->getError());
                $this->error($mod->getError());
            }
            if (method_exists($this, '_before_update')) {
                $data = $this->_before_update($data);
            }
            if (false !== $mod->save($data)) {
                if( method_exists($this, '_after_update')){
                    $id = $data['id'];
                    $this->_after_update($id);
                }
                
                if($data['isno']==1)
                {
                	$date['isno']=0;
                	$mod->where('id !='.$data['id'])->save($date);
                }
                
                IS_AJAX && $this->ajaxReturn(1,L('operation_success'), '', 'edit');
                $this->success(L('operation_success'));
            } else {
                IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
                $this->error(L('operation_failure'));
            }
        } else {
            $id = $this->_get($pk, 'intval');
            $info = $mod->find($id);
            $this->assign('info', $info);
            $this->assign('open_validator', true);
            if (IS_AJAX) {
                $response = $this->fetch();
                $this->ajaxReturn(1, '', $response);
            } else {
                $this->display();
            }
        }
    }
   
     public function add() {
     	$tokenTall = $this->getTokenTall();
        $mod = D($this->_name);
        if (IS_POST) {
            if (false === $data = $mod->create()) {
                IS_AJAX && $this->ajaxReturn(0, $mod->getError());
                $this->error($mod->getError());
            }
            if (method_exists($this, '_before_insert')) {
                $data = $this->_before_insert($data);
            }
            $data['tokenTall']=$tokenTall;
            if( $addid=$mod->add($data) ){
            
                if( method_exists($this, '_after_insert')){
                	
                    $id = $mod->getLastInsID();
                    $this->_after_insert($id);
                }
                if($data['isno']==1)
                {
                	$date['isno']=0;
                	$mod->where('id !='.$addid)->save($date);
                }
                
                IS_AJAX && $this->ajaxReturn(1, L('operation_success'), '', 'add');
                $this->success(L('operation_success'));
            } else {
                IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
                $this->error(L('operation_failure'));
            }
        } else {
            $this->assign('open_validator', true);
            if (IS_AJAX) {
                $response = $this->fetch();
                $this->ajaxReturn(1, '', $response);
            } else {
                $this->display();
            }
        }
    }
    
    
    public function deletebrand()
    {
    	$tokenTall = $this->getTokenTall();
        $mod = D($this->_name);
      
        $pk = $mod->getPk();
        $ids = trim($this->_request($pk), ',');
        
        if ($ids) {
        	$count=M('item_order')->where("fahuoaddress in (".$ids.") and tokenTall='".$tokenTall."'")->count();
        	if($count>0)
        	{
                IS_AJAX && $this->ajaxReturn(0,'此地址已被引用，不能删除');exit;
        	}
        	
            if (false !== $mod->delete($ids)) {
                IS_AJAX && $this->ajaxReturn(1, L('operation_success'));
                $this->success(L('operation_success'));
            } else {
                IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
                $this->error(L('operation_failure'));
            }
        } else {
            IS_AJAX && $this->ajaxReturn(0, L('illegal_parameters'));
            $this->error(L('illegal_parameters'));
        }
    }
    
}