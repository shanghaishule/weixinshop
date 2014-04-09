<?php

/**
 * Wechat
 * 
 * @author www.linauror.com
 * @copyright 2014
 * @version 1.0
 * @access public
 */
class Wechat{

	/**
	 * Wechat::bulidForm()
	 * 构建支付请求数组
	 * @param array $parameter
	 * @param array $config
	 * @return
	 */
	public function bulidForm($parameter, $config) {
       $parameter['package'] = $this->buildPackage($parameter, $config); // 生成订单package
       $paySignArray = array('appid' => $config['appId'], 'noncestr' => $parameter['noncestr'], 'package' => $parameter['package'], 'timestamp' => $parameter['timestamp']);
       $parameter['paysign'] = $this->buildSign($paySignArray, $config);
       return $parameter;
	}

    /**
     * Wechat::buildPackage()
     * 生成package
     * @param array $parameter
     * @param array $config
     * @return string
     */
    public function buildPackage($parameter, $config) {
        $filter = array('bank_type', 'body', 'attach', 'partner', 'out_trade_no', 'total_fee', 'fee_type', 'notify_url',
                        'spbill_create_ip', 'time_start', 'time_expire', 'transport_fee', 'product_fee', 'goods_tag', 'input_charset');
        $base = array(
            'bank_type' => 'WX',
            'fee_type' => '1',
            'input_charset' => 'GBK',
            'partner' => $config['partnerId']
        );
        $parameter = array_merge($parameter, $base);
        $array = array();
        foreach ($parameter as $k => $v) {
            if (in_array($k, $filter)) {
                $array[$k] = $v;
            }
        }
        ksort($array);
        $signPars = '';
        foreach ($array as $k => $v) {
            $signPars .= strtolower($k) . "=" . $v . "&";
        }
        $sign = strtoupper(md5($signPars . 'key=' . $config['partnerKey']));
        $signPars = '';
        foreach ($array as $k => $v) {
            $signPars .= strtolower($k) . "=" . urlencode($v) . "&";
        }        
        
        return $signPars . 'sign=' . $sign;
    }
    
    /**
     * Wechat::getXmlArray()
     * 从xml中获取数组
     * @return array
     */
    public function getXmlArray() {
		$postStr = isset($GLOBALS["HTTP_RAW_POST_DATA"]) ? $GLOBALS["HTTP_RAW_POST_DATA"] : '';
		if ($postStr) {
			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            if (! is_object($postObj)) {
                return false;
            }
            $array = json_decode(json_encode($postObj), true); // xml对象转数组
            return array_change_key_case($array, CASE_LOWER); // 所有键小写
        } else {
            return false;
        }        
    }
    
	/**
	 * Wechat::verifyNotify()
	 * 验证服务器通知
	 * @param array $data
     * @param array $config
	 * @return array
	 */
	public function verifyNotify($data, $config) {
        $xml = $this->getXmlArray();
        if (! $xml || ! $data) {
            return false;
        }
        $AppSignature = $xml['appsignature'];
        unset($xml['signmethod'], $xml['appsignature']);
        $sign = $this->buildSign($xml, $config);
        if ($AppSignature != $sign) {
            return false;
        } elseif ($data['trade_state'] != 0) {
            return false;
        }
        
        return $xml;
	}

	/**
	 * Wechat::buildSign()
	 * 生成sign值
	 * @param array $array
	 * @param array $config
	 * @return string
	 */
	public function buildSign($array, $config) {
		$signPars = "";
        $array['appKey'] = $config['paySignKey'];
		ksort($array);
		foreach($array as $k => $v) {
			if("" != $v && "sign" != $k) {
				$signPars .= strtolower($k) . "=" . $v . "&";
			}
		}
        $signPars = substr($signPars, 0, -1); // 去除最后一个&符号
		$sign = sha1($signPars);
		return $sign;

	}
    
    /**
     * wechat::getAccessToken()
     * 获取access_token
     * @return string
     */
    public function getAccessToken($config) {
        $request = httpRequest('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $config['appId'] . '&secret=' . $config['appSecret']);
        $requestArray = json_decode($request, true);
        if (isset($requestArray['errcode'])) {
            return false;
        }
        $accessToken = $requestArray['access_token'];
        return $accessToken;
    }
    
    /**
     * Wechat::delivernotify()
     * 发货通知
     * @param array $config
     * @param array $parameter
     * @return array
     */
    public function delivernotify($config, $parameter) {
        $url = 'https://api.weixin.qq.com/pay/delivernotify?access_token=' . $this->getAccessToken($config);
        $parameter += array(
            'app_signature' => $this->buildSign($parameter, $config),
            'sign_method' => 'sha1'
        );
        $result = $this->doPost($url, json_encode($parameter));
        return json_decode($result, true);
    }
    
    /**
     * Wechat::orderquery()
     * 订单查询
     * @param array $config
     * @param string $out_trade_no
     * @return array
     */
    public function orderquery($config, $out_trade_no) {
        if (! $config || ! $out_trade_no) {
            return false;
        }
        $url = 'https://api.weixin.qq.com/pay/orderquery?access_token=' . $this->getAccessToken($config);
        $array = array(
            'appid' => $config['appId'],
            'package' => 'out_trade_no=' . $out_trade_no . '&partner=' . $config['partnerId'] . '&sign=' . strtoupper(md5('out_trade_no=' . $out_trade_no . '&partner=' . $config['partnerId'] . '&key=' . $config['partnerkey'])),
            'timestamp' => mktime()
        );
        $array .= array(
            'app_signature' => $this->buildSign($array, $config),
            'sign_method' => 'sha1'
        );
        $result = $this->doPost($url, json_encode($array));
        return json_decode($result, true);
    }
    
    /**
     * Wechat::doPost()
     * post请求
     * @param string $url
     * @param array $data
     * @return
     */
    public function doPost($url, $data) {
        $context = array('http' => array('method' => "POST", 'header' => "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US) \r\n Accept: */*", 'content' => $data));
        $stream_context = stream_context_create($context);
        $request = @file_get_contents($url, FALSE, $stream_context);
        return $request;
    }
}
