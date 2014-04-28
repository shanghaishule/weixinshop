<html>
<head><title>姓名和电话</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="format-detection" content="telephone=no" />
</head>
<body>
<br><br><br>
<link rel="stylesheet" href="css/shake.css" type="text/css">
<script src="{lanrain::RES}/js/date/WdatePicker.js"></script>
<?php $token=$_GET['token'];
      $tokenTall=$_GET['tokenTall'];
      ?>
<form class="form" method="post" action="go.php?token=<?=$tokenTall?>&tokenTall=<?=$token?>" target="_top" enctype="multipart/form-data">
<div class="content" style="width:320px; background:#ece9d8; margin-left:0px; border:none; margin-bottom:30px;" >

<div class="cLineB">
  <h4>编辑您的姓名和手机号码</h4></div>  
<div class="msgWrap bgfc">
 
<table class="userinfoArea" width="100%"><tbody>
<tr>
  <th valign="top"><span class="red">*</span></th>
  <td valign="top">姓名：</td>
  <td><input type="input" class="px" id="keyword" name="name" style="width:100px;height:25px"><br>
  	<span class="red">显示在大屏幕上的</span></td>
  
</tr>
<tr>
  <th valign="top"><span class="red">*</span></th>
  <td valign="top">电话号码：</td>
  <td><input type="input" class="px" id="title" name="phone" style="width:150px;height:25px"><br>

  	<span class="red">领奖时凭证</span>
  	</td>
  </tr>
<tr>
  <td class="sureVaule" valign="top" colspan=3><br><input type="submit" value="确   定"/><br><br>
  
  </td>
  
  	</td>
  </tr>
  <tr>
   <td class="sureVaule" valign="top" colspan=3>
   <a href='/Wall/vote/shake.php?token=<?=$tokenTall?>&tokenTall=<?=$token?>'><b>我已经登记过了</b></a>
   </td>
  </tr>
</tbody>
</table>
 </div> 
</div>
</form>
</body>
</html>