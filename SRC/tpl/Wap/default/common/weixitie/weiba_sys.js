/// <reference path='jquery-2.0.3.js' />
/// <reference path='jquery.easing.1.3.js' />
/*
    (C)weiba66.com
    suolan@msn.com
*/

//自定义插件
(function (window, $, undefined) {
    var $layer_mask, curZIndex = 9999;

    $.fn.showDialog = function (arg) {
        $layer_mask = getMaskLayer().fadeIn();
        return this.each(function () {
            var $this = $(this).css({
                'z-index': curZIndex++
            }).css({
                'bottom': -$(this).height()
            }).show().animate({
                'bottom': 0
            }, function () {
                $layer_mask.one('click', function () {
                    $this.closeDialog();
                });
            }).data('isOpened',true);
        });
    };

    $.fn.closeDialog = function () {
        return this.each(function () {
            var $this = $(this);
            if ($this.data('isOpened')) {
                $this.animate({
                    'bottom': -$this.height()
                }, function () {
                    if ($layer_mask) {
                        $layer_mask.fadeOut(function () {
                            $layer_mask.remove();
                            $layer_mask = null;
                        });
                    }
                    $this.hide();
                }).data('isOpened', false);
            };
        });
    }

    $.fn.showHelper = function (arg) {
        $layer_mask = getMaskLayer().fadeIn();
        return this.each(function () {
            var $this = $(this).css({
                'z-index': curZIndex++
            }).fadeIn(function () {
                $layer_mask.one('click', function () {
                    $this.closeHelper();
                });
            }).data('isOpened', true);
        });
    }

    $.fn.closeHelper = function () {
        return this.each(function () {
            var $this = $(this);
            if ($this.data('isOpened')) {
                $this.hide(function () {
                    if ($layer_mask) {
                        $layer_mask.fadeOut(function () {
                            $layer_mask.remove();
                            $layer_mask = null;
                        });
                    }
                }).data('isOpened', false);
            };
        });
    }

    function getMaskLayer() {
        if (!$layer_mask) {
            $layer_mask = $('<div class="layer-mask"></div>').css({
                'z-index' : (curZIndex-1)
            }).appendTo('body');
        }
        return $layer_mask;
    }

    $.getUrlParam = function (name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]); return null;
    }

    //显示一个Pop text=内容,$parent=显示在哪个元素旁边,pos=在什么位置
    $.popTip = function (text, $parent, pos, type) {
        var html = '<div class="Tip ' + (type ? type : '') + '"><div class="Text">' + text + '</div><div class="ICON"></div></div>';
        var $pop = $(html).appendTo('body');
        var $icon = $('.ICON', $pop);
        var top, left;
        if ($parent) {
            switch (pos) {
                case 'TopRight':
                    top = $parent.offset().top - $pop.height() - $icon.height();
                    left = $parent.offset().left + $parent.width() - $pop.width();
                    break;
                case 'BottomRight':
                    top = $parent.offset().top + $parent.height() + $icon.height();
                    left = $parent.offset().left + $parent.width() - $pop.width();
                    break;
                case 'BottomLeft':
                    top = $parent.offset().top + $parent.height() + $icon.height();
                    left = $parent.offset().left;
                    break;
                case 'TopLeft':
                    top = $parent.offset().top - $pop.height() - $icon.height();
                    left = $parent.offset().left;
                    break;
                case 'Center':
                default:
                    pos = 'Center';
                    top = $parent.offset().top + ($parent.height() - $pop.height()) / 2;
                    left = $parent.offset().left + ($parent.width() - $pop.width()) / 2;
                    $icon.hide();
                    break;
            }
        }
        else {
            $icon.hide();
            top = '50%'; left = '50%';
            $pop.css({
                'position' : 'fixed',
                'margin-left': -$pop.width() / 2 + 'px',
                'margin-right': -$pop.height() / 2 + 'px'
            });
        }
        $pop.addClass(pos).css({
            'top': top,
            'left': left
        }).fadeIn(function () {
            window.setTimeout(function () {
                $pop.fadeOut(function () {
                    $pop.remove();
                    $pop = null;
                });
            }, 800);
        });

    };

    //显示一个警告Pop
    $.popWaningTip = function (text, $parent, pos) {
        $.popTip(text, $parent, pos, 'Warning')
    };

    $Loadings = {};
    //显示一个Loadding($cover = loading要遮挡的区域,默认是body)
    $.showLoading = function ($cover) {
        if (!$cover) {
            $cover = $('body');
        }
        var id = 'LOADING' + Math.round(Math.random() * 8000000 + 1000000);
        $Loadings[id] = $('<div class="System-Loading"><div class="BG"></div><div class="ICON"></div></div>').show().appendTo($cover);
        return id;
    };

    $.hideLoading = function (id) {
        if ($Loadings[id]) {
            $Loadings[id].hide();
            $Loadings[id].remove();
            $Loadings[id] = null;
            delete $Loadings[id];
        }
    };

    /*
    "yyyy-MM-dd hh:mm:ss.S"==> 2006-07-02 08:09:04.423      
    "yyyy-MM-dd E HH:mm:ss" ==> 2009-03-10 二 20:09:04      
    "yyyy-MM-dd EE hh:mm:ss" ==> 2009-03-10 周二 08:09:04      
    "yyyy-MM-dd EEE hh:mm:ss" ==> 2009-03-10 星期二 08:09:04      
    "yyyy-M-d h:m:s.S" ==> 2006-7-2 8:9:4.18      
    */
    $.formatDate = function (date,fmt) {
        var o = {
            'M+': date.getMonth() + 1, //月份         
            'd+': date.getDate(), //日         
            'h+': date.getHours() % 12 == 0 ? 12 : date.getHours() % 12, //小时         
            'H+': date.getHours(), //小时         
            'm+': date.getMinutes(), //分         
            's+': date.getSeconds(), //秒         
            'q+': Math.floor((date.getMonth() + 3) / 3), //季度         
            'S': date.getMilliseconds() //毫秒         
        };
        var week = {
            '0': '/u65e5',
            '1': '/u4e00',
            '2': '/u4e8c',
            '3': '/u4e09',
            '4': '/u56db',
            '5': '/u4e94',
            '6': '/u516d'
        };
        if (/(y+)/.test(fmt)) {
            fmt = fmt.replace(RegExp.$1, (date.getFullYear() + '').substr(4 - RegExp.$1.length));
        }
        if (/(E+)/.test(fmt)) {
            fmt = fmt.replace(RegExp.$1, ((RegExp.$1.length > 1) ? (RegExp.$1.length > 2 ? '/u661f/u671f' : '/u5468') : '') + week[date.getDay() + '']);
        }
        for (var k in o) {
            if (new RegExp('(' + k + ')').test(fmt)) {
                fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (('00' + o[k]).substr(('' + o[k]).length)));
            }
        }
        return fmt;
    };

})(window, jQuery, undefined);

(function () {
    var onBridgeReady = function () {

        $(document).trigger('bridgeready');

        var $body = $('body'), appId = '',
            title = $body.attr('weiba-title'),
            imgUrl = $body.attr('weiba-icon'),
            link = $body.attr('weiba-link'),
            desc = $body.attr('weiba-desc') || link;
        if (!setForward()) {
            $(document).bind('weibachanged', function () {
                setForward();
            });
        }
    };
    if (document.addEventListener) {
        document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
    } else if (document.attachEvent) {
        document.attachEvent('WeixinJSBridgeReady', onBridgeReady);
        document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
    }

    function setForward() {
        var $body = $('body'), appId = '',
            title = $body.attr('weiba-title'),
            imgUrl = $body.attr('weiba-icon'),
            link = $body.attr('weiba-link'),
            desc = $body.attr('weiba-desc') || link;
        if (title && link) {
            WeixinJSBridge.on('menu:share:appmessage', function (argv) {
                WeixinJSBridge.invoke('sendAppMessage', {
                    //'appid': 'kczxs88',
                    'img_url': imgUrl?imgUrl:undefined,
                    'link': link,
                    'desc': desc?desc:undefined,
                    'title': title
                }, function (res) {
                    if (res && res['err_msg'] && res['err_msg'].indexOf('confirm') > -1) {
                        $(document).trigger('wx_sendmessage_confirm');
                    }
                });
            });
            WeixinJSBridge.on('menu:share:timeline', function (argv) {
                $(document).trigger('wx_timeline_before');

                WeixinJSBridge.invoke('shareTimeline', {
                    'img_url': imgUrl?imgUrl:undefined,
                    'link': link,
                    'desc': desc?desc:undefined,
                    'title': title
                }, function (res) {
                    //貌似目前没有简报
                });
            });
            /*
            WeixinJSBridge.on('menu:share:weibo', function (argv) {
                WeixinJSBridge.invoke('shareWeibo', {
                    'content': title + desc,
                    'url': link
                }, function (res) {

                });
            });
            */
            return true;
        }
        else {
            return false;
        }
    }

})();

(function () {
    var lastTime = 0;
    var vendors = ['ms', 'moz', 'webkit', 'o'];
    for (var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
        window.requestAnimationFrame = window[vendors[x] + 'RequestAnimationFrame'];
        window.cancelAnimationFrame = window[vendors[x] + 'CancelAnimationFrame']
                                   || window[vendors[x] + 'CancelRequestAnimationFrame'];
    }

    if (!window.requestAnimationFrame)
        window.requestAnimationFrame = function (callback, element) {
            var currTime = new Date().getTime();
            var timeToCall = Math.max(0, 16 - (currTime - lastTime));
            var id = window.setTimeout(function () { callback(currTime + timeToCall); },
              timeToCall);
            lastTime = currTime + timeToCall;
            return id;
        };

    if (!window.cancelAnimationFrame)
        window.cancelAnimationFrame = function (id) {
            clearTimeout(id);
        };
}());

(function () {
    window.GameTimer = function (fn, timeout) {
        this.__fn = fn;
        this.__timeout = timeout;
        this.__running = false;
        this.__lastTime = Date.now();
        this.__stopcallback = null;
    };

    window.GameTimer.prototype.__runer = function () {
        if (Date.now() - this.__lastTime >= this.__timeout) {
            this.__lastTime = Date.now();
            this.__fn.call(this);
        }
        if (this.__running) {
            window.requestAnimationFrame(this.__runer.bind(this));
        }
        else {
            if (typeof this.__stopcallback === 'function') {
                window.setTimeout(this.__stopcallback, 100);
            }
        }
    };

    window.GameTimer.prototype.start = function () {
        this.__running = true;
        this.__runer();
    };
    window.GameTimer.prototype.stop = function (callback) {
        this.__running = false;
        this.__stopcallback = callback;
    };

})();

(function () {
    $.preLoadImage = function (imgArray,callback) {
        if ($.isArray(imgArray)) {
            var count = imgArray.length;
            $.each(imgArray, function (index,item) {
                var img = new Image();
                img.onload = function () {
                    count--;
                    if (count <= 0) {
                        if (typeof callback === 'function') {
                            callback.call(this);
                        }
                    }
                };
                img.onerror = function () {
                    count--
                    if (count <= 0) {
                        if (typeof callback === 'function') {
                            callback.call(this);
                        }
                    }
                };
                img.src = item;
            });
        }
    };
})();