<?php if (!defined('THINK_PATHSLAPP')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($tpl["wxname"]); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta charset="utf-8">
<link href="<?php echo RES;?>/css/yl/news.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo RES;?>/css/flash/css/plugmenu.css">
</head>
<script>
window.onload = function ()
{
var oWin = document.getElementById("win");
var oLay = document.getElementById("overlay");	
var oBtn = document.getElementById("popmenu");
var oClose = document.getElementById("close");
oBtn.onclick = function ()
{
oLay.style.display = "block";
oWin.style.display = "block"	
};
oLay.onclick = function ()
{
oLay.style.display = "none";
oWin.style.display = "none"	
}
};
</script>
<body id="listhome1">
<div id="ui-header">
<div class="fixed">
<a class="ui-title" id="popmenu">选择分类</a>
<a class="ui-btn-left_pre" href="javascript:history.go(-1)"></a>
<a class="ui-btn-right" href="<?php echo U('Index/index',array('token'=>$tpl['token']));?>"></a>
</div>
</div>
<div id="overlay"></div>
<div id="win">
<ul class="dropdown"> 
<?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php if($vo['url'] == ''): echo U('Wap/Index/lists',array('classid'=>$vo['id'],'token'=>$vo['token'])); else: echo (htmlspecialchars_decode($vo["url"])); endif; ?>"><span><?php echo ($vo["name"]); ?></span></a></li><?php endforeach; endif; else: echo "" ;endif; ?> 	
<div class="clr"></div>
</ul>
</div>
<div class="Listpage">
<div class="top46"></div>
    <div id="todayList">
<ul  class="todayList">
   <?php if(is_array($res)): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$so): $mod = ($i % 2 );++$i;?><li>
<?php if($so['url']): ?><a href="<?php echo ($so["url"]); ?>">
<?php else: ?>
<a href="<?php echo U('Index/content',array('id'=>$so['id'],'token'=>$so['token']));?>"><?php endif; ?>
<div class="img"><?php if(($so["showpic"]) == "1"): ?><img src="<?php echo ($so["pic"]); ?>"><?php endif; ?></div>
<h2><?php echo ($so["title"]); ?></h2>
<p class="onlyheight"><?php echo ($so["text"]); ?></p>
<div class="commentNum"></div>
</a>
</li><?php endforeach; endif; else: echo "" ;endif; ?>

</ul>
</div>
<section id="Page_wrapper">
<div id="pNavDemo" class="c-pnav-con">
<section class="c-p-sec">
<div class='c-p-pre <?php if(($p) == "1"): ?>c-p-grey<?php endif; ?> '><span class="c-p-p"><em></em></span><a <?php if(($p) == "1"): else: ?>href="<?php echo C('site_url');?>/index.php?g=Wap&m=Index&a=lists&classid=<?php echo $_GET['classid']; ?>&token=<?php echo ($tpl["token"]); ?>&p=<?php echo $p-1; ?>"<?php endif; ?>  >上一页</a></div>
<div class="c-p-cur">
<div class="c-p-arrow c-p-down"><span><?php echo ($p); ?>/<?php echo ($page); ?></span><span></span></div>
	<select class="c-p-select" onchange="dourl('<?php echo C('site_url');?>/index.php?g=Wap&m=Index&a=lists&classid=<?php echo $_GET['classid']; ?>&token=<?php echo ($tpl["token"]); ?>&p='+this.value)">
		<?php
 for($i=1;$i<=$page;$i++){ if($i==$p){ echo '<option value="'.$i.'" selected>第'.$i.'页</option>'; }else{ echo '<option value="'.$i.'">第'.$i.'页</option>'; } } ?>
	</select>
</div>
<div class='c-p-next <?php if(($p) == $page): ?>c-p-grey<?php endif; ?>'  >

<?php
 if($p<$page){ echo '<a href="'.C('site_url').'/index.php?g=Wap&m=Index&a=lists&classid='.(int)$_GET['classid'].'&token='.$tpl['token'].'&p='.($p+1).'">'; }else{ echo '<a>'; } ?>
下一页</a><span class="c-p-p"><em></em></span></div>
</section>
</div>
</section>
</div>
<script>
function dourl(url){
location.href= url;
}
</script>
<div style="display:none"> </div>
<div style="display:none"><?php echo (htmlspecialchars_decode($tpl["tongji"])); ?></div>
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
</div> 
</body>
</html>