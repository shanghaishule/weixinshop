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
	
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=<?php echo $apikey;?>"></script>
<div class="main">
	<div class="p_map">
    <div id="container"></div>
        <script type="text/javascript">
        $(function(){
        	var wh = $(window).height();
        	var bh = $('body').height();
        	var mh = $('#container').css('height');
        	mh = mh.replace('px', '');
        	oh = bh - wh;
        	nmh = mh - oh;
        	$('#container').css('height', nmh+'px');
        
        	var sContent = function(id, name, imgsrc, address, tel){
        		return "<h2 style='margin:0 0 7px 0;padding:0 0'>"+name+"</h2>" + 
        		"<img style='float:right;margin:0px 0px 0px 4px' id='imgDemo' src='"+imgsrc+"' width='120' height='80' />" + 
        		"<p style='padding-right:10px'>地址："+address+"</p>" +
        		"<p style=''>电话："+tel+"</p>" +
        		"" +
        		"</div>";
        	}
        	var storeList = [{"id":"<?php echo $thisCompany['id'];?>","name":"<?php echo $thisCompany['name'];?>","logourl":"<?php echo $thisCompany['logourl'];?>","address":"<?php echo $thisCompany['address'];?>","tel":"<?php echo $thisCompany['tel'];?>","longitude":"<?php echo $thisCompany['longitude'];?>","latitude":"<?php echo $thisCompany['latitude'];?>"}<?php if(is_array($branchStores)): $i = 0; $__LIST__ = $branchStores;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$c): $mod = ($i % 2 );++$i;?>,{"id":"<?php echo $c['id'];?>","name":"<?php echo $c['name'];?>","logourl":"<?php echo $c['logourl'];?>","address":"<?php echo $c['address'];?>","tel":"<?php echo $c['tel'];?>","longitude":"<?php echo $c['longitude'];?>","latitude":"<?php echo $c['latitude'];?>"}<?php endforeach; endif; else: echo "" ;endif; ?>];
        	// 编写自定义函数,创建标注
        	function addMarker(point, content){
        	  var marker = new BMap.Marker(point);  // 创建标注
        	  map.addOverlay(marker);
        	  var infoWindow = new BMap.InfoWindow(content);
        	  marker.addEventListener("click", function(){          
        		   this.openInfoWindow(infoWindow);
        		   //图片加载完毕重绘infowindow
        		   document.getElementById('imgDemo').onload = function (){
        		       infoWindow.redraw();
        		   }
        		});
        	}
        	var map = new BMap.Map("container");
        	var point = new BMap.Point(<?php echo $thisCompany['longitude'];?>, <?php echo $thisCompany['latitude'];?>);
        	map.centerAndZoom(point, 13);
        	var user_marker = new BMap.Marker(point);  // 创建标注
        	map.addOverlay(user_marker);
            	   
        	for (var i = 0, l=storeList.length; i < l; i ++) {
        	  var point = new BMap.Point(storeList[i].longitude, storeList[i].latitude);
        	  var content = sContent(storeList[i].id,storeList[i].name,storeList[i].logourl,storeList[i].address,storeList[i].tel);
        	  addMarker(point, content);
        	}

        });
        </script>
	</div>
</div>
</body>
</html>