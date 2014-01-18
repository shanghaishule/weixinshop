<include file="public:header" />
<!--短消息模版列表-->
<div class="pad_lr_10" >
    <form name="searchform" method="get" >
    <table width="100%" cellspacing="0" class="search_form">
        <tbody>
            <tr>
                <td>
                <div class="explain_col">
                    <input type="hidden" name="g" value="admin" />
                    <input type="hidden" name="m" value="message_tpl" />
                    <input type="hidden" name="a" value="index" />
                    <input type="hidden" name="menuid" value="{$menuid}" />
                    &nbsp;关键字 :
                    <input name="keyword" type="text" class="input-text" size="25" value="{$search.keyword}" />
                    <input type="submit" name="search" class="btn" value="搜索" />
                </div>
                </td>
            </tr>
        </tbody>
    </table>
    </form>

    <div class="J_tablelist table_list" data-acturi="{:U('message_tpl/ajax_edit')}">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
                <th width="25"><input type="checkbox" id="checkall_t" class="J_checkall"></th>
                <th width="120"><span data-tdtype="order_by" data-field="alias">标识</span></th>
                <th align="left"><span data-tdtype="order_by" data-field="name">名称</span></th>
                
                <th width="100">{:L('operations_manage')}</th>
            </tr>
        </thead>
    	<tbody>
            <volist name="list" id="val" >
            <tr>
                <td align="center">
                <if condition="$val['is_sys'] eq 1"><else />
                <input type="checkbox" class="J_checkitem" value="{$val.id}">
                </if>
                </td>
                <td align="center">{$val.alias}</td>
                <td><span data-tdtype="edit" data-field="name" data-id="{$val.id}" class="tdedit">{$val.name}</span></td>
                <td align="center">
                <a href="{:u('message_tpl/edit', array('id'=>$val['id'], 'menuid'=>$menuid))}" >编辑</a> <if condition="$val['is_sys'] eq 1"><else />| <a href="javascript:void(0);" class="J_confirmurl" data-uri="{:u('message_tpl/delete', array('id'=>$val['id']))}" data-acttype="ajax" data-msg="{:sprintf(L('confirm_delete_one'),$val['username'])}">{:L('delete')}</a></if></td>
            </tr>
            </volist>
    	</tbody>
    </table>
    <div class="btn_wrap_fixed">
        <label class="select_all"><input type="checkbox" name="checkall" class="J_checkall">{:L('select_all')}/{:L('cancel')}</label>
        <input type="button" class="btn" data-tdtype="batch_action" data-acttype="ajax" data-uri="{:U('message_tpl/delete')}" data-name="id" data-msg="{:L('confirm_delete')}" value="{:L('delete')}" />
        <div id="pages">{$page}</div>
    </div>

    </div>
</div>
<include file="public:footer" />
</body>
</html>