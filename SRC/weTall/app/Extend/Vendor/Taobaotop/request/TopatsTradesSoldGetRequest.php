<?php
/**
 * TOP API: taobao.topats.trades.sold.get request
 * 
 * @author auto create
 * @since 1.0, 2012-11-05 12:39:25
 */
class TopatsTradesSoldGetRequest
{
	/** 
	 * 订单创建结束时间，格式yyyyMMdd，取值范围：前3个月内~昨天，其中start_time<=end_time，如20120531相当于取订单创建时间到2012-05-31 23:59:59为止的订单。注：如果start_time和end_time相同，表示取一天的订单数据。<span style="color:red">强烈建议超大卖家（直充类，金冠类）把三个月订单拆分成3次来获取，否则单个任务会消耗很长时间。<span>
	 **/
	private $endTime;
	
	/** 
	 * Trade和Order结构体中的所有字段。<span style="color:red">请尽量按需获取，如果只取tid字段，获取订单数据速度会超快。</span>
	 **/
	private $fields;
	
	/** 
	 * 订单创建开始时间，格式yyyyMMdd，取值范围：前3个月内~昨天。如：20120501相当于取订单创建时间从2012-05-01 00:00:00开始的订单。
	 **/
	private $startTime;
	
	private $apiParas = array();
	
	public function setEndTime($endTime)
	{
		$this->endTime = $endTime;
		$this->apiParas["end_time"] = $endTime;
	}

	public function getEndTime()
	{
		return $this->endTime;
	}

	public function setFields($fields)
	{
		$this->fields = $fields;
		$this->apiParas["fields"] = $fields;
	}

	public function getFields()
	{
		return $this->fields;
	}

	public function setStartTime($startTime)
	{
		$this->startTime = $startTime;
		$this->apiParas["start_time"] = $startTime;
	}

	public function getStartTime()
	{
		return $this->startTime;
	}

	public function getApiMethodName()
	{
		return "taobao.topats.trades.sold.get";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->endTime,"endTime");
		RequestCheckUtil::checkNotNull($this->fields,"fields");
		RequestCheckUtil::checkNotNull($this->startTime,"startTime");
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
