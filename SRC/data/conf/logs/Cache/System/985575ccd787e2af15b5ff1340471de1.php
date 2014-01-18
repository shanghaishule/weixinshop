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
		<td width="70">ID</td>
		<td width="150">用户名称</td>
		<td width="150">角色名称</td>
		<td >用户描述</td>
		<td width="100">最后登录IP</td>
		<td width="150">最后登录位置</td>
		<td width="150">最后登录时间</td>
		<td width="70">状态</td>
		<td width="100">管理操作</td>
	  </tr>
	    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td align='center'><?php echo ($vo["id"]); ?></td>
				<td ><?php echo ($vo["username"]); ?></td>
				<td ><?php echo ($role[$vo['role']]); ?></td>
				<td ><?php echo ($vo["remark"]); ?></td>
				<td align='center'><?php echo ($vo["last_login_ip"]); ?></td>
				<td align='center'><?php echo ($vo["last_location"]); ?></td>
				<td align='center'><?php echo date('Y-m-d H:i:s', $vo['last_login_time']) ?></td>
				<td align='center'><?php if(($vo["status"]) == "1"): ?><font color="red">√</font><?php else: ?><font color="blue">×</font><?php endif; ?> 
				</td>
				<td align='center'>
					<a href="<?php echo U('User/edit/',array('id'=>$vo['id']));?>">修改</a>
					| <?php if(($vo["username"]) == "admin"): ?><font color="#cccccc">删除</font><?php else: ?><a href="javascript:void(0)" onclick="return confirmurl('<?php echo U('User/del/',array('id'=>$vo['id']));?>','确定删除该用户吗?')">删除</a><?php endif; ?>
				</td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
     <tr bgcolor="#FFFFFF"> 
      <td colspan="8"><div class="listpage"><?php echo ($page); ?></div></td>
    </tr>
   
</table>

<div class="bottom">
<span><b>选择：</b><a href="#">全选</a> <a href="#">反选</a> <a href="#">不选</a></span>
<span><b>属性设定：</b><select><option value="">正常</option></select></span>
<span><b>取消属性：</b><select><option value="">推荐</option></select></span>
<span><b>批量转移：</b> 由 <select><option value="">栏目名称</option></select> 移动到 <select><option value="">栏目名称2</option></select></span>
</div>

</body>
</html>