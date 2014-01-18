<?php if (!defined('THINK_PATHSLAPP')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($tpl['wxname']); ?></title>
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<link rel="stylesheet" href="<?php echo RES;?>/css/flash/css/plugmenu.css">
<style type="text/css">
@charset "utf-8";
*{
	margin:0;
	padding:0;}
.wz_wrapper a{
	display:block;
	color: #FFF;
	text-decoration: none;
	}

.wz_flat_left{
	float:left;}
.wz_flat_right{
	float:right;}
.clfl{
	float:none;
	clear:both;}
.wz_color_01{
	background-color:#228981;}
.wz_color_02{
	background-color:#8019bf;}
.wz_color_03{
	background-color:#22601a;}
.wz_color_04{
	background-color:#1f4b89;}
.wz_color_05{
	background-color:#af1d42;}
.wz_color_06{
	background-color:#ce6619;}

.wz_wrapper {
	width: 320px;
	margin-right: auto;
	margin-left: auto;
}
.wz_line{
	color:#FFF;
	font-size:16px;
	font-family:"微软雅黑";
	background-color:#999;
	height:103px;
	width:100%;
	margin-bottom:10px;}
.wz_text{
	overflow:hidden;
	text-align:center;
	line-height:103px;
	width:103px;
	height:103px;
	}
.wz_img{
	overflow:hidden;
	height:103px;
	width:217px;}
	
.wz_img img{
	width:100%;
	min-height:103px;
}

</style>
</head>
<body>
<div class="wz_wrapper">
<?php $color=1; $f=1; ?>
	<?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="wz_line">
		<a href="<?php if($vo['url'] == ''): echo U('Wap/Index/lists',array('classid'=>$vo['id'],'token'=>$vo['token'])); else: echo ($vo["url"]); endif; ?>">
<?php if($f==1){ $flat='left'; }else{ $flat='right'; } echo '		<div class="wz_text wz_color_0'.$color.' wz_flat_'.$flat.'">'; $color++; $f++; if($color==7){ $color=1; } if($f==3){ $f=1; } ?>
<?php echo ($vo["name"]); ?></div>
		<div class="wz_img "><img src="<?php echo ($vo["img"]); ?>"/></div></a>
		<div class="clfl"></div>
		</div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<?php if($showPlugMenu): ?><div class="plug-div">
				<div class="plug-phone">
					<div class="plug-menu themeStyle" style="background:<?php echo ($homeInfo["plugmenucolor"]); ?>">
						<span class="close">
						</span>
					</div>
					<?php if(is_array($plugmenus)): $i = 0; $__LIST__ = $plugmenus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="themeStyle plug-btn plug-btn<?php echo ($i); ?> close" style="background:<?php echo ($homeInfo["plugmenucolor"]); ?>">
							<a href="<?php echo ($vo["url"]); ?>">
								<span style="background-image: url(<?php echo RES;?>/css/flash/images/img/<?php echo ($vo["name"]); ?>.png);">
								</span>
							</a>
						</div><?php endforeach; endif; else: echo "" ;endif; ?>
					<div class="plug-btn plug-btn5 close">
					</div>
				</div>
			</div><?php endif; ?>
	<script src="<?php echo RES;?>/css/flash/js/zepto.min.js" type="text/javascript"></script>
	<script src="<?php echo RES;?>/css/flash/js/plugmenu.js" type="text/javascript"></script>
	<div class="copyright">
		<?php if($iscopyright == 1): echo ($homeInfo["copyright"]); ?>
		<?php else: ?>
			<?php echo ($siteCopyright); endif; ?>
	</div>
</body>
</html>