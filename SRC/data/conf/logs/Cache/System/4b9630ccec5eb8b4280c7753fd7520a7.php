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
<div id="artlist">

	 <div class="ksearch">
    	<div class="fl">
			<form action="<?php echo U('Users/search');?>" method="post">
			<b class="kserico">快速搜索：</b>搜索类型：
			<select name="type">
				<option value="1">用户名</option>
				<option value="2">用户ID</option>
				<option value="3">用户邮箱</option>
			</select> 
			<input name="name" class="ipt" type="text" value=""> 
			<input type="submit" class="ksub" value="">
			</form>
        </div>
        <div class="fl">
			<b>排序方式：</b>
			<select>
				<option value="">注册时间（降序）</option>
				<option value="">登陆时间（降序）</option>
			</select>
		</div>
        <div class="fl">
			<b>查看方式：</b>
			<select>
				<option value="">按分类查看</option>
			</select>
		</div>
    </div>
 	
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="alist">
	  <tr>
		<td width="70">ID</td>
		<td width="150">用户名称</td>
		<td width="150">角色组</td>
		<td width="100">最后登录IP</td>
		<td width="150">最后登录时间</td>
		<td width="70">状态</td>
		<td width="100">管理操作</td>
	  </tr>
	    <?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<td align='center'><?php echo ($vo["id"]); ?></td>
				<td ><?php echo ($vo["username"]); ?></td>
				<td ><?php echo ($group[$vo['gid']]); ?></td>
				<td align='center'><?php echo ($vo["lastip"]); ?></td>
				<td align='center'><?php echo date('Y-m-d H:i:s', $vo['lasttime']) ?></td>
				<td align='center'><?php if(($vo["status"]) == "1"): ?><font color="red">√</font><?php else: ?><font color="blue">×</font><?php endif; ?> 
				</td>
				<td align='center'>
					<a href="<?php echo U('Users/edit/',array('id'=>$vo['id']));?>">修改</a>
					| <?php if(($vo["username"]) == "admin"): ?><font color="#cccccc">删除</font><?php else: ?><a href="javascript:void(0)" onclick="return confirmurl('<?php echo U('Users/del/',array('id'=>$vo['id']));?>','确定删除该用户吗?')">删除</a><?php endif; ?>
				</td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
     <tr bgcolor="#FFFFFF"> 
      <td colspan="8"><div class="listpage"><?php echo ($page); ?></div></td>
    </tr>
   
</table>

</body>
</html>