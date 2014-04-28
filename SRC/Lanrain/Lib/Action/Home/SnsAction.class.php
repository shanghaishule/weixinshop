<?php
class SnsAction extends BaseAction{
	public function _initialize(){
		parent::_initialize();
		Vendor('Oauth.Oauth2.php');
	}
	public function login(){
		define('BASEPATH','1');
		$name=$this->_get('name');
		$app=C($name);
		//new Oauth2();
		include realpath('YiCms/Extend/Vendor/Oauth/Oauth2.php');
		$status=Oauth2::provider($name,$app);
		dump($status);
	}
}