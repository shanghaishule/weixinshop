<?php if (!defined('THINK_PATHSLAPP')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo ($tpl["wxname"]); ?></title>
        <base href="." />
        <meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        <meta name="format-detection" content="telephone=no" />
        <link href="<?php echo RES;?>/css/allcss/cate17_0.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo RES;?>/css/110/iscroll.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="<?php echo RES;?>/css/flash/css/plugmenu.css">
        <style>
            #cate10 .catemenu li:nth-child(n+4) img {
                display: block;
            }
            #cate10 .catemenu li:nth-child(n+4) a {
                padding: 20px 5px 10px;
            }
            #cate10 .catemenu li a {
                background:#8f0096;
                margin:0;
                border-radius: 0;
            }
            #cate10 .catemenu li:nth-child(2n) a {
                background:#5134ab;
                color:#fff;/*文字的颜色，可以自由更换*/
            }
            #cate10 .catemenu li:nth-child(3n) a {
                background:#d34827;
                color:#fff;/*文字的颜色，可以自由更换*/
            }
            #cate10 .catemenu li:nth-child(4n) a {
                background:#009dae;
                color:#fff;/*文字的颜色，可以自由更换*/
            }
            #cate10 .catemenu li:nth-child(5n) a {
                background:#008d00;
                color:#fff;/*文字的颜色，可以自由更换*/
            }
            #cate10 .catemenu li:nth-child(6n) a {
                background:#f07d5e;
                color:#fff;/*文字的颜色，可以自由更换*/
            }
            #cate10 .catemenu li:nth-child(7n) a {
                background:#8f0096;
                color:#fff;/*文字的颜色，可以自由更换*/
            }
            #cate10 .catemenu li:nth-child(8n) a {
                background:#5134ab;
                color:#fff;/*文字的颜色，可以自由更换*/
            }
            #cate10 .catemenu li:nth-child(9n) a {
                background:#d34827;
                color:#fff;/*文字的颜色，可以自由更换*/
            }
            #cate10 .catemenu li:nth-child(10n) a {
                background:#009dae;
                color:#fff;/*文字的颜色，可以自由更换*/
            }
            #cate10 .catemenu li:nth-child(11n) a {
                background:#008d00;
                color:#fff;/*文字的颜色，可以自由更换*/
            }
            #cate10 .catemenu li:nth-child(12n) a {
                background:#f07d5e;
                color:#fff;/*文字的颜色，可以自由更换*/
            }
            #cate10 .catemenu {
                margin:3px;
                border-radius: 0;
            } 
            #cate10 .catemenu a {
                border:0; color:#ccc;/*文字的颜色，可以自由更换*/
            } 
            #cate10 {
                background-color:#000000;/*黑色背景，可以自由更换*/
            }

        </style>
        <script src="<?php echo RES;?>/css/110/iscroll.js" type="text/javascript"></script>
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

    </head>

    <body id="cate10" style="background:#333;">
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

        <div class="catemenu">
            <ul> 
                <?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                    <a href="<?php if($vo['url'] == ''): echo U('Wap/Index/lists',array('classid'=>$vo['id'],'token'=>$vo['token'])); else: echo (htmlspecialchars_decode($vo["url"])); endif; ?>">
                        <img src="<?php echo ($vo["img"]); ?>" /><?php echo ($vo["name"]); ?>
                    </a>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>

                <div class="clr"></div>
            </ul>
        </div>

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

<?php if($showPlugMenu): ?><div class="plug-div">
        <div class="plug-phone">
            <div class="plug-menu themeStyle" style="background:<?php echo ($homeInfo["plugmenucolor"]); ?>"><span class="close"></span></div> 
               <?php if(is_array($plugmenus)): $i = 0; $__LIST__ = $plugmenus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="themeStyle plug-btn plug-btn<?php echo ($i); ?> close" style="background:<?php echo ($homeInfo["plugmenucolor"]); ?>">
							<a  href="<?php echo ($vo["url"]); ?>">
								<span style="background-image: url(<?php echo RES;?>/css/flash/images/img/<?php echo ($vo["name"]); ?>.png);" ></span>
							</a>
						</div><?php endforeach; endif; else: echo "" ;endif; ?>   
<div class="plug-btn plug-btn5 close"></div>
                    </div>
</div><?php endif; ?>
<script src="<?php echo RES;?>/css/flash/js/zepto.min.js" type="text/javascript"></script>
<script src="<?php echo RES;?>/css/flash/js/plugmenu.js" type="text/javascript"></script>
  <div class="copyright">
<?php if($iscopyright == 1): echo ($homeInfo["copyright"]); ?>
<?php else: ?>
<?php echo ($siteCopyright); endif; ?>
</div>   </body></html>