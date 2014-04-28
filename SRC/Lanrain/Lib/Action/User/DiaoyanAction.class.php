<?php
class DiaoyanAction extends UserAction{
	public function index(){
	    if(session('gid')==1){
			$this->error('vip0无法使用抽奖活动,请充值后再使用',U('Home/Index/price'));
		}
		$user=M('Users')->field('gid,activitynum')->where(array('id'=>session('uid')))->find();
		$group=M('User_group')->where(array('id'=>$user['gid']))->find();
		$this->assign('group',$group);
		$this->assign('activitynum',$user['activitynum']);
		$list=M('micro_research');
		$this->assign('count',M('micro_research')->where(array("1=1"))->count());
		$this->assign('list',$list->select());
		$this->display();
	
	}
	public function add(){
		if(IS_POST){
			$resech=M('micro_research');
			$data["question"]=$_POST["question"];
			$data["optionA"]=$_POST["questionA"];
			$data["optionB"]=$_POST["questionB"];
			$data["optionC"]=$_POST["questionC"];
			$data["optionD"]=$_POST["questionD"];
			$data["optionE"]=$_POST["questionE"];
			$disp=$_POST["display"];
			if($data["question"] == "" or $data["optionA"] == ""){
			    die("请不要让必填项为空！（有红星的为必填项）");
			}
			if($disp=="on") {
			    $data["display"]="Y";
			}else{
			    $data["display"]="X";
			}
			$data["type"]=$_POST["type"];
			if($resech->add($data)){
			   $this->success('微调研问题添加成功',U('Diaoyan/index'));
			}else{
			   $this->success('系统繁忙请重试',U('Diaoyan/add'));
			}
		}else{
	        $this->display();
		}
	}
	public function answer(){
	    if(session('gid')==1){
			$this->error('vip0无法使用优惠券管理,请充值后再使用',U('Home/Index/price'));
		}
		
		$resech = M('micro_research');
		$id=$_GET['id'];
		$obj=$resech->where(array('id'=>$id))->find();
		$this->assign('quesob',$obj);
		$this->display();
		
	}
	public function edit(){
	    if(session('gid')==1){
			$this->error('vip0无法使用优惠券管理,请充值后再使用',U('Home/Index/price'));
		}
		if(IS_POST){
			$resech = M('micro_research');
			$data['id']=$_GET["id"];
			$data["question"]=$_POST["question"];
			$data["optionA"]=$_POST["questionA"];
			if($data["question"] == "" or $data["optionA"] == ""){
			    die("请不要让必填项为空！（有红星的为必填项）");
			}
			$data["optionB"]=$_POST["questionB"];
			$data["optionC"]=$_POST["questionC"];
			$data["optionD"]=$_POST["questionD"];
			$data["optionE"]=$_POST["questionE"];
			$data["type"]=$_POST["type"];
			$disp=$_POST["display"];
			if($disp=="on") {
			    $data["display"]="Y";
			}else{
			    $data["display"]="X";
			}
			if($resech->save($data)){
			   $this->success('微调研问题修改成功'.$where["question"],U('Diaoyan/index'));
			}else{
			   $this->success('系统繁忙请重试'.$where["question"],U('Diaoyan/edit'));
			}
		}else{
		    $resech = M('micro_research');
			$id=$_GET['id'];
			$obj=$resech->where(array('id'=>$id))->find();
			$this->assign('quesob',$obj);
	        $this->display();
		}
	}
	public function delete(){
	    $id=$_GET['id'];
		$resech = M('micro_research');
		if($resech->where(array('id'=>$id))->delete()){
		    $this->success('微调研问题删除成功',U('Diaoyan/index'));
		}else{
		    $this->success('系统繁忙请重试',U('Diaoyan/index'));
		}
	}
}
?>