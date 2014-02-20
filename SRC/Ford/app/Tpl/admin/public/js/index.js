/**
 * @name 后台首页
 * @author andery@foxmail.com
 * @url http://www.pinphp.com
 */
$(function(){
    var set_h = function(){
        var heights = document.documentElement.clientHeight-80;
        $("#J_rframe").height(heights);
        var openClose = $("#J_rframe").height()+9;
        $('#center_frame').height(openClose+9);
        $("#J_lmoc").height(openClose+20);
        $('body').css('overflow','hidden');
    }
    $(window).resize(function(){
        set_h();
    });
    set_h();
    
    //默认载入左侧菜单
    $('#J_lmenu').load($('#J_lmenu').attr('data-uri'));

    $(".J_switchs").live('click', function(i){
        var ul = $(this).parent().next();
        if(ul.is(':visible')){
            ul.hide();
            $(this).removeClass('on');
        }else{
            ul.show();
            $(this).addClass('on');
        }
    });

    //刷新
    $('#J_refresh').live('click', function(){
        $('#J_rframe iframe:visible')[0].contentWindow.location.reload();
    });

    //全屏
    $('#J_full_screen').toggle(
        function(){
            $('#header').hide();
            $('#J_lmenu').parent().hide();
            $('html').addClass('on');
            $('#J_rframe').height($('#J_rframe').height()+50);
            $(this).attr('title', lang.unfull_screen);
            $(this).addClass("admin_unfull").html(lang.unfull_screen);
        },
        function(){
            $('#header').show();
            $('#J_lmenu').parent().show();
            $('html').removeClass('on');
            $('#J_rframe').height($('#J_rframe').height()-50);
            $(this).attr('title', lang.full_screen);
            $(this).removeClass('admin_unfull').html(lang.full_screen);
        }
    );

    //更新缓存
    $('#J_flush_cache').live('click', function(){
        var title = $(this).attr('title'),
            data_uri = $(this).attr('data-uri');
        $.getJSON(data_uri, function(result){
            $.pinphp.tip({content:result.msg});
        });
    });

    //后台地图
    $('#J_admin_map').live('click', function(){
        var title = $(this).attr('title');
        var data_uri = $(this).attr('data-uri');
        $.dialog({id:'admin_map', title:title, padding:'', lock:true});
        var dialog = $.dialog.get('admin_map');
        $.get(data_uri, function(html){
            dialog.content(html);
        });
        $('#admin_map a').live('click', function(){
            dialog.close();
        });
    });

    //左侧开关
    $('#J_lmoc').live('click', function(){
        if($(this).data('clicknum')==1) {
            $('html').removeClass('on');
            $('#J_lmenu').parent().removeClass('left_menu_on');
            $(this).removeClass('close');
            $(this).data('clicknum', 0);
        } else {
            $('#J_lmenu').parent().addClass('left_menu_on');
            $(this).addClass('close');
            $('html').addClass('on');
            $(this).data('clicknum', 1);
        }
        return false;
    });

    //顶部菜单点击
    $('#J_tmenu a').live('click', function(){
        var data_id = $(this).attr('data-id');
        //改变样式
        $(this).parent().addClass("on").siblings().removeClass("on");
        //改变左侧
        $('#J_lmenu').load($('#J_lmenu').attr('data-uri'), {menuid:data_id});
        //显示左侧菜单，当点击顶部时，展开左侧
        $('#J_lmenu').parent().removeClass('left_menu_on');
        $('html').removeClass('on');
        $('#J_lmoc').removeClass('close').data('clicknum', 0);
    });

    //左侧菜单点击
    $('.J_lmenu a').live('click', function(){
        $('#J_mtab_h li').removeClass('current');
        var data_name=$(this).html(),
            data_uri = $(this).attr('data-uri'),
            data_id = $(this).attr('data-id'),
            _li = $('#J_mtab li[data-id='+data_id+']');
        if(_li[0]){
            //存在则直接点击
            _li.trigger('click');
        }else{
            //不存在新建frame和tab
            var rframe = $('<iframe/>', {
                src               : data_uri,
                id                  : 'rframe_' + data_id,
                allowtransparency : true,
                frameborder       : 0,
                scrolling          : 'auto',
                width              : '100%',
                height        : '100%'
            }).appendTo('#J_rframe');
            $(rframe[0].contentWindow.document).ready(function(){
                rframe.siblings().hide();
                var _li = $('<li data-id="'+data_id+'"><span><a>'+data_name+'</a><a class="del" title="关闭此页">关闭</a></span></li>').addClass('current');
                _li.appendTo('#J_mtab_h').siblings().removeClass('current');
                _li.trigger('click');
            });
        }
        $(this).parent().addClass("on fb blue").siblings().removeClass("on fb blue");
        $(this).parent().parent().siblings().find('.sub_menu').removeClass("on fb blue");
        $('#rframe_'+ data_id).attr('src', $('#rframe_'+ data_id).attr('src'));
    });

    //TAB点击
    $('#J_mtab li').live('click', function(){
        //如果UL还在动画中则不处理，以免发生多次位移
        if($('#J_mtab_h').is(":animated")){
            return false;
        }
        var data_id = $(this).attr('data-id'),
            _li_prev = $(this).prev(),
            _li_next = $(this).next();
        $(this).addClass('current').siblings('li').removeClass('current');
        $(this).showMtab();
        //左右切换按钮效果改变
        if(_li_prev[0]){
            $('#J_prev').removeClass('mtab_nopre');
        }else{
            $('#J_prev').addClass('mtab_nopre');
        }
        if(_li_next[0]){
            $('#J_next').removeClass('mtab_nonext');
        }else{
            $('#J_next').addClass('mtab_nonext');
        }
        //frame页面切换
        $('#rframe_'+ data_id).show().siblings('iframe').hide();
    });

    //上一个TAB
    $('#J_prev').click(function(){
        $('#J_mtab_h .current').prev().trigger('click');
    });

    //下一个TAB
    $('#J_next').click(function(){
        $('#J_mtab_h .current').next().trigger('click');
    });

    //关闭TAB
    $('#J_mtab_h a.del').live('click', function(){
        var _li = $(this).parent().parent(),
            _prev_li = _li.prev('li'),
            data_id = _li.attr('data-id');
        _li.hide(60,function() {
            $(this).remove();
            $('#rframe_'+ data_id).remove();
            var _curr_li = $('#J_mtab_h li.current');
            if(!_curr_li[0]){
                _prev_li.addClass('current').trigger('click');
                $('#rframe_'+_prev_li.attr('data-id')).show();
            }
        });
        return false;
    });
});
//保持当前TAB可见
(function($){
    //调整TAB到可视区域
    $.fn.showMtab = function() {
        var _li = $(this),
            _ul = $('#J_mtab_h'),
            _li_left = _li.offset().left,
            _li_right = _li_left + _li.outerWidth(),
            _next_left = $('#J_next').offset().left,
            _prev_right = $('#J_prev').offset().left + $('#J_prev').outerWidth();
        if(_li_right > _next_left){
            //如果在右侧隐藏
            var distance = _li_right - _next_left;
            _ul.animate({left:'-='+distance}, 200, 'swing');
        }else if(_li_left < _prev_right){
            //如果在左侧隐藏
            var distance = _prev_right - _li_left;
            _ul.animate({left:'+='+distance}, 200, 'swing');
        }
    }
})(jQuery);