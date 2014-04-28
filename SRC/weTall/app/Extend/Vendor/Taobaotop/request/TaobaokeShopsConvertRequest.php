<?php
/**
 * TOP API: taobao.taobaoke.shops.convert request
 * 
 * @author auto create
 * @since 1.0, 2012-11-05 12:39:25
 */
class TaobaokeShopsConvertRequest
{
	/** 
	 * 需返回的字段列表.可选值:TaobaokeShop淘宝客商品结构体中的user_id,shop_title,click_url,commission_rate;字段之间用","分隔.
	 **/
	private $fields;
	
	/** 
	 * 标识一个应用是否来在无线或者手机应用,如果是true则会使用其他规则加密点击串.如果不传值,则默认是false.
	 **/
	private $isMobile;
	
	/** 
	 * 推广者的淘宝会员昵称.注：这里指的是淘宝的登录会员名
	 **/
	private $nick;
	
	/** 
	 * 自定义输入串.格式:英文和数字组成;长度不能大于12个字符,区分不同的推广渠道,如:bbs,表示bbs为推广渠道;blog,表示blog为推广渠道.
	 **/
	private $outerCode;
	
	/** 
	 * 用户的pid,必须是mm_xxxx_0_0这种格式中间的"xxxx". 注意nick和pid至少需要传递一个,如果2个都传了,将以pid为准,且pid的最大长度是20。第一次调用接口的用户，推荐该入参不要填写，使用nick=（淘宝账号）的方式去获取，以免出错。
	 **/
	private $pid;
	
	/** 
	 * 卖家昵称串.最大输入10个.格式如:"value1,value2,value3" 用" , "号分隔。
注意：sids和seller_nicks两个参数任意必须输入一个，如果同时输入，则以seller_nicks为准
	 **/
	private $sellerNicks;
	
	/** 
	 * 店铺id串.最大输入10个.格式如:"value1,value2,value3" 用" , "号分隔店铺id.
注意：sids和seller_nicks两个参数任意必须输入一个，如果同时输入，则以seller_nicks为准
	 **/
	private $sids;
	
	private $apiParas = array();
	
	public function setFields($fields)
	{
		$this->fields = $fields;
		$this->apiParas["fields"] = $fields;
	}

	public function getFields()
	{
		return $this->fields;
	}

	public function setIsMobile($isMobile)
	{
		$this->isMobile = $isMobile;
		$this->apiParas["is_mobile"] = $isMobile;
	}

	public function getIsMobile()
	{
		return $this->isMobile;
	}

	public function setNick($nick)
	{
		$this->nick = $nick;
		$this->apiParas["nick"] = $nick;
	}

	public function getNick()
	{
		return $this->nick;
	}

	public function setOuterCode($outerCode)
	{
		$this->outerCode = $outerCode;
		$this->apiParas["outer_code"] = $outerCode;
	}

	public function getOuterCode()
	{
		return $this->outerCode;
	}

	public function setPid($pid)
	{
		$this->pid = $pid;
		$this->apiParas["pid"] = $pid;
	}

	public function getPid()
	{
		return $this->pid;
	}

	public function setSellerNicks($sellerNicks)
	{
		$this->sellerNicks = $sellerNicks;
		$this->apiParas["seller_nicks"] = $sellerNicks;
	}

	public function getSellerNicks()
	{
		return $this->sellerNicks;
	}

	public function setSids($sids)
	{
		$this->sids = $sids;
		$this->apiParas["sids"] = $sids;
	}

	public function getSids()
	{
		return $this->sids;
	}

	public function getApiMethodName()
	{
		return "taobao.taobaoke.shops.convert";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->fields,"fields");
		RequestCheckUtil::checkMaxListSize($this->sellerNicks,10,"sellerNicks");
		RequestCheckUtil::checkMaxListSize($this->sids,10,"sids");
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
