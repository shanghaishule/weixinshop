<?php if (!defined('THINK_PATHSLAPP')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>导航</title>
<link href="<?php echo RES;?>/images/style.css" type="text/css" rel="stylesheet">
<meta http-equiv="x-ua-compatible" content="ie=7" />
<script lanuage="JScript">
function tourl(url){
	parent.main.location.href=url;
}
</script>
</head>
<body style="background:none">

<div class="mbox">
	<h3><?php echo ($title); ?></h3>
    <ul>
	<?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U($vo['name'].'/index',array('pid'=>$vo['id'],'level'=>3));?>" target="main" ><?php echo ($vo['title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
	</ul>
<p class="m_b"></p>
</div>
<!--/mbox-->

<!--/mbox-->

</body>
</html>