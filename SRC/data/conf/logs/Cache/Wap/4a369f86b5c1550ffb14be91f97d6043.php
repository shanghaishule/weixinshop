<?php if (!defined('THINK_PATHSLAPP')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($tpl['wxname']); ?></title>
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<base href="." />
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/yuesh/iscroll.css" />
<link rel="stylesheet" href="<?php echo RES;?>/css/flash/css/plugmenu.css">
<script src="<?php echo RES;?>/css/102/iscroll.js" type="text/javascript"></script>
        <script type="text/javascript">
            var myScroll;
            function loaded() {
                myScroll = new iScroll('wrapper', {
                    snap: true,
                    momentum: false,
                    hScrollbar: false,
                    onScrollEnd: function () {
                        document.querySelector('#indicator > li.active').className = '';
                        document.querySelector('#indicator > li:nth-child(' + (this.currPageX+1) + ')').className = 'active';
                    }
                });
 
            }
            document.addEventListener('DOMContentLoaded', loaded, false);
        </script>

<style type="text/css">
*{padding:0;margin:0;}
li{list-style:none;}
body{background:#032a4b;}
.show{height:200px;}
.main ul{padding:5px 0 0;}
.main ul:after{content:".";display:block;height:0;clear:both;visibility:hidden;}
.main li{height:70px;float:left;margin-top:5px;}
.m1{background:#5e3bb9;width:46%;margin:5px 2% 0 3%;}
.m2{background:#2d89ef;width:22%;margin-right:2%;}
.m3{background:#00a500;width:22%;}
.m4{background:#009bad;width:46%;margin:5px 2% 0 3%;}
.m5{background:#a400ab;width:22%;margin-right:2%;}
.m6{background:#0a58c1;width:22%;}
.m7{background:#00a400;width:46%;margin:5px 2% 0 3%;}
.m8{background:#5837b2;width:46%;}
.m9{background:#2c86ee;width:46%;margin:5px 2% 0 3%;}
.m10{background:#b01a40;width:46%;}
.main li a{color:#fff;font-size:13px;text-decoration:none;display:block;height:70px;text-align:center;}
.main li div{height:70px;}
.m1 a,.m4 a,.m7 a,.m8 a,.m9 a,.m10 a{line-height:70px;padding:0 0 0 60px;}
.m2 a,.m3 a,.m5 a,.m6 a{padding:53px 0 0 0;white-space: nowrap;}
html,body {
	color: #ffffff;
	font-family: Microsoft YaHei, Helvitica, Verdana, Tohoma, Arial,
		san-serif;
	margin: 0;
	padding: 0;
	text-decoration: none;
}

* {
	margin: 0;
	padding: 0;
}

li {
	list-style-type: none;
}

a{
	text-decoration:none;
}

</style>

</head>
<body>
<div class="wrap">
	<div class="banner">
		<div id="wrapper">
			<div id="scroller">
				<ul id="thelist"> 
				<?php if(is_array($flash)): $i = 0; $__LIST__ = $flash;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$so): $mod = ($i % 2 );++$i;?><li><p><?php echo ($so["info"]); ?></p><a href="<?php echo ($so["url"]); ?>"><img src="<?php echo ($so["img"]); ?>" /></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
		</div>
		<div id="nav">
			<div id="prev" onclick="myScroll.scrollToPage('prev', 0,400,3);return false">&larr; prev</div>
			<ul id="indicator">
			<?php if(is_array($flash)): $i = 0; $__LIST__ = $flash;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$so): $mod = ($i % 2 );++$i;?><li   <?php if($i == 1): ?>class="active"<?php endif; ?>  ><?php echo ($i); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
			<div id="next" onclick="myScroll.scrollToPage('next', 0);return false">next &rarr;</div>
		</div>
		<div class="clr"></div>
	</div>
	<div id="insert1"></div>
	<script>


            var count = document.getElementById("thelist").getElementsByTagName("img").length;	


            for(i=0;i<count;i++){
                document.getElementById("thelist").getElementsByTagName("img").item(i).style.cssText = " width:"+document.body.clientWidth+"px";

            }

            document.getElementById("scroller").style.cssText = " width:"+document.body.clientWidth*count+"px";


            setInterval(function(){
                myScroll.scrollToPage('next', 0,400,count);
            },3500 );

            window.onresize = function(){ 
                for(i=0;i<count;i++){
                    document.getElementById("thelist").getElementsByTagName("img").item(i).style.cssText = " width:"+document.body.clientWidth+"px";

                }

                document.getElementById("scroller").style.cssText = " width:"+document.body.clientWidth*count+"px";
            } 

	</script>
	<div id="insert2"></div>
	<div style="display:none"> </div>
	<div style="display:none"><script language="javascript" type="text/javascript" src=""></script></div>



<?php $m=1; ?>
<div class="main"><ul>
<?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($m==11){ $m=1; } echo '<li class="m'.$m.'">'; $m++; ?>
<div style="background:url(<?php echo ($vo["img"]); ?>) 5px 10px no-repeat;background-size:50px 50px;">
<a href="<?php if($vo['url'] == ''): echo U('Wap/Index/lists',array('classid'=>$vo['id'],'token'=>$vo['token'])); else: echo ($vo["url"]); endif; ?>">
<span class="icon"><em></em></span>	<span class="title"><?php echo ($vo["name"]); ?></span></a></div></li><?php endforeach; endif; else: echo "" ;endif; ?></ul></div>
</div>
<?php if($showPlugMenu): ?><div class="plug-div">
				<div class="plug-phone">
					<div class="plug-menu themeStyle" style="background:<?php echo ($homeInfo["plugmenucolor"]); ?>">
						<span class="close">
						</span>
					</div>
					<?php if(is_array($plugmenus)): $i = 0; $__LIST__ = $plugmenus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="themeStyle plug-btn plug-btn<?php echo ($i); ?> close" style="background:<?php echo ($homeInfo["plugmenucolor"]); ?>">
							<a href="<?php echo ($vo["url"]); ?>">
								<span style="background-image: url(<?php echo RES;?>/css/flash/images/img/<?php echo ($vo["name"]); ?>.png);">
								</span>
							</a>
						</div><?php endforeach; endif; else: echo "" ;endif; ?>
					<div class="plug-btn plug-btn5 close">
					</div>
				</div>
			</div><?php endif; ?>
	<script src="<?php echo RES;?>/css/flash/js/zepto.min.js" type="text/javascript"></script>
	<script src="<?php echo RES;?>/css/flash/js/plugmenu.js" type="text/javascript"></script>
	<div class="copyright">
		<?php if($iscopyright == 1): echo ($homeInfo["copyright"]); ?>
		<?php else: ?>
			<?php echo ($siteCopyright); endif; ?>
	</div>
</body>
</html>