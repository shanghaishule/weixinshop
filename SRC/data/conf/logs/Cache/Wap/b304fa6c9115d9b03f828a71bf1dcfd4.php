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
	<form class="f_index_search clearfix" action="" method="post" id="search_form">
				<input type="text" id="search_name" name="search_name" class="search_box" placeholder="请输入搜索关键字" />
		<input type="submit" class="search_button" value="搜 索" />
	</form>
<dl class="tab_control">
  <dd><a href="javascript:" order="time">时间排序</a></dd>
  <dd><a href="javascript:" order="salecount">团购人数</a></dd>
  <dd><a href="javascript:" order="price">价格排序</a></dd>
  <dd><a href="javascript:" order="discount">折扣排序</a></dd>
</dl>
<section class="f_list i_list" >
		<ul class="clearfix" id="f_list">
		<?php if(is_array($products)): $i = 0; $__LIST__ = $products;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hostlist): $mod = ($i % 2 );++$i;?><li>
			<div class="f_list_l">
				<a href="<?php echo U('Product/product',array('token'=>$token,'id'=>$hostlist['id'],'wecha_id'=>$wecha_id));?>">
					<img src="<?php echo ($hostlist["logourl"]); ?>" />
					<h3 style="height:20px;line-height:20px;"><?php echo ($hostlist["name"]); ?> </h3>
					
					<p class="tui_price ts2" style="font-weight:normal;font-size:14px;color:#666;"> 已有<strong style="font-size:16px;font-weight:bold; color:#f60"><?php echo ($hostlist['salecount']+$hostlist['fakemembercount']); ?></strong>人购买，截止<?php echo (date("Y-m-d",$hostlist["endtime"])); ?></p>
										<div class="hot">
						<strong>团购</strong>
					</div>
									</a>
			</div>
			<div class="f_list_r">
				<p class="tui_price ts2">
					<strong><i style="font-weight:normal;font-size:14px;color:#666;text-decoration:line-through"><?php echo ($hostlist["oprice"]); ?>&nbsp;元</i> ￥<?php echo ($hostlist["price"]); ?></strong>
				</p>
				<a href="<?php echo U('Product/product',array('token'=>$token,'id'=>$hostlist['id'],'wecha_id'=>$wecha_id));?>" class="u_order_return ts1" id="in_car">参加团购</a>
			</div>
		</li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
	</section>
<a class="more" id="show_more" page="2" style="display: none;" href="javascript:void(0);">加载更多</a>
	<input type="hidden" value="1" id="pageid" />
<script type="text/javascript">
$(function() {
	$('#search_form').submit(function() {
		var search_name = $('#search_name').val();
		if (search_name == '') {
			return false;
		}
	});

	//点击排序
	var base_url = '<?php echo U('Groupon/grouponIndex',array('token'=>$token,'wecha_id'=>$wecha_id));?>';
	var b_url = '<?php if($isSearch != 1): echo U('Groupon/ajaxGrouponProducts',array('token'=>$token,'wecha_id'=>$wecha_id)); else: echo U('Product/ajaxGrouponProducts',array('token'=>$token,'keyword'=>$_GET['keyword'],'wecha_id'=>$wecha_id)); endif; ?>'
		method = 'DESC',
		_get_method = '<?php echo ($method); ?>',
		order = '<?php echo ($order); ?>',
		_get_order  = '';
	if (_get_order != '') {
		order = _get_order;
	}
	$('.tab_control a').removeClass('on');
	$('.tab_control a[order="' + order + '"]').addClass('on');

	if (_get_method == 'DESC')  {
		method = 'ASC';
	}
	$('.tab_control a').click(function() {
		var order = $(this).attr('order');
		var url = base_url + '&order=' + order+'&method='+method;
		location.href = url;
	});

	/*---------------------加载更多--------------------*/
	var total = <?php echo ($count); ?>,
		pagesize = 5,
		pages = Math.ceil(total / pagesize);

	var com_link = '<?php echo U('Product/product',array('token'=>$token,'wecha_id'=>$wecha_id));?>';

	var label_arr = ["\u8bf7\u9009\u62e9\u6807\u7b7e","\u70ed\u5356","\u7206\u6b3e"];


	if (pages > 1) {
		var _page = $('#show_more').attr('page');
		$(window).bind("scroll",function() {
			if ($(document).scrollTop() + $(window).height() >= $(document).height()) {
				if (_page > pages) {
					$('#show_more').show().html('没有更多了').delay(2300).slideUp(1600);
					return;
				}
				$('#show_more').show().html('加载中...');
				$.ajax({
					type : "GET",
					data : {'page' : _page, 'inajax' : 1},
					url :  b_url + '&order=' + order + '&method=' + method + '&pagesize='+pagesize,
					dataType : "json",
					success : function(RES) {
						$('#show_more').hide().html('加载更多');
						
						data = RES.products;
						
						//alert(b_url + 'order=' + order + '&method=' + method + '&pagesize='+pagesize)
						if(data.length){
						$('#show_more').attr('page',parseInt(_page)+1);
						}
						_page = $('#show_more').attr('page');
						var _tmp_html = '';
						$.each(data, function(x, y) {
							_tmp_html +=    '<li><div class="f_list_l">' +
							'<a href="' + com_link + '&id=' + y.id + '">' +
							'<img src="' +y.logourl + '" />' +
							'<h3 style="height:20px;">' + y.name + '</h3>' +
							'</a>' +
							'<p class="tui_price ts2" style="font-weight:normal;font-size:14px;color:#666;">已有<strong style="font-size:16px;font-weight:bold; color:#f60">' + y.membercount + '</strong>人购买，截止' + y.enddate + '</p>';
							if (y.product_label > 0) {
								_tmp_html += 	'<div class="hot">' +
								'<strong>团购</strong>' +
								'</div>';
							}
							_tmp_html += '</div><div class="f_list_r"><p class="tui_price ts2"><strong><i style="font-weight:normal;font-size:14px;color:#666;text-decoration:line-through">' + y.oprice + '&nbsp;元</i> ￥' + y.price + '</strong></p>' +
							'<a href="'+com_link+'&id='+y.id+'" class="u_order_return ts1" id="in_car" >参加团购</a></div></li>';
						});
						$('#f_list').append(_tmp_html);
						
					}
				});
			}
		});

		
	}
});
</script>
</body>
</html>