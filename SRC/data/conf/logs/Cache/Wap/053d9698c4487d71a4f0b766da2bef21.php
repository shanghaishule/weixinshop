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

    	<div class="p_mod">
    		<h2 class="p_mod_title">购物车</h2>
            <div class="car">
                <?php if(is_array($products)): $i = 0; $__LIST__ = $products;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?><div class="car_list clearfix">
                <div class="car_content clearfix">
                  <h3><a href="<?php echo U('Product/product',array('token'=>$_GET['token'],'id'=>$p['id'],'wecha_id'=>$_GET['wecha_id']));?>"><?php echo ($p["name"]); ?></a></h3>
                     <a href="<?php echo U('Product/product',array('token'=>$_GET['token'],'id'=>$p['id'],'wecha_id'=>$_GET['wecha_id']));?>">
                      <img src="<?php echo ($p["logourl"]); ?>" />
                     </a>
                     <div class="car_property">
                        <span class="price_now">单价：<font>￥<?php echo ($p["price"]); ?></font></span>
                                                <div class="o_num_input clearfix" id="<?php echo ($p["id"]); ?>">
                            <a class="minus ts2" href="javascript:;" onclick="plus_minus(<?php echo ($p["id"]); ?>, -1,<?php echo ($p["price"]); ?>)">-</a>
                            <input type="number" min="1" lastnum="1" value="<?php echo ($p["count"]); ?>" id="qty<?php echo ($p["id"]); ?>" class="qty" onblur="full_update(<?php echo ($p["id"]); ?>,<?php echo ($p["price"]); ?>)" />
                            <a class="plus ts2 on" href="javascript:;" onclick="plus_minus(<?php echo ($p["id"]); ?>,1,<?php echo ($p["price"]); ?>)">+</a>
                        </div>
                        <a class="u_order_return delete" href="<?php echo U('Product/deleteCart',array('token'=>$_GET['token'],'id'=>$p['id'],'wecha_id'=>$_GET['wecha_id']));?>">删除商品</a>                     
                     </div>
                </div>
              </div><?php endforeach; endif; else: echo "" ;endif; ?>
                            <p><span class="price_now" id="total_fee">总价格：<font>￥<?php echo ($totalFee); ?></font></span></p>
            </div>            
    	</div>
            	<div class="o_btn clearfix">
            	<?php if($totalProductCount != 0): ?><input type="button" class="o_btn_back ts1" onclick="history.go(-1);" value="继续购物"/>
    		<input type="button" class="o_btn_submit ts1" onclick="location.href='<?php echo U('Product/orderCart',array('token'=>$_GET['token'],'cartIsDining'=>$cartIsDining,'wecha_id'=>$_GET['wecha_id']));?>'" value="去结算" /><?php endif; ?>
    	</div>
 
</div>
<style type="text/css">
.desks{ display: none;}
</style>
<script type="text/javascript">
function full_update(rowid,price) {
    var _this = $('#qty'+rowid);
    var this_val = parseInt($(_this).val());
    if (this_val < 1 || isNaN(this_val)) {
        alert('购买数量不能小于0！');
        $(_this).focus();
        return false;
    }
    update_cart(rowid, this_val,price);
}
//加减
function plus_minus(rowid, number,price) {
    var num = parseInt($('#qty'+rowid).val());
    num = num + parseInt(number);
    if (num < 1) {
        return false;
    }
     $('#qty'+rowid).attr('value',num);
    update_cart(rowid, num,price);     
}

//更新购物车
function update_cart(rowid, num,price) {
	$.ajax({
		url: '<?php echo U('Product/ajaxUpdateCart',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>&id='+rowid+'&count='+num+'&price='+price,
		success: function( data ) {
			if(data){
				var datas=data.split('|');
				$('#p_buy #all_price').html('￥'+datas[1]);
				$('#p_buy #all_numb').html(datas[0]);
				$('#total_fee font').html('￥'+datas[1]);
			}
		}
	});
}
//点击加入购物车
    function add_cart(id,price,count) {
    	$.ajax({
    		url: "<?php echo U('Product/addProductToCart',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id']));?>"+'&id='+id+'&price='+price+'&count='+count,
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
</body>
</html>