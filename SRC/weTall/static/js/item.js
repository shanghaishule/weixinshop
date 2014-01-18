/**
 * @name 商品
 * @author andery@foxmail.com
 * @url http://www.pinphp.com
 */
;(function($){
    $.pinphp.item = {
        settings: {
            share_btn: '.J_shareitem_btn',
            like_btn: '.J_likeitem',
            unlike_btn: '.J_unlike',
            del_btn: '.J_delitem',
            select_album: '#J_select_album',
            joinalbum_btn: '.J_joinalbum',
            item_unit: '.J_item',
            item_gallery: '#J_item_gallery'
        },
        init: function(options){
            options && $.extend($.pinphp.item.settings, options);
            var s = $.pinphp.item.settings;
            //单个
            $(s.item_unit).live('mouseover', function(){
                $(this).find(s.joinalbum_btn).show();
                $(this).find(s.del_btn).show();
                $(this).find(s.unlike_btn).show();
            }).live('mouseout', function(){
                $(this).find(s.joinalbum_btn).hide();
                $(this).find(s.del_btn).hide();
                $(this).find(s.unlike_btn).hide();
            });

            $.pinphp.item.share();
            $.pinphp.item.select_album();
            $.pinphp.item.joinalbum();
            $.pinphp.item.like();
            $.pinphp.item.unlike();
            $.pinphp.item.del();
            $.pinphp.item.gallery();
        },
        //喜欢
        like: function(){
            var s = $.pinphp.item.settings;
            $(s.like_btn).live('click', function(){
                if(!$.pinphp.dialog.islogin()) return !1;
                var self = $(this),
                    nb = self.siblings('.J_like_n').find('a'),
                    id = self.attr('data-id'),
                    aid = self.attr('data-aid'),
                    n = parseInt(nb.html());
                $.getJSON(PINER.root + '/?m=item&a=like', {id:id, aid:aid}, function(result){
                    if(result.status == 1){
                        //喜欢成功
                        nb.text(n+1).show();
                        $.pinphp.tip({content:result.msg});
                    }else{
                        $.pinphp.tip({content:result.msg, icon:'error'});
                    }
                });
            });
        },
        //不喜欢了
        unlike: function(){
            var s = $.pinphp.item.settings;
            $(s.unlike_btn).live('click', function(){
                if(!$.pinphp.dialog.islogin()) return !1;
                var self = $(this),
                    id = self.attr('data-id');
                $.getJSON(PINER.root + '/?m=item&a=unlike', {id:id}, function(result){
                    if(result.status == 1){
                        self.parents(s.item_unit).slideUp(500, function(){
                            $(this).parent().masonry('remove', $(this)).masonry('reload');
                        });
                    }else{
                        $.pinphp.tip({content:result.msg, icon:'error'});
                    }
                });
            });
        },
        //删除
        del: function(){
            var s = $.pinphp.item.settings;
            $(s.del_btn).live('click', function(){
                if(!$.pinphp.dialog.islogin()) return !1;
                var self = $(this),
                    id = self.attr('data-id'),
                    album_id = self.attr('data-aid');
                $.getJSON(PINER.root + '/?m=item&a=delete', {id:id, album_id:album_id}, function(result){
                    if(result.status == 1){
                        self.parents(s.item_unit).slideUp(500, function(){
                            $(this).parent().masonry('remove', $(this)).masonry('reload');
                        });
                    }else{
                        $.pinphp.tip({content:result.msg, icon:'error'});
                    }
                });
            });
        },
        //选择专辑
        select_album: function(){
            var s = $.pinphp.item.settings;
            $(s.select_album).find('.J_qcreate_btn').live('click', function(){
                $(this).hide();
                $(s.select_album).find('.J_qcreate').show();
            });
            //点击创建
            $(s.select_album).find('.J_qc_submit').live('click', function(){
                var title = $(s.select_album).find('.J_qc_title').val(),
                    cate_id = $(s.select_album).find('.J_qc_cate').val();
                $.ajax({
                    url: PINER.root + '/?m=album&a=create_album',
                    type: 'POST',
                    data: {
                        title: title,
                        cate_id: cate_id
                    },
                    dataType: 'json',
                    success: function(result){
                        if(result.status == 1){
                            $(s.select_album).find('.J_qcreate_btn').show();
                            $('<option value="'+result.data+'">'+title+'</option>').appendTo($(s.select_album).find('.J_album_id'));
                            setTimeout(function(){
                                $(s.select_album).find('.J_album_id').find('option[value="'+result.data+'"]').attr("selected", true);
                                $(s.select_album).find('.J_album_id').find('option[value="0"]').remove();
                            }, 1);
                            $(s.select_album).find('.J_df_cate').hide();
                            $(s.select_album).find('.J_qcreate').hide();
                        }else{
                            $.pinphp.tip({content:result.msg, icon:'error'});
                        }
                    }
                });
            });
        },
        joinalbum_form: function(form){
            form.ajaxForm({
                beforeSubmit: function(){
                    $.dialog.get('join_album').title(false).content('<div class="d_loading">'+lang.wait+'</div>');
                },
                success: function(result){
                    $.dialog.get('join_album').close();
                    if(result.status == 1){
                        $.pinphp.tip({content:result.msg});
                    } else {
                        $.pinphp.tip({content:result.msg, icon:'error'});
                    }
                },
                dataType: 'json'
            });
        },
        //加入专辑
        joinalbum: function(id){
            var s = $.pinphp.item.settings;
            $(s.joinalbum_btn).live('click', function(){
                if(!$.pinphp.dialog.islogin()) return !1;
                var id = $(this).attr('data-id');
                $(this).hide();
                $.dialog({id:'join_album', title:lang.join_album, padding:'', fixed:true, lock:true});
                $.getJSON(PINER.root + '/?m=album&a=join', {id:id}, function(result){
                    if(result.status == 1){
                        $.dialog.get('join_album').content(result.data);
                        $.pinphp.item.joinalbum_form($('#J_join_album'));
                    }else{
                        $.pinphp.tip({content:result.msg, icon:'error'});
                    }
                });
            });
        },
        //发布商品
        share: function(){
            var s = $.pinphp.item.settings;
            $(s.share_btn).live('click', function(){
                if(!$.pinphp.dialog.islogin()) return !1;
                var aid = $(this).attr('data-aid');
                $.getJSON(PINER.root + '/?m=item&a=share_item', function(result){
                    if(result.status == 1){
                        $.dialog({id:'share_item', title:lang.share_title, content:result.data, padding:'', fixed:true, lock:true});
                        $.pinphp.item.share_form($('#J_share_item'), aid);
                    }else{
                        $.pinphp.tip({content:result.msg, icon:'error'});
                    }
                });
            });
        },
        share_form: function(form, aid){
            form.find('.J_si_btn').die('click').live('click', function(){
                var si_url = $.trim($('.si_url').val());
                if(!$.pinphp.util.isURl(si_url)) return $.pinphp.tip({content:lang.please_input+lang.correct_itemurl, icon:'alert'}), !1;
                $.dialog.get('share_item').title(false).content('<div class="d_loading">'+lang.wait+'</div>');
                $.getJSON(PINER.root + '/?m=item&a=fetch_item', {url:si_url, aid:aid}, function(result){
                    if(result.status == 1){
                        $.pinphp.item.fetch(result.data);
                    }else{
                        $.dialog.get('share_item').close();
                        $.pinphp.tip({content:result.msg, icon:'error'});
                    }
                });
            });
        },
        //获取商品信息
        fetch: function(result){
            $.dialog.get('share_item').title(lang.share_title).content(result.html);
            $.pinphp.item.fetch_form($('#J_fetch_item'), result.item);
        },
        fetch_form: function(form, item){
            form.find('.J_pub_btn').die('click').live('click', function(){
                $.dialog.get('share_item').title(false).content('<div class="d_loading">'+lang.wait+'</div>');
                var album_id = $('.J_album_id').val(),
                    ac_id = $('.J_df_cate').val(),
                    intro = form.find('.J_intro').val();
                $.ajax({
                    url: PINER.root + '/?m=item&a=publish_item',
                    type: 'POST',
                    data: {
                        item: item,
                        album_id: album_id,
                        intro: intro
                    },
                    dataType: 'json',
                    success: function(result){
                        if(result.status == 1){
                            $.dialog.get('share_item').close();
                            $.pinphp.tip({content:result.msg});
                        }else{
                            $.pinphp.tip({content:result.msg, icon:'error'});
                        }
                    }
                });
            });
        },
        //相册
        gallery: function(){
            var s = $.pinphp.item.settings;
            if($('#J_img_list', s.item_gallery)[0]){
                $('#J_img_list').jcarousel();
                $('#J_img_list li', s.item_gallery).live('mouseover', function(){
                    var self = $(this),
                        bimg = self.attr('data-url');
                    self.addClass('active').siblings().removeClass('active');
                    $('.J_item img', s.item_gallery).attr('src', bimg).attr('jqimg', bimg);
                });
                $('#J_img_zoom').imagesLoaded(function(){
                    if ($('#J_img_zoom img').width() >= 468) {
                        $('#J_img_zoom', s.item_gallery).jqueryzoom({xzoom:420, yzoom:420,offset:20});
                    }
                });
                
            }
        }
    };
    $.pinphp.item.init();
})(jQuery);