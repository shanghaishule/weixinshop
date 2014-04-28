<?php


/*此代码用来处理用户详细信息并输出*/
$sixian=getmessage($token,$cookie,$cookies);//将用户消息转换成变量
//var_dump($sixian);
				$id=$sixian["id"];
				$type=$sixian["type"];
				$fakeid=$sixian["fakeid"];
				$nick_name=$sixian["nick_name"];
                $date_time=$sixian["date_time"];
				$play_length=$sixian["play_length"];
				$length=$sixian["length"];
                $messageid =$sixian["id"];
				$source=$sixian["source"];
                $msg_status =$sixian["msg_status"];
				$remark_name =$sixian["remark_name"];
                $has_reply = $sixian["remark_name"];
				$refuse_reason =$sixian["refuse_reason"];
				$content=$sixian["content"];
//var_dump($type);
$date=datetime($token,$cookie,$cookies);//时间戳
$deng=sixi($token,$fakeid,$cookie,$cookies);//将用户详细信息转换成变量
//var_dump($deng);
                $deng= preg_replace('/[\{]+/i','',$deng);
                $deng= preg_replace('/[\}]+/i','',$deng);
                $deng= preg_replace('/[\[]+/i','',$deng);
                $deng= preg_replace('/[\]]+/i','',$deng);
                $aaa=preg_replace('/["]+/i','',$deng);
                $aaaq=str_replace(',','&',$aaa);
                $aaaq =str_replace(':','=',$aaaq);
                $aaaq="?$aaaq";
                $ab=trim($aaaq);
                $bb=str_replace(" ","",$ab);
                $bb=str_replace("\r\n","",$bb);
                $bb=str_replace("\n","",$bb); 

parse_str($bb);
$Signature= $signature;
$NickName=$nick_name;
  $Country=$country;
  $City=$city;
  $Province=$province;
  $Sex=$gender;
  $Username=$user_name;
$ReMarkName=$remark_name;
  
     $u_m=substr($bb,(strpos($bb,"&groups="))+4);
                $u_m=preg_replace('/[groups groups]+/i','',$u_m); 
$u_m=str_replace("==","",$u_m);
$u_m=str_replace("&cnt=","^",$u_m);
$u_m=str_replace("&name","",$u_m);
$u_m=str_replace("id=","id",$u_m);
$u_m='?'.$u_m;
parse_str($u_m);
$fenzhu='id'.$group_id;
$fengzhu=$$fenzhu;
$FakeId=$fakeid;

$img=gethead($token,$fakeid,$cookie);//注意从此行开始以下代码无需更改
$filename ="{$fakeid}.jpg";//要生成的图片名字
$jpg = $img;//得到post过来的二进制原始数据
$file = fopen("img/".$filename,"w");//打开文件准备写入
fwrite($file,$jpg);//写入
fclose($file);//关闭
$imgurl =$siurl."/img/".$filename;


$voice=getvoice($token,$messageid,$cookie);
//var_dump($voice);
$sname = "{$messageid}.mp3";
$mp3 = $voice;
$file = fopen("vs/".$sname,"w");
fwrite($file,$mp3);
fclose($file);
$sound = $siurl."/vs/".$sname;

$video=getvideo($token,$messageid,$cookie);
$sname = "{$messageid}.mp4";
$mp4 = $video;
$file = fopen("vv/".$sname,"w");
fwrite($file,$mp4);
fclose($file);
$shipin =$siurl."/vv/".$sname;

if($Sex=="1"){
  $Sex="男";
$ta="他";}else{$Sex="女";$ta="她";}
$picurll= $request['PicUrl'];
if($type=="1"){
	$type="文字";
}elseif($type=="2"){
  $type="图片<img src='$picurll' />";}elseif($type=="3"){
  $type="语音<audio src=$sound autoplay=autoplay controls=controls></audio>";}elseif($type=="4")
  {$type="视频<br>
	<video src=$shipin autoplay=autoplay controls=controls width='320' height='240'></video>";}
	
$b2=substr($content,0,6);
if($b2=="中国"){
	$typ="1";
	$lbs=$content;
	$content=str_replace('邮政编码','',$content);
	$es="地理位置";
$imglbs="http://api.map.baidu.com/staticimage?center=$content&width=300&height=200&zoom=16&markers=$content&markerStyles=-1,http://focxconnmusic.duapp.com/0.png,-1,33,25";
 }
$ik=<<<si
	<img src='{$imgurl}' width='50'><br/>
	
	类型:<span style='color:#f00'>$type</span><br/>
	消息ID:<span style='color:#f00'>$messageid</span><br/>
	昵称：<span style='color:#f00'>$NickName<br/></span>
	TOKEN:<span style='color:#f00'>$token<br/></span>
	发送内容：<span style='color:#f00'>$content<br/></span>
      		
	头像地址：<span style='color:#f00'>$imgurl<br/></span>
	备注名：<span style='color:#f00'>$ReMarkName<br/></span>
	微信号：<span style='color:#f00'>$Username<br/></span>
	签名：<span style='color:#f00'>$Signature<br/></span>
	国家：<span style='color:#f00'>$Country<br/></span>
	省：<span style='color:#f00'>$Province<br/></span>
	城市：<span style='color:#f00'>$City<br/></span>
	分组：<span style='color:#f00'>$fengzhu<br/></span>
	姓别：<span style='color:#f00'>$Sex<br/></span>
	FakeId：<span style='color:#f00'>$FakeId<br/></span>
      <a href="./index.php">返回首页</a>
si;
echo $ik;
$xml=<<<xml
  ?qq=123&wxuser=$Username&nickname=$NickName&city=$City&sex=$Sex
  &wxhead=$imgurl
  &fakeid=$FakeId&fengzhu=$fengzhu&messageid=$messageid&type=$type&bzname=$ReMarkName
  &qm=$Signature&date=$date&country=$Country&province=$Province
xml;
parse_str($xml);
echo $nickname;//数据库传送地址
include './baeinsert.php';
?>