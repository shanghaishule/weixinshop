/**
 * @name 积分兑换
 * @author andery@foxmail.com
 * @url http://www.pinphp.com
 */
;(function($){
    $.pinphp.exchange = {
        settings: {
            ec_btn: '.J_ec_btn',
        },
        init: function(options){
            options && $.extend($.pinphp.exchange.settings, options);
            //详细信息切换
            $('ul.J_desc_tab').tabs('div.J_desc_panes > div');
            $.pinphp.exchange.ec();
        },
        ec: function(){
            var s = $.pinphp.exchange.settings;
            $(s.ec_btn).live('click', function(){
                if(!$.pinphp.dialog.islogin()) return !1;
                var id = $(this).attr('data-id'),
                    num_input = $(this).attr('data-num'),
                    num = $(num_input).val();
                $.getJSON(PINER.root + '/?m=exchange&a=ec', {id:id, num:num}, function(result){
                    if(result.status == 1){
                        $.pinphp.tip({content:result.msg});
                    }else if(result.status == 2){
                        $.dialog({id:'ec_address', title:result.msg, content:result.data, width:450, padding:'', fixed:true, lock:true});
                        $.pinphp.exchange.daddress_form($('#J_daddress_form'));
                    }else{
                        $.pinphp.tip({content:result.msg, icon:'error'});
                    }
                });
            });
        },
        //收货地址表单
        daddress_form: function(form){
            form.ajaxForm({
                success: function(result){
                    if(result.status == 1){
                        $.dialog.get('ec_address').close();
                        $.pinphp.tip({content:result.msg});
                        window.location.reload();
                    } else {
                        $.pinphp.tip({content:result.msg, icon:'error'});
                    }
                },
                dataType: 'json'
            });
        }
    };
    $.pinphp.exchange.init();
})(jQuery);