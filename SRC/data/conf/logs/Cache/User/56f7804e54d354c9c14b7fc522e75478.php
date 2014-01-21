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
<div class="content"  style="width:920px; background:none; margin-left:275px; border:none; margin-bottom:30px;"  >
<div class="usercontent" style="margin-top:20px;">
<ul>
<!--<li><a href="" class="gold" title="查看金币历史记录" ><p><strong>账户金币总数：</strong>5</p><p>已消费金币数：0</p></a></li>-->
<li class="addli"><a class="addwx" title="添加微信公众号" onclick="location.href='<?php echo U('Index/add');?>';">添加微信公众号</a></li>
<li style="height:47px;line-height:47px;color:red;padding:10px;">请添加公众帐号,进入功能管理,再进行功能测试，</li>
</ul>
      </div>
          <div class="msgWrap" style="float:left;width:100%;">
            <TABLE class="ListProduct" border="0" cellSpacing="0" cellPadding="0" width="100%">
              <THEAD>
                <TR>
                  <TH>公众号名称</TH>
                  <TH>VIP等级</TH>
                  <TH>创建时间/到期时间</TH>
                   <TH>已定义/上限</TH>
                   <TH>请求数</TH>
                  <TH>操作</TH>
                </TR>
              </THEAD>
              <TBODY>
                <TR></TR>                
                 <?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><TR>
					  <TD><p><a href="<?php echo U('Function/index',array('id'=>$vo['id'],'token'=>$vo['token']));?>" title="点击进入功能管理"><img src="<?php echo ($vo["headerpic"]); ?>" width="40" height="40"></a></p><p><?php echo ($vo["wxname"]); ?></p></TD>
					  <TD align="center"><?php if($_SESSION['gid']>1){echo $_SESSION['gid']-1;}else{echo 0;} ?></TD>
					  <TD><p>创建时间:<?php echo (date("Y-m-d",$vo["createtime"])); ?></p><p>到期时间:<?php echo (date("Y-m-d",$viptime)); ?></p><p><a   href="<?php echo U('Alipay/index');?>" id="smemberss" class="green"><em>升降级vip续费</em></a></p></Td>
					  <TD><p>图文：<?php echo $_SESSION['diynum'].'/'.$group[$_SESSION['gid']]['did']; ?></p></TD>
					   <TD><p>总请求数:<?php echo $_SESSION['connectnum'] ?></p><p> 本月请求数:<?php echo $group[$_SESSION['gid']]['cid']; ?></p></TD>
					  
					  <TD class="norightborder">　<a href="<?php echo U('Index/edit',array('id'=>$vo['id']));?>">编辑</a>　<a  href="<?php echo U('Index/del',array('id'=>$vo['id']));?>;">删除</a>　
					  <a href="<?php echo U('Function/index',array('id'=>$vo['id'],'token'=>$vo['token']));?>" class="btnGreens" >功能管理</a>
					  <a href="<?php echo U('Home/Index/help',array('id'=>$vo['id'],'token'=>$vo['token']));?>" class="btnGreens" >API接口</a>
					  </TD>
					</TR><?php endforeach; endif; else: echo "" ;endif; ?>

              </TBODY>
            </TABLE>
            
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