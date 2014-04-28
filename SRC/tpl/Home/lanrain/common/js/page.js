function Print(i) {if(isIE) {window.print();} else {var i = i ? i : 'content'; var w = window.open('','',''); w.opener = null; w.document.write('<div style="width:630px;">'+Dd(i).innerHTML+'</div>'); w.window.print();}}
function addFav(t) {document.write('<a href="'+window.location.href+'" title="'+document.title+'" rel="sidebar" onclick="if(UA.indexOf(\'chrome\') != -1){alert(\''+L['chrome_fav_tip']+'\');return false;}window.external.addFavorite(this.href, this.title);return false;">'+t+'</a>');}
function SendPage() {
	var htm = '<form method="post" action="'+MEPath+'sendmail.php" id="dsendmail" target="_blank">';
	htm += '<input type="hidden" name="action" value="page"/>';
	htm += '<input type="hidden" name="title" value="'+$('#title').html()+'"/>';
	htm += '<input type="hidden" name="linkurl" value="'+window.location.href+'"/>';
	htm += '</form>';
	$('#destoon_space').html(htm);
	Dd('dsendmail').submit();
}
function SendFav() {
	var htm = '<form method="post" action="'+MEPath+'favorite.php" id="dfavorite" target="_blank">';
	htm += '<input type="hidden" name="action" value="add"/>';
	htm += '<input type="hidden" name="title" value="'+$('#title').html()+'"/>';
	htm += '<input type="hidden" name="url" value="'+window.location.href+'"/>';
	htm += '</form>';
	$('#destoon_space').html(htm);
	Dd('dfavorite').submit();
}
function Dsearch(i) {
	if(Dd('destoon_kw').value.length < 1 || Dd('destoon_kw').value == L['keyword_message']) {
		Dd('destoon_kw').value = '';window.setTimeout(function(){Dd('destoon_kw').value = L['keyword_message'];}, 500);
		return false;
	}
	if(i && Dd('destoon_search').action.indexOf('/api/') == -1) {$('#destoon_moduleid').remove();$('#destoon_spread').remove();}
	return true;
}
function Dsearch_adv() {Go(Dd('destoon_search').action.indexOf('/api/') != -1 ? DTPath+'api/search.php?moduleid='+Dd('destoon_moduleid').value : Dd('destoon_search').action);}
function Dsearch_top() {if(Dsearch(0)){Dd('destoon_search').action = DTPath+'api/search.php';Dd('destoon_spread').value=1;Dd('destoon_search').submit();}}
function View(s) {window.open(EXPath+'view.php?img='+s);}
function setModule(i, n) {Dd('destoon_search').action = DTPath+'api/search.php';Dd('destoon_moduleid').value = i;searchid = i;Dd('destoon_select').value = n;$('#search_module').fadeOut('fast');Dd('destoon_kw').focus();}
function setTip(w) {Dh('search_tips'); Dd('destoon_kw').value = w; Dd('destoon_search').submit();}
var tip_word = '';
function STip(w) {
	if(w.length < 2) {Dd('search_tips').innerHTML = ''; Dh('search_tips'); return;}
	if(w == tip_word) {return;} else {tip_word = w;}
	makeRequest('action=tipword&mid='+searchid+'&word='+w, AJPath, '_STip');
}
function _STip() {
	if(xmlHttp.readyState==4 && xmlHttp.status==200) {
		if(xmlHttp.responseText) {
			Ds('search_tips'); Dd('search_tips').innerHTML = xmlHttp.responseText + '<label onclick="Dh(\'search_tips\');">'+L['search_tips_close']+'&nbsp;&nbsp;</label>';
		} else {
			Dd('search_tips').innerHTML = ''; Dh('search_tips');
		}
	}
}
function SCTip(k) {
	var o = Dd('search_tips');
	if(o.style.display == 'none') {
		if(o.innerHTML != '') Ds('search_tips');
	} else {
		if(k == 13) {Dd('destoon_search').submit(); return;}
		Dd('destoon_kw').blur();
		var d = o.getElementsByTagName('div'); var l = d.length; var n, p; var c = w = -2;
		for(var i=0; i<l; i++) {if(d[i].className == 'search_t_div_2') c = i;}
		if(c == -2) {
			n = 0; p = l-1;
		} else if(c == 0) {
			n = 1; p = -1;
		} else if(c == l-1) {
			n = -1; p = l-2; 
		} else {
			n = c+1; p = c-1;
		}
		w = k == 38 ? p : n;
		if(c >= 0) d[c].className = 'search_t_div_1';
		if(w >= 0) d[w].className = 'search_t_div_2';
		if(w >= 0) {var r = d[w].innerHTML.split('>'); Dd('destoon_kw').value = r[2];} else {Dd('destoon_kw').value = tip_word;}
	}
}
function user_login() {
	if(Dd('user_name').value.length < 2) {Dd('user_name').focus(); return false;}
	if(Dd('user_pass').value == 'password' || Dd('user_pass').value.length < 6) {Dd('user_pass').focus(); return false;}
}
function show_answer(i) {document.write('<iframe src="'+MEPath+'answer.php?itemid='+i+'" name="destoon_answer" id="des'+'toon_answer" style="width:100%;height:0px;" scrolling="no" frameborder="0"></iframe>');}
function show_task(s) {document.write('<script type="text/javascript" src="'+DTPath+'api/task.js.php?'+s+'&refresh='+Math.random()+'.js"></sc'+'ript>');}
var sell_n = 0;
function sell_tip(o, i) {
	if(o.checked) {sell_n++; Dd('item_'+i).style.backgroundColor='#F1F6FC';} else {Dd('item_'+i).style.backgroundColor='#FFFFFF'; sell_n--;}
	if(sell_n < 0) sell_n = 0;
	if(sell_n > 1) {
		var aTag = o; var leftpos = toppos = 0;
		do {aTag = aTag.offsetParent; leftpos	+= aTag.offsetLeft; toppos += aTag.offsetTop;
		} while(aTag.offsetParent != null);
		var X = o.offsetLeft + leftpos - 10;
		var Y = o.offsetTop + toppos - 70;
		Dd('sell_tip').style.left = X + 'px';
		Dd('sell_tip').style.top = Y + 'px';
		o.checked ? Ds('sell_tip') : Dh('sell_tip');
	} else {
		Dh('sell_tip');
	}
}
function img_tip(o, i) {
	if(i) {
		if(i.indexOf('nopic.gif') == -1) {
			if(i.indexOf('.thumb.') != -1) {var t = i.split('.thumb.');var s = t[0];} else {var s = i;}
			var aTag = o; var leftpos = toppos = 0;
			do {aTag = aTag.offsetParent; leftpos	+= aTag.offsetLeft; toppos += aTag.offsetTop;
			} while(aTag.offsetParent != null);
			var X = o.offsetLeft + leftpos + 90;
			var Y = o.offsetTop + toppos - 20;
			Dd('img_tip').style.left = X + 'px';
			Dd('img_tip').style.top = Y + 'px';
			Ds('img_tip');
			Inner('img_tip', '<img src="'+s+'" onload="if(this.width<200) {Dh(\'img_tip\');}else if(this.width>300){this.width=300;}Dd(\'img_tip\').style.width=this.width+\'px\';"/>')
		}
	} else {
		Dh('img_tip');
	}
}
function GoMobile(url) {
	if((UA.indexOf('phone') != -1 || UA.indexOf('mobile') != -1 || UA.indexOf('android') != -1 || UA.indexOf('ipod') != -1) && get_cookie('mobile') != 'pc' && UA.indexOf('ipad') == -1) {
		Go(url);
	}
}
function oauth_logout() {
	set_cookie('oauth_site', '');
	set_cookie('oauth_user', '');
	window.location.reload();
}
(function() {
	$(window).bind("scroll.back2top", function() {
		var st = $(document).scrollTop(), winh = $(window).height();
        (st > 0) ? $('#back2top').show() : $('#back2top').hide();        
        if(!window.XMLHttpRequest) { $('#back2top').css("top", st + winh - 166);}//IE6
	});
})();