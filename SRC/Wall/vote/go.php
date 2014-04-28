<html>
<head><title>姓名和电话</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="format-detection" content="telephone=no" />
</head>
<body>
<?php
    include("db.php");
    $tokenTall=$_GET['tokenTall']; 
    $token=$_GET['token'];
    $name=$_POST['name'];
    $tel=$_POST['phone'];
    if($tel != '' and $name != ''){
        $sql = "update tp_weixin_vote set name='".$name."' , tel='".$tel."' where token='".$tokenTall."'";
        if($query2=mysql_query($sql,$link)){
         echo "登录中....";
         echo "<script language='javascript'>";
         echo "location.href='/Wall/vote/shake.php?token=".$token."&tokenTall=".$tokenTall."'";
         echo "</script>";
        }else{
           echo "系统故障！<a href='javascript:history.go(-1);' class='right btnGrayS vm' style='margin-top:-27px'>返回</a>";
        }
    }else{
        echo "请填写完整！<a href='javascript:history.go(-1);' class='right btnGrayS vm' style='margin-top:-27px'>返回</a>";
        }
           
?>
</body>
</html>