<?php
class SelfformAction extends UserAction{
	public $token;
	public $selfform_model;
	public $selfform_input_model;
	public $selfform_value_model;
	public function _initialize() {
		
		parent::_initialize();
		
		//检查权限和功能
		$this->checkauth('diymen_set','diymen_set');
		
		$this->selfform_model=M('Selfform');
		$this->selfform_input_model=M('Selfform_input');
		$this->selfform_value_model=M('Selfform_value');
		$this->token=session('token');
		$this->assign('token',$this->token);
		$this->assign('module','Selfform');
	}
	public function index(){
		if (IS_POST){
			if ($_POST['token']!=$this->token){
				exit();
			}
			for ($i=0;$i<40;$i++){
				if (isset($_POST['id_'.$i])){
					
				}
			}
			$this->success('操作成功',U('Selfform/index',array('token'=>$this->token)));
		}else{
			$where=array('token'=>$this->token);
			if(IS_POST){
				$key = $this->_post('searchkey');
				if(empty($key)){
					$this->error("关键词不能为空");
				}

				$where['name|intro|keyword|content'] = array('like',"%$key%");
				$list = $this->selfform_model->where($where)->select();
				$count      = $this->selfform_model->where($where)->count();
				$Page       = new Page($count,20);
				$show       = $Page->show();
			}else {
				$count      = $this->selfform_model->where($where)->count();
				$Page       = new Page($count,20);
				$show       = $Page->show();
				$list=$this->selfform_model->where($where)->order('time DESC')->select();
			}
			$this->assign('list',$list);

			$this->assign('page',$show);
			$this->display();
		}
	}
	public function add(){ 
		if(IS_POST){
			$this->all_insert('Selfform','/index?token='.$this->token);
		}else{
			$set=array();
			$set['endtime']=time()+10*24*3600;
			$this->assign('set',$set);
			$this->display('set');
		}
	}
	public function set(){
        $id = intval($this->_get('id')); 
		$checkdata = $this->selfform_model->where(array('id'=>$id))->find();
		if(empty($checkdata)||$checkdata['token']!=$this->token){
            $this->error("没有相应记录.您现在可以添加.",U('Selfform/add'));
        }
		if(IS_POST){ 
            $where=array('id'=>$this->_post('id'),'token'=>$this->token);
			$check=$this->selfform_model->where($where)->find();
			if($check==false)$this->error('非法操作');
			if($this->selfform_model->create()){
				if($this->selfform_model->where($where)->save($_POST)){
					$this->success('修改成功',U('Selfform/index',array('token'=>$this->token)));
					$keyword_model=M('Keyword');
					$keyword_model->where(array('token'=>$this->token,'pid'=>$id,'module'=>'Selfform'))->save(array('keyword'=>$_POST['keyword']));
				}else{
					$this->error('操作失败');
				}
			}else{
				$this->error($this->selfform_model->getError());
			}
		}else{
			$this->assign('isUpdate',1);
			
			$this->assign('set',$checkdata);
			$this->display();	
		
		}
	}
	public function del(){
		if($this->_get('token')!=$this->token){$this->error('非法操作');}
        $id = intval($this->_get('id'));
        if(IS_GET){                              
            $where=array('id'=>$id,'token'=>$this->token);
            $check=$this->selfform_model->where($where)->find();
            if($check==false)   $this->error('非法操作');

            $back=$this->selfform_model->where($wehre)->delete();
            if($back==true){
            	$keyword_model=M('Keyword');
            	$keyword_model->where(array('token'=>$this->token,'pid'=>$id,'module'=>'Selfform'));
                $this->success('操作成功',U('Selfform/index',array('token'=>$this->token)));
            }else{
                 $this->error('服务器繁忙,请稍后再试',U('Selfform/index',array('token'=>$this->token)));
            }
        }        
	}
	public function inputs(){
		$formid=$this->_get('id');
		$thisForm=$this->selfform_model->where(array('id'=>$formid))->find();
		//dump($thisForm);
		if ($thisForm['token']!=$this->token){
			//exit();
		}
		$this->assign('thisForm',$thisForm);
		$where=array('formid'=>$formid);
		$list = $this->selfform_input_model->where($where)->order('taxis ASC')->select();
		$this->assign('list',$list);
		$this->display();
	}
	public function inputAdd(){ 
		if(IS_POST){
			$this->insert('Selfform_input','/inputs?id='.$this->_post('formid'));
		}else{
			$formid=intval($_GET['formid']);
			$thisForm=$this->selfform_model->where(array('id'=>$formid))->find();
			$this->assign('thisForm',$thisForm);

			$this->inputTypeOptions();
			$this->requireOptions(0);
			$this->regexOptions();
			$this->display('inputSet');
		}
	}
	public function inputTypeOptions($selected=''){
		$options=array(
		array('value'=>'','text'=>'请选择'),
		array('value'=>'text','text'=>'文本输入框'),
		array('value'=>'textarea','text'=>'多行文本输入框'),
		array('value'=>'select','text'=>'下拉列表')
		);
		$str='';
		foreach ($options as $o){
			$selectedStr='';
			if ($selected==$o['value']){
				$selectedStr=' selected';
			}
			$str.='<option value="'.$o['value'].'"'.$selectedStr.'>'.$o['text'].'</option>';
		}
		$this->assign('inputTypeOptions',$str);
	}
	public function requireOptions($selected=0){
		$options=array(
		array('value'=>'1','text'=>'必填'),
		array('value'=>'0','text'=>'不是必填')
		);
		$str='';
		foreach ($options as $o){
			$selectedStr='';
			if ($selected==$o['value']){
				$selectedStr=' selected';
			}
			$str.='<option value="'.$o['value'].'"'.$selectedStr.'>'.$o['text'].'</option>';
		}
		$this->assign('requireOptions',$str);
	}
	public function regexOptions(){
		$options=array(
		array('value'=>'','text'=>'选择常用输入限制'),
		array('value'=>'/^[A-Za-z]+$/','text'=>'英文大小写字符'),
		array('value'=>'/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/','text'=>'邮箱'),
		array('value'=>'/^[1-9]\d*|0$/','text'=>'0或正整数'),
		array('value'=>'/^[0-9]{1,30}$/','text'=>'正整数'),
		array('value'=>'/^[-\+]?\d+(\.\d+)?$/','text'=>'小数'),
		array('value'=>'/^13[0-9]{9}$|^15[0-9]{9}$|^18[0-9]{9}$/','text'=>'手机'),
		);
		$str='';
		foreach ($options as $o){
			$str.='<option value="'.$o['value'].'">'.$o['text'].'</option>';
		}
		$this->assign('regexOptions',$str);
	}
	public function inputSet(){
        $id = intval($this->_get('id')); 
		$checkdata = $this->selfform_input_model->where(array('id'=>$id))->find();
		if(empty($checkdata)){
            $this->error("没有相应记录.您现在可以添加.",U('Selfform/inputAdd'));
        }
		if(IS_POST){
            $where=array('id'=>$this->_post('id'));
            $thisInput=$this->selfform_input_model->where($where)->find();
            $thisForm=$this->selfform_model->where(array('id'=>$thisInput['formid']))->find();
            if ($thisForm['token']!=$this->token){
            	exit();
            }
			if($this->selfform_input_model->create()){
			$rt=$this->selfform_input_model->where($where)->save($_POST);
				if($rt){
					$this->success('修改成功',U('Selfform/inputs',array('token'=>$this->token,'id'=>$thisForm['id'])));
				}else{
					$this->error('操作失败');
				}
			}else{
				$this->error($this->selfform_input_model->getError());
			}
		}else{
			$this->assign('isUpdate',1);
			
			$this->assign('set',$checkdata);
			//
			$formid=intval($checkdata['formid']);
			$thisForm=$this->selfform_model->where(array('id'=>$formid))->find();
			$this->assign('thisForm',$thisForm);

			$this->inputTypeOptions($checkdata['inputtype']);
			$this->requireOptions($checkdata['require']);
			$this->regexOptions();
			$this->display();	
		
		}
	}
	public function inputDelete(){
		$id = intval($this->_get('id'));
		$where=array('id'=>$id);
		$thisInput=$this->selfform_input_model->where($where)->find();
		$thisForm=$this->selfform_model->where(array('id'=>$thisInput['formid']))->find();
		if ($thisForm['token']!=$this->token){
			exit();
		}
		$back=$this->selfform_input_model->where($wehre)->delete();
		if($back==true){
			$this->success('操作成功',U('Selfform/inputs',array('token'=>$this->token,'id'=>$thisForm['id'])));
		}else{
			$this->error('服务器繁忙,请稍后再试',U('Selfform/inputs',array('token'=>$this->token,'id'=>$thisForm['id'])));
		}
	}
	//
	public function infos(){
		//form
		$id = intval($this->_get('id'));
		$where=array('id'=>$id);
		$thisForm=$this->selfform_model->where($where)->find();
		$this->assign('thisForm',$thisForm);
		if ($thisForm['token']!=$this->token){
			exit();
		}
		//fields
		$fieldWhere=array('formid'=>$thisForm['id']);
		$fields = $this->selfform_input_model->where($fieldWhere)->order('taxis ASC')->select();
		$fieldsByKey=array();
		if ($fields){
			$i=0;
			foreach ($fields as $l){
				$fieldsByKey[$l['fieldname']]=$l;
				$i++;
			}
		}
		$this->assign('fields',$fields);
		//提交的信息
		$infoWhere=array('formid'=>$thisForm['id']);
		if(IS_POST){
			$key = $this->_post('searchkey');
			if(empty($key)){
				$this->error("关键词不能为空");
			}

			$infoWhere['values'] = array('like',"%$key%");
			$count      = $this->selfform_value_model->where($infoWhere)->count();
			$Page       = new Page($count,20);
			$show       = $Page->show();
		}else {
			$count      = $this->selfform_value_model->where($infoWhere)->count();
			$Page       = new Page($count,20);
			$show       = $Page->show();
		}
		$list=$this->selfform_value_model->where($infoWhere)->order('time DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
		if ($list){
			$i=0;
			foreach ($list as $l){
				$values=unserialize($l['values']);
				if ($fields){
					foreach ($fields as $f){
						$list[$i][$f['fieldname']]=$values[$f['fieldname']];
					}
				}
				$list[$i]['time']=date('Y-m-d H:i:s',$l['time']);
				unset($list[$i]['formid']);
				//unset($list[$i]['id']);
				unset($list[$i]['values']);
				unset($list[$i]['wecha_id']);
				$i++;
			}
			
		}
		$this->assign('count',$count);
		$this->assign('page',$show);
		$this->assign('list',$list);
		//
		$this->display();
	}
	public function infoDelete(){
		$thisInfo=$this->selfform_value_model->where(array('id'=>intval($_GET['id'])))->find();
		$thisFrom=$this->selfform_model->where(array('id'=>$thisInfo['formid']))->find();
		if ($thisFrom['token']!=$this->token){
			exit();
		}
		$back=$this->selfform_value_model->where(array('id'=>intval($_GET['id'])))->delete();
		if($back==true){
			$this->success('操作成功',U('Selfform/infos',array('token'=>$this->token,'id'=>$thisFrom['id'])));
		}else{
			$this->error('服务器繁忙,请稍后再试',U('Selfform/infos',array('token'=>$this->token,'id'=>$thisFrom['id'])));
		}
	}
}


?>