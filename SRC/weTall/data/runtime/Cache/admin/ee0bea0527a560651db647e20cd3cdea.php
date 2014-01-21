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
<!--网站设置-->
<div class="pad_lr_10">
	<form id="info_form" action="<?php echo u('setting/edit');?>" method="post" enctype="multipart/form-data">
	<table width="100%" class="table_form">
        <tr>
            <th width="150"><?php echo L('site_name');?> :</th>
            <td><input type="text" name="setting[site_name]" class="input-text" size="50" value="<?php echo C('pin_site_name');?>"></td>
        </tr>
        <tr>
            <th><?php echo L('seo_title');?> :</th>
            <td><input type="text" name="setting[site_title]" class="input-text" size="50" value="<?php echo C('pin_site_title');?>"></td>
        </tr>
        <tr>
            <th><?php echo L('seo_keys');?> :</th>
            <td><input type="text" name="setting[site_keyword]" class="input-text" size="50" value="<?php echo C('pin_site_keyword');?>"></td>
        </tr>
        <tr>
            <th><?php echo L('seo_desc');?> :</th>
            <td><textarea rows="3" cols="50" name="setting[site_description]"><?php echo C('pin_site_description');?></textarea></td>
        </tr>
         <tr>
            <th>微信公众号二维码 :</th>
            <td>
            <?php if(C('pin_weixin_img')!=''){ ?>
            <img src="<?php echo attach(get_thumb(C('pin_weixin_img'), ''), 'weixin'); ?>" width="100" height="100"/><br />
            <?php }else{ ?>
            <?php } ?>
  	<input type="file" name="weixin_img" /></td>
        </tr>
         <tr>
            <th>微信公商城二维码 :</th>
            <td>
            <?php if(C('pin_weixinshop_img')!=''){ ?>
            <img src="<?php echo attach(get_thumb(C('pin_weixinshop_img'), ''), 'weixin'); ?>" width="100" height="100"/><br />
            <?php }else{ ?>
            <?php } ?>
  	<input type="file" name="weixinshop_img" /></td>
        </tr>
        	
       <!-- <tr>
            <th><?php echo L('site_icp');?> :</th>
            <td><input type="text" name="setting[site_icp]" class="input-text" size="50" value="<?php echo C('pin_site_icp');?>"></td>
        </tr>
        <tr>
            <th><?php echo L('statistics_code');?> :</th>
            <td><textarea rows="3" cols="50" name="setting[statistics_code]"><?php echo C('pin_statistics_code');?></textarea></td>
        </tr>-->
    	<tr>
        	<th><?php echo L('site_status');?> :</th>
        	<td>
            	<label><input type="radio" class="J_change_status" <?php if(C('pin_site_status') == '1'): ?>checked="checked"<?php endif; ?> value="1" name="setting[site_status]"> <?php echo L('open');?></label> &nbsp;&nbsp;
                <label><input type="radio" class="J_change_status" <?php if(C('pin_site_status') == '0'): ?>checked="checked"<?php endif; ?> value="0" name="setting[site_status]"> <?php echo L('close');?></label>
            </td>
    	</tr>
        <tr id="J_closed_reason" <?php if(C('pin_site_status') == 1): ?>class="hidden"<?php endif; ?>>
        	<th><?php echo L('closed_reason');?> :</th>
        	<td><textarea rows="4" cols="50" name="setting[closed_reason]" id="closed_reason"><?php echo C('pin_closed_reason');?></textarea></td>
    	</tr>
        <tr>
        	<th></th>
        	<td><input type="hidden" name="menuid"  value="<?php echo ($menuid); ?>"/><input type="submit" class="btn btn_submit" value="<?php echo L('submit');?>"/></td>
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