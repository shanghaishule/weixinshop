<?php
class custom_menuAction extends backendAction {
    public function _initialize() {
        parent::_initialize();
        $this->_mod = D('custom_menu');
    }
    
    public function curl($appid,$secret)
    {
 $ch = curl_init(); 
 curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret); 
 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
 curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
 curl_setopt($ch, CURLOPT_AUTOREFERER, 1); 
// curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
 $tmpInfo = curl_exec($ch); 
 if (curl_errno($ch)) {  
	echo 'Errno'.curl_error($ch);
 }
 curl_close($ch); 
 $arr= json_decode($tmpInfo,true);
 return $arr;
    }
    
     public function curl_menu($ACCESS_TOKEN,$data)
    {
$ch = curl_init(); 
 curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$ACCESS_TOKEN); 
 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
 curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
 curl_setopt($ch, CURLOPT_AUTOREFERER, 1); 
 curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
 $tmpInfo = curl_exec($ch); 
 if (curl_errno($ch)) {  
 
	echo 'Errno'.curl_error($ch);
 }
 curl_close($ch); 
$arr= json_decode($tmpInfo,true);
return $arr;
    }
   
   public function getmenu()
   {
   	$keyword = array();
    	$topmemu= $this->_mod->field('id,name,key,keyword')->where('pid=0 and status=1')->order('id asc')->select();
    	foreach ($topmemu as $key )
    	{
    		$nextmenu= $this->_mod->field('id,name,key,keyword')->where('pid='.$key['id'].' and status=1')->order('id asc')->select();
    		if(count($nextmenu)!=0)//没有下级栏目
    		{
                 foreach ($nextmenu as $key2)
                 {
                 	$kk[]=array('type'=>'click','name'=>$key2['name'],'key'=>$key2['key']);
                 }
                 $keyword['button'][]=array('name'=>$key['name'],'sub_button'=>$kk);
                 $kk='';
    		}else
    		{
                $keyword['button'][]=array('type'=>'click','name'=>$key['name'],'key'=>$key['key']);
    		}
    	}
     return	json_encode($keyword);
   } 
    
   
    public function creat_custom_menu()
    {
	
    	  $appid= C('pin_appid');
    	 $appsecret=C('pin_appsecret');
    	if(!trim($appid))
    	{
    		$this->error('请填写微信AppId');
    	}
    	if(!trim($appsecret))
    	{
    		$this->error('请填写微信AppSecret');
    	}
    	$ACCESS_LIST= $this->curl($appid,$appsecret);//获取到的凭证
    	
    	if($ACCESS_LIST['access_token']!='')
    	{
    		$access_token=$ACCESS_LIST['access_token'];//获取到ACCESS_TOKEN
    		$data=$this->getmenu();
    	
         $msg=$this->curl_menu($access_token,preg_replace("#\\\u([0-9a-f]+)#ie", "iconv('UCS-2', 'UTF-8', pack('H4', '\\1'))", $data));
        if($msg['errmsg']=='ok')
        {
        	$this->success('创建自定义菜单成功!');
        }
        else {
        	$this->error('创建自定义菜单失败!');
        }
        
    	}else
    	{
    		$this->error('创建失败,微信AppId或微信AppSecret填写错误');
    	}
    
    	
    }
    
    public function index() {
        $sort = $this->_get("sort", 'trim', 'ordid');
        $order = $this->_get("order", 'trim', 'ASC');
        $tree = new Tree();
        $tree->icon = array('│ ','├─ ','└─ ');
        $tree->nbsp = '&nbsp;&nbsp;&nbsp;';
        $result = $this->_mod->order($sort . ' ' . $order)->select();
      
        $array = array();
        foreach($result as $r) {
         
            $r['str_status'] = '<img data-tdtype="toggle" data-id="'.$r['id'].'" data-field="status" data-value="'.$r['status'].'" src="__STATIC__/images/admin/toggle_' . ($r['status'] == 0 ? 'disabled' : 'enabled') . '.gif" />';
           
           
            $r['key'] = '<span >'.$r['key'].'</span>' ;
            $r['keyword'] ='<span >'.$r['keyword'].'</span>' ;
            if($r['pid']=='0')
            {
            $r['str_manage'] = '<a href="javascript:;" class="J_showdialog" data-uri="'.U('custom_menu/add',array('pid'=>$r['id'])).'" data-title="'.L('add_item_cate').'" data-id="add" data-width="520" data-height="360">添加子菜单</a> |
                                <a href="javascript:;" class="J_showdialog" data-uri="'.U('custom_menu/edit',array('id'=>$r['id'])).'" data-title="'.L('edit').' - '. $r['name'] .'" data-id="edit" data-width="520" data-height="360">'.L('edit').'</a> |
                                <a href="javascript:;" class="J_confirmurl" data-acttype="ajax" data-uri="'.U('custom_menu/delete',array('id'=>$r['id'])).'" data-msg="'.sprintf(L('confirm_delete_one'),$r['name']).'">'.L('delete').'</a>';
            }else 
            {
            	   $r['str_manage'] = '<a href="javascript:;" class="J_showdialog" data-uri="'.U('custom_menu/edit',array('id'=>$r['id'])).'" data-title="'.L('edit').' - '. $r['name'] .'" data-id="edit" data-width="520" data-height="360">'.L('edit').'</a> |
                                <a href="javascript:;" class="J_confirmurl" data-acttype="ajax" data-uri="'.U('custom_menu/delete',array('id'=>$r['id'])).'" data-msg="'.sprintf(L('confirm_delete_one'),$r['name']).'">'.L('delete').'</a>';
            }

            $r['parentid_node'] = ($r['pid'])? ' class="child-of-node-'.$r['pid'].'"' : '';
            $array[] = $r;
        }
        $str  = "<tr id='node-\$id' \$parentid_node>
                <td align='center'><input type='checkbox' value='\$id' class='J_checkitem'></td>
                <td align='center'>\$id</td>
                <td>\$spacer<span data-tdtype='edit' data-field='name' data-id='\$id' class='tdedit'  style='color:\$fcolor'>\$name</span></td>
                 <td align='center'><span data-tdtype='edit' data-field='key' data-id='\$id' class='tdedit'  >\$key</span></td>
                  <td align='center'><span data-tdtype='edit' data-field='keyword' data-id='\$id' class='tdedit'  >\$keyword</span></td>
                
                <td align='center'><span data-tdtype='edit' data-field='ordid' data-id='\$id' class='tdedit'>\$ordid</span></td>
            
                <td align='center'>\$str_status</td>
                <td align='center'>\$str_manage</td>
                </tr>";
        $tree->init($array);
        $list = $tree->get_tree(0, $str);
        $this->assign('list', $list);
        //bigmenu (标题，地址，弹窗ID，宽，高)
        $big_menu = array(
            'title' => '添加菜单',
            'iframe' => U('custom_menu/add'),
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
            $spid = $this->_mod->where(array('id'=>$pid))->getField('spid');
            $spid = $spid ? $spid.$pid : $pid;
            $this->assign('spid', $spid);
        }
    }

    /**
     * 入库数据整理
     */
    protected function _before_insert($data = '') {
        //检测分类是否存在
        if($this->_mod->name_exists($data['name'], $data['pid'])){
            $this->ajaxReturn(0, L('item_cate_already_exists'));
        }
        //生成spid
        $data['spid'] = $this->_mod->get_spid($data['pid']);
        return $data;
    }

    /**
     * 修改提交数据
     */
    protected function _before_update($data = '') {
        if ($this->_mod->name_exists($data['name'], $data['pid'], $data['id'])) {
            $this->ajaxReturn(0, L('item_cate_already_exists'));
        }
        $item_cate = $this->_mod->field('img,pid')->where(array('id'=>$data['id']))->find();
        if ($data['pid'] != $item_cate['pid']) {
            //不能把自己放到自己或者自己的子目录们下面
            $wp_spid_arr = $this->_mod->get_child_ids($data['id'], true);
            if (in_array($data['pid'], $wp_spid_arr)) {
                $this->ajaxReturn(0, L('cannot_move_to_child'));
            }
            //重新生成spid
            $data['spid'] = $this->_mod->get_spid($data['pid']);
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
            $target_spid = $this->_mod->where(array('id'=>$data['pid']))->getField('spid');
            $ids_arr = explode(',', $ids);
            foreach ($ids_arr as $id) {
                if (false !== strpos($target_spid . $data['pid'].'|', $id.'|')) {
                    $this->ajaxReturn(0, L('cannot_move_to_child'));
                }
            }
            //修改PID和SPID
            $data['spid'] = $this->_mod->get_spid($data['pid']);
            $this->_mod->where(array('id' => array('in', $ids)))->save($data);
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
        $cate_name = $this->_mod->get_name($cate_id); //分类名称
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
            $noids = $this->_mod->get_tag_ids($cate_id);
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
        $return = $this->_mod->field('id,name')->where($map)->select();
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