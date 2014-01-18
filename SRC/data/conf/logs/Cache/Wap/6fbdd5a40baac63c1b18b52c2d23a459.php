<?php if (!defined('THINK_PATHSLAPP')) exit();?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>3G相册列表</title>
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta charset="utf-8">
<link href="<?php echo RES;?>/css/Photo/css/photo.css" rel="stylesheet" type="text/css" />
</head>
<body id="photo">
<div class="qiandaobanner"><a> <img src="<?php echo RES;?>/css/Photo/banner.jpg" ></a></div>
<div id="todayList">
<ul  class="chatPanel">  
<?php if(is_array($photo)): $i = 0; $__LIST__ = $photo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$photo): $mod = ($i % 2 );++$i;?><li class="media mediaFullText">
<a href="<?php echo U('Photo/plist',array('token'=>$_GET['token'],'id'=>$photo['id']));?>">
	<div class="mediaPanel">
		<div class="mediaHead"> 
			<div class="clr"></div>
		</div>
		<div class="mediaImg"><img src="<?php echo ($photo["picurl"]); ?>"></div>                                                        
		<div class="mediaFooter">
			<span class="mesgIcon right"></span><span class="bt"><?php echo ($photo["title"]); ?></span>
			<div class="clr"></div>
		</div>
	</div>
</a>
</li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>

 
   
</div>
<!--??????-->

<script>
function dourl(url){
location.href= url;
}
</script>

</body>
</html>