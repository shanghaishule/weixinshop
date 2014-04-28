<include file="public:header" />
<!--站内信列表-->
<div <notempty name="big_menu">class="pad_lr_10"<else/>class="pad_10"</notempty> >
    <form name="searchform" method="get" >
    <table width="100%" cellspacing="0" class="search_form">
        <tbody>
            <tr>
                <td>
                <div class="explain_col">
                    <input type="hidden" name="g" value="admin" />
                    <input type="hidden" name="m" value="message" />
                    <input type="hidden" name="a" value="index" />
                    <input type="hidden" name="menuid" value="{$menuid}" />
                    发送时间：
                    <input type="text" name="time_start" id="time_start" class="date" size="12" value="{$search.time_start}">
                    -
                    <input type="text" name="time_end" id="time_end" class="date" size="12" value="{$search.time_end}">
					<if condition="$type eq 2">
                    &nbsp;发送者 :
                    <input name="from_name" id="from_name" type="text" class="input-text" size="15" value="{$search.from_name}" />
                    </if>
					&nbsp;接收者 :
                    <input name="to_name" id="to_name" type="text" class="input-text" size="15" value="{$search.to_name}" />
                    &nbsp;关键字 :
                    <input name="keyword" type="text" class="input-text" size="25" value="{$search.keyword}" />
                    <input type="hidden" name="type" value="{$search.type}" />
                    <input type="submit" name="search" class="btn" value="搜索" />
                </div>
                </td>
            </tr>
        </tbody>
    </table>
    </form>

    <div class="J_tablelist table_list" data-acturi="{:U('message/ajax_edit')}">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
                <th width=25><input type="checkbox" id="checkall_t" class="J_checkall"></th>
                <th width="150"><span data-tdtype="order_by" data-field="from_id">发信人</span></th>
                <th width="150"><span data-tdtype="order_by" data-field="to_id">收信人</span></th>
                <th>信息内容</th>
                <th width="140"><span data-tdtype="order_by" data-field="add_time">发送时间</span></th>
                <if condition="$type eq 2">
				<th width="80"><span data-tdtype="order_by" data-field="status">{:L('status')}</span></th>
				</if>
                <th width="80">{:L('operations_manage')}</th>
            </tr>
        </thead>
    	<tbody>
            <volist name="list" id="val">
            <tr>
                <td align="center"><input type="checkbox" class="J_checkitem" value="{$val.id}"></td>
                <td align="center">{$val.from_name}</td>
                <td align="center"><if condition="$val['to_id'] eq 0">所有会员<else />{$val.to_name}</if></td>
                <td align="left">{$val.info|strip_tags}</td><!--|msubstr=0,26-->
                <td align="center">{$val.add_time|date='Y-m-d H:i:s',###}</td>  
                <if condition="$type eq 2">
				<td align="center">
				    <if condition="$val['status'] eq 3"><span class="strike gray">已删(接受者)</span><elseif condition="$val['status'] eq 2" /><span class="strike gray">已删(发送者)</span><elseif condition="$val['status'] eq 1">已读<else/><span class="red">未读</span></if>
				</td>
				</if>
                <td align="center"><a href="javascript:void(0);" class="J_confirmurl" data-uri="{:u('message/delete', array('id'=>$val['id']))}" data-acttype="ajax" data-msg="{:sprintf(L('confirm_delete_one'),$val['form_name'])}">{:L('delete')}</a></td>
            </tr>
            </volist>
    	</tbody>
    </table>
	</div>
    <div class="btn_wrap_fixed">
        <label class="select_all"><input type="checkbox" name="checkall" class="J_checkall">{:L('select_all')}/{:L('cancel')}</label>
        <input type="button" class="btn" data-tdtype="batch_action" data-acttype="ajax" data-uri="{:U('message/delete')}" data-name="id" data-msg="{:L('confirm_delete')}" value="{:L('delete')}" />
        <div id="pages">{$page}</div>
    </div>
</div>
<include file="public:footer" />
<link rel="stylesheet" type="text/css" href="__STATIC__/js/calendar/calendar-blue.css"/>
<script type="text/javascript" src="__STATIC__/js/calendar/calendar.js"></script>
<script>
Calendar.setup({
	inputField : "time_start",
	ifFormat   : "%Y-%m-%d",
	showsTime  : false,
	timeFormat : "24"
});
Calendar.setup({
	inputField : "time_end",
	ifFormat   : "%Y-%m-%d",
	showsTime  : false,
	timeFormat : "24"
});
</script>
</body>
</html>
