<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<link href="__STATIC__/css/admin/style.css" rel="stylesheet"/>
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

<body>
<div id="J_ajax_loading" class="ajax_loading"><?php echo L('ajax_loading');?></div>
<?php if(($sub_menu != '') OR ($big_menu != '')): ?><div class="subnav">
    <div class="content_menu ib_a blue line_x">
    	<?php if(!empty($big_menu)): ?><a class="add fb J_showdialog" href="javascript:void(0);" data-uri="<?php echo ($big_menu["iframe"]); ?>" data-title="<?php echo ($big_menu["title"]); ?>" data-id="<?php echo ($big_menu["id"]); ?>" data-width="<?php echo ($big_menu["width"]); ?>" data-height="<?php echo ($big_menu["height"]); ?>"><em><?php echo ($big_menu["title"]); ?></em></a>　<?php endif; ?>
        <?php if(!empty($sub_menu)): if(is_array($sub_menu)): $key = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($key % 2 );++$key; if($key != 1): ?><span>|</span><?php endif; ?>
        <a href="<?php echo U($val['module_name'].'/'.$val['action_name'],array('menuid'=>$menuid)); echo ($val["data"]); ?>" class="<?php echo ($val["class"]); ?>"><em><?php echo L($val['name']);?></em></a><?php endforeach; endif; else: echo "" ;endif; endif; ?>
    </div>
</div><?php endif; ?>
<!--注册登陆-->
<div class="subnav">
    <h1 class="title_2 line_x">注册登陆</h1>
</div>
<div class="pad_lr_10">
	<form id="info_form" action="<?php echo u('setting/edit');?>" method="post">
	<table width="100%" class="table_form">
        <tr>
            <th width="150">用户注册 :</th>
            <td>
                <label class="mr10"><input type="radio" class="J_change_status" <?php if(C('pin_reg_status') == '1'): ?>checked="checked"<?php endif; ?> value="1" name="setting[reg_status]"> <?php echo L('open');?></label>
                <label><input type="radio" class="J_change_status" <?php if(C('pin_reg_status') == '0'): ?>checked="checked"<?php endif; ?> value="0" name="setting[reg_status]"> <?php echo L('close');?></label>
            </td>
        </tr>
        <tr id="J_closed_reason" <?php if(C('pin_reg_status') == 1): ?>class="hidden"<?php endif; ?>>
            <th>关闭注册原因 :</th>
            <td><textarea rows="2" cols="40" name="setting[reg_closed_reason]"><?php echo C('pin_reg_closed_reason');?></textarea></td>
        </tr>
       <!-- <tr>
            <th><?php echo L('user_intro_default');?> :</th>
            <td><input type="text" name="setting[user_intro_default]" class="input-text" value="<?php echo C('pin_user_intro_default');?>" size="40" /></td>
        </tr>
        <tr>
            <th><?php echo L('reg_protocol');?> :</th>
            <td><textarea rows="3" cols="80" name="setting[reg_protocol]"><?php echo C('pin_reg_protocol');?></textarea></td>
        </tr>-->
        <tr>
        	<th></th>
        	<td>
                <input type="hidden" name="menuid"  value="<?php echo ($menuid); ?>"/>
                <input type="submit" class="btn btn_submit" value="<?php echo L('submit');?>"/>
            </td>
    	</tr>
	</table>
	</form>
</div>
<script src="__STATIC__/js/jquery/jquery.js"></script>
<script src="__STATIC__/js/jquery/plugins/jquery.tools.min.js"></script>
<script src="__STATIC__/js/jquery/plugins/formvalidator.js"></script>
<script src="__STATIC__/js/pinphp.js"></script>
<script src="__STATIC__/js/admin.js"></script>
<script>
//初始化弹窗
(function (d) {
    d['okValue'] = lang.dialog_ok;
    d['cancelValue'] = lang.dialog_cancel;
    d['title'] = lang.dialog_title;
})($.dialog.defaults);
</script>

<?php if(isset($list_table)): ?><script src="__STATIC__/js/jquery/plugins/listTable.js"></script>
<script>
$(function(){
	$('.J_tablelist').listTable();
});
</script><?php endif; ?>
<script>
$(function(){
    $('.J_change_status').live('click', function(){
        if($(this).val() == '0'){
            $('#J_closed_reason').fadeIn();
        }else{
            $('#J_closed_reason').fadeOut();
        }
    });
});
</script>
</body>
</html>