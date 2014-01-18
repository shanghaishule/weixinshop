<?php

class DiaoyanAction extends BaseAction{
	private $Diaoyan = array();
	private $wecha_id;
	private $totalNum;
	private $currNum=1;
	public function index(){
	$agent = $_SERVER['HTTP_USER_AGENT']; 
	if(!strpos($agent,"icroMessenger")) {
		echo '此功能只能在微信浏览器中使用';exit;
	}
	$this->wecha_id	= $this->_get('wecha_id');
	$disply["display"] 	= 'Y';
	$Diaoyan = M("micro_research");
	$firstD=$Diaoyan->where($display)->find();
	$id=$firstD["id"];
	$flag='X';
	if($id == $Diaoyan->where($display)->max("id")){
	   $flag='Y';
	}
	$this->assign("totalNum",$Diaoyan->where($display)->count());
	$this->assign("currNum",$this->currNum);
	$this->assign("last",$flag);
	$this->assign("id",$id);
	$this->assign("Diaoyan",$Diaoyan->where($display)->select());
	$this->display();
	}
	
	public function next(){
	$agent = $_SERVER['HTTP_USER_AGENT']; 
	if(!strpos($agent,"icroMessenger")) {
		echo '此功能只能在微信浏览器中使用';exit;
	}

	$disply["display"] 	= 'Y';
	$Diaoyan = M("micro_research");
	$this->currNum = $this->currNum + 1;
	$getId=$_POST['id'];
	$answer=$_POST['answer'];
	$condition['id']=array(array('gt',$getId));
	$firstD=$Diaoyan->where($condition)->find();
	$id=$firstD["id"];
	$flag='X';
	if($id == $Diaoyan->where($display)->max("id")){
	   $flag='Y';
	}
	$Dresult=array();
	$DResult["id"]=$getId;
	$DResult["answer"]=$answer;
	//$this->DiaoyanResult = array_merge($this->DiaoyanResult,$DResult);
	array_push($this->Diaoyan,array($getId,$answer));
	$_SESSION["DiaoyanResult".$getId] = $this->Diaoyan;

	$this->assign("last",$flag);
	$this->assign("id",$id);
	$this->assign("totalNum",$Diaoyan->where($display)->count());
	$this->assign("currNum",$this->currNum);
	$this->assign("Diaoyan",$Diaoyan->where($display)->select());
	$this->display('index');   
	}
	public function finish(){
	$agent = $_SERVER['HTTP_USER_AGENT']; 
	if(!strpos($agent,"icroMessenger")) {
		echo '此功能只能在微信浏览器中使用';exit;
	}

	$disply["display"] 	= 'Y';
	$Diaoyan = M("micro_research");
	$getId=$_POST['id'];
	$answer=$_POST['answer'];
	$Dresult=array();
	$DResult["id"]=$getId;
	$DResult["answer"]=$answer;
	//$this->DiaoyanResult = array_merge($this->DiaoyanResult,$DResult);
	array_push($this->Diaoyan,array($getId,$answer));
	$_SESSION["DiaoyanResult".$getId] = $this->Diaoyan;
	$i=1;
	while($i<=$getId){
	  $finishData["id"]=$_SESSION["DiaoyanResult".$i][0][0];
	  switch($_SESSION["DiaoyanResult".$i][0][1]){
	  case "optionA":$j=$Diaoyan->where('id = $getId')->find('answerA');
	  $j = $j+1;
	  $finishData["answerA"] = $j;
	  break;
	  case "optionB":$j=$Diaoyan->where('id = $getId')->find('answerB');
	  $j = $j+1;
	  $finishData["answerB"] = $j;break;
	  case "optionC":$j=$Diaoyan->where('id = $getId')->find('answerC');
	  $j = $j+1;
	  $finishData["answerC"] = $j;break;
	  case "optionD":$j=$Diaoyan->where('id = $getId')->find('answerD');
	  $j = $j+1;
	  $finishData["answerD"] = $j;break;
	  case "optionE":$j=$Diaoyan->where('id = $getId')->find('answerE');
	  $j = $j+1;
	  $finishData["answerE"] = $j;break;
	  }
	  unset($_SESSION["DiaoyanResult".$i]);
	  $Diaoyan->save($finishData);
	  $i++;
	}
	
	$this->assign("wecha_id",$this->wecha_id);
	$this->display();   
	}
	
}
	
?>