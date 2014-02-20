<?php
class collect_batchAction extends backendAction
{

    public function index() {
        //采集马甲
        $auto_user = M('auto_user')->select();
        $this->assign('auto_user', $auto_user);
    	$this->display();
    }

    public function import() {
        $type = $this->_post('type', 'trim', 'input');
        $auid = $this->_post('auid', 'intval');
        !$auid && $this->error('auto_user_error');
        
        switch ($type) {
            case 'input':
                $url_list = $this->_post('url_list', 'urldecode');
                break;
            
            case 'file':
                $url_file = $_FILES['url_file'];
                $url_list = file_get_contents($url_file['tmp_name']);
                break;
        }
        $url_list = split(PHP_EOL, $url_list);

        //获取马甲
        $auto_user_mod = M('auto_user');
        $user_mod = M('user');
        $unames = $auto_user_mod->where(array('id'=>$auid))->getField('users');
        $unamea = explode(',', $unames);
        $users = $user_mod->field('id,username')->where(array('username'=>array('in', $unamea)))->select();
        !$users && $this->error('auto_user_error');
        //开始处理
        $item_mod = D('item');
        foreach ($url_list as $url) {
            if (!$url) continue;
            //获取商品信息
            $itemcollect = new itemcollect();
            $itemcollect->url_parse($url);
            $item = $itemcollect->fetch();
            if (!$item = $itemcollect->fetch()) continue;
            $item = $item['item'];
            //判断是否已经存在(避免后期修改过商品信息，如果存在则不处理)
            $item_id = $item_mod->where(array('key_id'=>$item['key_id']))->getField('id');
            if ($item_id) continue;
            //随机取一个马甲
            $user_rand = array_rand($users);
            //整理商品数据
            $item['uid'] = $users[$user_rand]['id'];
            $item['uname'] = $users[$user_rand]['username'];
            //添加商品
            $result = $item_mod->publish($item);
        }
        $this->success(L('operation_success'));
    }
}