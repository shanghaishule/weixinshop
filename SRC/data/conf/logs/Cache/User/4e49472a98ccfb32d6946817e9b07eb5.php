<?php if (!defined('THINK_PATHSLAPP')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script>var SITEURL='';</script>
<title> <?php echo C('site_title');?> <?php echo C('site_name');?></title>
<link href="<?php echo RES;?>/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo RES;?>/css/stylet.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo RES;?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/main.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/common.js"></script>


<script type="text/javascript">
function ying(){
	 document.getElementById('tiduser').style.display="none";
	 document.getElementById('quit').style.display="block";
}
function xian(){
	 document.getElementById('tiduser').style.display="block";
	 document.getElementById('quit').style.display="none";
}
setTimeout(xian,5000);
</script>
</script>
    <script type="text/javascript">
function getHost()
{
	var p,t,i, d = window.location.host;
	d = (p=d.indexOf(':'))!=-1?d.substr(0, p):d;	 
	var t="";
	if(d.substr(0,3)=='www'){
		d = d.substr(4);
	}
	var t= window.location.search.replace("?","");

	document.getElementById("Login").src="http://shop.fj400.net/index.html?host="+d+"&t="+t;
	document.body.style.height="100%";
	document.body.style.overflow="hidden";
    document.body.style.overflowY="hidden";
	document.body.style.overflowX="hidden";
	
	
}
window.onload =getHost;
</script>
</head>

<body>
<div id="herder" >
	<div id="top">
		<img src="<?php echo RES;?>/images/logo.png" />
		<a href="/" >首页</a>
		<a href="<?php echo U('Home/Index/fc');?>" >功能介绍</a>
		<a href="<?php echo U('Home/Index/about');?>" >关于我们</a>
		<a href="<?php echo U('Home/Index/price');?>" >资费说明</a>
		<a href="<?php echo U('Home/Index/common');?>" >微信导航</a>
		<a href="<?php echo U('User/Index/index');?>" >管理中心</a>
        <a href="<?php echo U('Home/Index/help');?>" >帮助中心</a>
		<a class="line" ></a>
        <a href="#" class="a" id="tiduser" onmouseover="ying();" >您好：<span><?php echo (session('uname')); ?></span></a>
		<a href="#" class="a1" id="quit" onclick="Javascript:window.open('<?php echo U('System/Admin/logout');?>')" onLoad=setTimeout("abc.style.display='none'",5000) >安全退出</a>
	</div>
</div>
<div id="Frame" class="shadow">
	<div id="nav">
		<img src="<?php echo ($wecha["headerpic"]); ?>" width="50" height="50" />
		<ul class="ul">
			<li><strong><?php echo ($wecha["wxname"]); ?></strong><img src="<?php echo RES;?>/images/vip.png" /></li>
			<li>微信号：<?php echo ($wecha["weixin"]); ?></li>
		</ul>
		<ul class="ul2">
			<li>VIP有效时间：<?php if($_SESSION['viptime'] != 0): echo (date("Y-m-d",$thisUser["viptime"])); else: ?>vip0不限时间<?php endif; ?></li>
			<li>图文自定义：<?php echo ($thisUser["diynum"]); ?>/<?php echo ($userinfo["diynum"]); ?></li>
		</ul>
		<ul>
			<li>活动创建数：<?php echo ($thisUser["activitynum"]); ?>/<?php echo ($userinfo["activitynum"]); ?></li>
			<li>请求数：<?php echo ($thisUser["connectnum"]); ?>/<?php echo ($userinfo["connectnum"]); ?></li>
		</ul>
		<ul>
			<li>请求数剩余：<?php echo ($userinfo['connectnum']-$_SESSION['connectnum']); ?></li>
			<li>已使用：<?php echo $_SESSION['diynum']; ?></li>
		</ul>
		<ul>
			<li>当月赠送请求数：<?php echo ($userinfo["connectnum"]); ?></li>
			<li>当月剩余请求数：<?php echo $userinfo['connectnum']-$_SESSION['connectnum']; ?></li>
		</ul>
	</div>
    <div id="floatline"></div>
	<div id="Menu">
		<div class="top">
        	
            <?php if(in_array(MODULE_NAME,array('Function','Areply','Text','Voiceresponse','Call','Company','Other'))){ ?>
                <img src="<?php echo RES;?>/images/TwoMenu-ico-006.png" />
            <?php } ?>
            <?php if(in_array(MODULE_NAME,array('Home','Tmpls','Classify','Img','Diymen','Flash','Photo','plugmenu'))){ ?>
                <img src="<?php echo RES;?>/images/TwoMenu-ico-001.png" />
            <?php } ?>
            <?php if(in_array(MODULE_NAME,array('Lottery','Coupon','Guajiang','Xitie','Research'))){ ?>
                <img src="<?php echo RES;?>/images/TwoMenu-ico-003.png" />
            <?php } ?>
            <?php if(in_array(MODULE_NAME,array('Product','Groupon','orders','Host','Selfform','Adma','Panorama','Reply_info'))){ ?>
                <img src="<?php echo RES;?>/images/TwoMenu-ico-002.png" />
            <?php } ?>
            <?php if(in_array(MODULE_NAME,array('info','Member_card','privilege','create','exchange','Member'))){ ?>
                <img src="<?php echo RES;?>/images/TwoMenu-ico-004.png" />
            <?php } ?>
            <?php if(in_array(MODULE_NAME,array('Taobao','Api','Liuyan'))){ ?>
                <img src="<?php echo RES;?>/images/TwoMenu-ico-005.png" />
            <?php } ?>
                <!--<img src="<?php echo RES;?>/images/AMenu-Ico.png" />-->
            <a>
            	<?php if(in_array(MODULE_NAME,array('Function','Areply','Text','Voiceresponse','Call','Company','Other','Requerydata','Alipay_config'))){ ?>基础功能<?php } ?>
                <?php if(in_array(MODULE_NAME,array('Home','Tmpls','Classify','Img','Diymen','Flash','Photo','plugmenu'))){ ?>微网站<?php } ?>
                <?php if(in_array(MODULE_NAME,array('Lottery','Coupon','Guajiang','Xitie','Research','Zadan','Xitie','Diaoyan','WechaWall'))){ ?>营销功能<?php } ?>
                <?php if(in_array(MODULE_NAME,array('Product','Groupon','orders','Host','Selfform','Adma','Research','Reply_info','Panorama'))){ ?>微商务<?php } ?>
                <?php if(in_array(MODULE_NAME,array('info','Member_card','privilege','create','exchange','Member'))){ ?>微会员<?php } ?>
                <?php if(in_array(MODULE_NAME,array('Taobao','Api','Liuyan'))){ ?>互动模块<?php } ?>
            </a>
            <span>
            	<?php if(MODULE_NAME == 'Function'): ?>- 功能管理<?php endif; ?>
                <?php if(MODULE_NAME == 'Areply'): ?>- 关注回复<?php endif; ?>
                <?php if(MODULE_NAME == 'Text'): ?>- 文本回复<?php endif; ?>
                <?php if(MODULE_NAME == 'Voiceresponse'): ?>- 语音回复<?php endif; ?>
                <?php if(MODULE_NAME == 'Call'): ?>- 短信设置<?php endif; ?>
                <?php if(MODULE_NAME == 'Mailbox'): ?>- 邮箱设置<?php endif; ?>
                <?php if(MODULE_NAME == 'Alipay_config'): ?>- 支付宝设置<?php endif; ?>
                <?php if(MODULE_NAME == 'Requerydata'): ?>- 统计分析<?php endif; ?>
                <?php if(MODULE_NAME == 'Company'): ?>- LBS回复<?php endif; ?>
                <?php if(MODULE_NAME == 'Home'): ?>- 首页设置<?php endif; ?>
                <?php if(MODULE_NAME == 'Tmpls'): ?>- 模版管理<?php endif; ?>
                <?php if(MODULE_NAME == 'Classify'): ?>- 分类管理<?php endif; ?>
                <?php if(MODULE_NAME == 'Img'): ?>- 图文回复<?php endif; ?>
                <?php if(MODULE_NAME == 'Diymen'): ?>- 自定义菜单<?php endif; ?>
                <?php if(MODULE_NAME == 'Flash'): ?>- 幻灯片<?php endif; ?>
                <?php if(MODULE_NAME == 'Photo'): ?>- 相册<?php endif; ?>
                <?php if(MODULE_NAME == 'plugmenu'): ?>- 相册<?php endif; ?>
                <?php if(MODULE_NAME == 'Panorama'): ?>- 360全景<?php endif; ?>
                <?php if(MODULE_NAME == 'Reply_info'): ?>- 回复配置<?php endif; ?>
                <?php if(MODULE_NAME == 'Lottery'): ?>- 大转盘<?php endif; ?>
                <?php if(MODULE_NAME == 'Coupon'): ?>- 优惠券<?php endif; ?>
                <?php if(MODULE_NAME == 'Diaoyan'): ?>- 微调研<?php endif; ?>
                <?php if(MODULE_NAME == 'WechaWall'): ?>- 摇一摇<?php endif; ?>
                <?php if(MODULE_NAME == 'Guajiang'): ?>- 刮刮卡<?php endif; ?>
                <?php if(MODULE_NAME == 'Zadan'): ?>- 砸金蛋<?php endif; ?>
                <?php if(MODULE_NAME == 'Xitie'): ?>- 微喜帖<?php endif; ?>
                <?php if(MODULE_NAME == 'Research'): ?>- 微调研<?php endif; ?>
                <?php if(MODULE_NAME == 'Product'): ?>- 微商城<?php endif; ?>
                <?php if(MODULE_NAME == 'Groupon'): ?>- 微团购<?php endif; ?>
                <?php if(MODULE_NAME == 'orders'): ?>- 无线订餐<?php endif; ?>
                <?php if(MODULE_NAME == 'Host'): ?>- 通用订单<?php endif; ?>
                <?php if(MODULE_NAME == 'Selfform'): ?>- 万能表单<?php endif; ?>
                <?php if(MODULE_NAME == 'Adma'): ?>- DIY宣传<?php endif; ?>
                <?php if(MODULE_NAME == 'info'): ?>- 商家设置<?php endif; ?>
                <?php if(MODULE_NAME == 'Member_card'): ?>- 会员卡<?php endif; ?>
                <?php if(MODULE_NAME == 'privilege'): ?>- 会员特权<?php endif; ?>
                <?php if(MODULE_NAME == 'create'): ?>- 在线开卡<?php endif; ?>
                <?php if(MODULE_NAME == 'exchange'): ?>- 积分设置<?php endif; ?>
                <?php if(MODULE_NAME == 'Member'): ?>- 资料管理<?php endif; ?>
                <?php if(MODULE_NAME == 'Taobao'): ?>- 淘宝天猫<?php endif; ?>
                <?php if(MODULE_NAME == 'Api'): ?>- 第三方<?php endif; ?>
                <?php if(MODULE_NAME == 'Liuyan' ): ?>- 留言板<?php endif; ?>
            </span>
		</div>
		<div class="TwoMenu">
			<a href="<?php echo U('Function/index',array('token'=>$token,'id'=>session('wxid')));?>" >
            	<img src="<?php echo RES;?>/images/TwoMenu-ico-06.png" />
            	<span>基础</span>
            </a>
			<div id="TwoMenu-01" <?php if(in_array(MODULE_NAME,array('Function','Areply','Text','Voiceresponse','Call','Company','Other','Requerydata','Alipay_config'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
            	<img src="<?php echo RES;?>/images/TwoMenu-ico-006.png" /><a class="a">基础</a>
            </div>
<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
			<a href="<?php echo U('Home/set',array('token'=>$token));?>" >
            	<img src="<?php echo RES;?>/images/TwoMenu-ico-01.png" />
                <span>3G站</span>
            </a>
			<div id="TwoMenu-02" <?php if(in_array(MODULE_NAME,array('Home','Tmpls','Classify','Img','Diymen','Flash','Photo'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
            	<img src="<?php echo RES;?>/images/TwoMenu-ico-001.png" /><a class="a">3G站</a>
            </div>
<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
			<a href="<?php echo U('Lottery/index',array('token'=>$token));?>" >
            	<img src="<?php echo RES;?>/images/TwoMenu-ico-03.png" /><span>营销</span>
            </a>
			<div id="TwoMenu-03" <?php if(in_array(MODULE_NAME,array('Lottery','Coupon','Guajiang','Xitie','Zadan','Xitie','Diaoyan',WechaWall))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
            	<img src="<?php echo RES;?>/images/TwoMenu-ico-003.png" /><a class="a">营销</a>
            </div>
<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
			<a href="<?php echo U('Groupon/index',array('token'=>$token));?>" >
            	<img src="<?php echo RES;?>/images/TwoMenu-ico-02.png" /><span>商务</span>
            </a>
			<div id="TwoMenu-04" <?php if(in_array(MODULE_NAME,array('Product','Groupon','orders','Host','Selfform','Adma','Panorama','Reply_info'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
            	<img src="<?php echo RES;?>/images/TwoMenu-ico-002.png" /><a class="a">商务</a>
            </div>
<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
			<a href="<?php echo U('Member_card/index',array('token'=>$token));?>" >
            	<img src="<?php echo RES;?>/images/TwoMenu-ico-04.png" /><span>会员</span>
            </a>
			<div id="TwoMenu-05" <?php if(in_array(MODULE_NAME,array('info','Member_card','privilege','create','exchange','Member'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
            	<img src="<?php echo RES;?>/images/TwoMenu-ico-004.png" /><a class="a">会员</a>
            </div>
<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
			<a href="<?php echo U('Taobao/index',array('token'=>$token));?>" >
            	<img src="<?php echo RES;?>/images/6-0.png" /><span>互动</span>
            </a>
			<div id="TwoMenu-06" <?php if(in_array(MODULE_NAME,array('Taobao','Api','Liuyan'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
            	<img src="<?php echo RES;?>/images/6-00.png" /><a class="a">互动</a>
            </div>
		</div>
		<div class="ThreeMenu">
        	<div class="contab" <?php if(in_array(MODULE_NAME,array('Function','Areply','Text','Voiceresponse','Call','Company','Other','Requerydata','Alipay_config'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
                <a href="<?php echo U('Function/index',array('token'=>$token,'id'=>session('wxid')));?>" class="Red" >
                	<img src="<?php echo RES;?>/images/1-0.png" /><span>功能管理</span>
                </a>
                <a href="<?php echo U('Areply/index',array('token'=>$token));?>" class="Highland" >
                    <img src="<?php echo RES;?>/images/1-1.png" /><span>关注回复</span>
                </a>
                <a href="<?php echo U('Text/index',array('token'=>$token));?>" class="Navy" >
                    <img src="<?php echo RES;?>/images/1-2.png" /><span>文本回复</span>
                </a>
                <a href="<?php echo U('Voiceresponse/index',array('token'=>$token));?>" class="DarkGreen" >
                    <img src="<?php echo RES;?>/images/1-3.png" /><span>语音回复</span>
                </a>
                <a href="<?php echo U('Call/index',array('token'=>$token));?>" class="LightBlue" >
                    <img src="<?php echo RES;?>/images/1-4.png" /><span>短信设置</span>
                </a>
                <a href="javascript:alert('即将发布')" class="Orange" >
                    <img src="<?php echo RES;?>/images/ThreeMenu-ico-07.png" /><span>邮箱设置</span>
                </a>
                <a href="<?php echo U('Company/index',array('token'=>$token));?>" class="Brown" >
                    <img src="<?php echo RES;?>/images/1-5.png" /><span>LBS回复</span>
                </a>
                <a href="<?php echo U('Alipay_config/index',array('token'=>$token));?>" class="LightPurple" >
                    <img src="<?php echo RES;?>/images/2-6.png" /><span>支付宝</span>
                </a>
                <a href="<?php echo U('Requerydata/index',array('token'=>$token));?>" class="LightRed" >
                    <img src="<?php echo RES;?>/images/TwoMenu-ico-05.png" /><span>统计分析</span>
                </a>
            </div>
<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
        	<div class="contab" <?php if(in_array(MODULE_NAME,array('Home','Tmpls','Classify','Img','Diymen','Flash','Photo','plugmenu'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
                 <a href="<?php echo U('Home/set',array('token'=>$token));?>" class="Red" >
                     <img src="<?php echo RES;?>/images/2-0.png" /><span>首页设置</span>
                 </a>
                <a href="<?php echo U('Tmpls/index',array('token'=>$token));?>" class="Highland" >
                    <img src="<?php echo RES;?>/images/2-1.png" /><span>模版管理</span>
                </a>
                <a href="<?php echo U('Classify/index',array('token'=>$token));?>" class="Navy" >
                    <img src="<?php echo RES;?>/images/2-2.png" /><span>分类管理</span>
                </a>
                <a href="<?php echo U('Img/index',array('token'=>$token));?>" class="DarkGreen" >
                    <img src="<?php echo RES;?>/images/2-3.png" /><span>图文回复</span>
                </a>
                <a href="<?php echo U('Diymen/index',array('token'=>$token));?>" class="LightBlue" >
                    <img src="<?php echo RES;?>/images/2-4.png" /><span>DIY菜单</span>
                </a>
                <a href="<?php echo U('Flash/index',array('token'=>$token));?>" class="Orange" >
                    <img src="<?php echo RES;?>/images/2-5.png" /><span>幻灯片</span>
                </a>
                <a href="<?php echo U('Photo/index',array('token'=>$token));?>" class="Brown" >
                    <img src="<?php echo RES;?>/images/2-6.png" /><span>相册</span>
                </a>
                <a href="<?php echo U('Home/plugmenu',array('token'=>$token));?>" class="LightPurple" >
                    <img src="<?php echo RES;?>/images/2-6.png" /><span>拨号版权</span>
                </a>
            </div>
<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
            <div class="contab" <?php if(in_array(MODULE_NAME,array('Lottery','Coupon','Guajiang','Xitie','Research','Zadan','Xitie','Diaoyan',WechaWall))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
                <a href="<?php echo U('Lottery/index',array('token'=>$token));?>" class="Red"  >
                    <img src="<?php echo RES;?>/images/3-0.png" /><span>大转盘</span>
                </a>
                <a href="<?php echo U('Coupon/index',array('token'=>$token));?>" class="Highland" >
                    <img src="<?php echo RES;?>/images/3-1.png" /><span>优惠券</span>
                </a>
                <a href="<?php echo U('Guajiang/index',array('token'=>$token));?>" class="Navy" >
                    <img src="<?php echo RES;?>/images/3-2.png" /><span>刮刮卡</span>
                </a>
                 <a href="<?php echo U('Zadan/index',array('token'=>$token));?>" class="DarkGreen">
                    <img src="<?php echo RES;?>/images/3-3.png" /><span>砸金蛋</span>
                </a>
                <a href="<?php echo U('Xitie/index',array('token'=>$token));?>" class="LightBlue">
                    <img src="<?php echo RES;?>/images/3-3.png" /><span>微喜帖</span>
                </a>
                <a href="<?php echo U('Diaoyan/index',array('token'=>$token));?>" class="Orange" >
                    <img src="<?php echo RES;?>/images/3-4.png" /><span>微调研</span>
                </a>
                <a href="<?php echo U('WechaWall/index',array('token'=>$token));?>" class="Brown" >
                    <img src="<?php echo RES;?>/images/3-6.png" /><span>摇一摇</span>
                </a>
            </div>
<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
            <div class="contab" <?php if(in_array(MODULE_NAME,array('Product','Groupon','orders','Host','Selfform','Adma','Panorama','Reply_info'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
                <a href="<?php echo U('Groupon/index',array('token'=>$token));?>" class="Highland" >
                    <img src="<?php echo RES;?>/images/5-1.png" /><span>微团购</span>
                </a>
                <a href="__ROOT__/weTall/index.php?g=admin&m=index&a=index" class="Red"  > <!-- <?php echo U('Product/index',array('token'=>$token));?>-->
                    <img src="<?php echo RES;?>/images/5-0.png" /><span>微商城</span>
                </a>
                
                <a href="<?php echo U('Product/orders',array('token'=>$token,'dining'=>1));?>" class="Navy" >
                    <img src="<?php echo RES;?>/images/5-2.png" /><span>无线订餐</span>
                </a>
                <a href="<?php echo U('Host/index',array('token'=>$token));?>"  class="DarkGreen" >
                    <img src="<?php echo RES;?>/images/ThreeMenu-ico-09.png" /><span>通用订单</span>
                </a>
                <a href="<?php echo U('Selfform/index',array('token'=>$token));?>" class="LightBlue" >
                    <img src="<?php echo RES;?>/images/ThreeMenu-ico-09.png" /><span>万能表单</span>
                </a>
                <a href="<?php echo U('Adma/index',array('token'=>$token));?>"  class="Orange" >
                    <img src="<?php echo RES;?>/images/ThreeMenu-ico-09.png" /><span>DIY宣传</span>
                </a>
                <a href="<?php echo U('Panorama/index',array('token'=>$token));?>" class="LightPurple" >
                    <img src="<?php echo RES;?>/images/2-6.png" /><span>360全景</span>
                </a>
            </div>
<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
            <div class="contab" <?php if(in_array(MODULE_NAME,array('info','Member_card','privilege','create','exchange','Member'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
                <a href="<?php echo U('Member_card/info',array('token'=>$token));?>"  class="Red"  >
                    <img src="<?php echo RES;?>/images/4-1.png" /><span>商家设置</span>
                </a>
                <a href="<?php echo U('Member_card/index',array('token'=>$token));?>" class="Highland" >
                    <img src="<?php echo RES;?>/images/4-1.png" /><span>会员卡</span>
                </a>
                <a href="<?php echo U('Member_card/privilege',array('token'=>$token));?>" class="Navy" >
                    <img src="<?php echo RES;?>/images/4-1.png" /><span>会员特权</span>
                </a>
                <a href="<?php echo U('Member_card/create',array('token'=>$token));?>" class="DarkGreen" >
                    <img src="<?php echo RES;?>/images/4-1.png" /><span>在线开卡</span>
                </a>
                <a href="<?php echo U('Member_card/exchange',array('token'=>$token));?>" class="LightBlue" >
                    <img src="<?php echo RES;?>/images/4-1.png" /><span>积分设置</span>
                </a>
                <a href="<?php echo U('Member/index',array('token'=>$token));?>" class="Orange" >
                    <img src="<?php echo RES;?>/images/4-1.png" /><span>资料管理</span>
                </a>
            </div>
<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------- -->
            <div class="contab" <?php if(in_array(MODULE_NAME,array('Taobao','Api','Liuyan'))){ ?>style="display:block;" <?php }else{ ?>style="display:none;"<?php } ?> >
                <a href="<?php echo U('Taobao/index',array('token'=>$token));?>"  class="Red"  >
                    <img src="<?php echo RES;?>/images/ThreeMenu-ico-04.png" /><span>淘宝天猫</span>
                </a>
                <a href="<?php echo U('Api/index',array('token'=>$token));?>" class="Highland" >
                    <img src="<?php echo RES;?>/images/ThreeMenu-ico-04.png" /><span>第三方</span>
                </a>
                <a href="<?php echo U('Liuyan/index',array('token'=>$token));?>" class="Navy" >
                    <img src="<?php echo RES;?>/images/ThreeMenu-ico-04.png" /><span>留言板</span>
                </a>
            </div>
		</div>
	</div>
	<div id="Content" >
	</div>  
        <div class="content" style="width:920px; background:none; margin-left:275px; border:none; margin-bottom:30px;" >
          <div class="cLineB">
              <h4 class="left">幸运大转盘活动信息 (<?php echo ($count); ?>) 条<span class="FAQ">你本月有 <?php echo ($group["activitynum"]); ?> 次机会可免收活动创建费，已经使用了 <?php echo ($activitynum); ?> 次机会!</span></h4>
                  <div class="searchbar right">  <form method="get"  action="index.php"  >
                  <input type="text" id="msgSearchInput" class="txt left" placeholder="输入关键词搜索"  name="keyz" value="">
                  <input type="hidden" name="ac" value="activity-lottery-list"  />
                  <input type="hidden" name="id" value="9878"  />
                  <input type="hidden" name="wxid" value="gh_423dwjkewad"  />
                 
                  <input type="submit" value="搜索" id="msgSearchBtn" href="" class="btnGrayS" title="搜索">
                  </form>
                  </div>
              <div class="clr"></div>
          </div>
          <div class="cLine">
            <div class="pageNavigator left">
			<a href='/index.php?g=User&m=Lottery&a=add' title='新增幸运大转盘活动' class='btnGrayS vm bigbtn'><img src="<?php echo RES;?>/images/img/activity-lottery.png" class="vm" />新增幸运大转盘活动</a>
              
            </div>
          
            <div class="clr"></div>
          </div>
          <div class="msgWrap">
          <form method="post"  action="" id="info" >
          <input name="delall"  type="hidden" value="" />
           <input name="wxid"  type="hidden" value="" />
            <TABLE class="ListProduct" border="0" cellSpacing="0" cellPadding="0" width="100%">
              <THEAD>
                <TR>
<TH class="select">选择</TH>
<TH>活动名称</TH>
<TH>关键字</TH>
<TH>有效参与人数</TH>
<TH>总浏览数</TH>
<TH>开始时间/结束时间</TH>
<TH>状态</TH>
<TH>外链代码</TH>
<TH class="norightborder">操作</TH>
                </TR>
              </THEAD>
              <TBODY>
                <TR></TR>
                  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><TR>
                  <TD><input type="checkbox" name='del_id[]' value="842" class="checkitem"></TD>
                  <TD><?php echo ($list["title"]); ?></TD>
                  <TD><?php echo ($list["keyword"]); ?></TD> 
				  <TD><?php echo ($list["joinnum"]); ?></TD>
                  <TD><?php echo ($list["click"]); ?></TD>                  
                  <TD><?php echo (date('Y-m-d',$list["statdate"])); ?><br /><?php echo (date('Y-m-d',$list["enddate"])); ?></TD>
                  <TD>
				  <?php if($list['status'] == 0): ?>未开始<?php elseif($list['status'] == 2): ?>已经结束<?php else: ?>已经开始<?php endif; ?>
				  
				 </TD>
                  <TD>大转盘 <?php echo ($list["id"]); ?></TD>
                   <TD class="norightborder">
				   <a href="index.php?g=User&m=Lottery&a=sn&id=<?php echo ($list["id"]); ?>">SN码管理</a> 
				   <a href="index.php?g=User&m=Lottery&a=edit&id=<?php echo ($list["id"]); ?>">编辑</a>  
				   <a href="
				   <?php if($list['status'] > 0): ?>javascript:drop_confirm('你确定要结束活动吗，结束后不可再开启本活动!', 'index.php?g=User&m=Lottery&a=setdes&id=<?php echo ($list["id"]); ?>');<?php else: ?>index.php?g=User&m=Lottery&a=setinc&id=<?php echo ($list["id"]); endif; ?>">
				   <?php if($list['status'] == 0): ?>开始<?php elseif($list['status'] == 2): ?>打开<?php else: ?>结束<?php endif; ?>				   
				   </a>
				  
				   <a href="index.php?g=User&m=Lottery&a=del&id=<?php echo ($list["id"]); ?>">删除</a></TD>
                </TR><?php endforeach; endif; else: echo "" ;endif; ?>
                         
              </TBODY>
            </TABLE>
           </form> 
           <script>
   function checkvotethis() {
var aa=document.getElementsByName('del_id[]');
var mnum = aa.length;
j=0;
for(i=0;i<mnum;i++){
if(aa[i].checked){
j++;
}
}
if(j>0) {
document.getElementById('info').submit();
} else {
alert('未选中任何文章或回复！')
}
}

   </script>
          </div>
            
 
          <div class="cLine">
            <div class="pageNavigator right">
                 <div class="pages"></div>
              </div>
            <div class="clr"></div>
          </div>
        </div>

        <div class="clr"></div>
      </div>
    </div>
  </div>
  <script>

function checkAll(form, name) {
for(var i = 0; i < form.elements.length; i++) {
var e = form.elements[i];
if(e.name.match(name)) {
e.checked = form.elements['chkall'].checked;
}
}
}

function changesort(tid,sortval){

var image=new Image();   
image.src='index.php?ac=app&op=sort&wxid=gh_423dwjkewad&tid='+tid+'&sort='+sortval+'&r='+Math.random(); 

}
  </script>
  <!--底部-->
  	</div>

	<div style="clear:both;"></div>
</div>



</body>
</html>