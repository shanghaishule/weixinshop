<?php if (!defined('THINK_PATHSLAPP')) exit();?><!DOCTYPE html>
<html lang="zh-CN" >
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="format-detection" content="telephone=no" />
<title></title>
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/card/wei_webapp_new_v1.0.4.css" />
<script src="<?php echo RES;?>/js/card/jquery.js"  type="text/javascript" ></script>
<script src="<?php echo RES;?>/js/card/rotate.js"  type="text/javascript"></script>
<style>

 .yuan {
 float:right;
background-color: #179F00;
font-size: 12px;
color:white;
text-decoration: none;
border: 1px solid #0B8E00;
Invalid property value.background-image: linear-gradient(bottom, #179F00 0%, #5DD300 100%);
Invalid property value.background-image: -o-linear-gradient(bottom, #179F00 0%, #5DD300 100%);
Invalid property value.background-image: -moz-linear-gradient(bottom, #179F00 0%, #5DD300 100%);
background-image: -webkit-linear-gradient(bottom, #179F00 0%, #5DD300 100%);
Invalid property value.background-image: -ms-linear-gradient(bottom, #179F00 0%, #5DD300 100%);
background-image: -webkit-gradient(
 linear,
 left bottom,
 left top,
 color-stop(0, #179F00),
 color-stop(1, #5DD300)
 );
</style>

<script type="text/javascript">
$(document).ready(function(){
	var value = 360;
	$(".card").bind('click',function(){		
		if($("#card2").is(":hidden")){
			$("#card").rotate({ animateTo:value});
			$("#card").delay(600).hide(0);
			$("#card2").delay(600).show(0);
		
		}else{
			$("#card2").rotate({ animateTo:value});
			$("#card").delay(600).show(0);
			$("#card2").delay(600).hide(0);
		
		}
		
	});	
});

</script>
<script>
$(function(){
	$('#vip1').height(50);
	$('#vip1').click(function(){
		if($('#vip').is(':hidden')){
			$('#vip').show();
			$('#vip1').height('100%');
		}else{
			$('#vip').hide();
			$('#vip1').height('50');
		}
	});
	$('#vip2').height(50);
	$('#vip2').click(function(){
		if($('#vip-2').is(':hidden')){
			$('#vip-2').show();
			$('#vip2').height('100%');
		}else{
			$('#vip-2').hide();
			$('#vip2').height('50');
		}
	});
	$('#vip3').height(50);
	$('#vip3').click(function(){
		if($('#vip-3').is(':hidden')){
			$('#vip-3').show();
			$('#vip3').height('100%');
		}else{
			$('#vip-3').hide();
			$('#vip3').height('50');
		}
	});
});
</script>
</head>
<body id="page_card" style="margin-bottom:50px;">
<div id="mappContainer">
  <div class="inner root" style="height: 468px;">
    <div id="card" class="card" style="background:url('<?php echo ($card["diybg"]); ?>') no-repeat 0 0;-webkit-background-size:267px 159px;background-size:267px 159px;">
		  <img src="<?php echo ($card["logo"]); ?>" class="logo"/>
		  <h1 style="color:<?php echo ($card["vipnamecolor"]); ?>;text-shadow:0 1px #e2ded2;"><?php echo ($card["cardname"]); ?></h1>
		  <!--<h2></h2>-->
		  <figure class="pdo twodim" hidden=""><img data-src="006 4655"></figure>
		  <figure class="pdo barcode" hidden=""><img data-src="006 4655"></figure>
		  <strong class="pdo verify" style="">
				<span style="color:#847d64;text-shadow:0 1px #ebe9e0;"><em style="color:#847d64;text-shadow:0 1px #ebe9e0;">会员卡号</em><span style="color:<?php echo ($card["numbercolor"]); ?>"><?php echo ($card_info["number"]); ?></span></span>
		  </strong>
	  </div>
	  <!--会员卡背面-->
	  <div id="card2" class="card" style="background:url('<?php echo ($card["diybg"]); ?>') no-repeat 0 0;-webkit-background-size:267px 159px;background-size:267px 159px;display:none">
		  <img src="<?php echo ($card["logo"]); ?>" class="logo"/>
		  <h1 style="color:<?php echo ($card["vipnamecolor"]); ?>;text-shadow:0 1px #e2ded2;"><?php echo ($card["cardname"]); ?></h1>
		  <!--<h2></h2>-->
		  <div style="padding-top:50px;color:#847d64;font-size:12px;margin-left:10px;"><span style="color:<?php echo ($card["vipnamecolor"]); ?>">总店电话：<a style="color:#000" href="tel:<?php echo ($addr["tel"]); ?>"><?php echo ($contact["tel"]); ?></a></span><p></p>
		  <span style="color:<?php echo ($card["vipnamecolor"]); ?>">总店地址：<?php echo ($contact["info"]); ?></span>
		  </div>
		  
		 
		  
	  </div>
    <p><span data-hidden-when-lost="使用时向服务员出示此卡"><?php echo ($card["msg"]); ?></span></p>
   
    <ul class="round" style="display:block">
     <li  class="intro" style="display:block;height:100%" id="vip1">	
		<div style="width:60px;float:left">
			<img src="tpl/User/default/common/images/cart_info/power1.png" width="50">
		</div>
		<div style="float:leftwidth:460px;">
			<?php echo ($vip["title"]); ?><br/>到期时间：<?php if($vip["enddate"] != false): echo (date('Y/m/d',$vip["enddate"])); else: ?> 暂时无该活动<?php endif; ?>	
			
		</div>
		<div style="clear:both;background:rgb(230, 230, 230);font-size:12px;display:none;padding:5px;" id="vip"><?php echo (htmlspecialchars_decode($vip["info"])); ?></div>		
	</li>
      <!-- 自定义链接在预存余额下面显示 -->
    </ul>
	 <ul class="round" style="display:block">
     <li style="height:50px;" class="intro" id="vip2">
		<div style="width:60px;float:left">
			<img src="tpl/User/default/common/images/cart_info/power2.png" width="50">
		</div>
		<div style="float:left;">
			<?php echo ($coupon["title"]); ?><br/>到期时间：<?php if($coupon["enddate"] != false): echo (date('Y/m/d',$coupon["enddate"])); else: ?> 暂时无该活动<?php endif; ?>	
			
		</div>
		<div style="clear:both;background:rgb(230, 230, 230);font-size:12px;display:none;padding:5px;" id="vip-2"><p><?php echo (htmlspecialchars_decode($coupon["info"])); ?></p></div>
	</li>
	</ul>
	<ul class="round" style="display:block">
     <li style="height:50px;" class="intro" id="vip3">
	 <div style="width:60px;float:left">
			<img src="tpl/User/default/common/images/cart_info/power3.png" width="50">
		</div>
		<div style="float:left;">
			<?php echo ($integral["title"]); ?><br/>到期时间： <?php if($integral["enddate"] != false): echo (date('Y/m/d',$integral["enddate"])); else: ?> 暂时无该活动<?php endif; ?>			
		</div>
		<div style="clear:both;background:rgb(230, 230, 230);font-size:12px;display:none;padding:5px;" id="vip-3"><p><?php echo (htmlspecialchars_decode($integral["info"])); ?></p></div>
	</li>
    
      <!-- 自定义链接在预存余额下面显示 -->
    </ul>
    <ul class="round" style="display:block;clear:both">
      <li class="intro" style="">
	  <a href="javascript:void(0)" onClick="location.href='<?php echo U('Signscore/index',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>'">会员卡签到</a></li>
	  <li class="intro" style="">
	  <a href="javascript:void(0)" onClick="location.href='<?php echo U('Signscore/expend',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>'">我的消费记录</a></li>
      <li class="intro" style="">
	  <a href="javascript:void(0)" onClick="location.href='<?php echo U('Userinfo/index',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>';">我的资料</a></li>
      <li class="intro" style="">
	  <a href="javascript:void(0)" onClick="location.href='<?php echo U('Card/info',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>';">会员卡说明</a></li>
      <li class="applicable" style="">
	  <a href="javascript:void(0)" onClick="location.href='<?php echo U('Card/addr',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>';">门店电话及地址</a></li>
	  
    </ul>
  </div>
  <div class="footFix" id="modal"></div>
</div>

</body>
</html>