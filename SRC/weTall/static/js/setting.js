/**
 * @name 个人中心
 * @author andery@foxmail.com
 * @url http://www.pinphp.com
 */
;(function(){
    $.pinphp.setting = {
        init: function(){
            $.pinphp.setting.basic();
            $.pinphp.setting.password();
            $.pinphp.setting.cover();
            $.pinphp.setting.address();
            $.pinphp.setting.message_list();
            $.pinphp.setting.message();
            $.pinphp.setting.target();
        },
        //上传头像
        basic: function(){
            $('#J_birthday')[0] && Calendar.setup({
                inputField : "J_birthday",
                ifFormat   : "%Y-%m-%d",
                showsTime  : false,
                timeFormat : "24"
            });
            $('#J_upload_avatar').uploader({
                action_url: PINER.root + '/?m=user&a=upload_avatar',
                input_name: 'avatar',
                onComplete: function(id, fileName, result){
                    if(result.status == '1'){
                        $('#J_avatar').attr('src', result.data);
                    }
                }
            });
        },
        //修改密码
        password: function(){
            //验证
            $.formValidator.initConfig({formid:'J_password_form',autotip:true});

            $('#J_password').formValidator({onshow:' ',onfocus:lang.password_tip, oncorrect: ' '})
            .inputValidator({min:6,onerror:lang.password_too_short})
            .inputValidator({max:20,onerror:lang.password_too_long});

            $('#J_repassword').formValidator({onshow:' ',onfocus:lang.repassword_tip, oncorrect: ' '})
            .inputValidator({min:1,onerror:lang.repassword_empty})
            .compareValidator({desid:'J_password',operateor:'=',onerror:lang.passwords_not_match});
        },
        //自定义封面
        cover: function(){
            $('#upload_cover').uploader({
                action_url: PINER.root + '/?m=user&a=upload_cover',
                input_name: 'cover',
                onSubmit: function(id, fileName){
                    $.pinphp.tip({content:lang.uploading_cover, time:0,  icon:'wait'});
                },
                onComplete: function(id, fileName, result){
                    if(result.status == '1'){
                        $.pinphp.tip({close:true});
                        $('#J_cover_img').html(result.data);
                    }
                }
            });
            //取消图片
            $('#J_cancle_cover').live('click', function(){
                $.getJSON(PINER.root + '/?m=user&a=cancle_cover', function(result){
                    if(result.status == '1'){
                        window.location.reload();
                    }
                });
            });
        },
        //收货地址表单
        address: function(){
            //验证
            $.formValidator.initConfig({formid:'J_address_form',autotip:true});
            $('#J_consignee').formValidator({onshow:' ',onfocus:lang.please_input+lang.consignee, oncorrect: ' '})
            .inputValidator({min:1,onerror:lang.please_input+lang.consignee});
            $('#J_address').formValidator({onshow:' ',onfocus:lang.please_input+lang.address, oncorrect: ' '})
            .inputValidator({min:1,onerror:lang.please_input+lang.address});
            $('#J_mobile').formValidator({onshow:' ',onfocus:lang.please_input+lang.mobile, oncorrect: ' '})
            .inputValidator({min:1,onerror:lang.please_input+lang.mobile});

        },
        //短信
        message: function(){
            $('#J_msg_send').live('click', function(){
                var to_id = $(this).attr('data-toid'),
                    content = $('#J_msg_content').val();
                $.ajax({
                    url: PINER.root + '/?m=message&a=publish',
                    type: 'POST',
                    data: {
                        to_id: to_id,
                        content: content
                    },
                    dataType: 'json',
                    success: function(result){
                        if(result.status == 1){
                            //列表动态添加
                            $('#J_msg_list').prepend(result.data);
                            $('#J_msg_content').val('');
                        }else{
                            $.pinphp.tip({content:result.msg, icon:'error'});
                        }
                    }
                });
            });
        },
        //短信列表
        message_list: function(){
            //单个删除
            $('#J_msg_list').find('.J_ml_del').live('click', function(){
                var mid = $(this).attr('data-mid');
                $.getJSON(PINER.root + '/?m=message&a=del', {mid:mid}, function(result){
                    if (result.status == '1') {
                        $('#ml_'+mid).slideUp('fast', function(){
                            $(this).remove();
                        });
                    } else {
                        $.pinphp.tip({content:result.msg, icon:'error'});
                    }
                });
            });
            //批量删除
            $('#J_ml_delall').live('click', function(){
                if(!confirm(lang.confirm_del_talk)) return !1;
            });
        },
        //搜索用户
        target: function(){
            $('#J_search_target').live('click', function(){
                var search_uname = $('#J_search_uname').val();
                $.ajax({
                    url: PINER.root + '/?m=message&a=search_target',
                    type: 'POST',
                    data: {
                        search_uname: search_uname
                    },
                    dataType: 'json',
                    success: function(result){
                        if(result.status == 1){
                            //列表动态添加
                            $('#J_search_list').html(result.data);
                        }
                    }
                });
            });
        }
    };
    $.pinphp.setting.init();
})(jQuery);