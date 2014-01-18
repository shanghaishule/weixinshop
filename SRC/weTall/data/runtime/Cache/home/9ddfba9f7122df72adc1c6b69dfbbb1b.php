<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0048)http://store.weiapps.cn/index.php -->
<html>
<head>
<meta charset="utf-8" />
<title><?php echo ($page_seo["title"]); ?></title>
<meta name="keywords" content="<?php echo ($page_seo["keywords"]); ?>" />
<meta name="description" content="<?php echo ($page_seo["description"]); ?>" />
<meta content="width=device-width,minimum-scale=1.0,maximum-scale=1.0" name="viewport">
<script src="__STATIC__/js/jquery/jquery.js"></script>
<script type="text/javascript" src="__STATIC__/weixin/js/index.js"></script>
<link type="text/css" rel="stylesheet" href="__STATIC__/weixin/css/shop.css">
<script charset="utf-8" src="__STATIC__/weixin/js/jquery.js" type="text/javascript"></script>
<script charset="utf-8" src="__STATIC__/weixin/js/ecmall.js" type="text/javascript"></script>
<script charset="utf-8" src="__STATIC__/weixin/js/touchslider.dev.js" type="text/javascript"></script>
<script charset="utf-8" src="__STATIC__/weixin/js/goodsinfo.js" type="text/javascript"></script>
<script charset="utf-8" type="text/javascript" src="__STATIC__/weixin/js/jquery_002.js"></script></head>
<script type="text/javascript">
//<!CDATA[
var SITE_URL = "index.php-app=member&act=login&ret_url=-index.php-app=member.htm";
var REAL_SITE_URL = "index.php-app=member&act=login&ret_url=-index.php-app=member.htm";
var PRICE_FORMAT = '¥%s';

$(function(){
    var span = $("#child_nav");
    span.hover(function(){
        $("#float_layer:not(:animated)").show();
    }, function(){
        $("#float_layer").hide();
    });
});
//]]>
</script>
	<script charset="utf-8" src="__STATIC__/weixin/js/goodsinfo.js" type="text/javascript"></script>
	<script charset="utf-8" src="__STATIC__/weixin/js/jquery.js" type="text/javascript"></script>
	<script charset="utf-8" src="__STATIC__/weixin/js/colorbox.js" type="text/javascript"></script>
	<link type="text/css" rel="stylesheet" href="__STATIC__/weixin/colorbox.css">
</head>



<body>
<div id="head">
	<!--<img height="50" src="http://bestchoice88.com/weTall/static/weixin/images/store_logo.jpg">-->
</div>

<style>
#logo{
height:50px;
width:116px;
}
#headshop select{
 -webkit-border-radius:5px ; -moz-border-radius:5px;
float:left;
height:30px;
top:30px;
border-color:rgb(102,204,51);
margin:2px 0px 0px 2px;
}
#leftfloat{
height:35px;
margin:2px 2px 0px 10px;
}
#search_box {

width: 301px; 
height: 34px; 
background: url(http://bestchoice88.com/weTall/static/weixin/css/images/bg_search_box.gif); 
} 
 #s { 
float:left;
padding: 0; 
margin: 2px 0 0 6px; 
border: 0; 
height:30px;
width: 175px; 
background: none; 
font-size: .8em; 
} 
#search_box #go { 
float: right; 
margin: 4px 4px 0 0; 
} 
</style>
<div id="headshop">
        
        <div id="leftfloat">
        
        <div id="search_box"> 
        <select name="color" id="color">
		<option value="red"  class="red">搜索本店</option>
		<option value="blue" class="blue">搜微指购</option>
	</select>
	<form id="search_form" method="post" action="#"> 
	
	<input type="text" id="s" value="Search" class="swap_value" /> 
	<input type="image" src="http://bestchoice88.com/weTall/static/weixin/css/images/btn_search_box.gif" width="27" height="24" id="go" alt="Search" title="Search" /> 
	</form> 
	</div> 
	</div>
	</div>

<div id="nav">
        
	
	
	<ul class="navlist">
	<li class="r" id="n_4"><a href="http://bestchoice88.com/index.php?g=Wap&m=weTall&a=index"><span>&nbsp;&nbsp;微指购商城</span></a></li>
    	<li id="n_0">
    	<span ></span>
        	<ul class="submenu">
 
        	<?php if(is_array($index_cate_list)): $i = 0; $__LIST__ = $index_cate_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                    <a href="<?php echo U('book/cate',array('cid'=>$vo['id']));?>" class="none_ico"> <?php echo ($vo["name"]); ?></a><br>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
             
            
            </ul>
        </li>
        <li class="r active" id="n_1"><a href="<?php echo U('home/index/index');?>"><span></span></a></li>
        <li class="r" id="n_2"><a href="<?php echo U('user/index');?>"><span></span></a></li>
        <li class="r" id="n_3"><a href="<?php echo U('shopcart/index');?>"><span></span></a><i></i></li>
        
    </ul>
    <script type="text/javascript">
    	$(".navlist > li#n_0").click(function(){
			$(this).toggleClass("active");
			
		});
		$(".navlist > li.r a").each(function() {
            href="index.php-app=member&act=login&ret_url=-index.php-app=member.htm"+$(this).attr("href");
			whref=window.location.href;
			if(whref.indexOf(href)!='-1'){
				$(this).parent("li").addClass("active");
			}
        });
    </script>
    
</div>
<div class="s_bottom"></div>
<script type="text/javascript">
$(function(){
	$("div.module_special .wrap .major ul.list li:last-child").addClass("remove_bottom_line");
});
var active=0,
	as=document.getElementById('pagenavi').getElementsByTagName('a');
	
for(var i=0;i<as.length;i++){
	(function(){
		var j=i;
		as[i].onclick=function(){
			t2.slide(j);
			return false;
		}
	})();
}
var t2=new TouchSlider({id:'sliderlist', speed:600, timeout:6000, before:function(index){
		as[active].className='';
		active=index;
		as[active].className='active';
	}});
</script>
<div id="content">

	<script type="text/javascript">

    function buys()
    {
    	
        var goodId = $("#goodId").val();
        var quantity = $("#quantity").val();
      
        if (quantity == '')
        {
            alert('请输入购买数量');
            return;
        }
        if (parseInt(quantity) < 1)
        {
            alert("购买数量不能小于1");
            return;
        }
        if(isNaN(quantity))
        {
          alert("请输入数字!");
           return;
        }
        add_cart(goodId, quantity);
    }
    
  
  
    function add_cart(goodId,quantity)//商品ID，购买数量
    {
    	
     	var url  = "<?php echo U('Shopcart/add_cart');?>";
     	$.post(url,{goodId:goodId,quantity:quantity},function(data){
     		
     		if(data.status==1)
     		{
     			
     			$('.dialog_title').html(data.msg);
     			$('.bold_num').text(data.count);
     			 $('.bold_mly').html(data.sumPrice);
     			 $('.ware_cen').slideDown('slow');
     			 setTimeout(slideUp_fn, 5000);
     		}else
     		{
     			$('.dialog_title').html(data.msg);
     			$('.bold_num').text(data.count);
     			 $('.bold_mly').html(data.sumPrice);
     			 $('.ware_cen').slideDown('slow');
     			 setTimeout(slideUp_fn, 5000);
     		}
     	},'json');	
    }
    
    
    /* add cart */
  function add_to_cart(spec_id, quantity)
    {
        var url = SITE_URL + '/index.php?app=cart&amp;act=add';
        $.getJSON(url, {'spec_id':spec_id, 'quantity':quantity}, function(data){
            if (data.done)
            {
                $('.bold_num').text(data.retval.cart.kinds);
                $('.bold_mly').html(price_format(data.retval.cart.amount));
                $('#n_3 i').css({display:"block"});
                $('#n_3 i').text(data.retval.cart.kinds);
                $('.ware_cen').slideDown('slow');
                setTimeout(slideUp_fn, 5000);
            }
            else
            {
                //alert(data.msg);
                $('.ware_center').html('&lt;h1&gt;'+data.msg+'&lt;/h1&gt;&lt;a class="enter" href="http://store.weiapps.cn/index.php?app=cart&amp;store_id=9"&gt;现在去结算&lt;/a&gt;');
                $('.ware_cen').slideDown('slow');
                setTimeout(slideUp_fn, 5000);
            }
        });
    }
    
    </script>
    
    <script>
			$(document).ready(function(){
			
				$(".group1").colorbox({rel:'group1',width:"100%",height:"100%"});
			
			});
		</script>
    <div class="ware_info">
            <div class="ware_pic"></div>
            <div id="slider" class="slider" style="overflow: hidden; visibility: visible; list-style: none outside none; position: relative;">
                <ul id="sliderlist" class="sliderlist" style="position: relative; overflow: hidden; transition: left 600ms ease 0s; width: 784px; left: 202px;">

                    <?php if(is_array($img_list)): $i = 0; $__LIST__ = $img_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$img): $mod = ($i % 2 );++$i;?><li style="float: left; display: block; width: 596px;"><a class="group1" href="<?php echo attach(get_thumb($img['url'], '_b'), 'item');?>"><img  width="90%" height="85%" src="<?php echo attach(get_thumb($img['url'], '_b'), 'item');?>"></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
               <div id="pagenavi">
                   <?php if(is_array($img_list)): $k = 0; $__LIST__ = $img_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$img): $mod = ($k % 2 );++$k;?><a href="javascript:void(0);" <?php if($k == 1): ?>class="active"<?php endif; ?>><?php echo ($k); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
               </div>
           </div>
            <script type="text/javascript">
            var active=0,
                as=document.getElementById('pagenavi').getElementsByTagName('a');
                
            for(var i=0;i<as.length;i++){
                (function(){
                    var j=i;
                    as[i].onclick=function(){
                        t2.slide(j);
                        return false;
                    }
                })();
            }
            var t2=new TouchSlider({id:'sliderlist', speed:600, timeout:6000, before:function(index){
                    as[active].className='';
                    active=index;
                    as[active].className='active';
                }});
            </script>
            <input type="hidden" value="<?php echo ($item["id"]); ?>" id="goodId" >
        <div class="ware_text">
            <div class="rate">
                <h2 class="ware_title"><?php echo ($item["title"]); ?></h2>       	
                <span class="letterprice">现价: </span>
                <span ectype="goods_price" class="fontColor3">¥<?php echo ($item["price"]); ?></span><br>                       
                <span class="letter1">品牌: </span><?php echo ($item["brand"]); ?><br>
                销售情况: 售出 <?php echo ($item["buy_num"]); ?> 件<br>
                所在地区: 中国                        
            </div>
            <div class="handle">
                <ul>
                    <li class="handle_title">购买数量: </li>
                    <li>
                        <input type="text" value="1" id="quantity" name="" class="text width1" onafterpaste="this.value=this.value.replace(/\D/g,'')" onkeyup="this.value=this.value.replace(/\D/g,'')" />
                        件（库存<span ectype="goods_stock" class="stock"><?php echo ($item["goods_stock"]); ?></span>件）
                    </li>
                </ul>
            </div>
            <ul class="ware_btn">
                <div style="display:none;" class="ware_cen">
                    <div class="ware_center">
                        <h1>
                            <span class="dialog_title"></span>
                            <span onclick="slideUp_fn();" onmouseout="this.className = 'close_link'" onmouseover="this.className = 'close_hover'" title="关闭" class="close_link"></span>
                        </h1>
                        <div class="ware_cen_btn">
                            <p class="ware_text_p">购物车内共有 <span class="bold_num"></span> 种商品 共计 <span class="bold_mly"></span></p>
                            <p class="ware_text_btn">
                                <a href="<?php echo U('shopcart/index');?>"><input type="submit" onclick="#" value="查看购物车" name="" class="btn1"></a>
                                <input type="submit" onclick="$('.ware_cen').css({'display':'none'});" value="继续挑选商品" name="" class="btn2">
                            </p>
                        </div>
                    </div>
                    <div class="ware_cen_bottom"></div>
                </div>
                <li onclick="javascript:buys();" title="立刻购买" class="enter">立刻购买</li>
            </ul>
        </div>
    
        <div class="clear"></div>
    </div>
    <a name="module"></a>
    <ul class="user_menu">
        <div class="ornament1"></div>
        <div class="ornament2"></div>
        <li><a href="#" class="active"><span>商品详情</span></a></li>
    </ul>
    <div class="option_box">
        <div class="default">
        <?php echo ($item["info"]); ?>
        </div>
    </div>
    <div class="clear"></div>
</div>

﻿<div id="footer">
    <p class="foot_nav">
        <a href="<?php echo U('index/index');?>">商城首页</a> | <a href="<?php echo U('user/index');?>">会员中心</a> | <a href="#">品牌介绍</a>
    </p>
    <div style="height:40px; background:#fff; padding:0; overflow:hidden;">
        <div style="float:left; margin:5px 10px 0 0; display:inline;"><img height="20" src="__STATIC__/weixin/images/logo.png"></div>
        <div style="line-height:40px; height:40px; display:inline-block; margin-left:10px; float:right; color:#aaa; font-size:14px;">微指购商城</div>
    </div>
</div>

<script>
var PINER = {
    root: "__ROOT__",
    uid: "<?php echo $visitor['id'];?>", 
    async_sendmail: "<?php echo $async_sendmail;?>",
    config: {
        wall_distance: "<?php echo C('pin_wall_distance');?>",
        wall_spage_max: "<?php echo C('pin_wall_spage_max');?>"
    },
    //URL
    url: {}
};
//语言项目
var lang = {};
<?php $_result=L('js_lang');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>lang.<?php echo ($key); ?> = "<?php echo ($val); ?>";<?php endforeach; endif; else: echo "" ;endif; ?>
</script>
<?php $tag_load_class = new loadTag;$data = $tag_load_class->js(array('type'=>'js','href'=>'__STATIC__/js/jquery/plugins/jquery.tools.min.js,__STATIC__/js/jquery/plugins/jquery.masonry.js,__STATIC__/js/jquery/plugins/formvalidator.js,__STATIC__/js/fileuploader.js,__STATIC__/js/pinphp.js,__STATIC__/js/front.js,__STATIC__/js/dialog.js,__STATIC__/js/wall.js,__STATIC__/js/item.js,__STATIC__/js/user.js,__STATIC__/js/album.js','cache'=>'0','return'=>'data',));?>

</body>
</html>