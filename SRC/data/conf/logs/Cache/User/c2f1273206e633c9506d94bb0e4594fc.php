<?php if (!defined('THINK_PATHSLAPP')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script>var SITEURL='';</script>
<title> <?php echo C('site_title');?> <?php echo C('site_name');?></title>
<link href="<?php echo RES;?>/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo RES;?>/css/stylet.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo RES;?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/main.js"></script>

<script type="text/javascript">
function ying(){
	 document.getElementById('tiduser').style.display="none";
	 document.getElementById('quit').style.display="block";
}
function xian(){
	 document.getElementById('tiduser').style.display="block";
	 document.getElementById('quit').style.display="none";
}
setTimeout("xian()",5000);
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
    <?php if(!empty($_GET['id'])){ ?>
		<img src="<?php echo ($wecha["headerpic"]); ?>" width="50" height="50" />
    <?php }else{ ?>
    	<img src="<?php echo RES;?>/images/portrait.jpg" width="50" height="50" />
    <?php } ?>
		<ul class="ul">
        <?php if(!empty($_GET['id'])){ ?>
			<li><strong><?php echo ($wecha["wxname"]); ?></strong><img src="<?php echo RES;?>/images/vip.png" /></li>
			<li>微信号：<?php echo ($wecha["weixin"]); ?></li>
        <?php }else{ ?>
        	<li><strong>用户：</strong><strong style="color:#CC3300;" ><?php echo (session('uname')); ?></strong></li>
			<li><strong>等级：</strong><strong style="color:#CC3300;" >VIP<?php if($_SESSION['gid']>1){echo $_SESSION['gid']-1;}else{echo 0;} ?></strong></li>
        <?php } ?>
		</ul>
		<ul class="ul2" >
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
             <img src="<?php echo RES;?>/images/TwoMenu-ico-006.png" />
            <a>管理平台</a>
            <span>
            	<?php if(MODULE_NAME == 'useredit'): ?>- 修改密码<?php endif; ?>
                <?php if(MODULE_NAME == 'index'): ?>- 我的公众号<?php endif; ?>
                <?php if(MODULE_NAME == 'add'): ?>- 添加公众号<?php endif; ?>
            </span>
		</div>
		<div class="TwoMenu">
			<a href="#" >
            	<img src="<?php echo RES;?>/images/TwoMenu-ico-06.png" />
            	<span>管理</span>
            </a>
			<div id="TwoMenu-01" style="display:block;" >
            	<img src="<?php echo RES;?>/images/TwoMenu-ico-006.png" /><a class="a">管理</a>
            </div>
			<?php for($i=1;$i<6;$i++){?>
            	<a ></a>
            <?php } ?>
		</div>
		<div class="ThreeMenu">
        	<div class="contab" style="display:block;" >
                <a href="<?php echo U('Index/useredit');?>" class="Red" >
                	<img src="<?php echo RES;?>/images/1-0.png" /><span>修改密码</span>
                </a>
                <a href="<?php echo U('Index/index');?>" class="Highland" >
                    <img src="<?php echo RES;?>/images/1-1.png" /><span>我的公号</span>
                </a>
                <a href="<?php echo U('Index/add');?>" class="Navy" >
                    <img src="<?php echo RES;?>/images/1-2.png" /><span>添加公号</span>
                </a>
                <a href="<?php echo U('Alipay/index');?>" class="DarkGreen" >
                    <img src="<?php echo RES;?>/images/1-3.png" /><span>会员充值</span>
                </a>
            </div>
		</div>
	</div>
	<div id="Content" >
	</div>
<div class="content" style="width:920px; background:none; margin-left:275px; border:none; margin-bottom:30px;" >
          <div class="cLineB"><h4>修改密码<span class="FAQ"></span></h4></div>
          <form method="post" action="<?php echo U('Index/usersave');?>" enctype="multipart/form-data">
          <div class="msgWrap">
            <table class="userinfoArea" border="0" cellspacing="0" cellpadding="0" width="100%">
             
              <tbody>
				<tr>
                	<th><span class="red">*</span><label for="QQ">修改密码</label></th>
                	<td><input type="password" class="px"  value="" name="password">　为确保消息畅通，请确认QQ号码填写无误。</td>
                </tr>
                 <tr>
                 	<th></th>
                 	<td><button type="submit" name="button" class="btnGreen">提交</button></td>
                 	</tr>
              </tbody>
            </table>
            
          </div>
          </form>
          
        </div>
        <div class="clr"></div>
      </div>
    </div>
  </div>
  <!--底部-->
  	</div>