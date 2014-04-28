<?php
class QuestionAction extends UserAction{

	public function index(){
		$this->display();
	}

	public function add(){
		if(IS_POST){
			$this->error('功能内测中,您无内测资格！');
		}else{
			$this->display();
		}
	}


}



?>