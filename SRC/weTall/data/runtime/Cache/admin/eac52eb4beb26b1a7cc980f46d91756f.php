<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html class="off">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/admin/style.css" />
    <link href="/tpl/User/default/common/css/style.css" rel="stylesheet" type="text/css" />
<link href="/tpl/User/default/common/css/stylet.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/tpl/User/default/common/js/jquery.min.js"></script>
<script type="text/javascript" src="/tpl/User/default/common/js/main.js"></script>
    
    <title><?php echo L('website_manage');?></title>
    <script>
	var URL = '__URL__';
	var SELF = '__SELF__';
	var ROOT_PATH = '__ROOT__';
	var APP	 =	 '__APP__';
	//语言项目
	var lang = new Object();
	<?php $_result=L('js_lang');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>lang.<?php echo ($key); ?> = "<?php echo ($val); ?>";<?php endforeach; endif; else: echo "" ;endif; ?>
	</script>
</head>
<body scroll="no">
<div id="header">
   <div id="top">
		<img src="/tpl/User/default/common/images/logo.png" />
		<a href="/" >首页</a>
		<a href="/index.php?g=Home&m=Index&a=fc" >功能介绍</a>
		<a href="/index.php?g=Home&m=Index&a=about" >关于我们</a>
		<a href="/index.php?g=Home&m=Index&a=price" >资费说明</a>
		<a href="/index.php?g=Home&m=Index&a=common" >微信导航</a>
		<a href="/index.php?g=User&m=Index&a=index" >管理中心</a>
        <a href="/index.php?g=Home&m=Index&a=help" >帮助中心</a>
		<a class="line" ></a>
        <a href="/index.php?g=User&m=Groupon&a=index&token=gmbqsf1389536537">>>>返回管理中心</a>
	</div> 
</div>
<div id="content">
	<div class="left_menu fl">
    	<div id="J_lmenu" class="J_lmenu" data-uri="<?php echo U('index/left');?>"></div>
        <a href="javascript:;" id="J_lmoc" style="outline-style: none; outline-color: invert; outline-width: medium;" hidefocus="true" class="open" title="<?php echo L('expand_or_contract');?>"></a>
    </div>
    <div class="right_main">
    	<div class="crumbs">
        	<div class="options">
				<a href="javascript:;" title="<?php echo L('refresh_page');?>" id="J_refresh" class="refresh" hidefocus="true"><?php echo L('refresh_page');?></a>
            	<a href="javascript:;" title="<?php echo L('full_screen');?>" id="J_full_screen" class="admin_full" hidefocus="true"><?php echo L('full_screen');?></a>
                <a href="javascript:;" title="<?php echo L('flush_cache');?>" id="J_flush_cache" class="flush_cache" data-uri="<?php echo U('cache/qclear');?>" hidefocus="true"><?php echo L('flush_cache');?></a>
            	<!--<a href="javascript:;" title="<?php echo L('background_map');?>" id="J_admin_map" class="admin_map" data-uri="<?php echo U('index/map');?>" hidefocus="true"><?php echo L('background_map');?></a>-->
			</div>
    		<div id="J_mtab" class="mtab">
            	<a href="javascript:;" id="J_prev" class="mtab_pre fl" title="上一页">上一页</a>
                <a href="javascript:;" id="J_next" class="mtab_next fr" title="下一页">下一页</a>
                <div class="mtab_p">
                    <div class="mtab_b">
                        <ul id="J_mtab_h" class="mtab_h"><li class="current" data-id="0"><span><a>后台首页</a></span></li></ul>
                    </div>
                </div>
            </div>
        </div>
    	<div id="J_rframe" class="rframe_b">
        	<iframe id="rframe_0" src="<?php echo U('index/panel');?>" frameborder="0" scrolling="auto" style="height:100%;width:100%;"></iframe>
        </div>
    </div>
</div>
<script src="__STATIC__/js/jquery/jquery.js"></script>
<script src="__STATIC__/js/pinphp.js"></script>
<script>
//初始化弹窗
(function (d) {
    d['okValue'] = lang.dialog_ok;
    d['cancelValue'] = lang.dialog_cancel;
    d['title'] = lang.dialog_title;
})($.dialog.defaults);
</script>
<script src="__TMPL__public/js/index.js"></script>
</body>
</html>