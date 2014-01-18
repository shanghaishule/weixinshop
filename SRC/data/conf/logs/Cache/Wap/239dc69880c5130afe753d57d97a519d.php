<?php if (!defined('THINK_PATHSLAPP')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($res["title"]); ?>-<?php echo ($tpl["wxname"]); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes" />
<meta name="viewport" content="initial-scale=1, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta charset="utf-8">
<link href="<?php echo RES;?>/css/ktv/style.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div class="content">
	<span class="marginb">
		<h3><?php echo ($res["title"]); ?></h3>
		<span id="post-date"><?php echo (date("y-m-d",$res["createtime"])); ?></span>
	</span>
	
	<?php if(($res["showpic"]) == "1"): ?><div class="showpic"><img src="<?php echo ($res["pic"]); ?>" /></div><?php endif; ?>
	<?php echo htmlspecialchars_decode($res['info']) ?>
</div>
<div class="content">
<!-- UY BEGIN -->
<div id="uyan_frame"></div>
<script type="text/javascript" src="http://v2.uyan.cc/code/uyan.js?uid=1713244"></script>
<!-- UY END -->
</div>
	<?php if(($copyright) == "0"): ?><div class="copyright"  >
<?php echo htmlspecialchars_decode(C('copyright')) ?>
</div><?php endif; ?>
<div style="display:none"><?php echo htmlspecialchars_decode($tpl['tongji']) ?></div>
</body>
</html>