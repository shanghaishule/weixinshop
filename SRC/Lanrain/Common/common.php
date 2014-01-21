<?php
function isAndroid(){
	if(strstr($_SERVER['HTTP_USER_AGENT'],'Android')) {
		return 1;
	}
	return 0;
}
function attach($attach, $type) {
	if (false === strpos($attach, 'http://')) {
		//本地附件
		return __ROOT__ . '/weTall/data/upload/' . $type . '/' . $attach;
		//远程附件
		//todo...
	} else {
		//URL链接
		return $attach;
	}
}
?>