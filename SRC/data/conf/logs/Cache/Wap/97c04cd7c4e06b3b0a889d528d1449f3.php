<?php if (!defined('THINK_PATHSLAPP')) exit();?><html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo ($tpl["wxname"]); ?></title>
        <base href="." />
        <meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        <meta name="format-detection" content="telephone=no" />
        <link href="<?php echo RES;?>/css/allcss/cate<?php echo ($tpl["tpltypeid"]); ?>_<?php echo ($tpl["color_id"]); ?>.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="<?php echo RES;?>/css/flash/css/plugmenu.css">
    </head>

    <body id="cate16">
        <div class="mainbg">
                <img src="<?php if($homeInfo["homeurl"] != false): echo ($homeInfo["homeurl"]); else: echo RES;?>/images/themes/bg1.jpg<?php endif; ?> "/>
        </div>
        <div id="insert1"></div>
        <div class="mainmenu">
            <ul>
                <?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                        <div class="menubtn"><a href="<?php if($vo['url'] == ''): echo U('Wap/Index/lists',array('classid'=>$vo['id'],'token'=>$vo['token'])); else: echo (htmlspecialchars_decode($vo["url"])); endif; ?>">
                                <div class="menuimg"><img src="<?php echo ($vo["img"]); ?>"></div>
                                <div class="menutitle"><?php echo ($vo["name"]); ?></div></a>
                        </div>

                    </li><?php endforeach; endif; else: echo "" ;endif; ?>

                <div class="clr"></div>


            </ul>
        </div>

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