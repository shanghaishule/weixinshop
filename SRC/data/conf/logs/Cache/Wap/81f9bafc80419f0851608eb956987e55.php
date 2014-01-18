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
<?php if($_GET['success'] == 1): ?><a class="more" id="show_more" href="javascript:void(0);" style="color:#fff;background:#f90"></a>
<script type="text/javascript">
$(function() {
	$('#show_more').show().html('订购成功').delay(1600).slideUp(1600);
	return;
});
</script><?php endif; ?>
<div class="u_main">
	
        <ul class="u_order clearfix">
        <?php if($ordersCount != 0): if(is_array($orders)): $i = 0; $__LIST__ = $orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$o): $mod = ($i % 2 );++$i;?><li>
            <div class="u_img">
              
                            </div>
            <div class="u_text">
                <h2><?php echo (date("Y-m-d H:i:s",$o["time"])); ?></h2>
                <p class="u_color1">数量：<font class="org"><?php echo ($o["total"]); ?></font>  总价： <font class="org">￥<?php echo ($o["price"]); ?></font></p>
				<?php if($alipayConfig['open']){ ?>
				<p><?php if($o['paid']){echo '<span style="color:green">已付款</span>';}else{echo '<span style="color:red">未付款(点查看付款)</span>';} ?></p>
				<?php } ?>
                                <p><span class="u_mt5">订购人：<?php echo ($o["truename"]); ?></span> <a class="u_btn ts1" href="<?php echo U('Product/updateOrder',array('token'=>$token,'id'=>$o['id'],'wecha_id'=>$wecha_id));?>" style="margin-left:10px;display:">查看</a> <?php if($o["handled"] == 0): ?><a class="u_btn ts1" href="<?php echo U('Product/deleteOrder',array('token'=>$token,'id'=>$o['id'],'wecha_id'=>$wecha_id));?>">删除</a><?php endif; ?></p>
                            </div>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
         <?php else: ?>
         <div style="padding:10px; text-align:center">没有订单</div><?php endif; ?>
                </ul>  
      
</div>
</body>
</html>