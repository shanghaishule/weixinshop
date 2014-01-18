<?php if (!defined('THINK_PATHSLAPP')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>权限设置</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel='stylesheet' type='text/css' href='<?php echo STATICS;?>/treetable/admin_style.css' />
	<script type="text/javascript" src="<?php echo STATICS;?>/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo STATICS;?>/treetable/jquery.treetable.js"></script>
	<link rel='stylesheet' type='text/css' href='<?php echo STATICS;?>/treetable/css/jquery.treeTable.css' />
</head>
<body>
	<form action="<?php echo U('Group/access_edit');?>" method="POST">
		<input type="hidden" name="roleid" value="<?php echo ($_GET['roleid']); ?>" />
		<table id="tree" width="100%" border="0" cellpadding="4" cellspacing="1" class="table">
			<?php echo ($html_tree); ?>
			<tr class="tr lt">
				<td>
					<input class="bginput" type="submit" name="dosubmit" value="提 交" ></td>
			</tr>
		</table>
	</form>
</body>
	<script type="text/javascript">
  $(document).ready(function() {
  	//树配置
    $("#tree").treeTable({
    	expandable: true,
    });

   });

function checknode(obj)
  {
      var chk = $("input[type='checkbox']");
      var count = chk.length;
      var num = chk.index(obj);
      var level_top = level_bottom =  chk.eq(num).attr('level')
      for (var i=num; i>=0; i--)
      {
              var le = chk.eq(i).attr('level');
              if(eval(le) < eval(level_top)) 
              {
                  chk.eq(i).attr("checked",'checked');
                  var level_top = level_top-1;
              }
      }
      for (var j=num+1; j<count; j++)
      {
              var le = chk.eq(j).attr('level');
              if(chk.eq(num).attr("checked")=='checked') {
                  if(eval(le) > eval(level_bottom)) chk.eq(j).attr("checked",'checked');
                  else if(eval(le) == eval(level_bottom)) break;
              }
              else {
                  if(eval(le) > eval(level_bottom)) chk.eq(j).attr("checked",false);
                  else if(eval(le) == eval(level_bottom)) break;
              }
      }
  }
</script>
</html>