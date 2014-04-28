<include file="public:header" />
<div class="pad_10">
    <form action="{:U('admin_role/auth')}" method="post">
    <div class="J_tablelist table_list">
    <table width="100%" cellspacing="0" id="J_auth_tree">
    	<thead>
        	<tr><th align="left">{:L('role_auth')} - {$role.name}</th></tr>
        </thead>
    	<tbody>
        	{$list}
    	</tbody>
    </table>
    <input type="hidden" name="id" value="{$role.id}"></input>
    <div>
    
    <div class="btn_wrap_fixed">
    	<label class="select_all"><input type="checkbox" name="checkall" class="J_checkall">{:L('select_all')}/{:L('cancel')}</label>
        <input type="submit" class="btn" name="dosubmit" value="{:L('submit')}"/>
    </div>
    </form>
</div>
<include file="public:footer" />
<script src="__STATIC__/js/jquery/plugins/jquery.treetable.js"></script>
<script>
$(function() {
    $("#J_auth_tree").treeTable({indent:20});

    $('.J_checkall').live('click', function(){
        $('.J_checkitem').attr('checked', this.checked);
        $('.J_checkall').attr('checked', this.checked);
    });

    $('.J_checkitem').live('click', function(){
        var chk = $("input[type='checkbox']"),
            count = chk.length,
            num = chk.index($(this)),
            level_top = level_bottom =  chk.eq(num).attr('level');
        for(var i=num; i>=0; i--){
            var le = chk.eq(i).attr('level');
            if(eval(le) < eval(level_top)){
                chk.eq(i).attr("checked", true);
                var level_top = level_top-1;
            }
        }
        for(var j=num+1; j<count; j++){
            var le = chk.eq(j).attr('level');
            if(chk.eq(num).attr("checked")) {
                if(eval(le) > eval(level_bottom)) chk.eq(j).attr("checked", true);
                else if(eval(le) == eval(level_bottom)) break;
            }else{
                if(eval(le) > eval(level_bottom)) chk.eq(j).attr("checked", false);
                else if(eval(le) == eval(level_bottom)) break;
            }
        }
    });
});
</script>
</body>
</html>