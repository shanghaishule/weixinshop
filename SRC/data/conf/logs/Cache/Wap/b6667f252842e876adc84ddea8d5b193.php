<?php if (!defined('THINK_PATHSLAPP')) exit();?><!DOCTYPE HTML>
<html lang="zh-CN">
<head>
	<meta charset="utf-8" />
	<title><?php echo ($metaTitle); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" />
	<meta name="format-detection" content="telephone=no" />
	<link type="text/css" rel="stylesheet" href="<?php echo $staticFilePath;?>/css/style.css" />
	<script src="<?php echo $staticFilePath;?>/js/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo $staticFilePath;?>/js/main.js"></script>
</head>

<body>
	<!--头部-->
	<header class="ts1">
		<a class="u_back fl" href="javascript:history.go(-1)"></a>
		<ul class="topbar fr">
			<li>
				<a class="icon_user" href="<?php echo U('Product/my',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'dining'=>$isDining));?>"> <i></i>
					我的
				</a>
			</li>
			<li>
				<a class="icon_shopping" href="<?php echo U('Product/cart',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'dining'=>$isDining));?>"> <i></i>
					已点菜
				</a>
			</li>
			<li>
				<a class="icon_class" href="<?php echo U('Product/cats',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'dining'=>$isDining));?>">
					<i></i>
					分类
				</a>
			</li>
			<li>
				<a class="icon_index" href="<?php echo U('Product/index',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'dining'=>$isDining));?>">
					<i></i>
					主页
				</a>
			</li>
		</ul>
	</header><!--主体-->
	<div class="p_floatbox">
    <div class="f_list_car p_buy clearfix" id="p_buy">
    	<span class="all_price">总价格：<font id="all_price">￥<?php echo ($totalProductFee); ?></font></span>
    	<span>总共<font id="all_numb"><?php echo ($totalProductCount); ?></font份菜品</span>
    	<a href="<?php echo U('Product/cart',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'dining'=>$isDining));?>" class="p_btn_buy"><span class="ts1">已点菜品</span></a>
    </div>
</div>
<!--主体-->
<div class="main">
	<div class="f_index clearfix">
		<a class="f_index_button ts1" href="<?php echo U('Product/cats',array('token'=>$_GET['token'],'wecha_id'=>$wecha_id,'dining'=>1));?>">我要点餐</a>
		<ul class="clearfix">
			<?php if($diningConfig["diningyuding"] == 1): ?><li class="fl"><a href="<?php echo U('Product/orderCart',array('token'=>$_GET['token'],'wecha_id'=>$wecha_id,'cartIsDining'=>1));?>" class="c_button_cz" title="预订餐桌">预订餐桌</a></li><?php endif; ?>
			<?php if($diningConfig["diningwaimai"] == 1): ?><li class="fr"><a href="<?php echo U('Product/cats',array('token'=>$_GET['token'],'wecha_id'=>$wecha_id,'dining'=>1));?>" class="c_button_wm" title="预订外卖">预订外卖</a></li><?php endif; ?>

		</ul>
	</div>
</div>
</body>
</html>