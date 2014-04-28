/**
 * @name 用户相关
 * @author andery@foxmail.com
 * @url http://www.pinphp.com
 */
;(function($){
    $.pinphp.user = {
        settings: {
            card_btn: '.J_card',
            layer_html: '<div id="J_card_layer" class="user_card"><div id="J_card_info"></div><div class="J_card_arrow card_arrow"></div></div>',
            loading_html: '<div class="card_info"><p class="card_loading">'+lang.card_loading+'</p></div><div class="card_toolbar"></div>',
            follow_bar: '.J_follow_bar',
            add_btn_html: '<a href="javascript:;" class="J_fo_u fo_u_btn">关注</a>',
            add_ok_html: '<span class="fo_u_ok">已关注</span><a href="javascript:;" class="J_unfo_u green">取消</a>',
            add_all_html: '<span class="fo_u_all">互相关注</span><a href="javascript:;" class="J_unfo_u green">取消</a>'
        },
        init: function(options){
            options && $.extend($.pinphp.user.settings, options);
            var s = $.pinphp.user.settings;
            //名片
            $.pinphp.user.card();
            //名片上的关注
            $.pinphp.user.follow();
            //名片上的取消关注
            $.pinphp.user.unfollow();
            //绑定表单
            $.pinphp.user.bind_form();
        },
        //关注(需要登陆)
        follow: function(){
            var s = $.pinphp.user.settings;
            $(s.follow_bar).find('.J_fo_u').live('click', function(){
                if(!$.pinphp.dialog.islogin()) return !1;
                var self = $(this),
                    uid = $(this).parent().attr('data-uid');
                $.getJSON(PINER.root + '/?m=user&a=follow', {uid:uid}, function(result){
                    if(result.status == 1){
                        result.data == 1 ? self.parent().html(s.add_ok_html) : self.parent().html(s.add_all_html);
                        $("body").data(uid, false);
                    }else{
                        $.pinphp.tip({content:result.msg,  icon:'error'});
                    }
                });
            });
        },
        //取消关注(需要登陆)
        unfollow: function(){
            var s = $.pinphp.user.settings;
            $(s.follow_bar).find('.J_unfo_u').live('click', function(){
                if(!$.pinphp.dialog.islogin()) return !1;
                if(!confirm(lang.confirm_unfollow)) return !1;
                var self = $(this),
                    uid = $(this).parent().attr('data-uid');
                $.getJSON(PINER.root + '/?m=user&a=unfollow', {uid:uid}, function(result){
                    if(result.status == 1){
                        self.parent().html(s.add_btn_html);
                        $("body").data(uid, false);
                    }else{
                        $.pinphp.tip({content:result.msg,  icon:'error'});
                    }
                });
            });
        },
        //显示名片
        card: function(){
            var s = $.pinphp.user.settings,
                h = null,
                n = null;
            $(s.card_btn).live({
                mouseover: function(){
                    clearTimeout(h);
                    clearTimeout(n);
                    //计算显示位置
                    var p = $(this).offset(),
                        l = p.left,
                        d = $(this).width(),
                        q = d / 2 - 8,
                        w = $(window).width();
                        l + 300 > w && (l = l - 300 + d, q = 300 - d / 2 - 8),
                        uid = $(this).attr('data-uid');
                    if(!uid) return !1; //缺少属性
                    //显示加载
                    !$('#J_card_layer')[0] && $('body').append(s.layer_html);
                    $('#J_card_info').html(s.loading_html);
                    $('#J_card_layer').css({
                        top: p.top - 145 + "px",
                        left: l + "px"
                    });
                    $("#J_card_layer .J_card_arrow").css("margin-left", q + "px");
                    h = setTimeout(function(){
                        clearTimeout(h);
                        $("#J_card_layer").show();
                    }, 200);
                    $("#J_card_layer").hover(
                        function() {
                            clearTimeout(h);
                            $("#J_card_layer").show();
                        },
                        function() {
                            $("#J_card_layer").hide();
                        }
                    );
                    //获取内容
                    if($('body').data(uid) != void(0) && $('body').data(uid) != ''){
                        $("#J_card_info").html($('body').data(uid));
                    }else{
                        n = setTimeout(function(){
                            $.getJSON(PINER.root + '/?m=space&a=card', {uid:uid}, function(result){
                                if(result.status == 1){
                                    $("#J_card_info").html(result.data);
                                    $("body").data(uid, result.data);
                                    clearTimeout(h);
                                }else{
                                    clearTimeout(h);
                                    clearTimeout(n);
                                    $.pinphp.tip({content:result.msg,  icon:'error'});
                                }
                            });
                        }, 500);
                    }
                },
                mouseout: function(){
                    clearTimeout(h);
                    clearTimeout(n);
                    h = setTimeout(function() {
                        $("#J_card_layer").hide();
                    }, 500);
                }
            });
        },
        //登陆页面
        login_validate: function(form){
            //验证
            $.formValidator.initConfig({formid:form.attr('id'),autotip:true});
            form.find('#J_name').formValidator({onshow:' ', onfocus:lang.please_input+lang.username, oncorrect: ' '}).inputValidator({min:1,onerror:lang.please_input+lang.username});
            form.find('#J_pass').formValidator({onshow:' ', onfocus:lang.please_input+lang.password, oncorrect: ' '}).inputValidator({min:1,onerror:lang.please_input+lang.password});
        },
        //找回密码验证
        findpwd_validate: function(form){
            $.formValidator.initConfig({formid:form.attr('id'),autotip:true});
            form.find('#J_name').formValidator({onshow:' ', onfocus:lang.please_input+lang.username, oncorrect: ' '}).inputValidator({min:1,onerror:lang.please_input+lang.username});
            $('#J_captcha').formValidator({onshow:' ',onfocus:lang.captcha_tip, oncorrect: ' '})
            .inputValidator({min:1,onerror:lang.captcha_empty});
        },
        //重置密码表单
        resetpwd_form: function(){
            $.formValidator.initConfig({formid:'J_resetpwd_form',autotip:true});
            
            $('#J_password').formValidator({onshow:' ',onfocus:lang.password_tip, oncorrect: ' '})
            .inputValidator({min:6,onerror:lang.password_too_short})
            .inputValidator({max:20,onerror:lang.password_too_long});

            $('#J_repassword').formValidator({onshow:' ',onfocus:lang.repassword_tip, oncorrect: ' '})
            .inputValidator({min:1,onerror:lang.repassword_empty})
            .compareValidator({desid:'J_password',operateor:'=',onerror:lang.passwords_not_match});

            $('#J_captcha').formValidator({onshow:' ',onfocus:lang.captcha_tip, oncorrect: ' '})
            .inputValidator({min:1,onerror:lang.captcha_empty});
        },
        //绑定表单
        bind_form: function(){
            if ($('#J_bind_form')) {
                $.formValidator.initConfig({formid:'J_bind_form',autotip:true});
                $('#J_email').formValidator({onshow:' ',onfocus:lang.email_tip, oncorrect: ' '})
                .inputValidator({min:1,onerror:lang.please_input+lang.email})
                .regexValidator({regexp:'email',datatype:'enum',onerror:lang.email_format_error})
                .ajaxValidator({
                    type: 'get',
                    url: PINER.root + '/?m=user&a=ajax_check',
                    data: 'type=email',
                    datatype: 'json',
                    async:'false',
                    success: function(result){
                        return result.status == '1' ? !0 : !1;
                    },
                    buttons: $('#J_regsub'),
                    onerror: lang.email_exists,
                    onwait : lang.wait
                });
                
                $('#J_username').formValidator({onshow:' ',onfocus:lang.username_tip, oncorrect: ' '})
                .inputValidator({min:1,onerror:lang.please_input+lang.username})
                .inputValidator({max:20,onerror:lang.username_tip})
                .ajaxValidator({
                    type: 'get',
                    url: PINER.root + '/?m=user&a=ajax_check',
                    data: 'type=username',
                    datatype: 'json',
                    async:'false',
                    success: function(result){
                        return result.status == '1' ? !0 : !1;
                    },
                    buttons: $('#J_regsub'),
                    onerror: lang.username_exists,
                    onwait : lang.wait
                }).defaultPassed();

                $('#J_password').formValidator({onshow:' ',onfocus:lang.password_tip, oncorrect: ' '})
                .inputValidator({min:6,onerror:lang.password_too_short})
                .inputValidator({max:20,onerror:lang.password_too_long});

                $('#J_repassword').formValidator({onshow:' ',onfocus:lang.repassword_tip, oncorrect: ' '})
                .inputValidator({min:1,onerror:lang.repassword_empty})
                .compareValidator({desid:'J_password',operateor:'=',onerror:lang.passwords_not_match});
            }
        },
        //注册验证
        register_form: function(form){
            //协议
            $('#J_protocol_btn').live('click', function(){
                var content = $('#J_protocol').html();
                $.dialog({id:'protocol', title:lang.user_protocol, content:content, padding:'', fixed:true, lock:true});
            });
            //验证
            $.formValidator.initConfig({formid:'J_register_form',autotip:true});
            $('#J_email').formValidator({onshow:' ',onfocus:lang.email_tip, oncorrect: ' '})
            .inputValidator({min:1,onerror:lang.please_input+lang.email})
            .regexValidator({regexp:'email',datatype:'enum',onerror:lang.email_format_error})
            .ajaxValidator({
                type: 'get',
                url: PINER.root + '/?m=user&a=ajax_check',
                data: 'type=email',
                datatype: 'json',
                async:'false',
                success: function(result){
                    return result.status == '1' ? !0 : !1;
                },
                buttons: $('#J_regsub'),
                onerror: lang.email_exists,
                onwait : lang.wait
            });
            $('#J_username').formValidator({onshow:' ',onfocus:lang.username_tip, oncorrect: ' '})
            .inputValidator({min:1,onerror:lang.please_input+lang.username})
            .inputValidator({max:20,onerror:lang.username_tip})
            .ajaxValidator({
                type: 'get',
                url: PINER.root + '/?m=user&a=ajax_check',
                data: 'type=username',
                datatype: 'json',
                async:'false',
                success: function(result){
                    return result.status == '1' ? !0 : !1;
                },
                buttons: $('#J_regsub'),
                onerror: lang.username_exists,
                onwait : lang.wait
            });
            $('#J_password').formValidator({onshow:' ',onfocus:lang.password_tip, oncorrect: ' '})
            .inputValidator({min:6,onerror:lang.password_too_short})
            .inputValidator({max:20,onerror:lang.password_too_long});
            $('#J_repassword').formValidator({onshow:' ',onfocus:lang.repassword_tip, oncorrect: ' '})
            .inputValidator({min:1,onerror:lang.repassword_empty})
            .compareValidator({desid:'J_password',operateor:'=',onerror:lang.passwords_not_match});
            $('#J_captcha').formValidator({onshow:' ',onfocus:lang.captcha_tip, oncorrect: ' '})
            .inputValidator({min:1,onerror:lang.captcha_empty});
        }
    };
    $.pinphp.user.init(); //用户
})(jQuery);