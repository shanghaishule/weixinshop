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
		<ul >
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
            <span>- 会员充值</span>
		</div>
		<div class="TwoMenu">
			<a href="<?php echo U('Function/index',array('token'=>$token,'id'=>session('wxid')));?>" >
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
<script src="./tpl/static/jquery-1.4.2.min.js" type="text/javascript"></script>

<div class="content" style="width:920px; background:none; margin-left:275px; border:none; margin-bottom:30px; margin-top:20px;" >
<style>
.usercontent ul li{
float:none;
line-height:50px;
padding-left:10px;
}
input{border: 1px solid #DDDDDD;height:30px;width:200px;margin-left:10px;}
.new-btn-login{
    background-color: transparent;
    background-image: url('<?php echo RES;?>/images/img/new-btn-fixed.png');
    border: medium none;
	border:1px solid red;
	
}
.new-btn-login{
    background-position: 0 -198px;
    width: 82px;
	color: #FFFFFF;
    font-weight: bold;
    height: 28px;
    line-height: 28px;
    padding: 1px 10px 0px 8px;
	
}
.new-btn-login:hover{
	background-position: 0 -167px;
}
.bottonbox{
border: 1px solid #D74C00;
padding: 1px;
display: inline-block;
}
</style>
<script>

$(function(){
var price=new Array();
		<?php if(is_array($group)): $i = 0; $__LIST__ = $group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?>price[<?php echo ($p["id"]); ?>]=<?php echo ($p["price"]); ?>;<?php endforeach; endif; else: echo "" ;endif; ?>
	$('#group').change(function(){		
		
$('#price').val(price[$('#group').val()]*$('#num').val());
	});
	$('#num').change(function(){		
		
$('#price').val(price[$('#group').val()]*$('#num').val());
	});
});
</script>
<div class="usercontent">
<ul>
<form action="<?php echo U('Alipay/post');?>" method="post">
	<li> 
		<b>充值　选项: </b>
		<select name="gid" style="margin-left:10px;" id="group">
			<?php if(is_array($group)): $i = 0; $__LIST__ = $group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?><option value="<?php echo ($group["id"]); ?>" <?php if($_SESSION['gid'] == $group['id']): ?>selected="selected"<?php endif; ?>><?php echo ($group["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		</select>
		<select name="num" style="margin-left:10px;" id="num">
			<option value="1">1个月</option>
			<option value="2">2个月</option>
			<option value="3">3个月</option>
			<option value="4">4个月</option>
			<option value="5">5个月</option>
			<option value="6">6个月</option>
			<option value="7">7个月</option>
			<option value="8">8个月</option>
			<option value="9">9个月</option>
			<option value="10">10个月</option>
			<option value="11">11个月</option>
			<option value="12">12个月</option>		
		</select>
    </li>
	<li> <b>充值用户名: </b><input type="text" name="uname" value="<?php echo (session('uname')); ?>" size="60" style="padding-left:5px;" > <b>充值帐号,默认即可请勿修改</b></li>
	<li> <b>充值　金额: </b><input type="text" name="price" value="<?php echo ($user["price"]); ?>" id="price" size="60" readonly="readonly" style="padding-left:5px;"  > <b>先择对应的充值选项,价格自动生成</b></li>

	<li><span class="bottonbox"><button class="new-btn-login" type="submit" style="text-align:center;">确 认</button></span></li>
</ul>
        <div class="clr"></div>
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
  <!--底部-->
  	</div>




	<div style="clear:both;"></div>
</div>



</body>
</html>