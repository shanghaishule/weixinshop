// JavaScript Document
$(document).ready(function(){
	var $Bottom1WidthLi = $(".Bottom1Width > ul > li");
	var $BottomLiFirst = $(".BottomLiFirst");
	var $BottomLi = $(".BottomLi");
	var BottomBtnShow = false;
	var BottomBtnPlay = true;
	$(".BottomKingTop").animate({height:14});
	$(".BottomBg").animate({height:0});
	$(".BottomBtn").click(function(){
		if($(this).attr("class").indexOf("Active")>=0){
			$(this).removeClass("Active");
			$(".BottomKingTop").animate({height:14});
			$(".BottomBg").animate({height:0});
			}
		else{
			$(this).addClass("Active");
			$(".BottomKingTop").animate({height:58});
			$(".BottomBg").animate({height:44});
			}
		});
	$Bottom1WidthLi.click(function(){
		if(BottomBtnPlay){
			BottomBtnPlay=false;
			var Bottom1ThisLen = $Bottom1WidthLi.index(this);
			$BottomLi.eq(Bottom1ThisLen).siblings(".BottomLi").hide().css({height:0});
			var BottomLiLen = $BottomLi.eq(Bottom1ThisLen).find("li").length;
			if(BottomLiLen>0){
				if($BottomLi.eq(Bottom1ThisLen).height()>1){
					BottomBtnShow = false;
					$BottomLi.eq(Bottom1ThisLen).animate({height:0},function(){BottomBtnPlay=true;});
					$BottomLiFirst.hide();
					$(".BottomBtn").show();
					}
				else{
					BottomBtnShow = true;
					$BottomLi.eq(Bottom1ThisLen).animate({height:BottomLiLen*41+30},function(){BottomBtnPlay=true;});
					$BottomLiFirst.hide();
					$(".BottomBtn").hide();
					};
				}
			else{BottomBtnPlay=true;};
			};
		return false;
		});
	$(window).click(function(){
		if(BottomBtnShow){
			setTimeout(function(){
				$BottomLi.hide().css({height:0});
				$BottomLiFirst.hide();
				if($(".BottomBtn").css("display")=="none")$(".BottomBtn").show();
				},200);
			};
		});
	$(".KingLiCont a").click(function(){
		if(typeof(eval($(this).parent().attr("rel")))=="undefined"){
			BottomBtnShow = false;
			}
		else{
			if($("#"+$(this).parent().attr("rel")).css("display")=="block") return false;
			$BottomLiFirst.hide();
			BottomLiFirstID = $(this).parent().attr("rel");
			var KingLiContNum = $(this).parent().parent().find("a").index(this);
			var KingLiContTop = $(this).position().top;
			var KingLiContLen = $(this).parent().parent().find("li").length;
			var KingLiContLength = $("#"+BottomLiFirstID).find("li").length;
			var KingLiContMaxNum = (5-KingLiContLen+KingLiContNum+1)*41;
			var KingLiContMinNum = KingLiContLength*41;
			if(KingLiContMaxNum>KingLiContMinNum) $("#"+BottomLiFirstID).find(".KingLiBg:first").css({"margin-top":KingLiContMaxNum-KingLiContMinNum});
			else $("#"+BottomLiFirstID).find(".KingLiBg:first").css({"margin-top":0});
			if($("#"+BottomLiFirstID).attr("class").toLowerCase().indexOf("bottomlifirst3")>=0){
				$("#"+BottomLiFirstID).css({"width":0,"left":205,"padding-right":0}).animate({width:100,left:105},function(){$("#"+BottomLiFirstID).css({"padding-right":5}).find(".BottomLiFirstA").css({"display":"block"});}).find(".BottomLiFirstA").css({"top":10*KingLiContNum+30*(KingLiContNum+1)+(5-KingLiContLen)*41,"display":"none"});
				}
			else{
				$("#"+BottomLiFirstID).css({"width":0}).animate({width:100}).find(".BottomLiFirstA").css({"top":10*KingLiContNum+30*(KingLiContNum+1)+(5-KingLiContLen)*41});
				}
			
			BottomBtnShow = true;
			return false;
			};
		});
	$(".KingLiBg").click(function(){
		return false;
		});
	
	$("input,select,textarea").focus(function(){
		$(".top_bg").css({"position":"absolute","top":0})
		$(".BottomKingTop").css({"height":0});
		$(".BottomBg").css({"position":"relative","bottom":"","overflow":"hidden"});
		});
	$("input,select,textarea").blur(function(){
		$(".top_bg").css({"position":"","top":""});
		$(".BottomKingTop").css({"height":""});
		$(".BottomBg").css({"position":"","bottom":0,"overflow":""});
		});
	});
function getIphone(){
	var agent = navigator.userAgent.toLowerCase();
	res = agent.match(/iphone/);
	if(res == "iphone")
		return true;;
	return false;
	};