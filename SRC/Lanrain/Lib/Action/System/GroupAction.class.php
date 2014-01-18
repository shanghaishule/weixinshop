<?php
class GroupAction extends BackAction{
	public function _initialize() {
        parent::_initialize();  //RBAC 验证接口初始化
    }
	public function index(){
		$RoleDB = D('Role');
        $list = $RoleDB->getAllRole();
        $this->assign('list',$list);
        $this->display();
	}
	
	public function add(){
		$RoleDB = D("Role");
        if(isset($_POST['dosubmit'])) {
            //根据表单提交的POST数据创建数据对象
            if($RoleDB->create()){
                if($RoleDB->add()){
                    $this->assign("jumpUrl",U('Group/index'));
                    $this->success('添加成功！');
                }else{
                     $this->error('添加失败!');
                }
            }else{
                $this->error($RoleDB->getError());
            }
        }else{
            $this->assign('tpltitle','添加');
            $this->display();
        }
	}
	
	public function edit(){
		$RoleDB = D("Role");
        if(isset($_POST['dosubmit'])) {
            //根据表单提交的POST数据创建数据对象
            if($RoleDB->create()){
                if($RoleDB->save()){
                    $this->assign("jumpUrl",U('Group/index'));
                    $this->success('编辑成功！');
                }else{
                     $this->error('编辑失败!');
                }
            }else{
                $this->error($RoleDB->getError());
            }
        }else{
            $id = $this->_get('id','intval',0);
            if(!$id)$this->error('参数错误!');
            $info = $RoleDB->getRole(array('id'=>$id));
            $this->assign('tpltitle','编辑');
            $this->assign('info',$info);
            $this->display();
        }
	}
	
	public function del(){
		$id = $this->_get('id','intval',0);
        if(!$id)$this->error('参数错误!');
        $RoleDB = D('Role');
        if($RoleDB->delRole('id='.$id)){
            $this->assign("jumpUrl",U('Group/index'));
            $this->success('删除成功！');
        }else{
            $this->error('删除失败!');
        }
	}
	
	// 排序权重更新
    public function role_sort(){
        $sorts = $this->_post('sort');
        if(!is_array($sorts))$this->error('参数错误!');
        foreach ($sorts as $id => $sort) {
            D('Role')->upRole( array('id' =>$id , 'sort' =>intval($sort) ) );
        }
        $this->assign("jumpUrl",U('Group/index'));
        $this->success('更新完成！');
    }

/* ========权限设置部分======== */    
    //权限浏览
    public function access(){
        $roleid = $this->_get('roleid','intval',0);
        if(!$roleid) $this->error('参数错误!');

        $Tree = new Tree();
        $Tree->icon = array('&nbsp;&nbsp;&nbsp;│ ','&nbsp;&nbsp;&nbsp;├─ ','&nbsp;&nbsp;&nbsp;└─ ');
        $Tree->nbsp = '&nbsp;&nbsp;&nbsp;';

        $NodeDB = D('Node');
        $node = $NodeDB->getAllNode();

        $AccessDB = D('Access');
        $access = $AccessDB->getAllAccess('','role_id,node_id,pid,level');
       

        foreach ($node as $n=>$t) {
            $node[$n]['checked'] = ($AccessDB->is_checked($t,$roleid,$access))? ' checked' : '';
            $node[$n]['depth'] = $AccessDB->get_level($t['id'],$node);
            $node[$n]['pid_node'] = ($t['pid'])? ' class="tr lt child-of-node-'.$t['pid'].'"' : '';
        }
        $str  = "<tr id='node-\$id' \$pid_node>
                    <td style='padding-left:30px;'>\$spacer<input type='checkbox' name='nodeid[]' value='\$id' class='radio' level='\$depth' \$checked onclick='javascript:checknode(this);'/ > \$title (\$name)</td>
                </tr>";

        $Tree->init($node);
        $html_tree = $Tree->get_tree(0, $str);
        $this->assign('html_tree',$html_tree);

        $this->display();
    }

    //权限编辑
    public function access_edit(){
        $roleid = $this->_post('roleid','intval',0);
        $nodeid = $this->_post('nodeid');
        if(!$roleid) $this->error('参数错误!');
        $AccessDB = D('Access');
        if (is_array($nodeid) && count($nodeid) > 0) {  //提交得有数据，则修改原权限配置
            $AccessDB -> delAccess(array('role_id'=>$roleid));  //先删除原用户组的权限配置
            $NodeDB = D('Node');
            $node = $NodeDB->getAllNode();

            foreach ($node as $_v) $node[$_v[id]] = $_v;
            foreach($nodeid as $k => $node_id){
                $data[$k] = $AccessDB -> get_nodeinfo($node_id,$node);
                $data[$k]['role_id'] = $roleid;
            }
            $AccessDB->addAll($data);   // 重新创建角色的权限配置
        } else {    //提交的数据为空，则删除权限配置
            $AccessDB -> delAccess(array('role_id'=>$roleid));
        }
        $this->assign("jumpUrl",U('Group/access',array('roleid'=>$roleid)));
        $this->success('设置成功！');
    }
}