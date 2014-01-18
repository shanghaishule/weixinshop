<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>用户注册 - <?php echo ($page_seo["title"]); ?></title>
<link href="__STATIC__/weixin/css/shop.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="__STATIC__/weixin/js/index.js"></script>
<script type="text/javascript" src="__STATIC__/weixin/js/jquery.js" charset="utf-8"></script>
<script type="text/javascript" src="__STATIC__/weixin/js/ecmall.js" charset="utf-8"></script>
<script type="text/javascript" src="__STATIC__/weixin/js/touchslider.js" charset="utf-8"></script>
<script type="text/javascript">
//<!CDATA[
var SITE_URL = "http://store.weiapps.cn";
var REAL_SITE_URL = "http://store.weiapps.cn";
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
<script charset="utf-8" type="text/javascript" src="__STATIC__/weixin/js/jquery_002.js"></script>
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
<script type="text/javascript">
//注册表单验证
$(function(){
    $('#register_form').validate({
    	
    	/*errorLabelContainer: $('#warning'),
        invalidHandler: function(form, validator) {
           var errors = validator.numberOfInvalids();
           if(errors)
           {
               $('#warning').show();
           }
           else
           {
               $('#warning').hide();
           }
        },*/
      /*  errorPlacement: function(error, element){
            var error_td = element.next("label");
            error_td.append(error);
        },*/
        success  : function(label){
            //label.addClass('validate_right').text('OK!');
        },
        onkeyup: false,
        rules : {
            user_name : {
                required : true,
                byteRange: [3,15,'utf-8'],
                remote   : {
                    url :'index.php?m=Index&a=ajaxRegister',
                    type:'post',
                    dataType:"json",  
                    data:{
                        user_name : function(){
                        return $('#user_name').val();
                        }
                    },
                   beforeSend:function(){
                        var _checking = $('#checking_user');
                        _checking.next('label').hide();
                        $(_checking).show();
                    },
                    complete :function(){
                        $('#checking_user').show();
                    }
                }
            },
            password : {
                required : true,
                minlength: 6
            },
            password_confirm : {
                required : true,
                equalTo  : '#password'
            },
            email : {
                required : true,
                email    : true
            }
           
        },
        messages : {
            user_name : {
                required : '您必须提供一个用户名',
                byteRange: '用户名必须在3-15个字符之间',
                remote : '您提供的用户名已存在'
            },
            password  : {
                required : '您必须提供一个密码',
                minlength: '密码长度应在6-20个字符之间'
            },
            password_confirm : {
                required : '您必须再次确认您的密码',
                equalTo  : '两次输入的密码不一致'
            },
            email : {
                required : '您必须提供您的电子邮箱',
                email    : '这不是一个有效的电子邮箱'
            }
        }
    });
});
</script>

<div id="content">
    <form name="" id="register_form" method="post" action="<?php echo U('User/register');?>">
        <input id="user_name" name="user_name" placeholder="用户名" class="text width10" type="text">
        <label id="checking_user" class="checking"></label>
        <input id="password" name="password" placeholder="密&nbsp;&nbsp;&nbsp;码" class="text width10" type="password">
        <input name="password_confirm" placeholder="确认密码" class="text width10" type="password">
        <input name="email" placeholder="电子邮箱" class="text width10" type="text">
        <input name="Submit" value="立即注册" class="login_btn" title="立即注册" type="submit">
        <input name="ret_url" value=" " type="hidden">
    </form>
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