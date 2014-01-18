<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>用户登入-<?php echo ($page_seo["title"]); ?></title>
<link href="__STATIC__/weixin/css/shop.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="__STATIC__/weixin/js/index.js"></script>
<script type="text/javascript" src="__STATIC__/weixin/js/jquery.js" charset="utf-8"></script>
<script type="text/javascript" src="__STATIC__/weixin/js/ecmall.js" charset="utf-8"></script>
<script type="text/javascript" src="__STATIC__/weixin/js/touchslider.js" charset="utf-8"></script>

<script charset="utf-8" type="text/javascript" src="__STATIC__/weixin/js/jquery_002.js"></script></head>

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
$(function(){	
    $('#login_form').validate({
        errorPlacement: function(error, element){
            $(element).next("label").append(error); 
        },
        success       : function(label){
            //label.addClass('validate_right').text('OK!');
        },
		onsubmit:true,// 是否在提交是验证 
        onkeyup : false,
        rules : {
            user_name : {
                required : true,
			/*	remote   : {
					url:'index.php?app=member&act=check_user&ajax=1&login=1',
					type:'get',
					data:{
						user_name : function(){
                        return $('#user_name').val();
                        }
					}
				}*/
            },
            password : {
                required : true
            },
          		
        },
        messages : {
            user_name : {
                required : '您必须提供一个用户名',
				remote   : '用户名不存在！'
            },
            password  : {
                required : '您必须提供一个密码'
            }
        },
		submitHandler: function(form) {  //通过之后回调
			
    	//var param = $("#login_form").serialize();
    	var user_name= $('#user_name').val();
    	 var password= $('#password').val();
    	
    	var url  = "<?php echo U('Index/ajaxlogin');?>";
    	$.post(url,{user_name:user_name,password:password},function(data){
    	
    		if(data.status==1) {
    			$('#login_text').html("<b>登陆成功！</b>");
    			function a(){location.href=decodeURIComponent("%2Findex.php%3Fapp%3Dmemberbuy%26store_id%3D9");}
    			setTimeout(a,2000);
    		} else {
    			//var jsonObj = eval('('+result+')');
    			$('#login_text').html("<i>密码错误！</i>");
    		}

    	},'json');
     /*	$.ajax({
		url : "<?php echo U('Index/ajaxlogin');?>",
		type : "post",
		dataType : "json",
		data: param,
		success : function(result) {
			alert(result.msg);

		if(result.status==1) {
			$('#login_text').html("<b>登陆成功！</b>");			
			function a(){location.href=decodeURIComponent("%2Findex.php%3Fapp%3Dmemberbuy%26store_id%3D9");}
			setTimeout(a,2000);
		} else {
        	//var jsonObj = eval('('+result+')');
			$('#login_text').html("<i>密码错误！</i>");
		}
		}
     	});
     */
        }
}); 
});
</script>

<div id="content">
    <form method="post" id="login_form">
            <input name="user_name" id="user_name" class="text width5" placeholder="用户名" type="text">
            <label></label>
            <input name="password" id="password" class="text width5" placeholder="密 码" type="password">
            <label></label>                              
            <label id="login_text"></label>
            <input name="Submit" value="登陆" class="enter" type="submit">
            <a href="#" class="clew" style="display:none;">忘记密码？</a>
           <!-- <input name="ret_url" value=" " type="hidden">-->
    </form>
    <div class="login_right">
        <h4>如果您还不是会员，请<a href="<?php echo U('user/register');?>" title="立即注册">立即注册</a></h4>
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