<?php
class XitieAction extends BaseAction{
	public $token;
	public $wecha_id;
	public $xitie_model;
	public function __construct(){
		parent::__construct();
		$agent = $_SERVER['HTTP_USER_AGENT']; 
		/*if(!strpos($agent,"MicroMessenger")) {
			echo '此功能只能在微信浏览器中使用';exit;
		}
		*/
		$this->token = $this->_get('token');
		$this->assign('token',$this->token);
		$this->wecha_id	= $this->_get('wecha_id');
		if (!$this->wecha_id){
			$this->wecha_id='null';
		}
		$this->assign('wecha_id',$this->wecha_id);
		
		$this->xitie_model=M('Xitie');
		$this->assign('staticFilePath',str_replace('./','/',THEME_PATH.'common/css/xitie'));
	}
	public function index(){
		$formid=intval($_GET['id']);
		$thisForm=$this->xitie_model->where(array("id"=>$formid))->find();
		//这里可能需要判断		
		//dump($thisForm);
		$this->assign('Xitie',$thisForm);
		$this->display();
	}
	public function add(){
		if($_POST['action'] == 'add'){
			$data['token'] = $this->token;
			$data['wecha_id'] = $this->wecha_id;
			$data['xid'] = $_POST['id'];
			$data['name'] = $_POST['name'];
			$data['number'] = $_POST['count'];
			$data['phone'] = $_POST['phone'];
			$data['time'] = $_SERVER['REQUEST_TIME'];
			$base_canyu = M('Canyu');

			if($base_canyu->add($data)){
				echo '提交成功';
			}else{
				echo '提交失败';
			}
		}elseif($_POST['action'] == 'addtwo'){
			$data['token'] = $this->token;
			$data['wecha_id'] = $this->wecha_id;
			$data['xid'] = $_POST['id'];
			$data['name'] = $_POST['name'];
			$data['content'] = $_POST['content'];
			$data['phone'] = $_POST['phone'];
			$data['time'] = $_SERVER['REQUEST_TIME'];
			$base_canyu = M('Zhufu');

			if($base_canyu->add($data)){
				echo '祝福成功';
			}else{
				echo '祝福失败';
			}
		}
	}
}
?>