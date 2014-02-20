<?php
class menuAction extends backendAction {
    public function _initialize() {
        parent::_initialize();
        $this->_mod = D('menu');
    }

    public function index() {
        $tree = new Tree();
        $tree->icon = array('&nbsp;&nbsp;&nbsp;│ ','&nbsp;&nbsp;&nbsp;├─ ','&nbsp;&nbsp;&nbsp;└─ ');
        $tree->nbsp = '&nbsp;&nbsp;&nbsp;';
        $result = $this->_mod->order('ordid')->select();
        $array = array();
        foreach($result as $r) {
            $r['cname'] = L($r['name']);
            $r['str_manage'] = '<a href="javascript:;" class="J_showdialog" data-uri="'.U('menu/add',array('pid'=>$r['id'])).'" data-title="'.L('add_submenu').'" data-id="add" data-width="500" data-height="350">'.L('add_submenu').'</a> |
                                <a href="javascript:;" class="J_showdialog" data-uri="'.U('menu/edit',array('id'=>$r['id'])).'" data-title="'.L('edit').' - '. $r['name'] .'" data-id="edit" data-width="500" data-height="350">'.L('edit').'</a> |
                                <a href="javascript:;" class="J_confirmurl" data-acttype="ajax" data-uri="'.U('menu/delete',array('id'=>$r['id'])).'" data-msg="'.sprintf(L('confirm_delete_one'),$r['name']).'">'.L('delete').'</a>';
            $array[] = $r;
        }
        $str  = "<tr>
                <td align='center'><input type='checkbox' value='\$id' class='J_checkitem'></td>
                <td align='center'>\$id</td>
                <td>\$spacer<span data-tdtype='edit' data-field='name' data-id='\$id' class='tdedit'>\$name</span></td>
                <td align='center'><span data-tdtype='edit' data-field='ordid' data-id='\$id' class='tdedit'>\$ordid</span></td>
                <td align='center'>\$str_manage</td>
                </tr>";
        $tree->init($array);
        $menu_list = $tree->get_tree(0, $str);
        $this->assign('menu_list', $menu_list);

        $big_menu = array(
            'title' => '添加菜单',
            'iframe' => U('menu/add'),
            'id' => 'add',
            'width' => '500',
            'height' => '350',
        );
        $this->assign('big_menu', $big_menu);
        $this->assign('list_table', true);
        $this->display();
    }

    public function _before_add()
    {
        $tree = new Tree();
        $result = $this->_mod->select();
        $array = array();
        foreach($result as $r) {
            $r['selected'] = $r['id'] == $_GET['pid'] ? 'selected' : '';
            $array[] = $r;
        }
        $str  = "<option value='\$id' \$selected>\$spacer \$name</option>";
        $tree->init($array);
        $select_menus = $tree->get_tree(0, $str);
        $this->assign('select_menus', $select_menus);
    }

    public function _before_edit()
    {
        $id = $this->_get('id','intval');
        $info = $this->_mod->find($id);
        $this->assign('info', $info);
        $tree = new Tree();
        $result = $this->_mod->select();
        $array = array();
        foreach($result as $r) {
            $r['selected'] = $r['id'] == $info['pid'] ? 'selected' : '';
            $array[] = $r;
        }
        $str  = "<option value='\$id' \$selected>\$spacer \$name</option>";
        $tree->init($array);
        $select_menus = $tree->get_tree(0, $str);
        $this->assign('select_menus', $select_menus);
    }

}