<?php
class TallAction extends BackAction{
public function _initialize() {
        parent::_initialize();
        $this->_mod = D('item_cate');
    }

    public function index() {
        $sort = $this->_get("sort", 'trim', 'ordid');
        $order = $this->_get("order", 'trim', 'ASC');
        $tree = new Tree();
        $tree->icon = array('│ ','├─ ','└─ ');
        $tree->nbsp = '&nbsp;&nbsp;&nbsp;';
        $result = M('item_cate')->order($sort . ' ' . $order)->select();

        $map = array();
        $UserDB = D('item_cate');
        $count = $UserDB->where($map)->count();
        $Page       = new Page($count,1808);// 实例化分页类 传入总记录数
        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $nowPage = isset($_GET['p'])?$_GET['p']:1;
        $show       = $Page->show();// 分页显示输出
        $result = $UserDB->where($map)->order('ordid ASC')->limit($Page->firstRow.','.$Page->listRows)->select();
        
        $this->assign('page',$show);// 赋值分页输出

        
        //var_dump($result);die();
        $array = array();
        foreach($result as $r) {
            $r['str_img'] = $r['img'] ? '<span class="img_border"><img src="'.attach($r['img'], 'item_cate').'" style="width:26px; height:26px;" class="J_preview" data-bimg="'.attach($r['img'], 'item_cate').'" /></span>' : '';
            $r['str_status'] = '<img data-tdtype="toggle" data-id="'.$r['id'].'" data-field="status" data-value="'.$r['status'].'" src="__ROOT__/weTall/static/images/admin/toggle_' . ($r['status'] == 0 ? 'disabled' : 'enabled') . '.gif" />';
            $r['str_index'] = '<img data-tdtype="toggle" data-id="'.$r['id'].'" data-field="is_index" data-value="'.$r['is_index'].'" src="__ROOT__/weTall/static/images/admin/toggle_' . ($r['is_index'] == 0 ? 'disabled' : 'enabled') . '.gif" />';
            $r['str_type'] = $r['type'] ? '<span class="gray">标签分类</span>' : "商品分类";
            $r['str_manage'] = '<a href="javascript:;" class="J_showdialog" data-uri="/weTall/index.php?g=Admin&m=item_cate&a=add&pid='.$r['id'].'" data-title="添加子分类" data-id="add" data-width="520" data-height="360">'."添加子分类".'</a> |
                            
                                <a href="javascript:;" class="J_showdialog" data-uri="/weTall/index.php?g=Admin&m=item_cate&a=edit&id='.$r['id'].'" data-title="编辑 - '. $r['name'] .'" data-id="edit" data-width="520" data-height="360">'."编辑".'</a> |
                                <a href="javascript:;" class="J_confirmurl" data-acttype="ajax" data-uri="/weTall/index.php?g=Admin&m=item_cate&a=delete&id='.$r['id'].'" data-msg="'.sprintf("确定删除吗？",$r['name']).'">'."删除".'</a>';
  // <a href="'.U('item_cate/tag_list',array('cate_id'=>$r['id'])).'">'.L('tag').'</a> |
            $r['parentid_node'] = ($r['pid'])? ' class="child-of-node-'.$r['pid'].'"' : '';
            $array[] = $r;
        }
       // var_dump($array);die();
        $str  = "<tr id='node-\$id' \$parentid_node>
                <td align='center'><input type='checkbox' value='\$id' class='J_checkitem'></td>
                <td align='center'>\$id</td>
                <td>\$spacer<span data-tdtype='edit' data-field='name' data-id='\$id' class='tdedit'  style='color:\$fcolor'>\$name</span></td>
                <td align='center'>\$str_img</td>
                <td align='center'>\$str_type</td>
                <td align='center'><span data-tdtype='edit' data-field='ordid' data-id='\$id' class='tdedit'>\$ordid</span></td>
                <td align='center'>\$str_index</td>
                <td align='center'>\$str_status</td>
                <td align='center'>\$str_manage</td>
                </tr>";
        //$this->show($str);
        $tree->init($array);
        $list = $tree->get_tree(0, $str);
        $this->assign('list', $list);
        //bigmenu (标题，地址，弹窗ID，宽，高)
        $big_menu = array(
            'title' => L('add_item_cate'),
            'iframe' => U('item_cate/add'),
            'id' => 'add',
            'width' => '520',
            'height' => '360'
        );
        $this->assign('big_menu', $big_menu);
        $this->assign('list_table', true);
        $this->display();
    }
   
    /**
     * 添加子菜单上级默认选中本栏目
     */
    public function _before_add() {
        $pid = $this->_get('pid', 'intval', 0);
        if ($pid) {
            $spid = M('item_cate')->where(array('id'=>$pid))->getField('spid');
            $spid = $spid ? $spid.$pid : $pid;
            $this->assign('spid', $spid);
        }
    }

    /**
     * 入库数据整理
     */
    protected function _before_insert($data = '') {
        //检测分类是否存在
        if(M('item_cate')->name_exists($data['name'], $data['pid'])){
            $this->ajaxReturn(0, L('item_cate_already_exists'));
        }
        //生成spid
        $data['spid'] = M('item_cate')->get_spid($data['pid']);
        return $data;
    }

    /**
     * 修改提交数据
     */
    protected function _before_update($data = '') {
        if (M('item_cate')->name_exists($data['name'], $data['pid'], $data['id'])) {
            $this->ajaxReturn(0, L('item_cate_already_exists'));
        }
        $item_cate = M('item_cate')->field('img,pid')->where(array('id'=>$data['id']))->find();
        if ($data['pid'] != $item_cate['pid']) {
            //不能把自己放到自己或者自己的子目录们下面
            $wp_spid_arr = M('item_cate')->get_child_ids($data['id'], true);
            if (in_array($data['pid'], $wp_spid_arr)) {
                $this->ajaxReturn(0, L('cannot_move_to_child'));
            }
            //重新生成spid
            $data['spid'] = M('item_cate')->get_spid($data['pid']);
        }
        return $data;
    }

    /**
     * 批量移动分类
     */
    public function move() {
        if (IS_POST) {
            $data['pid'] = $this->_post('pid', 'intval');
            $ids = $this->_post('ids');
            //检查移动分类是否合法
            //获取目标分类信息
            $target_spid = M('item_cate')->where(array('id'=>$data['pid']))->getField('spid');
            $ids_arr = explode(',', $ids);
            foreach ($ids_arr as $id) {
                if (false !== strpos($target_spid . $data['pid'].'|', $id.'|')) {
                    $this->ajaxReturn(0, L('cannot_move_to_child'));
                }
            }
            //修改PID和SPID
            $data['spid'] = M('item_cate')->get_spid($data['pid']);
            M('item_cate')->where(array('id' => array('in', $ids)))->save($data);
            $this->ajaxReturn(1, L('operation_success'), '', 'move');
        } else {
            $ids = trim($this->_request('id'), ',');
            $this->assign('ids', $ids);
            $resp = $this->fetch();
            $this->ajaxReturn(1, '', $resp);
        }
    }

    /**
     * 分类标签列表
     */
    public function tag_list() {
        $cate_id = $this->_get('cate_id', 'intval');
        $keyword = $this->_get('keyword', 'trim');
        $cate_tag_mod = M('item_cate_tag');
        $db_pre = C('DB_PREFIX');
        $table = $db_pre.'item_cate_tag';
        $pagesize = 20;
        $map = array($table.'.cate_id'=>$cate_id);
        $keyword && $map['t.name'] = array('like', '%'.$keyword.'%');
        $join = $db_pre.'tag t ON t.id = '.$table.'.tag_id';
        $count = $cate_tag_mod->where($map)->join($join)->count();
        $pager = new Page($count, $pagesize);
        $list = $cate_tag_mod->field('t.id,t.name,weight')->where($map)->join($join)->limit($pager->firstRow.','.$pager->listRows)->select();
        $cate_name = M('item_cate')->get_name($cate_id); //分类名称
        $this->assign('list', $list);
        $this->assign('page', $pager->show());
        $this->assign('cate_id', $cate_id);
        $this->assign('cate_name', $cate_name);
        $this->assign('list_table', true);
        $this->display();
    }

    public function ajax_tag_edit() {
        $tag_id = $this->_get('id', 'intval');
        $cate_id = $this->_get('cate_id', 'intval');
        if (!$cate_id && !$tag_id) {
            $this->ajaxReturn(0, L('illegal_parameters'));
        }
        $weight = $this->_get('val', 'intval', 0);
        M('item_cate_tag')->where(array('cate_id'=>$cate_id, 'tag_id'=>$tag_id))->save(array('weight'=>$weight));
        $this->ajaxReturn(1);
    }

    /**
     * 标签搜索
     */
    public function tag_search() {
        $tag_mod = D('tag');
        $keywords = $this->_get('keywords', 'trim');
        $cate_id = $this->_get('cate_id', 'intval');
        $map = array();
        $keywords && $map['name'] = array('like', '%'.$keywords.'%');
        if ($cate_id) {
            $noids = M('item_cate')->get_tag_ids($cate_id);
            $noids && $map['id'] = array('not in', $noids);
        }
        $data = $tag_mod->where($map)->limit('0,60')->select();
        $this->ajaxReturn(1, '', $data);
    }

    /**
     * 分类标签设置
     */
    public function tag_add() {
        if (IS_POST) {
            $cate_id = $this->_post('cate_id', 'intval');
            !$cate_id && $this->ajaxReturn(0, L('illegal_parameters'));
            $tag_ids = $this->_post('tag_ids', 'trim');
            $custom_tags = $this->_post('custom_tags', 'trim');
            $tag_ids_arr = array();
            if ($tag_ids) {
                $tag_ids = substr($tag_ids, 1);
                $tag_ids_arr = explode('|', $tag_ids);
            }
            if ($custom_tags) {
                $tag_mod = M('tag');
                $custom_tags_arr = explode(',', $custom_tags);
                foreach ($custom_tags_arr as $val) {
                    $tag_id = $tag_mod->where("name='".$val."'")->getField('id');
                    if (!$tag_id) {
                        $tag_id = $tag_mod->add(array('name' => $val,));
                    }
                    if ($tag_id) {
                        $tag_ids_arr[] = $tag_id;
                    }
                }
            }
            $cate_tag_mod = M('item_cate_tag');
            $cate_tag_mod->where(array('cate_id'=>$cate_id))->delete();
            foreach ($tag_ids_arr as $val) {
                $cate_tag_mod->add(array(
                    'cate_id' => $cate_id,
                    'tag_id' =>$val
                ));
            }
            $this->ajaxReturn(1, L('operation_success'), '', 'tag_add');
        } else {
            $cate_id = $this->_get('cate_id', 'intval');
            $this->assign('cate_id', $cate_id);
            $resp = $this->fetch();
            $this->ajaxReturn(1, '', $resp);
        }
    }

    /**
     * 删除标签
     */
    public function tag_delete() {
        $cate_tag_mod = M('item_cate_tag');
        $cate_id = $this->_get('cate_id', 'intval');
        $ids = trim($this->_get('id'), ',');
        if ($ids) {
            $map = array('cate_id'=>$cate_id, 'tag_id'=>array('in', $ids));
            $cate_tag_mod->where($map)->delete();
            $this->ajaxReturn(1, L('operation_success'));
        } else {
            $this->ajaxReturn(0, L('illegal_parameters'));
        }
    }

    /**
     * 获取紧接着的下一级分类ID
     */
    public function ajax_getchilds() {
        $id = $this->_get('id', 'intval');
        $type = $this->_get('type', 'intval', null);
        $map = array('pid'=>$id);
        if (!is_null($type)) {
            $map['type'] = $type;
        }
        $return = M('item_cate')->field('id,name')->where($map)->select();
        if ($return) {
            $this->ajaxReturn(1, L('operation_success'), $return);
        } else {
            $this->ajaxReturn(0, L('operation_failure'));
        }
    }

    public function ajax_upload_img() {
        //上传图片
        if (!empty($_FILES['img']['name'])) {
            $result = $this->_upload($_FILES['img'], 'item_cate', array(
                    'width' => C('pin_itemcate_img.width'),
                    'height' => C('pin_itemcate_img.height'),
                    'remove_origin' => true,
                )
            );
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
}
?>