<?php
/**
 * TOP API: taobao.widget.cartpanel.get request
 * 
 * @author auto create
 * @since 1.0, 2012-11-05 12:39:25
 */
class WidgetCartpanelGetRequest
{
	
	private $apiParas = array();
	
	public function getApiMethodName()
	{
		return "taobao.widget.cartpanel.get";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
