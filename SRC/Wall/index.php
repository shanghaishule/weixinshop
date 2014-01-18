<?php

/*第一步 微信公众平台登陆*/

/*配置开始*/
header("content-Type: text/html; charset=utf-8");
echo "<a href='./myadmin/index.php'>进入后台</a><br>";
echo "<a href='./weixin/index.php'>微信接口：token是:wall</a><br>";
echo "<a href='./vote/index.php'>投票系统</a><br>";
echo "<a href='./cj/index.php'>抽奖功能</a><br>";
echo "<a href='./1.php'>采集区域激活到数据库</a><br>";
echo "<a href='./wall/index.php'>微信墙（需先到后台审核后才能上墙）</a><br>";
$aa=<<<si
  <center><strong>使用说明<br/></strong><span style="color:red">
  第一步将安装包上传到到你的bea<br/>第二步配置file.php 中的数据 <br/>第三步配置config.php中的数据<br/>
  第四步修改weixin/index.php中122行 的地址（就是你1.php中的地址）<br/>
    第六步将SQL文件夹的表单上传到你的数据库</span><br>
  第七步访问后台即可使用</span><br>（其它功能需自己开发，本源码只是一个示例demo<br/>
  可根据采集的源码开发出更多的功能<br/>只能帮你到这了）</center><br>
  更新说明:<br>
  新增微信墙，自动审核，手动审核模式<br>
  关注时可以采集用户数据需自己开发保 变量名在weixin/sub1.php<br>
  当打开或手动刷新网页时数据是从最新的4条开始实时更新，不用担心网页卡死问题了，手动刷新也不会从头开始联系QQ1402612547<br>
  
si;
echo $aa; 