// JavaScript Document
$(document).ready(function(){
	var IE6 = window.XMLHttpRequest;
	var ShowNum = 0;
	var MinNum = 0;
	var FirNum = 15;
	var SecNum = 100;
	var MaxNum = 1000;
	var SlideMoveSpeed = 5;
	var SlideMoveID = "BanCont";//必须使用ID
	var SlideMoveLi = "li";
	var SlideMoveBtn = ".banner_link";
	var SlideClick = "banner_link_red";
	var SlideMoveAutoPlay = true;//自动播放
	var SlideMoveOr = true;//播放方向(true 自右到左，false 自左到右)
	var SlideWidth = $("#"+SlideMoveID+" > "+SlideMoveLi+":first").outerWidth(true);
	var SlideLiNum = $("#"+SlideMoveID+" > "+SlideMoveLi).length;
	$("#"+SlideMoveID+" > "+SlideMoveLi).eq(ShowNum).css({"left":MinNum}).siblings().css({"left":-SlideWidth});
	if(SlideMoveBtn!=""){
		var SlideMoveBtnCont = "";
		for(i=MinNum;i<SlideLiNum;i++){
			SlideMoveBtnCont += "<li>"+(i+1)+"</li>";
			};
		$(SlideMoveBtn).html(SlideMoveBtnCont);
		$SlideMoveBtnLi = $(SlideMoveBtn).find("li");
		var SlideBtnWidth = $SlideMoveBtnLi.outerWidth(true);
		$(SlideMoveBtn).css({"width":SlideBtnWidth*SlideLiNum});
		$SlideMoveBtnLi.eq(ShowNum).addClass(SlideClick+"1")
		$SlideMoveBtnLi.hover(function(){
			$(this).addClass(SlideClick+"2");
			},function(){
				$(this).removeClass(SlideClick+"2");
				});
		$SlideMoveBtnLi.click(function(){
			SlideMoveThisNum = $SlideMoveBtnLi.index(this);
			if(ShowNum==SlideMoveThisNum){return false;};
			$(this).addClass(SlideClick+"1").siblings().removeClass(SlideClick+"1");
			if(SlideMoveThisNum>ShowNum){
				$("#"+SlideMoveID+" > "+SlideMoveLi).eq(SlideMoveThisNum).css({"left":SlideWidth});
				$("#"+SlideMoveID+" > "+SlideMoveLi).eq(ShowNum).animate({left:-SlideWidth},SlideMoveSpeed*SecNum);
				}
			else{
				$("#"+SlideMoveID+" > "+SlideMoveLi).eq(SlideMoveThisNum).css({"left":-SlideWidth});
				$("#"+SlideMoveID+" > "+SlideMoveLi).eq(ShowNum).animate({left:SlideWidth},SlideMoveSpeed*SecNum);
				};
			ShowNum = SlideMoveThisNum;
			$("#"+SlideMoveID+" > "+SlideMoveLi).eq(ShowNum).animate({left:MinNum},SlideMoveSpeed*SecNum,function(){ThisBtn=true;});
			})
		};
	if(SlideLiNum<=1)return;
	if(getPgjs()){
		GetObj(SlideMoveID).addEventListener("touchstart",function(ev){
			//ev.preventDefault();
			StartX = ev.touches[MinNum].pageX;
			StartY = ev.touches[MinNum].pageY;
			StartPlay=true;
			},false);
		};
	var LeftSlideMove = function(){
		if(SlideMoveAutoPlay) SlideMoveStop();
		$("#"+SlideMoveID+" > "+SlideMoveLi).eq(ShowNum).animate({left:-SlideWidth},SlideMoveSpeed*SecNum);
		ShowNum++;
		if(ShowNum >= SlideLiNum) ShowNum = MinNum;
		$("#"+SlideMoveID+" > "+SlideMoveLi).eq(ShowNum).css({"left":SlideWidth}).animate({left:MinNum},SlideMoveSpeed*SecNum);
		if(SlideMoveBtn!=""){$SlideMoveBtnLi.eq(ShowNum).addClass(SlideClick+"1").siblings().removeClass(SlideClick+"1");};
		if(SlideMoveAutoPlay) SlideMoveAutoGo();
		};
	var RightSlideMove = function(){
		if(SlideMoveAutoPlay) SlideMoveStop();
		$("#"+SlideMoveID+" > "+SlideMoveLi).eq(ShowNum).animate({left:SlideWidth},SlideMoveSpeed*SecNum);
		if(ShowNum <= MinNum) ShowNum = SlideLiNum;
		ShowNum--;
		$("#"+SlideMoveID+" > "+SlideMoveLi).eq(ShowNum).css({"left":-SlideWidth}).animate({left:MinNum},SlideMoveSpeed*SecNum);
		if(SlideMoveBtn!=""){$SlideMoveBtnLi.eq(ShowNum).addClass(SlideClick+"1").siblings().removeClass(SlideClick+"1");};
		if(SlideMoveAutoPlay) SlideMoveAutoGo();
		};
	var SlideMoveAuto = function(){
		if(SlideLiNum>1){
			if(SlideMoveOr){LeftSlideMove();}
			else{RightSlideMove()};
			};
		};
	var SlideMoveAutoGo = function(){
		if(SlideMoveAutoPlay){
			SlideMoveTimer = setTimeout(function(){
				SlideMoveAuto()
				},SlideMoveSpeed*MaxNum);
			};
		};
	if(SlideMoveAutoPlay){
		var SlideMoveTimer = setTimeout(function(){
			SlideMoveAuto()
			},SlideMoveSpeed*MaxNum);
		};
	var SlideMoveStop = function(){
		if(SlideMoveAutoPlay){
			clearTimeout(SlideMoveTimer);
			};
		};
	$("#"+SlideMoveID).hover(function(){
		SlideMoveStop();
		},function(){
			SlideMoveAutoGo();
			});
	if(getPgjs()){
		document.addEventListener("touchmove",function(ev){
			var EndX = ev.touches[MinNum].pageX;
			var EndY = ev.touches[MinNum].pageY;
			if(StartPlay){	
				if(EndX-StartX>MinNum){
					if(EndX-StartX>FirNum){
						ev.preventDefault();
						ev.stopPropagation();
						RightSlideMove();
						StartPlay=false;
						return false;
						};
					}
				else{
					if(Math.abs(EndX-StartX)>FirNum){
						ev.preventDefault();
						ev.stopPropagation();
						LeftSlideMove();
						StartPlay=false;
						return false;
						};
					};
				}
			},false);
		};
	});
function GetObj(id){
	return document.getElementById(id);
	};
function getPgjs(){
	var agent = navigator.userAgent.toLowerCase();
	var res = agent.match(/android/);
	if(res == "android")
		return true;//res+"浏览器";
	res = agent.match(/iphone/);
	if(res == "iphone")
		return true;//"iphone浏览器";
	res = agent.match(/ipad/);
	if(res == "ipad")
		return false;//"ipad浏览器";
	res = agent.match(/windows/);
	if(res == "windows")
		return false;// "电脑上的浏览器";
	return true;//"手机浏览器";
	};