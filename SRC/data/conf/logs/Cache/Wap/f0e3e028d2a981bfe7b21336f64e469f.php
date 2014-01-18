<?php if (!defined('THINK_PATHSLAPP')) exit();?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($info["title"]); ?></title>
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta charset="utf-8">
<link href="<?php echo RES;?>/css/Photo/css/photo.css" rel="stylesheet" type="text/css" />
<link href="<?php echo RES;?>/css/Photo/css/photoswipe.css" type="text/css" rel="stylesheet" />
<script src="<?php echo RES;?>/css/Photo/js/klass.min.js" type="text/javascript"></script>
<script src="<?php echo RES;?>/css/Photo/js/code.photoswipe-3.0.5.min.js" type="text/javascript"></script>
<script type="text/javascript">
(function(window, PhotoSwipe){
document.addEventListener('DOMContentLoaded', function(){
var
options = {},
instance = PhotoSwipe.attach( window.document.querySelectorAll('#Gallery a'), options );
}, false);
}(window, window.Code.PhotoSwipe));
</script>
</head>

<body id="photo">
<div class="qiandaobanner"> <a ><img src="<?php echo RES;?>/css/Photo/banner.jpg" ></a> </div>
<div  id="main" role="main">
      <ul id="Gallery" class="gallery">
        <?php if(is_array($photo)): $i = 0; $__LIST__ = $photo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$photo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($photo["picurl"]); ?>"><img src="<?php echo ($photo["picurl"]); ?>" alt="  "></a>
		
		</li><?php endforeach; endif; else: echo "" ;endif; ?>
        
   
      </ul>
</div>

<!--jquery.min-->
<script src="<?php echo RES;?>/css/Photo/js/jquery.min.js" type="text/javascript"></script>
<!--下面是瀑布流js-->
<script src="<?php echo RES;?>/css/Photo/js/jquery.imagesloaded.js" type="text/javascript"></script>
<script src="<?php echo RES;?>/css/Photo/js/jquery.wookmark.min.js" type="text/javascript"></script>
<script type="text/javascript">
    (function ($){
      $('#Gallery').imagesLoaded(function() {
        // Prepare layout options.
        var options = {
          autoResize: true, // This will auto-update the layout when the browser window is resized.
          container: $('#main'), // Optional, used for some extra CSS styling
          offset: 4, // Optional, the distance between grid items
          itemWidth: 150 // Optional, the width of a grid item
        };

        // Get a reference to your grid items.
        var handler = $('#Gallery li');

        // Call the layout function.
        handler.wookmark(options);

       
      });
    })(jQuery);
  </script>
</body>
</html>