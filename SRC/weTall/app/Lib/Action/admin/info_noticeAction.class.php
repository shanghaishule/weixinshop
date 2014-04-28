<?php

class info_noticeAction extends backendAction
{

    public function _initialize() {
        parent::_initialize();
        $this->_mod = D('info_notice');
    }

    public function _before_index() {
        $big_menu = array(
            'title' => L('添加分类'),
            'iframe' => U('info_notice/add'),
            'id' => 'add',
            'width' => '400',
            'height' => '130'
        );
        $map["id"]=$_GET["id"];
        $UserDB = D('info_notice'); 
        $list = $UserDB->where($map)->find();
        //var_dump($list);die();
        $this->assign('volist',$list);
        $this->assign('big_menu', $big_menu);

       
    }
    public function _before_update(){
    	$data=$_POST;
    	$data["ptime"] = strtotime($_POST["ptime"]);
    	return $data;
    }
    public function _before_insert(){
    	$data=$_POST;
    	$data["ptime"] = strtotime($_POST["ptime"]);
    	return $data;
    }
    protected function _search() {
        $map = array();
        ($keyword = $this->_request('keyword', 'trim')) && $map['name'] = array('like', '%'.$keyword.'%');
        $this->assign('search', array(
            'keyword' => $keyword,
        ));
        return $map;
    }

    public function ajax_check_name() {
        $name = $this->_get('name', 'trim');
        $id = $this->_get('id', 'intval');
        //if (D('score_item_cate')->name_exists($name, $id)) {
        //    $this->ajaxReturn(0, L('该分类名称已存在'));
       // } else {
            $this->ajaxReturn(1);
        //}
    }
    
      public function deletebrand()
    {
    	 
        $mod = D("info_notice");
      
        $pk = $mod->getPk();
        $ids = trim($this->_request($pk), ',');
        
       
        if ($ids) {
        	
        	
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
?>