<?php

class albumAction extends backendAction
{

    public function _initialize() {
        parent::_initialize();
        $this->_mod = D('album');
        $this->_cate_mod = D('album_cate');
    }

    protected function _search() {
        $map = array('status'=>1);
        ($cate_id = $this->_request('cate_id', 'trim')) && $map['cate_id'] = array('eq', $cate_id);
        ($keyword = $this->_request('keyword', 'trim')) && $map['title'] = array('like', '%'.$keyword.'%');
        $this->assign('search', array(
            'keyword' => $keyword,
            'cate_id'=>$cate_id,
        ));
        return $map;
    }

    public function _before_index() {
        $cate_list = D('album_cate')->select();
        $this->assign('cate_list',$cate_list);
    }


    public function _before_edit() {
        $cate_list = D('album_cate')->select();
        $this->assign('cate_list',$cate_list);
    }

    public function ajax_upload_img() {
        //上传图片
        if (!empty($_FILES['img']['name'])) {
            $result = $this->_upload($_FILES['img'], 'album/', array('width'=>'960', 'height'=>'130', 'remove_origin'=>true) );
            if ($result['error']) {
                $this->ajaxReturn(0, $result['info']);
            } else {
                $ext = array_pop(explode('.', $result['info'][0]['savename']));
                $data['img'] = str_replace('.' . $ext, '_thumb.' . $ext, $result['info'][0]['savename']);
                $this->ajaxReturn(1, L('operation_success'), $data['img']);
            }
        } else {
            $this->ajaxReturn(0, L('illegal_parameters'));
        }
    }

    /**
     * 专辑审核
     */
    public function check() {
        $res = $this->_cate_mod->field('id,name')->select();
        $album_cate = array();
        foreach ($res as $val) {
            $album_cate[$val['id']] = $val['name'];
        }
        $this->assign('album_cate',$album_cate);
        $cate_list = D('album_cate')->select();
        $this->assign('cate_list',$cate_list);

        $map = $this->_search();
        $map['status']=0;
        ($cate_id = $this->_request('cate_id', 'trim')) && $map['cate_id'] = array('eq', $cate_id);
        ($keyword = $this->_request('keyword', 'trim')) && $map['title'] = array('like', '%'.$keyword.'%');
        $this->assign('search', array(
            'keyword' => $keyword,
            'cate_id'=>$cate_id,
        ));
        //分页
        import("ORG.Util.Page");
        $count = $this->_mod->where($map)->count('id');
        $pager = new Page($count, 20);
        $select = $this->_mod->field('id,cate_id,title,banner,cover_cache')->where($map)->order('id DESC');
        $select->limit($pager->firstRow.','.$pager->listRows);
        $page = $pager->show();
        $this->assign("page", $page);
        $list = $select->select();
        //格式化专辑图片数据
        foreach ($list as $key=>$val) {
            $list[$key]['cover'] = unserialize($val['cover_cache']);
        }
        $this->assign('list', $list);
        $this->assign('list_table', true);
        $this->display();
    }

    /**
     * 审核操作
     */
    public function do_check() {
        $mod = D($this->_name);
        $pk = $mod->getPk();
        $ids = trim($this->_request($pk), ',');
        $datas['id']=array('in',$ids);
        $datas['status']=1;
        if ($ids) {
            if (false !== $mod->save($datas)) {
                IS_AJAX && $this->ajaxReturn(1, L('operation_success'));
            } else {
                IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
            }
        } else {
            IS_AJAX && $this->ajaxReturn(0, L('illegal_parameters'));
        }
    }
}