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

<body><BR><BR>
<!--鏍忕洰鍒楄〃-->
<div class="pad_lr_10">
    <div class="J_tablelist table_list" data-acturi="<?php echo U('item_cate/ajax_edit');?>"> 
    <table width="100%" cellspacing="0" id="J_cate_tree">
        <thead>
            <tr>
                <!-- <th width="30"><input type="checkbox" name="checkall" class="J_checkall"></th> -->
                <th width="30"><span data-tdtype="order_by" data-field="id">ID</span></th>
                <th><?php echo L('item_cate_name');?></th>
                <th width="100"><?php echo L('item_cate_img');?></th>
                <th width="80"><span data-tdtype="order_by" data-field="type"><?php echo L('item_cate_type');?></span></th>
              	<th width="60"><span data-tdtype="order_by" data-field="ordid"><?php echo L('sort_order');?></span></th>
                <th width="60"><span data-tdtype="order_by" data-field="index"><?php echo L('show_index');?></span></th>
				<th width="60"><span data-tdtype="order_by" data-field="status"><?php echo L('status');?></span></th>
                 <th width="180"><?php echo L('operations_manage');?></th>
            </tr>
        </thead>
    	<tbody>
        <?php echo ($list); ?>
    	</tbody>
    </table>
    </div>
    <div class="btn_wrap_fixed">
        <label class="select_all mr10"><input type="checkbox" name="checkall" class="J_checkall"><?php echo L('select_all');?>/<?php echo L('cancel');?></label>
        <input type="button" class="btn btn_submit" data-tdtype="batch_action" data-acttype="ajax_form" data-id="move" data-uri="<?php echo U('item_cate/move');?>" data-name="id" data-title="<?php echo L('item_cate_move');?>" value="<?php echo L('move');?>" /> 
        <input type="button" class="btn" data-tdtype="batch_action" data-acttype="ajax" data-uri="<?php echo U('item_cate/delete');?>" data-name="id" data-msg="<?php echo L('confirm_delete');?>" value="<?php echo L('delete');?>" />
    </div>
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
<script src="__STATIC__/js/jquery/plugins/jquery.treetable.js"></script>
<script>
$(function(){
    //initialState:'expanded'
    $("#J_cate_tree").treeTable({indent:20,treeColumn:2});
    $(".J_preview").preview();
});        
</script> 
</body>
</html>