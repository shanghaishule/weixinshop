// JavaScript Document

(function($){
	$.fn.cxFocusImg=function(){
		var obj = this;
		var sWidth = obj.width(),
			len = obj.find('ul li').length,
			index = 0;
			
		$(this).find('.carNext').click(function(){
			index += 1;
			if(index == len) {index = 0;}
			showPic(index);
		});
		
		obj.find('ul').css({width:len*sWidth});		
		
		function showPic(index){
			var nowLeft = -index*sWidth;
			obj.find('ul').stop(true,false).animate({'left':nowLeft},300);
		}
	}
	
	$.fn.appFocusImg=function(){
		
		var app = this;
		var len = app.find('ul li').length,
			index = 0,
			btn_prev = app.find('.btn_prev'),
			btn_next = app.find('.btn_next'),
			sWidth = app.width();
			
		
		$(window).resize(function(){
			sWidth = app.width();
			showPics(index);
			showBtns(index);
		});
		
		btn_prev.click(function() {
			index -= 1;
			if(index == -1) { index = len - 1; }
			showBtns(index);
			showPics(index);
		});
		
		btn_next.click(function() {
			index += 1;//console.log(len);
			if(index == len) {index = 0;}
			if(index == len - 1){
				//显示Form
				$('.formhtml').html('');
				app.find('ul li:last').html(formhtml);
				initialize_province();
				$('#model').change(function(){
					$("#dealer").empty().append('<option value="-1" selected="selected">请选择经销商</option>');
					city();
				});
				$('#city').change(function(){
					initialize_city($(this).val());
				});
			}
			showBtns(index);
			showPics(index);
		});
		
		function showPics(index) {
			var nowLeft = -index*sWidth;
			app.find('ul').stop(true,false).animate({'left':nowLeft},300); 
		}
		
		function showBtns(index){
			btn_next.show();
			btn_prev.show();
			if(index == 0) { 
				btn_prev.hide();//第二屏上一个按钮点击事件后隐藏该按钮
			}else if(index == len-1) {
				btn_next.hide();//倒数第二屏下一个按钮点击事件后隐藏该按钮
			}
		}	
		
		//判断浏览类型
		var Sys = {};
		var ua = navigator.userAgent.toLowerCase();
		var s;
		(s = ua.match(/version\/([\d.]+).*safari/)) ? Sys.safari = s[1] : 0;
		//if(Sys.safari){
			/*屏幕触动监听*/
			$(".pop_slide ul").touchwipe({
				 wipeLeft: function() { 
					if(index<4){
						index++;
						if(index == len - 1){
							//显示Form
							$('.formhtml').html('');
							app.find('ul li:last').html(formhtml);
							initialize_province();
							$('#model').change(function(){
								$("#dealer").empty().append('<option value="-1" selected="selected">请选择经销商</option>');
								city();
							});
							$('#city').change(function(){
								initialize_city($(this).val());
							});
						}
						showBtns(index);
						showPics(index);
					}
				 },
				 wipeRight: function() { 
					if(index>0){
						index--;
						showBtns(index);
						showPics(index);
					}
				 },
				 min_move_x: 20,
				 min_move_y: 20,
				 preventDefaultEvents: false
			});
			
		//}
		
		
		
		
	}
	
})(jQuery)
	
	
jQuery(function ($) {
	
	//尊崇服务
	$('.title_service li').click(function(){
		var index = $('.title_service li').index(this);
		$(this).removeClass('on').siblings('li').addClass('on');
		$('.concentService').eq(index).show().siblings('.concentService').hide();
	})
});

function Share(weburl){
	var myurl = "";
	var title="";
	var openurl = "http://service.weibo.com/share/share.php?url="+myurl+"&appkey=&title="+encodeURIComponent(title);
	window.open(openurl);
}

function FormLogin(){
	
	var $parent = $('.verify');
	$parent.find('.onError').remove();
	
	if($('#dealer option:selected').val()=="-1"){
		var errorMsg = '请选择经销商！';
		$parent.append('<span class="onError">'+errorMsg+'</span>');
	}else
	if($('#selmodel option:selected').val()=="-1"){
		var errorMsg = '请选择车型！';
		$parent.append('<span class="onError">'+errorMsg+'</span>');
	}else if($('input:checkbox[name="RequestTypeID"]:checked').val()==null){
		var errorMsg = '请在预约看车及索取资料中任勾选一个！';
		$parent.append('<span class="onError">'+errorMsg+'</span>');
	}else if($('#driverName').val()==""){
		var errorMsg = '请输入姓名！';
		$parent.append('<span class="onError">'+errorMsg+'</span>');		
	}else if($('input:radio[name="sex"]:checked').val()==null){
		var errorMsg = '请选择称谓！';
		$parent.append('<span class="onError">'+errorMsg+'</span>');
	}else if($('#driverPhone').val()==""||$('#driverPhone').val()!==""&&!/^1[3|4|5|8][0-9]\d{4,8}$/.test($('#driverPhone').val())){
		var errorMsg = '请输入正确的手机号码！';
		$parent.append('<span class="onError">'+errorMsg+'</span>');
	}else if($('#driverPlan option:selected').val()=="-1"){
		var errorMsg = '请选择计划购车时间！';
		$parent.append('<span class="onError">'+errorMsg+'</span>');
	}else{
		submitData();
	}
}

//弹窗
var popupStatus = 0;
function loadPopup(){	
	if(popupStatus==0){
		var docheight = $(document).height();		
		$("body").append("<div id='backgroundPopup'></div>");
		$("#backgroundPopup").css({"opacity":"0.5","height":docheight});
		popupStatus = 1;
	}
}

function closePopup(){	
	if(popupStatus==1){
		$("[id*='popupWin']").fadeOut("slow");
		$("#backgroundPopup").remove();
		popupStatus = 0;
	}
}
function lottery(){	
	$('#popupWin').fadeIn(300);
	loadPopup();
}

/* 2013.09.21 */
function atsOrder(){
	
	var $parent = $('.verify');
	$parent.find('.onError').remove();
	
	if($('#atsUserName').val()==""){
		var errorMsg = '请输入姓名！';
		$parent.append('<span class="onError">'+errorMsg+'</span>');		
	}else if($('#atsUserPhone').val()==""||$('#atsUserPhone').val()!==""&&!/^1[3|4|5|8][0-9]\d{4,8}$/.test($('#atsUserPhone').val())){
		var errorMsg = '请输入正确的手机号码！';
		$parent.append('<span class="onError">'+errorMsg+'</span>');
	}else{
		AtsSubmitData();
	}
}

function Request(strName, defaultValue) {
    var strHref = location.href;
    var intPos = strHref.indexOf("?");
    var strRight = strHref.substr(intPos + 1);
    var arrTmp = strRight.split("&");
    for (var i = 0; i < arrTmp.length; i++) {
        var arrTemp = arrTmp[i].split("=");
        if (arrTemp[0].toUpperCase() == strName.toUpperCase()) return arrTemp[1];
    }
    return defaultValue;
}


/*
	新增监测 2013.11.07 Start
*/
function AddTracking(tag){
	// GA
	var pageTracker = _gat._getTracker("UA-17663917-2");
	pageTracker._trackPageview(tag, tag, tag);
	
	// 官网
	trackclick(tag);
}
/*
按钮监测
*/
function trackclick(linkname) {
    $.ajax({
        type: "POST",
        url: "../api/click.ashx?ts=" + new Date().getTime(),
        data: {
            "linkname": linkname
        },
        async:false,
        success: function (xml) {
        }
    });
}
/*
	新增监测 2013.11.07 End
*/