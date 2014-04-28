<?php
class PlugmenuAction extends UserAction{
	//配置
	public function set(){
		$home=M('Home')->where(array('token'=>session('token')))->find();
		if(IS_POST){
			if($home==false){				
				$this->all_insert('Home','/set');
			}else{
				$_POST['id']=$home['id'];
				$this->all_save('Home','/set');				
			}
		}else{
			$this->assign('home',$home);
			$this->display();
		}
	}
	
}



?>