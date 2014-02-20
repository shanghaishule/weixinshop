<?php
vendor('Taobaotop.TopClient');
vendor('Taobaotop.RequestCheckUtil');
vendor('Taobaotop.Logger');
require_once dirname(__FILE__) . '/taobao.class.php';
class taobao_oauth
{
    private $_need_request = array('code');

    public function __construct($setting) {
        $this->redirect_uri = U('oauth/callback', array('mod'=>'taobao'), '', '', true);
        $this->setting = $setting;
    }
    function getAuthorizeURL() {
      $oauth = new TaobaoTOAuthV2($this->setting['app_key'], $this->setting['app_secret'] );
      return $oauth->getAuthorizeURL($this->redirect_uri);
    }
    public function getUserInfo($request_args) {
        $oauth = new TaobaoTOAuthV2($this->setting['app_key'], $this->setting['app_secret'] );
        $keys = array('code'=>$request_args['code'], 'redirect_uri'=>$this->redirect_uri);
        $token = $oauth->getAccessToken($keys);
        $result['keyid'] = $token['taobao_user_id'];
        $result['keyname'] = $token['taobao_user_nick'];
        $result['keyavatar_small'] = '';
        $result['keyavatar_big'] = '';
        $result['bind_info'] = $token;
        return $result;
    }
    public function getFriends($bind_user, $page, $count) {
        
    }
    public function send($bind_user, $data) {
        //淘宝不发送
    }
    public function follow($bind_user, $uid) {
        
    }
    public function NeedRequest() {
        return $this->_need_request;
    }
    public function CheckTaoBaoSign($top_secret,$top_parameters,$top_sign) {
        $sign = base64_encode(md5($top_parameters.$top_secret,true));
        return $sign == $top_sign;
    }
}