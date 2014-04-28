<?php
@header("Content-type: text/html; charset=utf-8");
$admin=false;
session_start();
if(isset($_SESSION['admin']) && $_SESSION['admin']=== true){
	echo "你已经成功登陆";
} else {
$_SESSION['admin'] = false;
$str="你还没登陆，无权访问";
$str.='<a href="index.php">点击这里返回</a>';
 	$str.=<<<eot
<script language="javascript" type="text/javascript">  
setTimeout("javascript:location.href='index.php'", 3000);  
</script> 
eot;
die($str);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>微信墙后台</title>
<meta name="description" content="微信墙后台">  
<meta name="keywords" content="微信墙后台"> 
<link rel="stylesheet" href="themes/css/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="themes/css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="themes/css/invalid.css" type="text/css" media="screen" />
<link rel="stylesheet" href="themes/css/main.css" type="text/css" media="screen" />
<script type="text/javascript" src="themes/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="themes/js/simpla.jquery.configuration.js"></script>
<script type="text/javascript" src="themes/js/facebox.js"></script>
<script type="text/javascript" src="themes/js/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="themes/js/jquery.datePicker.js"></script>
<script type="text/javascript" src="themes/js/jquery.date.js"></script>
<script type="text/javascript" src="themes/js/faceboxpage.js"></script>

</head>
<body>
<style>
.content-box{ width:823px;}
</style>
<style>
.content-box{ width:900px;}
</style>
<?php include "head.php";?>
    <div class="content-box">
      <!-- Start Content Box -->
      <div class="content-box-header">
        <h3>投票管理</h3>
		<ul class="content-box-tabs">
          <li><a href="#tab1" class="default-tab">更新信息</a></li>
		  <li><a href="#tab2">查看最新数据</a></li>
          <!-- href must be unique and match the id of target div -->
        </ul>
        <div class="clear"></div>

      </div>
      <!-- End .content-box-header -->
      <div class="content-box-content">
	  
        <div class="tab-content default-tab" id="tab1">
		<form method="post" enctype="multipart/form-data">
            <fieldset>
            <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
            <?php
		   include("db.php");
		   $sql1="SELECT * FROM  `weixin_vote`";
			$query1=mysql_query($sql1,$link) or die(mysql_error());
			while($q=mysql_fetch_row($query1)){
			?>
			<p>
              <label><?=$q[0]?>号选手</label>
              <input class="text-input small-input" value="<?=$q[1]?>" type="text" id="small-input" name="xsname[]" />
              <!-- Classes for input-notification: success, error, information, attention -->
              <br />
            </p>
			<?php } ?>
            </fieldset>
           
              <input class="button" type="submit" value="保存" />
              
           </form>
            <div class="clear"></div>
            <!-- End .clear -->
			
        </div>
		<div class="tab-content" id="tab2">
            <p><a href="<?=$weixin_wxq?>">点击查看得票情况</a></p>
			<?php
		   include("db.php");
		   $sql1="SELECT * FROM  `weixin_vote`  order by `res` desc";
			$query1=mysql_query($sql1,$link) or die(mysql_error());
			$n=0;
			while($q=mysql_fetch_row($query1)){
			?>
			<p><h4><?=$q[0]?>号选手【<span style="color:#F00; font-weight:bold"><?=$q[2]?></span>】票</h4></p>
			<?php } ?>
		</div>
        <!-- End #tab2 -->
      </div>
      <!-- End .content-box-content -->
    </div>

    <div class="clear"></div>
    <!-- Start Notifications -->

<script>
	leftModou.leftCur("#shenhe");
	leftModou.leftCur("#up");
</script>

    <!-- End #footer -->
  </div>
  <!-- End #main-content -->
</div>
