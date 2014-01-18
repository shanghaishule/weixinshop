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
          <div class="cLineB"><h4>添加微信公众号</h4></div>
          <form method="post" action="<?php echo U('User/Index/upsave');?>" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo ($info["id"]); ?>">
          <div class="msgWrap">
            <table class="userinfoArea" border="0" cellspacing="0" cellpadding="0" width="100%">
              <thead>
                <tr>
                  <th><span class="red">*</span>公众号名称：</th>
                  <td><input type="text" required="" class="px" name="wxname" value="<?php echo ($info["wxname"]); ?>" tabindex="1" size="25">
                  </td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th><span class="red">*</span>公众号原始id：</th>
                  <td><input type="text" required="" name="wxid" value="<?php echo ($info["wxid"]); ?>" onmouseup="this.value=this.value.replace('_430','')" class="px" tabindex="1" size="25">　<span class="red">请认真填写，错了不能修改。</span>比如：gh_423dwjkeww3 <a href="http://jingyan.baidu.com/article/63f23628eb6b490209ab3d6b.html" target="_blank"><img src="<?php echo RES;?>/images/help.png" class="vm helpimg" title="帮助"></a></td>
                </tr>
                <tr>
                  <th><span class="red">*</span>微信号：</th>
                  <td><input type="text" required="" name="weixin" value="<?php echo ($info["weixin"]); ?>" class="px" tabindex="1" size="25">　比如：lentu123 </td>
                </tr>
                  <tr>
                  <th>头像地址（url）:</th>
                  <td><input class="px" name="headerpic" value="<?php echo ($info["headerpic"]); ?>" size="60">  请填写图片外链地址 <a href="forum.php?mod=viewthread&amp;tid=69&amp;extra=page%3D1" target="_blank"><img src="<?php echo RES;?>/images/help.png" class="vm helpimg" title="帮助"></a></td>
                </tr>
                 
                 <input type="hidden" name="token" value="<?php echo ($info["token"]); ?>" class="px" tabindex="1" size="40">
               
                
                <tr>
                  <th><span class="red">*</span>地区</th>
                  <td>
                  省：<input type="text" class="px" id="province" value="<?php echo ($info["province"]); ?>" name="province" tabindex="1" size="20">  市：<input id="city" value="<?php echo ($info["city"]); ?>" type="text" name="city" class="px" tabindex="1" size="20">
               （此处关联公交等本地化查询）
                  </td>
                </tr>
                <tr>
                  <th>公众号邮箱：</th>
                  <td><input type="text" required="" class="px" tabindex="1" value="<?php echo ($info["qq"]); ?>" name="qq" size="25"></td>
                </tr>
                 <tr>
                  <th>粉丝数：</th>
                  <td><input type="text" required="" name="wxfans" value="<?php echo ($info["wxfans"]); ?>" class="px" tabindex="1" size="25"></td>
                </tr>
             
                <tr>
                  <th>类型：</th>
                  <td><select id="type" name="type">
                  <option value="1,情感" <?php if(($info["typeid"]) == "1"): ?>selected<?php endif; ?> >情感</option>
                  <option value="2,数码" <?php if(($info["typeid"]) == "2"): ?>selected<?php endif; ?> >数码</option>
                  <option value="3,娱乐" <?php if(($info["typeid"]) == "3"): ?>selected<?php endif; ?> >娱乐</option>
                  <option value="4,IT" <?php if(($info["typeid"]) == "4"): ?>selected<?php endif; ?> >IT</option>
                  <option value="5,数码" <?php if(($info["typeid"]) == "5"): ?>selected<?php endif; ?> >数码</option>
                  <option value="6,购物" <?php if(($info["typeid"]) == "6"): ?>selected<?php endif; ?> >购物</option>
                  <option value="7,生活" <?php if(($info["typeid"]) == "7"): ?>selected<?php endif; ?> >生活</option>
                  <option value="8,服务" <?php if(($info["typeid"]) == "8"): ?>selected<?php endif; ?> >服务</option>
                  </select></td>
                </tr>
              
                <tr>
                  <th></th>
                  <td><button type="submit" class="btnGreen" id="saveSetting">保存</button></td>
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

	<div style="clear:both;"></div>
</div>



</body>
</html>