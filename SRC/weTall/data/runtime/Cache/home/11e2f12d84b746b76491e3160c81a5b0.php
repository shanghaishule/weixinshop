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

<div class="banner">
    <div id="slider" class="slider" style="overflow: hidden; visibility: visible; list-style: none outside none; position: relative;">
        <ul id="sliderlist" class="sliderlist" style="position: relative; overflow: hidden; transition: left 600ms ease 0s; width: 1800px; left: -1200px;">
        <?php if(is_array($ad)): $i = 0; $__LIST__ = $ad;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li style="float: left; display: block; width: 600px;">
                <span>
                   <a href="<?php echo ($vo["url"]); ?>"> <img title="<?php echo ($vo["desc"]); ?>" width="100%" src="/weTall/data/upload/advert/<?php echo ($vo["content"]); ?>"></a>
                </span>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
      
        </ul>
        <div id="pagenavi">
         <?php if(is_array($ad)): $k = 0; $__LIST__ = $ad;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><a <?php if($k == 1): ?>class="active"<?php endif; ?> href="javascript:void(0);"><?php echo ($k); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
        
        </div>
    </div>
</div>
<div class="shoplogo">
   <div class="shoplogourl">
    <img width="60" height="60" src="__STATIC__/weixin/images/logo.jpg"/>
   </div>
   <div class="favi">
      <div id="shopname">
        语嫣鞋店
      </div>
        <ul id="operdetail">
          <li id="m_1">
            五星<br>信用
          </li>
          <li id="m_2">
            <img width="20" height="20" src="__STATIC__/weixin/images/share.png"/><br>分享
          </li>
          <li id="m_3">
            <img width="20" height="20" src="__STATIC__/weixin/images/favi.png"/><br>收藏店铺
          </li>
        </ul>
   </div>
   <hr>
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
   <!-- <div class="module_special">
        <h2 class="common_title veins2">
            <div class="ornament1"></div>
            <div class="ornament2"></div>
          <!--  <span class="ico1">
                <span class="ico2">最新团购</span>
            </span>
        </h2>
        <div class="wrap">
            <div class="wrap_child">
                <div class="group_major">
                    <ul class="list">
                        <li>
                            <div class="pic">
                                <a href="<?php echo U('Item/tuan');?>">
                                    <img src="__STATIC__/weixin/images/goods1.jpg">
                                </a>
                            </div>
                            <div class="good_content">
                                <h3>
                                    <a target="_blank" href="<?php echo U('Item/tuan');?>">7月团购火热</a>
                                </h3>
                                <p>
                                    <span> 团购价:&nbsp;</span>¥15.00
                                </p>
                                <div class="time">
                                    剩余:&nbsp;19天15小时
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>-->
    
    <div class="module_special">
        <h2 class="common_title veins2">
            <div class="ornament1"></div>
            <div class="ornament2"></div>
            <span class="ico1">
                <span class="ico2">推荐商品</span>
            </span>
        </h2>
        <div class="wrap">
            <div class="wrap_child">
                <div class="major">
                    <ul class="list">
                        <?php if(is_array($tuijian)): $i = 0; $__LIST__ = $tuijian;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li>
                    <div class="pic">
                     <a href="<?php echo U('Item/index',array('id'=>$item['id']));?>"><img  src="<?php echo attach(get_thumb($item['img'], '_b'), 'item');?>"></a>
                    </div>
                   <div class="good_content">
                    <h3>
                    <a  href="<?php echo U('Item/index',array('id'=>$item['id']));?>"><?php echo ($item["title"]); ?></a>
                   </h3>
                    <p>¥<?php echo ($item["price"]); ?></p>
                    </div>
                    <span class="show_good">
                      <a  href="<?php echo U('Item/index',array('id'=>$item['id']));?>"></a>
                    </span>
                      </li><?php endforeach; endif; else: echo "" ;endif; ?>
                       
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="module_special tbr">
        <h2 class="common_title veins2">
            <div class="ornament1"></div>
            <div class="ornament2"></div>
            <span class="ico1">
                <span class="ico2">最新商品</span>
            </span>
        </h2>
        <div class="wrap">
            <div class="wrap_child">
                <div class="major">
                    <ul class="list">
                     <?php if(is_array($news)): $i = 0; $__LIST__ = $news;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li>
                    <div class="pic">
                     <a href="<?php echo U('Item/index',array('id'=>$item['id']));?>"><img  src="<?php echo attach(get_thumb($item['img'], '_b'), 'item');?>"></a>
                    </div>
                   <div class="good_content">
                    <h3>
                    <a  href="<?php echo U('Item/index',array('id'=>$item['id']));?>"><?php echo ($item["title"]); ?></a>
                   </h3>
                    <p>¥<?php echo ($item["price"]); ?></p>
                    </div>
                    <span class="show_good">
                      <a  href="<?php echo U('Item/index',array('id'=>$item['id']));?>"></a>
                    </span>
                      </li><?php endforeach; endif; else: echo "" ;endif; ?>
                      
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="clear">
    </div>
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