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
                <a href="http://bestchoice88.com/weTall/index.php?g=admin&m=index&a=index" class="Red"  > <!-- <?php echo U('Product/index',array('token'=>$token));?>-->
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
<link rel="stylesheet" href="<?php echo STATICS;?>/kindeditor/themes/default/default.css" />
<link rel="stylesheet" href="<?php echo STATICS;?>/kindeditor/plugins/code/prettify.css" />
<script src="<?php echo STATICS;?>/kindeditor/kindeditor.js" type="text/javascript"></script>
<script src="<?php echo STATICS;?>/kindeditor/lang/zh_CN.js" type="text/javascript"></script>
<script src="<?php echo STATICS;?>/kindeditor/plugins/code/prettify.js" type="text/javascript"></script>
<div class="content" style="width:920px; background:none; margin-left:275px; border:none; margin-bottom:30px;" >

    <div class="cLineB">
        <h4>模板管理 <span class="FAQ">选择适合您的模版风格，手机输入“首页”测试效果。</span></h4>
    </div>

    <div class="msgWrap form">
        <ul id="tags" style="width:920px;">
            <li class="selectTag"><a onclick="selectTag('tagContent0',this)" href="javascript:void(0)">1. 栏目首页模板风格</a> </li>
            <li><a onclick="selectTag('tagContent1',this)" href="javascript:void(0)">2.图文列表模板风格</a> </li>
            <li><a onclick="selectTag('tagContent2',this)" href="javascript:void(0)">3.图文详细页模板风格</a> </li>
            <li><a onclick="selectTag('tagContent3',this)" href="javascript:void(0)">4.颜色风格&预览</a> </li>
        </ul>

        <div id="tagContent">
            <div class="tagContent selectTag" id="tagContent0">
                <fieldset>
                    <ul class="cateradio">
					    <li <?php if(($info["tpltypeid"]) == "32"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                            <label>
                                <img src="<?php echo RES;?>/images/cate137.png" onclick="javascript:alert('已选择模板32')" />
                                <input class="radio" type="radio" name="optype" value="32" <?php if(($info["tpltypeid"]) == "32"): ?>checked<?php endif; ?> /> 模板32
                            </label>
                        </li>
					    <li <?php if(($info["tpltypeid"]) == "31"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                            <label>
                                <img src="<?php echo RES;?>/images/cate136.png" onclick="javascript:alert('已选择模板31')" />
                                <input class="radio" type="radio" name="optype" value="31" <?php if(($info["tpltypeid"]) == "31"): ?>checked<?php endif; ?> /> 模板31
                            </label>
                        </li>
					    <li <?php if(($info["tpltypeid"]) == "30"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                            <label>
                                <img src="<?php echo RES;?>/images/cate133.png" onclick="javascript:alert('已选择模板30')" />
                                <input class="radio" type="radio" name="optype" value="30" <?php if(($info["tpltypeid"]) == "30"): ?>checked<?php endif; ?> /> 模板30
                            </label>
                        </li>
					    <li <?php if(($info["tpltypeid"]) == "29"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                            <label>
                                <img src="<?php echo RES;?>/images/cate132.png" onclick="javascript:alert('已选择模板29')" />
                                <input class="radio" type="radio" name="optype" value="29" <?php if(($info["tpltypeid"]) == "29"): ?>checked<?php endif; ?> /> 模板29
                            </label>
                        </li>
					    <li <?php if(($info["tpltypeid"]) == "28"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                            <label>
                                <img src="<?php echo RES;?>/images/cate131.png" onclick="javascript:alert('已选择模板28')" />
                                <input class="radio" type="radio" name="optype" value="28" <?php if(($info["tpltypeid"]) == "28"): ?>checked<?php endif; ?> /> 模板28
                            </label>
                        </li>
					    <li <?php if(($info["tpltypeid"]) == "27"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                            <label>
                                <img src="<?php echo RES;?>/images/cate130.png" onclick="javascript:alert('已选择模板27')" />
                                <input class="radio" type="radio" name="optype" value="27" <?php if(($info["tpltypeid"]) == "27"): ?>checked<?php endif; ?> /> 模板27
                            </label>
                        </li>
					    <li <?php if(($info["tpltypeid"]) == "26"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                            <label>
                                <img src="<?php echo RES;?>/images/cate128.png" onclick="javascript:alert('已选择模板26')" />
                                <input class="radio" type="radio" name="optype" value="26" <?php if(($info["tpltypeid"]) == "26"): ?>checked<?php endif; ?> /> 模板26
                            </label>
                        </li>
					    <li <?php if(($info["tpltypeid"]) == "25"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                            <label>
                                <img src="<?php echo RES;?>/images/cate127.png" onclick="javascript:alert('已选择模板25')" />
                                <input class="radio" type="radio" name="optype" value="25" <?php if(($info["tpltypeid"]) == "25"): ?>checked<?php endif; ?> /> 模板25
                            </label>
                        </li>
					    <li <?php if(($info["tpltypeid"]) == "24"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                            <label>
                                <img src="<?php echo RES;?>/images/cate124.png" onclick="javascript:alert('已选择模板24')" />
                                <input class="radio" type="radio" name="optype" value="24" <?php if(($info["tpltypeid"]) == "24"): ?>checked<?php endif; ?> /> 模板24
                            </label>
                        </li>
					    <li <?php if(($info["tpltypeid"]) == "23"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                            <label>
                                <img src="<?php echo RES;?>/images/cate123.png" onclick="javascript:alert('已选择模板23')" />
                                <input class="radio" type="radio" name="optype" value="23" <?php if(($info["tpltypeid"]) == "23"): ?>checked<?php endif; ?> /> 模板23
                            </label>
                        </li>
					    <li <?php if(($info["tpltypeid"]) == "22"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                            <label>
                                <img src="<?php echo RES;?>/images/cate122.png" onclick="javascript:alert('已选择模板22')" />
                                <input class="radio" type="radio" name="optype" value="22" <?php if(($info["tpltypeid"]) == "22"): ?>checked<?php endif; ?> /> 模板22
                            </label>
                        </li>
					    <li <?php if(($info["tpltypeid"]) == "21"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                            <label>
                                <img src="<?php echo RES;?>/images/cate121.png" onclick="javascript:alert('已选择模板21')" />
                                <input class="radio" type="radio" name="optype" value="21" <?php if(($info["tpltypeid"]) == "21"): ?>checked<?php endif; ?> /> 模板21
                            </label>
                        </li>
					    <li <?php if(($info["tpltypeid"]) == "20"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                            <label>
                                <img src="<?php echo RES;?>/images/cate120.png" onclick="javascript:alert('已选择模板20')" />
                                <input class="radio" type="radio" name="optype" value="20" <?php if(($info["tpltypeid"]) == "20"): ?>checked<?php endif; ?> /> 模板20
                            </label>
                        </li>
					    <li <?php if(($info["tpltypeid"]) == "19"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                            <label>
                                <img src="<?php echo RES;?>/images/cate119.png" onclick="javascript:alert('已选择模板19')" />
                                <input class="radio" type="radio" name="optype" value="19" <?php if(($info["tpltypeid"]) == "19"): ?>checked<?php endif; ?> /> 模板19
                            </label>
                        </li>
					    <li <?php if(($info["tpltypeid"]) == "118"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                            <label>
                                <img src="<?php echo RES;?>/images/cate118.png" onclick="javascript:alert('已选择模板18')" />
                                <input class="radio" type="radio" name="optype" value="18" <?php if(($info["tpltypeid"]) == "18"): ?>checked<?php endif; ?> /> 模板18
                            </label>
                        </li>
					    <li <?php if(($info["tpltypeid"]) == "17"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                            <label>
                                <img src="<?php echo RES;?>/images/cate117.png" onclick="javascript:alert('已选择模板17')" />
                                <input class="radio" type="radio" name="optype" value="17" <?php if(($info["tpltypeid"]) == "17"): ?>checked<?php endif; ?> /> 模板17
                            </label>
                        </li>
					    <li <?php if(($info["tpltypeid"]) == "16"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                            <label>
                                <img src="<?php echo RES;?>/images/cate116.png" onclick="javascript:alert('已选择模板16')" />
                                <input class="radio" type="radio" name="optype" value="16" <?php if(($info["tpltypeid"]) == "16"): ?>checked<?php endif; ?> /> 模板16
                            </label>
                        </li>
					    <li <?php if(($info["tpltypeid"]) == "15"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                            <label>
                                <img src="<?php echo RES;?>/images/cate115.png" onclick="javascript:alert('已选择模板15)" />
                                <input class="radio" type="radio" name="optype" value="15" <?php if(($info["tpltypeid"]) == "15"): ?>checked<?php endif; ?> /> 模板15
                            </label>
                        </li>
                        <li <?php if(($info["tpltypeid"]) == "14"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                            <label>
                                <img src="<?php echo RES;?>/images/cate114.png" onclick="javascript:alert('已选择模板14')" //>
                                <input class="radio" type="radio" name="optype" value="14" <?php if(($info["tpltypeid"]) == "14"): ?>checked<?php endif; ?> /> 模板14
                            </label>
                        </li>
                        <li <?php if(($info["tpltypeid"]) == "13"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                            <label>
                                <img src="<?php echo RES;?>/images/cate113.png" onclick="javascript:alert('已选择模板13')" />
                                <input class="radio" type="radio" name="optype" value="13" <?php if(($info["tpltypeid"]) == "13"): ?>checked<?php endif; ?> /> 模板13
                            </label>
                        </li>
                        <li <?php if(($info["tpltypeid"]) == "12"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                            <label>
                                <img src="<?php echo RES;?>/images/cate112.png" onclick="javascript:alert('已选择模板12')" />
                                <input class="radio" type="radio" name="optype" value="12" <?php if(($info["tpltypeid"]) == "12"): ?>checked<?php endif; ?> /> 模板12
                            </label>
                        </li>
                        <li <?php if(($info["tpltypeid"]) == "11"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                            <label>
                                <img src="<?php echo RES;?>/images/cate111.png" onclick="javascript:alert('已选择模板11')" />
                                <input class="radio" type="radio" name="optype" value="11" <?php if(($info["tpltypeid"]) == "11"): ?>checked<?php endif; ?> /> 模板11
                            </label>
                        </li>
                        <li <?php if(($info["tpltypeid"]) == "10"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                            <label>
                                <img src="<?php echo RES;?>/images/cate110.png" onclick="javascript:alert('已选择模板10')" />
                                <input class="radio" type="radio" name="optype" value="10" <?php if(($info["tpltypeid"]) == "10"): ?>checked<?php endif; ?> /> 模板10 
                            </label>
                        </li>
                        <li <?php if(($info["tpltypeid"]) == "9"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                            <label>
                                <img src="<?php echo RES;?>/images/cate109.png" onclick="javascript:alert('已选择模板9')" />
                                <input class="radio" type="radio" name="optype" value="9" <?php if(($info["tpltypeid"]) == "9"): ?>checked<?php endif; ?> /> 模板9 
                            </label>
                        </li>
                        <li <?php if(($info["tpltypeid"]) == "8"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                            <label>
                                <img src="<?php echo RES;?>/images/cate108.png" onclick="javascript:alert('已选择模板8')" />
                                <input class="radio" type="radio" name="optype" value="8" <?php if(($info["tpltypeid"]) == "8"): ?>checked<?php endif; ?> /> 模板8
                            </label>
                        </li>
                        <li <?php if(($info["tpltypeid"]) == "7"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                            <label>
                                <img src="<?php echo RES;?>/images/cate107.png" onclick="javascript:alert('已选择模板7')" />
                                <input class="radio" type="radio" name="optype" value="7" <?php if(($info["tpltypeid"]) == "7"): ?>checked<?php endif; ?> /> 模板7 
                            </label>
                        </li>
                        <li <?php if(($info["tpltypeid"]) == "6"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                            <label>
                                <img src="<?php echo RES;?>/images/cate106.png" onclick="javascript:alert('已选择模板6')" />
                                <input class="radio" type="radio" name="optype" value="6" <?php if(($info["tpltypeid"]) == "6"): ?>checked<?php endif; ?> /> 模板6 
                            </label>
                        </li>
                        <li <?php if(($info["tpltypeid"]) == "5"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                        	<label>
                                <img src="<?php echo RES;?>/images/cate9.png" onclick="javascript:alert('已选择模板5')" />
                                <input class="radio" type="radio" name="optype" value="5" <?php if(($info["tpltypeid"]) == "5"): ?>checked<?php endif; ?> /> 模板5 
                            </label>
                        </li>
                        <li <?php if(($info["tpltypeid"]) == "4"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                            <label>
                                <img src="<?php echo RES;?>/images/cate4.png" onclick="javascript:alert('已选择模板4')" />
                                <input class="radio" type="radio" name="optype" value="4" <?php if(($info["tpltypeid"]) == "4"): ?>checked<?php endif; ?> /> 模板4 
                            </label>
                        </li>
                        <li <?php if(($info["tpltypeid"]) == "3"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                            <label>
                                <img src="<?php echo RES;?>/images/cate3.png" onclick="javascript:alert('已选择模板3')" />
                                <input class="radio" type="radio" name="optype" value="3" <?php if(($info["tpltypeid"]) == "3"): ?>checked<?php endif; ?> /> 模板3 
                            </label>
                        </li>
                        <li <?php if(($info["tpltypeid"]) == "2"): ?>class="active"<?php endif; ?> style="margin:10px 30px;" >
                            <label>
                                <img src="<?php echo RES;?>/images/cate2.png" onclick="javascript:alert('已选择模板2')" />
                                <input class="radio" type="radio" name="optype" value="2" <?php if(($info["tpltypeid"]) == "2"): ?>checked<?php endif; ?> /> 模板2 
                            </label>
                        </li>
                        <li <?php if(($info["tpltypeid"]) == "1"): ?>class="active"<?php endif; ?> style="margin:10px 30px 30px 30px;" >
                            <label>
                                <img src="<?php echo RES;?>/images/cate1.png" onclick="javascript:alert('已选择模板1')" />
                                <input class="radio" type="radio" name="optype" value="1" <?php if(($info["tpltypeid"]) == "1"): ?>checked<?php endif; ?> /> 模板1 
                            </label>
                        </li>
                    </ul>
                </fieldset>
            </div>
            <div class="tagContent" id="tagContent1">
                <fieldset>
                    <ul class="cateradio2">
                        <li style="display:none" <?php if(($info["tpllistid"]) == "103"): ?>class="active"<?php endif; ?> style="margin:10px 30px 30px 30px;"  >
                            <label><img src="<?php echo RES;?>/images/list103.png" onclick="javascript:alert('已选择模板3')" />
                                <input class="radio2" type="radio" name="optype2" value="103" <?php if(($info["tpllistid"]) == "103"): ?>checked<?php endif; ?> /> 模板3
                            </label>
                        </li>
                        <li <?php if(($info["tpllistid"]) == "4"): ?>class="active"<?php endif; ?>  style="margin:10px 30px 30px 30px;"  >
                            <label><img src="<?php echo RES;?>/images/list4.png" onclick="javascript:alert('已选择模板2')" />
                                <input class="radio2" type="radio" name="optype2" <?php if(($_SESSION['gid']) == "2"): ?>disabled="disabled"<?php endif; ?> value="4" <?php if(($info["tpllistid"]) == "4"): ?>checked<?php endif; ?> /> 模板2(省流量)
                            </label>
                        </li>
                        <li <?php if(($info["tpllistid"]) == "1"): ?>class="active"<?php endif; ?> style="margin:10px 30px 30px 30px;"  >
                            <label><img src="<?php echo RES;?>/images/list1.png" onclick="javascript:alert('已选择模板1')" />
                                <input class="radio2" type="radio" name="optype2" value="1" <?php if(($info["tpllistid"]) == "1"): ?>checked<?php endif; ?> /> 模板1(美观)
                            </label>
                        </li>
                    
                    </ul>
                </fieldset>
            </div>
            <div class="tagContent" id="tagContent2">
                <fieldset>
                    <ul class="cateradio3">
                        <li <?php if(($info["tplcontentid"]) == "1"): ?>class="active"<?php endif; ?> style="margin:10px 30px 30px 30px;"   ><label><img src="<?php echo RES;?>/images/news1.png" onclick="javascript:alert('已选择模板1')" /><input class="radio3" type="radio" name="optype3" value="1" <?php if(($info["tplcontentid"]) == "1"): ?>checked<?php endif; ?>/>模板1(有头像) </label></li>
                         <li <?php if(($info["tplcontentid"]) == "3"): ?>class="active"<?php endif; ?> style="margin:10px 30px 30px 30px;"   ><label><img src="<?php echo RES;?>/images/news3.png" onclick="javascript:alert('已选择模板2')"/ ><input class="radio3" type="radio" name="optype3" value="3" <?php if(($info["tplcontentid"]) == "3"): ?>checked<?php endif; ?>/>模板3(无头像)</label></li>
                    </ul>
                </fieldset>
            </div>
            <div class="tagContent" id="tagContent3">
                <fieldset>
                    <div class="cateradio4">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                                <tr>
                                    <td width="400" rowspan="2" valign="top">
                                        <div class="samsung-render">
                                            <iframe src="/index.php?g=Wap&m=Index&token=<?php echo ($info["token"]); ?>&show=1" id="myiframe" width="320" height="406" frameborder="0" style="overflow-x:hidden;"></iframe>
                                        </div>
                                    </td>
                                    <td valign="top"><h3>请选择你喜欢的颜色风格，实时预览 (<span style="color:#c30">注意：只有在手机上才能获得最佳浏览效果，电脑浏览并不一定是最终显示效果，并且仅部分模板支持更换颜色风格</span>)</h3>
                                        <ul>
                                            <li><label><input class="radio4" type="radio" name="optype4" value="0" <?php if(($info["color_id"]) == "0"): ?>checked="checked"<?php endif; ?>> 默认风格</label></li>
                                            <li><label><input class="radio4" type="radio" name="optype4" value="1" <?php if(($info["color_id"]) == "1"): ?>checked="checked"<?php endif; ?>> 黑色风格</label></li>
                                            <li><label><input class="radio4" type="radio" name="optype4" value="2" <?php if(($info["color_id"]) == "2"): ?>checked="checked"<?php endif; ?>> 蓝色风格</label></li>
                                            <li><label><input class="radio4" type="radio" name="optype4" value="3" <?php if(($info["color_id"]) == "3"): ?>checked="checked"<?php endif; ?>> 木纹风格</label></li>
                                            <li><label><input class="radio4" type="radio" name="optype4" value="4" <?php if(($info["color_id"]) == "4"): ?>checked="checked"<?php endif; ?>> 橙色风格</label></li>
                                            <li><label><input class="radio4" type="radio" name="optype4" value="5" <?php if(($info["color_id"]) == "5"): ?>checked="checked"<?php endif; ?>> 紫色风格</label></li>
                                            <li><label><input class="radio4" type="radio" name="optype4" value="6" <?php if(($info["color_id"]) == "6"): ?>checked="checked"<?php endif; ?>> 绿色风格</label></li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="clr"></div>
                    </div>
                </fieldset>
            </div>
        </div>

        <script type="text/javascript">
            function selectTag(showContent,selfObj){
                // 操作标签
                var tag = document.getElementById("tags").getElementsByTagName("li");
                var taglength = tag.length;
                for(i=0; i<taglength; i++){
                    tag[i].className = "";
                }
                selfObj.parentNode.className = "selectTag";
                // 操作内容
                for(i=0; j=document.getElementById("tagContent"+i); i++){
                    j.style.display = "none";
                }
                document.getElementById(showContent).style.display = "block";


            }
        </script>


        <script>

            $(".radio").click(function(){
                $(".cateradio li").each(function(){
                    $(this).removeClass("active");
                });
                $(this).parents("li").addClass("active");
                var myurl='index.php?g=User&m=Tmpls&a=add&style='+$(this).val()+'&r='+Math.random(); 
                $.ajax({url:myurl,async:false});

//                $("#homeurl").attr("href","http://baidu.com/index.php?ac=cate"+$(this).val()+"&tid=9379&w=1");
                $("#myiframe").attr("src",$("#myiframe").attr("src")+'&r='+Math.random());


            });
            $(".radio2").click(function(){
                $(".cateradio2 li").each(function(){
                    $(this).removeClass("active");
                });
                $(this).parents("li").addClass("active");
  
                var myurl ='index.php?g=User&m=Tmpls&a=lists&style='+$(this).val()+'&r='+Math.random(); 
                $.ajax({url:myurl,async:false});


            });
            $(".radio3").click(function(){
                $(".cateradio3 li").each(function(){
                    $(this).removeClass("active");
                });
                $(this).parents("li").addClass("active");
  
                var myurl='index.php?g=User&m=Tmpls&a=content&style='+$(this).val()+'&r='+Math.random(); 
                $.ajax({url:myurl,async:false});

            });
            $(".radio4").click(function(){
                var myurl='index.php?g=User&m=Tmpls&a=background&style='+$(this).val()+'&r='+Math.random(); 
                $.ajax({url:myurl,async:false});
                $("#myiframe").attr("src",$("#myiframe").attr("src")+'&r='+Math.random());
            });
            function changeapp(obj,gid){
                if(obj.checked==true){
                    //var image=new Image();   
                    var myurl='index.php?ac=app&op=open&value=1&id=9379&wxid=gh_858dwjkeww5&openid='+gid+'&r='+Math.random(); 
                    $.ajax({url:myurl,async:false});

                }else{
 
                    var myurl='index.php?ac=app&op=open&value=0&id=9379&wxid=gh_858dwjkeww5&openid='+gid+'&r='+Math.random(); 
                    $.ajax({url:myurl,async:false});

                }
            }

        </script>


    </div>

</div>

</div>
</div>
</div> 
<!--底部-->
</div>

	<div style="clear:both;"></div>
</div>



</body>
</html>