(function(a){a.fn.switchable=function(c){return this.each(function(){var n=a.extend({},a.fn.switchable.deflunt,c),g=0,f=a(this),h="",w=a(".JQ_next",f),v=a(".JQ_prev",f),o=a("."+n.claCon,f),d=o.children().size(),e=a("."+n.claNav,f),t,s,q,m,k=o.children().first().outerHeight(true);if(n.effect=="fade"){o.children().css({position:"absolute",left:"0",top:"0","z-index":"0",opacity:"0"}).first().css({"z-index":"1",opacity:"1"});t=d-1}else{if(n.effect=="scrollY"){k=o.children().first().outerHeight(true);o.css("height",d*k);o.children().css({"float":"left"});t=Math.ceil((d-Math.ceil(a("."+n.claBox,a(this)).width()/k))/n.steps);if(n.loop==true){n.effect=n.effect+"_loop"}}else{if(n.effect=="scrollX"){k=o.children().first().outerWidth(true);o.css("width",d*k);o.children().css({"float":"left"});t=Math.ceil((d-Math.ceil(a("."+n.claBox,a(this)).width()/k))/n.steps);if(n.loop==true){n.effect=n.effect+"_loop"}}else{if(n.effect=="accordion"){var u=o.find(".JQ_touchbar");u.bind(n.action,function(){if(n.loop===false){u.parent().removeClass("current");a(this).parent().addClass("current")}else{a(this).parent().toggleClass("current")}});return}}}}if(e.length!==0){var l="",r=0,p;for(;r<=t;r++){p=r+1;if(r==0){l+="<li class='current'><a href='javascript:;'>"+p+"</a></li>"}else{l+="<li><a href='javascript:;'>"+p+"</a></li>"}}e.append(l);h=a("."+n.claNav+" li",f)}else{h=a("."+n.claPrv+" li",f)}s=function(){if(n.loop===false){g+=1;if(g>t){g=0}}else{g=1}a.fn.switchable.effect[n.effect](o,h,g,k,n)};if(n.autoPlay){q=setInterval(s,n.timer);f.hover(function(){clearInterval(q)},function(){q=setInterval(s,n.timer)})}h.bind(n.action,function(){g=h.index(this);if(n.effect==="click"){a.fn.switchable.effect[n.effect](o,h,g,k,n)}else{m=setTimeout(function(){a.fn.switchable.effect[n.effect](o,h,g,k,n)},200)}});if(n.action==="mouseover"){h.bind("mouseout",function(){clearTimeout(m)})}w.click(function(i){g+=1;if(g>t){g=0}a.fn.switchable.effect[n.effect](o,h,g,k,n);i.preventDefault()});v.click(function(i){g-=1;if(g*n.steps<0){g=t}a.fn.switchable.effect[n.effect](o,h,g,k,n);i.preventDefault()})})};a.fn.switchable.deflunt={effect:"none",action:"mouseover",autoPlay:false,speed:"normal",timer:1000,steps:1,claNav:"JQ_switchable_nav",claPrv:"JQ_switchable_prv",claCon:"JQ_switchable_content",claBox:"JQ_contact_box",tween:"swing",loop:false};a.fn.switchable.effect={fade:function(e,d,f,c,g){e.children().eq(f).stop().animate({opacity:1},g.speed,g.tween).css({"z-index":"1"}).siblings().stop().animate({opacity:0},g.speed,g.tween).css({"z-index":"0"});b(d,f)},scrollX:function(e,d,f,c,g){e.stop().animate({left:-f*g.steps*c},g.speed,g.tween);b(d,f)},scrollY:function(d,c,f,e,g){d.stop().animate({top:-f*g.steps*e},g.speed,g.tween);b(c,f)},none:function(e,d,f,c,g){e.children().eq(f).show().siblings().hide();b(d,f)},scrollY_loop:function(e,d,f,c,g){e.stop().animate({top:-f*g.steps*c},g.speed,function(){for(var h=0;h<g.steps;h++){e.children().first().appendTo(e)}e.css({top:"0px"})})},scrollX_loop:function(e,d,f,c,g){e.stop().animate({left:-f*g.steps*c},g.speed,function(){for(var h=0;h<g.steps;h++){e.children().first().appendTo(e)}e.css({left:"0px"})})}};function b(c,d){if(c){c.eq(d).addClass("current").siblings().removeClass("current")}}})(jQuery);
/*鍦嗚鎻掍欢*/
(function($){var style=document.createElement('div').style,moz=style['MozBorderRadius']!==undefined,webkit=style['WebkitBorderRadius']!==undefined,radius=style['borderRadius']!==undefined||style['BorderRadius']!==undefined,mode=document.documentMode||0,noBottomFold=$.browser.msie&&(($.browser.version<8&&!mode)||mode<8),expr=$.browser.msie&&(function(){var div=document.createElement('div');try{div.style.setExpression('width','0+0');div.style.removeExpression('width')}catch(e){return false};return true})();$.support=$.support||{};$.support.borderRadius=moz||webkit||radius;function sz(el,p){return parseInt($.css(el,p))||0};function hex2(s){s=parseInt(s).toString(16);return(s.length<2)?'0'+s:s};function gpc(node){while(node){var v=$.css(node,'backgroundColor'),rgb;if(v&&v!='transparent'&&v!='rgba(0, 0, 0, 0)'){if(v.indexOf('rgb')>=0){rgb=v.match(/\d+/g);return'#'+hex2(rgb[0])+hex2(rgb[1])+hex2(rgb[2])};return v};if(node.nodeName.toLowerCase()=='html')break;node=node.parentNode};return'#ffffff'};function getWidth(fx,i,width){switch(fx){case'round':return Math.round(width*(1-Math.cos(Math.asin(i/width))));case'cool':return Math.round(width*(1+Math.cos(Math.asin(i/width))));case'sharp':return width-i;case'bite':return Math.round(width*(Math.cos(Math.asin((width-i-1)/width))));case'slide':return Math.round(width*(Math.atan2(i,width/i)));case'jut':return Math.round(width*(Math.atan2(width,(width-i-1))));case'curl':return Math.round(width*(Math.atan(i)));case'tear':return Math.round(width*(Math.cos(i)));case'wicked':return Math.round(width*(Math.tan(i)));case'long':return Math.round(width*(Math.sqrt(i)));case'sculpt':return Math.round(width*(Math.log((width-i-1),width)));case'dogfold':case'dog':return(i&1)?(i+1):width;case'dog2':return(i&2)?(i+1):width;case'dog3':return(i&3)?(i+1):width;case'fray':return(i%2)*width;case'notch':return width;case'bevelfold':case'bevel':return i+1;case'steep':return i/2+1;case'invsteep':return(width-i)/2+1}};$.fn.corner=function(options){if(this.length==0){if(!$.isReady&&this.selector){var s=this.selector,c=this.context;$(function(){$(s,c).corner(options)})};return this};return this.each(function(index){var $this=$(this),o=[$this.attr($.fn.corner.defaults.metaAttr)||'',options||''].join(' ').toLowerCase(),keep=/keep/.test(o),cc=((o.match(/cc:(#[0-9a-f]+)/)||[])[1]),sc=((o.match(/sc:(#[0-9a-f]+)/)||[])[1]),width=parseInt((o.match(/(\d+)px/)||[])[1])||10,re=/round|bevelfold|bevel|notch|bite|cool|sharp|slide|jut|curl|tear|fray|wicked|sculpt|long|dog3|dog2|dogfold|dog|invsteep|steep/,fx=((o.match(re)||['round'])[0]),fold=/dogfold|bevelfold/.test(o),edges={T:0,B:1},opts={TL:/top|tl|left/.test(o),TR:/top|tr|right/.test(o),BL:/bottom|bl|left/.test(o),BR:/bottom|br|right/.test(o)},strip,pad,cssHeight,j,bot,d,ds,bw,i,w,e,c,common,$horz;if(!opts.TL&&!opts.TR&&!opts.BL&&!opts.BR)opts={TL:1,TR:1,BL:1,BR:1};if($.fn.corner.defaults.useNative&&fx=='round'&&(radius||moz||webkit)&&!cc&&!sc){if(opts.TL)$this.css(radius?'border-top-left-radius':moz?'-moz-border-radius-topleft':'-webkit-border-top-left-radius',width+'px');if(opts.TR)$this.css(radius?'border-top-right-radius':moz?'-moz-border-radius-topright':'-webkit-border-top-right-radius',width+'px');if(opts.BL)$this.css(radius?'border-bottom-left-radius':moz?'-moz-border-radius-bottomleft':'-webkit-border-bottom-left-radius',width+'px');if(opts.BR)$this.css(radius?'border-bottom-right-radius':moz?'-moz-border-radius-bottomright':'-webkit-border-bottom-right-radius',width+'px');return};strip=document.createElement('div');$(strip).css({overflow:'hidden',height:'1px',minHeight:'1px',fontSize:'1px',backgroundColor:sc||'transparent',borderStyle:'solid'});pad={T:parseInt($.css(this,'paddingTop'))||0,R:parseInt($.css(this,'paddingRight'))||0,B:parseInt($.css(this,'paddingBottom'))||0,L:parseInt($.css(this,'paddingLeft'))||0};if(typeof this.style.zoom!=undefined)this.style.zoom=1;if(!keep)this.style.border='none';strip.style.borderColor=cc||gpc(this.parentNode);cssHeight=$(this).outerHeight();for(j in edges){bot=edges[j];if((bot&&(opts.BL||opts.BR))||(!bot&&(opts.TL||opts.TR))){strip.style.borderStyle='none '+(opts[j+'R']?'solid':'none')+' none '+(opts[j+'L']?'solid':'none');d=document.createElement('div');$(d).addClass('jquery-corner');ds=d.style;bot?this.appendChild(d):this.insertBefore(d,this.firstChild);if(bot&&cssHeight!='auto'){if($.css(this,'position')=='static')this.style.position='relative';ds.position='absolute';ds.bottom=ds.left=ds.padding=ds.margin='0';if(expr)ds.setExpression('width','this.parentNode.offsetWidth');else ds.width='100%'}else if(!bot&&$.browser.msie){if($.css(this,'position')=='static')this.style.position='relative';ds.position='absolute';ds.top=ds.left=ds.right=ds.padding=ds.margin='0';if(expr){bw=sz(this,'borderLeftWidth')+sz(this,'borderRightWidth');ds.setExpression('width','this.parentNode.offsetWidth - '+bw+'+ "px"')}else ds.width='100%'}else{ds.position='relative';ds.margin=!bot?'-'+pad.T+'px -'+pad.R+'px '+(pad.T-width)+'px -'+pad.L+'px':(pad.B-width)+'px -'+pad.R+'px -'+pad.B+'px -'+pad.L+'px'};for(i=0;i<width;i++){w=Math.max(0,getWidth(fx,i,width));e=strip.cloneNode(false);e.style.borderWidth='0 '+(opts[j+'R']?w:0)+'px 0 '+(opts[j+'L']?w:0)+'px';bot?d.appendChild(e):d.insertBefore(e,d.firstChild)};if(fold&&$.support.boxModel){if(bot&&noBottomFold)continue;for(c in opts){if(!opts[c])continue;if(bot&&(c=='TL'||c=='TR'))continue;if(!bot&&(c=='BL'||c=='BR'))continue;common={position:'absolute',border:'none',margin:0,padding:0,overflow:'hidden',backgroundColor:strip.style.borderColor};$horz=$('<div/>').css(common).css({width:width+'px',height:'1px'});switch(c){case'TL':$horz.css({bottom:0,left:0});break;case'TR':$horz.css({bottom:0,right:0});break;case'BL':$horz.css({top:0,left:0});break;case'BR':$horz.css({top:0,right:0});break};d.appendChild($horz[0]);var $vert=$('<div/>').css(common).css({top:0,bottom:0,width:'1px',height:width+'px'});switch(c){case'TL':$vert.css({left:width});break;case'TR':$vert.css({right:width});break;case'BL':$vert.css({left:width});break;case'BR':$vert.css({right:width});break};d.appendChild($vert[0])}}}}})};$.fn.uncorner=function(){if(radius||moz||webkit)this.css(radius?'border-radius':moz?'-moz-border-radius':'-webkit-border-radius',0);$('div.jquery-corner',this).remove();return this};$.fn.corner.defaults={useNative:true,metaAttr:'data-corner'}})(jQuery);
/*IE6png閫忔槑*/
(function($){var jspath=$('script').last().attr('src');var basepath='';if(jspath.indexOf('/')!=-1){basepath+=jspath.substr(0,jspath.lastIndexOf('/')+1);}$.fn.fixpng=function(options){function _fix_img_png(el,emptyGIF){var images=$('img[src*="png"]',el||document),png;images.each(function(){png=this.src;width=this.width;height=this.height;this.src=emptyGIF;this.width=width;this.height=height;this.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+png+"',sizingMethod='scale')";});}function _fix_bg_png(el){var bg=$(el).css('background-image');if(/url\([\'\"]?(.+\.png)[\'\"]?\)/.test(bg)){var src=RegExp.$1;$(el).css('background-image','none');$(el).css("filter","progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+src+"',sizingMethod='scale')");}}if($.browser.msie&&$.browser.version<7){return this.each(function(){var opts={scope:'',emptyGif:basepath+'blank.gif'};$.extend(opts,options);switch(opts.scope){case'img':_fix_img_png(this,opts.emptyGif);break;case'all':_fix_img_png(this,opts.emptyGif);_fix_bg_png(this);break;default:_fix_bg_png(this);break;}});}}})(jQuery);
//鍏ㄥ眬鍑芥暟
function pressCaptcha(obj){obj.value=obj.value.toUpperCase()};function ResumeError(){return true};window.onerror=ResumeError;function SetHome(obj,vrl){try{obj.style.behavior='url(#default#homepage)';obj.setHomePage(vrl)}catch(e){if(window.netscape){try{netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect")}catch(e){alert("Your Browser does not support")};var prefs=Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);prefs.setCharPref('browser.startup.homepage',vrl)}}};function addFavorite(){var vDomainName=window.location.href;var description=document.title;try{window.external.AddFavorite(vDomainName,description)}catch(e){window.sidebar.addPanel(description,vDomainName,"")}};function metHeight(group){tallest=0;group.each(function(){thisHeight=$(this).height();if(thisHeight>tallest){tallest=thisHeight}});group.height(tallest)};function metmessagesubmit(info3,info4){if(document.myform.pname.value.length==0){alert(info3);document.myform.pname.focus();return false};if(document.myform.info.value.length==0){alert(info4);document.myform.info.focus();return false}};function addlinksubmit(info2,info3){if(document.myform.webname.value.length==0){alert(info2);document.myform.webname.focus();return false};if(document.myform.weburl.value.length==0||document.myform.weburl.value=='http://'){alert(info3);document.myform.weburl.focus();return false}};function textWrap(my){var text='',txt=my.text();txt=txt.split("");for(var i=0;i<txt.length;i++){text+=txt[i]+'<br/>'};my.html(text)}
//浠ヤ笂JS浠ｇ爜涓嶅缓璁幓闄わ紝灏ゅ叾鏄叏灞€鍑芥暟銆�
/*妯℃澘瀹氫箟鍑芥暟*/
function proxy(dom,lei,type){
	if(dom){
		dom.hover(function(){
			$(this).addClass(lei);
			if(type==1){
				if($(this).find('.sub').length>0){
					$(this).find('.sub').show()
				}
				else{
					$(this).addClass(lei+'er')
				}
			}
		}
		,function(){
			$(this).removeClass(lei);
			if(type==1){
				if($(this).find('.sub').length>0){
					$(this).find('.sub').hide()
				}
				else{
					$(this).removeClass(lei+'er');
				}
			}
		})
	}
}
function navnow(dom,part2,part3,none){
	var li=dom.find(".navnow dt[id*='part2_']");
	var dl=li.next("dd.sub");
	if(none)dl.hide();
	if(part2.next("dd.sub").length>0)part2.next("dd.sub").show();
	if(part3.length>0)part3.parent('dd.sub').show();
	li.bind('click',function(){
		var fdl=$(this).next("dd.sub");
		if(fdl.length>0){
			fdl.is(':hidden')?fdl.show():fdl.hide();
			fdl.is(':hidden')?$(this).removeClass('launched'):$(this).addClass('launched');
		}
	})
}
function partnav(c2,c3,jsok){
	var part2=$('#part2_'+c2);
	var part3=$('#part3_'+c3);
	if(part2)part2.addClass('on');
	if(part3)part3.addClass('on');
	if(jsok!=0)navnow($('#sidebar'),part2,part3);
}
function DownWdith(group){
	tallest=0;
	group.each(function(){
		thisWdith=$(this).width();
		if(thisWdith>tallest){
			tallest=thisWdith
		}
	});
	group.width(tallest);
}
function Iframedom(){
	var Iframe=$("#iframe");
	var Iframe_Conts=Iframe.contents().find("body");
	Iframe_Conts.css("height","100%");
	var Iframe_div=Iframe_Conts.find("div.main_deng");
	var Iframe_div1=Iframe_Conts.find("div.main_zhuce");
	Iframe_div.css("margin","0px auto");
	Iframe_div1.css("margin","0px auto");
	var Iframe_Height=Iframe_Conts.outerHeight(true);
	Iframe.height(Iframe_Height);
}
function productlist(dom,l){
	var w=dom.width();
	var p=((w/l)-dom.find('li').width())/2;
	if(p<0)p=0;
	dom.find('li').css("margin","0px "+p+"px");
}
/*鑷畾涔夊嚱鏁扮粨鏉�*/
//浠ヤ笅涓烘墽琛屼唬鐮�

var navdown=$("#nav_"+$(".met-nav").data('navdown')),module=Number($(".met-nav").data('module')),classnow=Number($(".met-nav").data('classnow'));
	$(".met-head h2 a,.met-nav li a").bind("focus",function(){if(this.blur)this.blur();});//IE
	proxy($(".met-nav ul li[class!='line']"),'hover');//榧犳爣缁忚繃瀵艰埅
	if(navdown)navdown.addClass('navdown');//褰撳墠鏍忕洰
	$('.met-nav ul li').hover(
		function () {
			$(this).addClass("hover");
			$(this).find('dl').show();    
		},
		function () {
			$(this).removeClass("hover");
			$(this).find('dl').stop(true,true);
			$(this).find('dl').hide();
		}
	);
if(module!=10001){//鎵€鏈夊唴椤�
	var csnow=$("#sidebar").attr('data-csnow'),class3=$("#sidebar").attr('data-class3'),jsok=$("#sidebar").attr('data-jsok');
	partnav(csnow,class3,jsok);//渚ф爮瀵艰埅鐐瑰嚮灞曞紑闅愯棌
	/*
	$.fn.smartFloat = function() {
		var position = function(element) {
			var top = element.position().top, pos = element.css("position");
			$(window).scroll(function() {
				var scrolls = $(this).scrollTop();
				if (scrolls > 260) {
					var zh=(scrolls-260)+$(this).height();
					var zz = $('.sb_box').height();
					var k = zh>zz?zz-zh:0;
					if (window.XMLHttpRequest){
						element.css({
							position: "fixed",
							top: k
						});	
					}else{
						alert(k);
						element.css({
							margin-top: k
						});	
					}
				}else {
					element.css({
						position: pos,
						top: top
					});	
				}
			});
	};
		return $(this).each(function() {
			position($(this));						 
		});
	};
	//缁戝畾
	$(".sb_nav_box").smartFloat();*/
}
switch(module){
	case 10001://棣栭〉
		function autoPlay(){
			if(i>($('.flash_icon a').size()-1)) i=0;
			$('.flash_list').eq(i).fadeIn().siblings('.flash_list').fadeOut();
			$('.flash_icon a').eq(i).addClass('active').siblings().removeClass('active');
			i++;
		}
		var i = 0;
		var timer;
		$(function(){
			 timer = setInterval(autoPlay,3000);
			 $('.flash_list,.flash_icon a').mouseover(function(){ clearInterval(timer)});
			 $('.flash_list,.flash_icon a').mouseout(function(){timer = setInterval(autoPlay,3000)});
			 selectPlay();
		});
		function selectPlay(){
			$('.flash_icon a').each(function(index) {
				$(this).click(function(){
					$('.flash_list').eq(index).fadeIn().siblings('.flash_list').fadeOut();
					$('.flash_icon a').eq(index).addClass('active').siblings().removeClass('active');
				});
			});
		}
		$("#caseshow ol.metlist").height(function(){
			return $(this).find('li').size()*170;
		});
		$("#caseshow").switchable({
			effect:"scrollY",
			loop:true,
			autoPlay:true,
			speed:200,
			timer:3000,
			steps:1
		});
	break;
	case 268://浜у搧妯″潡
		var plist = $('#productlist');
		if(plist.size()>0){
			metHeight(plist.find('li'));
			$('#mb_hy').click(function(){	
				var dm=$(this).find('.mb_fl');
				dm.is(':hidden')?dm.show():dm.hide();
			});
			if($('.md_serch_txt').val()=='')$('.md_bh label').show();
			$('.md_serch_txt').focus(function(){
				$('.md_bh label').hide();
			});
			$('.md_serch_txt').focusout(function(){
				if($(this).val()=='')$('.md_bh label').show();
			});
		}else{
			var pshow=$(".pshow");
			var pshow_ddwh=pshow.width()-pshow.find("dt").width();
			pshow.find("dd").width(pshow_ddwh);
			var parlt=$('.pshow dd li');
			parlt.each(function(){
				var parst=$(this).find('span');
				if(parst.height()<$(this).height())parst.height($(this).height());
			});
		}
	break;
	case 269://涓嬭浇妯″潡
		var showdownload = $('#showdownload');
		if(showdownload.size()>0){
			var parlt=$('.paralist li');
			parlt.each(function(){
				var parst=$(this).find('span');
				if(parst.height()<$(this).height())parst.height($(this).height());
			});
			DownWdith($('.paralist li span.name'));
			$('.paralist li:last').css("border-bottom","0")
		}
	break;
	case 5://鍥剧墖妯″潡
		var ilist = $('#imglist');
		if(ilist.size()>0){
			metHeight(ilist.find('li'));
		}
	break;
}
$('.myCorner').corner();//鍦嗚
var ie6 = (navigator.appName == "Microsoft Internet Explorer" && parseInt(navigator.appVersion) == 4 && navigator.appVersion.indexOf("MSIE 6.0") != -1);
if (jQuery.browser.msie && ie6){
	$(document.body).fixpng({scope:'img'});
}
//QQ鍦ㄧ嚎鐨勯殣钘忔樉绀�
function qq(index){
		var onlineboxShowbox=document.getElementById("onlinebox-showbox");
		var onlineboxConbox=document.getElementById("onlinebox-conbox");
		if(index==0){			
			onlineboxConbox.style.display="";
			onlineboxShowbox.style.display="none";			
		}
		if(index==1){
			onlineboxConbox.style.display="none";
			onlineboxShowbox.style.display="";
		}
	}