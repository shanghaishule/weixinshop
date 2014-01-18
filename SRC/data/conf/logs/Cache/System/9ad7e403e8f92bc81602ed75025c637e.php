<?php if (!defined('THINK_PATHSLAPP')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>站点配置</title>
<link href="<?php echo RES;?>/images/main.css" type="text/css" rel="stylesheet">
<link href="<?php echo RES;?>/images/jquery-1.7.2.min.js" type="text/css" rel="stylesheet">
<link href="<?php echo RES;?>/images/jquery.form.js" type="text/css" rel="stylesheet">
<meta http-equiv="x-ua-compatible" content="ie=7" />
</head>
<body class="warp">
<style>
.set_top{background:url('<?php echo RES;?>/images/set_top.png');height:60px;}
.set_top li{font-weight: bold;float:left;width:98px;line-height:60px;text-align: center;background:url('<?php echo RES;?>/images/set_top_li.png');}
#set_top_li_bg{background:url('<?php echo RES;?>/images/set_top_li_hover.png');}
</style>
<div class="set_top">
	<?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li <?php if(ACTION_NAME == $vo['name']): ?>id="set_top_li_bg"<?php endif; ?>><a href="<?php echo U($action.'/'.$vo['name'],array('pid'=>6,'level'=>3));?>"><?php echo ($vo['title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<div id="artlist">
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="addn">
 <form id="myform" action="<?php echo U('Site/insert');?>" method="post">

    <tr> 
      <td  height="48" align="right"><strong>支付宝帐号</strong></td>
      <td><input type="text" name="alipay_name" value="<?php echo C('alipay_name');?>" class="ipt" size="45" /><span>&nbsp;&nbsp;例：phpw_CN@163.COM</span>
	  </td>
    </tr>
	 <tr> 
      <td  height="48" align="right"><strong>支付宝PID：</strong></td>
      <td><input type="text" name="alipay_pid" value="<?php echo C('alipay_pid');?>" class="ipt" size="45" /><span>&nbsp;&nbsp;请登陆支付宝商家服务中去查看</span>
	  
    </tr>
	 <tr> 
      <td  height="48" align="right"><strong>支付宝KEY：</strong></td>
      <td><input type="text" name="alipay_key" value="<?php echo C('alipay_key');?>" class="ipt" size="45" /><span>&nbsp;&nbsp;请登陆支付宝商家服务中去查看</span>
    </tr> 

   <input type="hidden" name="files" value="alipay.php" />
    <tr> 
      <td height="48" colspan="2">
		  <div id="addkey"></div>
		  <div style="padding-left:100px;">
			<input type="submit" value="保存设置" />
		  </div>
	  </td>
    </tr>
	</form>
</table><br />
<br />
<br />

</div>
</body>
</html>