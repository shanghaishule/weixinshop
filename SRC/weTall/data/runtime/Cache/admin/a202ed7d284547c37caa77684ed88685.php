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
<!--商品列表-->
<div class="pad_lr_10" >
    <form name="searchform" method="get" >
    <table width="100%" cellspacing="0" class="search_form">
        <tbody>
            <tr>
                <td>
                <div class="explain_col">
                    <input type="hidden" name="g" value="admin" />
                    <input type="hidden" name="m" value="item_order" />
                    <input type="hidden" name="a" value="index" />
                    <input type="hidden" name="menuid" value="<?php echo ($menuid); ?>" />
                     订单编号 :
                    <input name="orderId" type="text" class="input-text" size="25" value="<?php echo ($search["orderId"]); ?>" />
                   &nbsp;&nbsp; 会员名 :
                    <input name="userName" type="text" class="input-text" size="25" value="<?php echo ($search["userName"]); ?>" />
                    &nbsp;&nbsp; 订单状态 :
                    <select name="status">
                    <option value="">--所有--</option>
                   <?php foreach($order_status as $key=>$item){ ?>
                   <option <?php if($search['status']==$key) echo "selected=''"; ?> value="<?php echo $key; ?>"><?php echo $item; ?></option>
                    <?php } ?>
                    
                    </select>
                    <br>
					<?php if($sm != ''): ?><input type="hidden" name="sm" value="<?php echo ($sm); ?>" /><?php endif; ?>
                    下单时间 :
                    <input type="text" name="time_start" id="J_time_start" class="date" size="12" value="<?php echo ($search["time_start"]); ?>">
                    -
                    <input type="text" name="time_end" id="J_time_end" class="date" size="12" value="<?php echo ($search["time_end"]); ?>">
                    付款时间 :
                    <input type="text" name="start_support_time" id="J_time_start_support" class="date" size="12" value="<?php echo ($search["start_support_time"]); ?>">
                    -
                    <input type="text" name="end_support_time" id="J_time_end_support" class="date" size="12" value="<?php echo ($search["end_support_time"]); ?>">
                   

                    订单价格区间 :
                    <input type="text" name="price_min" class="input-text" size="5" value="<?php echo ($search["price_min"]); ?>" />
                    -
                    <input type="text" name="price_max" class="input-text" size="5" value="<?php echo ($search["price_max"]); ?>" />
					
					

                    
                    <input type="submit" name="search" class="btn" value="搜索" />
					
                </div>
                </td>
            </tr>
        </tbody>
    </table>
    </form>
   
    <div class="J_tablelist table_list" data-acturi="<?php echo U('item/ajax_edit');?>">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
                <th width=25><input type="checkbox" id="checkall_t" class="J_checkall"></th>
                <th width="100"><span data-tdtype="order_by" data-field="id">ID</span></th>
                <th width="100"><span data-tdtype="order_by" data-field="orderId">订单编号&状态</span></th>
                <th width="70"><span data-tdtype="order_by" data-field="order_sumPrice">订单金额</span></th>
                <th width="60">收货人&电话</span></th>
                <th width="70">支付&配送</span></th>
                <th width="40"><span data-tdtype="order_by" data-field="add_time">下单&付款时间 </span></th>
                <th width="80"><?php echo L('operations_manage');?></th>
            </tr>
        </thead>
    	<tbody>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr>
                <td align="center"><input type="checkbox" class="J_checkitem" value="<?php echo ($val["id"]); ?>"></td>
                <td align="center"><?php echo ($val["id"]); ?></td>
       
                <td align="center"><a href="<?php echo u('item_order/edit', array('id'=>$val['id'], 'menuid'=>$menuid));?>"><?php echo ($val["orderId"]); ?></a><br> 
               <?php if($val["sellerRemark"] != ''): ?><a title="【客服备注】<?php echo ($val["sellerRemark"]); ?>">
                <img src="__STATIC__/weixin/images/remark.gif" >
               </a><?php endif; ?>
                     <?php switch($val["status"]): case "1": ?>待付款<?php break;?>
                         <?php case "2": ?>待发货<?php break;?>
                         <?php case "3": ?>待收货<?php break;?>
                         <?php case "4": ?>完成<?php break;?>
                        <?php default: ?>关闭<?php endswitch;?>
                 </td>
               <td align="center"><b style="color:red">¥<?php echo ($val["order_sumPrice"]); ?></b></td>
                <td align="center"><?php echo ($val["address_name"]); ?>(<?php echo ($val["userName"]); ?>)<br><?php echo ($val["mobile"]); ?></td>
               
                <td align="center" >
                   <?php switch($val["supportmetho"]): case "1": ?>支付宝支付<?php break;?>
                         <?php case "2": ?>货到付款<?php break; endswitch;?>
                 <br>
                  <?php switch($val["freetype"]): case "1": ?>平邮<?php break;?>
                         <?php case "2": ?>快递<?php break;?>  
                         <?php case "3": ?>ems<?php break;?>  
                          <?php case "0": ?>卖家包邮<?php break; endswitch;?>
                </td> 
                <td align="center"><?php echo (date('Y-m-d H:i:s',$val["add_time"])); ?>--<br><?php if($val["support_time"] != '' ): echo (date('Y-m-d H:i:s',$val["support_time"])); endif; ?></td>
                <td align="center"><a href="<?php echo u('item_order/edit', array('id'=>$val['id'], 'menuid'=>$menuid));?>">查看</a>| <a href="javascript:void(0);" class="J_confirmurl" data-uri="<?php echo u('item_order/delete', array('id'=>$val['id']));?>" data-acttype="ajax" data-msg="<?php echo sprintf(L('confirm_delete_one'),$val['orderId']);?>"><?php echo L('delete');?></a> </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    	</tbody>
    </table>
    </div>
   
    <div class="btn_wrap_fixed">
      <label class="select_all mr10"><input type="checkbox" name="checkall" class="J_checkall"><?php echo L('select_all');?>/<?php echo L('cancel');?></label>
        <input type="button" class="btn" data-tdtype="batch_action" data-acttype="ajax" data-uri="<?php echo U('item_order/delete');?>" data-name="id" data-msg="<?php echo L('confirm_delete');?>" value="<?php echo L('delete');?>" />
        <div id="pages"><?php echo ($page); ?></div>
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
<link rel="stylesheet" href="__STATIC__/js/calendar/calendar-blue.css"/>
<script src="__STATIC__/js/calendar/calendar.js"></script>
<script>
Calendar.setup({
	inputField : "J_time_start",
	ifFormat   : "%Y-%m-%d",
	showsTime  : false,
	timeFormat : "24"
});
Calendar.setup({
	inputField : "J_time_end",
	ifFormat   : "%Y-%m-%d",
	showsTime  : false,
	timeFormat : "24"
});
Calendar.setup({
	inputField : "J_time_start_support",
	ifFormat   : "%Y-%m-%d",
	showsTime  : false,
	timeFormat : "24"
});
Calendar.setup({
	inputField : "J_time_end_support",
	ifFormat   : "%Y-%m-%d",
	showsTime  : false,
	timeFormat : "24"
});

$('.J_preview').preview(); //查看大图
$('.J_cate_select').cate_select({top_option:lang.all}); //分类联动
$('.J_tooltip[title]').tooltip({offset:[10, 2], effect:'slide'}).dynamic({bottom:{direction:'down', bounce:true}});
</script>
</body>
</html>