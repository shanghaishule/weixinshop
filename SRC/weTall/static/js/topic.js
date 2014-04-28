/**
 * @name 微薄相关
 * @author andery@foxmail.com
 * @url http://www.pinphp.com
 */
;(function($){
    $.pinphp.topic = {
        settings: {
            topic_unit: '.J_feed',
            cmt_pub: '.J_cmt_pub',
            cmt_unit: '.J_cmt_list',
            cmt_me_reply_html: '<div class="J_cmtme_reply_pub reply clearfix"><div class="reply_input"><textarea class="J_cmt_content reply_content fl rl3"></textarea><input type="button" class="J_cmt_sub btn fl ml5" value="确定"></div></div>'
        },
        init: function(options){
            options && $.extend($.pinphp.topic.settings, options);
            var s = $.pinphp.topic.settings;
            $(s.topic_unit).live({
                mouseover: function(){
                    $(this).find('.J_del').show();
                },
                mouseout: function(){
                    $(this).find('.J_del').hide();
                }
            });
            $.pinphp.topic.piczoom();
            $.pinphp.topic.delete();
            $.pinphp.topic.forward();
            $.pinphp.topic.comment();
            $.pinphp.topic.comment_sub();
            $.pinphp.topic.comment_reply();
            $.pinphp.topic.comment_del();
            $.pinphp.topic.comment_me_reply();
            $.pinphp.topic.comment_me_reply_sub();
        },
        //点击缩略查看详细
        piczoom: function(){
            var s = $.pinphp.topic.settings;
            $(s.topic_unit).find('.J_pic').live('click', function(){
                var self = $(this);
                if(self.siblings('.J_src').html()){
                    self.hide();
                    self.siblings('.J_src').show();
                }else{
                    //获取源数据
                    var src_id = self.attr('data-sid'),
                        src_type = self.attr('data-stype');
                    $.getJSON(PINER.root + '/?m=space&a=feed_src', {src_id:src_id, src_type:src_type}, function(result){
                        if(result.status == 1){
                            self.hide();
                            self.siblings('.J_src').html(result.data).show();
                            $.pinphp.ui.decode_img(self.siblings('.J_src'));
                        }else{
                            $.pinphp.tip({content:result.msg,  icon:'error'});
                        }
                    });
                }
            });
            $(s.topic_unit).find('.J_src').live('click', function(){
                var self = $(this);
                self.hide();
                self.siblings('.J_pic').show();
            });
        },
        //删除
        delete: function(){
            var s = $.pinphp.topic.settings;
            $(s.topic_unit).find('.J_del').live('click', function(){
                if(!$.pinphp.dialog.islogin()) return !1;
                if(!confirm(lang.confirm_del_norestore)) return !1;
                var self = $(this),
                    tid = self.parents(s.topic_unit).attr('data-tid');
                $.getJSON(PINER.root + '/?m=topic&a=delete', {tid:tid}, function(result){
                    if(result.status == 1){
                        self.parents(s.topic_unit).slideUp(500, function(){
                            $(this).remove();
                        });
                    }else{
                        $.pinphp.tip({content:result.msg,  icon:'error'});
                    }
                });
            });
        },
        //转发
        forward: function(){
            var s = $.pinphp.topic.settings;
            $(s.topic_unit).find('.J_fw').live('click', function(){
                if(!$.pinphp.dialog.islogin()) return !1;
                var tid = $(this).parents(s.topic_unit).attr('data-tid');
                $.dialog({id:'topic_forward', title:'转发给我的粉丝', width:450, padding:'', fixed:true, lock:true});
                $.getJSON(PINER.root + '/?m=topic&a=forward', {tid:tid}, function(result){
                    if(result.status == 1){
                        $.dialog.get('topic_forward').content(result.data);
                        $.pinphp.topic.forward_form($('#J_forward_form'));
                    }else{
                        $.pinphp.tip({content:result.msg, icon:'error'});
                    }
                });
            });
        },
        forward_form: function(form){
            form.ajaxForm({
                beforeSubmit: function(){
                    var content = form.find('.J_content').val();
                    if(content == ''){
                        $.pinphp.tip({content:lang.please_input+lang.forward_content, icon:'error'});
                        return !1;
                    }
                },
                success: function(result){
                    if(result.status == 1){
                        $.dialog.get('topic_forward').close();
                        $.pinphp.tip({content:result.msg});
                    } else {
                        $.pinphp.tip({content:result.msg, icon:'error'});
                    }
                },
                dataType: 'json'
            });
        },
        //评论
        comment: function(){
            var s = $.pinphp.topic.settings;
            $(s.topic_unit).find('.J_cmt').toggle(
                function(){
                    if(!$.pinphp.dialog.islogin()) return !1;
                    var unit = $(this).parents(s.topic_unit);
                    if(unit.find(s.cmt_pub)[0]){
                        unit.find(s.cmt_pub).show();
                    }else{
                        $.pinphp.topic.comment_list(unit);
                    }
                },
                function(){
                    $(this).parents(s.topic_unit).find(s.cmt_pub).hide();
                }
            );
        },
        //评论列表
        comment_list: function(unit){
            var s = $.pinphp.topic.settings,
                tid = unit.attr('data-tid');
            $.getJSON(PINER.root + '/?m=topic&a=comment', {tid:tid}, function(result){
                if(result.status == 1){
                    unit.find(s.cmt_pub).remove();
                    unit.find('.J_feed_info').append(result.data);
                }else{
                    $.pinphp.tip({content:result.msg, icon:'error'});
                }
            });
            //分页
            $('a', $('.J_cmt_page')).live('click', function(){
                var url = $(this).attr('href');
                $.getJSON(url, function(result){
                    if(result.status == 1){
                        unit.find(s.cmt_pub).remove();
                        unit.find('.J_feed_info').append(result.data);
                    }else{
                        $.pinphp.tip({content:result.msg, icon:'error'});
                    }
                });
                return false;
            });
        },
        //发表评论
        comment_sub: function(){
            var s = $.pinphp.topic.settings;
            $(s.cmt_pub).find('.J_cmt_sub').live('click', function(){
                if(!$.pinphp.dialog.islogin()) return !1;
                var self = $(this),
                    unit = self.parents(s.topic_unit),
                    tid = unit.attr('data-tid'),
                    content = unit.find('.J_cmt_content').val();
                $.ajax({
                    url: PINER.root + '/?m=topic&a=comment',
                    type: 'POST',
                    data: {
                        tid: tid,
                        content: content
                    },
                    dataType: 'json',
                    success: function(result){
                        if(result.status == 1){
                            $.pinphp.topic.comment_list(unit);
                        }else{
                            $.pinphp.tip({content:result.msg, icon:'error'});
                        }
                    }
                });
            });
        },
        //回复评论
        comment_reply: function(){
            var s = $.pinphp.topic.settings;
            $(s.cmt_unit).find('.J_cmt_reply').live('click', function(){
                if(!$.pinphp.dialog.islogin()) return !1;
                var self = $(this),
                    cmt_b = self.parents(s.cmt_pub),
                    cmt_i = self.parents(s.cmt_unit),
                    content_b = cmt_b.find('.J_cmt_content'),
                    uname = cmt_i.find('.sms .n').text(),
                    reply_c = '回复@' + uname + ": ";
                //console.log(reply_c);
                content_b.val(reply_c);
            });
        },
        //删除评论
        comment_del: function(){
            var s = $.pinphp.topic.settings;
            $(s.cmt_unit).find('.J_cmt_del').live('click', function(){
                if(!$.pinphp.dialog.islogin()) return !1;
                if(!confirm(lang.confirm_del_norestore)) return !1;
                var self = $(this),
                    cmt_i = self.parents(s.cmt_unit),
                    cid = cmt_i.attr('data-cid');
                $.getJSON(PINER.root + '/?m=topic&a=comment_del', {cid:cid}, function(result){
                    if(result.status == 1){
                        cmt_i.remove();
                    }else{
                        $.pinphp.tip({content:result.msg, icon:'error'});
                    }
                });
            });
        },
        //回复评论我的
        comment_me_reply: function(){
            var s = $.pinphp.topic.settings;
            $(s.cmt_unit).find('.J_cmtme_reply').live('click', function(){
                if(!$.pinphp.dialog.islogin()) return !1;
                var self = $(this),
                    cmt_i = self.parents(s.cmt_unit);
                cmt_i.append(s.cmt_me_reply_html);
                var content_b = cmt_i.find('.J_cmtme_reply_pub').find('.J_cmt_content'),
                    uname = cmt_i.find('.msg .n').text(),
                    reply_c = '回复@' + uname + ': ';
                content_b.val(reply_c);
            });
        },
        //发表回复评论我的
        comment_me_reply_sub: function(){
            var s = $.pinphp.topic.settings;
            $(s.cmt_unit).find('.J_cmt_sub').live('click', function(){
                if(!$.pinphp.dialog.islogin()) return !1;
                var self = $(this),
                    cmt_i = self.parents(s.cmt_unit),
                    tid = cmt_i.attr('data-tid'),
                    content = cmt_i.find('.J_cmt_content').val();
                $.ajax({
                    url: PINER.root + '/?m=topic&a=comment',
                    type: 'POST',
                    data: {
                        tid: tid,
                        content: content
                    },
                    dataType: 'json',
                    success: function(result){
                        if(result.status == 1){
                            cmt_i.find('.J_cmtme_reply_pub').remove();
                            $.pinphp.tip({content:result.msg});
                        }else{
                            $.pinphp.tip({content:result.msg, icon:'error'});
                        }
                    }
                });
            });
        }
    };
    $.pinphp.topic.init();
})(jQuery);