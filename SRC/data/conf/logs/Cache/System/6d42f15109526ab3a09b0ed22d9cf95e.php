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
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="alist">
	  <tr>
		<td >ID</td>
		<td>模块名</td>
		<td >等级条件</td>
		<td >功能描述</td>
		<td >使用次数</td>
		
		<td>状态</td>
		<td>管理操作</td>
	  </tr>
	    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td align='center'><?php echo ($vo["id"]); ?></td>
				<td ><?php echo ($vo["name"]); ?></td>
				<td ><?php echo ($vo["gid"]); ?></td>
				<td ><?php echo ($vo["info"]); ?></td>
				<td align='center'><?php echo ($vo["usenum"]); ?></td>
				<td align='center'><?php if(($vo["status"]) == "1"): ?><font color="red">√</font><?php else: ?><font color="blue">×</font><?php endif; ?> 
				</td>
				<td align='center'>
					<a href="<?php echo U('Function/edit/',array('id'=>$vo['id']));?>">修改</a>
					| <?php if(($vo["username"]) == "admin"): ?><font color="#cccccc">删除</font><?php else: ?><a href="javascript:void(0)" onclick="return confirmurl('<?php echo U('Function/del/',array('id'=>$vo['id']));?>','确定删除该用户吗?')">删除</a><?php endif; ?>
				</td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		<style>
			.current{border: 0;padding: 1px 9px;color: #fff;background: #3F8EF3 url(main/pageh.png) no-repeat;}
		</style>
     <tr bgcolor="#FFFFFF"> 
	 
      <td colspan="7"><div class="listpage"><?php echo ($page); ?></div></td>
     
    </tr>
   
</table>

<div class="bottom">
<span>功能详细说明：</span>
</div>

</body>
</html>