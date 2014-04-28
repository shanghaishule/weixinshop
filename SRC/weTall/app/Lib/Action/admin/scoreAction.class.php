<?php

class scoreAction extends backendAction
{

    public function setting() {
        if (IS_POST) {
            $score_rule = $this->_post('score_rule', ',');
            D('setting')->where(array('name'=>'score_rule'))->save(array('data'=>serialize($score_rule)));
            $this->success(L('operation_success'));
        } else {
            $this->display();
        }
    }

    public function logs() {
        $score_log_mod = M('score_log');
        $map = array();
        $keyword = $this->_request('keyword', 'trim');
        $keyword && $map = array('uname'=>array('like', '%'.$keyword.'%'));
        $count = $score_log_mod->where($map)->count();
        $pager = new Page($count, 20);
        $list = $score_log_mod->order('id DESC')->limit($pager->firstRow.','.$pager->listRows)->select();
        $this->assign('list',$list);
        $this->assign('page',$pager->show());
        $this->assign('keyword', array('keyword' => $keyword,));
        $this->display();
    }
}