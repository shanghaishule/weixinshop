<?php
/**
 *网站后台
 *@package YiCms
 *@author YiCms
 **/
class NodeAction extends BackAction{
	public function _initialize() {
        parent::_initialize();  //RBAC 验证接口初始化
    }
	public function index(){
		$Node = D('Node')->getAllNode();
		$array = array();
		// 构建生成树中所需的数据
		foreach($Node as $k => $r) {
			$r['id']      = $r['id'];
			$r['title']   = $r['title'];
			$r['name']    = $r['name'];
			$r['status']  = $r['status']==1 ? '<font color="red">√</font>' :'<font color="blue">×</font>';
			$r['submenu'] = $r['level']==3 ? '<font color="#cccccc">添加子菜单</font>' : "<a href='".U('Node/add',array('pids'=>$r['id']))."'>添加子菜单</a>";
			$r['edit']    = $r['level']==1 ? '<font color="#cccccc">修改</font>' : "<a href='".U('Node/edit',array('id'=>$r['id'],'pids'=>$r['pid']))."'>修改</a>";
			$r['del']     = $r['level']==1 ? '<font color="#cccccc">删除</font>' : "<a onClick='return confirmurl(\"".U('Node/del',array('id'=>$r['id']))."\",\"确定删除该菜单吗?\")' href='javascript:void(0)'>删除</a>";
			switch ($r['display']) {
				case 0:
					$r['display'] = '不显示';
					break;
				case 1:
					$r['display'] = '主菜单';
					break;
				case 2:
					$r['display'] = '子菜单';
					break;
			}
			switch ($r['level']) {
				case 0:
					$r['level'] = '非节点';
					break;
				case 1:
					$r['level'] = '应用';
					break;
				case 2:
					$r['level'] = '模块';
					break;
				case 3:
					$r['level'] = '方法';
					break;
			}
			$array[]      = $r;
		}

		$str  = "<tr class='tr'>
				    <td align='center'><input type='text' value='\$sort' size='3' name='sort[\$id]'></td>
				    <td align='center'>\$id</td> 
				    <td style='text-align:left'>\$spacer \$title (\$name)</td> 
				    <td align='center'>\$level</td> 
				    <td align='center'>\$status</td> 
				    <td align='center'>\$display</td> 
					<td align='center'>
						\$submenu | \$edit | \$del
					</td>
				  </tr>";

  		$Tree = new Tree();
		$Tree->icon = array('&nbsp;&nbsp;&nbsp;│ ','&nbsp;&nbsp;&nbsp;├─ ','&nbsp;&nbsp;&nbsp;└─ ');
		$Tree->nbsp = '&nbsp;&nbsp;&nbsp;';
		$Tree->init($array);
		$html_tree = $Tree->get_tree(0, $str);
		$this->assign('html_tree',$html_tree);
		$this->display();
	}
	
	public function add(){
		if(isset($_POST['dosubmit'])) {
			$_POST['status']=1;
			$NodeDB = M("Node");
			//根据表单提交的POST数据创建数据对象
			if($NodeDB->create()){
				if($NodeDB->add()){
					$this->assign("jumpUrl",U('/Admin/Node/index'));
    				$this->success('添加成功！');
				}else{
					 $this->error('添加失败!');
				}
			}else{
				$this->error($NodeDB->getError());
			}
			
		}else{
			$Node = D('Node')->getAllNode();
			$pid = $this->_get('pids','intval',0);	//选择子菜单
			$array = array();
			foreach($Node as $k => $r) {
				$r['id']         = $r['id'];
				$r['title']      = $r['title'];
				$r['name']       = $r['name'];
				$r['disabled']   = $r['level']==3 ? 'disabled' : '';
				$array[$r['id']] = $r;
			}
			$str  = "<option value='\$id' \$selected \$disabled >\$spacer \$title</option>";
			$Tree = new Tree();
			$Tree->init($array);
			$select_categorys = $Tree->get_tree(0, $str, $pid);
			$this->assign('tpltitle','添加');
			$this->assign('select_categorys',$select_categorys);
			$this->display();
		}

	}

	//编辑菜单
	public function edit(){
		$NodeDB = D('Node');
		if(isset($_POST['dosubmit'])) {
			//根据表单提交的POST数据创建数据对象
			if($NodeDB->create()){
				if($NodeDB->save()){
					$this->assign("jumpUrl",U('Node/index'));
    				$this->success('编辑成功！');
				}else{
					 $this->error('编辑失败!');
				}
			}else{
				$this->error($NodeDB->getError());
			}
			
		}else{
			$id = $this->_get('id','intval',0);
			$pid = $this->_get('pids','intval',0);	//选择子菜单
			if(!$id || !$pid)$this->error('参数错误!');
			$allNode = $NodeDB->getAllNode();
			$array = array();
			foreach($allNode as $k => $r) {
				$r['id']         = $r['id'];
				$r['title']      = $r['title'];
				$r['name']       = $r['name'];
				$r['disabled']   = $r['level']==3 ? 'disabled' : '';
				$array[$r['id']] = $r;
			}
			$str  = "<option value='\$id' \$selected \$disabled >\$spacer \$title</option>";
			$Tree = new Tree();
			$Tree->init($array);
			$select_categorys = $Tree->get_tree(0, $str, $pid);
			$this->assign('tpltitle','编辑');
			$this->assign('select_categorys',$select_categorys);
			$this->assign('info', $NodeDB->getNode('id='.$id));
			$this->display();
		}

	}
	
	//删除菜单
	public function del(){
		$id = $this->_get('id','intval',0);
		if(!$id)$this->error('参数错误!');
		$NodeDB = D('Node');
		$info = $NodeDB -> getNode(array('id'=>$id),'id');
		if($NodeDB->childNode($info['id'])){
			$this->error('存在子菜单，不可删除!');
		}
		if($NodeDB->delNode('id='.$id)){
			$this->assign("jumpUrl",U('Node/index'));
			$this->success('删除成功！');
		}else{
			$this->error('删除失败!');
		}
	}

	//菜单排序权重更新
	public function sort(){
		$sorts = $this->_POST('sort');
		if(!is_array($sorts))$this->error('参数错误!');
		foreach ($sorts as $id => $sort) {
			D('Node')->upNode( array('id' =>$id , 'sort' =>intval($sort) ) );
		}
		$this->assign("jumpUrl",U('/Admin/Node/index'));
		$this->success('更新完成！');
	}
}