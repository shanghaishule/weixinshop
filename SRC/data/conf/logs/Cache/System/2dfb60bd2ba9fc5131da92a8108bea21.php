<?php if (!defined('THINK_PATHSLAPP')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>权限管理</title>
<link href="<?php echo RES;?>/images/main.css" type="text/css" rel="stylesheet">
<script src="<?php echo STATICS;?>/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo STATICS;?>/function.js" type="text/javascript"></script>
<meta http-equiv="x-ua-compatible" content="ie=7" />
</head>
<body class="warp">
<div id="artlist">
	<div class="mod kjnav">
		<?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U($action.'/'.$vo['name'],array('pid'=>$_GET['pid'],'level'=>3,'title'=>urlencode ($vo['title'])));?>"><?php echo ($vo['title']); ?></a>
		<?php if(($action == 'Article') or ($action == 'Img') or ($action == 'Text') or ($action == 'Voiceresponse')): break; endif; endforeach; endif; else: echo "" ;endif; ?>
	</div>   	
</div>
<div class="cr"></div>
<form action="<?php echo U('Node/sort');?>" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="alist">
  <tr>
    <th width="5%">排序权重</th>
    <th width="5%" class="xtit">ID</th>
    <th width="40%">菜单名称</th>
    <th width="6%">类型</th>
    <th width="6%">状态</th>
    <th width="6%">显示</th>
    <th width="24%">操作</th>
  </tr>
	<?php echo ($html_tree); ?>
   
</table>

<div class="bottom">
<span><input type="submit" value="排序" class="bginput"></span>
</div>
</form>
</body>
</html>