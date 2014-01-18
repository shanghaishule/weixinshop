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
<div class="main">
	<div class="banner" id="banner">
		<a href="<?php echo U('Product/product',array('token'=>$_GET['token'],'id'=>$product['id'],'wecha_id'=>$_GET['wecha_id']));?>">
			<img src="<?php echo ($product["logourl"]); ?>" alt="<?php echo ($product["name"]); ?>"/>
			<h1 class="p_title"><?php echo ($product["name"]); ?></h1>
		</a>
	</div>
	<div class="f_list_car p_buy clearfix">
		<span class="all_price all_price_this">价格：<font>￥<?php echo ($product["price"]); ?></font> <span style="text-decoration:line-through">原价：<?php echo ($product["oprice"]); ?>元</span></span>

		<!--检查库存-->
				<a href="javascript:;" class="p_btn_buy">
			<span class="ts1" onclick="add_cart();">点菜</span>
		</a>
			</div>
			<?php if($product['groupon'] == 1): ?><div class="p_buy clearfix" style="">
<div id="remainTime" style="font-size:16px;font-weight:800;color:#FF9900"></div> 
</div>
<script type="text/javascript"> 
 var SysSecond; 
 var InterValObj; 
  
 $(document).ready(function() { 
  SysSecond = parseInt($("#remainSeconds").html()); //这里获取倒计时的起始时间 
  InterValObj = window.setInterval(SetRemainTime, 1000); //间隔函数，1秒执行 
 }); 
 
 //将时间减去1秒，计算天、时、分、秒 
 function SetRemainTime() { 
  if (SysSecond > 0) { 
   SysSecond = SysSecond - 1; 
   var second = Math.floor(SysSecond % 60);             // 计算秒     
   var minite = Math.floor((SysSecond / 60) % 60);      //计算分 
   var hour = Math.floor((SysSecond / 3600) % 24);      //计算小时 
   var day = Math.floor((SysSecond / 3600) / 24);        //计算天 
 
   $("#remainTime").html('&nbsp;&nbsp;还剩'+day + "天" + hour + "小时" + minite + "分" + second + "秒"); 
  } else {//剩余时间小于或等于0的时候，就停止间隔函数 
   window.clearInterval(InterValObj); 
   //这里可以添加倒计时时间为0后需要执行的事件 
  } 
 } 
</script> 
<div id="remainSeconds" style="display:none"><?php echo ($leftSeconds); ?></div><?php endif; ?>
        <script type="text/javascript">
    //点击加入购物车
    function add_cart() {
    	$.ajax({
    		url: "<?php echo U('Product/addProductToCart',array('token'=>$token,'id'=>$product['id'],'price'=>$product['price'],'count'=>1,'wecha_id'=>$_GET['wecha_id']));?>",
    		success: function( data ) {
    			if(data){
    				var datas=data.split('|');
    				$('#p_buy #all_price').html('￥'+datas[1]);
                    $('#p_buy #all_numb').html(datas[0]); 
    			}
    		}
    	});
    }
    </script>
    <?php if($product['groupon'] == 1): ?><div class="p_mod p_short_desc">
		<h2 class="p_mod_title">团购信息</h2>
		<div class="p_con">
			<p>已售数量：<span style="color:#f60;font-size:16px;font-weight:bold"><?php echo ($product['salecount']+$product['fakemembercount']); ?></span></p>
			<p>截止日期：<?php echo (date("Y-m-d",$product["endtime"])); ?></p>
		</div>
		
	</div><?php endif; ?>
	<div class="p_mod p_short_desc">
		<h2 class="p_mod_title">商品简介</h2>
		<div class="p_con">
			<p><?php echo ($intro); ?></p>
		</div>
		<a href="<?php echo U('Product/productDetail',array('token'=>$_GET['token'],'id'=>$product['id'],'wecha_id'=>$_GET['wecha_id']));?>" class="p_to_desc">
			查看图文详情
			<span class="gt"></span>
		</a>
	</div>
	<div class="p_mod p_seller_info">
		<a href="<?php echo U('Product/company',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'id'=>$product['id']));?>">
			查看商家信息
			<font>共<?php echo ($branchStoreCount); ?>家分店</font>
			<span class="gt"></span>
		</a>
	</div>
    

	<!--套餐-->
				    <section class="f_list f_mod i_list" >
	    	<h2 class="p_mod_title">热门</h2>
	    	<ul class="clearfix" id="f_list">
	    	<?php if(is_array($products)): $i = 0; $__LIST__ = $products;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hostlist): $mod = ($i % 2 );++$i;?><li>
			<div class="f_list_l">
				<a href="<?php echo U('Product/product',array('token'=>$_GET['token'],'id'=>$hostlist['id'],'wecha_id'=>$_GET['wecha_id']));?>">
					<img src="<?php echo ($hostlist["logourl"]); ?>" />
					<h3><?php echo ($hostlist["name"]); ?></h3>
					<p class="tui_price ts2" style="font-weight:normal;font-size:14px;color:#666;text-decoration:line-through">原价：<?php echo ($hostlist["price"]); ?>&nbsp;元</p>
										<div class="hot">
						<strong style="display:none">热卖</strong>
					</div>
									</a>
			</div>
			<div class="f_list_r">
				<p class="tui_price ts2">
					<strong>￥<?php echo ($hostlist["price"]); ?></strong>
				</p>
				<a href="<?php echo U('Product/product',array('token'=>$_GET['token'],'id'=>$hostlist['id'],'wecha_id'=>$_GET['wecha_id']));?>" class="u_order_return ts1" id="in_car">去购买</a>
			</div>
		</li><?php endforeach; endif; else: echo "" ;endif; ?>
	            	   
	            	    	</ul>
	    </section>
			
<br>

</body>
</html>