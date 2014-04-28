// JavaScript Document
		
var t = n = 0, count; 
$(document).ready(function(){ 
count=$("#slider li").length; 
$("#slider_btn span").click(function() { 
var i = $(this).text() - 1;//获取Li元素内的值，即1，2，3，4 
n = i; 
if (i >= count) return; 
$("#slider li").filter(":visible").fadeOut(500).parent().children().eq(i).fadeIn(1000); 
$(this).css({"background":"url(/static/images/admin/pancl/flashbutton.gif)",'color':'#fff'}).siblings().css({"background":"url(/static/images/admin/pancl/flashbutton.gif) no-repeat scroll -15px 0 transparent",'color':'#000'}); 
}); 
t = setInterval("showAuto()", 3000); 
$("#slider").hover(function(){clearInterval(t)}, function(){t = setInterval("showAuto()", 3000);}); 
}) 

function showAuto() 
{ 
n = n >=(count - 1) ? 0 : ++n; 
$("#slider li").eq(n).trigger('click'); 
} 



