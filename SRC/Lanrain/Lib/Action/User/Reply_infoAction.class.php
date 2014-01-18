<?php
class Reply_infoAction extends UserAction{
	public $token;
	public $reply_info_model;
	Public $infoTypes;
	public function _initialize() {
		parent::_initialize();
		$this->reply_info_model=M('reply_info');
		$this->token=session('token');
		$this->assign('token',$this->token);
		//
		$this->infoTypes=array(
		'Groupon'=>array('type'=>'Groupon','name'=>'团购','keyword'=>'团购','url'=>'/index.php?g=Wap&m=Groupon&a=grouponIndex&token='.$this->token),
		'Dining'=>array('type'=>'Dining','name'=>'订餐','keyword'=>'订餐','url'=>'/index.php?g=Wap&m=Product&a=dining&dining=1&token='.$this->token),
		'Shop'=>array('type'=>'Shop','name'=>'商城','keyword'=>'商城','url'=>'/index.php?g=Wap&m=Product&a=cats&token='.$this->token),
		'panorama'=>array('type'=>'panorama','name'=>'全景','keyword'=>'全景','url'=>'/index.php?g=Wap&m=Product&a=cats&token='.$this->token),
		'Liuyan'=>array('type'=>'Liuyan','name'=>'留言','keyword'=>'留言','url'=>'/index.php?g=Wap&m=Liuyan&a=cats&token='.$this->token),
		);
		//是否是餐饮
		if (isset($_GET['infotype'])&&$_GET['infotype']=='Dining'){
			$this->isDining=1;
		}else {
			$this->isDining=0;
		}
		$this->assign('isDining',$this->isDining);
	}
	public function set(){
        $infotype = $this->_get('infotype');
		$thisInfo = $this->reply_info_model->where(array('infotype'=>$infotype,'token'=>$this->token))->find();
		if ($thisInfo&&$thisInfo['token']!=$this->token){
			exit();
		}

		if(IS_POST){
			$row['title']=$this->_post('title');
			$row['info']=$this->_post('info');
			$row['picurl']=$this->_post('picurl');
			$row['token']=$this->_post('token');
			$row['infotype']=$this->_post('infotype');
			if ($row['infotype']=='Dining'){//订餐
				$diningyuding=intval($_POST['diningyuding']);
				$diningwaimai=intval($_POST['diningwaimai']);
				if (isset($_POST['diningyuding'])){
					$row['diningyuding']=intval($_POST['diningyuding']);
				}else {
					$row['diningyuding']=0;
				}
				if (isset($_POST['diningwaimai'])){
					$row['diningwaimai']=intval($_POST['diningwaimai']);
				}else {
					$row['diningwaimai']=0;
				}
				$row['config']=serialize(array('waimaiclose'=>$diningwaimai,'yudingclose'=>$diningyuding,'yudingdays'=>intval($_POST['yudingdays'])));
			}
			if ($thisInfo){
				
				$where=array('infotype'=>$thisInfo['infotype'],'token'=>$this->token);
				$this->reply_info_model->where($where)->save($row);

				$keyword_model=M('Keyword');
				$keyword_model->where(array('token'=>$this->token,'pid'=>$thisInfo['id'],'module'=>'Reply_info'))->save(array('keyword'=>$_POST['keyword']));
				$this->success('修改成功',U('Reply_info/set',$where));
						
			}else {
				$this->all_insert('Reply_info','/set?infotype='.$infotype);
			}
		}else{
			//
			$config=unserialize($thisInfo['config']);
			$this->assign('config',$config);
			//
			$this->assign('infoType',$this->infoTypes[$infotype]);
			$this->assign('set',$thisInfo);
			$this->display();
		}
	}
}


?>