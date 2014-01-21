<?php if (!defined('THINK_PATHSLAPP')) exit();?> <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<title>微信-微信营销专家</title>
<meta name="keywords" content="LANRAIN 微信帮手 微信公众账号 微信公众平台 微信公众账号开发 微信二次开发 微信接口开发 微信托管服务 微信营销 微信公众平台接口开发"/>
<meta name="description" content="微信公众平台接口开发、托管、营销活动、二次开发"/>
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/style.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/index.css"/>
<!--[if lte IE 6]>
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/ie6.css"/>
<![endif]-->
<script type="text/javascript">window.onerror=function(){return true;}</script>
<script type="text/javascript" src="<?php echo RES;?>/js/lang.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/config.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/common.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/page.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jquery.lazyload.js"></script>
<script type="text/javascript">
GoMobile('');
var searchid = 5;
</script>
</head>
<body oncontextmenu="return false" onselectstart ="return false">
<div class="topbg">
<div class="top">
<div class="toplink">
<div class="welcome">欢迎使用微信营销平台!</div>
    <div class="memberinfo"  id="destoon_member">	
		<?php if($_SESSION[uid]==false): ?>你好&nbsp;&nbsp;<span class="f_red">游客</span>&nbsp;&nbsp;
			<a href="<?php echo U('Index/login');?>">登录</a>&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="<?php echo U('Index/login');?>">注册</a>
			<?php else: ?>
			你好,<a href="/#" hidefocus="true"  ><span style="color:red"><?php echo (session('uname')); ?></span></a>（uid:<?php echo (session('uid')); ?>）
			<a href="/#" onClick="Javascript:window.open('<?php echo U('System/Admin/logout');?>','_blank')" >退出</a><?php endif; ?>	
	</div>
</div>
    <div class="logo">
        <div style="float:left"></div>
            <h1><a href="/" title="多用户微信营销服务平台"><img src="<?php echo RES;?>/images/logo-lanrain.png" /></a></h1>
            <div class="navr">
        <ul id="topMenu">           
			 <li <?php if((ACTION_NAME == 'index') and (GROUP_NAME == 'Home')): ?>class="menuon"<?php endif; ?> ><a href="/" >首页</a></li>
           <li <?php if((ACTION_NAME) == "fc"): ?>class="menuon"<?php endif; ?>><a href="<?php echo U('Home/Index/fc');?>">功能介绍</a></li>
                <li <?php if((ACTION_NAME) == "about"): ?>class="menuon"<?php endif; ?>><a href="<?php echo U('Home/Index/about');?>">关于我们</a></li>
				
                <li <?php if((ACTION_NAME) == "price"): ?>class="menuon"<?php endif; ?>><a href="<?php echo U('Home/Index/price');?>">资费说明</a></li>
				
                <li <?php if((ACTION_NAME) == "common"): ?>class="menuon"<?php endif; ?>><a href="<?php echo U('Home/Index/common');?>">微信导航</a></li>
                <li <?php if((GROUP_NAME) == "User"): ?>class="menuon"<?php endif; ?>><a href="<?php echo U('User/Index/index');?>">管理中心</a></li>
                <li <?php if((ACTION_NAME) == "help"): ?>class="menuon"<?php endif; ?>><a href="<?php echo U('Home/Index/help');?>">帮助中心</a></li>
            
            </ul>
        </div>
        </div>
    </div>
</div>
    <div class="slib">
    <div class="sli">
        <div class="sliimg"></div>
            <div class="slic">
            <span style="font-size:1.2em; font-weight:normal">微信-微信公众号管理服务平台</span><br /><br />
                <span style="font-size:1.8em">让世界发现你的精彩</span><br /><br />
                <span style="font-size:1.2em; font-weight:normal">突破微信公众平台限制,无限自定义图文回复.<br />微信公众账号轻松接入,众多智能服务瞬间开启</span>
            </div>
        <div class="slit">
            <ul>
                <li><a href="<?php echo U('Index/login');?>"><img src="<?php echo RES;?>/images/zc.png" /></a></li>
                    <li><a href="<?php echo U('Index/reg');?>"><img src="<?php echo RES;?>/images/dl.png" /></a></li>
                </ul>
            </div>
        </div>
    </div>
    
<div class="index_virtue">    
<ul>
  <li class="first">
   <div class="virtue_point_img"><img src="<?php echo RES;?>/images/s-weiwangzhan-01.png" /></div>
   <h1 class="virtue_point_title"><a href="#">微3G网站</a></h1>
   <p class="virtue_point_intro">将企业微网站植入微信公众平台<br />关注公众平台即可访问网站</p>
  </li>
  <li>
   <div class="virtue_point_img"><img src="<?php echo RES;?>/images/s-quanfa-01.png" /></div>
   <h1 class="virtue_point_title"><a href="#">微信互动营销</a></h1>
   <p class="virtue_point_intro">大转盘、刮刮卡，会员卡  <br /> 客户互动很轻松 </p>
  </li>
  <li>
   <div class="virtue_point_img"><img src="<?php echo RES;?>/images/s-yijian-01.png" /></div>
   <h1 class="virtue_point_title"><a href="#">一站式管理</a></h1>
   <p class="virtue_point_intro">一站管理微信公众号<br />轻松方便，快捷！</p>
  </li>
 </ul>
</div>    
    
    <div class="bor">
    <ul>
        <li>
            <div class="leftI"><img src="<?php echo RES;?>/images/l1.png" /></div>
                <div class="leftT">
                <div class="t">微信账号集中一站管理</div>
                    <div class="b">支持微信账号的添加与管理，节约运营成本。</div>
                </div>
            </li>
            
            <li>
            <div class="leftI"><img src="<?php echo RES;?>/images/l2.png" /></div>
                <div class="leftT">
                <div class="t">无限自定义图文回复</div>
                    <div class="b">突破微信公众平台内容限制，快速响应预设回复</div>
                </div>
            </li>
            
            <li>
            <div class="leftI"><img src="<?php echo RES;?>/images/l3.png" /></div>
                <div class="leftT">
                <div class="t">众多便捷工具免费享用</div>
                    <div class="b">拥有多款查询小工具,提高微信公众账号活跃度。</div>
                </div>
            </li>
            
            <li>
            <div class="leftI"><img src="<?php echo RES;?>/images/l4.png" /></div>
                <div class="leftT">
                <div class="t">淘宝店铺商品快速导入</div>
                    <div class="b">倡导手机淘宝，引领微支付前沿，一键快速添加。</div>
                </div>
            </li>
            
            <li>
            <div class="leftI"><img src="<?php echo RES;?>/images/l5.png" /></div>
                <div class="leftT">
                <div class="t">强大的商家运营管理</div>
                    <div class="b">实现本地商家与微信用户直接的消费营销互动。</div>
                </div>
            </li>
            
            <li>
            <div class="leftI"><img src="<?php echo RES;?>/images/l6.png" /></div>
                <div class="leftT">
                <div class="t">网站完美兼容其他接口</div>
                    <div class="b">整合第三方应用接口，实现网站与平台数据互通。</div>
                </div>
            </li>
        </ul>
    </div>
    <div class="c" style="display:none">
    <div class="cT">最新功能<span></span></div>
    </div>
    <div class="center" style="display:none">
    <div class="centerc">
        <div class="centercc">
            <div class="centerccT">
                <div class="name">图文应用-<span class="tag">直观便捷</span></div>
                    <div class="contex">微信接口服务平台是国内首家以图文并茂形式开展趣味应用类的微信服务平台，微90奔着方便、快捷、直观的理念，趣味类应用一经问世便收到了众多微信主的一致好评，我们将不断拓展新思路，将为广大微信主提供更优质的应用</div>
                </div>
                <div class="img"><img src="<?php echo RES;?>/images/c1.png" /></div>
            </div>
        </div>
        <BR /><BR />
        <div class="centerc">
        <div class="centercc">
            <div class="centerccT">
                <div class="name">应用测试-<span class="tag">趣味十足</span></div>
                    <div class="contex">为了让您的粉丝互动性更强，粘性度更大，本站开创了独家测试应用功能，操作简单，趣味性高。让公众号摆脱了只是一个功能查询的软肋。游戏性测试功能我们会逐渐增加，让更多的使用者受益。</div>
                </div>
                <div class="img"><img src="<?php echo RES;?>/images/c2.png" /></div>
            </div>
        </div>
        
        <BR /><BR />
        <div class="centerc">
        <div class="centercc">
            <div class="centerccT">
                <div class="name">模板选择-<span class="tag">更多更全</span></div>
                    <div class="contex">我们将不断推出各种<span>首页模板</span>、<span>分类页模板</span>、<span>详情页模板</span>提供您使用，让您的WAP网站更加精彩！您只需到模板管理中心选择想要展示的模板，即可让您的用户看到您最新的内容。</div>
                </div>
                <div class="img"><img src="<?php echo RES;?>/images/c3.png" /></div>
            </div>
        </div>
        
    </div>
</div>
<div class="IndexFoot" style="height:120px;">
<div class="foot">
<div class="foot_page">
<a href="<?php echo C('site_url');?>">微信微信营销平台</a><br/>
帮助您快速搭建属于自己的营销平台，构建自己的客户群体。<br/>
大转盘、刮刮卡、会员卡、优惠卷、订餐、订房等营销模块，客户易用，易懂，易营销。
</div>

    </div>
</div>
<script src="/images/css/qqserver.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/images/css/qqserver.css"/>
<div style="display:none">
<script src="http://s15.cnzz.com/stat.php?id=5524076&web_id=5524076" language="JavaScript"></script>
</div>
</body>
</html>