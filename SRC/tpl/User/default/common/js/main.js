// JavaScript Document

$(function(){
	if($(".selected").length>0){
		n = $(".selected").attr("id");
		setTab(n);
	}
});

$(document).scroll(function(){
	if($(document).scrollTop()>158){
		$("#floatline").css("display","block");
		$("#floatline").css("top","0px");
		$("#Menu").addClass("menufloat");
	}
	else{
		$("#floatline").css("display","none");
		$("#Menu").removeClass("menufloat");
	}
});

/*IEÏÂµÄÆ¯¸¡*/
$(window).scroll(function(){
	if($(document).scrollTop()>158){
		$("#floatline").css("display","block");
		$("#floatline").css("top","0px");
		$("#Menu").addClass("menufloat");
	}
	else{
		$("#floatline").css("display","none");
		$("#Menu").removeClass("menufloat");
	}
});

function setTab(idstr){
	n = idstr.substring(2);
	imgsrc = $("#tm"+n).find("img").attr("src");
	txt = $("#tm"+n).find("span").html();
	$(".top").find("img").attr("src",imgsrc);
	$(".top").find("a").html(txt);
	
	$(".TwoMenu div").hide();
	$("#TwoMenu-0"+n).show();
	
	$(".ThreeMenu div").hide();
	$("#con-0"+n).show();
	
	$("#confrm").attr("src",n+".html");

}