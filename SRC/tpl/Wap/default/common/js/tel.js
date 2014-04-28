
$(function(){
	$("a").click(function(e){
		var url = this.href;
		var flg_weixin = /(MicroMessenger)/i.test(navigator.userAgent);
		var flg_ios = /(iPhone|iPad|iPod|iOS)/i.test(navigator.userAgent);
		//if(flg_weixin && !flg_ios){
			if(url.indexOf('tel:')==0){
			}else{
				e.preventDefault();
				if(url.indexOf('?')!=-1){
					window.location.href = (url + '&lanrain=mp.weixin.qq.com');
				}else{
					window.location.href = (url + '?lanrain=mp.weixin.qq.com');
				}
				return false;
			}
		//}
	})
})

(function(window,$){
    $.translateTel= function(tel) {
        tel += '';
        var numbers = '-0123456789', telNumber = '', spStrings = [' ', ':', '：'];
        spStrings.forEach(function (ele) {
            var spIndex = tel.indexOf(ele);
            if (spIndex > -1) {
                tel = tel.substring(spIndex + 1);
            }
        });

        if (typeof tel === 'string') {
            for (var i = 0, length = tel.length; i < length; i++) {
                var t = tel.charAt(i);
                if (numbers.indexOf(t) > -1) {
                    telNumber += t;
                }
            }
        }
        return telNumber;
    };

})(window,jQuery);