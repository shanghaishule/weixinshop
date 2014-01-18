// JavaScript Document
$.fn.SlideTab=function(options){
	var SlideTab={TabBtn:"",TabCont:"",TabBtnLi:"li",TabShow:0,TabBtnStyle:"",TabTime:300,MinNum:0};
	var options=$.extend(SlideTab,options);
	var $TabID = $(this);
	var $TabBtnLi = $TabID.find(options.TabBtn).find(options.TabBtnLi);
	var $TabCont = $TabID.find(options.TabCont);
	var TabWidht = $(this).outerWidth(true);
	var ShowNum = options.TabShow;
	$TabBtnLi.eq(ShowNum).addClass(options.TabBtnStyle);
	$TabCont.css({"left":TabWidht}).eq(ShowNum).css({"left":options.MinNum});
	$TabBtnLi.click(function(){
		var TabBtnLiLen=$TabBtnLi.index(this);
		if(TabBtnLiLen==ShowNum){return false;}
		$(this).addClass(options.TabBtnStyle).siblings(options.TabBtnLi).removeClass(options.TabBtnStyle);
		if(TabBtnLiLen>ShowNum){
			$TabCont.eq(TabBtnLiLen).css({"left":TabWidht});
			$TabCont.eq(ShowNum).animate({left:-TabWidht},options.TabTime);
			}
		else{
			$TabCont.eq(TabBtnLiLen).css({"left":-TabWidht});
			$TabCont.eq(ShowNum).animate({left:TabWidht},options.TabTime);
			}
		ShowNum = TabBtnLiLen
		$TabCont.eq(ShowNum).animate({left:options.MinNum},options.TabTime);
		})
	};
/* 示例 */
/*$(document).ready(function(){
	$("#BanCont").SlideBtn({
		TabBtn:""          //按钮的样式名（可ID,Class）
		,TabCont:""        //需要移动的内容样式名
		,TabBtnLi:"li"     //按钮的名称
		,TabShow:0         //默认显示第几个
		,TabBtnStyle:""    //点击后的样式名
		,TabTime:300       //移动使用的时间（毫秒）
		});
	})*/