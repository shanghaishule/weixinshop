<include file="public:header" />
<div class="pad_lr_10" >
    
    <form name="searchform" method="get" >
    <table width="100%" cellspacing="0" class="search_form">
        <tbody>
            <tr>
            <td>
            <div class="explain_col">
            	<input type="hidden" name="g" value="admin" />
                <input type="hidden" name="m" value="badword" />
                <input type="hidden" name="a" value="index" />
                <input type="hidden" name="menuid" value="{$menuid}" />
				所属类型：
                <select name="word_type">
                        <option value="">--请选择分类--</option>
                        <option value="1" <if condition="$search.word_type eq 1"> selected="selected" </if>>禁用</option>
						<option value="2" <if condition="$search.word_type eq 2"> selected="selected" </if>>替换</option>
						<option value="3" <if condition="$search.word_type eq 3"> selected="selected" </if>>审核</option>
                </select>&nbsp;
                关键字 :
                <input name="keyword" type="text" class="input-text" size="25" value="{$search.keyword}" />
                <input type="submit" name="search" class="btn" value="搜索" />
        	</div>
            </td>
            </tr>
        </tbody>
    </table>
    </form>
    
    <div class="J_tablelist table_list" data-acturi="{:U('badword/ajax_edit')}">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
                <th width=25><input type="checkbox" id="checkall_t" class="J_checkall"></th>
                <th><span tdtype="order_by" fieldname="id">ID</span></th>
				<th align="left">敏感词</th>
                <th align="left">敏感词替换</th>
                <th align="left">敏感词类型</th>
				
				<th align="left"><span data-tdtype="order_by" data-field="add_time">添加时间</span></th>
                <th width="80">{:L('operations_manage')}</th>
            </tr>
        </thead>
    	<tbody>
            <volist name="list" id="val" >
            <tr>
                <td align="center">
                <input type="checkbox" class="J_checkitem" value="{$val.id}"></td>
                <td align="center">{$val.id}</td>
                <td align="left"><span data-tdtype="edit" data-field="badword" class="tdedit" data-id="{$val.id}">{$val.badword}</span></td>
                <td align="left"><span data-tdtype="edit" data-field="replaceword" class="tdedit" data-id="{$val.id}">{$val.replaceword}</span></td>
                <td align="left">
				<if condition="$val['word_type'] eq 1">禁用</if>
				<if condition="$val['word_type'] eq 2">替换</if>
				<if condition="$val['word_type'] eq 3">审核</if>
				</td>
				<td align="left">{$val.add_time|date='Y-m-d H:i:s',###}</td>
                <td align="center">
					<a href="javascript:;" class="J_showdialog" data-uri="{:U('badword/edit', array('id'=>$val['id']))}" data-title="{:L('edit')} - {$val.badword}"  data-id="edit" data-acttype="ajax" data-width="500" data-height="130">{:L('edit')}</a> | 
                    <a href="javascript:;" class="J_confirmurl" data-acttype="ajax" data-uri="{:U('badword/delete', array('id'=>$val['id']))}" data-msg="{:sprintf(L('confirm_delete_one'),$val['name'])}">{:L('delete')}</a>
					</td>
            </tr>
            </volist>
    	</tbody>
    </table>
</div>
	<div class="btn_wrap_fixed">
    	<label><input type="checkbox" name="checkall" class="J_checkall">{:L('select_all')}/{:L('cancel')}</label>
    	<input type="button" class="btn" data-tdtype="batch_action" data-acttype="ajax" data-uri="{:U('badword/delete')}" data-name="id" data-msg="{:L('confirm_delete')}" value="{:L('delete')}" />
    	<div id="pages">{$page}</div>
    </div>

    
</div>
<include file="public:footer" />
</body>
</html>